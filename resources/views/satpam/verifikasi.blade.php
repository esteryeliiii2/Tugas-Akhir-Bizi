<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">

<!-- WAJIB BIAR RESPONSIVE -->
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>Verifikasi Izin</title>

<link rel="stylesheet" href="/css/style.css">

<style>
/* khusus halaman ini aja */
.verify-card {
    max-width: 420px;
    margin: auto;
    text-align: center;
    padding: 40px;
}

.file-icon {
    width: 80px;
    height: 80px;
    border-radius: 16px;
    background: #f4f4f4;
    display: flex;
    align-items: center;
    justify-content: center;
    margin: auto;
    border: 1px solid #e8e8e8;
    font-size: 32px;
}

/* MOBILE FIX */
@media (max-width: 768px) {

    .content {
        margin: 0;
        padding: 16px;
    }

    .verify-card {
        padding: 24px;
        border-radius: 14px;
    }

    .btn-primary {
        width: 100%;
    }

    .modal-box {
        width: 90%;
        padding: 24px;
    }
}
</style>

</head>

<body>

<div class="content">

    <!-- HEADER -->
    <div class="page-header">
        <div class="page-title">Verifikasi Izin</div>
        <div class="page-desc">Lihat surat dan lakukan ACC</div>
    </div>

    <!-- CARD -->
    <div class="card verify-card">

        <!-- ICON -->
        <div style="margin-bottom:20px;">
            <div class="file-icon">📄</div>
        </div>

        <!-- TITLE -->
        <div style="font-weight:600; margin-bottom:8px;">
            Surat Izin
        </div>

        <div class="page-desc" style="margin-bottom:20px;">
            Klik untuk melihat dokumen
        </div>

        <!-- BUTTON PDF -->
        <a href="/surat/{{ $izin->token }}/pdf" target="_blank" class="btn-primary">
            Buka PDF
        </a>

        <!-- STATUS -->
        <!-- <div style="margin-top:20px;">
            @if($izin->status == 10)
                <div class="badge-status ditolak">SUDAH DIGUNAKAN ❌</div>
            @else
                <div class="badge-status disetujui">BELUM DI ACC ✅</div>
            @endif
        </div> -->

        <!-- BUTTON ACC -->
        @if($izin->status != 10)
            <div style="margin-top:16px;">
                <button class="btn-primary" onclick="openModal()">
                    ACC SATPAM
                </button>
            </div>
        @endif

    </div>

</div>


<!-- MODAL -->
<div id="modal" class="modal-overlay">
    <div class="modal-box">

        <div class="modal-title">Konfirmasi ACC</div>

        <div class="modal-desc">
            Setelah di ACC, surat tidak bisa digunakan lagi.
        </div>

        <div class="modal-actions">
            <form action="/verifikasi/{{ $izin->token }}" method="POST">
                @csrf
                <button class="btn-primary">Ya, ACC</button>
            </form>

            <button class="btn-secondary" onclick="closeModal()">Batal</button>
        </div>

    </div>
</div>

<script>
function openModal() {
    document.getElementById("modal").style.display = "flex";
}

function closeModal() {
    document.getElementById("modal").style.display = "none";
}
</script>

</body>
</html>