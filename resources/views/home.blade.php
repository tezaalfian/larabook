<x-layouts.client>
    <x-slot:heading>
        <div class="col">
            <!-- Page pre-title -->
            <div class="page-pretitle">
                Home
            </div>
            <h2 class="page-title">
                Daftar eBook
            </h2>
        </div>
    </x-slot:heading>

    <div class="row g-4">
        <div class="col-md-3">
            <form action="{{ route('home') }}" method="get">
                <div class="mb-3">
                    <div class="form-label">Kategori</div>
                    <select class="form-select" name="category">
                        <option value="">Semua</option>
                        @foreach ($categories as $item)
                            <option value="{{ $item->id }}" @selected(request()->category == $item->id)>
                                {{ $item->name }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div>
                    <button class="btn btn-primary w-100 mb-2">
                        Tampilkan
                    </button>
                    <a href="{{ route('home') }}" class="btn btn-link w-100">
                        Reset
                    </a>
                </div>
            </form>
        </div>
        <div class="col-md-9">
            <div class="row row-cards">
                @foreach ($books as $item)
                    <div class="col-md-3 col-6">
                        <a href="#" style="text-decoration: none;">
                            <div class="card h-100">
                                <div class="card-status-bottom bg-info"></div>
                                <div class="img-responsive img-responsive-3x4 card-img-top"
                                    style="background-image: url({{ $item->cover }});position:relative;">
                                    <span class="badge bg-blue-lt"
                                        style="position: absolute;right:10px;top:10px;">{{ strtolower($item->category_name) }}</span>
                                </div>
                                <div class="card-body">
                                    <h3 class="card-title mb-2">{{ $item->title }}</h3>
                                    <b class="text-primary d-block mb-1">@currency($item->price)</b>
                                    <small>
                                        {{ $item->author }}
                                    </small>
                                </div>
                            </div>
                        </a>
                    </div>
                @endforeach
            </div>
            <div class="mt-3 d-flex justify-content-end">
                {{ $books->links() }}
            </div>
        </div>
    </div>
</x-layouts.client>
