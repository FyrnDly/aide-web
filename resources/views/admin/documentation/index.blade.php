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
    @include('components.pagination', ['paginator' => $documentations, 'interval' => 5])
</div>

