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

    public function generateAlgorithm(Request $request)
    {
        $Algorithm = new Algorithm(
            $request->plan,
            $request->allergens,
            $request->categories,
            $request->diets
        );

        $Week = $Algorithm->generateWeek();
        $Week = $Algorithm->saveWeek($Week);

        return response()->json($Week);
    }

    public function generateFutureWeek($id, $week) {

    }
}
