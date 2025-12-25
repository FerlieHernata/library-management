@extends('layouts.app')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-6">

        <div class="card shadow-sm">
            <div class="card-body text-center">

                <h4 class="mb-3">
                    📧 Verifikasi Email
                </h4>

                {{-- SUCCESS ALERT --}}
                @if (session('resent'))
                    <div class="alert alert-success alert-dismissible fade show">
                        Link verifikasi baru telah dikirim ke email Anda.
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                @endif

                <p class="text-muted">
                    Sebelum melanjutkan, silakan periksa email Anda dan klik link verifikasi
                    yang telah dikirimkan.
                </p>

                <p class="mb-4 text-muted">
                    Jika Anda belum menerima email verifikasi,
                    klik tombol di bawah ini.
                </p>

                <form method="POST" action="{{ route('verification.resend') }}">
                    @csrf
                    <button type="submit" class="btn btn-primary">
                        🔄 Kirim Ulang Email Verifikasi
                    </button>
                </form>

            </div>
        </div>

    </div>
</div>
@endsection
