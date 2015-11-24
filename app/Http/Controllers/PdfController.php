<?php
/**
 * Created by PhpStorm.
 * User: usuario
 * Date: 23/11/15
 * Time: 10:57 AM
 */

namespace Publishers\Http\Controllers;
use DOMPDF;
use Html;

class PdfController extends Controller
{

    public function invoice()
    {
        $data = $this->getData();
        $date = date('Y-m-d');
        $invoice = "2222";
        $view =  \View::make('analytics.invoice', compact('data', 'date', 'invoice'))->render();
//        dd($view);
        $pdf = \App::make('dompdf.wrapper');
        $pdf->loadHTML($view);
        return $pdf->stream('analytics.invoice');

        /*$pdf = App::make('dompdf.wrapper');
        $pdf->loadHTML('<h1>Test</h1>');
        return $pdf->stream();

        $pdf = PDF::loadView('pdf.invoice', $data);
        return $pdf->stream('invoice.pdf');*/
    }

    public function getData()
    {
        $data =  [
            'quantity'      => '1' ,
            'description'   => 'some ramdom text',
            'price'   => '500',
            'total'     => '500'
        ];
        return $data;
    }

}