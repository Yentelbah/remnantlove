<x-form-section submit="updateProfileInformation">
    <x-slot name="title">
        <h4 class="mt-4 fs-6">Profile Information</h4>
    </x-slot>

    <x-slot name="description">
        <p>Update your account's profile information and email address.</p>
    </x-slot>

    <x-slot name="form">
        <!-- Profile Photo -->
        @if (Laravel\Jetstream\Jetstream::managesProfilePhotos())
            <div x-data="{photoName: null, photoPreview: null}" class="col-span-6 sm:col-span-4">
                <!-- Profile Photo File Input -->
                <input type="file" id="photo" class="hidden"
                            wire:model.live="photo"
                            x-ref="photo"
                            x-on:change="
                                    photoName = $refs.photo.files[0].name;
                                    const reader = new FileReader();
                                    reader.onload = (e) => {
                                        photoPreview = e.target.result;
                                    };
                                    reader.readAsDataURL($refs.photo.files[0]);
                            " />

                <x-label for="photo" value="{{ __('Photo') }}" />

                <!-- Current Profile Photo -->
                <div class="mt-2" x-show="! photoPreview">
                    <img src="{{ $this->user->profile_photo_url }}" alt="{{ $this->user->name }}" class="object-cover w-20 h-20 rounded-full">
                </div>

                <!-- New Profile Photo Preview -->
                <div class="mt-2" x-show="photoPreview" style="display: none;">
                    <span class="block w-20 h-20 bg-center bg-no-repeat bg-cover rounded-full"
                          x-bind:style="'background-image: url(\'' + photoPreview + '\');'">
                    </span>
                </div>

                <x-secondary-button class="mt-2 me-2" type="button" x-on:click.prevent="$refs.photo.click()">
                    {{ __('Select A New Photo') }}
                </x-secondary-button>

                @if ($this->user->profile_photo_path)
                    <x-secondary-button type="button" class="mt-2" wire:click="deleteProfilePhoto">
                        {{ __('Remove Photo') }}
                    </x-secondary-button>
                @endif

                <x-input-error for="photo" class="mt-2" />
            </div>
        @endif

        <!-- Name -->
        <div class="row">
            <div class="mb-3 col-lg-6">
                <label for="name" class="form-label">Name</label>
                <input type="text" id="name" type="text" class="form-control @error('name') is-invalid @enderror" wire:model="state.name" required autocomplete="name">
                @error('name')
                    <small class="invalid-feedback" role="alert">
                    {{ $message }}
                    </small>
                @enderror
            </div>

            <div class="mb-3 col-lg-6">
                <label for="email" class="form-label">Email</label>
                <input type="email" id="email" type="text" class="form-control @error('email') is-invalid @enderror" wire:model="state.email" required autocomplete="username">
                @error('email')
                    <small class="invalid-feedback" role="alert">
                    {{ $message }}
                    </small>
                @enderror

                @if (Laravel\Fortify\Features::enabled(Laravel\Fortify\Features::emailVerification()) && ! $this->user->hasVerifiedEmail())
                    <p class="mt-2 text-sm">
                        {{ __('Your email address is unverified.') }}

                        <button type="button" class="text-sm text-gray-600 underline rounded-md hover:text-gray-900 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" wire:click.prevent="sendEmailVerification">
                            {{ __('Click here to re-send the verification email.') }}
                        </button>
                    </p>

                    @if ($this->verificationLinkSent)
                        <p class="mt-2 text-sm font-medium text-green-600">
                            {{ __('A new verification link has been sent to your email address.') }}
                        </p>
                    @endif
                @endif
            </div>
        </div>


    </x-slot>

    <x-slot name="actions">
        <x-action-message class="me-3" on="saved">
            {{ __('Saved.') }}
        </x-action-message>

        <button wire:loading.attr="disabled" wire:target="photo" class="btn-primary btn">
            {{ __('Save') }}
        </button>
    </x-slot>
</x-form-section>
