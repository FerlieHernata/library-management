@extends('layouts.app')

@section('content')
<div class="card shadow-sm">
    <div class="card-body">

        <h4 class="mb-4">✏️ Edit Data Buku</h4>

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

        <form method="POST" action="{{ route('books.update', $book->id) }}">
            @csrf
            @method('PUT')

            <div class="row mb-3">
                <label class="col-md-3 col-form-label">Judul Buku</label>
                <div class="col-md-9">
                    <input type="text"
                           name="title"
                           class="form-control"
                           value="{{ old('title', $book->title) }}"
                           required>
                </div>
            </div>

            <div class="row mb-3">
                <label class="col-md-3 col-form-label">Penulis</label>
                <div class="col-md-9">
                    <input type="text"
                           name="author"
                           class="form-control"
                           value="{{ old('author', $book->author) }}"
                           required>
                </div>
            </div>

            <div class="row mb-3">
                <label class="col-md-3 col-form-label">Kategori</label>
                <div class="col-md-9">
                    <input type="text"
                           name="category"
                           class="form-control"
                           value="{{ old('category', $book->category) }}"
                           required>
                </div>
            </div>

            <div class="row mb-3">
                <label class="col-md-3 col-form-label">Tahun Terbit</label>
                <div class="col-md-9">
                    <input type="number"
                           name="year"
                           class="form-control"
                           value="{{ old('year', $book->year) }}"
                           required>
                </div>
            </div>

            <div class="row mb-4">
                <label class="col-md-3 col-form-label">Stok</label>
                <div class="col-md-9">
                    <input type="number"
                           name="stock"
                           class="form-control"
                           value="{{ old('stock', $book->stock) }}"
                           required>
                </div>
            </div>

            <div class="d-flex justify-content-between">
                <a href="{{ url('/') }}" class="btn btn-secondary">
                    ⬅ Kembali
                </a>

                <button type="submit" class="btn btn-success">
                    💾 Update Buku
                </button>
            </div>
        </form>

    </div>
</div>
@endsection
