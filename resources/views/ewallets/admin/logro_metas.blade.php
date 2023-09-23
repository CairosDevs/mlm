<x-app-layout>
    <!--start page wrapper -->
    <div class="page-wrapper">
        <div class="page-content">
                <div class="row">
                    <div class="row">
                        <div class="col-4">
                            <div class="card bg-gradient-deepblue rounded-4 border border-4 border-white shadow">
                                <div class="card-body">
                                    <div class="d-flex align-items-center justify-content-between">
                                        <div class="">
                                            <h4 class="mb-0 text-white">Total de depositos</h4>
                                        </div>
                                        <div class="widgets-icons rounded-circle bg-light-transparent-2 text-white">
                                            <i class="bx bx-dollar"></i>
                                        </div>
                                    </div>
                                    <div class="mt-3">
                                        <h3 class="mb-0 text-white">$ {{ $allDeposits }} </h3>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-4">
                            <div class="card bg-gradient-deepblue rounded-4 border border-4 border-white shadow">
                                <div class="card-body">
                                    <div class="d-flex align-items-center justify-content-between">
                                        <div class="">
                                            <h4 class="mb-0 text-white">Ganancias generadas</h4>
                                        </div>
                                        <div class="widgets-icons rounded-circle bg-light-transparent-2 text-white">
                                            <i class="bx bx-dollar"></i>
                                        </div>
                                    </div>
                                    <div class="mt-3">
                                        <h3 class="mb-0 text-white">$ {{  $profit }} </h3>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-4">
                            <div class="card bg-gradient-deepblue rounded-4 border border-4 border-white shadow">
                                <div class="card-body">
                                    <div class="d-flex align-items-center justify-content-between">
                                        <div class="">
                                            <h4 class="mb-0 text-white">Referidos</h4>
                                        </div>
                                        <div class="widgets-icons rounded-circle bg-light-transparent-2 text-white">
                                            <i class="bx bx-dollar"></i>
                                        </div>
                                    </div>
                                    <div class="mt-3">
                                        <h3 class="mb-0 text-white">{{ $referrals }} </h3>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                    </div>

                    <div class="row">
                        <div class="col-6">
                            <div class="card bg-gradient-deepblue rounded-4 border border-4 border-white shadow">
                                <div class="card-body">
                                    <div class="d-flex align-items-center justify-content-between">
                                        <div class="">
                                            <h4 class="mb-0 text-white">Total comisiones referidos</h4>
                                        </div>
                                        <div class="widgets-icons rounded-circle bg-light-transparent-2 text-white">
                                            <i class="bx bx-dollar"></i>
                                        </div>
                                    </div>
                                    <div class="mt-3">
                                        <h3 class="mb-0 text-white">0 </h3>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="card bg-gradient-deepblue rounded-4 border border-4 border-white shadow">
                                <div class="card-body">
                                    <div class="d-flex align-items-center justify-content-between">
                                        <div class="">
                                            <h4 class="mb-0 text-white">Retiros pagados</h4>
                                        </div>
                                        <div class="widgets-icons rounded-circle bg-light-transparent-2 text-white">
                                            <i class="bx bx-dollar"></i>
                                        </div>
                                    </div>
                                    <div class="mt-3">
                                        <h3 class="mb-0 text-white">$ {{ $withdraws }} </h3>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="card">
                                <div class="card-body">
                                    <h5 class="d-flex align-items-center mb-3">Reporte Logros de metas</h5>

                                    <form method="post" action="{{ route('reportes.logroMetas') }}" class="mt-6 space-y-6 row g-3">
                                    @csrf
                                        <div class="col-sm-3 text-secondary">
                                            <input id="fechaInicio" name="fechaInicio" type="date" class="form-control"
                                                required />
                                        </div>
                                        <div class="col-sm-3 text-secondary">
                                            <input id="fechaFin" name="fechaFin" type="date" class="form-control"
                                                 required />
                                        </div>
                                        <div class="col-sm-3 d-lg-flex align-items-center mb-4 gap-3">
                                            <a id="boton-buscar" class="btn btn-info" href="">Buscar</a>
                                        </div>
                                    </form>

                                    <div class="table-responsive">
                                        <table id="reporte-logro-metas" class="table mb-0">
                                            <thead class="table-light">
                                                <tr>
                                                    
                                                    <th>Fecha</th>
                                                    <th>Capital depositado</th>
                                                    <th>Ganancia generada</th>
                                                    <th>Referidos</th>
                                                    <th>Comisiones por referidos</th>
                                                    <th>Retiros pagados</th>
                                                    
                                    
                                                </tr>
                                            </thead>
                                            <tbody>
                                                
                                            </tbody>
                                        </table>
                                    
                                    </div>
                                   
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
        </div>
    </div>
    <!--end page wrapper -->

    <!-- Modal -->


<script>

    $(document).ready(function() {
        $('#boton-buscar').on('click', function(e) {
            e.preventDefault()
            var fechaInicio = $('#fechaInicio').val();
            var fechaFin = $('#fechaFin').val();

            var url = "{{ route('reportes.logroMetas') }}";

            axios.defaults.headers.common['X-CSRF-TOKEN'] =
            document.querySelector('meta[name="csrf-token"]').getAttribute('content');
            
            axios.post(url, {
                    fechaInicio: fechaInicio,
                    fechaFin: fechaFin                
            })
            .then(function (response) {
                console.log(response);
                var tabla = $('#reporte-logro-metas tbody');
                tabla.empty();

                response.data.forEach(function(item) {
                    var fila = '<tr>' +
                        '<td>' + item.fecha + '</td>' +
                        '<td>' + item.capital_depositado + '</td>' +
                        '<td>' + item.ganancia_generada + '</td>' +
                        '<td>' + item.referidos + '</td>' +
                        '<td>' + item.comisiones_por_referidos + '</td>' +
                        '<td>' + item.retiros_pagados + '</td>' +
                        '</tr>';
                    tabla.append(fila);
                });
            })
            .catch(function (error) {
                console.log(error);
            });
        });
    });
</script>
</x-app-layout>
