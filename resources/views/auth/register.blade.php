<x-layouts.auth>
    <h2 class="h2 text-center mb-4">Daftar</h2>
    <form method="POST" action="{{ route('register') }}">
        @csrf
        <div class="mb-3">
            <label class="form-label required">Nama</label>
            <input type="text" class="form-control @error('name') is-invalid @enderror" required autofocus
                autocomplete="username" value="{{ old('name') }}" name="name">
            @error('name')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
        <div class="mb-3">
            <label class="form-label required">Email</label>
            <input type="email" class="form-control @error('email') is-invalid @enderror" required autofocus
                autocomplete="username" value="{{ old('email') }}" name="email">
            @error('email')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
        <div class="mb-3">
            <label class="form-label required">Password</label>
            <input type="password" class="form-control @error('password') is-invalid @enderror" required autofocus
                autocomplete="current-password" value="{{ old('password') }}" name="password">
            @error('password')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
        <div class="mb-3">
            <label class="form-label required">Konfirmasi Password</label>
            <input type="password" class="form-control @error('password_confirmation') is-invalid @enderror" required
                autofocus autocomplete="current-password" value="{{ old('password_confirmation') }}"
                name="password_confirmation">
            @error('password_confirmation')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
        <div class="form-footer">
            <button type="submit" class="btn btn-primary w-100">Daftar</button>
        </div>
        <div class="text-center text-secondary mt-3">
            Sudah punya akun? <a href="" tabindex="-1">Login</a>
        </div>
    </form>
</x-layouts.auth>
