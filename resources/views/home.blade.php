@extends('layouts.app')

@section('content')
<div class="card shadow-sm">
    <div class="card-body text-center">

        <h4 class="mb-3">
            👋 Selamat Datang, {{ Auth::user()->name }}
        </h4>

        <p class="text-muted mb-4">
            Anda berhasil login ke Sistem Peminjaman Buku
        </p>

        <a href="{{ url('/') }}" class="btn btn-primary">
            📚 Lihat Daftar Buku
        </a>

    </div>
</div>
@endsection
