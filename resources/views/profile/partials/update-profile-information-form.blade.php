<section>
    <header>
        <h2 class="text-lg font-medium text-gray-900">
            {{ __('Profile Information') }}
        </h2>

        <p class="mt-1 text-sm text-gray-600">
            {{ __("Update your account's profile information.") }}
        </p>
    </header>

    <form id="send-verification" method="post" action="{{ route('verification.send') }}">
        @csrf
    </form>

    <form method="post" action="{{ route('profile.update') }}" class="mt-6 space-y-6 row g-3">
        @csrf
        @method('patch')
        <div>
            <label for="name" class="form-label">First Name</label>
            <x-text-input id="name" name="name" type="text" class="mt-1 block w-full" :value="old('name', $user->name)" required autofocus autocomplete="Name" />
            <x-input-error class="mt-2" :messages="$errors->get('name')" />
        </div>
        <div>
            <label for="lastName" class="form-label">Last Name</label>
            <x-text-input id="lastName" name="lastName" type="text" class="mt-1 block w-full" :value="old('lastName', $user->lastName)"  required autocomplete="Last Name" />
            <x-input-error class="mt-2" :messages="$errors->get('lastName')" />
        </div>
        <div>
            <label for="phone" class="form-label">Phone</label>
            <x-text-input id="phone" name="phone" type="text" class="mt-1 block w-full" :value="old('phone', $user->phone)" required autocomplete="Phone" />
            <x-input-error :messages="$errors->get('phone')" class="mt-2" />
        </div>
        <div>
            <label for="sponsorCode" class="form-label">Sponsor Code</label>
            <x-text-input id="sponsorCode" name="sponsorCode" type="text" class="mt-1 block w-full" :value="old('sponsorCode', $user->sponsorCode)" readonly />
        </div>

        <div>
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" name="email" type="email" class="mt-1 block w-full" :value="old('email', $user->email)" readonly />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <div class="flex items-center gap-4">
            <x-primary-button>{{ __('Save') }}</x-primary-button>

            @if (session('status') === 'profile-updated')
                <p
                    x-data="{ show: true }"
                    x-show="show"
                    x-transition
                    x-init="setTimeout(() => show = false, 2000)"
                    class="text-sm text-gray-600"
                >{{ __('Saved.') }}</p>
            @endif
        </div>
    </form>
</section>
