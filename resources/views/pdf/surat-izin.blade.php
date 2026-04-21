<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Surat Izin Keluar Siswa</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Times New Roman', Times, serif;
            font-size: 12pt;
            color: #111;
            background: white;
            padding: 32px 48px;
        }

        /* ── KOP SURAT ── */
        .kop {
            display: flex;
            align-items: center;
            gap: 16px;
            padding-bottom: 8px;
            border-bottom: 4px double #111;
            margin-bottom: 16px;
        }

        .kop img {
            width: 72px;
            height: 72px;
            object-fit: contain;
        }

        .kop-text {
            flex: 1;
            text-align: center;
            line-height: 1.4;
        }

        .kop-text .instansi {
            font-size: 10pt;
        }

        .kop-text .dinas {
            font-size: 11pt;
            font-weight: bold;
        }

        .kop-text .sekolah {
            font-size: 14pt;
            font-weight: bold;
        }

        .kop-text .kota {
            font-size: 14pt;
            font-weight: bold;
        }

        .kop-text .alamat {
            font-size: 9pt;
            margin-top: 2px;
        }

        /* ── JUDUL ── */
        .judul {
            text-align: center;
            margin: 16px 0 14px;
        }

        .judul h1 {
            font-size: 13pt;
            font-weight: bold;
            text-transform: uppercase;
            text-decoration: underline;
            letter-spacing: 1px;
        }

        .judul .nomor {
            font-size: 10pt;
            margin-top: 4px;
            color: #444;
        }

        /* ── META SURAT ── */
        .meta-surat {
            margin-bottom: 14px;
        }

        .meta-surat table {
            width: 100%;
            border-collapse: collapse;
        }

        .meta-surat td {
            padding: 2px 0;
            font-size: 11pt;
            vertical-align: top;
        }

        .meta-surat .label {
            width: 110px;
            color: #444;
        }

        .meta-surat .colon {
            width: 14px;
        }

        /* ── KALIMAT PEMBUKA ── */
        .pembuka {
            margin-bottom: 14px;
            font-size: 11pt;
            line-height: 1.6;
        }

        /* ── SECTION BOX ── */
        .section-box {
            border: 0.5px solid #bbb;
            border-radius: 4px;
            margin-bottom: 12px;
            overflow: hidden;
        }

        .section-header {
            background: #e8e8e8;
            padding: 5px 12px;
            font-size: 9.5pt;
            font-weight: bold;
            letter-spacing: 0.6px;
            text-transform: uppercase;
            color: #333;
        }

        .section-body table {
            width: 100%;
            border-collapse: collapse;
        }

        .section-body td {
            padding: 5px 12px;
            font-size: 11pt;
            vertical-align: top;
        }

        .section-body .label {
            width: 120px;
            color: #555;
        }

        .section-body .colon {
            width: 14px;
        }

        .section-body .value {
            font-weight: normal;
        }

        /* ── PENUTUP ── */
        .penutup {
            font-size: 11pt;
            line-height: 1.6;
            margin: 14px 0 20px;
        }

        /* ── BAGIAN BAWAH: QR + STEMPEL ── */
        .footer-area {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            margin-top: 8px;
        }

        /* QR Code */
        .qr-area {
            text-align: center;
            width: 140px;
        }

        .qr-label {
            font-size: 9pt;
            color: #555;
            margin-bottom: 6px;
        }

        .qr-box {
            width: 108px;
            height: 108px;
            border: 1.5px solid #333;
            margin: 0 auto;
            display: flex;
            align-items: center;
            justify-content: center;
            background: #fff;
        }

        .qr-box img {
            width: 100px;
            height: 100px;
        }

        .qr-token {
            font-size: 8pt;
            color: #888;
            margin-top: 5px;
            word-break: break-all;
        }

        /* Stempel */
        .stempel-area {
            text-align: center;
            width: 140px;
        }

        .stempel {
            width: 200px;
            height: 200px;
            border: 3px solid #1a5c2e;
            border-radius: 50%;
            margin: 0 auto;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            background: rgba(26, 92, 46, 0.05);
            position: relative;
        }

        .stempel::before {
            content: '';
            position: absolute;
            top: 5px;
            left: 5px;
            right: 5px;
            bottom: 5px;
            border: 1px dashed #1a5c2e;
            border-radius: 50%;
        }

        .stempel-disetujui {
            font-size: 8pt;
            font-weight: bold;
            color: #1a5c2e;
            letter-spacing: 1px;
            text-transform: uppercase;
        }

        .stempel-check {
            font-size: 22pt;
            color: #1a5c2e;
            line-height: 1;
            margin: 2px 0;
        }

        .stempel-nama-sekolah {
            font-size: 7.5pt;
            font-weight: bold;
            color: #1a5c2e;
            text-align: center;
            line-height: 1.3;
        }

        .stempel-tanggal {
            font-size: 8.5pt;
            color: #555;
            margin-top: 6px;
        }

        /* Info approve */
        .approve-info {
            text-align: center;
            width: 180px;
            font-size: 10.5pt;
        }

        .approve-info .kota-tgl {
            margin-bottom: 4px;
        }

        .approve-info .disetujui-oleh {
            font-size: 9.5pt;
            color: #555;
            margin-bottom: 32px;
        }

        .approve-info .nama-guru {
            font-weight: bold;
            text-decoration: underline;
        }

        .approve-info .jabatan {
            font-size: 10pt;
        }

        .approve-wrapper {
            position: relative;
            width: 200px;
            margin: 0 auto;
            text-align: center;
        }

        .stempel-overlay {
            position: absolute;
            top: -40px;
            /* naik ke atas */
            left: 50%;
            transform: translateX(-50%);
            opacity: 0.9;
        }
    </style>
