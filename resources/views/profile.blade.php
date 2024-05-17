@extends('layouts.app')
@section('title', 'Profil '.$user->name)

@section('main')
<div class="row mt-5 pt-5 justify-content-center align-items-stretch">
    <div class="col-lg-6 col-md-8 p-lg-4 my-4">
        <section class="w-100 h-100 guest-form">
            <div class="d-flex flex-column my-4">
                <h1 class="title fs-1 text-center">Informasi Profil</h1>
                <span>Perbarui Informasi Profil Akun {{ $user->name }}</span>
            </div>

            <form id="send-verification" method="post" action="{{ route('verification.send') }}">
                @csrf
            </form>

            <form method="POST" action="{{ route('profile.update') }}">
                @csrf
                @method('patch')
                <div class="form-floating mb-3">
                    <input type="text" class="form-control" id="name" name="name" value="{{ old('name', $user->name) }}" required autofocus autocomplete="name">
                    <label for="name">Nama</label>
                    @error('name')
                    <small>{{ $errors->first('name') }}</small>
                    @enderror
                </div>

                <div class="form-floating mb-3">
                    <input type="email" class="form-control" id="email" name="email" placeholder="Masukkan Alamat Email" value="{{ old('email', $user->email) }}" required autofocus autocomplete="username" @disabled($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! $user->hasVerifiedEmail())>
                    <label for="email">Email</label>
                    @error('email')
                    <small>Pastikan Alamat Email Baru Anda Belum Terdaftar</small>
                    @enderror
                    @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! $user->hasVerifiedEmail())
                    <div class="d-flex align-items-center">
                        <span>Email Belum diverifikasi</span>
                        <button class="ms-auto btn btn-primary w-auto fs-5 mt-2" form="send-verification">Kirim Email Verifikasi</button>
                    </div>
                    @if(session('status') === 'verification-link-sent')
                    <span class="fs-5">Email Verifikasi Baru Saja Terkirim, Silahkan Cek Inbox atau Spam</span>
                    @endif
                    @endif
                </div>

                <div class="container">
                    <div class="row justify-content-end align-items-center">
                        @if(session('status') === 'profile-updated')
                        <span class="fs-5 w-auto">Profil Berhasil Diperbarui</span>
                        @endif
                        <button type="submit" class="btn btn-primary w-auto">Perbarui Profil</button>
                    </div>
                </div>
            </form>
        </section>
    </div>

    <div class="col-lg-6 col-md-8 p-lg-4 my-4">
        <section class="w-100 h-100 guest-form">
            <div class="d-flex flex-column my-4">
                <h1 class="title fs-1 text-center">Perbarui Kata Sandi</h1>
            </div>

            <form method="post" action="{{ route('password.update') }}">
                @csrf
                @method('put')
                <div class="form-floating mb-3">
                    <input type="password" class="form-control" id="update_password_current_password" name="current_password" placeholder="Masukkan Kata Sandi Saat Ini Digunakan" required autofocus autocomplete="current_password">
                    <label for="update_password_current_password">Kata Sandi Saat Ini</label>
                    @if($errors->updatePassword->get('current_password'))
                    <small>Pastikan Kata Sandi Saat Ini Telah Sesuai</small>
                    @endif
                </div>

                <div class="form-floating mb-3">
                    <input type="password" class="form-control" id="update_password_password" name="password" placeholder="Masukkan Kata Sandi Baru" required autofocus autocomplete="new-password">
                    <label for="update_password_password">Kata Sandi Baru</label>
                    @if($errors->updatePassword->get('password'))
                    <small>Kata Sandi Konfirmasi Tidak Sesuai </small>
                    @endif
                </div>

                <div class="form-floating mb-3">
                    <input type="password" class="form-control" id="update_password_password_confirmation" name="password_confirmation" placeholder="Masukkan Kata Sandi Baru Kembali" required autofocus autocomplete="new-password">
                    <label for="update_password_password_confirmation">Konfirmasi Kata Sandi</label>
                </div>

                <div class="container">
                    <div class="row justify-content-end align-items-center">
                        @if(session('status') === 'password-updated')
                        <span class="fs-5 w-auto">Kata Sandi Berhasil Diperbarui</span>
                        @endif
                        <button type="submit" class="btn btn-primary w-auto">Ubah Kata Sandi</button>
                    </div>
                </div>
            </form>
        </section>
    </div>

    <div class="col-lg-6 col-md-8 p-lg-4 my-4">
        <section class="w-100 h-100 guest-form">
            <div class="d-flex flex-column my-4">
                <h1 class="title fs-1 text-center">Hapus Akun</h1>
            </div>

            <form method="post" action="{{ route('profile.destroy') }}">
                @csrf
                @method('delete')
                <div class="form-floating mb-3">
                    <input type="password" class="form-control" id="password" name="password" placeholder="Masukkan Kata Sandi" required autofocus autocomplete="password">
                    <label for="password">Kata Sandi</label>
                    @if($errors->userDeletion->any())
                    <small>Pastikan Kata Sandi Anda Masukkan Benar</small>
                    @endif
                </div>

                <div class="container">
                    <div class="row justify-content-end align-items-center">
                        <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#modalDeleteAccount">Hapus Akun</button>
                    </div>
                </div>

                <!-- Modal Delete -->
                <div class="modal fade" id="modalDeleteAccount" tabindex="-1" aria-labelledby="modalDeleteAccountLabel" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h1 class="modal-title fs-5" id="modalDeleteAccountLabel">Penghapusan Aku {{ $user->name }}</h1>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>

                            <div class="modal-body">
                                <span>Apakah anda yakin akan menghapus akun {{ $user->name }}. Setelah akun dihapus tidak dapat dipulihkan kembali. <br> <b>Pastikan Anda Yakin Untuk Menghapus Akun!</b></span>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary w-auto" data-bs-dismiss="modal">Batal</button>
                                <button type="submit" class="btn btn-danger w-auto">Hapus</button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </section>
    </div>
</div>
@endsection

