<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <script src="https://code.iconify.design/iconify-icon/1.0.7/iconify-icon.min.js"></script>
    <title>Dashboard - Bizi</title>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>

<body>

    <div class="container">

        <!-- sidebar -->
        <div class="sidebar">

            <div>
                <div class="logo">
                    <img src="{{ asset('images/LogoDashboard.png') }}">
                    <span>BIZI</span>
                </div>

                <hr class="line-sidebar">

                <div class="menu">

                    <div class="menu-title">AKTIVITAS</div>

                    <a href="/dashboard" class="{{ request()->is('dashboard') ? 'active' : '' }}">
                        <iconify-icon icon="boxicons:grid-filled" width="18"></iconify-icon>
                        Beranda Pengajuan
                    </a>

                    <a href="/status-izin" class="{{ request()->is('status-izin*') ? 'active' : '' }}">
                        <iconify-icon icon="ph:notification" width="18"></iconify-icon>
                        Status Perizinan
                    </a>

                    <a href="/riwayat-izin-siswa" class="{{ request()->is('riwayat-izin-siswa') ? 'active' : '' }}">
                        <iconify-icon icon="solar:history-linear" width="18"></iconify-icon>
                        Riwayat Izin
                    </a>

                    <div class="submenu">

                        <div class="menu-title">LAINNYA</div>

                        <a href="#">
                            <iconify-icon icon="lucide:info" width="18"></iconify-icon>
                            Tutorial Perizinan
                        </a>

                        <a href="#">
                            <iconify-icon icon="lsicon:setting-outline" width="18"></iconify-icon>
                            Pengaturan
                        </a>

                    </div>

                </div>
            </div>

            <div class="sidebar-bottom">

                <div class="user-card">

                    <div class="avatar">NR</div>

                    <div class="user-info">

                        <div class="user-name">
                            Nicholas Daniel Raditya
                        </div>

                        <div class="user-meta">
                            <span class="badge">SISWA</span>
                            <span class="nis">224119999</span>
                        </div>

                    </div>

                </div>

                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="logout-btn">
                        <iconify-icon icon="ion:log-out-outline" width="20"></iconify-icon>
                        Keluar Akun
                    </button>
                </form>

            </div>

        </div>

        <!-- content kanan -->
        <div class="content">
            @yield('content')
        </div>

    </div>

</body>

</html>