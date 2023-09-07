<x-app-layout>
    <!--start page wrapper -->
    <div class="page-wrapper">
        <div class="page-content">
           
            <div class="row">

                <div class="col-lg-4">
                    <div class="card">
                        <div class="card-body">
                            <div class="d-flex flex-column align-items-center text-center">
                                <a href="{{ Storage::disk('local')->url($user->dni) }}" target="_blank" rel="noopener noreferrer">
                                    <img width="150px" src="{{ Storage::disk('local')->url($user->dni) }}">
                                </a>
                            </div>
                            <hr class="my-4">
                            <div class="d-flex flex-column align-items-center text-center">
                                
                                <a target="_blank" rel="noopener noreferrer" href="{{ Storage::disk('local')->url($user->digitalContract) }}">
                                    <i style="font-size:150px; color:red;" class="lni lni-adobe"></i>
                                </br>  {{ __('Download signed contract')}}
                                </a>
                            </div>
                        </div>
                    </div>
                    <form action="{{ route('profile.StatusUpdate', $user->id ) }}" method="post">
                        @csrf
                        @method('PUT')

                        <button type="submit" class="btn btn-primary">{{  __('Aprove') }}</button>
                        <button class="btn btn-danger">{{ __('Rechazar') }}</button>
                    </form>
                </div>

                <div class="col-lg-8">
                    {{-- //profile data --}}
                    <div class="card">
                        <div class="card-body">
                            <header>
                                <h2 class="text-lg font-medium text-gray-900">
                                    {{ __('Profile Information') }}
                                </h2>
                            </header>
                            <br>
                            
                                <div class="row mb-3">
                                    <div class="col-sm-3">
                                        <h6 class="mb-0">{{ __('First Name') }}</h6>
                                    </div>
                                    <div class="col-sm-9 text-secondary">
                                        <input id="name" name="name" type="text" class="form-control" value="{{ $user->user->name}}"
                                            disabled />
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col-sm-3">
                                        <h6 class="mb-0">{{ __('Last Name') }}</h6>
                                    </div>
                                    <div class="col-sm-9 text-secondary">
                                        <input id="lastName" name="lastName" type="text" class="form-control"
                                            value="{{  $user->user->lastName}}" disabled />
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col-sm-3">
                                        <h6 class="mb-0">{{ __('Phone') }}</h6>
                                    </div>
                                    <div class="col-sm-9 text-secondary">
                                        <input id="phone" name="phone" type="text" class="form-control" value="{{ $user->user->phone}}"
                                            disabled />
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col-sm-3">
                                        <h6 class="mb-0">{{ __('Email') }}</h6>
                                    </div>
                                    <div class="col-sm-9 text-secondary">
                                        <input id="email" name="email" type="email" class="form-control"
                                            value="{{$user->user->email}}" disabled />
                                    </div>
                                </div>
                        </div>
                    </div>

                    {{-- //docs validation --}}
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="card">
                                <div class="card-body">
                                    <h5 class="d-flex align-items-center mb-3">{{ __('Docs pending for validate') }}</h5>

                                    <div class="row mb-3">
                                        <div class="col-sm-3">
                                            <h6 class="mb-0">{{__('Country')}}</h6>
                                        </div>
                                        <div class="col-sm-9 text-secondary">
                                            <input id="country" name="country" type="text" class="form-control"
                                                value="{{ $user->country }}" disabled />
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <div class="col-sm-3">
                                            <h6 class="mb-0">{{ __('Place of Birth')}}</h6>
                                        </div>
                                        <div class="col-sm-9 text-secondary">
                                            <input id="placeBirth" name="placeBirth" type="text" class="form-control"
                                                value="{{ $user->placeBirth }}" disabled/>
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <div class="col-sm-3">
                                            <h6 class="mb-0">{{ __('Birthdate') }}</h6>
                                        </div>
                                        <div class="col-sm-9 text-secondary">
                                            <input id="Birthdate" name="birthdate" type="date" class="form-control"
                                                value="{{ $user->birthdate }}" disabled />
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <div class="col-sm-3">
                                            <h6 class="mb-0">{{ __('Address') }}</h6>
                                        </div>
                                        <div class="col-sm-9 text-secondary">
                                            <input id="Address" name="address" type="text" class="form-control"
                                                value="{{$user->address }}" disabled />
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <div class="col-sm-3">
                                            <h6 class="mb-0">{{ __('Postal Code') }}</h6>
                                        </div>
                                        <div class="col-sm-9 text-secondary">
                                            <input id="PostalCode" name="postalCode" type="text" class="form-control"
                                                value="{{  $user->PostalCode }}" disabled />
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
    <!--end page wrapper -->

<script>
        $(document).ready(function () {

    
    		});
    </script>
</x-app-layout>

