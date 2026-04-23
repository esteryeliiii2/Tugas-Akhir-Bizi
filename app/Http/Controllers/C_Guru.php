<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Perizinan;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use Illuminate\Support\Facades\Storage;

class C_Guru extends Controller
{

    public function index()
    {
        $user = Auth::user();
        $izin = Perizinan::where(function ($query) {
            $query->where('penginput', Auth::id())
                ->orWhere('approver_umum_id', Auth::id())
                ->orWhere('approver_bk_id', Auth::id());
            })
            ->whereNotIn('status', [5])
            ->get();
        // dd($totalIzin);

        $totalPengajuan = $izin->count();
        if ($user->jabatan == 'guru umum') {
            $dataIzin = $izin->where('status', 0);
            $pengajuanDisetujui = $izin->whereIn('status', [1, 2, 10])->count();
            $pengajuanDitolak = $izin->whereIn('status', [3, 4])->count();
        } elseif ($user->jabatan == 'guru bk') {
            $dataIzin = $izin->where('status', 1);
            $pengajuanDisetujui = $izin->whereIn('status', [2, 10])->count();
            $pengajuanDitolak = $izin->where('status', 4)->count();
        }

        return view('guru.dashboard-guru', compact(
            'dataIzin',
            'totalPengajuan',
            'pengajuanDisetujui',
            'pengajuanDitolak',
            'user'
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
        $user = Auth::user();
        $semuaIzin = Perizinan::where(function ($query) {
            $query->where('penginput', Auth::id())
                ->orWhere('approver_umum_id', Auth::id())
                ->orWhere('approver_bk_id', Auth::id());
            })
            ->whereNotIn('status', [5])
            ->get();
        // dd($totalIzin);

        $pengajuanDisetujui = $semuaIzin->whereIn('status', [2, 10]);
        if ($user->jabatan == 'guru umum') {
            $pengajuanMenunggu = $semuaIzin->whereIn('status', [0, 1]);
            $pengajuanDitolak = $semuaIzin->whereIn('status', [3, 4]);
        } elseif ($user->jabatan == 'guru bk') {
            $semuaIzin = $semuaIzin->whereIn('status', [1, 2, 4, 10]);
            $pengajuanMenunggu = $semuaIzin->whereIn('status', [1]);
            $pengajuanDitolak = $semuaIzin->whereIn('status', [4]);
        }

        return view('guru.daftar-pengajuan', compact(
            'semuaIzin',
            'pengajuanMenunggu',
            'pengajuanDisetujui',
            'pengajuanDitolak',
            'user'
        ));
    }

    public function riwayatIzinGuru()
    {
        $user = Auth::user();
        $semuaIzin = Perizinan::where(function ($query) {
                $query->where('penginput', Auth::id())
                    ->orWhere('approver_umum_id', Auth::id())
                    ->orWhere('approver_bk_id', Auth::id());
            })
            ->whereNotIn('status', [0, 1, 2, 5])
            ->orderBy('created_at', 'desc')
            ->get();

        // mapping status
        if ($user->jabatan == 'guru umum') {
            $izinData = $semuaIzin->whereIn('status', [3, 4, 10]);
        } elseif ($user->jabatan == 'guru bk') {
            $izinData = $semuaIzin->whereIn('status', [4, 10]);
        }

        // grouping by tanggal
        \Carbon\Carbon::setLocale('id');

        $groupData = $izinData->groupBy(function ($item) {
            return \Carbon\Carbon::parse($item->created_at)->format('Y-m-d');
        });

        return view('guru.riwayat-izin-guru', compact(
            'groupData',
            'user'
            // 'groupDitolak'
        ));
    }

    public function profileGuru()
    {
        $user = Auth::user();

        $words = explode(' ', $user->nama);
        $initials = strtoupper(substr($words[0], 0, 1) . (isset($words[1]) ? substr($words[1], 0, 1) : ''));
        
        return view('guru.profile-guru', compact('user', 'initials'));
    }

    public function updateProfileGuru(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:40',
            'gelar' => 'nullable|string|max:10',
            'no_telp' => 'nullable|string|max:15',
            // 'no_telp' => 'required|regex:/^08[0-9]{8,13}$/', //pake kalo nanti mau lebih ketat
            'foto' => 'nullable|image|mimes:jpg,png|max:2048'
        ]);

        $user = Auth::user();

        // upload foto
        if ($request->hasFile('foto')) {
            if ($user->foto) {
                Storage::disk('public')->delete($user->foto);
            }

            $path = $request->file('foto')->store('foto-profil', 'public');
            $user->foto = $path;
        } else if ($request->hapusFoto == 0) {
            if ($user->foto) {
                Storage::disk('public')->delete($user->foto);
            }

            $user->foto = null;
        }
        // dd($request);

        $user->nama = $request->nama;
        $user->gelar = $request->gelar;
        $user->no_telp = $request->no_telp;
        $user->save();

        return back()->with('success', 'Profil berhasil diupdate');
    }

    public function viewPasswordGuru()
    {
        $user = Auth::user();

        return view('guru.kata-sandi', compact('user'));
    }

    public function updatePasswordGuru(Request $request)
    {
        $request->validate([
            'current_password' => ['required', 'current_password'],
            'password' => ['required', 'confirmed', 'min:6']
        ]);

        $user = Auth::user();
        $user->password = bcrypt($request->password);
        $user->save();

        // return back()->with('success', 'Password berhasil diubah');
        return redirect()->route('profile-guru')
            ->with('success', 'Password berhasil diubah');
    }
}
