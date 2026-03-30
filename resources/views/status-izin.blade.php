@extends('layouts.app')

@section('content')

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

        <a href="{{ route('ajukan-izin') }}" class="empty-btn">
            Ajukan Izin
        </a>

    </div>
</div>

@endsection