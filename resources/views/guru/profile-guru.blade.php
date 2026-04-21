@extends('layouts.app')

@section('content')

<div class="page-header">

    <h1 class="page-title">Pengaturan Profil</h1>

    <p class="page-desc">
        Kelola informasi akun dan pengaturan pribadi
    </p>

</div>

<div class="card-profil">
    <div class="profil">
        <div class="card-group">
            <div class="title-profil">FOTO PROFIL</div>
            <div class="card-desc">
                Foto profil akun guru
            </div>
        </div>
        <div class="card-avatar">
            <div class="avatar-profile" id="previewAvatar">RY</div>
            <div class="text-avatar">
                <input type="file" id="uploadFoto" accept="image/*" hidden>
                <button type="button" class="ubah-profile"
                    onclick="document.getElementById('uploadFoto').click()">
                    Ubah Foto Profil
                    <iconify-icon icon="flowbite:edit-outline" class="edit-icon"></iconify-icon>
                </button>
                <button type="button" class="hapus-profile" id="btnHapusFoto" style="display: none;"
                    onclick="hapusFoto()">
                    Hapus Foto
                    <iconify-icon icon="mi:delete" class="delete-icon"></iconify-icon>
                </button>
                <div class="card-desc">
                    Format JPG/PNG. Gunakan foto yang jelas dan sopan.
                </div>
            </div>

        </div>
    </div>

    <div class="profil">
        <div class="card-group">
            <div class="title-profil">NAMA</div>
            <div class="card-desc">
                Nama lengkap guru
            </div>
        </div>
        <div class="card-avatar">
            <div class="text-avatar">
                <div class="value-profil">Retno Yolanda, S.Pd.</div>
            </div>

        </div>
    </div>

    <div class="profil">
        <div class="card-group">
            <div class="title-profil">NIP</div>
            <div class="card-desc">
                Nomor induk pegawai
            </div>
        </div>
        <div class="card-avatar">
            <div class="text-avatar">
                <div class="value-profil-none">1992XXXXXXXXXXXXXX</div>
            </div>

        </div>
    </div>

    <div class="profil">
        <div class="card-group">
            <div class="title-profil">NO TELEPON</div>
            <div class="card-desc">
                Nomor telepon aktif
            </div>
        </div>
        <div class="card-avatar">
            <div class="text-avatar">
                <div class="value-profil">082137626366</div>
            </div>

        </div>
    </div>

    <div class="profil-action">
        <button class="btn-secondary" onclick="window.location.href='kata-sandi'">
            Ubah Kata Sandi
            <iconify-icon icon="mdi:lock-outline"></iconify-icon>
        </button>

        <button class="btn-primary">
            Simpan Perubahan
        </button>
    </div>
</div>

<script>
const uploadFoto = document.getElementById('uploadFoto');
const previewAvatar = document.getElementById('previewAvatar');
const btnHapus = document.getElementById('btnHapusFoto');

uploadFoto.addEventListener('change', function(event) {
    const file = event.target.files[0];

    if (file) {
        const reader = new FileReader();

        reader.onload = function(e) {
            previewAvatar.style.backgroundImage = `url(${e.target.result})`;
            previewAvatar.style.backgroundSize = 'cover';
            previewAvatar.style.backgroundPosition = 'center';
            previewAvatar.innerHTML = '';

            btnHapus.style.display = 'inline-block';
        }

        reader.readAsDataURL(file);
    }
});

function hapusFoto() {
    previewAvatar.style.backgroundImage = '';
    previewAvatar.innerHTML = 'NR';

    uploadFoto.value = ''; 
    btnHapus.style.display = 'none'; 
}
</script>


@endsection