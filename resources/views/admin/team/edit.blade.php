@extends('layouts.app')
@section('title', 'Admin Dashboard')

@section('main')
<section class="row justify-content-center align-items-stretch py-md-4 py-2" style="margin-top: 75px;">
    <h2 class="text-start mb-3">{{ $team->name }}</h2>

    <form method="POST" action="{{ route('team.update', $team->id) }}" class="guest-form" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label for="name" class="fs-5 fw-bold mb-1" style="color: white !important">Nama</label>
            <input class="form-control" id="name" placeholder="Masukkan Judul Fitur AIDE" name="name" value="{{ $team->name }}">
            @error('name')
            <div class="alert alert-danger my-2" role="alert">
                {{ $errors->first('name') }}
            </div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="nim" class="fs-5 fw-bold mb-1" style="color: white !important">Nim</label>
            <input type="text" class="form-control" id="nim" placeholder="Masukkan Tanggal Dokumentasi" name="nim" value="{{ $team->nim }}">
            @error('nim')
            <div class="alert alert-danger my-2" role="alert">
                {{ $errors->first('nim') }}
            </div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="linkedin" class="fs-5 fw-bold mb-1" style="color: white !important">LinkedIn</label>
            <input type="text" class="form-control" id="linkedin" placeholder="Masukkan Tanggal Dokumentasi" name="linkedin" value="{{ $team->linkedin }}">
            @error('linkedin')
            <div class="alert alert-danger my-2" role="alert">
                {{ $errors->first('linkedin') }}
            </div>
            @enderror
        </div>


        <div class="mb-3">
            <label for="image" class="fs-5 fw-bold mb-1" style="color: white !important">Gambar</label>
            <br>
            <img src="{{ Storage::url($team->path) }}" alt="{{ $team->path }}" class="img-thumbnail mb-3 w-50">
            <input type="file" class="form-control" id="image" placeholder="Upload Gambar Deskripsi Terkait" max="120" name="image" value="{{ old('image') }}">
            @error('image')
            <div class="alert alert-danger my-2" role="alert">
                {{ $errors->first('image') }}
            </div>
            @enderror
        </div>

        <div class="mb-2 text-end">
            <!-- Button trigger modal delete -->
            <button type="button" class="btn btn-danger w-auto" data-bs-toggle="modal" data-bs-target="#teamModal">
                <i class="bi bi-trash2-fill"></i>
            </button>
            <a href="{{ route('admin.index') }}" class="btn btn-secondary w-auto m-1">Batal</a>
            <button type="submit" class="btn btn-primary w-auto m-1">Perbarui Data</button>
        </div>
    </form>
</section>

<!-- Modal Delete -->
<div class="modal fade" id="teamModal" tabindex="-1" aria-labelledby="teamModalDelete" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="teamModalLabel">Hapus Fitur </h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <span>
                    Apakah anda yakin ingin menghapus fitur berikut, fitur yang telah dihapus tidak dapat dipulihkan. Pastikan anda telah memikirkannya!
                </span>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary w-auto fs-5" data-bs-dismiss="modal">Batal</button>
                <form action="{{ route('team.destroy', $team->id) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger w-auto fs-5">Hapus</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

