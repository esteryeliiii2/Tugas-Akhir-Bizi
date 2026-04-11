<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Perizinan;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class C_Guru extends Controller
{

    public function index()
    {
        // $users = User::all();
        $user = Auth::user();
        if ($user->jabatan != 'guru umum' && $user->jabatan != 'guru bk') {
            return redirect()->route('dashboard-siswa');
        }
        return view('guru.dashboard-guru');
    }

    public function daftarPengajuan()
    {
        // $users = User::all();

        return view('guru.daftar-pengajuan');
    }

    public function riwayatIzinGuru()
    {
        return view('guru.riwayat-izin-guru');
    }
}
