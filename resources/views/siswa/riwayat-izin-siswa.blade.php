@extends('layouts.app')

@section('content')

@if (count($semuaIzin) == 0)

<!-- empty state -->
<div id="empty-state">
    <div class="empty-wrapper">
        <div class="empty-izin">

            <div class="empty-icon">
                <img src="{{ asset('images/no izin.png') }}" alt="izin">
            </div>

            <div class="empty-title">
                Belum Ada Riwayat Izin
            </div>

            <div class="empty-desc">
                Pengajuan izin yang telah selesai akan muncul di sini.
            </div>

            <a href="{{ route('ajukan_izin-siswa') }}" class="empty-btn">
                Ajukan Izin
            </a>

        </div>
    </div>
</div>

@else

<!-- ada data -->
<div class="page-header" style="margin-bottom: 24px;">

    <h1 class="page-title">Riwayat Pengajuan Izin</h1>

    <p class="page-desc">
        Lihat semua pengajuan izin yang pernah kamu buat.
    </p>

</div>

<div class="search-container">
    <div class="search-box">
        <iconify-icon icon="mynaui:search" class="search-icon"></iconify-icon>
        <input type="text" id="searchInput" placeholder="Cari riwayat perizinan..." />
    </div>

    <div class="filter-box">

        <div class="dropdown">
            <div class="dropdown-btn">
                Semua Status
                <iconify-icon icon="mdi:chevron-down"></iconify-icon>
            </div>
            <div class="dropdown-content">
                <div>Semua Status</div>
                <div>Disetujui</div>
                <div>Ditolak</div>
            </div>
        </div>

        <div class="dropdown">
            <div class="dropdown-btn">
                7 hari terakhir
                <iconify-icon icon="mdi:chevron-down"></iconify-icon>
            </div>
            <div class="dropdown-content">
                <div>7 hari terakhir</div>
                <div>30 hari terakhir</div>
            </div>
        </div>

    </div>
</div>

@foreach($groupDisetujui as $tanggal => $items)

<div class="section-item">

    <div class="section-title" style="margin-top: 32px; font-size: 14px;">
        {{ \Carbon\Carbon::parse($tanggal)->translatedFormat('l, d F Y') }}
    </div>

    @foreach($items as $index => $izin)

    <div id="filledState">

        <div class="izin-card">

            <div class="izin-header">

                <div class="izin-left">
                    <div class="izin-icon">
                        @if (in_array($izin->status, [0,1]))
                        <iconify-icon icon="mdi:clock"></iconify-icon>
                        @elseif (in_array($izin->status, [3,4]))
                        <iconify-icon-red icon="mdi:clock"></iconify-icon-red>
                        @elseif (in_array($izin->status, [2,10]))
                        <iconify-icon icon="solar:check-circle-bold-duotone" style="color: #1DB366;"></iconify-icon>
                        @endif
                    </div>

                    <div class="izin-text">

                        <div class="izin-date">{{ $izin->created_at->format('d M Y, H:i') }} WIB</div>

                        <div class="izin-row">
                            <div class="izin-title">
                                @if ($izin->status == 0)
                                    Sedang Ditinjau Oleh Guru Kelas
                                @elseif ($izin->status == 1)
                                    Sedang Ditinjau Oleh Guru BK
                                @elseif ($izin->status == 2)
                                    Pengajuan Telah Disetujui
                                @elseif ($izin->status == 10)
                                    Pengajuan Telah Disetujui
                                @endif
                            </div>

                            <div class="izin-user">
                                <img src="{{ asset('images/guru cowo.png') }}">
                                <span>
                                    @if ($izin->status == 0)
                                        {{ $izin->approver_umum }}
                                    @elseif ($izin->status == 1)
                                        {{ $izin->approver_bk }}
                                    @elseif ($izin->status == 2)
                                        {{ $izin->approver_umum }}
                                    @elseif ($izin->status == 3)
                                        {{ $izin->approver_bk }}
                                    @elseif ($izin->status == 10)
                                        {{ $izin->approver_umum }}
                                    @endif
                                </span>
                            </div>
                            @if ($izin->status == 10)
                                <div class="izin-user">
                                    <img src="{{ asset('images/guru cowo.png') }}">
                                    <span>
                                        {{ $izin->approver_bk }}
                                    </span>
                                </div>
                            @endif
                        </div>

                    </div>

                </div>

                <div class="izin-actions">
                    <a href="javascript:void(0)" class="izin-detail" onclick="openPopup()">
                        Lihat Detail
                    </a>
                    <iconify-icon icon="mdi:dots-vertical"></iconify-icon>
                </div>

            </div>

        </div>

    </div>

    @endforeach

</div>

@endforeach

