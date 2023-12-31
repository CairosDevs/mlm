<x-app-layout>

<!--start page wrapper -->
    <div class="page-wrapper">
        <div class="page-content">

            <div class="main-body">
                <div class="row">
                    @include('profile.partials.menu')
                    <div class="col-lg-8">
                        <div class="card">
                            @include('profile.partials.update-profile-information-form')
                        </div>
                        <div class="card">
                            @include('profile.partials.update-password-form')
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>    
</x-app-layout>
