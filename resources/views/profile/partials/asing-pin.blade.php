<form method="post" action="{{ route('profile.asingPin') }}" class="mt-6 space-y-6" id="sPin">
    @csrf
    @method('post')
    <div>
        @if (isset($asignProfile->status) && !$asignProfile->status)
            <i class="lni lni-cross-circle" style="color:red"></i>
            <label for="pin">PIN 2FA</label>
        @else
            @if(isset($asignPin->status) && $asignPin->status)
                <i class="bx bxs-check-circle" style="color:green;"></i>
                @if($asignPin->status)
                    <input id="pin" name="pin" type="checkbox" checked onclick="event.preventDefault();
                                                this.closest('form').submit();" style="cursor: pointer;"/>
                @else
                    <input id="pin" name="pin" type="checkbox" onclick="event.preventDefault();
                                                this.closest('form').submit();" style="cursor: pointer;"/>
                @endif  
            @else
                <i class="lni lni-cross-circle" style="color:red"></i>
                <input id="pin" name="pin" type="checkbox" onclick="event.preventDefault();
                                                this.closest('form').submit();" style="cursor: pointer;"/>
            @endif
            <label for="pin" style="cursor: pointer;">PIN 2FA</label>
            <input name="updatePin" type="hidden" value="updatePin"  style="cursor: pointer;"/>
            <x-input-error :messages="$errors->get('pin')" class="mt-2" />
        @endif
    </div>
</form>