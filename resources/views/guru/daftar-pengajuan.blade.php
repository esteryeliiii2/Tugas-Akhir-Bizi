@extends('layouts.app')

@section('content')

{{-- @php
$dataIzin = [
[
'nama' => 'Nicholas Daniel Raditya',
'kelas' => 'XIII (13)',
'no_presensi' => '27',
'jurusan' => 'SIJA',
'keperluan' => 'cap 3 jari ijazah SMP di SMPN 1 Semarang',
'jam' => '11:00 - 13:00',
'guru_bk' => 'Retno Yolanda, S.Pd.',
'guru_umum' => 'Agus Setyawan, S.Pd.'
]
];
@endphp --}}


<div class="page-header" style="margin-bottom: 24px;">

    <h1 class="page-title">Daftar Pengajuan Izin</h1>

    <p class="page-desc">
        Kelola dan proses pengajuan izin siswa dengan cepat dan terstruktur.
    </p>

</div>

<div class="filter-tabs">
    <button class="tab active" data-filter="all">Semua</button>
    <button class="tab" data-filter="menunggu">Menunggu</button>
    <button class="tab" data-filter="disetujui">Disetujui</button>
    <button class="tab" data-filter="ditolak">Ditolak</button>
</div>

@if(count($semuaIzin) > 0)


