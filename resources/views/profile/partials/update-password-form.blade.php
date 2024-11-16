<div class="card">
    <div class="card-header">
        <h4>{{ __('Update Password') }}</h4>
    </div>
    <div class="card-body">
        <form method="post" action="{{ route('password.update') }}">
            @csrf
            @method('put')

            <div class="mb-3">
                <label for="current_password" class="form-label">{{ __('Current Password') }}</label>
                <input id="current_password" name="current_password" type="password" class="form-control">
                @if ($errors->updatePassword->get('current_password'))
                    <div class="text-danger small">{{ $errors->updatePassword->get('current_password')[0] }}</div>
                @endif
            </div>

            <div class="mb-3">
                <label for="password" class="form-label">{{ __('New Password') }}</label>
                <input id="password" name="password" type="password" class="form-control">
                @if ($errors->updatePassword->get('password'))
                    <div class="text-danger small">{{ $errors->updatePassword->get('password')[0] }}</div>
                @endif
            </div>

            <div class="mb-3">
                <label for="password_confirmation" class="form-label">{{ __('Confirm Password') }}</label>
                <input id="password_confirmation" name="password_confirmation" type="password" class="form-control">
                @if ($errors->updatePassword->get('password_confirmation'))
                    <div class="text-danger small">{{ $errors->updatePassword->get('password_confirmation')[0] }}</div>
                @endif
            </div>

            <button type="submit" class="btn btn-primary">{{ __('Save') }}</button>
            @if (session('status') === 'password-updated')
                <span class="text-success ms-2">{{ __('Saved.') }}</span>
            @endif
        </form>
    </div>
</div>
