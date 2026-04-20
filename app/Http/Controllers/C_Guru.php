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
        $izin = Perizinan::where(function ($query) {
            $query->where('penginput', Auth::id())
                ->orWhere('approver_umum_id', Auth::id())
                ->orWhere('approver_bk_id', Auth::id());
            })
            ->whereNotIn('status', [5])
            ->get();
        // dd($totalIzin);

        $totalPengajuan = $izin->count();
        $pengajuanDisetujui = $izin->whereIn('status', [1,2,10])->count();
        $pengajuanDitolak = $izin->whereIn('status', [3,4])->count();
        $dataIzin = $izin->where('status', 0);

        return view('guru.dashboard-guru', compact(
            'dataIzin',
            'totalPengajuan',
            'pengajuanDisetujui',
            'pengajuanDitolak'
        ));
    }

    public function persetujuanGuru(Request $request)
    {
        $request->validate([
            'id' => 'required|exists:perizinan,id',
            'jenis' => 'required|in:0,1',
            'catatanPenolakan' => 'nullable'
        ]);
        dd($request);

        $izin = Perizinan::where('id', $request->id)
            ->where(function ($query) {
                $query->where('approver_umum_id', Auth::id())
                    ->orWhere('approver_bk_id', Auth::id());
            })
            ->firstOrFail();

        // 0 = tolak, 1 = setujui
        if ($request->jenis == 1) {
            $izin->update([
                'status' => 1
            ]);

            $pesan = 'Pengajuan berhasil disetujui';
        } else {
            $izin->update([
                'status' => 3,
                'alasan_reject' => $request->catatanPenolakan
            ]);

            $pesan = 'Pengajuan berhasil ditolak';
        }

        return redirect()->back()->with('success', $pesan);
    }

    public function daftarPengajuan()
    {
        $semuaIzin = Perizinan::where(function ($query) {
            $query->where('penginput', Auth::id())
                ->orWhere('approver_umum_id', Auth::id())
                ->orWhere('approver_bk_id', Auth::id());
            })
            ->whereNotIn('status', [5])
            ->get();
        // dd($totalIzin);

        $pengajuanMenunggu = $semuaIzin->where('status', 0);
        $pengajuanDisetujui = $semuaIzin->whereIn('status', [1,2,10]);
        $pengajuanDitolak = $semuaIzin->whereIn('status', [3,4]);

        return view('guru.daftar-pengajuan', compact(
            'semuaIzin',
            'pengajuanMenunggu',
            'pengajuanDisetujui',
            'pengajuanDitolak'
        ));
    }

    public function riwayatIzinGuru()
    {
        $semuaIzin = Perizinan::where(function ($query) {
                $query->where('penginput', Auth::id())
                    ->orWhere('approver_umum_id', Auth::id())
                    ->orWhere('approver_bk_id', Auth::id());
            })
            ->whereNotIn('status', [5])
            ->orderBy('created_at', 'desc')
            ->get();

        // mapping status
        $izinDisetujui = $semuaIzin->whereIn('status', [1,2,10]);
        $izinDitolak   = $semuaIzin->whereIn('status', [3,4]);

        // grouping by tanggal
        \Carbon\Carbon::setLocale('id');

        $groupDisetujui = $izinDisetujui->groupBy(function ($item) {
            return \Carbon\Carbon::parse($item->created_at)->format('Y-m-d');
        });

        $groupDitolak = $izinDitolak->groupBy(function ($item) {
            return \Carbon\Carbon::parse($item->created_at)->format('Y-m-d');
        });

        return view('guru.riwayat-izin-guru', compact(
            'groupDisetujui',
            'groupDitolak'
        ));
    }
}
