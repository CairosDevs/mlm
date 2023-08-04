<x-guest-layout>
<div class="section-authentication-signin d-flex align-items-center justify-content-center my-5 my-lg-0">
            <div class="container-fluid">
            <div class="row row-cols-1 row-cols-lg-2 row-cols-xl-3">
                <div class="col mx-auto">
                    <div class="card rounded-4">
                        <div class="card-body">
                            <div class="border p-4 rounded-4">
                                <div class="text-center mb-2">
                                    <img class="mx-auto" src="{{ asset('template/assets/images/logo-icon.png') }}" width="70" alt="" />
                                </div>
                                <div class="form-body">
                                    @include('securitypin.form')
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!--end row-->
        </div>


</x-guest-layout>