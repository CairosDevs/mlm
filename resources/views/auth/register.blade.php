<x-guest-layout>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.0/jquery.min.js"
            integrity="sha512-3gJwYpMe3QewGELv8k/BX9vcqhryRdzRMxVfq6ngyWXwo03GFEzjsUm8Q7RZcHPHksttq7/GFoxjCVUjkjvPdw=="
            crossorigin="anonymous" referrerpolicy="no-referrer"></script>

        <div class="d-flex align-items-center justify-content-center my-lg-0 py-5">
                <div class="container">
                    <div class="row row-cols-1 row-cols-lg-2 row-cols-xl-2">
                        <div class="col mx-auto">
                            <div class="card rounded-4">
                                <div class="card-body">
                                    <div class="border p-4  rounded-4">
                                        <div class="text-center">
                                            <img src="assets/images/logo-icon.png" width="70" alt="" />
                                            <p class="mb-4">{{ __('Create Your New Account')}}</p>
                                        </div>
            
                                        <div class="form-body" >
                                            <form class="row g-3" method="POST" action="{{ route('register') }}">
                                                @csrf

                                                <div class="col-sm-6">
                                                    <label for="name" class="form-label">Nombre</label>
                                                    <input type="text" class="form-control rounded-5 @error('name') is-invalid @enderror" id="name" name="name"  required>
                                                    @error('name')
                                                        <div id="validationName" class="invalid-feedback">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                                <div class="col-sm-6">
                                                    <label for="lastName" class="form-label">Apellido</label>
                                                    <input id="lastName" type="text" class="form-control rounded-5 @error('lastName') is-invalid @enderror" id="lastName" name="lastName" required>
                                                    @error('lastName')
                                                    <div id="validationLastName" class="invalid-feedback">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                                <div class="col-6">
                                                    <label for="inputEmailAddress" class="form-label">Email</label>
                                                    <input type="email" class="form-control rounded-5 @error('email') is-invalid @enderror" id="email" name="email" required>
                                                    @error('email') 
                                                        <div id="validationEmail" class="invalid-feedback">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                                <div class="col-6">
                                                    <x-input-label for="phone" class="form-label" :value="__('Teléfono')" />
                                                    <x-text-input id="phone" class="form-control rounded-5" type="text" name="phone" required autocomplete="phone" />
                                                    <x-input-error :messages="$errors->get('phone')" class="mt-2" />
                                                    @error('phone')
                                                    <div id="validationEmail" class="invalid-feedback">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                                <div class="col-12">
                                                    <x-input-label for="sponsorCode" class="form-label" :value="__('Código Patrocinador')" />                                           
                                                    @if(!empty(Request::segment(2)))
                                                        <input id="sponsorCode" class="form-control rounded-5" type="text" name="sponsorCode" value="{{ Request::segment(2) }}" readonly />
                                                        @if (session('status') === 'invalitReferralCode')
                                                            <p>{{ __('invalit Referral Code')}}</p>
                                                        @endif
                                                    @else
                                                        <x-text-input id="sponsorCode" class="form-control rounded-5" type="text" name="sponsorCode" :value="old('sponsorCode')"
                                                        autocomplete="sponsorCode" />
                                                        <x-input-error :messages="$errors->get('sponsorCode')" class="mt-2" />
                                                    @endif
                                                </div>
                                                <div class="col-12">
                                                    <label for="inputChoosePassword" class="form-label">Contraseña</label>
                                                    <div class="input-group" id="show_hide_password">
                                                        <input type="password" class="form-control rounded-5 @error('password') is-invalid @enderror"
                                                            id="password" name="password" placeholder="Ingrese Contraseña">
                                                        @error('password')
                                                        <div id="validationPassword" class="invalid-feedback">{{ $message }}</div>
                                                        @enderror
                                                    </div>
                                                </div>

                                                <div class="col-12">
                                                    <label for="inputChoosePassword" class="form-label">Confirme contraseña</label>
                                                    <div class="input-group" >
                                                        <input type="password" class="form-control rounded-5 @error('password_confirmation') is-invalid @enderror" id="password_confirmation" name="password_confirmation" placeholder="Repita Contraseña">
                                                        @error('password_confirmation')
                                                        <div id="validationPasswordConfirmation" class="invalid-feedback">{{ $message }}</div>
                                                        @enderror
                                                    </div>
                                                </div>

                                                <div class="col-12">
                                                    <div class="flex items-center justify-start mt-4">
                                                        <div class="captcha text-center">
                                                            <span>{!! captcha_img('flat') !!}</span>
                                                            <x-primary-button type="button" class="btn btn-danger reload" id="reload" onclick="reloadCaptcha()">
                                                                &#x21bb;
                                                            </x-primary-button>
                                                        </div>

                                                    </div>
                                                    <div class="mt-4">
                                                        <input type="text" class="form-control rounded-5" name="captcha">
                                                        <x-input-error :messages="$errors->get('captcha')" class="mt-2" />
                                                    </div>
                                                </div>

                                                <div class="col-12">
                                                    <div class="d-grid">
                                                        <button type="submit" class="btn btn-gradient-info rounded-5"><i
                                                                class='bx bx-user'></i>{{ __('Sign up')}}</button>
                                                    </div>
                                                </div>
                                                
                                                <div class="col-12 text-center">
                                                    <p class="mb-0">{{ __('Already have an account?')}} <a
                                                            href="{{ route('login') }}">{{ __('Sign in here')}}</a></p>
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