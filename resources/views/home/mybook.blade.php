<x-layouts.client>
    <x-slot:heading>
        <div class="col">
            <div class="page-pretitle">
                Books
            </div>
            <h2 class="page-title">
                My Books
            </h2>
        </div>
    </x-slot:heading>

    <div class="row row-cards">
        @foreach ($books as $item)
            <div class="col-md-2 col-6">
                <a href="{{ route('file.book', $item->id) }}" style="text-decoration: none;">
                    <div class="card h-100">
                        <div class="card-status-bottom bg-info"></div>
                        <div class="img-responsive img-responsive-3x4 card-img-top"
                            style="background-image: url({{ $item->cover }});position:relative;">
                            <span class="badge bg-blue-lt"
                                style="position: absolute;right:10px;top:10px;">{{ strtolower($item->category_name) }}</span>
                        </div>
                        <div class="card-body">
                            <h3 class="card-title mb-2">{{ $item->title }}</h3>
                            <small>{{ $item->author }}</small>
                        </div>
                    </div>
                </a>
            </div>
        @endforeach
    </div>
    <div class="mt-3 d-flex justify-content-end">
        {{ $books->links() }}
    </div>
</x-layouts.client>
