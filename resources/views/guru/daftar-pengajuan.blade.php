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


<div class="page-header" style="margin-bottom: 24px;">

    <h1 class="page-title">Daftar Pengajuan Izin</h1>

    <p class="page-desc">
        Kelola dan proses pengajuan izin siswa dengan cepat dan terstruktur.
    </p>

</div>

<div class="filter-tabs">
    <button class="tab active" data-filter="all">Semua</button>
    <button class="tab" data-filter="menunggu">Menunggu</button>
    <button class="tab" data-filter="disetujui">Disetujui</button>
    <button class="tab" data-filter="ditolak">Ditolak</button>
</div>

<div class="section-item" data-status="menunggu">

    <div class="section-title" style="margin-top: 32px; font-size: 14px;">
        Menunggu Peninjauan
    </div>

    @if(count($dataIzin) > 0)

    @foreach($dataIzin as $index => $izin)
    <div class="card-izinn">

        <div class="card-header" data-index="menunggu-{{ $index }}" onclick="toggleCard(this)">

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
                <span class="arrow" id="arrow-menunggu-{{ $index }}">⌄</span>
            </div>
        </div>

        <!-- BODY -->
        <div class="card-body" id="card-menunggu-{{ $index }}" style="display: none;">

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

</div>

@endif


<div class="section-item" data-status="disetujui">

    <div class="section-title" style="margin-top: 32px; font-size: 14px;">
        Perizinan Disetujui
    </div>

    @if(count($dataIzin) > 0)

    @foreach($dataIzin as $index => $izin)
    <div class="card-izinn">

        <div class="card-header" data-index="izin-{{ $index }}" onclick="toggleCard(this)">

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
                <span class="badge-status disetujui">
                    Perizinan Disetujui ✓
                </span>
                <span class="arrow" id="arrow-izin-{{ $index }}">⌄</span>
            </div>
        </div>

        <!-- BODY -->
        <div class="card-body" id="card-izin-{{ $index }}" style="display: none;">

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

</div>

@endif

<div class="section-item" data-status="ditolak">

    <div class="section-title" style="margin-top: 32px; font-size: 14px;">
        Perizinan Ditolak
    </div>

    @if(count($dataIzin) > 0)

    @foreach($dataIzin as $index => $izin)
    <div class="card-izinn">

        <div class="card-header" data-index="ditolak-{{ $index }}" onclick="toggleCard(this)">

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
                <span class="badge-status ditolak">
                    Perizinan Ditolak ✕
                </span>
                <span class="arrow" id="arrow-ditolak-{{ $index }}">⌄</span>
            </div>
        </div>

        <!-- BODY -->
        <div class="card-body" id="card-ditolak-{{ $index }}" style="display: none;">

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

</div>

@endif

@endsection

<script>
    document.addEventListener("DOMContentLoaded", function() {

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

        window.toggleCard = toggleCard; // biar bisa dipanggil dari HTML

        const tabs = document.querySelectorAll('.tab');
        const items = document.querySelectorAll('.section-item');

        tabs.forEach(tab => {
            tab.addEventListener('click', () => {

                tabs.forEach(t => t.classList.remove('active'));
                tab.classList.add('active');

                const filter = tab.getAttribute('data-filter');

                items.forEach(item => {
                    if (filter === 'all') {
                        item.style.display = '';
                    } else {
                        item.style.display =
                            item.getAttribute('data-status') === filter ?
                            '' :
                            'none';
                    }
                });
            });
        });

    });
</script>