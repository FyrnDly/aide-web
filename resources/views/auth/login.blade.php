@extends('layouts.guest')
@section('title', 'Login')

@section('content')
<main class="position-absolute top-50 start-50 translate-middle guest-form">
	<div class="d-flex flex-column my-4">
		<img src="{{ url('dev/image/logo.png') }}" alt="Logo AIDE" class="mx-auto">
		<h1 class="title fs-1 text-center">Halmanan Masuk AIDE</h1>
	</div>

	<form method="POST" action="{{ route('login') }}">
		@csrf
		<span>Pastikan Alamat Email dan Kata Sandi yang dimasukkan sesuai untuk masuk</span>
		<div class="form-floating my-3">
		    <input type="email" class="form-control" id="email" name="email" placeholder="Masukkan Alamat Email" value="{{ old('email') }}" required autofocus autocomplete="username">
		    <label for="email">Email</label>
		    @error('email')
		    <small>{{ $errors->first('email') }}</small>
		    @enderror
		</div>

		<div class="form-floating mb-3">
		    <input type="password" class="form-control" id="password" name="password" placeholder="Masukkan Kata Sandi" required autocomplete="current-password">
		    <label for="password">Kata Sandi</label>
		    @error('password')
		    <small>{{ $errors->first('password') }}</small>
		    @enderror
		</div>

		<div class="container">
		    <div class="row justify-content-end align-items-center">
		        <a href="{{ route('register') }}">Tidak punya akun ?</a>
		        <button type="submit" class="btn btn-primary w-auto">Masuk</button>
		    </div>
		</div>
	</form>
</main>
@endsection