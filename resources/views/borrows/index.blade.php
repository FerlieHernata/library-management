@extends('layouts.app')

@section('content')
<div class="card shadow-sm">
    <div class="card-body">

        <h4 class="mb-3">📄 Riwayat Peminjaman Buku</h4>

        {{-- ALERT --}}
        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        @if($borrows->isEmpty())
            <div class="alert alert-info">
                Belum ada buku yang dipinjam.
            </div>
        @else
            <div class="table-responsive">
                <table class="table table-hover align-middle">
                    <thead class="table-light">
                        <tr>
                            <th>No</th>
                            <th>Judul Buku</th>
                            <th>Tanggal Pinjam</th>
                            <th>Tanggal Kembali</th>
                            <th>Status</th>
                            <th class="text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($borrows as $index => $b)
                        <tr>
                            <td>{{ $index + 1 }}</td>

                            <td class="fw-semibold">
                                {{ $b->book->title }}
                            </td>

                            <td>
                                {{ \Carbon\Carbon::parse($b->borrow_date)->format('d M Y') }}
                            </td>

                            <td>
                                {{ $b->return_date
                                    ? \Carbon\Carbon::parse($b->return_date)->format('d M Y')
                                    : '-' }}
                            </td>

                            <td>
                                @if($b->status === 'borrowed')
                                    <span class="badge bg-warning text-dark">
                                        Dipinjam
                                    </span>
                                @else
                                    <span class="badge bg-success">
                                        Dikembalikan
                                    </span>
                                @endif
                            </td>

                            <td class="text-center">
                                @if($b->status === 'borrowed')
                                    <form method="POST" action="{{ route('return', $b->id) }}">
                                        @csrf
                                        <button class="btn btn-sm btn-success">
                                            🔄 Kembalikan
                                        </button>
                                    </form>
                                @else
                                    <span class="text-muted">-</span>
                                @endif
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @endif

    </div>
</div>
@endsection
