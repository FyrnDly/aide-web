@extends('layouts.guest')
@section('title', 'Verify Email')

@section('content')
<main class="position-absolute top-50 start-50 translate-middle guest-form">
    <div class="d-flex flex-column my-4">
        <img src="{{ url('dev/image/logo.png') }}" alt="Logo AIDE" class="mx-auto">
        <h1 class="title fs-1 text-center">Verifikasi Email AIDE</h1>
    </div>

    <form method="POST" action="{{ route('verification.send') }}">
        @csrf
        <span>Terima Kasih Telah Melakukan Login Silahkan Cek Inbox atau Spam Email Anda Untuk Verifikasi Akun</span>
        <div class="container">
            <div class="row justify-content-center align-items-center">
                <button type="submit" class="btn btn-primary w-100">Kirim Ulang Email Verifikasi</button>
            </div>
        </div>
    </form>
</main>
@endsection