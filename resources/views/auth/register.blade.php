@extends('layouts.auth')
@section('title', 'Register')

@section('content')
	<div class="d-flex flex-column my-4">
		<img src="{{ url('dev/image/logo.png') }}" alt="Logo AIDE" class="mx-auto">
		<h1 class="title fs-1 text-center">Halaman Daftar AIDE</h1>
	</div>

	<form method="POST" action="{{ route('register') }}">
		@csrf
		<span>Isi form pendaftaran sesuai data diri anda</span>
		<div class="form-floating mb-3">
			<input type="text" class="form-control" id="name" name="name" placeholder="Masukkan Nama Lengkap Anda" value="{{ old('name') }}" required autofocus autocomplete="name">
			<label for="name">Nama</label>
			@error('name')
			<div class="alert alert-danger my-2" role="alert">
			    {{ $errors->first('name') }}
			</div>
			@enderror
		</div>

		<div class="form-floating mb-3">
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
			<input type="password" class="form-control" id="password_confirmation" name="password_confirmation" placeholder="Masukkan Kembali Kata Sandi" required autocomplete="new-password_confirmation">
			<label for="password_confirmation">Konfirmasi Kata Sandi</label>
			@error('password_confirmation')
			<div class="alert alert-danger my-2" role="alert">
			    {{ $errors->first('password_confirmation') }}
			</div>
			@enderror
		</div>

		<div class="container">
			<div class="row justify-content-end align-items-center">
				<a href="{{ route('login') }}">Sudah punya akun ?</a>
				<button type="submit" class="btn btn-primary w-auto">Daftar</button>
			</div>
		</div>
	</form>
@endsection