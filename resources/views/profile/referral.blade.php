<x-app-layout>
    <div class="page-wrapper">
        <div class="page-content">
            <div class="main-body">
                <div class="row">
                    @include('profile.partials.menu')
                    <div class="col-lg-8">
                        <div class="card">
                            @include('profile.partials.list-referral')
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>    
</x-app-layout>