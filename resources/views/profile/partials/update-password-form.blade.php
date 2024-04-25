<section>
    <form method="post" action="{{ route('password.update') }}">
        @csrf
        @method('put')
        <div class="mb-3">
            <label class="form-label">Password saat ini</label>
            <input class="form-control @error('current_password') is-invalid @enderror" type="password"
                name="current_password" required />
            @if ($errors->updatePassword->get('current_password'))
                @foreach ((array) $errors->updatePassword->get('current_password') as $message)
                    <div class="form-text text-danger">{{ $message }}</div>
                @endforeach
            @endif
        </div>
        <div class="mb-3">
            <label class="form-label">Password baru</label>
            <input class="form-control @error('password') is-invalid @enderror" type="password" name="password"
                required />
            @if ($errors->updatePassword->get('password'))
                @foreach ((array) $errors->updatePassword->get('password') as $message)
                    <div class="form-text text-danger">{{ $message }}</div>
                @endforeach
            @endif
        </div>
        <div class="mb-3">
            <label class="form-label">Konfirmasi Password</label>
            <input class="form-control @error('password_confirmation') is-invalid @enderror" type="password"
                name="password_confirmation" required />
            @if ($errors->updatePassword->get('password_confirmation'))
                @foreach ((array) $errors->updatePassword->get('password_confirmation') as $message)
                    <div class="form-text text-danger">{{ $message }}</div>
                @endforeach
            @endif
        </div>
        <button class="btn btn-primary">Simpan</button>
    </form>
</section>
