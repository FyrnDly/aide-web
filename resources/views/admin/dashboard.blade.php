@extends('layouts.app')
@section('title', 'Admin Dashboard')

@section('main')
<section class="row justify-content-center align-items-stretch py-md-4 py-2" style="margin-top: 75px;">
    @if(count($errors))
    <div class="alert alert-danger my-2" role="alert">
        {{ $errors }}
    </div>
    @endif

    <h2 class="text-start">Deskripsi Tentang AIDE</h2>
    <div class="table-responsive">
        <table class="table table-hover align-middle">
            <thead>
                <tr>
                    <th scope="col">Deskripsi</th>
                    <th scope="col" class="text-center">Gambar</th>
                    <th scope="col" class="text-end">
                        <button type="button" class="btn btn-primary w-auto" data-bs-toggle="modal" data-bs-target="#aboutModal">
                            <i class="bi bi-file-earmark-plus"></i>
                        </button>
                    </th>
                </tr>
            </thead>
            <tbody>
                @forelse ($abouts as $about)
                <tr>
                    <td scope="row">{{ Str::limit($about->description, 1000, '...') }}</td>
                    <td class="text-center">
                        <img src="{{ Storage::url($about->path) }}" alt="{{ $about->path }}" class="img-thumbnail">
                    </td>
                    <td class="text-end">
                        <a class="btn btn-info w-auto m-1" href="{{ route('about.edit',$about->id) }}">
                            <i class="bi bi-pencil-square"></i>
                        </a>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="3" class="text-center">Belum Menambahkan Deskripsi</td>
                </tr>
                @endforelse
            </tbody>
        </table>
        @include('components.loadmore', ['paginator' => $abouts])
    </div>

    <!-- Modal add -->
    <div class="modal fade" id="aboutModal" tabindex="-1" aria-labelledby="aboutModalLabel" aria-hidden="true">
        <div class="modal-dialog w-75 modal-dialog-centered modal-dialog-scrollable">
            <form method="POST" action="{{ route('about.store') }}" class="modal-content" enctype="multipart/form-data">
                @csrf
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="aboutModalLabel">Tambahkan Deskripsi Baru Tentang AIDE</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="form-floating mb-3">
                        <textarea class="form-control" style="height: fit-content" id="description" placeholder="Masukkan Deskripsi AIDE" name="description" rows="4">
                        {{ old('description') }}
                        </textarea>
                        <label for="description">Deskripsi</label>
                    </div>
                    <div class="mb-3">
                        <label for="image">Gambar</label>
                        <input type="file" class="form-control" id="image" placeholder="Upload Gambar Deskripsi Terkait" max="120" name="image" value="{{ old('image') }}">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary w-auto" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary w-auto">Tambahkan</button>
                </div>
            </form>
        </div>
    </div>
</section>

