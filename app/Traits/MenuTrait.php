<?php

namespace App\Traits;

use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

trait MenuTrait
{
    public function getMenuWeek($year, $week, $json = true)
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

        if ($json) {
            return response()->json($weekPlan);
        } else {
            return $weekPlan;
        }
    }
}