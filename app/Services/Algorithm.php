<?php

namespace App\Services;

use Fatsecret;

class Algorithm
{
    private $recipe_types = [
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

    public function __construct($plan)
    {
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

    }

    private function generateType()
    {

    }
}
