@extends('layouts.app')

@section('content')

<div class="topbar">

    <div>
        <div class="greeting">Halo, {{ $user->nama ? $user->nama : 'Nicholas' }} 👋</div>
        <div class="title">Mau mengajukan izin hari ini?</div>
    </div>

    <button class="notif-btn">
        Notifikasi
        <iconify-icon icon="basil:notification-on-outline" width="20"></iconify-icon>
    </button>

</div>

<div class="banner">
    <div class="banner-title">
        Lihat Cara Mengajukan Izin
    </div>

    <div class="banner-desc">
        Pelajari cara mengajukan izin di BIZI dengan langkah yang cepat dan mudah.
    </div>

    <button class="banner-btn">
        Lihat Tutorial
        <iconify-icon icon="ion:play" width="16"></iconify-icon>
    </button>
</div>

<h3 class="section-title">Mulai Aktivitasmu</h3>

<div class="cards">

    <a href="{{ route('ajukan_izin-siswa') }}" class="card">
        <div class="card-top">
            <div class="card-icon">
                <iconify-icon icon="hugeicons:file-upload" width="20"></iconify-icon>
            </div>

            <iconify-icon icon="heroicons:arrow-up-right-20-solid" width="24"></iconify-icon>
        </div>

        <div class="card-group">
            <div class="card-title">Ajukan Surat Izin</div>
            <div class="card-desc">
                Buat pengajuan izin baru secara cepat melalui formulir digital.
            </div>
        </div>
    </a>

    <a href="{{ route('status_izin-siswa') }}" class="card">
        <div class="card-top">
            <div class="card-icon">
                <iconify-icon icon="ph:notification" width="20"></iconify-icon>
            </div>

            <iconify-icon icon="heroicons:arrow-up-right-20-solid" width="24"></iconify-icon>
        </div>

        <div class="card-groups">
            <div class="card-title">Cek Status Pengajuan</div>
            <div class="card-desc">
                Lihat apakah pengajuan izin sedang diproses, disetujui, atau ditolak.
            </div>
        </div>

    </a>

    <a href="{{ route('riwayat-izin-siswa') }}" class="card">
        <div class="card-top">
            <div class="card-icon">
                <iconify-icon icon="solar:history-linear" width="20"></iconify-icon>
            </div>

            <iconify-icon icon="heroicons:arrow-up-right-20-solid" width="24"></iconify-icon>
        </div>

        <div class="card-groups">
            <div class="card-title">Lihat Riwayat Izin</div>
            <div class="card-desc">
                Periksa daftar izin yang pernah diajukan beserta statusnya.
            </div>
        </div>

    </a>

</div>

<h3 class="section-title">Aktivitas Perizinanmu</h3>

@if (!$izin)
<div id="emptyState" class="empty-state">

    <div class="empty-icon">
        <img src="{{ asset('images/izin.png') }}" alt="izin">
    </div>

    <div class="empty-title">
        Belum Ada Pengajuan Izin
    </div>

    <div class="empty-desc">
        Ajukan izin melalui formulir untuk memulai proses perizinan.
    </div>

    <a href="{{ route('ajukan_izin-siswa') }}" class="empty-btn">
        Ajukan Izin
    </a>

</div>
@else

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

                    <div class="izin-date">
                        {{ $izin->created_at->format('d M Y, H:i') }} WIB
                    </div>

                    <div class="izin-row">
                        <div class="izin-title">
                            @if ($izin->status == 0)
                                Sedang Ditinjau Oleh Guru Kelas
                            @elseif ($izin->status == 1)
                                Sedang Ditinjau Oleh Guru BK
                            @elseif ($izin->status == 2)
                                Pengajuan Telah Disetujui
                            @elseif ($izin->status == 3)
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
                                    Satpam
                                @endif
                            </span>
                        </div>
                    </div>

                </div>

            </div>

            <div class="izin-actions">
                <a href="/status-izin" class="izin-detail" style="text-decoration:none;color:black">
                    Lihat Detail
                </a>
                <iconify-icon icon="mdi:dots-vertical"></iconify-icon>
            </div>

        </div>

    </div>

    <!-- step -->
    <div class="izin-step">

        <div class="step-item">
            <div class="step done">
                <div class="dot">✓</div>
                <p>Isi Formulir<br>Perizinan</p>
            </div>
        </div>

        <div class="line active"></div>

        <div class="step-item">
            <div class="step {{ in_array($izin->status, [1,2,10]) ? 'done' : 'active' }}">
                <div class="dot">{{ in_array($izin->status, [1,2,10]) ? '✓' : '2' }}</div>
                <p>Persetujuan Guru<br>Kelas (Umum)</p>
            </div>
        </div>

        <div class="line {{ in_array($izin->status, [1,2,10]) ? 'active' : '' }}"></div>

        <div class="step-item">
            <div class="step {{ in_array($izin->status, [2,10]) ? 'done' : '' }}{{ $izin->status == 1 ? 'active' : '' }}">
                <div class="dot">{{ in_array($izin->status, [2,10]) ? '✓' : '3' }}</div>
                <p>Persetujuan Guru<br>BK</p>
            </div>
        </div>

        <div class="line {{ in_array($izin->status, [2,10]) ? 'active' : '' }}"></div>

        <div class="step-item">
            <div class="step {{ $izin->status == 10 ? 'done' : '' }}{{ $izin->status == 2 ? 'active' : '' }}">
                <div class="dot">{{ $izin->status == 10 ? '✓' : '4' }}</div>
                <p>Verifikasi QR<br>Code ke Satpam</p>
            </div>
        </div>

    </div>

</div>
@endif

<script>
    window.onload = function() {
        const status = sessionStorage.getItem("izin");

        if (status === "sudah") {
            document.getElementById("emptyState").style.display = "none";
            document.getElementById("filledState").style.display = "block";
        }
    };
</script>
@endsection