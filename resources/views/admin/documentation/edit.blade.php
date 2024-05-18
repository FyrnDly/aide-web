@extends('layouts.app')
@section('title', 'Admin Dashboard')

@section('main')
<section class="row justify-content-center align-items-stretch py-md-4 py-2" style="margin-top: 75px;">
    <h2 class="text-start mb-3">Fitur {{ $documentation->name }}</h2>

    <form method="POST" action="{{ route('documentation.update', $documentation->id) }}" class="guest-form" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label for="name" class="fs-5 fw-bold mb-1" style="color: white !important">Judul</label>
            <input class="form-control" id="name" placeholder="Masukkan Judul Dokumentasi" name="name" value="{{ $documentation->name }}">
            @error('name')
            <div class="alert alert-danger my-2" role="alert">
                {{ $errors->first('name') }}
            </div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="date" class="fs-5 fw-bold mb-1" style="color: white !important">Tanggal</label>
            <input class="form-control" id="date" placeholder="Masukkan Tanggal Dokumentasi" name="date" value="{{ $documentation->date }}">
            @error('date')
            <div class="alert alert-danger my-2" role="alert">
                {{ $errors->first('date') }}
            </div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="description" class="fs-5 fw-bold mb-1" style="color: white !important">Deskripsi</label>
            <textarea class="form-control" style="height: fit-content" id="description" placeholder="Masukkan Deskripsi AIDE" name="description" rows="4">
            {{ $documentation->description }}
            </textarea>
            @error('description')
            <div class="alert alert-danger my-2" role="alert">
                {{ $errors->first('description') }}
            </div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="image" class="fs-5 fw-bold mb-1" style="color: white !important">Gambar</label>
            <br>
            <img src="{{ Storage::url($documentation->path) }}" alt="{{ $documentation->path }}" class="img-thumbnail mb-3 w-50">
            <input type="file" class="form-control" id="image" placeholder="Upload Gambar Deskripsi Terkait" max="120" name="image" value="{{ old('image') }}">
            @error('image')
            <div class="alert alert-danger my-2" role="alert">
                {{ $errors->first('image') }}
            </div>
            @enderror
        </div>

        <div class="mb-2 text-end">
            <!-- Button trigger modal delete -->
            <button type="button" class="btn btn-danger w-auto" data-bs-toggle="modal" data-bs-target="#documentationModal">
                <i class="bi bi-trash2-fill"></i>
            </button>
            <a href="{{ route('admin.index') }}" class="btn btn-secondary w-auto m-1">Batal</a>
            <button type="submit" class="btn btn-primary w-auto m-1">Perbarui Data</button>
        </div>
    </form>
</section>

<!-- Modal Delete -->
<div class="modal fade" id="documentationModal" tabindex="-1" aria-labelledby="documentationModalDelete" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="documentationModalLabel">Hapus Dokumentasi </h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <span>
                    Apakah anda yakin ingin menghapus dokumentasi berikut, dokumentasi yang telah dihapus tidak dapat dipulihkan. Pastikan anda telah memikirkannya!
                </span>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary w-auto fs-5" data-bs-dismiss="modal">Batal</button>
                <form action="{{ route('documentation.destroy', $documentation->id) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger w-auto fs-5">Hapus</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

