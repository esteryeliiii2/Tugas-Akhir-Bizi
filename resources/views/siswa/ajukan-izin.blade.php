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
        <form action="{{ route('store_session-siswa') }}" method="POST">
            @csrf

            <div class="form-card">

                <div class="card-header-box">
                    <span class="card-number">01.</span>
                    <span class="card-title">Data Siswa</span>
                </div>
                <div class="form-group">
                    <label>NAMA</label>
                    <input type="text" name="nama" placeholder="Masukkan nama lengkap">
                </div>

                <div class="form-row">

                    <div class="form-group">
                        <label>NO. URUT</label>
                        <select name="no_presensi">
                            <option value="">Pilih no. urut</option>
                            @for ($i = 1; $i <= 36; $i++)
                                <option value="{{ $i }}">{{ $i }}</option>
                                @endfor
                        </select>
                    </div>

                    <div class="form-group">
                        <label>KELAS</label>
                        <select name="kelas" id="kelas">
                            <option value="">Pilih kelas</option>
                            <option value="10">X</option>
                            <option value="11">XI</option>
                            <option value="12">XII</option>
                            <option value="13">XIII</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label>JURUSAN</label>
                        <select name="jurusan" id="jurusan">
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
                        <input type="radio" name="kembali" value="ya" checked>
                        <span class="custom-radio"></span>
                        Kembali ke sekolah
                    </label>
                    <label class="toggle-item">
                        <input type="radio" name="kembali" value="tidak">
                        <span class="custom-radio"></span>
                        Tidak kembali
                    </label>
                </div>

                <div class="form-group">
                    <label>KEPERLUAN</label>
                    <textarea placeholder="Sebutkan keperluan izin..." name="keperluan"></textarea>
                </div>

                <div class="form-row">

                    <div class="form-group">
                        <label>JAM MULAI IZIN</label>
                        <div class="time-input">
                            <input type="time" name="jam_mulai">
                            <iconify-icon icon="solar:clock-circle-linear" class="time-icon"></iconify-icon>
                        </div>
                    </div>

                    <div class="form-group" id="container-jam-kembali">
                        <label>JAM SELESAI IZIN</label>
                        <div class="time-input">
                            <input type="time" name="jam_selesai">
                            <iconify-icon icon="solar:clock-circle-linear" class="time-icon"></iconify-icon>
                        </div>
                    </div>
                </div>

            </div>

            <div class="form-actions">
                <button class="btn-cancel" type="button">
                    Batalkan
                </button>

                {{-- <form action="{{ route('guru-approve') }}" method="GET"> --}}
                <button type="submit" class="btn-submit">
                    Lanjutkan Pengajuan
                    <iconify-icon icon="iconamoon:arrow-right-2-light"></iconify-icon>
                </button>
                {{-- </form> --}}
            </div>
        </form>

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

<script>
    const jurusanMap = {
        10: ['TKL', 'TE', 'TO', 'TKP', 'KPBS', 'TPFL', 'PPLG'],
        11: ['TITL', 'TEK', 'TME', 'TKR', 'KGS', 'KJIJ', 'TFLM', 'SIJA'],
        12: ['TITL', 'TEK', 'TME', 'TKR', 'KGS', 'KJIJ', 'TFLM', 'SIJA'],
        13: ['TITL', 'TEK', 'TME', 'TKR', 'KGS', 'KJIJ', 'TFLM', 'SIJA']
    };

    const kelasSelect = document.getElementById('kelas');
    const jurusanSelect = document.getElementById('jurusan');

    kelasSelect.addEventListener('change', function() {
        const selectedKelas = this.value;

        // reset jurusan
        jurusanSelect.innerHTML = '<option value="">Pilih jurusan</option>';

        if (jurusanMap[selectedKelas]) {
            jurusanMap[selectedKelas].forEach(jurusan => {
                const option = document.createElement('option');
                option.value = jurusan;
                option.textContent = jurusan;
                jurusanSelect.appendChild(option);
            });
        }
    });

    document.addEventListener('DOMContentLoaded', function () {
        // 1. Cari radio button-nya
        const radioKembali = document.querySelectorAll('input[name="kembali"]');
        // 2. Cari kontainer jam selesai yang tadi kita kasih ID
        const containerJamSelesai = document.getElementById('container-jam-kembali');

        // 3. Fungsi untuk cek kondisi
        function toggleJamInput() {
            // Cari mana yang sedang dipilih (checked)
            const selectedValue = document.querySelector('input[name="kembali"]:checked').value;
            
            if (selectedValue === 'tidak') {
                containerJamSelesai.style.display = 'none'; // Sembunyikan
            } else {
                containerJamSelesai.style.display = 'block'; // Munculkan
            }
        }

        // 4. Jalankan fungsi setiap kali ada perubahan klik
        radioKembali.forEach(radio => {
            radio.addEventListener('change', toggleJamInput);
        });

        // 5. Jalankan saat halaman pertama kali dibuka (biar sinkron)
        toggleJamInput();
    });
</script>
@endsection