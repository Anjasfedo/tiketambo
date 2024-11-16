<div class="card">
    <div class="card-header">
        <h4>{{ __('Profile Information') }}</h4>
    </div>
    <div class="card-body">
        <form method="post" action="{{ route('profile.update') }}">
            @csrf
            @method('patch')

            <div class="mb-3">
                <label for="name" class="form-label">{{ __('Name') }}</label>
                <input id="name" name="name" type="text" class="form-control" value="{{ old('name', $user->name) }}" required>
                @if ($errors->get('name'))
                    <div class="text-danger small">{{ $errors->get('name')[0] }}</div>
                @endif
            </div>

            <div class="mb-3">
                <label for="email" class="form-label">{{ __('Email') }}</label>
                <input id="email" name="email" type="email" class="form-control" value="{{ old('email', $user->email) }}" required>
                @if ($errors->get('email'))
                    <div class="text-danger small">{{ $errors->get('email')[0] }}</div>
                @endif

                @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && !$user->hasVerifiedEmail())
                    <div class="mt-2">
                        <p class="text-muted small">
                            {{ __('Your email address is unverified.') }}
                            <button form="send-verification" class="btn btn-link p-0">{{ __('Click here to re-send the verification email.') }}</button>
                        </p>
                        @if (session('status') === 'verification-link-sent')
                            <span class="text-success small">{{ __('A new verification link has been sent to your email address.') }}</span>
                        @endif
                    </div>
                @endif
            </div>

            <button type="submit" class="btn btn-primary">{{ __('Save') }}</button>
            @if (session('status') === 'profile-updated')
                <span class="text-success ms-2">{{ __('Saved.') }}</span>
            @endif
        </form>
    </div>
</div>
