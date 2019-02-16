<?php

namespace App\Services;

use Elibyy\TCPDF\Facades\TCPDF;

class Pdf
{
    
    private $pdf;

    public function __construct()
    {
        $this->pdf = new TCPDF('L', 'mm', 'A4', true, 'UTF-8', false, false);

        $this->pdf::SetCreator('ThreeSixFive');
        $this->pdf::SetAuthor('ThreeSixFive');
        $this->pdf::SetTitle('Week Plan');
        $this->pdf::SetSubject('Diet plan for the week');
        $this->pdf::SetKeywords('ThreeSixFive, Food, Recipes, Plan, Diet plan');

        $this->pdf::setPrintHeader(false);
        $this->pdf::setPrintFooter(false);

        $this->pdf::SetFont('Helvetica', 'BI', 20);

        $this->pdf::SetMargins(15, 15, 15, true);
        $this->pdf::SetAutoPageBreak(true, 15);
    }

    public function generate()
    {
        $this->pdf::AddPage('L');

        $txt = 'Hello World';

        $this->pdf::Write(0, $txt, '', 0, 'C', true, 0, false, false, 0);

        $this->pdf::Output('test.pdf', 'D');

    }

}