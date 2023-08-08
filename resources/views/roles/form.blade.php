<x-app-layout>
    <!--start page wrapper -->
    <div class="page-wrapper">
        <div class="page-content">

            <form method="post">
            @csrf
            @method('PUT')

                <div class="row">
                    <div class="col-lg-6">
                        <div class="card">
                            <div class="card-body">
                                <div class="row mb-3">
                                    <div class="col-sm-3">
                                        <h6 class="mb-0">{{ __('User') }}</h6>
                                    </div>
                                    <div class="col-sm-9 text-secondary">
                                        <select id="select-usuario" name="user_id" class="form-select mb-3" aria-label="{{ __('Select User') }}">
                                        <option selected="">{{ __('Select User') }}</option>
                                        @foreach ($users as $item)
                                            <option value="{{ $item->id }}">{{ $item->name }} {{ $item->lastName }}</option>
                                        @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <h6 class="mb-0">{{ __('User role') }}</h6>
                                    <div id="roles-section"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="card">
                            <div class="card-body">
                                <div class="row mb-3">
                                    <div class="col-sm-3">
                                        <h6 class="mb-0">{{ __('Roles') }}</h6>
                                    </div>
                                    <div class="col-sm-9 text-secondary">
                                        <select id="select-usuario" name="role_id" class="form-select mb-3" aria-label="{{ __('Select User') }}">
                                            <option selected="">{{ __('Select new role') }}</option>
                                            @foreach ($roles as $item)
                                                <option value="{{ $item->id }}">{{ $item->name }} {{ $item->lastName }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>                            
                                <div class="row">
                                    <div class="col-sm-3"></div>
                                    <div class="col-sm-9 text-secondary">
                                        <input type="submit" class="btn btn-primary px-4" value="{{  __('Save Changes') }}">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </form>

        </div>
    </div>


    <script>
            $(document).ready(function() {
                // Obtener una referencia al select y a la sección de roles
                let select = $('#select-usuario');
                let rolesSection = $('#roles-section');
                const users = @json($users);
        
                // Escuchar el evento 'change' del select
                select.on('change', function() {
                    // Obtener el id del usuario seleccionado
                    let userId = $(this).val();
        
                    // Buscar el usuario en la lista de usuarios
                    let user = users.find(user => user.id == userId);
       
                    // Actualizar la sección de roles con la información del usuario
                    let rolesList = '<ul>';                    
                    rolesList += '<li>' + user.roles[0].name + '</li>';                    
                    rolesList += '</ul>';
                    rolesSection.html(rolesList);
                });
            });
                
    </script>

    <script>
        $(document).ready(function() {
            $('input[type="submit"]').click(function(e) {
                e.preventDefault();
                var formData = $('form').serialize();

                // Actualizar la URL de acción del formulario con el ID seleccionado
                var id = $('select[name="user_id"]').val();
                var url = '/roles/update/' + id;
                $('form').attr('action', url);

                $.ajax({
                    url: $('form').attr('action'),
                    type: 'POST',
                    data: formData,
                    success: function(response) {
                        let successMessage = response.success;

                        Swal.fire({
                        title: "¡Éxito!",
                        text: successMessage,
                        icon: "success",
                        }).then((result) => {
                            location.reload();
                        });
                        
                    }
                });
            });
        });
    </script>
    <!--end page wrapper -->
</x-app-layout>



