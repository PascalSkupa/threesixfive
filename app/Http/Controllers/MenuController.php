<?php

namespace App\Http\Controllers;

use App\Traits\MenuTrait;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class MenuController extends Controller
{
    use MenuTrait;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function getMenuDay($date)
    {
        $dayPlan = null;

        $select = DB::table('plans')
            ->where('pk_fk_user_id', '=', Auth::id())
            ->where('pk_date', '=', $date)->first();

        $dayPlan[$select->weekday]['breakfast'] = $select->breakfast;
        $dayPlan[$select->weekday]['lunch'] = $select->lunch;
        $dayPlan[$select->weekday]['main_dish'] = $select->main_dish;
        $dayPlan[$select->weekday]['snack'] = $select->snack;
        
        return response()->json($dayPlan);
    }
}
