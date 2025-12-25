@extends('layouts.app')

@section('content')
<div class="card shadow-sm">
    <div class="card-body">

        <div class="d-flex justify-content-between align-items-center mb-3">
            <h4 class="mb-0">📚 Daftar Buku</h4>

            {{-- HANYA ADMIN --}}
            @if(auth()->user()->role === 'admin')
                <a href="{{ route('books.create') }}" class="btn btn-primary">
                    ➕ Tambah Buku
                </a>
            @endif
        </div>

        {{-- ALERT --}}
        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        @if(session('error'))
            <div class="alert alert-danger alert-dismissible fade show">
                {{ session('error') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        {{-- SEARCH & FILTER --}}
        <form method="GET" action="{{ url('/') }}" class="row g-2 mb-3">
            <div class="col-md-5">
                <input type="text"
                       name="search"
                       class="form-control"
                       placeholder="🔍 Cari judul atau penulis"
                       value="{{ request('search') }}">
            </div>

            <div class="col-md-3">
                <select name="filter" class="form-select">
                    <option value="">Semua Buku</option>
                    <option value="available" {{ request('filter')=='available' ? 'selected' : '' }}>
                        Stok Tersedia
                    </option>
                    <option value="empty" {{ request('filter')=='empty' ? 'selected' : '' }}>
                        Stok Habis
                    </option>
                </select>
            </div>

            <div class="col-md-2">
                <button class="btn btn-primary w-100">
                    Cari
                </button>
            </div>
        </form>

        {{-- TABLE --}}
        <div class="table-responsive">
            <table class="table table-hover align-middle">
                <thead class="table-light">
                    <tr>
                        <th>No</th>
                        <th>Judul</th>
                        <th>Penulis</th>
                        <th>Stok</th>
                        <th class="text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($books as $index => $book)
                    <tr>
                        <td>{{ $index + 1 }}</td>

                        <td class="fw-semibold">
                            {{ $book->title }}
                        </td>

                        <td>
                            {{ $book->author }}
                        </td>

                        <td>
                            @if($book->stock > 0)
                                <span class="badge bg-success">
                                    Tersedia ({{ $book->stock }})
                                </span>
                            @else
                                <span class="badge bg-danger">
                                    Habis
                                </span>
                            @endif
                        </td>

                        <td class="text-center">

                            {{-- USER --}}
                            @if(auth()->user()->role === 'user')
                                @if($book->stock > 0)
                                    <form action="{{ route('borrow', $book->id) }}"
                                          method="POST"
                                          class="d-inline">
                                        @csrf
                                        <button class="btn btn-sm btn-success">
                                            📥 Pinjam
                                        </button>
                                    </form>
                                @else
                                    <span class="text-muted">-</span>
                                @endif
                            @endif

                            {{-- ADMIN --}}
                            @if(auth()->user()->role === 'admin')
                                <a href="{{ route('books.edit', $book->id) }}"
                                   class="btn btn-sm btn-warning">
                                    ✏️ Edit
                                </a>

                                <form action="{{ route('books.destroy', $book->id) }}"
                                      method="POST"
                                      class="d-inline"
                                      onsubmit="return confirm('Yakin ingin menghapus buku ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-sm btn-danger">
                                        🗑 Hapus
                                    </button>
                                </form>
                            @endif

                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="text-center text-muted">
                            Tidak ada data buku.
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

    </div>
</div>
@endsection