</head>

<body>

    {{-- ── KOP SURAT ── --}}
    <div class="kop">
        <img
            src="https://upload.wikimedia.org/wikipedia/commons/thumb/6/6e/Lambang_Provinsi_Jawa_Tengah.svg/120px-Lambang_Provinsi_Jawa_Tengah.svg.png"
            alt="Logo Jawa Tengah" />
        <div class="kop-text">
            <div class="instansi">PEMERINTAH PROVINSI JAWA TENGAH</div>
            <div class="dinas">DINAS PENDIDIKAN DAN KEBUDAYAAN</div>
            <div class="sekolah">SEKOLAH MENENGAH KEJURUAN NEGERI 7</div>
            <div class="kota">SEMARANG</div>
            <div class="alamat">
                Jalan Simpang Lima Kota Semarang Kode Pos 50243 Telepon (024)8311532<br>
                Pos-el admin@smkn7semarang.sch.id &nbsp; Laman www.smkn7semarang.sch.id
            </div>
        </div>
    </div>

    {{-- ── JUDUL ── --}}
    <div class="judul">
        <h1>Surat Izin Keluar Siswa</h1>
        {{-- Uncomment jika sudah ada data: --}}
        {{-- <div class="nomor">Nomor: {{ $izin->nomor_surat }}
    </div> --}}
    <div class="nomor">Nomor: 001/IZIN/SMKN7/III/2026</div>
    </div>

    {{-- ── META SURAT ── --}}
    <div class="meta-surat">
        <table>
            <tr>
                <td class="label">Tanggal</td>
                <td class="colon">:</td>
                {{-- <td>{{ \Carbon\Carbon::parse($izin->created_at)->translatedFormat('d F Y') }}</td> --}}
                <td>16 Maret 2026</td>
            </tr>
            <tr>
                <td class="label">Perihal</td>
                <td class="colon">:</td>
                <td><strong>Permohonan Izin Keluar Siswa</strong></td>
            </tr>
        </table>
    </div>

    {{-- ── PEMBUKA ── --}}
    <div class="pembuka">
        Yang bertanda tangan di bawah ini menerangkan bahwa siswa berikut telah mendapatkan
        izin untuk meninggalkan lingkungan sekolah pada waktu yang telah ditentukan.
    </div>

    {{-- ── DATA SISWA ── --}}
    <div class="section-box">
        <div class="section-header">Data Siswa</div>
        <div class="section-body">
            <table>
                <tr>
                    <td class="label">Nama</td>
                    <td class="colon">:</td>
                    {{-- <td class="value" style="font-weight:bold;">{{ $izin->nama_siswa }}</td> --}}
                    <td class="value" style="font-weight:bold;">Nicholas Daniel Raditya</td>
                </tr>
                <tr>
                    <td class="label">No. Urut</td>
                    <td class="colon">:</td>
                    {{-- <td class="value">{{ $izin->no_urut }}</td> --}}
                    <td class="value">27</td>
                </tr>
                <tr>
                    <td class="label">Kelas</td>
                    <td class="colon">:</td>
                    {{-- <td class="value">{{ $izin->kelas }}</td> --}}
                    <td class="value">XIII (13)</td>
                </tr>
                <tr>
                    <td class="label">Jurusan</td>
                    <td class="colon">:</td>
                    {{-- <td class="value">{{ $izin->jurusan }}</td> --}}
                    <td class="value">SIJA</td>
                </tr>
            </table>
        </div>
    </div>

    {{-- ── DETAIL IZIN ── --}}
    <div class="section-box">
        <div class="section-header">Detail Izin</div>
        <div class="section-body">
            <table>
                <tr>
                    <td class="label">Keperluan</td>
                    <td class="colon">:</td>
                    {{-- <td class="value">{{ $izin->keperluan }}</td> --}}
                    <td class="value">Cap 3 jari ijazah SMP di SMPN 1 Semarang</td>
                </tr>
                <tr>
                    <td class="label">Jam Izin</td>
                    <td class="colon">:</td>
                    {{-- <td class="value">{{ $izin->jam_izin }} s.d. {{ $izin->jam_kembali }} WIB</td> --}}
                    <td class="value">11:00 s.d. 13:00 WIB</td>
                </tr>
            </table>
        </div>
    </div>

    {{-- ── INFORMASI GURU ── --}}
    <div class="section-box">
        <div class="section-header">Informasi Guru</div>
        <div class="section-body">
            <table>
                <tr>
                    <td class="label">Guru BK</td>
                    <td class="colon">:</td>
                    {{-- <td class="value">{{ $izin->guru_bk }}</td> --}}
                    <td class="value">Retno Yolanda, S.Pd.</td>
                </tr>
                <tr>
                    <td class="label">Guru Umum</td>
                    <td class="colon">:</td>
                    {{-- <td class="value">{{ $izin->guru_umum }}</td> --}}
                    <td class="value">Agus Setyawan, S.Pd.</td>
                </tr>
            </table>
        </div>
    </div>

    {{-- ── PENUTUP ── --}}
    <div class="penutup">
        Demikian surat izin ini diberikan untuk dapat dipergunakan sebagaimana mestinya.
        Harap kembali ke sekolah tepat waktu sesuai dengan jam izin yang telah ditentukan.
    </div>

    {{-- ── FOOTER: QR + STEMPEL + APPROVE INFO ── --}}
    <table width="100%" style="margin-top:10px;">
        <tr>

            <!-- QR -->
            <td width="33%" align="center" valign="top">
                <div class="qr-area">
                    <div class="qr-label">Scan untuk verifikasi:</div>
                    <div class="qr-box">
                        <img src="https://api.qrserver.com/v1/create-qr-code/?size=100x100&data=DUMMY-TOKEN-12345">
                    </div>
                    <div class="qr-token">DUMMY-TOKEN-12345</div>
                </div>
            </td>

            <!-- STEMPEL + NAMA -->
            <td width="33%" align="center" valign="top">

                <div class="approve-wrapper">

                    <!-- STEMPEL (overlay / numpuk) -->
                    <div class="stempel stempel-overlay">
                        <div class="stempel-disetujui">Disetujui</div>
                        <div class="stempel-disetujui">Retno Yolanda, S.Pd.</div>
                        <div class="stempel-check">✓</div>
                        <div class="stempel-nama-sekolah">
                            SMKN 7<br>SEMARANG
                        </div>
                    </div>

                    <!-- NAMA (di bawah, ketiban stempel) -->
                    <!-- <div style="margin-top:80px;">
                        <div style="font-weight:bold; text-decoration:underline;">
                            Retno Yolanda, S.Pd.
                        </div>
                        <div>Guru Bimbingan Konseling</div>
                    </div> -->

                </div>

            </td>

            <!-- KOSONG / OPSIONAL -->
            <td width="33%"></td>

        </tr>
    </table>

</body>

</html>