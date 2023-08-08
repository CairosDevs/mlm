<div class="card-body">
    <section>
        <header>
            <h2 class="text-lg font-medium text-gray-900">
                {{ __('Safety pin 2FA') }}
            </h2>

            <p class="mt-1 text-sm text-gray-600">
                {{ __('To improve the security of your transactions, activate the security PIN.') }}
            </p>
        </header>
        <form method="post" action="{{ route('profile.asingPin') }}" class="mt-6 space-y-6" id="sPin">
            @csrf
            @method('post')
            <div class="row mb-3">
                <div class="col-sm-1"></div>
                <div class="col-sm-8 text-secondary">
                    @if(isset($asignPin->status) && $asignPin->status)
                        @if($asignPin->status)
                            <input id="pin" name="pin" type="checkbox" checked onclick="event.preventDefault();
                                                        this.closest('form').submit();" style="cursor: pointer;"/>
                        @else
                            <input id="pin" name="pin" type="checkbox" onclick="event.preventDefault();
                                                        this.closest('form').submit();" style="cursor: pointer;"/>
                        @endif  
                    @else
                        <input id="pin" name="pin" type="checkbox" onclick="event.preventDefault();
                                                        this.closest('form').submit();" style="cursor: pointer;"/>
                    @endif
                    <label for="pin" style="cursor: pointer;">PIN 2FA</label>
                    <input name="updatePin" type="hidden" value="updatePin" />
                    <x-input-error :messages="$errors->get('pin')" class="mt-2" />
                </div>
                <div class="col-sm-2"></div>
            </div>
        </form>
        <br>
        @if (!is_null($asignPin))
            <form method="post" action="{{ route('forwardPin') }}" class="mt-6 space-y-6">
                @csrf
                @method('post')
                <div class="row mb-3">
                    <div class="col-sm-1"></div>
                    <div class="col-sm-8 text-secondary">
                        <button type="submit" class="btn btn-primary">{{ __('Forward Pin') }}</button>
                        @if (session('status') === 'forwardPin')
                            <p>{{ __('the security pin has been sent to your email') }}</p>
                        @endif
                    </div>
                    <div class="col-sm-2"></div>
                </div>
            </form>
        @endif
    </section>
</div>
