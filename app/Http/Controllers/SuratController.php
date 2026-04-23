<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Barryvdh\DomPDF\Facade\Pdf;
use App\Models\Perizinan;

class SuratController extends Controller
{

    public function show($token)
    {
        $izin = Perizinan::where('token', $token)->firstOrFail();

        return view('satpam.verifikasi', compact('izin'));
    }

    public function pdf($token)
    {
        $izin = Perizinan::where('token', $token)->firstOrFail();

        $pdf = Pdf::loadView('pdf.surat-izin', compact('izin'))
            ->setPaper('A4', 'portrait')
            ->setOptions([
                'isRemoteEnabled' => true,
                'isHtml5ParserEnabled' => true,
                'enable_php' => false,
            ]);

        return $pdf->stream('surat.pdf');
    }

    public function verifikasi($token)
    {
        $izin = Perizinan::where('token', $token)
            ->where('status', 2)
            ->firstOrFail();

        $izin->update([
            'status' => 10
        ]);

        return back()->with('success', 'Berhasil diverifikasi');
    }
}
