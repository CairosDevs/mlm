<div class="col-lg-4">
    <div class="card">
        <div class="card-body">
            <div class="d-flex flex-column align-items-center text-center">
                <img src="assets/images/avatars/avatar-2.png" alt="Admin" class="rounded-circle p-1 bg-primary" width="110">
                <div class="mt-3">
                    <h4>{{$user->name}} {{$user->lastName}}</h4>
                </div>
            </div>
            <hr class="my-4">
            <ul class="list-group list-group-flush">
                <li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
                    <a href="{{ route('profile.edit') }}">
                        <span class="text-secondary">Inicio</span>
                    </a>
                </li>
                <li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
                    <a href="{{ route('validationProfile') }}">
                        <span class="text-secondary">Register</span>
                    </a>
                </li>  
                <li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
                    <a href="{{ route('validationProfile') }}">
                        <span class="text-secondary">Validation Docs</span>
                    </a>
                </li>                              
                <li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
                    @include('profile.partials.asing-pin')
                </li>
                <li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
                    @include('profile.partials.delete-user-form')
                </li>
            </ul>
        </div>
    </div>
</div>