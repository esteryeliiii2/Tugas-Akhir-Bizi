<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Login - Bizi</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://code.iconify.design/iconify-icon/1.0.7/iconify-icon.min.js"></script>

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
        }

       .left {
            flex: 1;
            background: linear-gradient(180deg, #0176F4 0%, #01C3F4 140%);
            border-radius: 16px;
            margin: 24px;

            display: flex;
            justify-content: center;
            align-items: center;
        }

        .left-content{
            width: 100%;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .left-content img {
            width: 75%;
        }

        .right {
            flex: 1;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .login-box {
            width: 420px;
        }

       .logo {
            text-align: center;
            margin-bottom: 10px;
        }

        .logo img {
            width: 60px;   
            height: auto;
        }

        h1 {
            text-align: center;
            margin-bottom: 32px;
            font-size: 32px;
            font-weight: 600;
        }

        .subtitle {
            text-align: center;
            color: #7c7c7c;
            margin-bottom: 20px;
        }

        .role-container {
            display: flex;
            gap: 10px;
            /* margin-bottom: 20px; */
        }

        .line-image {
            text-align: center;
            margin-bottom: 32px;
        }

        .line-image img {
            width: 100%;
            max-width: 300px;
        }

        .role-btn {
            flex: 1;
            padding: 10px;
            border-radius: 8px;
            border: 1px solid #ddd;
            color: #7C7C7C;
            font-size: 14px;
            background: #FCFCFC;
            cursor: pointer;
            transition: 0.3s;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 6px;
        }

        .role-btn.active {
            background: #dce8f9;
            border: 1px solid #0176F4;
            color: #0176F4;
        }

        label {
            font-size: 14px;
            font-weight: 600;
            margin-bottom: 8px;
            display: block;
        }

        .input-group {
            margin-bottom: 24px;
        }

        .input-all {
            margin-bottom: 40px;
        }
         
        input {
            width: 100%;
            padding: 12px;
            border-radius: 12px;
            font-size: 16px;
            color: #9C9C9C;
            border: 1px solid #E8E8E8;
            background: #F4F4F4;
        }

        input:focus {
            border: 1px solid #9c9c9c; 
            outline: none; 
        }

        .forgot {
            text-align: right;
            font-size: 13px;
            color: #0176F4;
            margin-bottom: 20px;
        }

        .forgot a {
            text-decoration: none;   
            color: #0176F4;
        }

        .btn-group {
            display: flex;
            gap: 12px;
        }

        .btn-login {
            flex: 1;
            padding: 12px;
            border-radius: 16px;
            border: none;
            background: #121212;
            color: #FCFCFC;
            font-weight: 500;
            font-size: 14px;
            cursor: pointer;
        }

        .btn-register {
            flex: 1;
            padding: 12px;
            border-radius: 16px;
            border: 1px solid #E8E8E8;
            color: #121212;
            font-size: 14px;
            background: #FCFCFC;
            cursor: pointer;
            text-align: center;
            text-decoration: none;
            display: block;
        }

        @media (max-width: 900px) {
            .left {
                display: none;
            }

            .right {
                flex: 1;
            }
        }

    </style>
</head>
<body>

<div class="container">

    <div class="left">
        <div class="left-content">
            <img src="{{ asset('images/tampilan.png') }}" alt="Tampilan">
        </div>
    </div>

    <div class="right">
        <div class="login-box">

            <div class="logo">
                <img src="{{ asset('images/LogoBizi.png') }}" alt="Logo Bizi">
            </div>

            <h1>Selamat datang di Bizi</h1>
            <div class="subtitle">Silakan masuk sebagai :</div>

            <div class="role-container">
                <button type="button" class="role-btn active">
                    <iconify-icon icon="ph:chalkboard-teacher" width="18"></iconify-icon>
                    Guru BK
                </button>
                <button type="button" class="role-btn">
                    <iconify-icon icon="ph:chalkboard-teacher" width="18"></iconify-icon>
                    Guru Umum
                </button>
                <button type="button" class="role-btn">
                    <iconify-icon icon="hugeicons:students" width="18"></iconify-icon>
                    Siswa
                </button>
            </div>

            <div class="line-image">
                <img src="{{ asset('images/line.png') }}" alt="Line">
            </div>

            <form method="POST" action="#">
                @csrf

                <div class="input-all">
                    <div class="input-group">
                        <label>NIS</label>
                        <input type="text" name="nis" placeholder="Masukkan NIS" autocomplete="off">
                    </div>

                    <div class="input-group" style="margin-bottom: 16px;">
                        <label>KATA SANDI</label>
                        <input type="password" name="password" placeholder="Masukkan kata sandi" autocomplete="new-password">
                    </div>

                    <div class="forgot">
                        <a href="#">Lupa kata sandi?</a>
                    </div>
                </div>

                <div class="btn-group">
                    <button type="submit" class="btn-login">Masuk</button>
                    <a href="{{ route('register') }}" class="btn-register">
                        Belum Punya Akun
                    </a>
                </div>

            </form>

        </div>
    </div>

</div>

<script>
    const buttons = document.querySelectorAll('.role-btn');

    buttons.forEach(btn => {
        btn.addEventListener('click', () => {
            buttons.forEach(b => b.classList.remove('active'));
            btn.classList.add('active');
        });
    });
</script>

</body>
</html>