<div class="section-item" data-status="menunggu">

        @if(count($pengajuanMenunggu) > 0)

        <div class="section-title" style="margin-top: 32px; font-size: 14px;">
            Menunggu Peninjauan
        </div>

        @foreach($pengajuanMenunggu as $index => $izin)
        <div class="card-izinn">

            <div class="card-header-izin" data-index="menunggu-{{ $index }}" onclick="toggleCard(this)">

                <div class="left-header">

                    <img src="{{ asset('images/profile.png') }}" class="avatar">

                    <div>
                        <div class="tanggal">
                            {{ $izin->created_at->format('d M Y, H:i') }} WIB
                        </div>

                        <div class="nama-row">
                            <div class="nama">{{ $izin->nama }}</div>

                            <span class="badge siswa">SISWA</span>
                            <span class="badge sija">{{ $izin->jurusan }}</span>
                        </div>
                    </div>

                </div>

                <div class="action">
                    <button type="button" class="btn-tolak" onclick="event.stopPropagation(); openModalTolak({{ $izin->id }})">Tolak ✕</button>
                    <button type="button" class="btn-setuju" onclick="event.stopPropagation(); openModalSetuju({{ $izin->id }})">Setujui ✓</button>
                    <span class="arrow" id="arrow-menunggu-{{ $index }}">⌄</span>
                </div>
            </div>

            <!-- BODY -->
            <div class="card-body" id="card-menunggu-{{ $index }}" style="display: none;">

                <hr class="line-data">

                <div class="grid">

                    <div class="col">
                        <div class="card-header-none">
                            <span class="card-number" style="color: #7ABAFF;">01.</span>
                            <span class="card-title" style="margin-bottom: 0px;">Data Siswa</span>
                        </div>
                        <div class="row" style="margin-bottom: 20px; width: fit-content;">
                            <label style="color: #b1b1b1; font-size: 13px; font-weight: 500; margin-bottom: 8px;">
                                NAMA
                            </label>
                            <div class="value" style="width: 100%;">{{ $izin->nama }}</div>
                        </div>

                        <div class="row" style="margin-bottom: 20px; width: fit-content;">
                            <label style="color: #b1b1b1; font-size: 13px; font-weight: 500; margin-bottom: 8px;">
                                NO URUT
                            </label>
                            <div class="value" style="text-align: center; width: 100%;">{{ $izin->no_presensi }}</div>
                        </div>

                        <div class="row" style="margin-bottom: 20px; width: fit-content;">
                            <label style="color: #b1b1b1; font-size: 13px; font-weight: 500; margin-bottom: 8px;">
                                KELAS
                            </label>
                            <div class="value" style="width: 100%;">
                                {{ [
                                    10 => 'X (10)',
                                    11 => 'XI (11)',
                                    12 => 'XII (12)',
                                    13 => 'XIII (13)'
                                ][$izin->kelas] ?? '-' }}
                            </div>
                        </div>

                        <div class="row" style="margin-bottom: 20px; width: fit-content;">
                            <label style="color: #b1b1b1; font-size: 13px; font-weight: 500; margin-bottom: 8px;">
                                JURUSAN
                            </label>
                            <div class="value" style="width: 100%;">{{ $izin->jurusan }}</div>
                        </div>
                    </div>

                    <div class="col">
                        <div class="card-header-none">
                            <span class="card-number" style="color: #7ABAFF;">02.</span>
                            <span class="card-title" style="margin-bottom: 0px;">Detail Izin</span>
                        </div>
                        <div class="row" style="margin-bottom: 20px; width: fit-content;">
                            <label style="color: #b1b1b1; font-size: 13px; font-weight: 500; margin-bottom: 8px;">
                                KEPERLUAN
                            </label>
                            <div class="value" style="width: 100%;">{{ $izin->keperluan }}</div>
                        </div>

                        <div class="row" style="margin-bottom: 20px; width: fit-content;">
                            <label style="color: #b1b1b1; font-size: 13px; font-weight: 500; margin-bottom: 8px;">
                                JAM IZIN
                            </label>
                            <div class="jam-wrapper">
                                <div class="value small">{{ $izin->jam_mulai->format('H:i') }}</div>
                                <span class="arrow">→</span>
                                <div class="value small">{{ $izin->jam_selesai->format('H:i') }}</div>
                            </div>
                        </div>
                    </div>

                    <div class="col">
                        <div class="card-header-none">
                            <span class="card-number" style="color: #7ABAFF;">03.</span>
                            <span class="card-title" style="margin-bottom: 0px;">Informasi Guru</span>
                        </div>
                        <div class="row" style="margin-bottom: 20px; width: fit-content;">
                            <label style="color: #b1b1b1; font-size: 13px; font-weight: 500; margin-bottom: 8px;">
                                GURU BK
                            </label>
                            <div class="value guru">
                                <img src="{{ asset('images/guru cewe.png') }}" class="foto-guru">
                                <span>{{ $izin->approver_bk }}</span>
                            </div>
                        </div>

                        <div class="row" style="margin-bottom: 20px; width: fit-content;">
                            <label style="color: #b1b1b1; font-size: 13px; font-weight: 500; margin-bottom: 8px;">
                                GURU UMUM
                            </label>
                            <div class="value guru small">
                                <img src="{{ asset('images/guru cowo.png') }}" class="foto-guru">
                                <span>{{ $izin->approver_umum }}</span>
                            </div>
                        </div>
                    </div>

                </div>

            </div>

        </div>
        @endforeach

        @endif

    </div>

    <div class="section-item" data-status="disetujui">
        
        @if(count($pengajuanDisetujui) > 0)

        <div class="section-title" style="margin-top: 32px; font-size: 14px;">
            Perizinan Disetujui
        </div>

        @foreach($pengajuanDisetujui as $index => $izin)
        <div class="card-izinn">

            <div class="card-header-izin" data-index="izin-{{ $index }}" onclick="toggleCard(this)">

                <div class="left-header">

                    <img src="{{ asset('images/profile.png') }}" class="avatar">

                    <div>
                        <div class="tanggal">
                            {{ $izin->created_at->format('d M Y, H:i') }} WIB
                        </div>

                        <div class="nama-row">
                            <div class="nama">{{ $izin->nama }}</div>

                            <span class="badge siswa">SISWA</span>
                            <span class="badge sija">{{ $izin->jurusan }}</span>
                        </div>
                    </div>

                </div>

                <div class="action">
                    <span class="badge-status disetujui">
                        Perizinan Disetujui ✓
                    </span>
                    <span class="arrow" id="arrow-izin-{{ $index }}">⌄</span>
                </div>
            </div>

            <!-- BODY -->
            <div class="card-body" id="card-izin-{{ $index }}" style="display: none;">

                <hr class="line-data">

                <div class="grid">

                    <div class="col">
                        <div class="card-header-none">
                            <span class="card-number" style="color: #7ABAFF;">01.</span>
                            <span class="card-title" style="margin-bottom: 0px;">Data Siswa</span>
                        </div>
                        <div class="row" style="margin-bottom: 20px; width: fit-content;">
                            <label style="color: #b1b1b1; font-size: 13px; font-weight: 500; margin-bottom: 8px;">
                                NAMA
                            </label>
                            <div class="value" style="width: 100%;">{{ $izin->nama }}</div>
                        </div>

                        <div class="row" style="margin-bottom: 20px; width: fit-content;">
                            <label style="color: #b1b1b1; font-size: 13px; font-weight: 500; margin-bottom: 8px;">
                                NO URUT
                            </label>
                            <div class="value" style="text-align: center; width: 100%;">{{ $izin->no_presensi }}</div>
                        </div>

                        <div class="row" style="margin-bottom: 20px; width: fit-content;">
                            <label style="color: #b1b1b1; font-size: 13px; font-weight: 500; margin-bottom: 8px;">
                                KELAS
                            </label>
                            <div class="value" style="width: 100%;">
                                {{ [
                                    10 => 'X (10)',
                                    11 => 'XI (11)',
                                    12 => 'XII (12)',
                                    13 => 'XIII (13)'
                                ][$izin->kelas] ?? '-' }}
                            </div>
                        </div>

                        <div class="row" style="margin-bottom: 20px; width: fit-content;">
                            <label style="color: #b1b1b1; font-size: 13px; font-weight: 500; margin-bottom: 8px;">
                                JURUSAN
                            </label>
                            <div class="value" style="width: 100%;">{{ $izin->jurusan }}</div>
                        </div>
                    </div>

                    <div class="col">
                        <div class="card-header-none">
                            <span class="card-number" style="color: #7ABAFF;">02.</span>
                            <span class="card-title" style="margin-bottom: 0px;">Detail Izin</span>
                        </div>
                        <div class="row" style="margin-bottom: 20px; width: fit-content;">
                            <label style="color: #b1b1b1; font-size: 13px; font-weight: 500; margin-bottom: 8px;">
                                KEPERLUAN
                            </label>
                            <div class="value" style="width: 100%;">{{ $izin->keperluan }}</div>
                        </div>

                        <div class="row" style="margin-bottom: 20px; width: fit-content;">
                            <label style="color: #b1b1b1; font-size: 13px; font-weight: 500; margin-bottom: 8px;">
                                JAM IZIN
                            </label>
                            <div class="jam-wrapper">
                                <div class="value small">{{ $izin->jam_mulai->format('H:i') }}</div>
                                <span class="arrow">→</span>
                                <div class="value small">{{ $izin->jam_selesai->format('H:i') }}</div>
                            </div>
                        </div>
                    </div>

                    <div class="col">
                        <div class="card-header-none">
                            <span class="card-number" style="color: #7ABAFF;">03.</span>
                            <span class="card-title" style="margin-bottom: 0px;">Informasi Guru</span>
                        </div>
                        <div class="row" style="margin-bottom: 20px; width: fit-content;">
                            <label style="color: #b1b1b1; font-size: 13px; font-weight: 500; margin-bottom: 8px;">
                                GURU BK
                            </label>
                            <div class="value guru">
                                <img src="{{ asset('images/guru cewe.png') }}" class="foto-guru">
                                <span>{{ $izin->approver_bk }}</span>
                            </div>
                        </div>

                        <div class="row" style="margin-bottom: 20px; width: fit-content;">
                            <label style="color: #b1b1b1; font-size: 13px; font-weight: 500; margin-bottom: 8px;">
                                GURU UMUM
                            </label>
                            <div class="value guru small">
                                <img src="{{ asset('images/guru cowo.png') }}" class="foto-guru">
                                <span>{{ $izin->approver_umum }}</span>
                            </div>
                        </div>
                    </div>

                </div>

            </div>

        </div>
        @endforeach

        @endif

    </div>

    <div class="section-item" data-status="ditolak">

        @if(count($pengajuanDitolak) > 0)

        <div class="section-title" style="margin-top: 32px; font-size: 14px;">
            Perizinan Ditolak
        </div>

        @foreach($pengajuanDitolak as $index => $izin)
        <div class="card-izinn">

            <div class="card-header-izin" data-index="ditolak-{{ $index }}" onclick="toggleCard(this)">

                <div class="left-header">

                    <img src="{{ asset('images/profile.png') }}" class="avatar">

                    <div>
                        <div class="tanggal">{{ $izin->created_at->format('d M Y, H:i') }} WIB</div>

                        <div class="nama-row">
                            <div class="nama">{{ $izin->nama }}</div>

                            <span class="badge siswa">SISWA</span>
                            <span class="badge sija">{{ $izin->jurusan }}</span>
                        </div>
                    </div>

                </div>

                <div class="action">
                    <span class="badge-status ditolak">
                        Perizinan Ditolak ✕
                    </span>
                    <span class="arrow" id="arrow-ditolak-{{ $index }}">⌄</span>
                </div>
            </div>

            <!-- BODY -->
            <div class="card-body" id="card-ditolak-{{ $index }}" style="display: none;">

                <hr class="line-data">

                <div class="grid">

                    <div class="col">
                        <div class="card-header-none">
                            <span class="card-number" style="color: #7ABAFF;">01.</span>
                            <span class="card-title" style="margin-bottom: 0px;">Data Siswa</span>
                        </div>
                        <div class="row" style="margin-bottom: 20px; width: fit-content;">
                            <label style="color: #b1b1b1; font-size: 13px; font-weight: 500; margin-bottom: 8px;">
                                NAMA
                            </label>
                            <div class="value" style="width: 100%;">{{ $izin->nama }}</div>
                        </div>

                        <div class="row" style="margin-bottom: 20px; width: fit-content;">
                            <label style="color: #b1b1b1; font-size: 13px; font-weight: 500; margin-bottom: 8px;">
                                NO URUT
                            </label>
                            <div class="value" style="text-align: center; width: 100%;">{{ $izin->no_presensi }}</div>
                        </div>

                        <div class="row" style="margin-bottom: 20px; width: fit-content;">
                            <label style="color: #b1b1b1; font-size: 13px; font-weight: 500; margin-bottom: 8px;">
                                KELAS
                            </label>
                            <div class="value" style="width: 100%;">
                                {{ [
                                    10 => 'X (10)',
                                    11 => 'XI (11)',
                                    12 => 'XII (12)',
                                    13 => 'XIII (13)'
                                ][$izin->kelas] ?? '-' }}
                            </div>
                        </div>

                        <div class="row" style="margin-bottom: 20px; width: fit-content;">
                            <label style="color: #b1b1b1; font-size: 13px; font-weight: 500; margin-bottom: 8px;">
                                JURUSAN
                            </label>
                            <div class="value" style="width: 100%;">{{ $izin->jurusan }}</div>
                        </div>
                    </div>

                    <div class="col">
                        <div class="card-header-none">
                            <span class="card-number" style="color: #7ABAFF;">02.</span>
                            <span class="card-title" style="margin-bottom: 0px;">Detail Izin</span>
                        </div>
                        <div class="row" style="margin-bottom: 20px; width: fit-content;">
                            <label style="color: #b1b1b1; font-size: 13px; font-weight: 500; margin-bottom: 8px;">
                                KEPERLUAN
                            </label>
                            <div class="value" style="width: 100%;">{{ $izin->keperluan }}</div>
                        </div>

                        <div class="row" style="margin-bottom: 20px; width: fit-content;">
                            <label style="color: #b1b1b1; font-size: 13px; font-weight: 500; margin-bottom: 8px;">
                                JAM IZIN
                            </label>
                            <div class="jam-wrapper">
                                <div class="value small">{{ $izin->jam_mulai->format('H:i') }}</div>
                                <span class="arrow">→</span>
                                <div class="value small">{{ $izin->jam_selesai->format('H:i') }}</div>
                            </div>
                        </div>
                    </div>

                    <div class="col">
                        <div class="card-header-none">
                            <span class="card-number" style="color: #7ABAFF;">03.</span>
                            <span class="card-title" style="margin-bottom: 0px;">Informasi Guru</span>
                        </div>
                        <div class="row" style="margin-bottom: 20px; width: fit-content;">
                            <label style="color: #b1b1b1; font-size: 13px; font-weight: 500; margin-bottom: 8px;">
                                GURU BK
                            </label>
                            <div class="value guru">
                                <img src="{{ asset('images/guru cewe.png') }}" class="foto-guru">
                                <span>{{ $izin['approver_bk'] }}</span>
                            </div>
                        </div>

                        <div class="row" style="margin-bottom: 20px; width: fit-content;">
                            <label style="color: #b1b1b1; font-size: 13px; font-weight: 500; margin-bottom: 8px;">
                                GURU UMUM
                            </label>
                            <div class="value guru small">
                                <img src="{{ asset('images/guru cowo.png') }}" class="foto-guru">
                                <span>{{ $izin['approver_umum'] }}</span>
                            </div>
                        </div>
                    </div>

                </div>

            </div>

        </div>
        @endforeach

        @endif

    </div>


    <!-- modal -->
    <form action="{{ route('persetujuan-guru') }}" method="POST">
        @csrf
        <input type="hidden" name="id" id="id" value="">
        <div id="modal-tolak" class="modal-overlay" style="display:none;" onclick="closeModalTolak()">

            <div class="modal-box" onclick="event.stopPropagation()">

                <div class="modal-icon">
                    <div class="icon-line">
                        <div class="line-red"></div>

                        <div class="icon-box red">
                            <iconify-icon icon="iconoir:cancel"></iconify-icon>
                        </div>

                        <div class="line-red"></div>
                    </div>
                </div>

                <h2 class="modal-title">Tolak Pengajuan Izin?</h2>

                <p class="modal-desc">
                    Pengajuan izin akan ditolak dan tidak dapat diproses lebih lanjut.
                    Siswa dapat mengajukan kembali dengan data yang sesuai.
                </p>

                <div class="modal-actions">
                    <button type="button" class="btn-kembali" onclick="closeModalTolak()">Batal</button>
                    <button type="button" class="btn-submit" onclick="tolakIzin()" style="background:#F24141; color:#fff;">
                        Tolak Perizinan
                    </button>
                </div>

            </div>
        </div>

        <div id="modal-setuju" class="modal-overlay" style="display:none;" onclick="closeModalSetuju()">

            <div class="modal-box" onclick="event.stopPropagation()">

                <div class="modal-icon">
                    <div class="icon-line">
                        <div class="line-green"></div>

                        <div class="icon-box-green">
                            <iconify-icon icon="uim:check"></iconify-icon>
                        </div>

                        <div class="line-green"></div>
                    </div>
                </div>

                <h2 class="modal-title">Setujui Pengajuan Izin?</h2>

                <p class="modal-desc">
                    Pastikan data yang diajukan sudah sesuai sebelum memberikan persetujuan.
                </p>

                <div class="modal-actions">
                    <button type="button" class="btn-kembali" onclick="closeModalSetuju()">Batal</button>
                    <button type="submit" class="btn-submit" onclick="setujuiIzin()" style="background:#121212; border: 1px solid #3B3B3B; color:#fff;" name="jenis" value="1">
                        Setujui Perizinan
                    </button>
                </div>

            </div>
        </div>

        <div id="modal-catatan" class="modal-overlay" style="display:none;" onclick="closeModalCatatan()">

            <div class="modal-box" onclick="event.stopPropagation()">

                <div class="modal-icon">
                    <div class="icon-line">
                        <div class="line-red"></div>

                        <div class="icon-box red">
                            <iconify-icon icon="iconoir:cancel"></iconify-icon>
                        </div>

                        <div class="line-red"></div>
                    </div>
                </div>

                <h2 class="modal-title">Catatan Alasan Penolakan</h2>

                <p class="modal-desc" style="margin-bottom: 24px;">
                    Jelaskan alasan penolakan pengajuan izin agar siswa dapat memahami dan memperbaiki pengajuan berikutnya.
                </p>

                <textarea id="catatan-text" name="catatanPenolakan"
                    placeholder="Tulis alasan penolakan..."
                    style="width:100%; height:100px; margin-top:12px; margin-bottom: 40px;padding:10px; border-radius:8px;"></textarea>

                <div class="modal-actions">
                    <button type="button" class="btn-kembali" onclick="closeModalCatatan()">Batalkan</button>
                    <button type="submit" class="btn-submit" onclick="submitTolak()" style="background:#F24141; color:#fff;" name="jenis" value="0">
                        Tolak
                    </button>
                </div>

            </div>
        </div>
    </form>

