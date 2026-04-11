<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Perizinan;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class C_Siswa extends Controller
{

    public function index()
    {
        // $users = User::all();
        $user = Auth::user();
        if ($user->jabatan != 'siswa') {
            return redirect()->route('dashboard-guru');
        }

        return view('siswa.dashboard');
    }

    public function statusIzin()
    {
        // $users = User::all();

        return view('siswa.status-izin');
    }

    public function ajukanIzin()
    {
        return view('siswa.ajukan-izin');
    }

    public function guruApprove()
    {
        $data = session('izin_data');

        if (!$data) {
            return redirect()->route('ajukan_izin-siswa');
        }
        // dd($data);

        $user = Auth::user();

        $queryBk = User::where('jabatan', 'guru bk');
        $queryBk->where('jurusan', $user->jurusan);
        $queryUmum = User::where('jabatan', 'guru umum');

        $guruBk = $queryBk->get()->first();
        $guruUmum = $queryUmum->get();
        $guruUmumFirst = $guruUmum->first();

        return view('siswa.guru-approve', compact('data', 'guruBk', 'guruUmum', 'guruUmumFirst'));
    }

    public function store(Request $request)
    {
        $data = session('izin_data');

        if (!$data) {
            return redirect()->route('ajukan_izin-siswa');
        }

        $kembali_lagi = ($data['kembali'] == 'ya') ? true : false;

        // gabung data step 1 + step 2
        $finalData = array_merge($data, [
            'approver_umum_id' => $request->id_guru_umum,
            'approver_umum' => $request->nama_guru_umum,
            'approver_bk_id' => $request->id_guru_bk,
            'approver_bk' => $request->nama_guru_bk,
            'penginput' => Auth::id(),
            'kembali_lagi' => $kembali_lagi,
            'status' => 0,
            'jam_mulai' => Carbon::today()->setTimeFromTimeString($data['jam_mulai']),
            'jam_selesai' => $data['jam_selesai'] ? Carbon::today()->setTimeFromTimeString($data['jam_selesai']) : null,
        ]);

        dd($finalData); //sementara biar ga kepush kalo ga sengaja

        Perizinan::create($finalData);

        session()->forget('izin_data'); //ni hapus session yg sementara

        // Perizinan::create([
        //     'nama' => $request->nama,
        //     'no_presensi' => $request->no_presensi,
        //     'kelas' => $request->kelas,
        //     'jurusan' => $request->jurusan,
        //     'kembali' => $request->kembali,
        //     'keperluan' => $request->keperluan,
        //     'jam_mulai' => $request->jam_mulai,
        //     'jam_selesai' => $request->jam_selesai,
        // ]);

        return redirect()->route('status_izin-siswa');
    }

    public function storeSession(Request $request)
    {
        session(['izin_data' => $request->all()]); //simpen dulu di session
        // dd(session()->all());

        return redirect()->route('guru_approve-siswa');
    }
}
