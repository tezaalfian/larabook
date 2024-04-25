<section>
    <form method="post" action="{{ route('profile.update') }}" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label class="form-label">Nama</label>
            <input class="form-control @error('name') is-invalid @enderror" type="text" name="name"
                value="{{ old('name', $user->name) }}" required autocomplete="off" />
            @error('name')
                <div class="form-text text-danger">{{ $message }}</div>
            @enderror
        </div>
        <div class="mb-3">
            <label class="form-label">Email</label>
            <input class="form-control @error('email') is-invalid @enderror" type="email" name="email"
                value="{{ old('email', $user->email) }}" required autocomplete="off" />
            @error('email')
                <div class="form-text text-danger">{{ $message }}</div>
            @enderror
            @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && !$user->hasVerifiedEmail())
                <div>
                    <p class="text-sm">
                        {{ __('Your email address is unverified.') }}

                        <button form="send-verification" class="btn btn-secondary">
                            {{ __('Click here to re-send the verification email.') }}
                        </button>
                    </p>

                    @if (session('status') === 'verification-link-sent')
                        <p class="text-sm text-success">
                            {{ __('A new verification link has been sent to your email address.') }}
                        </p>
                    @endif
                </div>
            @endif
        </div>
        <div class="mb-3">
            <label class="form-label">Foto</label>
            <input class="form-control @error('photo') is-invalid @enderror" type="file" name="photo" />
            @error('photo')
                <div class="form-text text-danger">{{ $message }}</div>
            @enderror
        </div>
        <button class="btn btn-primary">Simpan</button>
    </form>
</section>
