<x-guest-layout>
    <form method="POST" action="{{ route('password.create.store') }}">
        @csrf

        <div class="wrapper">
            <div class="authentication-reset-password d-flex align-items-center justify-content-center">
                <div class="row">
                    <div class="col-12 col-lg-10 mx-auto">
                        <div class="card rounded-5 overflow-hidden">
                            <div class="row g-0 align-items-center">
                                <div class="col-lg-6 border-end">
                                    <div class="card-body">
                                        <div class="p-5">
                                            <div class="text-start">
                                                <img class="mx-auto"
                                                    src="{{ asset('template/assets/images/logo-icon.png') }}"
                                                    width="180" alt="">
                                            </div>
                                            <h4 class="mt-5 font-weight-bold">{{ __('Generate New Password') }}</h4>
                                            
                                            <div class="mb-3 mt-5">
                                                <label class="form-label">{{ __('Password') }}</label>
                                                <input name="password" type="password"
                                                    class="form-control rounded-5 @error('password') is-invalid @enderror"
                                                    placeholder="Enter new password" />
                                                @error('password')
                                                <div id="validationEmail" class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                            <div class="mb-4">
                                                <label class="form-label">{{ _('Confirm Password')}}</label>
                                                <input name="password_confirmation" type="password"
                                                    class="form-control rounded-5 @error('password_confirmation') is-invalid @enderror"
                                                    placeholder="Confirm password" />
                                                @error('password_confirmation')
                                                <div id="validationEmail" class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                            <div class="d-grid gap-3">
                                                <button type="submit" class="btn btn-gradient-info rounded-5">{{
                                                    __('Create
                                                    Password')}}</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>


</x-guest-layout>