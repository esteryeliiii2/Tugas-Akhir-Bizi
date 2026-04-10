@extends('layouts.app')

@section('content')

@php
$dataIzin = [
[
'nama' => 'Nicholas Daniel Raditya',
'kelas' => 'XIII (13)',
'no_urut' => '27',
'jurusan' => 'SIJA',
'keperluan' => 'cap 3 jari ijazah SMP di SMPN 1 Semarang',
'jam' => '11:00 - 13:00',
'guru_bk' => 'Retno Yolanda, S.Pd.',
'guru_umum' => 'Agus Setyawan, S.Pd.'
]
];
@endphp

<div class="topbar">

    <div>
        <div class="greeting">Selamat datang kembali 👋</div>
        <div class="title">Mulai tinjau perizinan siswa hari ini</div>
    </div>

    <button class="notif-btn">
        Notifikasi
        <iconify-icon icon="basil:notification-on-outline" width="20"></iconify-icon>
    </button>

</div>

<!-- CARD STAT -->
<div class="card-container">

    <div class="card-guru">
        <div class="card-top-guru">
            <div class="card-icon-guru blue">
                <iconify-icon icon="hugeicons:file-upload"></iconify-icon>
            </div>
            <div>
                <div class="card-value">0</div>
                <div class="card-label">Pengajuan Disetujui</div>
            </div>
        </div>

        <hr class="line-guru">

        <div class="card-link">
            <span>Lihat semua</span>
            <span>→</span>
        </div>
    </div>

    <div class="card-guru">
        <div class="card-top-guru">
            <div class="card-icon-guru green">
                <iconify-icon icon="uim:check"></iconify-icon>
            </div>
            <div>
                <div class="card-value">0</div>
                <div class="card-label">Pengajuan Disetujui</div>
            </div>
        </div>

        <hr class="line-guru">

        <div class="card-link">
            <span>Lihat semua</span>
            <span>→</span>
        </div>
    </div>

    <div class="card-guru">
        <div class="card-top-guru">
            <div class="card-icon-guru red">
                <iconify-icon icon="iconoir:cancel"></iconify-icon>
            </div>
            <div>
                <div class="card-value">0</div>
                <div class="card-label">Pengajuan Disetujui</div>
            </div>
        </div>

        <hr class="line-guru">

        <div class="card-link">
            <span>Lihat semua</span>
            <span>→</span>
        </div>
    </div>


</div>

<!-- SECTION -->
<div class="section-title">Perizinan Siswa</div>

{{-- KONDISI --}}
@if(count($dataIzin) > 0)

