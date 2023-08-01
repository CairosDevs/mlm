<section>
    <header>
        <h2 class="text-lg font-medium text-gray-900">
            {{ __('Safety Pin') }}
        </h2>

        <p class="mt-1 text-sm text-gray-600">
            {{ __('If you activate the PIN, you will protect the sensitive data of your account.') }}
        </p>
    </header>

    <form method="post" action="{{ route('profile.asingPin') }}" class="mt-6 space-y-6" id="sPin">
        @csrf
        @method('post')
        <div>
            <x-input-label for="pin" :value="__('Pin')" />
            @if(isset($asignPin->status))
                @if($asignPin->status)
                    <x-text-input id="pin" name="pin" type="checkbox" checked />
                @else
                    <x-text-input id="pin" name="pin" type="checkbox" />
                @endif
            @else
                <x-text-input id="pin" name="pin" type="checkbox" />
            @endif
            <x-input-error :messages="$errors->get('pin')" class="mt-2" />
        </div>
        <div class="flex items-center gap-4">
        <input name="updatePin" type="text" value="updatePin" />
            <x-primary-button>{{ __('Save') }}</x-primary-button>
        </div>
    </form>
</section>