    @extends('layouts.app')

    @section('content')

    @if (count($groupData) == 0)

    <!-- empty state -->
    <div id="empty-state">
        <div class="empty-wrapper">
            <div class="empty-izin">

                <div class="empty-icon">
                    <img src="{{ asset('images/no izin.png') }}" alt="izin">
                </div>

                <div class="empty-title">
                    Belum Ada Riwayat Izin
                </div>

                <div class="empty-desc">
                    Pengajuan izin yang telah selesai akan muncul di sini.
                </div>

                <a href="{{ route('ajukan_izin-siswa') }}" class="empty-btn">
                    Ajukan Izin
                </a>

            </div>
        </div>
    </div>

    @else

    <!-- ada data -->
    <div class="page-header" style="margin-bottom: 24px;">

        <h1 class="page-title">Riwayat Pengajuan Izin</h1>

        <p class="page-desc">
            Lihat semua pengajuan izin yang pernah kamu buat.
        </p>

    </div>

    <div class="search-container">
        <div class="search-box">
            <iconify-icon icon="mynaui:search" class="search-icon"></iconify-icon>
            <input type="text" id="searchInput" placeholder="Cari riwayat perizinan..." />
        </div>

        <div class="filter-box">

            <!-- <div class="dropdown">
                <div class="dropdown-btn">
                    Semua Status
                    <iconify-icon icon="mdi:chevron-down"></iconify-icon>
                </div>
                <div class="dropdown-content">
                    <div>Semua Status</div>
                    <div>Disetujui</div>
                    <div>Ditolak</div>
                </div>
            </div> -->

            <!-- <div class="dropdown">
                <div class="dropdown-btn">
                    7 hari terakhir
                    <iconify-icon icon="mdi:chevron-down"></iconify-icon>
                </div>
                <div class="dropdown-content">
                    <div>7 hari terakhir</div>
                    <div>30 hari terakhir</div>
                </div>
            </div> -->

        </div>
    </div>

    @foreach($groupData as $tanggal => $items)

    <div class="section-item">

        <div class="section-title" style="margin-top: 32px; font-size: 14px;">
            {{ \Carbon\Carbon::parse($tanggal)->translatedFormat('l, d F Y') }}
        </div>

        @foreach($items as $index => $izin)

        <div id="filledState">

            <div class="izin-card">

                <div class="izin-header">

                    <div class="izin-left">
                        <div class="izin-icon">
                            @if (in_array($izin->status, [0,1]))
                            <iconify-icon icon="mdi:clock"></iconify-icon>
                            @elseif (in_array($izin->status, [3,4]))
                            <iconify-icon icon="mdi:clock"></iconify-icon>
                            @elseif (in_array($izin->status, [2,10]))
                            <iconify-icon icon="solar:check-circle-bold-duotone" style="color: #1DB366;"></iconify-icon>
                            @endif
                        </div>

                        <div class="izin-text">

                            <div class="izin-date">{{ $izin->created_at->format('d M Y, H:i') }} WIB</div>

                            <div class="izin-row">
                                <div class="izin-title">
                                    @if ($izin->status == 3)
                                    Pengajuan Telah Ditolak oleh Guru Umum
                                    @elseif ($izin->status == 4)
                                    Pengajuan Telah Ditolak oleh Guru BK
                                    @elseif ($izin->status == 10)
                                    Verifikasi QR Code Berhasil
                                    @endif
                                </div>

                                @if (in_array($izin->status, [3,10]))
                                @php
                                    $guruUmum = $allGuru[$izin->approver_umum_id] ?? null;
                                @endphp
                                <div class="izin-user">
                                    <img
                                        src="{{ $guruUmum && $guruUmum->foto ? asset('storage/'.$guruUmum->foto) : asset('images/default.png') }}"
                                        class="foto-guru">
                                    <span>
                                        {{ $izin->approver_umum }}
                                    </span>
                                </div>
                                @endif
                                @if (in_array($izin->status, [4,10]))
                                @php
                                    $guruBk = $allGuru[$izin->approver_bk_id] ?? null;
                                @endphp
                                <div class="izin-user">
                                    <img
                                        src="{{ $guruBk && $guruBk->foto ? asset('storage/'.$guruBk->foto) : asset('images/default.png') }}"
                                        class="foto-guru">
                                    <span>
                                        {{ $izin->approver_bk }}
                                    </span>
                                </div>
                                @endif
                            </div>

                        </div>

                    </div>

                    <div class="izin-actions">
                        <a href="javascript:void(0)" class="izin-detail"
                            onclick="openPopup(this)"
                            data-nama="{{ $izin->nama }}"
                            data-no="{{ $izin->no_presensi }}"
                            data-kelas="{{ $izin->kelas }}"
                            data-jurusan="{{ $izin->jurusan }}"
                            data-keperluan="{{ $izin->keperluan }}"
                            data-jam_mulai="{{ $izin->jam_mulai ? $izin->jam_mulai->format('H:i') : '--:--' }}"
                            data-jam_selesai="{{ $izin->jam_selesai ? $izin->jam_selesai->format('H:i') : 'Tidak Kembali' }}"
                            data-bk="{{ $izin->approver_bk }}"
                            data-umum="{{ $izin->approver_umum }}"
                            data-tanggal="{{ $izin->created_at->format('d M Y, H:i') }} WIB"
                            data-status="{{ $izin->status }}"
                            data-foto_bk="{{ $guruBk && $guruBk->foto ? asset('storage/'.$guruBk->foto) : asset('images/guru cewe.png') }}"
                            data-foto_umum="{{ $guruUmum && $guruUmum->foto ? asset('storage/'.$guruUmum->foto) : asset('images/guru cowo.png') }}">
                            Lihat Detail
                        </a>
                        <iconify-icon icon="mdi:dots-vertical"></iconify-icon>
                    </div>

                </div>

            </div>

        </div>

        @endforeach

    </div>

    @endforeach

    {{-- <div class="section-item">

        <div class="section-title" style="margin-top: 32px; font-size: 14px;">
            Jumat, 13 Maret 2026
        </div>

        <div id="filledState">

            @foreach($items as $izin)

<div class="izin-card">

    <div class="izin-header">

        <div class="izin-left">
            <div class="izin-icon">
                <iconify-icon icon="solar:check-circle-bold-duotone" style="color: #1DB366;"></iconify-icon>
            </div>

            <div class="izin-text">

                <div class="izin-date">
                    {{ $izin->created_at->format('d M Y, H:i') }} WIB
    </div>

    <div class="izin-row">
        <div class="izin-title">
            Pengajuan Telah Digunakan
        </div>

        <div class="izin-user">
            <img src="{{ asset('images/guru cowo.png') }}">
            <span>{{ $izin->approver_umum }}</span>
        </div>

        <div class="izin-user">
            <img src="{{ asset('images/guru cewe.png') }}">
            <span>{{ $izin->approver_bk }}</span>
        </div>
    </div>

    </div>
    </div>

    <!-- 🔥 KIRIM DATA KE POPUP -->
    <div class="izin-actions">
        <a href="javascript:void(0)" class="izin-detail"
            onclick="openPopup(this)"
            data-nama="{{ $izin->nama }}"
            data-kelas="{{ $izin->kelas }}"
            data-jurusan="{{ $izin->jurusan }}"
            data-keperluan="{{ $izin->keperluan }}"
            data-jam_mulai="{{ $izin->jam_mulai ? $izin->jam_mulai->format('H:i') : '--:--' }}"
            data-jam_selesai="{{ $izin->jam_selesai ? $izin->jam_selesai->format('H:i') : 'Tidak Kembali' }}"
            data-bk="{{ $izin->approver_bk }}"
            data-umum="{{ $izin->approver_umum }}">
            Lihat Detail
        </a>

        <iconify-icon icon="mdi:dots-vertical"></iconify-icon>
    </div>

    </div>

    </div>

    @endforeach

    </div>

    </div> --}}

    <div id="popup-detail" class="modal-overlay-izin" style="display:none;" onclick="closePopup()">

        <div class="modal-box-izin" onclick="event.stopPropagation()">

            <div class="form-card-izin">
                <div class="izin-left-2">
                    <div class="izin-icon">
                        <iconify-icon icon="solar:check-circle-bold-duotone" style="color: #1DB366;"></iconify-icon>
                    </div>

                    <div class="izin-header-row">

                        <div class="izin-text">
                            <div class="izin-date" id="detail-tanggal"></div>

                            <div class="izin-row">
                                <div class="izin-title" id="detail-status"></div>
                            </div>
                        </div>

                        <div class="izin-menu">
                            <!-- <iconify-icon icon="mdi:dots-vertical"></iconify-icon> -->
                        </div>

                    </div>

                </div>

                <hr class="line-izin">

                <div class="card-izin-2">
                    <div class="card-header" style="padding:12px;">
                        <span class="card-number" style="color: #7ABAFF;">01.</span>
                        <span class="card-title">Data Siswa</span>
                    </div>

                    <div class="card-content">
                        <div class="row">
                            <label>NAMA</label>
                            <div class="value" id="detail-nama"></div>
                        </div>

                        <div class="row">
                            <label>NO. URUT</label>
                            <div class="value small" id="detail-no"></div>
                        </div>

                        <div class="row">
                            <label>KELAS</label>
                            <div class="value small" id="detail-kelas"></div>
                        </div>

                        <div class="row">
                            <label>JURUSAN</label>
                            <div class="value small" id="detail-jurusan"></div>
                        </div>
                    </div>

                    <!-- DETAIL IZIN -->
                    <div class="card-header" style="padding:12px;">
                        <span class="card-number">02.</span>
                        <span class="card-title">Detail Izin</span>
                    </div>

                    <div class="card-content">
                        <div class="row">
                            <label>KEPERLUAN</label>
                            <div class="value" id="detail-keperluan"></div>
                        </div>

                        <div class="row">
                            <label>JAM IZIN</label>
                            <div class="jam-wrapper">
                                <div class="value small" id="detail-jam_mulai"></div>
                                <span class="arrow">→</span>
                                <div class="value small" id="detail-jam_selesai"></div>
                            </div>
                        </div>
                    </div>

                    <!-- GURU -->
                    <div class="card-header" style="padding:12px;">
                        <span class="card-number">03.</span>
                        <span class="card-title">Informasi Guru</span>
                    </div>

                    <div class="card-content">
                        <div class="row">
                            <label>GURU BK</label>
                            <div class="value guru">
                                <img id="detail-foto-bk" src="{{ asset('images/guru cewe.png') }}" class="foto-guru">
                                <span id="detail-bk"></span>
                            </div>
                        </div>

                        <div class="row">
                            <label>GURU UMUM</label>
                            <div class="value guru small">
                                <img id="detail-foto-umum" src="{{ asset('images/guru cowo.png') }}" class="foto-guru">
                                <span id="detail-umum"></span>
                            </div>
                        </div>
                    </div>

                </div>

            </div>

        </div>

    </div>

    @endif

    <script>
        function formatJam(jam) {
            if (!jam) return '--:--';
            return jam.substring(0, 5);
        }

        function getStatusText(status) {
            switch (parseInt(status)) {
                case 0:
                    return "Sedang Ditinjau Oleh Guru Kelas";
                case 1:
                    return "Sedang Ditinjau Oleh Guru BK";
                case 2:
                    return "Perizinan Telah Disetujui";
                case 3:
                    return "Ditolak oleh Guru Umum";
                case 4:
                    return "Ditolak oleh Guru BK";
                case 10:
                    return "Verifikasi QR Code Berhasil";
                default:
                    return "-";
            }
        }

        function getKelasText(kelas) {
            const map = {
                10: 'X (10)',
                11: 'XI (11)',
                12: 'XII (12)',
                13: 'XIII (13)'
            };
            return map[kelas] || '-';
        }

        function openPopup(el) {

            const d = el.dataset;

            // HEADER
            document.getElementById("detail-tanggal").innerText = d.tanggal;
            document.getElementById("detail-status").innerText = getStatusText(d.status);

            // DATA SISWA
            document.getElementById("detail-nama").innerText = d.nama;
            document.getElementById("detail-no").innerText = d.no;
            document.getElementById("detail-kelas").innerText = getKelasText(d.kelas);
            document.getElementById("detail-jurusan").innerText = d.jurusan;

            // DETAIL IZIN
            document.getElementById("detail-keperluan").innerText = d.keperluan;
            document.getElementById("detail-jam_mulai").innerText = formatJam(d.jam_mulai);

            document.getElementById("detail-jam_selesai").innerText =
                d.jam_selesai ? formatJam(d.jam_selesai) : "Tidak Kembali";

            // GURU
            document.getElementById("detail-bk").innerText = d.bk;
            document.getElementById("detail-umum").innerText = d.umum;
            
            document.getElementById("detail-foto-bk").src = d.foto_bk || "/images/guru cewe.png";
            document.getElementById("detail-foto-umum").src = d.foto_umum || "/images/guru cowo.png";

            // SHOW POPUP
            document.getElementById("popup-detail").style.display = "flex";
        }

        function closePopup() {
            document.getElementById("popup-detail").style.display = "none";
        }

        document.getElementById("searchInput").addEventListener("keyup", function() {

            let keyword = this.value.toLowerCase();

            // ambil semua card
            let cards = document.querySelectorAll(".izin-card");

            cards.forEach(card => {

                let text = card.innerText.toLowerCase();

                if (text.includes(keyword)) {
                    card.style.display = "block";
                } else {
                    card.style.display = "none";
                }

            });

        });
    </script>

    @endsection