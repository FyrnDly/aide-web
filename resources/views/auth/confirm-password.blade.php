@extends('layouts.guest')
@section('title', 'Confirm Password')

@section('content')
<main class="position-absolute top-50 start-50 translate-middle guest-form">
    <div class="d-flex flex-column my-4">
        <img src="{{ url('dev/image/logo.png') }}" alt="Logo AIDE" class="mx-auto">
        <h1 class="title fs-1 text-center">Halmanan Konfirmasi AIDE</h1>
    </div>

    <form method="POST" action="{{ route('password.confirm') }}">
        @csrf
        <span>Konfirmasi Kata Sandi Anda Untuk Lanjut</span>
        <div class="form-floating mb-3">
            <input type="password" class="form-control" id="password" name="password" placeholder="Masukkan Kata Sandi" required autocomplete="current-password">
            <label for="password">Kata Sandi</label>
            @error('password')
            <small>{{ $errors->first('password') }}</small>
            @enderror
        </div>

        <div class="container">
            <div class="row justify-content-center align-items-center">
                <button type="submit" class="btn btn-primary w-100">Konfirmasi</button>
            </div>
        </div>
    </form>
</main>
@endsection