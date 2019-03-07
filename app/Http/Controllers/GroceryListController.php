<?php

namespace App\Http\Controllers;

use App\Grocery;
use App\Plan;
use App\Recipe;
use Carbon\Carbon;
use FatSecret;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class GroceryListController extends Controller
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

    public function getCurrentGroceryList()
    {
        $today = Carbon::now()->format('Y-m-d');
        $sunday = Carbon::parse('next sunday')->format('Y-m-d');

        if (!($groceries_users = Grocery::where('fk_user_id', '=', Auth::id())->get(['name', 'serving', 'measurement', 'checked', 'generated']))->isEmpty()) {
            if ($groceries_users->where('generated', true)->isEmpty()) {
                if (!($plan = Plan::where('pk_fk_user_id', '=', Auth::id())->whereBetween('pk_date', [$today, $sunday])->get(['breakfast', 'lunch', 'main_dish', 'snack']))->isEmpty()) {
                    foreach ($plan as $item) {
                        foreach (['breakfast', 'lunch', 'main_dish', 'snack'] as $type) {
                            if (($recipe_id = $item[$type]) != null) {
                                $recipe = new Recipe(Fatsecret::getRecipe($recipe_id)['recipe']);
                                foreach ($recipe->getIngredients() as $ingredient) {
                                    if (Grocery::where('name', $ingredient->getName())->get()->isEmpty()) {
                                        $input = [
                                            'name' => $ingredient->getName(),
                                            'serving' => (($measurement = $ingredient->getMeasurement()) != 'g' ? $ingredient->getGrams($measurement) : $measurement) * $ingredient->getUnits(),
                                            'measurement' => 'g',
                                            'checked' => false,
                                            'generated' => true
                                        ];

                                        $groceries_users->push($input);

                                        $input['fk_user_id'] = Auth::id();
                                        Grocery::create($input);
                                    } else {
                                        $grams = $ingredient->getGrams($ingredient->getMeasurement());
                                        $currentGrams = Grocery::where('name', $ingredient->getName())->value('serving');

                                        Grocery::where('name', $ingredient->getName())->update(['serving' => $currentGrams + $grams]);
                                    }
                                }
                            }
                        }
                    }
                }
            }
        }

        return response()->json($groceries_users);
    }

    public function getNextGroceryList()
    {
        $nextMonday = (new Carbon('next Monday'))->format('Y-m-d');
        $nextSunday = (new Carbon('next Monday'))->endOfWeek()->format('Y-m-d');

        if (!($nextWeek = Plan::where('pk_fk_user_id', '=', Auth::id())->whereBetween('pk_date', [$nextMonday, $nextSunday])->get(['breakfast', 'lunch', 'main_dish', 'snack']))->isEmpty()) {
            return response()->json($nextWeek);
        } else {
            return response()->json(['The plan for the next week is not generated yet.' => 428], 428);
        }
    }

    public function createIndividualGroceryList(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'serving' => 'required',
            'measurement' => 'required',
            'checked' => 'required'
        ]);

        $input = $request->all();

        $input['fk_user_id'] = Auth::id();
        $input['generated'] = false;

        $grocery = Grocery::create($input);

        return response()->json($grocery, 201);
    }
}