<section class="row justify-content-center align-items-stretch pb-md-4 pb-2">
    <h2 class="text-start">Fitur</h2>
    <div class="table-responsive">
        <table class="table table-hover align-middle">
            <thead>
                <tr>
                    <th scope="col">Judul</th>
                    <th scope="col">Deskripsi</th>
                    <th scope="col" class="text-center">Gambar</th>
                    <th scope="col" class="text-end">
                        <button type="button" class="btn btn-primary w-auto" data-bs-toggle="modal" data-bs-target="#featureModal">
                            <i class="bi bi-file-earmark-plus"></i>
                        </button>
                    </th>
                </tr>
            </thead>
            <tbody>
                @forelse ($features as $feature)
                <tr>
                    <td scope="row" class="fw-bolder fs-5">{{ $feature->name }}</td>
                    <td scope="row">{{ Str::limit($feature->description, 1000, '...') }}</td>
                    <td class="text-center">
                        <img src="{{ Storage::url($feature->path) }}" alt="{{ $feature->path }}" class="img-thumbnail">
                    </td>
                    <td class="text-end">
                        <a class="btn btn-info w-auto m-1" href="{{ route('feature.edit',$feature->id) }}">
                            <i class="bi bi-pencil-square"></i>
                        </a>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="4" class="text-center">Belum Menambahkan Fitur</td>
                </tr>
                @endforelse
            </tbody>
        </table>
        @include('components.loadmore', ['paginator' => $features])
    </div>

    <!-- Modal add -->
    <div class="modal fade" id="featureModal" tabindex="-1" aria-labelledby="featureModalLabel" aria-hidden="true">
        <div class="modal-dialog w-75 modal-dialog-centered modal-dialog-scrollable">
            <form method="POST" action="{{ route('feature.store') }}" class="modal-content" enctype="multipart/form-data">
                @csrf
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="featureModalLabel">Tambahkan Fitur Baru Untuk AIDE</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="form-floating mb-3">
                        <input class="form-control" id="name" placeholder="Masukkan Judul Fitur" name="name" value="{{ old('name') }}">
                        <label for="name">Judul</label>
                    </div>

                    <div class="form-floating mb-3">
                        <textarea class="form-control" style="height: fit-content" id="description" placeholder="Masukkan Deskripsi AIDE" name="description" rows="4">
                        {{ old('description') }}
                        </textarea>
                        <label for="description">Deskripsi</label>
                    </div>

                    <div class="mb-3">
                        <label for="image">Gambar</label>
                        <input type="file" class="form-control" id="image" placeholder="Upload Gambar Deskripsi Terkait" max="120" name="image" value="{{ old('image') }}">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary w-auto" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary w-auto">Tambahkan</button>
                </div>
            </form>
        </div>
    </div>
</section>

<section class="row justify-content-center align-items-stretch pb-md-4 pb-2">
    <h2 class="text-start">Dokumentasi</h2>
    <div class="table-responsive">
        <table class="table table-hover align-middle">
            <thead>
                <tr>
                    <th scope="col">Judul</th>
                    <th scope="col">Tanggal</th>
                    <th scope="col">Deskripsi</th>
                    <th scope="col" class="text-center">Gambar</th>
                    <th scope="col" class="text-end">
                        <button type="button" class="btn btn-primary w-auto" data-bs-toggle="modal" data-bs-target="#documentationModal">
                            <i class="bi bi-file-earmark-plus"></i>
                        </button>
                    </th>
                </tr>
            </thead>
            <tbody>
                @forelse ($documentations as $documentation)
                <tr>
                    <td scope="row" class="fw-bolder fs-5">{{ $documentation->name }}</td>
                    <td scope="row">{{ $documentation->date }}</td>
                    <td scope="row">{{ Str::limit($documentation->description, 1000, '...') }}</td>
                    <td class="text-center">
                        <img src="{{ Storage::url($documentation->path) }}" alt="{{ $documentation->path }}" class="img-thumbnail">
                    </td>
                    <td class="text-end">
                        <a class="btn btn-info w-auto m-1" href="{{ route('documentation.edit',$documentation->id) }}">
                            <i class="bi bi-pencil-square"></i>
                        </a>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" class="text-center">Belum Menambahkan Dokumentasi</td>
                </tr>
                @endforelse
            </tbody>
        </table>
        @include('components.loadmore', ['paginator' => $documentations])
    </div>

    <!-- Modal add -->
    <div class="modal fade" id="documentationModal" tabindex="-1" aria-labelledby="documentationModalLabel" aria-hidden="true">
        <div class="modal-dialog w-75 modal-dialog-centered modal-dialog-scrollable">
            <form method="POST" action="{{ route('documentation.store') }}" class="modal-content" enctype="multipart/form-data">
                @csrf
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="documentationModalLabel">Tambahkan Dokumentasi Baru Untuk AIDE</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="form-floating mb-3">
                        <input class="form-control" id="name" placeholder="Masukkan Judul Dokumentasi" name="name" value="{{ old('name') }}">
                        <label for="name">Judul</label>
                    </div>

                    <div class="form-floating mb-3">
                        <input type="date" class="form-control" id="date" placeholder="Masukkan Tanggal Dokumentasi" name="date" value="{{ old('date') }}">
                        <label for="date">Tanggal</label>
                    </div>

                    <div class="form-floating mb-3">
                        <textarea class="form-control" style="height: fit-content" id="description" placeholder="Masukkan Deskripsi AIDE" name="description" rows="4">
                        {{ old('description') }}
                        </textarea>
                        <label for="description">Deskripsi</label>
                    </div>

                    <div class="mb-3">
                        <label for="image">Gambar</label>
                        <input type="file" class="form-control" id="image" placeholder="Upload Gambar Deskripsi Terkait" max="120" name="image" value="{{ old('image') }}">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary w-auto" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary w-auto">Tambahkan</button>
                </div>
            </form>
        </div>
    </div>
