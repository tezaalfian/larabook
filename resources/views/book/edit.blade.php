<x-layouts.admin>
    <x-slot:heading>
        <div class="page-pretitle">
            Buku
        </div>
        <h2 class="page-title">
            Edit Buku
        </h2>
    </x-slot:heading>

    <x-slot:card-header>
        Edit Buku
    </x-slot:card-header>

    <x-slot:button-action>
        <a href="{{ route('book.index') }}" class="btn btn-primary">
            <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-arrow-left" width="24"
                height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                stroke-linecap="round" stroke-linejoin="round">
                <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                <path d="M5 12l14 0"></path>
                <path d="M5 12l6 6"></path>
                <path d="M5 12l6 -6"></path>
            </svg>
            Kembali
        </a>
    </x-slot:button-action>
    <div class="card-body">
        <form action="{{ route('book.update', $book) }}" method="post" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="row">
                <div class="col-md-6">
                    <div class="mb-3">
                        <label class="form-label required">Judul</label>
                        <input type="text" class="form-control @error('title') is-invalid @enderror"
                            autocomplete="off" value="{{ old('title', $book->title) }}" name="title">
                        @error('title')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="mb-3">
                        <label class="form-label required">Kategori</label>
                        <select class="form-select @error('category_id') is-invalid @enderror" name="category_id">
                            <option value="">Pilih Kategori</option>
                            @foreach ($categories as $category)
                                <option value="{{ $category->id }}" @selected($category->id == old('category_id', $book->category_id))>{{ $category->name }}
                                </option>
                            @endforeach
                        </select>
                        @error('category_id')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="mb-3">
                        <label class="form-label required">Harga</label>
                        <input type="number" class="form-control @error('price') is-invalid @enderror"
                            autocomplete="off" value="{{ old('price', $book->price) }}" name="price">
                        @error('price')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="mb-3">
                        <label class="form-label required">Penulis</label>
                        <input type="text" class="form-control @error('author') is-invalid @enderror"
                            value="{{ old('author', $book->author) }}" name="author">
                        @error('author')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="mb-3">
                        <label class="form-label required">Penerbit</label>
                        <input type="text" class="form-control @error('publisher') is-invalid @enderror"
                            value="{{ old('publisher', $book->publisher) }}" name="publisher">
                        @error('publisher')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="mb-3">
                        <label class="form-label required">Tanggal Terbit</label>
                        <input type="date" class="form-control @error('published_date') is-invalid @enderror"
                            value="{{ old('published_date', $book->published_date->format('Y-m-d')) }}"
                            name="published_date" autocomplete="off">
                        @error('published_date')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="mb-3">
                        <label class="form-label required">
                            Cover
                            @if ($book->cover)
                                <a href="{{ $book->cover }}" target="_blank">
                                    Lihat
                                </a>
                            @endif
                        </label>
                        <input type="file" class="form-control @error('cover') is-invalid @enderror" name="cover"
                            accept="image/*">
                        @error('cover')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="mb-3">
                        <label class="form-label">File E-Book
                            @if ($book->file)
                                <a href="{{ route('file.book', $book->id) }}" target="_blank">
                                    Lihat
                                </a>
                            @endif
                        </label>
                        <input type="file" class="form-control @error('file') is-invalid @enderror" name="file"
                            accept=".pdf">
                        @error('file')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="col-12">
                    <div class="mb-3">
                        <label class="form-label">Deskripsi</label>
                        <textarea rows="5" class="form-control @error('description') is-invalid @enderror" name="description">{{ old('description', $book->description) }}</textarea>
                        @error('description')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="col-12">
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </div>
        </form>
    </div>
</x-layouts.admin>
