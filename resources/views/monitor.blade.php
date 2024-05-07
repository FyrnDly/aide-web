<!doctype html>
<html lang="en">

<head>
    <title>Dashboard | AIDE</title>
    <!-- Required meta tags -->
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />

    <!-- Bootstrap CSS v5.2.1 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    <!-- Font Google -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Noto+Sans:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">

    <!-- Logo -->
    <link rel="shortcut icon" href="{{ url('dev/image/logo.png') }}" type="image/x-icon">

    <!-- Local Style -->
    <link rel="stylesheet" href="{{ url('dev/style/main.css') }}">
</head>

<body>
    <!-- Navbar -->
    <header class="bg-nav fixed-top">
        <nav class="navbar navbar-expand-md px-4 py-3 rounded-0" id="navbar">
            <div class="container-fluid">
                <a class="navbar-brand" href="{{ route('home') }}">
                    <img src="{{ url('dev/image/logo.png') }}" alt="Logo AIDE">
                    AIDE
                </a>
                <div class="navbar-nav mx-auto d-none d-md-block">
                    <div class="nav-item">
                        <span class="nav-link">Halaman Monitoring Admin</span>
                    </div>
                </div>
                <div class="navbar-nav ms-md-4 ms-auto ms-md-0">
                    <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#modalLogout">Keluar</button>
                </div>
            </div>
        </nav>
    </header>

    <!-- Modal Logout -->
    <div class="modal fade" id="modalLogout" tabindex="-1" aria-labelledby="modalLogoutLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
            <form method="POST" action="{{ route('logout') }}" class="modal-content">
                @csrf
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="modalLogoutLabel">Kembali Kehalaman Awal</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <span>Apakah anda yakin untuk keluar dari halaman monitoring sebagai Admin?</span>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary w-auto" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-danger w-auto">Keluar</button>
                </div>
            </form>
        </div>
    </div>

    <!-- Main Content -->
    <main class="container">
        <!-- Chart -->
        <section class="row justify-content-between align-items-stretch py-md-4 py-2" style="margin-top: 75px;">
            <h1 class="text-start mb-2">Summary AIDE</h1>
            <!-- Weekly -->
            <div class="col-lg-8 p-1 chart chart-main">
                <div class="card flex justify-content-center align-items-center rounded h-100 p-md-4 p-2">
                    <div class="chart-item" id="weekChart" data-sm-time=@json($timeForWeek) data-sm-week=@json($chartForWeek) data-sm-date-today="{{ $today }}" data-sm-date-week='{{ $aWeekAgo }}'></div>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="row">
                    <!-- Monthly -->
                    <div class="col-12 p-1 chart">
                        <div class="card flex justify-content-center align-items-center rounded h-100 p-md-4 p-2">
                            <div class="chart-item" id="monthChart" data-sm-month=@json($chartForMonth)></div>
                        </div>
                    </div>
                    <!-- Battery -->
                    <div class="col-12 p-1 chart">
                        <div class="card flex justify-content-center align-items-center rounded h-100 p-md-4 p-2">
                            <h5>Persentase Baterai Robot Tersisa</h5>
                            <div class="chart-item" id="percentageBattery" data-sm-battery={{ $battery }}></div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Schedule -->
        <section class="schedule mb-4">
            <h1 class="text-start mb-2">Automation AIDE</h1>
            <div class="table-responsive">
                <table class="table table-hover align-middle">
                    <thead>
                        <caption>
                            Jadwal Monitoring Robot AIDE
                        </caption>
                        <tr>
                            <th scope="col">Waktu Mulai</th>
                            <th scope="col" class="text-center">Durasi</th>
                            <th scope="col" class="text-end">
                                <!-- Button trigger modal add -->
                                <button type="button" class="btn btn-primary w-auto" data-bs-toggle="modal" data-bs-target="#addModal">
                                    <i class="bi bi-file-earmark-plus"></i>
                                </button>
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
                                <!-- Button trigger modal delete -->
                                <button type="button" class="btn btn-danger w-auto" data-bs-toggle="modal" data-bs-time="{{ $time['started'] }}" data-bs-target="#deleteModal" data-bs-id="{{ $time['id'] }}">
                                    <i class="bi bi-trash2-fill"></i>
                                </button>
                                <!-- Button trigger modal edit -->
                                <button type="button" class="btn btn-primary w-auto" data-bs-toggle="modal" data-bs-target="#editModal" data-bs-time="{{ $time['started'] }}" data-bs-duration={{ $time['duration'] }} data-bs-id="{{ $time['id'] }}">
                                    <i class="bi bi-pencil-square"></i>
                                </button>
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

        </section>
    </main>

    <footer class="p-2 bg-primary">
        <h5 class="text-center">Copyright ©2024 AIDE-IoT | SV IPB</h5>
    </footer>

    <!-- Bootstrap JavaScript Libraries -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js" integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+" crossorigin="anonymous">
    </script>

    <!-- Google Chart -->
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script src="{{ url('dev/script/chart.js') }}" type="text/javascript"></script>

    <!-- Modal Schedule -->
    <script src="{{ url('dev/script/modal.js') }}"></script>
</body>
</html>