</section>

<section class="row justify-content-center align-items-stretch pb-md-4 pb-2">
    <h2 class="text-start">Tim</h2>
    <div class="table-responsive">
        <table class="table table-hover align-middle">
            <thead>
                <tr>
                    <th scope="col">Judul</th>
                    <th scope="col" class="text-center">NIM</th>
                    <th scope="col" class="text-center">Divisi</th>
                    <th scope="col" class="text-center">LinkedIn</th>
                    <th scope="col" class="text-center">Gambar</th>
                    <th scope="col">
                        <button type="button" class="btn btn-primary w-auto" data-bs-toggle="modal" data-bs-target="#teamModal">
                            <i class="bi bi-file-earmark-plus"></i>
                        </button>
                    </th>
                </tr>
            </thead>
            <tbody>
                @forelse ($teams as $team)
                <tr>
                    <td scope="row">{{ $team->name }}</td>
                    <td class="text-center">{{ $team->nim }}</td>
                    <td class="text-center">{{ $team->division }}</td>
                    <td class="text-center">
                        <a href="{{ $team->linkedin }}" target="_blank">{{ $team->linkedin }}</a>
                    </td>
                    <td class="text-center">
                        <img src="{{ Storage::url($team->path) }}" alt="{{ $team->path }}" class="img-thumbnail">
                    </td>
                    <td class="text-end">
                        <a class="btn btn-info w-auto m-1" href="{{ route('team.edit',$team->id) }}">
                            <i class="bi bi-pencil-square"></i>
                        </a>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="6" class="text-center">Belum Menambahkan Fitur</td>
                </tr>
                @endforelse
            </tbody>
        </table>
        @include('components.loadmore', ['paginator' => $teams])
    </div>

    <!-- Modal add -->
    <div class="modal fade" id="teamModal" tabindex="-1" aria-labelledby="teamModalLabel" aria-hidden="true">
        <div class="modal-dialog w-75 modal-dialog-centered modal-dialog-scrollable">
            <form method="POST" action="{{ route('team.store') }}" class="modal-content" enctype="multipart/form-data">
                @csrf
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="teamModalLabel">Tambahkan Dokumentasi Baru Untuk AIDE</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="form-floating mb-3">
                        <input type="text" class="form-control" id="name" placeholder="Masukkan Judul Dokumentasi" name="name" value="{{ old('name') }}">
                        <label for="name">Nama</label>
                    </div>

                    <div class="form-floating mb-3">
                        <input type="text" class="form-control" id="nim" placeholder="Masukkan Tanggal Dokumentasi" name="nim" value="{{ old('nim') }}">
                        <label for="nim">Nim</label>
                    </div>

                    <div class="form-floating mb-3">
                        <input type="text" class="form-control" id="division" placeholder="Masukkan Tanggal Dokumentasi" name="division" value="{{ old('division') }}">
                        <label for="division">Divisi</label>
                    </div>

                    <div class="form-floating mb-3">
                        <input type="text" class="form-control" id="linkedin" placeholder="Masukkan Tanggal Dokumentasi" name="linkedin" value="{{ old('linkedin') }}">
                        <label for="linkedin">LinkedIn</label>
                    </div>

                    <div class="mb-3">
                        <label for="image">Gambar</label>
                        <input type="file" class="form-control" id="image" placeholder="Upload Gambar Deskripsi Terkait" max="120" name="image" value="{{ old('image') }}">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary w-auto" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary w-auto">Tambahkan</button>
                </div>
            </form>
        </div>
    </div>
