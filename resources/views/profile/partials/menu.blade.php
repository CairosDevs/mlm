<div class="col-lg-4">
    <div class="card">
        <div class="card-body">
            <div class="d-flex flex-column align-items-center text-center">
                <div class="mt-3">
                    <h4>{{$user->name}} {{$user->lastName}}</h4>
                </div>
            </div>
            <hr class="my-4">
            <ul class="list-group list-group-flush">
                <li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
                    @if (Request::segment(1) == 'profile')
                        <a href="{{ route('profile.edit') }}">
                            <i class="bx bxs-check-circle" style="color:green;"></i>
                            <span class="text-secondary">{{ __('Registrated')}}</span>
                        </a>
                    @else
                        <a href="{{ route('editProfile') }}">
                            <i class="bx bxs-check-circle" style="color:green;"></i>
                            <span class="text-secondary">{{ __('Registrated')}}</span>
                        </a>
                    @endif
                </li>
                 
                <li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
                    <a href="{{ route('editValidate') }}">
                        @if (is_null($asignProfile) || (isset($asignProfile->status) && !$asignProfile->status))
                        <i class="lni lni-cross-circle" style="color:red"></i>
                        @else
                        <i class="bx bxs-check-circle" style="color:green;"></i>
                        @endif
                        <span class="text-secondary">{{ __('Validation Docs') }}</span>
                    </a>
                </li>                              
                <li class="list-group-item d-flex justify-content-between align-items-center flex-wrap"> 
                    <a href="{{ route('viewPin') }}" style="cursor:pointer !important;">
                        @if (is_null($asignProfile) || (isset($asignProfile->status) && !$asignProfile->status))
                            <i class="lni lni-cross-circle" style="color:red"></i>
                            <label style="cursor:pointer !important;">PIN 2FA</label>
                        @else
                            <i class="bx bxs-check-circle" style="color:green;"></i>
                            <label style="cursor:pointer !important;">PIN 2FA</label>
                        @endif
                    </a>
                </li>
            </ul>
        </div>
    </div>
</div>