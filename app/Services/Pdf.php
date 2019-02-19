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

        $this->pdf::SetFont('Helvetica', 'BI', 10);

        $this->pdf::SetMargins(15, 15, 15, true);
        $this->pdf::SetAutoPageBreak(true, 15);
    }

    public function generate($weekPlan)
    {
        $this->pdf::AddPage('L');

        $html = '<table>
                    <tr>
                        <th>Monday</th>
                        <th>Tuesday</th>
                        <th>Wednesday</th>
                        <th>Thursday</th>
                        <th>Friday</th>
                        <th>Saturday</th>
                        <th>Sunday</th>
                    </tr>
                    ' . $this->generateHTMLTable($weekPlan) . '
                 </table>';

        $this->pdf::writeHTML($html, true, false, false, false, 'C');

        $this->pdf::Output('test.pdf', 'D');
    }

    private function generateHTMLTable($weekplan)
    {
        $table = '';

        foreach (['breakfast', 'lunch', 'main_dish', 'snack'] as $type) {
            $table .= '<tr>';

            foreach ($weekplan as $day) {
                $table .= '<th>' . $day[$type] . '</th>';
            }

            $table .= '</tr>';
        }

        return $table;
    }

}