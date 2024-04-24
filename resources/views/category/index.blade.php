<x-layouts.admin :modal-delete="true">
    <x-slot:heading>
        <div class="page-pretitle">
            Kategori
        </div>
        <h2 class="page-title">
            Daftar Kategori
        </h2>
    </x-slot:heading>

    <x-slot:card-header>
        Daftar Kategori
    </x-slot:card-header>

    <x-slot:button-action>
        <a href="{{ route('category.create') }}" class="btn btn-primary">
            <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24"
                stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                <path d="M12 5l0 14"></path>
                <path d="M5 12l14 0"></path>
            </svg>
            Tambah data
        </a>
    </x-slot:button-action>

    <div class="table-responsive">
        <table class="table card-table table-vcenter text-nowrap datatable">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Kategori</th>
                    <th>#</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($categories as $item)
                    <tr>
                        <td>
                            {{ $loop->iteration + $categories->firstItem() - 1 }}
                        </td>
                        <td>{{ $item->name }}</td>
                        <td>
                            <a href="{{ route('category.edit', $item) }}" class="btn btn-sm btn-success">Edit</a>
                            <button type="button" class="btn btn-danger btn-sm btn-delete"
                                data-url="{{ route('category.destroy', $item) }}">
                                Hapus
                            </button>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <div class="card-footer d-flex justify-content-end pb-0">
        {{ $categories->links() }}
    </div>
</x-layouts.admin>