{{-- <div class="section-item">

    <div class="section-title" style="margin-top: 32px; font-size: 14px;">
        Jumat, 13 Maret 2026
    </div>

    <div id="filledState">

        <div class="izin-card">

            <div class="izin-header">

                <div class="izin-left">
                    <div class="izin-icon">
                        <iconify-icon icon="solar:check-circle-bold-duotone" style="color: #1DB366;"></iconify-icon>
                    </div>

                    <div class="izin-text">

                        <div class="izin-date">13 Maret 2026, 09:00 WIB</div>

                        <div class="izin-row">
                            <div class="izin-title">Pengajuan Telah Disetujui</div>

                            <div class="izin-user">
                                <img src="{{ asset('images/guru cowo.png') }}">
                                <span>Agus Setyawan, S.Pd.</span>
                            </div>

                            <div class="izin-user">
                                <img src="{{ asset('images/guru cewe.png') }}">
                                <span>Retno Yolanda, S.Pd.</span>
                            </div>
                        </div>

                    </div>

                </div>

                <div class="izin-actions">
                    <a href="javascript:void(0)" class="izin-detail" onclick="openPopup()">
                        Lihat Detail
                    </a>
                    <iconify-icon icon="mdi:dots-vertical"></iconify-icon>
                </div>

            </div>

        </div>

    </div>

</div> --}}

<div id="popup-detail" class="modal-overlay-izin" style="display:none;" onclick="closePopup()">

    <div class="modal-box-izin" onclick="event.stopPropagation()">

        <div class="form-card-izin">
            <div class="izin-left-2">
                <div class="izin-icon">
                    <iconify-icon icon="mdi:clock"></iconify-icon>
                </div>

                <div class="izin-header-row">

                    <div class="izin-text">
                        <div class="izin-date">16 Maret 2026, 09:00 WIB</div>

                        <div class="izin-row">
                            <div class="izin-title">Sedang Ditinjau Oleh Guru Kelas</div>
                        </div>
                    </div>

                    <div class="izin-menu">
                        <iconify-icon icon="mdi:dots-vertical"></iconify-icon>
                    </div>

                </div>

            </div>

            <hr class="line-izin">

            <div class="card-izin-2">
                <div class="card-header" style="padding:12px;">
                    <span class="card-number" style="color: #7ABAFF;">01.</span>
                    <span class="card-title">Data Siswa</span>
                </div>

                <div class="card-content">
                    <div class="row">
                        <label>NAMA</label>
                        <div class="value">Nicholas Daniel Raditya</div>
                    </div>

                    <div class="row">
                        <label>NO. URUT</label>
                        <div class="value small">27</div>
                    </div>

                    <div class="row">
                        <label>KELAS</label>
                        <div class="value small">XIII (13)</div>
                    </div>

                    <div class="row">
                        <label>JURUSAN</label>
                        <div class="value small">SIJA</div>
                    </div>
                </div>

                <div class="card-header" style="padding:12px;">
                    <span class="card-number" style="color: #7ABAFF;">02.</span>
                    <span class="card-title">Detail Izin<span>
                </div>

                <div class="card-content">
                    <div class="row">
                        <label>KEPERLUAN</label>
                        <div class="value">cap 3 jari ijazah SMP di SMPN 1 Semarang</div>
                    </div>

                    <div class="row">
                        <label>JAM IZIN</label>
                        <div class="jam-wrapper">
                            <div class="value small">11:00</div>
                            <span class="arrow">→</span>
                            <div class="value small">13:00</div>
                        </div>
                    </div>


                </div>

                <div class="card-header" style="padding:12px;">
                    <span class="card-number" style="color: #7ABAFF;">03.</span>
                    <span class="card-title">Informasi Guru</span>
                </div>

                <div class="card-content">
                    <div class="row">
                        <label>GURU BK</label>
                        <div class="value guru">
                            <img src="{{ asset('images/guru cewe.png') }}" class="foto-guru">
                            <span>Retno Yolanda, S.Pd.</span>
                        </div>
                    </div>

                    <div class="row">
                        <label>GURU UMUM</label>
                        <div class="value guru small">
                            <img src="{{ asset('images/guru cowo.png') }}" class="foto-guru">
                            <span>Agus Setyawan, S.Pd.</span>
                        </div>
                    </div>
                </div>

                <div class="btn-wrapper">
                    <button class="btn-batal-izin" onclick="openModal()">
                        Batalkan Pengajuan
                    </button>
                </div>

            </div>
        </div>

    </div>

</div>

@endif

<script>
    function openPopup() {
        document.getElementById("popup-detail").style.display = "flex";
    }

    function closePopup() {
        document.getElementById("popup-detail").style.display = "none";
    }
</script>

@endsection