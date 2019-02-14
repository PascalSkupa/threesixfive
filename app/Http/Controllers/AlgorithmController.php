<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use FatSecret;
use App\Services\Algorithm;
use App\Plan;

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
        $Algorithm = new Algorithm(
            $request->plan,
            $request->allergens,
            $request->categories,
            $request->diets
        );

        $Week = $Algorithm->generateWeek();

        return response()->json($Week);
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

    public function checkRecipe($recipe_id, $allergens, $nogos)
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
}
