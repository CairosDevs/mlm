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
    {{-- <form id="send-verification" method="post" action="{{ route('verification.send') }}" enctype="multipart/form-data">
        @csrf
    </form> --}}

    <form method="post" action="{{ route('profile.asignProfile') }}" class="mt-6 space-y-6 row g-3" enctype="multipart/form-data">
        @csrf
        @method('post')
        <div class="row mb-3">
            <div class="col-sm-3">                
                <h6 class="mb-0">{{ __('DNI')}}</h6>
            </div>
            @if (!is_null($asignProfile) && !is_null($asignProfile->dni))
            <div class="col-sm-1 text-secondary">
                 <img width="30px" src="{{ Storage::disk('local')->url($asignProfile->dni) }}">
            </div>
            <div class="col-sm-8 text-secondary">
                <input id="dni" name="dni" type="file" class="form-control" value="{{old('dni') ?? $asignProfile->dni ?? ''}}"
                    required autocomplete="Name" />
                <x-input-error class="mt-2" :messages="$errors->get('dni')" />
            </div>
            @else
            <div class="col-sm-9 text-secondary">
                <input id="dni" name="dni" type="file" class="form-control" value="{{old('dni') ?? $asignProfile->dni ?? ''}}"
                    required autocomplete="Name" />
                <x-input-error class="mt-2" :messages="$errors->get('dni')" />
            </div>
            @endif
            
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
                <input id="Birthdate" name="birthdate" type="date" class="form-control" value="{{old('birthdate') ?? $asignProfile->birthdate ?? ''}}" required />
                <x-input-error class="mt-2" :messages="$errors->get('Birthdate')" />
            </div>
        </div>
        <div class="row mb-3">
            <div class="col-sm-3">
                <h6 class="mb-0">{{  __('Address') }}</h6>
            </div>
            <div class="col-sm-9 text-secondary">
                <input id="Address" name="address" type="text" class="form-control" value="{{old('address') ?? $asignProfile->address ?? ''}}" required autocomplete="Address" />
                <x-input-error class="mt-2" :messages="$errors->get('address')" />
            </div>
        </div>
        <div class="row mb-3">
            <div class="col-sm-3">
                <h6 class="mb-0">{{ __('Postal Code') }}</h6>
            </div>
            <div class="col-sm-9 text-secondary">
                <input id="PostalCode" name="postalCode" type="text" class="form-control" value="{{old('postalCode') ?? $asignProfile->PostalCode ?? ''}}" required autocomplete="Postal Code" />
                <x-input-error class="mt-2" :messages="$errors->get('postalCode')" />
            </div>
        </div>
        <div class="row mb-3">
            <div class="col-sm-3">
                <h6 class="mb-0">{{ __('Digital Contract') }}</h6>
            </div>
            @if (!is_null($asignProfile) && !is_null($asignProfile->digitalContract))
                <div class="col-sm-1 text-secondary">
                    <a download href="{{ Storage::disk('local')->url($asignProfile->digitalContract) }}">
                        <i style="font-size:30px; color:red;" class="lni lni-adobe"></i>
                    </a>
                    
                </div>
                <div class="col-sm-8 text-secondary">
                    <input id="digitalContract" name="digitalContract" type="file" class="form-control"
                        value="{{old('digitalContract') ?? $asignProfile->digitalContract ?? ''}}" required
                        autocomplete="Digital Contract" />
                    <x-input-error class="mt-2" :messages="$errors->get('digitalContract')" />
                    <span><a href="{{ asset('contract/contrato.pdf') }}" download rel="noopener noreferrer">{{ __('Download contract to
                            sign')}}</a></span>
                </div>
            @else
                <div class="col-sm-9 text-secondary">
                    <input id="digitalContract" name="digitalContract" type="file" class="form-control"
                        value="{{old('digitalContract') ?? $asignProfile->digitalContract ?? ''}}" required
                        autocomplete="Digital Contract" />
                    <x-input-error class="mt-2" :messages="$errors->get('digitalContract')" />
                    <span><a href="{{ asset('contract/contrato.pdf') }}" download rel="noopener noreferrer">{{ __('Download contract to
                            sign')}}</a></span>
                </div>
            @endif
            
            
            
        </div>        
        <div class="row">
            <div class="col-sm-3"></div>
            <div class="col-sm-9 text-secondary">
                <input type="hidden" name="asignProfile" value="asignProfile">
                <input type="submit" class="btn btn-primary px-4" value="{{ __('Request Validation') }}">
                @if (session('status') === 'profile-updated')
                    <p>{{ __('Saved.') }}</p>
                @endif                
            </div>
        </div>
    </form>
</div>