<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <link rel="icon" type="image/png" href="{{ asset('images/LogoBizi.png') }}">
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

        .left-content {
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

        input::placeholder {
            color: #9C9C9C;
        }

        .input-error {
            border: 1px solid #C30D0D !important;
            /* background: #fff5f5; */
        }

        .error-text {
            font-size: 12px;
            color: #C30D0D;
            margin-top: 6px;
        }

        input {
            width: 100%;
            padding: 12px;
            border-radius: 12px;
            font-size: 16px;
            color: #121212;
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
            border-radius: 12px;
            display: block;
            text-align: center;
            text-decoration: none;
            border: 1px solid #121212;
            background: #121212;
            color: #FCFCFC;
            font-weight: 400;
            font-size: 14px;
            cursor: pointer;
        }

        .btn-register {
            flex: 1;
            padding: 12px;
            border-radius: 12px;
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
                    <button type="button" class="role-btn" data-role="guru_bk">
                        <iconify-icon icon="ph:chalkboard-teacher" width="18"></iconify-icon>
                        Guru BK
                    </button>
                    <button type="button" class="role-btn" data-role="guru_umum">
                        <iconify-icon icon="ph:chalkboard-teacher" width="18"></iconify-icon>
                        Guru Umum
                    </button>
                    <button type="button" class="role-btn active" data-role="siswa">
                        <iconify-icon icon="hugeicons:students" width="18"></iconify-icon>
                        Siswa
                    </button>
                </div>

                <div class="line-image">
                    <img src="{{ asset('images/line.png') }}" alt="Line">
                </div>

                <form method="POST" action="{{ route('login') }}">
                    @csrf

                    <div class="input-all">
                        <input type="hidden" name="login_type" id="login_type" value="{{ old('login_type', 'nis') }}">
                        <input type="hidden" name="role" id="role" value="{{ old('role', 'siswa') }}">
                        <div class="input-group">
                            <label id="label-login">NIS</label>
                            <input
                                type="text"
                                name="login"
                                id="login-input"
                                placeholder="Masukkan NIS"
                                autocomplete="off"
                                class="@error('login') input-error @enderror">

                            @error('login')
                            <div class="error-text">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="input-group" style="margin-bottom: 16px;">
                            <label>KATA SANDI</label>
                            <input
                                type="password"
                                name="password"
                                placeholder="Masukkan kata sandi"
                                autocomplete="new-password"
                                class="@error('password') input-error @enderror">

                            @error('password')
                            <div class="error-text">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="forgot">
                            <!-- <a href="#">Lupa kata sandi?</a> -->
                        </div>
                    </div>

                    <div class="btn-group">
                        <button type="submit" class="btn-login">Masuk</button>
                        <a href="{{ route('register') }}" class="btn-register" id="btn-register">
                            Belum Punya Akun
                        </a>
                    </div>

                </form>

            </div>
        </div>

    </div>

    <script>
        const buttons = document.querySelectorAll('.role-btn');
        const label = document.getElementById('label-login');
        const input = document.getElementById('login-input');
        const loginType = document.getElementById('login_type');
        const roleInput = document.getElementById('role');

        function setRole(role) {
            if (role === 'siswa') {
                label.innerText = 'NIS';
                input.placeholder = 'Masukkan NIS';
                loginType.value = 'nis';
                roleInput.value = 'siswa';
                document.getElementById('btn-register').style.display = 'block';
            } else {
                label.innerText = 'NIP';
                input.placeholder = 'Masukkan NIP';
                loginType.value = 'nip';

                if (role === 'guru_bk') {
                    roleInput.value = 'guru_bk';
                } else {
                    roleInput.value = 'guru_umum';
                }

                document.getElementById('btn-register').style.display = 'none';
            }
        }

        buttons.forEach(btn => {
            btn.addEventListener('click', () => {
                buttons.forEach(b => b.classList.remove('active'));
                btn.classList.add('active');

                const role = btn.getAttribute('data-role');
                setRole(role);

                input.value = '';

                document.querySelectorAll('.input-error').forEach(el => {
                    el.classList.remove('input-error');
                });

                document.querySelectorAll('.error-text').forEach(el => {
                    el.remove();
                });
            });
        });

        window.addEventListener('DOMContentLoaded', () => {
            const savedRole = roleInput.value; // dari old()

            buttons.forEach(btn => {
                if (btn.getAttribute('data-role') === savedRole) {
                    btn.classList.add('active');
                    setRole(savedRole);
                } else {
                    btn.classList.remove('active');
                }
            });
        });

        const inputs = document.querySelectorAll('input');

        inputs.forEach(input => {
            input.addEventListener('input', () => {
                input.classList.remove('input-error');

                const errorText = input.parentElement.querySelector('.error-text');
                if (errorText) {
                    errorText.remove();
                }
            });
        });
    </script>
</body>

</html>