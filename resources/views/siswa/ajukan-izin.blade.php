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

            @if(isset($izin))
            <input type="hidden" name="id_izin" value="{{ $izin->id }}">
            @endif

            <div class="form-card">

                <div class="card-header-box">
                    <span class="card-number">01.</span>
                    <span class="card-title">Data Siswa</span>
                </div>
                <div class="form-group">
                    <label>NAMA</label>
                    <input type="text" name="nama"
                        value="{{ old('nama', $izin->nama ?? '') }}"
                        placeholder="Masukkan nama lengkap"
                        class="@error('nama') input-error @enderror">

                    @error('nama')
                    <div class="error-text">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-row">

                    <div class="form-group">
                        <label>NO. URUT</label>
                        <select name="no_presensi" class="@error('no_presensi') input-error @enderror">
                            <option value="">Pilih no. urut</option>
                            @for ($i = 1; $i <= 36; $i++)
                                <option value="{{ $i }}"
                                {{ old('no_presensi', $izin->no_presensi ?? '') == $i ? 'selected' : '' }}>
                                {{ $i }}
                                </option>
                                @endfor
                        </select>

                        @error('no_presensi')
                        <div class="error-text">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label>KELAS</label>
                        <select name="kelas" id="kelas" class="@error('kelas') input-error @enderror">
                            <option value="10" {{ old('kelas', $izin->kelas ?? '') == 10 ? 'selected' : '' }}>X</option>
                            <option value="11" {{ old('kelas', $izin->kelas ?? '') == 11 ? 'selected' : '' }}>XI</option>
                            <option value="12" {{ old('kelas', $izin->kelas ?? '') == 12 ? 'selected' : '' }}>XII</option>
                            <option value="13" {{ old('kelas', $izin->kelas ?? '') == 13 ? 'selected' : '' }}>XIII</option>
                        </select>
                        @error('kelas')
                        <div class="error-text">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label>JURUSAN</label>
                        <select name="jurusan" id="jurusan">
                            <option value="">Pilih jurusan</option>
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
                        <input type="radio" name="kembali" value="ya"
                            {{ old('kembali', $izin->kembali_lagi ?? true) ? 'checked' : '' }}>
                        <span class="custom-radio"></span>
                        Kembali ke sekolah
                    </label>
                    <label class="toggle-item">
                        <input type="radio" name="kembali" value="tidak"
                            {{ old('kembali', $izin->kembali_lagi ?? true) ? '' : 'checked' }}>
                        <span class="custom-radio"></span>
                        Tidak kembali
                    </label>
                </div>

                <div class="form-group">
                    <label>KEPERLUAN</label>
                    <textarea
                        name="keperluan"
                        placeholder="Contoh: Izin ke dokter karena sakit"
                        class="@error('keperluan') input-error @enderror">{{ old('keperluan', $izin->keperluan ?? '') }}</textarea>

                    @error('keperluan')
                    <div class="error-text">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-row">

                    <div class="form-group">
                        <label>JAM MULAI IZIN</label>
                        <div class="time-input">
                            <input type="time" name="jam_mulai"
                                value="{{ old('jam_mulai', isset($izin->jam_mulai) ? $izin->jam_mulai->format('H:i') : '') }}">
                            <iconify-icon icon="solar:clock-circle-linear" class="time-icon"></iconify-icon>
                            @error('jam_mulai')
                            <div class="error-text">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group" id="container-jam-kembali">
                        <label>JAM SELESAI IZIN</label>
                        <div class="time-input">
                            <input type="time" name="jam_selesai"
                                value="{{ old('jam_selesai', isset($izin->jam_selesai) ? $izin->jam_selesai->format('H:i') : '') }}">
                            <iconify-icon icon="solar:clock-circle-linear" class="time-icon"></iconify-icon>
                            @error('jam_selesai')
                            <div class="error-text">{{ $message }}</div>
                            @enderror
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

    // ambil value lama (edit / old)
    const oldKelas = "{{ old('kelas', $izin->kelas ?? '') }}";
    const oldJurusan = "{{ old('jurusan', $izin->jurusan ?? '') }}";

    function loadJurusan(selectedKelas, selectedJurusan = null) {
        jurusanSelect.innerHTML = '<option value="">Pilih jurusan</option>';

        if (jurusanMap[selectedKelas]) {
            jurusanMap[selectedKelas].forEach(jurusan => {
                const option = document.createElement('option');
                option.value = jurusan;
                option.textContent = jurusan;

                // set selected kalau edit
                if (jurusan === selectedJurusan) {
                    option.selected = true;
                }

                jurusanSelect.appendChild(option);
            });
        }
    }

    // saat user ganti kelas
    kelasSelect.addEventListener('change', function() {
        loadJurusan(this.value);
    });

    document.addEventListener('DOMContentLoaded', function() {

        // 🔥 AUTO LOAD SAAT EDIT
        if (oldKelas) {
            kelasSelect.value = oldKelas;
            loadJurusan(oldKelas, oldJurusan);
        }

        // =====================
        // TOGGLE JAM KEMBALI
        // =====================
        const radioKembali = document.querySelectorAll('input[name="kembali"]');
        const containerJamSelesai = document.getElementById('container-jam-kembali');

        function toggleJamInput() {
            const selectedValue = document.querySelector('input[name="kembali"]:checked').value;

            if (selectedValue === 'tidak') {
                containerJamSelesai.style.display = 'none';
            } else {
                containerJamSelesai.style.display = 'block';
            }
        }

        radioKembali.forEach(radio => {
            radio.addEventListener('change', toggleJamInput);
        });

        toggleJamInput();
    });

    // =====================
    // REMOVE ERROR STYLE
    // =====================
    const inputs = document.querySelectorAll('input, select, textarea');

    inputs.forEach(input => {
        input.addEventListener('input', () => {
            input.classList.remove('input-error');

            const errorText = input.closest('.form-group')?.querySelector('.error-text');
            if (errorText) errorText.remove();
        });

        input.addEventListener('change', () => {
            input.classList.remove('input-error');

            const errorText = input.closest('.form-group')?.querySelector('.error-text');
            if (errorText) errorText.remove();
        });
    });

    // =====================
    // SELECT STYLE
    // =====================
    const selects = document.querySelectorAll('select');

    selects.forEach(select => {
        if (select.value !== "") {
            select.classList.add('selected');
        }

        select.addEventListener('change', () => {
            if (select.value !== "") {
                select.classList.add('selected');
            } else {
                select.classList.remove('selected');
            }
        });
    });
</script>
@endsection