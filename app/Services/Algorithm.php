<?php

namespace App\Services;

use Fatsecret;
use Carbon\Carbon;
use App\Plan;

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
                'type' => 'main_dish',
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

        foreach ($this->recipe_types as $item) {
            $page = rand(1, (int)$item['totalResults'] / 50);
            $recipes = FatSecret::searchRecipes('', $page, 50, $item['type'])['recipes']['recipe'];
            $numbers = $this->randomSet(sizeof($recipes), sizeof($recipes));

            for ($i = 0, $num = 0; $i < sizeof($item['days']); $i++, $num++) {
                if ($this->checkRecipe((int)$recipes[$numbers[$i]]['recipe_id'], $this->allergens, $this->nogos)) {
                    $weekPlan[$item['days'][$i]][$item['type']] = (int)$recipes[$numbers[$num]]['recipe_id'];
                } else {
                    $i--;
                }
                sleep(1);
            }
        }

        return $weekPlan;
    }

    public function saveWeek($id, $weekPlan) {
        $response = $weekPlan;
        $week = [
            ['Monday', Carbon::now()->startOfWeek()->format('Y-m-d')],
            ['Tuesday', Carbon::now()->startOfWeek()->addDay(1)->format('Y-m-d')],
            ['Wednesday', Carbon::now()->startOfWeek()->addDay(2)->format('Y-m-d')],
            ['Thursday', Carbon::now()->startOfWeek()->addDay(3)->format('Y-m-d')],
            ['Friday', Carbon::now()->startOfWeek()->addDay(4)->format('Y-m-d')],
            ['Saturday', Carbon::now()->startOfWeek()->addDay(5)->format('Y-m-d')],
            ['Sunday', Carbon::now()->endOfWeek()->format('Y-m-d')]
        ];

        foreach ($week as $weekday) {
            if (array_key_exists($weekday[0], $weekPlan)) {
                $response[$weekday[0]] = $weekPlan[$weekday[0]];
                $input = [
                    'pk_date' => $weekday[1],
                    'pk_fk_user_id' => (int)$id,
                    'weekday' => $weekday[0],
                    'breakfast' => $weekPlan[$weekday[0]]['breakfast'],
                    'lunch' => $weekPlan[$weekday[0]]['lunch'],
                    'main_dish' => $weekPlan[$weekday[0]]['main dish'],
                    'snack' => $weekPlan[$weekday[0]]['snack']
                ];

                Plan::create($input);
            } else {
                $response[$weekday[0]]['breakfast'] = null;
                $response[$weekday[0]]['lunch'] = null;
                $response[$weekday[0]]['main_dish'] = null;
                $response[$weekday[0]]['snack'] = null;

                Plan::create([
                    'pk_date' => $weekday[1],
                    'pk_fk_user_id' => (int)$id,
                    'weekday' => $weekday[0],
                    'breakfast' => null,
                    'lunch' => null,
                    'main_dish' => null,
                    'snack' => null
                ]);
            }
        }

        return $response;
    }

    private function checkRecipe($recipe_id, $allergens, $nogos)
    {
        $ingredients = Fatsecret::getRecipe($recipe_id)['recipe']['ingredients']['ingredient'];

        foreach ($ingredients as $ingredient) {
            if (isset($ingredient['food_id'])) {
                $food = FatSecret::getIngredient($ingredient['food_id']);
                if (isset($food['food']['food_sub_categories']['food_sub_category'])) {
                    if (is_array($food['food']['food_sub_categories']['food_sub_category'])) {
                        foreach (($food['food']['food_sub_categories']['food_sub_category']) as $sub_category) {
                            if (in_array($sub_category, $nogos)) {
                                return false;
                            }
                        }
                    }

                    return true;
                }
            }
            sleep(1);
        }

        return false;
    }

    private function randomSet($num, $max)
    {
        $result = [];

        for ($i = 0; $i < $num; $i++) {
            $rand = rand(0, $max - 1);
            if (!in_array($rand, $result)) {
                array_push($result, $rand);
            } else {
                $i--;
            }
        }

        return $result;
    }
}
