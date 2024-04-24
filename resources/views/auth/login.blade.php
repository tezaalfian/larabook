<x-layouts.auth>
    <h2 class="h2 text-center mb-4">Login</h2>
    <form method="POST" action="{{ route('login') }}">
        @csrf
        <div class="mb-3">
            <label class="form-label required">Email</label>
            <input type="email" class="form-control  @error('email') is-invalid @enderror" autocomplete="off"
                value="{{ old('email') }}" required autofocus name="email">
            @error('email')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
        <div class="mb-3">
            <label class="form-label required">Password</label>
            <input type="password" class="form-control" autocomplete="off" name="password">
            @error('password')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
        <div class="mb-3">
            <label class="form-check">
                <input type="checkbox" class="form-check-input" name="remember" />
                <span class="form-check-label">Remember me</span>
            </label>
        </div>
        <div class="form-footer">
            <button type="submit" class="btn btn-primary w-100">Login</button>
        </div>
    </form>
    @if (Route::has('register'))
        <div class="text-center text-secondary mt-3">
            Belum Punya Akun? <a href="{{ route('register') }}" tabindex="-1">Daftar</a>
        </div>
    @endif
</x-layouts.auth>
