@extends('layouts.app')
@section('title', 'Halaman Monitoring')

@section('main')
<section class="row justify-content-center align-items-stretch py-md-4 py-2" style="margin-top: 75px;">
    <h1 class="text-start mb-2">Summary AIDE</h1>
    <!-- Status Connection -->
    <div>
        <h4 class="d-inline">Status AIDE :</h4>
        <h5 @class(['alert p-1 d-inline', 'alert-success'=> $logStatus, 'alert-danger'=> !$logStatus]) role="alert">
            {{ $logMsg }}
            @if(! $logStatus)
            , Terakhir Terhubung: {{ $logTime }}
            @endif
        </h5>
    </div>

    <!-- Table Schedule -->
    <div class="col-lg-8 p-1 chart chart-main">
        <h4>Jadwal Monitoring Robot AIDE</h4>
        <div class="table-responsive">
            <table class="table table-hover align-middle">
                <thead>
                    <tr>
                        <th scope="col">Waktu Mulai</th>
                        <th scope="col" class="text-center">Durasi</th>
                        <th scope="col" class="text-end">
                            @if(Auth::user()->role == 'admin' or Auth::user()->role == 'root')
                            <!-- Button trigger modal add -->
                            <button type="button" class="btn btn-primary w-auto" data-bs-toggle="modal" data-bs-target="#addModal">
                                <i class="bi bi-file-earmark-plus"></i>
                            </button>
                            @endif
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @if ($operations)
                    @foreach($operations as $operation => $time)
                    <tr>
                        <td scope="row">{{ $time['started'] }}</td>
                        <td class="text-center">{{ (int)(((int)$time['duration'])/60) }} Jam {{ ((int)$time['duration'])%60 }} Menit</td>
                        <td class="text-end">
                            @if(Auth::user()->role == 'admin' or Auth::user()->role == 'root')
                            <!-- Button trigger modal delete -->
                            <button type="button" class="btn btn-danger w-auto" data-bs-toggle="modal" data-bs-time="{{ $time['started'] }}" data-bs-target="#deleteModal" data-bs-id="{{ $time['id'] }}">
                                <i class="bi bi-trash2-fill"></i>
                            </button>
                            <!-- Button trigger modal edit -->
                            <button type="button" class="btn btn-primary w-auto" data-bs-toggle="modal" data-bs-target="#editModal" data-bs-time="{{ $time['started'] }}" data-bs-duration={{ $time['duration'] }} data-bs-id="{{ $time['id'] }}">
                                <i class="bi bi-pencil-square"></i>
                            </button>
                            @endif
                        </td>
                    </tr>
                    @endforeach
                    @else
                    <tr>
                        <td colspan="3" class="text-center">
                            <h5>Buat Jam Operasi Robot Aide</h5>
                            <br>
                            <!-- Button trigger modal add -->
                            <button type="button" class="btn btn-primary w-100" data-bs-toggle="modal" data-bs-target="#addModal">
                                <i class="bi bi-file-earmark-plus"></i>
                            </button>
                        </td>
                    </tr>
                    @endif
                </tbody>
            </table>
        </div>
    </div>

    <!-- Battery -->
    <div class="col-lg-4 col-md-8">
        <div class="row">
            <div class="chart">
                <div class="card flex justify-content-center align-items-center rounded h-100 p-md-4 p-2">
                    <h4>Persentase Baterai Robot</h4>
                    <div class="chart-item" id="percentageBattery" data-sm-battery={{ $battery }}></div>
                </div>
            </div>
        </div>
    </div>
</section>

@if(Auth::user()->role == 'admin' or Auth::user()->role == 'root')
<!-- Modal add -->
<div class="modal fade" id="addModal" tabindex="-1" aria-labelledby="addModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
        <form method="POST" action="{{ route('dashboard.store') }}" class="modal-content">
            @csrf
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="addModalLabel">Tambahkan Jadwal Pengoperasian AIDE</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="form-floating mb-3">
                    <input type="time" class="form-control" id="floatingTime" placeholder="Masukkan Waktu Memulai Operasi Robot" name="started" value="{{ old('started') }}">
                    <label for="floatingTime">Waktu</label>
                </div>
                <div class="form-floating">
                    <input type="number" class="form-control" id="floatingDuration" placeholder="Masukkan Durasi Pengoperasian Robot (menit)" max="120" name="duration" value="{{ old('duration') }}">
                    <label for="floatingDuration">Durasi</label>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary w-auto" data-bs-dismiss="modal">Batal</button>
                <button type="submit" class="btn btn-primary w-auto">Tambahkan</button>
            </div>
        </form>
    </div>
</div>

<!-- Modal edit -->
<div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
        <form method="POST" action="{{ route('dashboard.update') }}" class="modal-content">
            @csrf
            <input type="hidden" name="id" id="operationId">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="editModalLabel">Ubah Waktu Operasi</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="form-floating mb-3">
                    <input type="time" class="form-control" id="floatingTime" placeholder="Masukkan Waktu Memulai Operasi Robot" name="started">
                    <label for="floatingTime">Waktu</label>
                </div>
                <div class="form-floating">
                    <input type="number" class="form-control" id="floatingDuration" placeholder="Masukkan Durasi Pengoperasian Robot (menit)" max="120" name="duration">
                    <label for="floatingDuration">Durasi</label>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary w-auto" data-bs-dismiss="modal">Batal</button>
                <button type="submit" class="btn btn-primary w-auto">Ubah Data</button>
            </div>
        </form>
    </div>
</div>

<!-- Modal delete -->
<div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
        <form method="POST" action="{{ route('dashboard.destroy') }}" class="modal-content">
            @csrf
            <input type="hidden" name="id" id="operationId">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="deleteModalLabel">Hapus Waktu Operasi</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <span>Apakah anda yakin ingin menghapus jam operasi ini? <br>
                    Jam pengoperasian robot dapat ditambahkan kembali</span>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary w-auto" data-bs-dismiss="modal">Batal</button>
                <button type="submit" class="btn btn-danger w-auto">Hapus</button>
            </div>
        </form>
    </div>
</div>
@endif
@endsection

@section('add-script')
<!-- Google Chart -->
<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
<script src="{{ url('dev/script/chart.js') }}" type="text/javascript"></script>

<!-- Modal Schedule -->
<script src="{{ url('dev/script/modal.js') }}"></script>
@endsection