<form method="post" action="{{ route('profile.asingPin') }}" class="mt-6 space-y-6" id="sPin">
    @csrf
    @method('post')
    <div>
        @if(isset($asignPin->status))
            <i class="bx bxs-check-circle" style="color:green;"></i>
            @if($asignPin->status)
                <input id="pin" name="pin" type="checkbox" checked />
            @else
                <input id="pin" name="pin" type="checkbox" />
            @endif
            <label for="pin">PIN 2FA</label>
            <input name="updatePin" type="hidden" value="updatePin" />
            <button class="btn btn-primary">{{ __('Save') }}</button>
            <x-input-error :messages="$errors->get('pin')" class="mt-2" />
        @else
            <i class="lni lni-cross-circle" style="color:red"></i>
            <label for="pin">PIN 2FA</label>
        @endif
    </div>
</form>