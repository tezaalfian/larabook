<x-layouts.auth>
    <form method="POST" action="{{ route('password.store') }}">
        @csrf
        <input type="hidden" name="token" value="{{ $request->route('token') }}">
        <div class="mb-3">
            <label class="form-label required">Email</label>
            <input type="email" class="form-control  @error('email') is-invalid @enderror" placeholder="your@email.com"
                autocomplete="off" value="{{ old('email', $request->email) }}" required autofocus name="email">
            @error('email')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
        <div class="mb-3">
            <label class="form-label required">Password</label>
            <input type="password" class="form-control @error('password') is-invalid @enderror" required autofocus
                autocomplete="current-password" :value="old('password')" name="password">
            @error('password')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
        <div class="mb-3">
            <label class="form-label required">Confirm Password</label>
            <input type="password" class="form-control @error('password_confirmation') is-invalid @enderror" required
                autofocus autocomplete="current-password" :value="old('password_confirmation')"
                name="password_confirmation">
            @error('password_confirmation')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
        <div class="form-footer">
            <button type="submit" class="btn btn-primary w-100">{{ __('Reset Password') }}</button>
        </div>
    </form>
</x-layouts.auth>
