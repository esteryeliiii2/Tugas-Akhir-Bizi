@extends('layouts.app')

@section('content')

<div class="page-header">

    <h1 class="page-title">Pengaturan Profil</h1>

    <p class="page-desc">
        Kelola informasi akun dan pengaturan pribadi
    </p>

</div>

<form action="{{ route('profile-guru') }}" method="POST" enctype="multipart/form-data">
    @csrf
    <div class="card-profil">
        <div class="profil">
            <div class="card-group">
                <div class="title-profil">FOTO PROFIL</div>
                <div class="card-desc">
                    Foto profil akun guru
                </div>
            </div>
            <div class="card-avatar">
                <div class="avatar-profile" id="previewAvatar"
                    style="
                    @if($user->foto)
                        background-image: url('{{ asset('storage/' . $user->foto) }}');
                        background-size: cover;
                        background-position: center;
                    @endif
                    ">
                    
                    @if(!$user->foto)
                        {{ $initials }}
                    @endif

                </div>
                <div class="text-avatar">
                    <input type="file" name="foto" id="uploadFoto" accept=".jpg,.jpeg,.png" hidden>
                    <input type="text" name="hapusFoto" id="inputHapusFoto" value="{{ $user->foto ? 1 : 0 }}" hidden>
                    <button type="button" class="ubah-profile"
                        onclick="document.getElementById('uploadFoto').click()">
                        Ubah Foto Profil
                        <iconify-icon icon="flowbite:edit-outline" class="edit-icon"></iconify-icon>
                    </button>
                    <button type="button" class="hapus-profile" id="btnHapusFoto" style="{{ $user->foto ? 'display: inline-block' : 'display: none' }}"
                        onclick="handleHapusFoto()">
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
                <div class="text-avatar" style="display:flex">
                    <input name="nama" class="value-profil" value="{{ $user->nama }}">
                    <input name="gelar" class="value-profil" style="width:30%" value="{{ $user->gelar ? $user->gelar : '' }}">
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
                    <div class="value-profil-none">{{ $user->nip }}</div>
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
                    <input name="no_hp" class="value-profil" value="{{ $user->no_telp ? $user->no_telp : '-' }}">
                </div>

            </div>
        </div>

        <div class="profil-action">
            <a class="btn-secondary" href="{{ route('kata_sandi-guru') }}" style="color:black;text-decoration:none">
                Ubah Kata Sandi
                <iconify-icon icon="mdi:lock-outline"></iconify-icon>
            </a>

            <button type="submit" class="btn-primary">
                Simpan Perubahan
            </button>
        </div>
    </div>
</form>

<script>
const uploadFoto = document.getElementById('uploadFoto');
const isHapusFoto = document.getElementById('inputHapusFoto');
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
        isHapusFoto.value = 1;
    }
});

function handleHapusFoto() {
    previewAvatar.style.backgroundImage = '';
    previewAvatar.innerHTML = '{{ $initials }}';

    uploadFoto.value = ''; 
    isHapusFoto.value = 0; 
    btnHapus.style.display = 'none'; 
}
</script>


@endsection