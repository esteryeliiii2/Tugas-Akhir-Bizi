<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Barryvdh\DomPDF\Facade\Pdf;

class SuratController extends Controller
{
    public function preview()
    {
        return view('pdf.surat-izin');
    }

    public function pdf()
    {
        $pdf = Pdf::loadView('pdf.surat-izin');
        return $pdf->stream('surat-izin.pdf');
    }
}
