<?php

namespace App\Http\Controllers;

use App\Services\Pdf;
use App\Traits\MenuTrait;

class PdfController extends Controller
{
    use MenuTrait;

    /*public function __construct()
    {
        $this->middleware('auth');
    }*/

    public function generateWeekPlan($year, $week)
    {
        $pdf = new Pdf();

        $pdf->generate($this->getMenuWeek($year, $week, false));
    }
}