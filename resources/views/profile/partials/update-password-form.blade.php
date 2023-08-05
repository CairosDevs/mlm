<div class="card-body">
    <section>
        <header>
            <h2 class="text-lg font-medium text-gray-900">
                {{ __('Update Password') }}
            </h2>

            <p class="mt-1 text-sm text-gray-600">
                {{ __('Ensure your account is using a long, random password to stay secure.') }}
            </p>
        </header>
    </section>
    <br>
    <form method="post" action="{{ route('password.update') }}" class="mt-6 space-y-6">
        @csrf
        @method('put')
        <div class="row mb-3">
            <div class="col-sm-3">
                <h6 class="mb-0">{{  __('Current Password') }}</h6>
            </div>
            <div class="col-sm-9 text-secondary">
                <input id="current_password" name="current_password" type="password" class="form-control" autocomplete="current-password" />
                <x-input-error :messages="$errors->get('current_password')" class="mt-2" />
            </div>
        </div>
        <div class="row mb-3">
            <div class="col-sm-3">
                <h6 class="mb-0">{{  __('New Password') }}</h6>
            </div>
            <div class="col-sm-9 text-secondary">
                <input id="password" name="password" type="password" class="form-control" autocomplete="new-password" />
                <x-input-error :messages="$errors->get('password')" class="mt-2" />
            </div>
        </div> 
        <div class="row mb-3">
            <div class="col-sm-3">
                <h6 class="mb-0">{{ __('Confirm Password')}}</h6>
            </div>
            <div class="col-sm-9 text-secondary">
                <input id="password_confirmation" name="password_confirmation" type="password" class="form-control" autocomplete="confirm-password" />
                <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
            </div>
        </div> 
        <div class="row">
            <div class="col-sm-3"></div>
            <div class="col-sm-9 text-secondary">
                <input type="hidden" name="updatePassord" value="updatePassord">
                <input type="submit" class="btn btn-primary px-4" value="{{ __('Save Changes') }}">
                @if (session('status') === 'password-updated')
                    <p>{{ __('Saved.') }}</p>
                @endif
            </div>
        </div> 
    </form>
</div>
