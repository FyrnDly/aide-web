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
    @include('components.pagination', ['paginator' => $features, 'interval' => 5])
</div>

