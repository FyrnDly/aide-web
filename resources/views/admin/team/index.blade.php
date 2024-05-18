<div class="table-responsive">
    <table class="table table-hover align-middle">
        <thead>
            <tr>
                <th scope="col">Judul</th>
                <th scope="col" class="text-center">NIM</th>
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
                <td colspan="5" class="text-center">Belum Menambahkan Fitur</td>
            </tr>
            @endforelse
        </tbody>
    </table>
    @include('components.pagination', ['paginator' => $teams, 'interval' => 5])
</div>

