@extends('layouts.auth')
@section('title', 'Reset Password')

@section('content')
    <div class="d-flex flex-column my-4">
        <img src="{{ url('dev/image/logo.png') }}" alt="Logo AIDE" class="mx-auto">
        <h1 class="title fs-1 text-center">Perbarui Kata Sandi AIDE</h1>
    </div>

    <form method="POST" action="{{ route('password.store') }}">
        @csrf
        <!-- Password Reset Token -->
        <input type="hidden" name="token" value="{{ $request->route('token') }}">

        <span>Masukkan Kata Sandi Baru Untuk Akun Anda</span>
        <div class="form-floating my-3">
            <input type="email" class="form-control" id="email" name="email" placeholder="Masukkan Alamat Email" value="{{ old('email') }}" required autofocus autocomplete="username">
            <label for="email">Email</label>
            @error('email')
            <div class="alert alert-danger my-2" role="alert">
                {{ $errors->first('email') }}
            </div>
            @enderror
        </div>

        <div class="form-floating mb-3">
            <input type="password" class="form-control" id="password" name="password" placeholder="Masukkan Kata Sandi" required autocomplete="new-password">
            <label for="password">Kata Sandi</label>
            @error('password')
		    <div class="alert alert-danger my-2" role="alert">
		        {{ $errors->first('password') }}
		    </div>
            @enderror
        </div>

        <div class="form-floating mb-3">
            <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" placeholder="Masukkan Kata Sandi" required autocomplete="new-password">
            <label for="password_confirmation">Kata Sandi</label>
            @error('password_confirmation')
            <div class="alert alert-danger my-2" role="alert">
                {{ $errors->first('password_confirmation') }}
            </div>
            @enderror
        </div>

        <div class="container">
            <div class="row justify-content-center align-items-center">
                <button type="submit" class="btn btn-primary w-100">Perbarui Kata Sandi</button>
            </div>
        </div>
    </form>
    @if(session('status') == 'verification-link-sent')
    <h5>Email Verifikasi yang Baru Telah Dikirim Silahkan Cek Inbox atau Spam</h5>
    @endif
@endsection