@else

    <!-- EMPTY STATE -->
    <div class="empty-state-guru">
        <div class="empty-icon">
            <img src="{{ asset('images/no izin.png') }}" alt="izin">
        </div>
        <div class="empty-title">Belum Ada Pengajuan Izin</div>
        <div class="empty-desc">
            Ajukan izin melalui formulir untuk memulai proses perizinan.
        </div>
    </div>

@endif

@endsection

<script>
    document.addEventListener("DOMContentLoaded", function() {

        function toggleCard(el) {
            const index = el.getAttribute('data-index');

            const card = document.getElementById('card-' + index);
            const arrow = document.getElementById('arrow-' + index);

            const isHidden = window.getComputedStyle(card).display === "none";

            if (isHidden) {
                card.style.display = "block";
                arrow.style.transform = "rotate(180deg)";
            } else {
                card.style.display = "none";
                arrow.style.transform = "rotate(0deg)";
            }
        }

        window.toggleCard = toggleCard;

        const tabs = document.querySelectorAll('.tab');
        const items = document.querySelectorAll('.section-item');

        tabs.forEach(tab => {
            tab.addEventListener('click', () => {

                tabs.forEach(t => t.classList.remove('active'));
                tab.classList.add('active');

                const filter = tab.getAttribute('data-filter');

                items.forEach(item => {
                    if (filter === 'all') {
                        item.style.display = '';
                    } else {
                        item.style.display =
                            item.getAttribute('data-status') === filter ?
                            '' :
                            'none';
                    }
                });
            });
        });

        function openModalTolak(id) {
            document.getElementById("modal-tolak").style.display = "flex";
            document.getElementById('id').value = id;
        }

        function closeModalTolak() {
            document.getElementById("modal-tolak").style.display = "none";
        }

        function tolakIzin() {
            closeModalTolak();
            document.getElementById("modal-catatan").style.display = "flex";
        }

        function openModalSetuju(id) {
            document.getElementById("modal-setuju").style.display = "flex";
            document.getElementById('id').value = id;
        }

        function closeModalSetuju() {
            document.getElementById("modal-setuju").style.display = "none";
        }

        function setujuiIzin() {
            alert("Pengajuan disetujui!");
            closeModalSetuju();
        }

        function closeModalCatatan() {
            document.getElementById("modal-catatan").style.display = "none";
        }

        function submitTolak() {
            const catatan = document.getElementById("catatan-text").value;

            if (catatan.trim() === "") {
                alert("Alasan penolakan harus diisi!");
                return;
            }

            alert("Pengajuan ditolak dengan alasan:\n" + catatan);

            closeModalCatatan();
        }

        window.openModalTolak = openModalTolak;
        window.closeModalTolak = closeModalTolak;
        window.tolakIzin = tolakIzin;

        window.openModalSetuju = openModalSetuju;
        window.closeModalSetuju = closeModalSetuju;
        window.setujuiIzin = setujuiIzin;

        window.closeModalCatatan = closeModalCatatan;
        window.submitTolak = submitTolak;
    });
</script>