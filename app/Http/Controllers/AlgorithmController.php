<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use FatSecret;
use App\Services\Algorithm;

class AlgorithmController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function generateAlgorithm($id, Request $request)
    {

        $recipe_ids = [];
        $nogos = $request->nogos;
        $diets = $request->diets;
        $allergens = $request->allergens;
        $plan = $request->plan;
        $counter = [
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

        // Count
        foreach ($plan as $weekday) {
            if ($weekday['breakfast']) {
                $counter['breakfast']['count'] += (int)$weekday['breakfast'];
                array_push($counter['breakfast']['days'], $weekday['weekday']);
            }
            if ($weekday['lunch']) {
                $counter['lunch']['count'] += (int)$weekday['lunch'];
                array_push($counter['lunch']['days'], $weekday['weekday']);
            }
            if ($weekday['main dish']) {
                $counter['main dish']['count'] += (int)$weekday['main dish'];
                array_push($counter['main dish']['days'], $weekday['weekday']);
            }
            if ($weekday['snack']) {
                $counter['snack']['count'] += (int)$weekday['snack'];
                array_push($counter['snack']['days'], $weekday['weekday']);
            }
        }

        // Select random recipes
        foreach ($counter as $item) {
            $page = rand(1, (int)$item['totalResults'] / 50);
            $recipes = FatSecret::searchRecipes('', $page, 50, $item['type'])['recipes']['recipe'];
            $numbers = $this->randomSet($item['count'], sizeof($recipes));

            for ($i = 0; $i < sizeof($item['days']); $i++) {
                $recipe_ids[$item['days'][$i]][$item['type']] = (int)$recipes[$numbers[$i]]['recipe_id'];
            }
        }

        return response()->json($recipe_ids);
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
