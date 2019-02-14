<?php

namespace App\Http\Controllers;

use App\Grocery;
use Carbon\Carbon;
use FatSecret;
use Illuminate\Http\Request;

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

    public function getGroceryList($id) {
    
        $today = Carbon::now();
        $sunday = Carbon::parse('next sunday')->addDay();  
        $dates = [];
        
        for($date = $today; $date->lte($sunday); $date->addDay()) {
            $dates[] = $date->format('Y-m-d');    
        }

        $ingredients = FatSecret::getRecipe(23061811)['recipe']['ingredients'];

        if (Grocery::where('fk_user_id', '=', $id)->get() != null) {
            //array_push($ingredients, Grocery::where('fk_user_id', '=', $id)->get());
        }

        return response()->json($dates);
    
    }
    
    public function createIndividualGroceryList($id, Request $request) {
    
        $this->validate($request, [
            'name' => 'required',
            'fk_user_id' => 'required',
            'quantity' => 'required',
            'checked' => 'required'
        ]);
        
        $grocery = Grocery::create($request->all());
            
        return response()->json($grocery, 201);
    
    }
}