</section>

@isset($users)
<section class="row justify-content-center align-items-stretch pb-md-4 pb-2">
    <h2 class="text-start">Daftar User</h2>
    <div class="table-responsive">
        <table class="table table-hover align-middle">
            <caption>
                Manajemen Daftar Akun AIDE
            </caption>
            <thead>
                <tr>
                    <th scope="col">Nama</th>
                    <th scope="col" class="text-center">Alamat Email</th>
                    <th scope="col" class="text-center">Level</th>
                    <th scope="col"></th>
                </tr>
            </thead>
            <tbody>
                @forelse($users as $user)
                <tr>
                    <td scope="row">{{ $user->name }}</td>
                    <td class="text-center">{{ $user->email }}</td>
                    <td class="text-center">{{ $user->role }}</td>
                    <td>
                        <!-- Button trigger modal change role -->
                        <button type="button" class="btn btn-danger w-auto" data-bs-toggle="modal" data-bs-target="#changeModal" data-bs-id='{{ $user->id }}' data-bs-name='{{ $user->name }}' data-bs-role='{{ $user->role }}' data-bs-exrole='{{ $user->role == 'admin' ? 'guest' : 'admin'}}'>
                            <i class="bi bi-arrow-clockwise"></i>
                        </button>
                        <form method="POST" action="{{ route('admin.update',$user->id) }}" id="formChange{{ $user->id }}">
                            @csrf
                        </form>

                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="4" class="text-center">Belum Ada User Mendaftar</td>
                </tr>
                @endforelse
            </tbody>
        </table>
        @include('components.loadmore', ['paginator' => $users])
    </div>

    <!-- Modal Change Role -->
    <div class="modal fade" id="changeModal" tabindex="-1" aria-labelledby="changeModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="changeModalLabel">Ubah Level User</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <span>
                        Apakah anda yakin ingin mengubah level user dari admin menjadi
                        guest
                    </span>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary w-auto fs-5" data-bs-dismiss="modal">Batal</button>
                    <button type="button" class="btn btn-danger w-auto fs-5" id="submit">Ubah Level User</button>
                </div>
            </div>
        </div>
    </div>
</section>
@endisset
@endsection

@section('add-script')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script>
    const changeModal = document.getElementById('changeModal')
    if (changeModal) {
        changeModal.addEventListener('show.bs.modal', event => {
            // Button that triggered the modal
            const button = event.relatedTarget
            // Extract info from data-bs-* attributes
            const id = button.getAttribute('data-bs-id')
            const name = button.getAttribute('data-bs-name')
            const role = button.getAttribute('data-bs-role');
            const exrole = button.getAttribute('data-bs-exrole');

            // Update the modal's content.
            const modalTitle = changeModal.querySelector('.modal-title');
            const modalBody = changeModal.querySelector('.modal-body span');
            const buttonSubmit = changeModal.querySelector('.modal-footer #submit');

            // Get Form
            const formTarget = document.getElementById(`formChange${id}`);

            modalTitle.textContent = `Ubah Level User ${name}`
            modalBody.textContent = `Apakah anda yakin ingin mengubah level user dari ${role} menjadi ${exrole}`

            // Form Submit
            buttonSubmit.onclick = function() {
                formTarget.submit();
            }
        })
    }
</script>
@endsection

@section('add-style')
<style>
    tr td img.img-thumbnail {
        max-width: 250px;
    }
</style>
@endsection