@extends('layouts.app')

@section('content')

{{-- @php
// dummy condition (ubah true/false untuk testing)
$izin = true;
@endphp --}}

<!-- empty state -->
@if (!$izin)
<div id="empty-state">
    <div class="empty-wrapper">
        <div class="empty-izin">

            <div class="empty-icon">
                <img src="{{ asset('images/izin.png') }}" alt="izin">
            </div>

            <div class="empty-title">
                Belum Ada Pengajuan Izin
            </div>

            <div class="empty-desc">
                Ajukan izin melalui formulir untuk memulai proses perizinan.
            </div>

            <a href="{{ route('ajukan_izin-siswa') }}" class="empty-btn">
                Ajukan Izin
            </a>

        </div>
    </div>
</div>
@else
<!-- detail izin -->
<div id="detail-izin">
    <div class="page-header">

        <h1 class="page-title">Status Perizinan</h1>

        <p class="page-desc">
            Pantau perkembangan pengajuan izinmu secara real-time.
        </p>

    </div>

    <div class="izin-layout">

        <div class="izin-form">

            <!-- DATA SISWA -->
            <div class="form-card">
                <div class="izin-left-2">
                    <div class="izin-icon">
                        @if ($izin->status == 2)
                        <iconify-icon icon="solar:check-circle-bold-duotone" style="color: #1DB366;"></iconify-icon>
                        @else
                        <iconify-icon icon="mdi:clock"></iconify-icon>
                        @endif
                    </div>

                    <div class="izin-header-row">

                        <div class="izin-text">
                            <div class="izin-date">
                                {{ $izin->created_at->format('d M Y, H:i') }} WIB
                            </div>

                            <div class="izin-row">
                                <div class="izin-title">
                                    @if ($izin->status == 0)
                                    Sedang Ditinjau Oleh Guru Kelas
                                    @elseif ($izin->status == 1)
                                    Sedang Ditinjau Oleh Guru BK
                                    @elseif ($izin->status == 2)
                                    Perizinan Telah Disetujui
                                    @endif
                                </div>
                            </div>
                        </div>

                        <div class="izin-menu">
                            <iconify-icon icon="mdi:dots-vertical"></iconify-icon>
                        </div>

                    </div>

                </div>

                <hr class="line-izin">

                <div class="card-izin-2">
                    <div class="card-header" style="padding:12px;display:block !important;">
                        <span class="card-number" style="color: #7ABAFF;">01.</span>
                        <span class="card-title">Data Siswa</span>
                    </div>

                    <div class="card-content">
                        <div class="row">
                            <label>NAMA</label>
                            <div class="value">{{ $izin->nama }}</div>
                        </div>

                        <div class="row">
                            <label>NO. URUT</label>
                            <div class="value small">{{ $izin->no_presensi }}</div>
                        </div>

                        <div class="row">
                            <label>KELAS</label>
                            <div class="value small">
                                {{ [
                                    10 => 'X (10)',
                                    11 => 'XI (11)',
                                    12 => 'XII (12)',
                                    13 => 'XIII (13)'
                                ][$izin->kelas] ?? '-' }}
                            </div>
                        </div>

                        <div class="row">
                            <label>JURUSAN</label>
                            <div class="value small">{{ $izin->jurusan }}</div>
                        </div>
                    </div>

                    <div class="card-header" style="padding:12px;display:block !important;">
                        <span class="card-number" style="color: #7ABAFF;">02.</span>
                        <span class="card-title">Detail Izin<span>
                    </div>

                    <div class="card-content">
                        <div class="row">
                            <label>KEPERLUAN</label>
                            <div class="value">{{ $izin->keperluan }}</div>
                        </div>

                        <div class="row">
                            <label>JAM IZIN</label>
                            <div class="jam-wrapper">
                                <div class="value small">
                                    {{ $izin->jam_mulai ? $izin->jam_mulai->format('H:i') : '--:--' }}
                                </div>

                                <span class="arrow">→</span>

                                <div class="value small">
                                    {{ $izin->jam_selesai ? $izin->jam_selesai->format('H:i') : 'Tidak Kembali' }}
                                </div>
                            </div>
                        </div>


                    </div>

                    <div class="card-header" style="padding:12px;display:block !important;">
                        <span class="card-number" style="color: #7ABAFF;">03.</span>
                        <span class="card-title">Informasi Guru</span>
                    </div>

                    <div class="card-content">
                        <div class="row">
                            <label>GURU BK</label>
                            <div class="value guru">
                                <img src="{{ asset('images/guru cewe.png') }}" class="foto-guru">
                                <span>{{ $izin->approver_bk }}</span>
                            </div>
                        </div>

                        <div class="row">
                            <label>GURU UMUM</label>
                            <div class="value guru small">
                                <img src="{{ asset('images/guru cowo.png') }}" class="foto-guru">
                                <span>{{ $izin->approver_umum }}</span>
                            </div>
                        </div>
                    </div>

                    <div class="btn-wrapper">
                        @if ($izin->status == 2)
                        {{-- Tombol Lihat QR Code (Hanya muncul jika status 2) --}}
                        <button class="btn-lihat-qr" onclick="openModalQR()" style="background: #1DB366; color: white; border: none; padding: 12px; border-radius: 10px; width: 100%; cursor: pointer; font-weight: bold; display: flex; align-items: center; justify-content: center; gap: 8px;">
                            <iconify-icon icon="solar:qr-code-bold-duotone" style="font-size: 20px;"></iconify-icon>
                            Lihat QR Code
                        </button>
                        @elseif (in_array($izin->status, [0, 1]))
                        {{-- Tombol Batalkan (Hanya muncul jika status 0 atau 1) --}}
                        <button class="btn-batal-izin" onclick="openModal()">
                            Batalkan Pengajuan
                        </button>
                        @endif
                    </div>

                </div>
            </div>
        </div>

        <!-- STEP KANAN -->
        <div class="izin-steps">

            <div class="step active">
                <div class="step-number">{{ in_array($izin->status, [0,1,2,10]) ? '✓' : '1' }}</div>
                <div>
                    <div class="step-title">Isi Formulir Perizinan</div>
                    <p>Lengkapi formulir pengajuan izin dengan data dan alasan yang jelas.</p>
                </div>
            </div>

            <div class="step {{ in_array($izin->status, [0,1,2,4,10]) ? 'active' : '' }}">
                <div class="step-number">{{ in_array($izin->status, [1,2,4,10]) ? '✓' : '2' }}</div>
                <div>
                    <div class="step-title">Persetujuan Guru Kelas (Umum)</div>
                    <p>Pengajuan izin akan ditinjau terlebih dahulu oleh guru kelas.</p>
                </div>
            </div>

            <div class="step {{ in_array($izin->status, [1,2,10]) ? 'active' : '' }}">
                <div class="step-number">{{ in_array($izin->status, [2,10]) ? '✓' : '3' }}</div>
                <div>
                    <div class="step-title">Persetujuan Guru BK</div>
                    <p>Pengajuan izin akan ditinjau dan diverifikasi oleh guru BK.</p>
                </div>
            </div>

            <div class="step {{ in_array($izin->status, [2,10]) ? 'active' : '' }}">
                <div class="step-number">{{ $izin->status == 10 ? '✓' : '4' }}</div>
                <div>
                    <div class="step-title">Verifikasi QR Code</div>
                    <p>Verifikasi ke satpam dengan QR code yang berisi surat izin yang valid.</p>
                </div>
            </div>

        </div>

    </div>
