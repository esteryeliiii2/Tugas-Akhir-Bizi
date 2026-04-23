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
                        @if (in_array($izin->status, [0,1]))
                        <iconify-icon icon="mdi:clock"></iconify-icon>
                        @elseif (in_array($izin->status, [3,4]))
                        <iconify-icon icon="material-symbols:cancel-rounded" style="color: #F24141;"></iconify-icon>
                        @elseif (in_array($izin->status, [2,10]))
                        <iconify-icon icon="solar:check-circle-bold-duotone" style="color: #3e5047;"></iconify-icon>
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
                                    @elseif ($izin->status == 3)
                                    Pengajuan Izin Ditolak oleh Guru Kelas
                                    @elseif ($izin->status == 4)
                                    Pengajuan Izin Ditolak oleh Guru BK
                                    @elseif ($izin->status == 10)
                                    Verifikasi QR Code Berhasil
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
                                <img
                                    src="{{ $guruBk && $guruBk->foto ? asset('storage/'.$guruBk->foto) : asset('images/default.png') }}"
                                    class="foto-guru">
                                <span>{{ $izin->approver_bk }}</span>
                            </div>
                        </div>

                        <div class="row">
                            <label>GURU UMUM</label>
                            <div class="value guru small">
                                <img
                                    src="{{ $guruUmum && $guruUmum->foto ? asset('storage/'.$guruUmum->foto) : asset('images/default.png') }}"
                                    class="foto-guru">
                                <span>{{ $izin->approver_umum }}</span>
                            </div>
                        </div>
                    </div>

                    <div class="btn-wrapper">
                        @if ($izin->status == 2)
                        {{-- Tombol Lihat QR Code (Hanya muncul jika status 2) --}}
                        <button class="btn-qr-code" onclick="openModalQR()">
                            Lihat QR Code
                            <iconify-icon icon="uil:qrcode-scan"></iconify-icon>
                        </button>
                        @elseif (in_array($izin->status, [0, 1]))
                        <button class="btn-batal-izin" onclick="openModal()">
                            Batalkan Pengajuan
                        </button>

                        @elseif (in_array($izin->status, [3,4]))
                        <a href="{{ route('edit-izin-siswa', $izin->id) }}" class="btn-batal-izin">
                            Edit Pengajuan
                        </a>
                        @endif
                    </div>

                </div>
            </div>
        </div>

        <div class="sisi-kanan">
            <div class="izin-steps">

                <div class="step active">
                    <div class="step-number">{{ in_array($izin->status, [0,1,2,3,4,10]) ? '✓' : '1' }}</div>
                    <div>
                        <div class="step-title">Isi Formulir Perizinan</div>
                        <p>Lengkapi formulir pengajuan izin dengan data dan alasan yang jelas.</p>
                    </div>
                </div>

                <div class="step {{ in_array($izin->status, [0,1,2,3,4,10]) ? 'active' : '' }}">
                    <div class="step-number">
                        @if($izin->status == 3)
                        ✕
                        @elseif(in_array($izin->status, [1,2,4,10]))
                        ✓
                        @else
                        2
                        @endif
                    </div>
                    <div>
                        <div class="step-title">Persetujuan Guru Kelas (Umum)</div>
                        <p>Pengajuan izin akan ditinjau terlebih dahulu oleh guru kelas.</p>
                    </div>
                </div>

                <div class="step {{ in_array($izin->status, [1,2,4,10]) ? 'active' : '' }}">
                    <div class="step-number">
                        @if($izin->status == 4)
                        ✕
                        @elseif(in_array($izin->status, [2,10]))
                        ✓
                        @else
                        3
                        @endif
                    </div>
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

            @if(in_array($izin->status, [3,4]))
            <div class="form-card-reject">

                <div class="card-header-box">
                    <span class="card-title" style="color: #F24141;">Catatan dari Guru</span>
                </div>

                <div class="card-content">
                    <p style="color:#7c7c7c; margin-bottom:16px; font-size: 14px;">
                        Pengajuan izin ditolak. Berikut alasan dari guru :
                    </p>

                    <div style=" background:#FCFCFC; border: 1px solid #E8E8E8; padding:12px; border-radius: 12px; margin-bottom:12px; font-size: 14px;">
                        {{ $izin->alasan_reject }}
                    </div>

                    <div class="value guru small" style="font-size: 12px; border-radius: 12px; padding: 8px 12px;">
                        <img
                            src="{{ $izin->status == 3 
                    ? ($guruUmum && $guruUmum->foto ? asset('storage/'.$guruUmum->foto) : asset('images/default.png')) 
                    : ($guruBk && $guruBk->foto ? asset('storage/'.$guruBk->foto) : asset('images/default.png')) }}"
                            class="foto-guru">

                        <span>
                            {{ $izin->status == 3 ? $izin->approver_umum : $izin->approver_bk }}
                        </span>
                    </div>
                </div>

            </div>
            @endif
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
        <p class="modal-desc" style="margin-bottom: 0px;">Tunjukkan QR Code ini kepada Satpam untuk diverifikasi.</p>

        @php
        $url = env('APP_URL') . '/surat/' . $izin->token;
        @endphp

        <div class="qr-display" style="margin: 20px 0; text-align: center;">
            {!! QrCode::size(200)->generate($url) !!}
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