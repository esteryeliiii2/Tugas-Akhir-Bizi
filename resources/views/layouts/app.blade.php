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

                    @if(in_array($user->jabatan, ['guru bk', 'guru umum']))
                        <a href="/daftar-pengajuan" class="{{ request()->is('daftar-pengajuan*') ? 'active' : '' }}">
                            <iconify-icon icon="ph:notification" width="18"></iconify-icon>
                            Daftar Pengajuan
                        </a>

                        <a href="/riwayat-izin-guru" class="{{ request()->is('riwayat-izin-guru') ? 'active' : '' }}">
                            <iconify-icon icon="solar:history-linear" width="18"></iconify-icon>
                            Riwayat Izin
                        </a>
                    @else
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

                        <a href="/tutorial-izin" class="{{ request()->is('tutorial-izin') ? 'active' : '' }}">
                            <iconify-icon icon="lucide:info" width="18"></iconify-icon>
                            Tutorial Perizinan
                        </a>

                    </div>
                
                @endif

                </div>
            </div>

            <div class="sidebar-bottom">

                <a href="{{ route('profile-siswa') }}" class="user-card-link">
                    <div class="user-card">
                        <div class="avatar">{{ $initials ? $initials : 'NR' }}</div>
                        <div class="user-info">

                            <div class="user-name">
                                {{ $user->nama ? $user->nama : 'Nicholas Daniel Raditya' }}
                            </div>

                            <div class="user-meta">
                                <span class="badge">{{ $user->jabatan ? strtoupper($user->jabatan) : 'SISWA' }}</span>
                                <span class="nis">
                                    @if($user->nis)
                                        {{ $user->nis }}
                                    @elseif($user->nip)
                                        {{ $user->nip }}
                                    @else
                                        224111999
                                    @endif
                                </span>
                            </div>

                        </div>
                    </div>
                </a>

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