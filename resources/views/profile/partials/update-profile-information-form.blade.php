<div class="card-body">
    <header>
        <h2 class="text-lg font-medium text-gray-900">
            {{ __('Profile Information') }}
        </h2>

        <p class="mt-1 text-sm text-gray-600">
            {{ __("Update your account's profile information.") }}
        </p>
    </header>
    <br>
    <form id="send-verification" method="post" action="{{ route('verification.send') }}">
        @csrf
    </form>
    <form method="post" action="{{ route('profile.update') }}" class="mt-6 space-y-6 row g-3">
        @csrf
        @method('patch')
        <div class="row mb-3">
            <div class="col-sm-3">
                <h6 class="mb-0">{{ __('First Name') }}</h6>
            </div>
            <div class="col-sm-9 text-secondary">
                <input id="name" name="name" type="text" class="form-control" value="{{old('name') ?? $user->name}}" required autofocus autocomplete="Name" />
                <x-input-error class="mt-2" :messages="$errors->get('name')" />
            </div>
        </div>
        <div class="row mb-3">
            <div class="col-sm-3">
                <h6 class="mb-0">{{  __('Last Name') }}</h6>
            </div>
            <div class="col-sm-9 text-secondary">
                <input id="lastName" name="lastName" type="text" class="form-control" value="{{old('lastName') ?? $user->lastName}}"  required autocomplete="Last Name" />
                <x-input-error class="mt-2" :messages="$errors->get('lastName')" />
            </div>
        </div>
        <div class="row mb-3">
            <div class="col-sm-3">
                <h6 class="mb-0">{{ __('Phone') }}</h6>
            </div>
            <div class="col-sm-9 text-secondary">
                <input id="phone" name="phone" type="text" class="form-control" value="{{old('phone') ?? $user->phone}}" required autocomplete="Phone" />
                <x-input-error :messages="$errors->get('phone')" class="mt-2" />
            </div>
        </div>
        <div class="row mb-3">
            <div class="col-sm-3">
                <h6 class="mb-0">{{ __('Sponsor Code') }}</h6>
            </div>
            <div class="col-sm-9 text-secondary">
                <input id="sponsorCode" name="sponsorCode" type="text" class="form-control" value="{{old('sponsorCode') ?? $user->sponsorCode}}" readonly />
            </div>
        </div>
        <div class="row mb-3">
            <div class="col-sm-3">
                <h6 class="mb-0">{{ __('Email') }}</h6>
            </div>
            <div class="col-sm-9 text-secondary">
                <input id="email" name="email" type="email" class="form-control" value="{{old('email') ?? $user->email}}" readonly />
                <x-input-error :messages="$errors->get('email')" class="mt-2" />
            </div>
        </div>
        <div class="row">
            <div class="col-sm-3"></div>
            <div class="col-sm-9 text-secondary">
                <input type="hidden" name="profileInfo" value="profileInfo">
                <input type="submit" class="btn btn-primary px-4" value="{{ __('Save Changes')}}">
                @if (session('status') === 'profile-updated')
                    <p>{{ __('Saved.') }}</p>
                @endif                
            </div>
        </div>
    </form>
</div>