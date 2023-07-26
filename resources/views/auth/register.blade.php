<x-guest-layout>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.0/jquery.min.js" integrity="sha512-3gJwYpMe3QewGELv8k/BX9vcqhryRdzRMxVfq6ngyWXwo03GFEzjsUm8Q7RZcHPHksttq7/GFoxjCVUjkjvPdw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <form method="POST" action="{{ route('register') }}">
        @csrf

        <!-- Name -->
        <div>
            <x-input-label for="name" :value="__('Name')" />
            <!-- <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" value="xavier" :value="old('name')" required autofocus autocomplete="name" /> -->
            <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" value="xavier" required autofocus autocomplete="name" />
            <x-input-error :messages="$errors->get('name')" class="mt-2" />
        </div>

        <!-- Last Name -->
        <div class="mt-4">
            <x-input-label for="lastName" :value="__('Apellidos')" />
            <!-- <x-text-input id="lastName" class="block mt-1 w-full" type="text" name="lastName" value="xavier" :value="old('lastName')" required autocomplete="lastName" /> -->
            <x-text-input id="lastName" class="block mt-1 w-full" type="text" name="lastName" value="xavier" required autocomplete="lastName" />
            <x-input-error :messages="$errors->get('lastName')" class="mt-2" />
        </div>

        <!-- Email Address -->
        <div class="mt-4">
            <x-input-label for="email" :value="__('Email')" />
            <!-- <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autocomplete="username" /> -->
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" value="xhnl21@gmail.com" required autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Phone -->
        <div class="mt-4">
            <x-input-label for="phone" :value="__('Teléfono')" />
            <!-- <x-text-input id="phone" class="block mt-1 w-full" type="text" name="phone" value="xavier" :value="old('phone')" required autocomplete="phone" /> -->
            <x-text-input id="phone" class="block mt-1 w-full" type="text" name="phone" value="xavier" required autocomplete="phone" />
            <x-input-error :messages="$errors->get('phone')" class="mt-2" />
        </div>
        
        <!-- Sponsor Code -->
        <div class="mt-4">
            <x-input-label for="sponsorCode" :value="__('Código Patrocinador')" />
            <!-- <x-text-input id="sponsorCode" class="block mt-1 w-full" type="text" name="sponsorCode" :value="old('sponsorCode')" required autocomplete="sponsorCode" /> -->
            <x-text-input id="sponsorCode" class="block mt-1 w-full" type="text" name="sponsorCode" value="xavier" required autocomplete="sponsorCode" />
            <x-input-error :messages="$errors->get('sponsorCode')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mt-4">
            <x-input-label for="password" :value="__('Password')" />

            <x-text-input id="password" class="block mt-1 w-full"
                            type="password"
                            name="password"
                            value="12345678"
                            required autocomplete="new-password" />

            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Confirm Password -->
        <div class="mt-4">
            <x-input-label for="password_confirmation" :value="__('Confirm Password')" />

            <x-text-input id="password_confirmation" class="block mt-1 w-full"
                            type="password"
                            value="12345678"
                            name="password_confirmation" required autocomplete="new-password" />

            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
        </div>

        <div class="flex items-center justify-start mt-4">
            <div class="captcha">
                <span>{!! captcha_img('math') !!}</span>
            </div>
            <x-primary-button type="button" class="btn btn-danger reload" id="reload" onclick="openWindow()">
                &#x21bb;
            </x-primary-button>
        </div>
        <div class="mt-4">
            <input type="text" name="captcha">
            <x-input-error :messages="$errors->get('captcha')" class="mt-2" />
        </div>

        <div class="flex items-center justify-end mt-4">
            <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" href="{{ route('login') }}">
                {{ __('Already registered?') }}
            </a>

            <x-primary-button class="ml-4">
                {{ __('Register') }}
            </x-primary-button>
        </div>
    </form>
</x-guest-layout>

<script>
    function openWindow() {
        let url = "{{ url('/') }}";
        $.ajax({
            type:'GET',
            url:url+'/reloadCaptcha',
            success:function (data) {
                $(".captcha span").html(data.captcha)
            }
        })
    }
</script>