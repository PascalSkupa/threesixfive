<?php

namespace App\Http\Controllers;

use App\Plan;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class MenuController extends Controller
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

    public function getMenu($year, $week)
    {

        $date = Carbon::now();
        $date->setISODate($year, $week);
        $weekPlan = null;

        $firstDate = $date->format('Y-m-d');
        $lastDate = $date->endOfWeek()->format('Y-m-d');

        $select = DB::table('plans')
            ->where('pk_fk_user_id', '=', Auth::id())
            ->where('pk_date', '>=', $firstDate)
            ->where('pk_date', '<=', $lastDate)->get();

        foreach ($select as $item) {
            $weekPlan[$item->weekday]['breakfast'] = $item->breakfast;
            $weekPlan[$item->weekday]['lunch'] = $item->lunch;
            $weekPlan[$item->weekday]['main_dish'] = $item->main_dish;
            $weekPlan[$item->weekday]['snack'] = $item->snack;
        }

        return response()->json($weekPlan);
    }
}
