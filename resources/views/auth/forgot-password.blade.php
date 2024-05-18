@extends('layouts.guest')
@section('title', 'Forgot Password')

@section('content')
<main class="position-absolute top-50 start-50 translate-middle guest-form">
    <div class="d-flex flex-column my-4">
        <img src="{{ url('dev/image/logo.png') }}" alt="Logo AIDE" class="mx-auto">
        <h1 class="title fs-1 text-center">Lupa Kata Sandi</h1>
    </div>

    <form method="POST" action="{{ route('password.email') }}">
        @csrf
        <span>Masukkan alamat email untuk dikirim email konfirmasi untuk perbarui password anda</span>
        <div class="form-floating my-3">
            <input type="email" class="form-control" id="email" name="email" placeholder="Masukkan Alamat Email" value="{{ old('email') }}" required autofocus>
            <label for="email">Email</label>
            @error('email')
            <div class="alert alert-danger my-2" role="alert">
                {{ $errors->first('email') }}
            </div>
            @enderror
        </div>

        <div class="container">
            <div class="row justify-content-center align-items-center">
                <button type="submit" class="btn btn-primary w-100">Kirim Email Konfirmasi</button>
            </div>
        </div>
    </form>
    @if($status)
    <h5>Email Konfirmasi Telah Dikirim Silahkan Lihat Inbox atau Spam Email Anda</h5>
    @endif
</main>
@endsection