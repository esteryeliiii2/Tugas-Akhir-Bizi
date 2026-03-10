<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <script src="https://code.iconify.design/iconify-icon/1.0.7/iconify-icon.min.js"></script>
    <title>Dashboard - Bizi</title>

    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Inter Display', sans-serif;
        }

        body {
            background: #FCFCFC;
        }

        .container {
            display: flex;
            height: 100vh;
            padding: 24px;
        }

        .sidebar {
            width: 320px;
            background: #F4F4F4;
            border: 1px solid #EDEDED;
            border-radius: 16px;
            padding: 20px;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
        }

        .logo {
            display: flex;
            align-items: center;
            gap: 10px;
            font-weight: 600;
            font-size: 24px;
            margin-bottom: 14px;
        }

        .logo img {
            width: 40px;
            height: 40px;
            object-fit: contain;
            display: block;
        }

        .logo span {
            line-height: 1;
            margin-bottom: 4px;
            font-family: 'Poppins', sans-serif;
            font-size: 24px;
        }

        .line {
            border: none;
            border-bottom: 1px solid #E1E1E1;
            margin-bottom: 8px;
        }

        .menu-title {
            font-size: 14px;
            color: #8D8D8D;
            font-weight: 500;
            margin: 8px 0 4px 4px;
            letter-spacing: 0.5px;
        }

        .menu {
            display: flex;
            flex-direction: column;
            gap: 8px;
            margin-top: 16px;
        }

        .menu a {
            text-decoration: none;
            color: #4F4F4F;
            padding: 10px 12px;
            display: flex;
            align-items: center;
            gap: 8px;
            font-size: 14px;
        }

        .menu a.active {
            background: #FCFCFC;
            color: #121212;
            border-radius: 8px;
            border: 1px solid #EDEDED;
            font-weight: 500;
        }

        .submenu {
            margin-top: 12px;
        }

        .user-card {
            background: #FCFCFC;
            padding: 16px;
            border-radius: 16px;
            display: flex;
            align-items: center;
            gap: 14px;
            border: 1px solid #EDEDED;
        }

        .avatar {
            width: 48px;
            height: 48px;
            background: #C7E6F5;
            color: #0A7AC9;
            font-weight: 600;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .user-info {
            display: flex;
            flex-direction: column;
            gap: 6px;
        }

        .user-name {
            font-weight: 600;
            font-size: 14px;
        }

        .user-meta {
            display: flex;
            align-items: center;
            gap: 6px;
        }

        .badge {
            background: #EAF4FF;
            border: 1px solid #D8EBFF;
            color: #0176F4;
            font-size: 10px;
            padding: 3px 8px;
            border-radius: 20px;
        }

        .nis {
            font-size: 13px;
            color: #888;
        }

        .logout-btn {
            margin-top: 0px;
            background: none;
            border: none;
            display: flex;
            align-items: center;
            gap: 8px;
            color: #CE0000;
            font-size: 14px;
            cursor: pointer;
        }

        .logout-btn iconify-icon {
            color: #CE0000;
        }

        .sidebar-bottom {
            display: flex;
            flex-direction: column;
            gap: 12px;
        }

        .content {
            flex: 1;
            padding-left: 32px;
        }

        .topbar {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
        }

        .greeting {
            font-size: 16px;
            color: #8D8D8D;
            margin-bottom: 6px;
        }

        .title {
            font-size: 24px;
            font-weight: 600;
        }

        .notif-btn {
            display: flex;
            align-items: center;
            gap: 6px;
            background: #FCFCFC;
            border: 1px solid #EBEBEB;
            padding: 8px 12px;
            border-radius: 10px;
            cursor: pointer;
            font-size: 14px;
        }

        .banner {
            height: 240px;
            border-radius: 16px;
            background: linear-gradient(90deg, #0176F4, #01C3F4);
            margin: 32px 0;
        }

        .cards {
            display: flex;
            gap: 16px;
        }

        .card {
            flex: 1;
            height: 180px;
            border-radius: 16px;
            border: 1px solid #ECECEC;
            background: #FCFCFC;
        }
    </style>
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

                <hr class="line">

                <div class="menu">

                    <div class="menu-title">AKTIVITAS</div>

                    <a href="#" class="active">
                        <iconify-icon icon="boxicons:grid-filled" width="18"></iconify-icon>
                        Beranda Pengajuan
                    </a>

                    <a href="#">
                        <iconify-icon icon="ph:notification" width="18"></iconify-icon>
                        Status Perizinan
                    </a>

                    <a href="#">
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

            <div class="banner"></div>

            <div class="cards">
                <div class="card"></div>
                <div class="card"></div>
                <div class="card"></div>
            </div>

        </div>

    </div>

</body>

</html>