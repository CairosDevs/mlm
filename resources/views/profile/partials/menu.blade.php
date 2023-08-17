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
                    
                    <a href="{{ (is_null($asignProfile) || !$asignProfile->status) ? "#": route('viewPin') }}" 
                    
                        style="cursor:pointer !important;"
                     >
                    
                        @if (is_null($asignPin))
                            <i class="lni lni-cross-circle" style="color:red"></i>
                            <label style="cursor:pointer !important;">PIN 2FA</label>
                        @else
                            <i class="bx bxs-check-circle" style="color:green;"></i>
                            <label style="cursor:pointer !important;">PIN 2FA</label>
                        @endif
                    </a>
                </li>
                <li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
                
                    <a href="{{ (is_null($asignPin)) ? " #": route('payment.membership') }}"
                        style="cursor:pointer !important;">
                
                        @if (is_null($membership))
                        <i class="lni lni-cross-circle" style="color:red"></i>
                        <label style="cursor:pointer !important;">{{ __('Membership')}}</label>
                        @else
                        <i class="bx bxs-check-circle" style="color:green;"></i>
                        <label style="cursor:pointer !important;">{{ __('Membership')}}</label>
                        @endif
                    </a>
                </li>
            </ul>
        </div>
    </div>
    @if (!is_null($membership))
        <div class="card">
            <div class="card-body">
                <div class="d-flex flex-column align-items-center text-center">
                    <div class="mt-3">
                        <h4>{{ __('Referral') }}</h4>
                    </div>
                </div>
                <hr class="my-4">
                <ul class="list-group list-group-flush">
                    <li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
                        <a href="{{ route('profile.referral') }}">
                            <i class="bx bxs-check-circle" style="color:green;"></i>
                            <span class="text-secondary">{{ __('Referral List.') }}</span>
                        </a>
                    </li>  
                    <li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
                        <div class="input-group">
                            <input type="text" class="form-control" id="referralLink" readonly value="{{$referral_url}}">
                            <div class="input-group-append">
                                <button class="btn btn-sm btn-primary" onclick="copyReferralLink()">
                                    <i class="bx bx-copy"></i> Copy
                                </button>
                            </div>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
    @endif
</div>
<script>
    function copyReferralLink() {
    var input = document.getElementById("referralLink");

    // Select the input
    input.select();
    // For mobile devices
    input.setSelectionRange(0, 99999); 

    // Copy the text inside the input
    document.execCommand("copy");

    // Confirmed copied text
    alert("Your referral link has been copied: " + input.value);
}
</script>