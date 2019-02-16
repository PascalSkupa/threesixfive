<?php

namespace App\Http\Controllers;

use App\Services\Pdf;

class PdfController extends Controller
{

    /*public function __construct()
    {
        $this->middleware('auth');
    }*/

    public function generateWeekPlan($id, $week)
    {
        $pdf = new Pdf();

        $pdf->generate();
    }
}