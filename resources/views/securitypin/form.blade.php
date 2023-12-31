<section>
    <header>
        <h2 class="text-lg font-medium text-gray-900">
            {{ __('Safety pin 2FA') }}
        </h2>

        <p class="mt-1 text-sm text-gray-600">
            {{ __('In order to make changes it is necessary to enter the security pin.') }}
        </p>
        <p class="mt-1 text-sm text-gray-600">
            {{ __('the security pin has been sent to your email') }}
        </p>
    </header>
    <form method="post" action="{{ route('pin.validatePinUser') }}" class="mt-6 space-y-6">
        @csrf
        @method('post')
        <div>
            <label for="pinProfile" :value="__('Enter Pin')" ></label>
            <input id="pinProfile" name="pinProfile" type="text" class="form-control" autocomplete="Pin" />
            @if (session('status') === 'error-pin')
                <p>{{ __('Pin invalid.') }}</p>
            @endif
        </div>
        <div>
            <input name="name" type="hidden" @if (isset($request->name)) value="{{$request->name}}" @endif />
            <input name="lastName" type="hidden" @if (isset($request->lastName)) value="{{$request->lastName}}" @endif />
            <input name="phone" type="hidden" @if (isset($request->phone)) value="{{$request->phone}}" @endif />
            <input name="sponsorCode" type="hidden" @if (isset($request->sponsorCode)) value="{{$request->sponsorCode}}" @endif  />
            <input name="email" type="hidden" @if (isset($request->email)) value="{{$request->email}}" @endif  />
            <input name="user_id" type="hidden" @if (isset($request->user_id)) value="{{$request->user_id}}" @else value="{{Request::segment(2)}}" @endif />
            <input type="hidden" name="profileInfo" @if (isset($request->profileInfo)) value="{{$request->profileInfo}}" @endif />
        </div>
        <div>
            <input name="asignProfile" type="hidden" @if (isset($request->asignProfile)) value="{{$request->asignProfile}}" @endif/>
            <input name="dni" type="hidden" @if (isset($request->dni)) value="{{$request->dni}}" @endif/>
            <input name="country" type="hidden" @if (isset($request->country)) value="{{$request->country}}" @endif/>
            <input name="placeBirth" type="hidden"  @if (isset($request->placeBirth)) value="{{$request->placeBirth}}" @endif/>
            <input name="birthdate" type="hidden" @if (isset($request->birthdate)) value="{{$request->birthdate}}" @endif/>
            <input name="address" type="hidden" @if (isset($request->address)) value="{{$request->address}}" @endif/>
            <input name="PostalCode" type="hidden" @if (isset($request->PostalCode)) value="{{$request->PostalCode}}" @endif/>
            <input name="doc" type="hidden" @if (isset($request->doc)) value="{{$request->doc}}" @endif/>
        </div>
        <div>
            <input name="password" type="hidden" @if (isset($request->password)) value="{{$request->password}}" @endif/>
            <input name="updatePassord" type="hidden" @if (isset($request->updatePassord)) value="{{$request->updatePassord}}" @endif/>
        </div>

        <div>
            <input name="pin" type="hidden" @if (isset($request->pin)) value="{{$request->pin}}" @endif/>
            <input name="updatePin" type="hidden" @if (isset($request->updatePin)) value="{{$request->updatePin}}" @endif/>
            <input name="pinView" type="hidden"  value="{{Request::segment(3)}}" />
        </div>
        <input name="editValidate" type="hidden" @if (isset($request->editValidate)) value="{{$request->editValidate}}" @endif/>
        <input name="editProfile" type="hidden" @if (isset($request->editProfile)) value="{{$request->editProfile}}" @endif/>
        <div class="flex items-center gap-4" style="text-align: center;">
            <br>
            <button class="btn btn-primary">{{ __('Send') }}</button>
        </div>
    </form>
</section>
