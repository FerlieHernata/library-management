@extends('layouts.app')

@section('content')
<div class="card shadow-sm">
    <div class="card-body">

        <h4 class="mb-4">➕ Tambah Buku Baru</h4>

        {{-- ERROR VALIDATION --}}
        @if ($errors->any())
            <div class="alert alert-danger alert-dismissible fade show">
                <ul class="mb-0">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        <form method="POST" action="{{ route('books.store') }}">
            @csrf

            <div class="row mb-3">
                <label class="col-md-3 col-form-label">Judul Buku</label>
                <div class="col-md-9">
                    <input type="text"
                           name="title"
                           class="form-control"
                           placeholder="Masukkan judul buku"
                           value="{{ old('title') }}"
                           required>
                </div>
            </div>

            <div class="row mb-3">
                <label class="col-md-3 col-form-label">Penulis</label>
                <div class="col-md-9">
                    <input type="text"
                           name="author"
                           class="form-control"
                           placeholder="Masukkan nama penulis"
                           value="{{ old('author') }}"
                           required>
                </div>
            </div>

            <div class="row mb-3">
                <label class="col-md-3 col-form-label">Kategori</label>
                <div class="col-md-9">
                    <input type="text"
                           name="category"
                           class="form-control"
                           placeholder="Contoh: Programming, Novel"
                           value="{{ old('category') }}"
                           required>
                </div>
            </div>

            <div class="row mb-3">
                <label class="col-md-3 col-form-label">Tahun Terbit</label>
                <div class="col-md-9">
                    <input type="number"
                           name="year"
                           class="form-control"
                           placeholder="Contoh: 2022"
                           value="{{ old('year') }}"
                           required>
                </div>
            </div>

            <div class="row mb-4">
                <label class="col-md-3 col-form-label">Stok</label>
                <div class="col-md-9">
                    <input type="number"
                           name="stock"
                           class="form-control"
                           placeholder="Jumlah stok buku"
                           value="{{ old('stock') }}"
                           required>
                </div>
            </div>

            <div class="d-flex justify-content-between">
                <a href="{{ url('/') }}" class="btn btn-secondary">
                    ⬅ Kembali
                </a>

                <button type="submit" class="btn btn-success">
                    💾 Simpan Buku
                </button>
            </div>
        </form>

    </div>
</div>
@endsection