@foreach($dataIzin as $index => $izin)
<div class="card-izinn">

    <div class="card-header" data-index="{{ $index }}" onclick="toggleCard(this)">

        <div class="left-header">

            <img src="{{ asset('images/profile.png') }}" class="avatar">

            <div>
                <div class="tanggal">16 Maret 2026, 09:00 WIB</div>

                <div class="nama-row">
                    <div class="nama">{{ $izin['nama'] }}</div>

                    <span class="badge siswa">SISWA</span>
                    <span class="badge sija">SIJA</span>
                </div>
            </div>

        </div>

        <div class="action">
            <button class="btn-tolak">Tolak ✕</button>
            <button class="btn-setuju">Setujui ✓</button>
            <span class="arrow" id="arrow-{{ $index }}" style="transform: rotate(180deg);">⌄</span>
        </div>
    </div>

    <!-- BODY -->
    <div class="card-body" id="card-{{ $index }}">

        <hr class="line-data">

        <div class="grid">

            <div class="col">
                <div class="card-header-none">
                    <span class="card-number" style="color: #7ABAFF;">01.</span>
                    <span class="card-title" style="margin-bottom: 0px;">Data Siswa</span>
                </div>
                <div class="row" style="margin-bottom: 20px; width: fit-content;">
                    <label style="color: #b1b1b1; font-size: 13px; font-weight: 500; margin-bottom: 8px;">
                        NAMA
                    </label>
                    <div class="value" style="width: 100%;">{{ $izin['nama'] }}</div>
                </div>

                <div class="row" style="margin-bottom: 20px; width: fit-content;">
                    <label style="color: #b1b1b1; font-size: 13px; font-weight: 500; margin-bottom: 8px;">
                        NO URUT
                    </label>
                    <div class="value" style="text-align: center; width: 100%;">{{ $izin['no_urut'] }}</div>
                </div>

                <div class="row" style="margin-bottom: 20px; width: fit-content;">
                    <label style="color: #b1b1b1; font-size: 13px; font-weight: 500; margin-bottom: 8px;">
                        KELAS
                    </label>
                    <div class="value" style="width: 100%;">{{ $izin['kelas'] }}</div>
                </div>

                <div class="row" style="margin-bottom: 20px; width: fit-content;">
                    <label style="color: #b1b1b1; font-size: 13px; font-weight: 500; margin-bottom: 8px;">
                        JURUSAN
                    </label>
                    <div class="value" style="width: 100%;">{{ $izin['jurusan'] }}</div>
                </div>
            </div>

            <div class="col">
                <div class="card-header-none">
                    <span class="card-number" style="color: #7ABAFF;">02.</span>
                    <span class="card-title" style="margin-bottom: 0px;">Detail Izin</span>
                </div>
                <div class="row" style="margin-bottom: 20px; width: fit-content;">
                    <label style="color: #b1b1b1; font-size: 13px; font-weight: 500; margin-bottom: 8px;">
                        KEPERLUAN
                    </label>
                    <div class="value" style="width: 100%;">{{ $izin['keperluan'] }}</div>
                </div>

                <div class="row" style="margin-bottom: 20px; width: fit-content;">
                    <label style="color: #b1b1b1; font-size: 13px; font-weight: 500; margin-bottom: 8px;">
                        JAM IZIN
                    </label>
                    <div class="value" style="text-align: center; width: 100%;">{{ $izin['jam'] }}</div>
                </div>
            </div>

            <div class="col">
                <div class="card-header-none">
                    <span class="card-number" style="color: #7ABAFF;">03.</span>
                    <span class="card-title" style="margin-bottom: 0px;">Informasi Guru</span>
                </div>
                <div class="row" style="margin-bottom: 20px; width: fit-content;">
                    <label style="color: #b1b1b1; font-size: 13px; font-weight: 500; margin-bottom: 8px;">
                        GURU BK
                    </label>
                    <div class="value guru">
                        <img src="{{ asset('images/guru cewe.png') }}" class="foto-guru">
                        <span>{{ $izin['guru_bk'] }}</span>
                    </div>
                </div>

                <div class="row" style="margin-bottom: 20px; width: fit-content;">
                    <label style="color: #b1b1b1; font-size: 13px; font-weight: 500; margin-bottom: 8px;">
                        GURU UMUM
                    </label>
                    <div class="value guru small">
                                <img src="{{ asset('images/guru cowo.png') }}" class="foto-guru">
                                <span>{{ $izin['guru_umum'] }}</span>
                            </div>
                </div>
            </div>

        </div>

    </div>

</div>
@endforeach

@else

<!-- EMPTY STATE -->
<div class="empty-state-guru">
    <div class="empty-icon">
        <img src="{{ asset('images/no izin.png') }}" alt="izin">
    </div>
    <div class="empty-title">Belum Ada Pengajuan Izin</div>
    <div class="empty-desc">
        Ajukan izin melalui formulir untuk memulai proses perizinan.
    </div>
</div>

@endif

@endsection

<script>
    function toggleCard(el) {
    const index = el.getAttribute('data-index');

    const card = document.getElementById('card-' + index);
    const arrow = document.getElementById('arrow-' + index);

    const isHidden = window.getComputedStyle(card).display === "none";

    if (isHidden) {
        card.style.display = "block";
        arrow.style.transform = "rotate(180deg)";
    } else {
        card.style.display = "none";
        arrow.style.transform = "rotate(0deg)";
    }
}
</script>