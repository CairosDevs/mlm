<x-app-layout>
    <!--start page wrapper -->
    <div class="page-wrapper">
        <div class="page-content">
           
            <div class="row">
                <div class="card radius-10">
                    <div class="card-body">
                        <div class="d-flex align-items-center">
                            <div>
                                <h6 class="mb-5">{{ __('Users pending for validation') }}</h6>
                            </div>
                            <div class="dropdown ms-auto">
                            </div>
                        </div>
                        <div class="table-responsive">
                            <table class="table align-middle mb-0">
                                <thead class="table-light">
                                    <tr>
                                        <th>{{ __('Name') }}</th>
                                        <th>{{ __('Lastname') }}</th>
                                        <th>{{ __('Email') }}</th>
                                        <th>{{ __('Status') }}</th>
                                        <th>{{ __('Action') }}</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($users as $item)
                                    <tr>
                                        <td>{{ $item->user->name }}</td>
                                        <td>{{ $item->user->lastName }}</td>
                                        <td>{{ $item->user->email }}</td>
                                        <td>@if (!$item->status) PENDIENTE @endif</td>
                                        <td><a class="btn btn-outline-success btn-sm px-4 rounded-5 w-100" href="{{ route('profile.show.validation', $item->id )}}">{{ __('See') }}</a>
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

