<x-layouts.admin :modal-delete="true">
    <x-slot:heading>
        <div class="page-pretitle">
            Buku
        </div>
        <h2 class="page-title">
            Daftar Buku
        </h2>
    </x-slot:heading>

    <x-slot:card-header>
        Daftar Buku
    </x-slot:card-header>

    <x-slot:button-action>
        <a href="{{ route('book.create') }}" class="btn btn-primary">
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
                    <th>Cover</th>
                    <th>Kategory</th>
                    <th>Judul</th>
                    <th>Harga</th>
                    <th>Penulis</th>
                    <th>Penerbit (Tahun)</th>
                    <th>#</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($books as $item)
                    <tr>
                        <td>
                            {{ $loop->iteration + $books->firstItem() - 1 }}
                        </td>
                        <td>
                            <img src="{{ $item->cover }}" alt="{{ $item->title }}" class="rounded" loading="lazy"
                                style="height: 40px;">
                        </td>
                        <td>{{ $item->category_name }}</td>
                        <td>{{ Str::limit($item->title, 30) }}</td>
                        <td>@currency($item->price)</td>
                        <td>{{ $item->author }}</td>
                        <td>{{ $item->publisher }} ({{ $item->published_date->format('Y') }})</td>
                        <td>
                            <a href="{{ route('book.edit', $item->id) }}" class="btn btn-sm btn-success">Edit</a>
                            <button type="button" class="btn btn-danger btn-sm btn-delete"
                                data-url="{{ route('book.destroy', $item->id) }}">
                                Hapus
                            </button>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <div class="card-footer d-flex justify-content-end pb-0">
        {{ $books->links() }}
    </div>
</x-layouts.admin>
