<x-guest-layout>
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
                                                    <label for="name" class="form-label">First Name</label>
                                                    <input type="text" class="form-control rounded-5" id="name" name="name"
                                                        placeholder="Jhon">
                                                </div>
                                                <div class="col-sm-6">
                                                    <label for="lastName" class="form-label">Last Name</label>
                                                    <input id="lastName" type="text" class="form-control rounded-5" id="lastName" name="lastName"
                                                        placeholder="Deo">
                                                </div>
                                                <div class="col-12">
                                                    <label for="inputEmailAddress" class="form-label">Email Address</label>
                                                    <input type="email" class="form-control rounded-5" id="email" name="email"
                                                        placeholder="example@user.com">
                                                </div>
                                                <div class="col-12">
                                                    <label for="inputChoosePassword" class="form-label">Password</label>
                                                    <div class="input-group" id="show_hide_password">
                                                        <input type="password" class="form-control rounded-5"
                                                            id="password" name="password" placeholder="Enter Password">
                                                    </div>
                                                </div>

                                                <div class="col-12">
                                                    <label for="inputChoosePassword" class="form-label">Password confirmation</label>
                                                    <div class="input-group" >
                                                        <input type="password" class="form-control rounded-5" id="password_confirmation" name="password_confirmation" placeholder="Repeat Password">
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
