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

    public function createAlgorithm(Request $request)
    {
        $Algorithm = new Algorithm(
            $request->plan,
            $request->allergens,
            $request->categories,
            $request->diets
        );
        return response()->json($Algorithm->saveUserPreferences());
        //$Algorithm->saveUserPreferences();

        //$Week = $Algorithm->generateWeek();
        //$Week = $Algorithm->saveWeek($Week, 0);

        //return response()->json($Week);
    }

    public function generateWeek($week)
    {

    }
}
