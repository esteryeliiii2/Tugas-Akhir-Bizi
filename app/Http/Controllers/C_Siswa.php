<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Perizinan;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Storage;


class C_Siswa extends Controller
{

    public function index()
    {
        // $users = User::all();
        // $user = Auth::user();
        // if ($user->jabatan != 'siswa') {
        //     return redirect()->route('dashboard-guru');
        // }

        $izin = Perizinan::where(function ($query) {
            $query->where('penginput', Auth::id())
                ->orWhere('approver_umum_id', Auth::id())
                ->orWhere('approver_bk_id', Auth::id());
        })
            ->whereNotIn('status', [5])
            ->whereDate('created_at', now())
            ->latest()
            ->first();

        $gabisaIzinLagi = false;
        if ($izin) {
            if (in_array($izin->status, [0, 1, 2, 5])) {
                $gabisaIzinLagi = true;
            } elseif ($izin->status == 10 && !$izin->kembali_lagi) {
                $gabisaIzinLagi = true;
            }
        }

        return view('siswa.dashboard', compact('izin', 'gabisaIzinLagi'));
    }

    public function ajukanIzin()
    {
        $izin = Perizinan::where(function ($query) {
            $query->where('penginput', Auth::id())
                ->orWhere('approver_umum_id', Auth::id())
                ->orWhere('approver_bk_id', Auth::id());
        })
            ->whereNotIn('status', [5])
            ->whereDate('created_at', now())
            ->latest()
            ->first();
        
        $gabisaIzinLagi = false;
        if ($izin) {
            if (in_array($izin->status, [0, 1, 2, 5])) {
                $gabisaIzinLagi = true;
            } elseif ($izin->status == 10 && !$izin->kembali_lagi) {
                $gabisaIzinLagi = true;
            }
        }

        if($gabisaIzinLagi) {
            return redirect()->route('dashboard-siswa');
        }
        //nanti dibuat cek, jika saat ini udah ada pengajuan maka gabisa ngajuin lagi, selain itu dibuat biar cuma bisa izin dari jam 00:00 - 15.30
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


    public function storeSession(Request $request)
    {
        session(['izin_data' => $request->all()]); //simpen dulu di session
        // dd(session()->all());

        return redirect()->route('guru_approve-siswa');
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

        // dd($finalData); //sementara biar ga kepush kalo ga sengaja

        Perizinan::create($finalData);

        session()->forget('izin_data'); //ni hapus session yg sementara

        return redirect()->route('status_izin-siswa');
    }

    public function statusIzin()
    {
        $izin = Perizinan::where('penginput', Auth::id())
            ->whereNotIn('status', [5])
            ->whereDate('created_at', now())
            ->latest()
            ->first();

        return view('siswa.status-izin', compact('izin'));
    }

    public function batal(Request $request)
    {
        $izin = Perizinan::where('id', $request->id)
            ->where('penginput', Auth::id()) // biar ga bisa batalin punya orang lain
            ->firstOrFail();
        // update status jadi 5 (batal)
        $izin->update([
            'status' => 5
        ]);

        return redirect()->route('status_izin-siswa')
            ->with('success', 'Pengajuan berhasil dibatalkan');
    }

    public function riwayatIzinSiswa()
    {
        $semuaIzin = Perizinan::where(function ($query) {
            $query->where('penginput', Auth::id());
        })
            ->whereNotIn('status', [0, 1, 2, 5])
            ->orderBy('created_at', 'desc')
            ->get();

        // mapping status
        $izinData = $semuaIzin->whereIn('status', [3, 4, 10]);
        // $izinDitolak   = $semuaIzin->whereIn('status', [3, 4]);

        // grouping by tanggal
        \Carbon\Carbon::setLocale('id');

        $groupData = $izinData->groupBy(function ($item) {
            return \Carbon\Carbon::parse($item->created_at)->format('Y-m-d');
        });

        // $groupDitolak = $izinDitolak->groupBy(function ($item) {
        //     return \Carbon\Carbon::parse($item->created_at)->format('Y-m-d');
        // });

        return view('siswa.riwayat-izin-siswa', compact(
            'groupData',
            // 'groupDitolak'
        ));
    }

    public function downloadPDF($id)
    {
        \Carbon\Carbon::setLocale('id'); 
        $izin = Perizinan::findOrFail($id);
        $pdf = Pdf::loadView('pdf.surat-izin', compact('izin'));
        return $pdf->stream('Surat_Izin_' . $izin->nama . '.pdf');
    }

    public function profileSiswa()
    {
        $user = Auth::user();

        $words = explode(' ', $user->nama);
        $initials = strtoupper(substr($words[0], 0, 1) . (isset($words[1]) ? substr($words[1], 0, 1) : ''));
        
        return view('siswa.profile-siswa', compact('user', 'initials'));
    }

    public function updateProfileSiswa(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:40',
            'email' => 'required|email|max:90',
            // 'email' => 'required|email:rfc,dns|max:90|unique:users,email,' . Auth::id() //pake kalo nanti mau lebih ketat
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
        $user->email = $request->email;
        $user->save();

        return back()->with('success', 'Profil berhasil diupdate');
    }

    public function viewPasswordSiswa()
    {
        $user = Auth::user();

        return view('siswa.kata-sandi', compact('user'));
    }

    public function updatePasswordSiswa(Request $request)
    {
        $request->validate([
            'current_password' => ['required', 'current_password'],
            'password' => ['required', 'confirmed', 'min:6']
        ]);

        $user = Auth::user();
        $user->password = bcrypt($request->password);
        $user->save();

        // return back()->with('success', 'Password berhasil diubah');
        return redirect()->route('profile-siswa')
            ->with('success', 'Password berhasil diubah');
    }
}
