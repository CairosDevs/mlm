<section>
    <header>
        <h2 class="text-lg font-medium text-gray-900">
            {{ __('Safety pin') }}
        </h2>

        <p class="mt-1 text-sm text-gray-600">
            {{ __('In order to make changes it is necessary to enter the security pin.') }}
        </p>
    </header>
    38deaa0c-f9d6-4934-9655-16281eef1e36
    <form method="post" action="{{ route('pin.validatePinUser') }}" class="mt-6 space-y-6">
        @csrf
        @method('post')
        <div>
            <x-input-label for="pinProfile" :value="__('Enter Pin')" />
            <x-text-input id="pinProfile" name="pinProfile" type="text" class="mt-1 block w-full" autocomplete="Pin" />
            <x-input-error :messages="$errors->get('pinProfile')" class="mt-2" />
        </div>
        <div>
            <x-text-input name="name" type="hidden" value="{{$request->name}}" />
            <x-text-input name="lastName" type="hidden" value="{{$request->lastName}}" />
            <x-text-input name="phone" type="hidden" value="{{$request->phone}}" />
            <x-text-input name="sponsorCode" type="hidden" value="{{$request->sponsorCode}}" />
            <x-text-input name="email" type="hidden" value="{{$request->email}}" />
            <x-text-input name="user_id" type="hidden" value="{{$request->user_id}}" />
            <input type="hidden" name="profileInfo" value="{{$request->profileInfo}}">
        </div>
        <div>
            <x-text-input name="asignProfile" type="hidden" value="{{$request->asignProfile}}" />
            <x-text-input name="dni" type="hidden" value="{{$request->dni}}" />
            <x-text-input name="country" type="hidden" value="{{$request->country}}"  />
            <x-text-input name="placeBirth" type="hidden" value="{{$request->placeBirth}}"  />
            <x-text-input name="birthdate" type="hidden" value="{{$request->birthdate}}"  />
            <x-text-input name="address" type="hidden" value="{{$request->address}}"  />
            <x-text-input name="PostalCode" type="hidden" value="{{$request->PostalCode}}"  />
            <x-text-input name="doc" type="hidden" value="{{$request->doc}}"  />
        </div>
        <div>
            <x-text-input name="current_password" type="hidden" value="{{$request->current_password}}" />
            <x-text-input name="password" type="hidden" value="{{$request->password}}" />
            <x-text-input name="password_confirmation" type="hidden" value="{{$request->password_confirmation}}" />
            <input name="updatePassord" type="hidden" value="{{$request->updatePassord}}" />
        </div>

        <div>
            <x-text-input name="pin" type="text" value="{{$request->pin}}" />
            <input name="updatePin" type="text" value="{{$request->updatePin}}" />
        </div>
        
        <div class="flex items-center gap-4">
            <x-primary-button>{{ __('Save') }}</x-primary-button>
        </div>
    </form>
</section>
