<x-form-section submit="updatePassword">
    <x-slot name="title">
        <h4 class="mt-4 fs-6">Update Password</h4>
    </x-slot>

    <x-slot name="description">
        <p>Ensure your account is using a long, random password to stay secure.</p>
    </x-slot>

    <x-slot name="form">
        <div class="row">
            <div class="mb-3 col-lg-4">
                <x-label class="form-label" for="current_password" value="{{ __('Current Password') }}" />
                <x-input id="current_password" type="password" class="form-control" wire:model="state.current_password" autocomplete="current-password" />
                <x-input-error for="current_password" class="mt-2" />
            </div>

            <div class="mb-3 col-lg-4">
                <x-label class="form-label" for="password" value="{{ __('New Password') }}" />
                <x-input id="password" type="password" class="form-control" wire:model="state.password" autocomplete="new-password" />
                <x-input-error for="password" class="mt-2" />
            </div>

            <div class="mb-3 col-lg-4">
                <x-label class="form-label" for="password_confirmation" value="{{ __('Confirm Password') }}" />
                <x-input id="password_confirmation" type="password" class="form-control" wire:model="state.password_confirmation" autocomplete="new-password" />
                <x-input-error for="password_confirmation" class="mt-2" />
            </div>

        </div>
    </x-slot>

    <x-slot name="actions">
        <x-action-message class="me-3" on="saved">
            {{ __('Saved.') }}
        </x-action-message>

        <button class="btn-primary btn">
            {{ __('Save') }}
        </button>

    </x-slot>
</x-form-section>
