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
    @include('components.pagination', ['paginator' => $abouts, 'interval' => 5])
</div>
