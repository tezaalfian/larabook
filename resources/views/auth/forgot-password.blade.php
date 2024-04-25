<x-layouts.auth>
    <p>Kami akan mengirimkan verifikasi link reset password ke email anda</p>
    <form method="POST" action="{{ route('password.email') }}">
        @csrf
        <div class="mb-3">
            <label class="form-label required">Email</label>
            <input type="email" class="form-control  @error('email') is-invalid @enderror"
                placeholder="your@email.com" autocomplete="off" value="{{ old('email') }}" required autofocus
                name="email">
            @error('email')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
        <button type="submit" class="btn btn-primary w-100">Email Password Reset Link</button>
    </form>
</x-layouts.auth>
