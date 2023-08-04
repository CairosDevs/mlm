<div class="card-body">
    <section>
        <header>
            <h2 class="text-lg font-medium text-gray-900">
                {{ __('Validation Docs') }}
            </h2>

            <p class="mt-1 text-sm text-gray-600">
                {{ __("Update your account's criteria of acceptance.") }}
            </p>
        </header>
    </section>
    <br>
    <form id="send-verification" method="post" action="{{ route('verification.send') }}">
        @csrf
    </form>

    <form method="post" action="{{ route('profile.asignProfile') }}" class="mt-6 space-y-6 row g-3" enctype="multipart/form-data">
        @csrf
        @method('patch')
        <div class="row mb-3">
            <div class="col-sm-3">
                <h6 class="mb-0">{{ __('DNI')}}</h6>
            </div>
            <div class="col-sm-9 text-secondary">
                <input id="dni" name="dni" type="text" class="form-control" value="{{old('dni') ?? $asignProfile->dni ?? ''}}" required autocomplete="Name" />
                <x-input-error class="mt-2" :messages="$errors->get('dni')" />
            </div>
        </div>
        <div class="row mb-3">
            <div class="col-sm-3">
                <h6 class="mb-0">{{__('Country')}}</h6>
            </div>
            <div class="col-sm-9 text-secondary">
                <input id="country" name="country" type="text" class="form-control" value="{{old('country') ?? $asignProfile->country ?? ''}}" required autocomplete="Country" />
                <x-input-error class="mt-2" :messages="$errors->get('country')" />
            </div>
        </div>
        <div class="row mb-3">
            <div class="col-sm-3">
                <h6 class="mb-0">{{ __('Place of Birth')}}</h6>
            </div>
            <div class="col-sm-9 text-secondary">
                <input id="placeBirth" name="placeBirth" type="text" class="form-control" value="{{old('placeBirth') ?? $asignProfile->placeBirth ?? ''}}" required autocomplete="Place of Birth" />
                <x-input-error class="mt-2" :messages="$errors->get('placeBirth')" />
            </div>
        </div>
        <div class="row mb-3">
            <div class="col-sm-3">
                <h6 class="mb-0">{{ __('Birthdate') }}</h6>
            </div>
            <div class="col-sm-9 text-secondary">
                <input id="Birthdate" name="Birthdate" type="text" class="form-control" value="{{old('Birthdate') ?? $asignProfile->Birthdate ?? ''}}" required autocomplete="Birthdate" />
                <x-input-error class="mt-2" :messages="$errors->get('Birthdate')" />
            </div>
        </div>
        <div class="row mb-3">
            <div class="col-sm-3">
                <h6 class="mb-0">{{  __('Address') }}</h6>
            </div>
            <div class="col-sm-9 text-secondary">
                <input id="Address" name="Address" type="text" class="form-control" value="{{old('Address') ?? $asignProfile->Address ?? ''}}" required autocomplete="Address" />
                <x-input-error class="mt-2" :messages="$errors->get('Address')" />
            </div>
        </div>
        <div class="row mb-3">
            <div class="col-sm-3">
                <h6 class="mb-0">{{ __('Postal Code') }}</h6>
            </div>
            <div class="col-sm-9 text-secondary">
                <input id="PostalCode" name="PostalCode" type="text" class="form-control" value="{{old('PostalCode') ?? $asignProfile->PostalCode ?? ''}}" required autocomplete="Postal Code" />
                <x-input-error class="mt-2" :messages="$errors->get('PostalCode')" />
            </div>
        </div>
        <div class="row mb-3">
            <div class="col-sm-3">
                <h6 class="mb-0">{{ __('Digital Contract') }}</h6>
            </div>
            <div class="col-sm-9 text-secondary">
                <input id="digitalContract" name="digitalContract" type="text" class="form-control" value="{{old('digitalContract') ?? $asignProfile->digitalContract ?? ''}}" required autocomplete="Digital Contract" />
                <x-input-error class="mt-2" :messages="$errors->get('digitalContract')" />
                    <span><a href="{{ asset('contract/contrato.pdf') }}" download rel="noopener noreferrer">{{ __('Download contract to sign')}}</a></span>
            </div>
            
        </div>        
        <div class="row">
            <div class="col-sm-3"></div>
            <div class="col-sm-9 text-secondary">
                <input type="hidden" name="asignProfile" value="asignProfile">
                <input type="button" class="btn btn-primary px-4" value="{{ __('Save Changes') }}">
                @if (session('status') === 'profile-updated')
                    <p>{{ __('Saved.') }}</p>
                @endif                
            </div>
        </div>
    </form>
</div>