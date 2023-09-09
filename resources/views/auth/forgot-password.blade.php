<x-guest-layout>
    <form method="POST" action="{{ route('password.email') }}">
        @csrf
        <div class="wrapper">
            <div class="authentication-forgot d-flex align-items-center justify-content-center">
                <div class="card forgot-box rounded-4">
                    <div class="card-body">
                        <x-auth-session-status class="mb-4" :status="session('status')" />
                        <div class="p-4 rounded-4  border">
                            <div class="text-center">
                                <img class="mx-auto" src="{{ asset('template/assets/images/logo-icon.png') }}" width="120" alt="" />
                            </div>
                            <h4 class="mt-5 font-weight-bold">{{  __('Olvido su contraseña?') }}</h4>
                            <p class="text-muted">{{ __('Ingrese su correo para reiniciar su contraseña') }}</p>
                            <div class="my-4">
                                <label class="form-label">Email</label>
                                <input type="text" name="email" class="form-control form-control-lg rounded-5 @error('email') is-invalid @enderror"
                                    placeholder="example@user.com" />
                                @error('email')
                                <div id="validationEmail" class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="d-grid gap-2">
                                <button type="submit" class="btn btn-gradient-primary btn-lg rounded-5">{{ __('Enviar link de reinicio') }}</button>
                                <a href="{{ route('login') }}" class="btn btn-light btn-lg rounded-5"><i
                                        class='bx bx-arrow-back me-1'></i>{{ __('Regresar a inicio') }}</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
</x-guest-layout>
