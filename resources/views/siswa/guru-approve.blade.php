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


<form action="{{ route('store-siswa') }}" method="POST">
@csrf
    <div class="izin-layout">

        <div class="izin-form">

            <!-- INFORMASI GURU -->
            <div class="form-card">

                <div class="card-header-box">
                    <span class="card-number">03.</span>
                    <span class="card-title">Informasi Guru</span>
                </div>

                <div class="guru-list">

                    <!-- GURU BK -->
                    <div class="guru-card">
                       <img src="{{ $guruBk->foto ? asset('storage/' . $guruBk->foto) : asset('images/guru cewe.png') }}" class="guru-avatar">

                        <div class="guru-info">
                            <div class="guru-badge">
                                <span class="badge-bk">GURU BK</span>
                                <span class="badge-status">SIJA</span>
                            </div>
                            <div class="guru-name">
                                {{ $guruBk->nama }}{{ $guruBk->gelar ? ', ' . $guruBk->gelar : '' }}
                            </div>

                            <input type="hidden" name="nama_guru_bk" value="{{ $guruBk->nama }}{{ $guruBk->gelar ? ', ' . $guruBk->gelar : '' }}">
                            <input type="hidden" name="id_guru_bk" value="{{ $guruBk->id }}">
                        </div>
                    </div>

                    <!-- GURU UMUM -->
                    <div class="guru-card">
                        <img src="{{ $guruUmumFirst->foto ? asset('storage/' . $guruUmumFirst->foto) : asset('images/guru cowo.png') }}" class="guru-avatar">

                        <div class="guru-info">
                            <div class="guru-badge">
                                <span class="badge-umum">GURU UMUM</span>
                            </div>
                            <div class="guru-name" id="guru-name">{{ $guruUmumFirst->nama }}{{ $guruUmumFirst->gelar ? ', ' . $guruUmumFirst->gelar : ''}}</div>
                            <input type="hidden" name="nama_guru_umum" id="guru-nama_hidden" value="{{ $guruUmumFirst->nama }}{{ $guruUmumFirst->gelar ? ', ' . $guruUmumFirst->gelar : ''}}">
                            <input type="hidden" name="id_guru_umum" id="guru-id" value="{{ $guruUmumFirst->id }}">

                            <select id="guru-select" style="display:none;" onchange="pilihGuru('guru')">
                                <option value="">-- pilih guru --</option>
                                @foreach ($guruUmum as $g)
                                    <option 
                                        value="{{ $g->id }}"
                                        data-nama="{{ $g->nama }}"
                                        data-jurusan="{{ $g->jurusan }}"
                                        data-gelar="{{ $g->gelar }}"
                                    >
                                        {{ $g->nama }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <iconify-icon icon="tabler:selector" class="guru-arrow" onclick="toggleSelect('guru')"></iconify-icon>
                    </div>

                </div>

            </div>


            <div class="form-actions">
                <button type="button" class="btn-kembali" onclick="window.location.href='ajukan-izin'">
                    Kembali
                </button>

                <button type="button" class="btn-submit" onclick="openModal()">
                    Ajukan Izin
                    <iconify-icon icon="hugeicons:file-upload"></iconify-icon>
                </button>
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

    <div id="modal" class="modal-overlay">

        <div class="modal-box">

            <span class="modal-close" onclick="closeModal()">✕</span>

            <div class="modal-icon">
                <div class="icon-box blue">
                    <iconify-icon icon="hugeicons:file-upload"></iconify-icon>
                </div>

                <div class="icon-line">
                    <div class="line"></div>

                    <div class="circle">
                        <iconify-icon icon="si:arrow-right-line"></iconify-icon>
                    </div>

                    <div class="line"></div>
                </div>

                <div class="icon-box gray">
                    <iconify-icon icon="ph:chalkboard-teacher"></iconify-icon>
                </div>
            </div>

            <h2 class="modal-title">Ajukan Izin Sekarang?</h2>

            <p class="modal-desc">
                Periksa kembali data yang telah diisi. Setelah dikirim, pengajuan izin
                akan diproses oleh guru kelas dan guru BK.
            </p>

            <div class="modal-actions">
                <button type="button" class="btn-kembali" onclick="closeModal()">Periksa kembali</button>
                <button type="submit" class="btn-submit" onclick="submitIzin()">Ajukan sekarang</button>
            </div>

        </div>

    </div>
</script>

<script>
    function openModal() {
        document.getElementById("modal").style.display = "flex";
    }

    function closeModal() {
        document.getElementById("modal").style.display = "none";
    }

    function submitIzin() {
        // sessionStorage.setItem("izin", "sudah"); 
        window.location.href = "dashboard";
    }
    
    function toggleSelect(type) {
        const select = document.getElementById(type + '-select');

        if (select.style.display === 'none') {
            select.style.display = 'block';
        } else {
            select.style.display = 'none';
        }
    }

    function pilihGuru(type) {
        const select = document.getElementById(type + '-select');
        const selected = select.options[select.selectedIndex];

        const nama = selected.getAttribute('data-nama');
        const jurusan = selected.getAttribute('data-jurusan');
        const id = selected.value;
        const gelar = selected.getAttribute('data-gelar') ? ', ' + selected.getAttribute('data-gelar') : '';

        // update tampilan
        document.getElementById(type + '-name').innerText = nama + gelar;
        document.getElementById(type + '-nama_hidden').innerText = nama;
        // document.getElementById(type + '-jurusan').innerText = jurusan;

        // update hidden input
        document.getElementById(type + '-id').value = id;

        // sembunyikan lagi select
        select.style.display = 'none';
    }
</script>

@endsection