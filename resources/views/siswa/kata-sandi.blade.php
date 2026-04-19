@extends('layouts.app')

@section('content')

<div class="page-header">

    <div class="breadcrumb">
        <iconify-icon icon="gg:profile"></iconify-icon>
        <span class="breadcrumb-inactive">Pengaturan Profil</span>
        <iconify-icon icon="iconamoon:arrow-right-2-light"></iconify-icon>
        <span class="breadcrumb-active">Ubah Kata Sandi</span>
    </div>

    <h1 class="page-title">Perbarui Kata Sandi</h1>

    <p class="page-desc">
        Ubah kata sandi untuk memperbarui keamanan akun.
    </p>

</div>

<div class="card-profil">

    <div class="profil-sandi">
        <div class="card-group">
            <div class="title-profil">KATA SANDI SAAT INI</div>
            <div class="card-desc">
                Kata sandi yang sedang digunakan.
            </div>
        </div>
        <div class="card-avatar">
            <div class="text-avatar password-group">
                <input type="password" id="currentPassword" placeholder="Masukkan kata sandi" class="input-password">
                <iconify-icon icon="mdi:eye-off-outline" class="toggle-password" onclick="togglePassword('currentPassword', this)"></iconify-icon>
            </div>

        </div>
    </div>

    <div class="profil-sandi">
        <div class="card-group">
            <div class="title-profil">KATA SANDI BARU</div>
            <div class="card-desc">
                Gunakan kombinasi huruf, angka, dan simbol.
            </div>
        </div>
        <div class="card-avatar">
           <div class="text-avatar password-group">
    <input type="password" id="newPassword" placeholder="Masukkan kata sandi baru" class="input-password">
    <iconify-icon icon="mdi:eye-off-outline" class="toggle-password" onclick="togglePassword('newPassword', this)"></iconify-icon>
</div>

        </div>
    </div>

    <div class="profil-sandi">
        <div class="card-group">
            <div class="title-profil">KONFIRMASI KATA SANDI BARU</div>
            <div class="card-desc">
                Ulangi kata sandi baru.
            </div>
        </div>
        <div class="card-avatar">
           <div class="text-avatar password-group">
    <input type="password" id="confirmPassword" placeholder="Konfirmasi kata sandi baru" class="input-password">
    <iconify-icon icon="mdi:eye-off-outline" class="toggle-password" onclick="togglePassword('confirmPassword', this)"></iconify-icon>
</div>
        </div>
    </div>

    <div class="profil-action">
        <button class="btn-primary">
            Ubah Kata Sandi
        </button>
    </div>
</div>

<script>
function togglePassword(id, icon) {
    const input = document.getElementById(id);

    if (input.type === "password") {
        input.type = "text";
        icon.setAttribute("icon", "mdi: ");
    } else {
        input.type = "password";
        icon.setAttribute("icon", "mdi:eye-off-outline");
    }
}
</script>

@endsection