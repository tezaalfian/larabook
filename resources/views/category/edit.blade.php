<x-layouts.admin>
    <x-slot:heading>
        <div class="page-pretitle">
            Kategori
        </div>
        <h2 class="page-title">
            Edit Kategori
        </h2>
    </x-slot:heading>

    <x-slot:card-header>
        Edit Kategori
    </x-slot:card-header>

    <x-slot:button-action>
        <a href="{{ route('category.index') }}" class="btn btn-primary">
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
        <form action="{{ route('category.update', $category) }}" method="post">
            @csrf
            @method('PUT')
            <div class="row">
                <div class="col-md-6">
                    <div class="mb-3">
                        <label class="form-label required">Kategori</label>
                        <input type="text" class="form-control @error('name') is-invalid @enderror"
                            autocomplete="off" value="{{ old('name', $category->name) }}" name="name">
                        @error('name')
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
