@extends('layouts.app')

@section('content')

<div class="topbar">

    <div>
        <div class="greeting">Halo, Nicholas 👋</div>
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

    <a href="{{ route('ajukan-izin') }}" class="card">
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

    <div class="card">
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

    </div>

    <div class="card">
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

    </div>

</div>

<h3 class="section-title">Aktivitas Perizinanmu</h3>

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

    <a href="{{ route('ajukan-izin') }}" class="empty-btn">
        Ajukan Izin
    </a>

</div>


<div id="filledState" style="display: none;">

    <div class="izin-card">

        <div class="izin-header">

            <div class="izin-left">
                <div class="izin-icon">
                    <iconify-icon icon="mdi:clock"></iconify-icon>
                </div>

                <div class="izin-text">

                    <div class="izin-date">16 Maret 2026, 09:00 WIB</div>

                    <div class="izin-row">
                        <div class="izin-title">Sedang Ditinjau Oleh Guru Kelas</div>

                        <div class="izin-user">
                            <img src="{{ asset('images/guru cowo.png') }}">
                            <span>Agus Setyawan, S.Pd.</span>
                        </div>
                    </div>

                </div>

            </div>

            <div class="izin-actions">
                <a href="/status-izin/1" class="izin-detail">
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
            <div class="step active">
                <div class="dot">2</div>
                <p>Persetujuan Guru<br>Kelas (Umum)</p>
            </div>
        </div>

        <div class="line"></div>

        <div class="step-item">
            <div class="step">
                <div class="dot">3</div>
                <p>Persetujuan Guru<br>BK</p>
            </div>
        </div>

        <div class="line"></div>

        <div class="step-item">
            <div class="step">
                <div class="dot">4</div>
                <p>Verifikasi QR<br>Code ke Satpam</p>
            </div>
        </div>

    </div>

</div>

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