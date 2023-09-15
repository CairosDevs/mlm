<x-app-layout>
    <!--start page wrapper -->
    <div class="page-wrapper">
        <div class="page-content">
            <div class="row">
                <form action="{{ route('users.store') }}" method="post">
                    @csrf
                    <div class="card radius-10">
                        <div class="card-body">
                            <div>
                                <h6 class="mb-5">{{ __('Create users') }}</h6>
                            </div>
                            <div class="row mb-3">
                                <div class="col-sm-3">
                                    <h6 class="mb-0">{{  __('Name') }}</h6>
                                </div>
                                <div class="col-sm-9 text-secondary">
                                    <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" value="">
                                    @error('name')
                                    <div id="validationPasswordConfirmation" class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                    <div data-lastpass-icon-root="true"
                                        style="position: relative !important; height: 0px !important; width: 0px !important; float: left !important;">
                                    </div>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-sm-3">
                                    <h6 class="mb-0">{{ __('lastName') }}</h6>
                                </div>
                                <div class="col-sm-9 text-secondary">
                                    <input type="text" name="lastName" class="form-control @error('lastName') is-invalid @enderror" value="">
                                    @error('lastName')
                                    <div id="validationPasswordConfirmation" class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                    <div data-lastpass-icon-root="true"
                                        style="position: relative !important; height: 0px !important; width: 0px !important; float: left !important;">
                                    </div>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-sm-3">
                                    <h6 class="mb-0">{{  __('Email') }}</h6>
                                </div>
                                <div class="col-sm-9 text-secondary">
                                    <input type="text" name="email" class="form-control @error('email') is-invalid @enderror" value="">
                                    @error('email')
                                    <div id="validationPasswordConfirmation" class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-sm-3">
                                    <h6 class="mb-0">{{ __('Phone') }}</h6>
                                </div>
                                <div class="col-sm-9 text-secondary">
                                    <input type="text" name="phone" class="form-control @error('phone') is-invalid @enderror" value="">
                                    @error('phone')
                                    <div id="validationPasswordConfirmation" class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            
                            <div class="row">
                                <div class="col-sm-3"></div>
                                <div class="col-sm-9 text-secondary">
                                    <input type="submit" class="btn btn-primary px-4" value="{{ __('Save Changes') }}">
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="row">
                <div class="card radius-10">
                    <div class="card-body">
                        <div class="d-flex align-items-center">
                            <div>
                                <h6 class="mb-5">{{ __('Users') }}</h6>
                            </div>
                            <div class="dropdown ms-auto">
                               {{-- <a class="dropdown-toggle dropdown-toggle-nocaret" href="#" data-bs-toggle="dropdown"><i
                                        class="bx bx-dots-horizontal-rounded font-22 text-option"></i>
                                </a>
                                 <ul class="dropdown-menu">
                                    <li><a class="dropdown-item" href="javascript:;">Action</a>
                                    </li>
                                    <li><a class="dropdown-item" href="javascript:;">Another action</a>
                                    </li>
                                    <li>
                                        <hr class="dropdown-divider">
                                    </li>
                                    <li><a class="dropdown-item" href="javascript:;">Something else here</a>
                                    </li>
                                </ul> --}}
                            </div>
                        </div>
                        <div class="table-responsive">
                            <table class="table align-middle mb-0">
                                <thead class="table-light">
                                    <tr>
                                        <th>{{ __('Name') }}</th>
                                        <th>{{ __('Lastname') }}</th>
                                        <th>{{ __('Email') }}</th>
                                        <th>{{ __('Phone') }}</th>
                                        {{-- <th>{{ __('Action') }}</th> --}}
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($users as $item)
                                    <tr>
                                        <td>{{ $item->name }}</td>
                                        <td>{{ $item->lastName }}</td>
                                        <td>{{ $item->email }}</td>
                                        <td>{{ $item->phone }}</td>
                                        {{-- <td><span class="btn btn-outline-success btn-sm px-4 rounded-5 w-100">{{ __('See') }}</span> --}}
                                        </td>
                
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            {{ $users->links('pagination::bootstrap-4') }}
                        </div>
                    </div>
                </div>
            </div>


        </div>
    </div>
    <!--end page wrapper -->

<script>
        $(document).ready(function () {
    			    
                // var success = "{{ session('success') }}";
    
                // if (success) {
                //     Swal.fire({
                //         title: "¡Éxito!",
                //         text: success,
                //         icon: "success",
                //     });
                    
                // }
                
                // var error = "{{ session('error') }}";
    
                // if (error) {
                //     Swal.fire({
                //         title: "Tuvimos un problema!",
                //         text: error,
                //         icon: "error",
                //     });
                // }
    
    		});
    </script>
</x-app-layout>

