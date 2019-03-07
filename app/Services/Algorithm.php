<?php

namespace App\Services;

use App\Recipe;
use Fatsecret;
use Carbon\Carbon;
use App\Plan;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class Algorithm
{
    private $recipe_types;
    private $diets;
    private $allergens;
    private $nogos;

    public function __construct($plan, $allergens, $nogos, $diets)
    {
        $this->recipe_types = [
            'breakfast' => [
                'count' => 0,
                'totalResults' => (int)FatSecret::searchRecipes('', 0, 1, 'breakfast')['recipes']['total_results'],
                'type' => 'breakfast',
                'days' => []
            ],
            'lunch' => [
                'count' => 0,
                'totalResults' => (int)FatSecret::searchRecipes('', 0, 1, 'lunch')['recipes']['total_results'],
                'type' => 'lunch',
                'days' => []
            ],
            'main dish' => [
                'count' => 0,
                'totalResults' => (int)FatSecret::searchRecipes('', 0, 1, 'main dish')['recipes']['total_results'],
                'type' => 'main dish',
                'days' => []
            ],
            'snack' => [
                'count' => 0,
                'totalResults' => (int)FatSecret::searchRecipes('', 0, 1, 'snack')['recipes']['total_results'],
                'type' => 'snack',
                'days' => []
            ]
        ];
        $this->allergens = $allergens;
        $this->nogos = $nogos;
        $this->diets = $diets;

        foreach ($plan as $weekday) {
            if ($weekday['breakfast']) {
                $this->recipe_types['breakfast']['count'] += (int)$weekday['breakfast'];
                array_push($this->recipe_types['breakfast']['days'], $weekday['weekday']);
            }
            if ($weekday['lunch']) {
                $this->recipe_types['lunch']['count'] += (int)$weekday['lunch'];
                array_push($this->recipe_types['lunch']['days'], $weekday['weekday']);
            }
            if ($weekday['main dish']) {
                $this->recipe_types['main dish']['count'] += (int)$weekday['main dish'];
                array_push($this->recipe_types['main dish']['days'], $weekday['weekday']);
            }
            if ($weekday['snack']) {
                $this->recipe_types['snack']['count'] += (int)$weekday['snack'];
                array_push($this->recipe_types['snack']['days'], $weekday['weekday']);
            }
        }
    }

    public function generateWeek()
    {
        $weekPlan = null;

        foreach ($this->recipe_types as $recipe_type) {
            for ($i = 0, $num = 0, $new_page = true; $i < sizeof($recipe_type['days']); $i++, $num++) {
                if ($new_page) {
                    $current_page = rand(1, (int)$recipe_type['totalResults'] / 50);
                    $recipes = FatSecret::searchRecipes('', $current_page, 50, $recipe_type['type'])['recipes']['recipe'];
                    $numbers = range(0, sizeof($recipes) - 1);
                    shuffle($numbers);
                    $new_page = false;
                }

                if ($i == sizeof($recipes) - 1) {
                    $new_page = true;
                } elseif ($recipe = $this->checkRecipe((int)$recipes[$numbers[$i]]['recipe_id'], $this->allergens, $this->nogos, $this->diets)) {
                    $weekPlan[$recipe_type['days'][$i]][$recipe_type['type']] = $recipe();
                } else {
                    $i--;
                }

                sleep(1);
            }
        }

        return $weekPlan;
    }

    public function saveWeek($weekPlan)
    {
        $response = null;
        $week = [
            ['Monday', Carbon::now()->startOfWeek()->format('Y-m-d')],
            ['Tuesday', Carbon::now()->startOfWeek()->addDay(1)->format('Y-m-d')],
            ['Wednesday', Carbon::now()->startOfWeek()->addDay(2)->format('Y-m-d')],
            ['Thursday', Carbon::now()->startOfWeek()->addDay(3)->format('Y-m-d')],
            ['Friday', Carbon::now()->startOfWeek()->addDay(4)->format('Y-m-d')],
            ['Saturday', Carbon::now()->startOfWeek()->addDay(5)->format('Y-m-d')],
            ['Sunday', Carbon::now()->endOfWeek()->format('Y-m-d')]
        ];

        foreach ($week as $weekDay) {
            if (array_key_exists($weekDay[0], $weekPlan)) {
                $response[$weekDay[0]] = $weekPlan[$weekDay[0]];
                $input = [
                    'pk_date' => $weekDay[1],
                    'pk_fk_user_id' => (int)Auth::id(),
                    'weekday' => $weekDay[0],
                    'breakfast' => $weekPlan[$weekDay[0]]['breakfast']['id'],
                    'lunch' => $weekPlan[$weekDay[0]]['lunch']['id'],
                    'main_dish' => $weekPlan[$weekDay[0]]['main dish']['id'],
                    'snack' => $weekPlan[$weekDay[0]]['snack']['id']
                ];

                Plan::create($input);
            } else {
                $response[$weekDay[0]]['breakfast'] = null;
                $response[$weekDay[0]]['lunch'] = null;
                $response[$weekDay[0]]['main_dish'] = null;
                $response[$weekDay[0]]['snack'] = null;

                Plan::create([
                    'pk_date' => $weekDay[1],
                    'pk_fk_user_id' => (int)Auth::id(),
                    'weekday' => $weekDay[0],
                    'breakfast' => null,
                    'lunch' => null,
                    'main_dish' => null,
                    'snack' => null
                ]);
            }
        }

        return $response;
    }

    private function checkRecipe($recipe_id, $allergens, $nogos, $diets)
    {
        $recipe = new Recipe(Fatsecret::getRecipe($recipe_id)['recipe']);

        foreach ($allergens as $allergen) {
            if ($recipe->hasAllergen($allergen)) {
                return false;
            }
        }

        foreach ($nogos as $nogo) {
            if ($recipe->hasNoGo($nogo)) {
                return false;
            }
        }

        foreach ($diets as $diet) {
            if ($recipe->hasDiet($diet)) {
                return false;
            }
        }

        return $recipe;
    }

    public function checkHistory($recipe_id)
    {
        $today = Carbon::today()->format('Y-m-d');
        $pastWeek = Carbon::today()->subWeek()->format('Y-m-d');

        $select = DB::table('plans')
            ->where('pk_fk_user_id', '=', Auth::id())
            ->where('pk_date', '>=', $today)
            ->where('pk_date', '<=', $pastWeek)->get();

        foreach ($select as $item) {
            if ($item->beakfast == $recipe_id | $item->lunch == $recipe_id | $item->main_dish == $recipe_id | $item->snack == $recipe_id) {
                return false;
            }
        }

        return true;
    }
}