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
    <div id="about"></div>

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
    <div id='feature'></div>

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
    <div id="documentation"></div>

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
    <div id="team"></div>

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
        @include('components.pagination', ['paginator' => $users, 'interval' => 5])
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

<script>
    $(document).ready(function() {
        $.get('/admin/about', function(data) {
            $('#about').html(data);
        });

        $(document).on('click', '#about .pagination a', function(e) {
            e.preventDefault();
            var url = $(this).attr('href');
            $.get(url, function(data) {
                $('#about').html(data);
            });
        });

        $.get('/admin/feature', function(data) {
            $('#feature').html(data);
        });

        $(document).on('click', '#feature .pagination a', function(e) {
            e.preventDefault();
            var url = $(this).attr('href');
            $.get(url, function(data) {
                $('#feature').html(data);
            });
        });

        $.get('/admin/documentation', function(data) {
            $('#documentation').html(data);
        });

        $(document).on('click', '#documentation .pagination a', function(e) {
            e.preventDefault();
            var url = $(this).attr('href');
            $.get(url, function(data) {
                $('#documentation').html(data);
            });
        });

        $.get('/admin/team', function(data) {
            $('#team').html(data);
        });

        $(document).on('click', '#team .pagination a', function(e) {
            e.preventDefault();
            var url = $(this).attr('href');
            $.get(url, function(data) {
                $('#team').html(data);
            });
        });
    });

</script>
@endsection
@section('add-style')
<style>
    tr td img.img-thumbnail {
        max-width: 150px;
    }

</style>



@endsection
