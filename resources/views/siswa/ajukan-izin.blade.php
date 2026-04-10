@extends('layouts.app')

@section('content')

<div class="page-header">

    <div class="breadcrumb">
        <iconify-icon icon="boxicons:grid-filled"></iconify-icon>
        <span class="breadcrumb-inactive">Beranda Pengajuan</span>
        <iconify-icon icon="iconamoon:arrow-right-2-light"></iconify-icon>
        <span class="breadcrumb-active">Pengajuan Surat Izin</span>
    </div>

    <h1 class="page-title">Pengajuan Surat Izin</h1>

    <p class="page-desc">
        Isi formulir dan pastikan data yang dimasukkan sudah benar agar proses lebih cepat.
    </p>

</div>

<div class="izin-layout">

    <div class="izin-form">

        <!-- DATA SISWA -->
        <div class="form-card">

            <div class="card-header-box">
                <span class="card-number">01.</span>
                <span class="card-title">Data Siswa</span>
            </div>
            <div class="form-group">
                <label>NAMA</label>
                <input type="text" placeholder="Masukkan nama lengkap">
            </div>

            <div class="form-row">

                <div class="form-group">
                    <label>NO. URUT</label>
                    <select>
                        <option>Pilih no. urut</option>
                    </select>
                </div>

                <div class="form-group">
                    <label>KELAS</label>
                    <select>
                        <option>Pilih kelas</option>
                    </select>
                </div>

                <div class="form-group">
                    <label>JURUSAN</label>
                    <select>
                        <option>Pilih jurusan</option>
                    </select>
                </div>

            </div>

        </div>

        <!-- DETAIL IZIN -->
        <div class="form-card">

            <div class="card-header-box">
                <span class="card-number">02.</span>
                <span class="card-title">Detail Izin</span>
            </div>

            <div class="toggle-group">
                <label class="toggle-item">
                    <input type="radio" name="kembali" checked>
                    <span class="custom-radio"></span>
                    Kembali ke sekolah
                </label>
                <label class="toggle-item">
                    <input type="radio" name="kembali">
                    <span class="custom-radio"></span>
                    Tidak kembali
                </label>
            </div>

            <div class="form-group">
                <label>KEPERLUAN</label>
                <textarea placeholder="Sebutkan keperluan izin..."></textarea>
            </div>

            <div class="form-row">

                <div class="form-group">
                    <label>JAM MULAI IZIN</label>
                    <div class="time-input">
                        <input type="time">
                        <iconify-icon icon="solar:clock-circle-linear" class="time-icon"></iconify-icon>
                    </div>
                </div>

                <div class="form-group">
                    <label>JAM SELESAI IZIN</label>
                    <div class="time-input">
                        <input type="time">
                        <iconify-icon icon="solar:clock-circle-linear" class="time-icon"></iconify-icon>
                    </div>
                </div>

            </div>

        </div>

        <div class="form-actions">
            <button class="btn-cancel">
                Batalkan
            </button>

            <form action="{{ route('guru-approve') }}" method="GET">
                <button type="submit" class="btn-submit">
                    Lanjutkan Pengajuan
                    <iconify-icon icon="iconamoon:arrow-right-2-light"></iconify-icon>
                </button>
            </form>
        </div>

    </div>

    <!-- STEP KANAN -->
    <div class="izin-steps">

        <div class="step active">
            <div class="step-number">1</div>
            <div>
                <div class="step-title">Isi Formulir Perizinan</div>
                <p>Lengkapi formulir pengajuan izin dengan data dan alasan yang jelas.</p>
            </div>
        </div>

        <div class="step">
            <div class="step-number">2</div>
            <div>
                <div class="step-title">Persetujuan Guru Kelas (Umum)</div>
                <p>Pengajuan izin akan ditinjau terlebih dahulu oleh guru kelas.</p>
            </div>
        </div>

        <div class="step">
            <div class="step-number">3</div>
            <div>
                <div class="step-title">Persetujuan Guru BK</div>
                <p>Pengajuan izin akan ditinjau dan diverifikasi oleh guru BK.</p>
            </div>
        </div>

        <div class="step">
            <div class="step-number">4</div>
            <div>
                <div class="step-title">Verifikasi QR Code</div>
                <p>Verifikasi ke satpam dengan QR code yang berisi surat izin yang valid.</p>
            </div>
        </div>

    </div>

</div>

@endsection