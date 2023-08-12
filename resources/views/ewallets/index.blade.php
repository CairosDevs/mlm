<x-app-layout>
    <!--start page wrapper -->
    <div class="page-wrapper">
        <div class="page-content">
            <div class="row">
                <form action="{{ route('ewallets.store') }}" method="post">
                    @csrf
                    <div class="card radius-10">
                        <div class="card-body">
                            <div>
                                <h6 class="mb-5">{{ __('Save Wallet') }}</h6>
                            </div>
                            <div class="row mb-3">
                                <div class="col-sm-3">
                                    <h6 class="mb-0">{{  __('Wallet Address') }}</h6>
                                </div>
                                <div class="col-sm-9 text-secondary">
                                    <input type="text" name="wallet_id" class="form-control @error('wallet_id') is-invalid @enderror"  @if(isset($ewallet)) value='{{$ewallet->wallet_id}}' @else placeholder='Porfavor agrega la dirección de tu wallet' @endif >
                                    @error('wallet_id')
                                    <div id="validationPasswordConfirmation" class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                    <div data-lastpass-icon-root="true"
                                        style="position: relative !important; height: 0px !important; width: 0px !important; float: left !important;">
                                    </div>
                                </div>
                            </div>
                            <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">
                            <div class="row">
                                <div class="col-sm-3"></div>
                                <div class="col-sm-9 text-secondary">
                                    <input type="submit" class="btn btn-primary px-4" value="{{ __('Save') }}">
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!--end page wrapper -->

<script>
        
</script>
</x-app-layout>

