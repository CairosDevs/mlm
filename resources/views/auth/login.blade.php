<x-guest-layout>
    <!-- Session Status -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.0/jquery.min.js" integrity="sha512-3gJwYpMe3QewGELv8k/BX9vcqhryRdzRMxVfq6ngyWXwo03GFEzjsUm8Q7RZcHPHksttq7/GFoxjCVUjkjvPdw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <x-auth-session-status class="mb-4" :status="session('status')" />

        <div class="section-authentication-signin d-flex align-items-center justify-content-center my-5 my-lg-0">
            <div class="container-fluid">
            <div class="row row-cols-1 row-cols-lg-2 row-cols-xl-3">
                <div class="col mx-auto">
                    <div class="card rounded-4">
                        <div class="card-body">
                            <div class="border p-4 rounded-4">
    
                                <!-- Session Status -->
                                <x-auth-session-status class="mb-4" :status="session('status')" />

                                <div class="text-center mb-2">
                                    <img class="mx-auto" src="{{ asset('template/assets/images/logo-icon.png') }}" width="70" alt="" />
                                </div>
    
                                <div class="form-body">
                                    <form method="POST" action="{{ route('login') }}" class="row g-3">
                                        @csrf
                                        <div class="col-12">
                                            <input type="email" class="form-control rounded-5 @error('email') is-invalid @enderror" name="email" id="email"
                                                placeholder="Email">
                                            @error('email') 
                                                <div id="validationEmail" class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <div class="col-12">
    
                                            <input type="password" class="form-control rounded-5" @error('password') is-invalid @enderror name="password" id="password"
                                                placeholder="Contraseña">
                                                @error('password') 
                                                <div id="validationEmail" class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <div class="flex items-center justify-start mt-4">
                                            <div class="captcha text-center">
                                                <span>{!! captcha_img('flat') !!}</span>
                                                <x-primary-button type="button" class="btn btn-danger reload" id="reload" onclick="reloadCaptcha()">
                                                    &#x21bb;
                                                </x-primary-button>
                                            </div>
                                        </div>
                                        
                                        <div class="mt-4 col-12">
                                            <input type="text" class="form-control rounded-5" name="captcha" placeholder="Captcha">
                                            <x-input-error :messages="$errors->get('captcha')" class="mt-2" />
                                        </div>
    
                                        <div class="col-12">
                                            <div class="d-grid">
                                                <button type="submit" class="btn btn-gradient-info rounded-5"><i
                                                        class="bx bxs-lock-open"></i>{{ __('Log in') }}</button>
                                            </div>
                                        </div>
    
                                        <div class="col-12 text-center">
                                            <p class="mb-0">
                                                    @if (Route::has('password.request'))
                                                    <a href="{{ route('password.request') }}">{{ __('Forgot your password?') }}</a></p>
                                                    @endif
                                        </div>
                                        <div class="col-12 text-center">
                                            <p class="mb-0">{{ __("Don't have an account yet?") }} <a href="{{ route('register') }}">{{ __('Sign up here') }}</a></p>
                                        </div>
                                        <div class="col-12 text-center">
                                            <p class="mb-0">v0.4.1</a></p>
                                        </div>

                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!--end row-->
        </div>

</x-guest-layout>
<script>
    function reloadCaptcha() {
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