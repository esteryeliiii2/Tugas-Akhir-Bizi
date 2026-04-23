<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Surat Izin Keluar Siswa</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: "Times New Roman", Times, serif;
            font-size: 12pt;
            color: #111;
            padding: 32px 48px;
        }

        table {
            border-collapse: collapse;
            width: 100%;
        }

        img {
            max-width: 100%;
        }

        .kop {
            border-bottom: 4px double #111;
            margin-bottom: 16px;
            padding-bottom: 8px;
        }

        .kop td {
            vertical-align: middle;
        }

        .kop img {
            width: 70px;
        }

        .kop-text {
            text-align: center;
            line-height: 1.4;
        }

        .instansi {
            font-size: 10pt;
        }

        .dinas {
            font-size: 11pt;
            font-weight: bold;
        }

        .sekolah {
            font-size: 14pt;
            font-weight: bold;
        }

        .kota {
            font-size: 14pt;
            font-weight: bold;
        }

        .alamat {
            font-size: 9pt;
        }

        .judul {
            text-align: center;
            margin: 16px 0;
        }

        .judul h1 {
            font-size: 13pt;
            text-transform: uppercase;
            text-decoration: underline;
        }

        .nomor {
            font-size: 10pt;
            margin-top: 4px;
        }

        .meta-surat td {
            padding: 2px 0;
            font-size: 11pt;
        }

        .label {
            width: 110px;
        }

        .colon {
            width: 14px;
        }

        .section-box {
            border: 0.5px solid #bbb;
            margin-bottom: 12px;
        }

        .section-header {
            background: #e8e8e8;
            padding: 5px 10px;
            font-size: 10pt;
            font-weight: bold;
        }

        .section-body td {
            padding: 5px 10px;
            font-size: 11pt;
        }

        .penutup {
            margin: 14px 0 20px;
            line-height: 1.6;
        }

        .ttd {
            text-align: center;
            font-size: 11pt;
        }

        .ttd .nama {
            margin-top: 10px;
            margin-bottom: 4px;
            font-weight: bold;
            text-decoration: underline;
        }

        .stempel-wrapper {
            text-align: center;
            margin-top: -10px;
            margin-bottom: -20px;
        }

        .approve-img {
            width: 150px;
            opacity: 0.8;
        }
    </style>
</head>

<body>

    <div class="kop">
        <table>
            <tr>
                <td width="80" align="center">
                    @php
                    $logo = 'data:image/jpeg;base64,' . base64_encode(file_get_contents(public_path('images/logo_jawa_tengah.jpg')));
                    @endphp

                    <img src="{{ $logo }}">

                </td>
                <td align="center">
                    <div class="kop-text">
                        <div class="instansi">PEMERINTAH PROVINSI JAWA TENGAH</div>
                        <div class="dinas">DINAS PENDIDIKAN DAN KEBUDAYAAN</div>
                        <div class="sekolah">SEKOLAH MENENGAH KEJURUAN NEGERI 7</div>
                        <div class="kota">SEMARANG</div>
                        <div class="alamat">
                            Jalan Simpang Lima Kota Semarang Kode Pos 50243<br>
                            admin@smkn7semarang.sch.id
                        </div>
                    </div>
                </td>
                <td width="80"></td>
            </tr>
        </table>
    </div>

    <div class="judul">
        <h1>Surat Izin Keluar Siswa</h1>
        <div class="nomor">Nomor: {{ $izin->id }}/IZIN/SMKN7/{{ $izin->created_at->format('m/Y') }}</div>
    </div>

    <table class="meta-surat">
        <tr>
            <td class="label">Tanggal</td>
            <td class="colon">:</td>
            <td>{{ $izin->created_at->translatedFormat('d F Y') }}</td>
        </tr>
        <tr>
            <td class="label">Perihal</td>
            <td class="colon">:</td>
            <td><b>Permohonan Izin Keluar Siswa</b></td>
        </tr>
    </table>

    <div class="penutup">
        Berdasarkan persetujuan yang diberikan, siswa berikut diperkenankan untuk meninggalkan
        lingkungan sekolah pada waktu yang telah ditentukan.
    </div>

    <div class="section-box">
        <div class="section-header">Data Siswa</div>
        <table class="section-body">
            <tr>
                <td class="label">Nama</td>
                <td class="colon">:</td>
                <td><b>{{ $izin->nama }}</b></td>
            </tr>
            <tr>
                <td class="label">No. Urut</td>
                <td class="colon">:</td>
                <td>{{ $izin->no_presensi }}</td>
            </tr>
            <tr>
                <td class="label">Kelas</td>
                <td class="colon">:</td>
                <td>{{ [10=>'X (10)', 11=>'XI (11)', 12=>'XII (12)', 13=>'XIII (13)'][$izin->kelas] ?? $izin->kelas }}</td>
            </tr>
            <tr>
                <td class="label">Jurusan</td>
                <td class="colon">:</td>
                <td>{{ $izin->jurusan }}</td>
            </tr>
        </table>
    </div>

    <div class="section-box">
        <div class="section-header">Detail Izin</div>
        <table class="section-body">
            <tr>
                <td class="label">Keperluan</td>
                <td class="colon">:</td>
                <td>{{ $izin->keperluan }}</td>
            </tr>
            <tr>
                <td class="label">Jam Izin</td>
                <td class="colon">:</td>
                <td>
                    {{ $izin->jam_mulai ? \Carbon\Carbon::parse($izin->jam_mulai)->format('H:i') : '--:--' }}
                    -
                    {{ $izin->jam_selesai ? \Carbon\Carbon::parse($izin->jam_selesai)->format('H:i') : 'Tidak Kembali' }}
                    WIB
                </td>
            </tr>
        </table>
    </div>

    <div class="section-box">
        <div class="section-header">Informasi Guru</div>
        <table class="section-body">
            <tr>
                <td class="label">Guru BK</td>
                <td class="colon">:</td>
                <td>{{ $izin->approver_bk }}</td>
            </tr>
            <tr>
                <td class="label">Guru Umum</td>
                <td class="colon">:</td>
                <td>{{ $izin->approver_umum }}</td>
            </tr>
        </table>
    </div>

    <div class="penutup">
        Demikian surat izin ini diberikan. Harap kembali tepat waktu.
    </div>

    <table style="margin-top:40px;">
        <tr valign="top">
            <td width="33%"></td>
            <td width="33%"></td>
            <td width="33%" class="ttd" style="padding-top:20px;">
                Semarang, {{ $izin->created_at->translatedFormat('d F Y') }}

                <div class="stempel-wrapper">
                    @php
                    $approve = 'data:image/jpeg;base64,' . base64_encode(file_get_contents(public_path('images/approve.jpg')));
                    @endphp

                    <img src="{{ $approve }}" class="approve-img">
                </div>

                <div class="nama">{{ $izin->approver_bk }}</div>
                Guru BK
            </td>
        </tr>
    </table>

</body>

</html>