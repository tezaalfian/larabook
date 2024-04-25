<x-layouts.client>
    <x-slot:heading>
        <div class="col">
            <div class="page-pretitle">
                E-Book
            </div>
            <h2 class="page-title">
                Beli E-Book
            </h2>
        </div>
        <div class="col-auto ms-auto d-print-none">
            <div class="btn-list">
                <a href="{{ route('home') }}" class="btn btn-primary d-none d-sm-inline-block" data-bs-toggle="modal"
                    data-bs-target="#modal-report">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                        fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                        stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-arrow-left">
                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                        <path d="M5 12l14 0" />
                        <path d="M5 12l6 6" />
                        <path d="M5 12l6 -6" />
                    </svg>
                    Kembali
                </a>
            </div>
        </div>
    </x-slot:heading>

    <div class="row g-4">
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-md-4">
                        <img src="{{ $book->cover }}" alt="{{ $book->title }}" class="img-thumbnail">
                    </div>
                    <div class="col-md-8">
                        <span class="badge bg-blue-lt mb-2">{{ $book->category_name }}</span>
                        <h1 class="text-primary">{{ $book->title }}</h1>
                        <h3 class="m-0">{{ $book->author }}</h3>
                        <p class="text-secondary">{{ $book->published_date->isoFormat('MMMM YYYY') }} -
                            {{ $book->publisher }}</p>
                        <form action="#" method="post">
                            @csrf
                            <button class="btn btn-primary mb-4">Beli E-Book (@currency($book->price))</button>
                        </form>
                        <h2 class="mb-1">Tentang Buku Ini</h2>
                        <p>{{ $book->description }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-layouts.client>