</div>

<div id="modal" class="modal-overlay">

    <div class="modal-box">

        <span class="modal-close" onclick="closeModal()">✕</span>

        <div class="modal-icon">
            <div class="icon-line">
                <div class="line-red"></div>

                <div class="icon-box red">
                    <iconify-icon icon="iconoir:cancel"></iconify-icon>
                </div>

                <div class="line-red"></div>
            </div>


        </div>

        <h2 class="modal-title">Batalkan Pengajuan Izin?</h2>

        <p class="modal-desc">
            Pengajuan izin yang dibatalkan tidak akan diproses lebih lanjut.
            Kamu dapat mengajukan izin kembali jika diperlukan.
        </p>

        <div class="modal-actions">
            <button type="button" class="btn-kembali" onclick="closeModal()">Lanjutkan Pengajuan</button>
            <form action="{{ route('batal-siswa') }}" method="POST">
                @csrf
                <input type="hidden" name="id" value="{{ $izin->id }}">
                <button type="submit" class="btn-submit" onclick="cancelIzin()" style="background: #F24141; color: #FCFCFC; border: 1px solid #F56666;">Batalkan Pengajuan</button>
            </form>
        </div>

    </div>

</div>

<div id="modalQR" class="modal-overlay" style="display: none;">
    <div class="modal-box">
        <span class="modal-close" onclick="closeModalQR()">✕</span>
        <h2 class="modal-title">QR Code Perizinan</h2>
        <p class="modal-desc">Tunjukkan QR Code ini kepada Satpam untuk diverifikasi.</p>

        <div class="qr-display" style="margin: 20px 0; text-align: center;">
            {!! QrCode::size(200)->generate(route('surat-izin', $izin->id)) !!}
        </div>

        <div class="modal-actions">
            <button type="button" class="btn-kembali" onclick="closeModalQR()" style="width: 100%;">Tutup</button>
        </div>
    </div>
</div>

@endif

<script>
    function openModal() {
        document.getElementById("modal").style.display = "flex";
    }

    function closeModal() {
        document.getElementById("modal").style.display = "none";
    }

    function openModalQR() {
        document.getElementById("modalQR").style.display = "flex";
    }

    function closeModalQR() {
        document.getElementById("modalQR").style.display = "none";
    }
    // function cancelIzin() {
    //     sessionStorage.setItem("izin", "false");

    //     location.reload();
    // }

    // window.onload = function() {
    //     let izin = sessionStorage.getItem("izin");

    //     // default pertama kali
    //     if (izin === null) {
    //         sessionStorage.setItem("izin", "true");
    //         izin = "true";
    //     }

    //     if (izin === "false") {
    //         document.getElementById("detail-izin").style.display = "none";
    //         document.getElementById("empty-state").style.display = "block";
    //     } else {
    //         document.getElementById("detail-izin").style.display = "block";
    //         document.getElementById("empty-state").style.display = "none";
    //     }
    // }
</script>

@endsection