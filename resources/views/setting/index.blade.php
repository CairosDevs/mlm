<x-app-layout>
    <!--start page wrapper -->
    <div class="page-wrapper">
        <div class="page-content">
            <div class="container py-5">
 
                <form method="POST" action="{{ route('setting.store') }}" >
                    @csrf
                
                    <div class="row">
                        <div class="col-lg-9">
                            <div class="card">
                                <div class="card-body">
                                    <h5 class="d-flex align-items-center mb-3">{{ __('Add new enviroment variable') }}</h5>
                                        <div class="row mb-3">
                                            
                                            <div class="col-sm-9 text-secondary">
                                                <input type="text" class="form-control" name="key" placeholder="Nombre">
                                                <div data-lastpass-icon-root="true"
                                                    style="position: relative !important; height: 0px !important; width: 0px !important; float: left !important;">
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row mb-3">
                                            
                                            <div class="col-sm-9 text-secondary">
                                                <input type="text" class="form-control" name="value" placeholder="Valor">
                                                <div data-lastpass-icon-root="true"
                                                    style="position: relative !important; height: 0px !important; width: 0px !important; float: left !important;">
                                                </div>
                                            </div>
                                        </div>

                                    <div class="row">
                                        
                                        <div class="col-sm-9 text-secondary">
                                            <input type="submit" class="btn btn-primary px-4" value="{{ __('Add new variable')}}">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
                <div class="row">
                    <div class="col-lg-9">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="d-flex align-items-center mb-3">{{ __('Setting') }}</h5>
                                @foreach ($config_variables as $key => $value )
                                    <div class="row mb-3">
                                        <div class="col-sm-3">
                                            <h6 class="mb-0">{{ str_replace("_", " ", $key);}}</h6>
                                        </div>
                                        <div class="col-sm-9 text-secondary">
                                            <input type="text" class="form-control" name="{{ $key }}" value="{{ $value}}">
                                            <div data-lastpass-icon-root="true"
                                                style="position: relative !important; height: 0px !important; width: 0px !important; float: left !important;">
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                                
                                <div class="row">
                                    <div class="col-sm-9 text-secondary">
                                        <input type="button" class="btn btn-primary px-4" value="{{ __('Save Changes') }}">
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
    $(function() {
        $('[data-toggle="tooltip"]').tooltip()
    })
</script>
</x-app-layout>

