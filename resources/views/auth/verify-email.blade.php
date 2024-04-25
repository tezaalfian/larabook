<x-layouts.auth>
    <p>{{ __('Terima kasih telah mendaftar. Sebelumnya kami perlu melakukan verifikasi melalui email anda. Silakan membuka email dan lakukan verifikasi') }}
    </p>
    @if (session('status') == 'verification-link-sent')
        <p class="text-success">
            {{ __('Link verifikasi telah kami kirimkan ke email anda') }}
        </p>
    @endif
    <form method="POST" action="{{ route('verification.send') }}">
        @csrf
        <div class="mb-3">
            <button type="submit" class="btn btn-primary w-100">{{ __('Resend Verification Email') }}</button>
        </div>
    </form>
    <form method="POST" action="{{ route('logout') }}">
        @csrf
        <button type="submit" class="btn btn-danger w-100">{{ __('Logout') }}</button>
    </form>
</x-layouts.auth>
