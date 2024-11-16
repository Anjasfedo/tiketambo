<div class="card">
    <div class="card-header">
        <h4>{{ __('Delete Account') }}</h4>
    </div>
    <div class="card-body">
        <p>
            {{ __('Once your account is deleted, all of its resources and data will be permanently deleted. Before deleting your account, please download any data or information that you wish to retain.') }}
        </p>
        <button class="btn btn-danger"
                x-data=""
                x-on:click.prevent="$dispatch('open-modal', 'confirm-user-deletion')">
            {{ __('Delete Account') }}
        </button>
    </div>
</div>

<x-modal name="confirm-user-deletion" :show="$errors->userDeletion->isNotEmpty()" focusable>
    <form method="post" action="{{ route('profile.destroy') }}" class="p-6">
        @csrf
        @method('delete')

        <h5>{{ __('Are you sure you want to delete your account?') }}</h5>
        <p class="mt-2">
            {{ __('Once your account is deleted, all of its resources and data will be permanently deleted. Please enter your password to confirm you would like to permanently delete your account.') }}
        </p>

        <div class="mt-4">
            <label for="password" class="form-label">{{ __('Password') }}</label>
            <input id="password" name="password" type="password" class="form-control" placeholder="{{ __('Password') }}">
            @if ($errors->userDeletion->get('password'))
                <div class="text-danger small">{{ $errors->userDeletion->get('password')[0] }}</div>
            @endif
        </div>

        <div class="mt-4 d-flex justify-content-end">
            <button type="button" class="btn btn-secondary me-2" x-on:click="$dispatch('close')">
                {{ __('Cancel') }}
            </button>
            <button type="submit" class="btn btn-danger">
                {{ __('Delete Account') }}
            </button>
        </div>
    </form>
</x-modal>
