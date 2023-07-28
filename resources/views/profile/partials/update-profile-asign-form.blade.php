<section>
    <header>
        <h2 class="text-lg font-medium text-gray-900">
            {{ __('Criteria of acceptance') }}
        </h2>

        <p class="mt-1 text-sm text-gray-600">
            {{ __("Update your account's criteria of acceptance.") }}
        </p>
    </header>

    <form id="send-verification" method="post" action="{{ route('verification.send') }}">
        @csrf
    </form>

    <form method="post" action="{{ route('profile.asignProfile') }}" class="mt-6 space-y-6 row g-3" enctype="multipart/form-data">
        @csrf
        @method('patch')
        <div>
            <label for="dni" class="form-label">DNI</label>
            <x-text-input id="dni" name="dni" type="text" class="mt-1 block w-full" :value="old('dni', $asignProfile->dni)" required autofocus autocomplete="Name" />
            <x-input-error class="mt-2" :messages="$errors->get('dni')" />
        </div>
        <div>
            <label for="country" class="form-label">Country</label>
            <x-text-input id="country" name="country" type="text" class="mt-1 block w-full" :value="old('country', $asignProfile->country)"  required autocomplete="Last Name" />
            <x-input-error class="mt-2" :messages="$errors->get('country')" />
        </div>
        <div>
            <label for="placeBirth" class="form-label">Place of Birth</label>
            <x-text-input id="placeBirth" name="placeBirth" type="text" class="mt-1 block w-full" :value="old('placeBirth', $asignProfile->placeBirth)" required autocomplete="Phone" />
            <x-input-error :messages="$errors->get('placeBirth')" class="mt-2" />
        </div>
        <div>
            <label for="birthdate" class="form-label">Birthdate</label>
            <x-text-input id="birthdate" name="birthdate" type="text" class="mt-1 block w-full" :value="old('birthdate', $asignProfile->birthdate)" require autocomplete="demo" />
            <x-input-error class="mt-2" :messages="$errors->get('birthdate')" />
        </div>
        <div>
        <label for="birthdate" class="form-label">Address</label>
            <x-text-input id="address" name="address" type="text" class="mt-1 block w-full" :value="old('address', $asignProfile->address)" require autocomplete="demo" />
            <x-input-error class="mt-2" :messages="$errors->get('address')" />
        </div>
        <div>
        <label for="birthdate" class="form-label">Postal Code</label>
            <x-text-input id="PostalCode" name="PostalCode" type="text" class="mt-1 block w-full" :value="old('PostalCode', $asignProfile->PostalCode)" require autocomplete="demo" />
            <x-input-error class="mt-2" :messages="$errors->get('PostalCode')" />
        </div>
        <div>
            <label for="birthdate" class="form-label">Digital Contract</label>
            <input id="digitalContract" name="digitalContract" type="file" class="mt-1 block w-full" class="form-control"/>
            <x-input-error class="mt-2" :messages="$errors->get('digitalContract')" />
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
