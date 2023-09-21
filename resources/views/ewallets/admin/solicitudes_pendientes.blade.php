<x-app-layout>
    <!--start page wrapper -->
    <div class="page-wrapper">
        <div class="page-content">
                <div class="row">
                    <div class="card">
                        <div class="card-body">
                            <div class="d-lg-flex align-items-center mb-4 gap-3">
                                {{-- <div class="position-relative">
                                    <input type="text" class="form-control ps-5 radius-30" placeholder="Search Order"> <span
                                        class="position-absolute top-50 product-show translate-middle-y"><i class="bx bx-search"></i></span>
                                </div> --}}
                             <a class="btn btn-info" href="{{ route('excel.withdrawPending2') }}">Descargar</a>
                             <a id="status-btn" class="btn btn-info" href="{{ route('statusToPaid') }}">Procesar todas como pagadas</a>
                            </div>
                            <div class="table-responsive">
                                <table class="table mb-0">
                                    <thead class="table-light">
                                        <tr>
                                            <th># Orden de retiro</th>
                                            <th>Billetera</th>
                                            <th>Usuario</th>
                                            <th>Monto</th>
                                            <th>Fecha solicitud</th>
                                            <th>Estatus</th>
                                            {{-- <th>View Details</th>
                                            <th>Actions</th> --}}
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($withdraws as $item)
                                        <tr>
                                            <td>
                                                <div class="d-flex align-items-center">
                                                    <div>
                                                        <input class="form-check-input me-3" type="checkbox" value="" aria-label="...">
                                                    </div>
                                                    <div class="ms-2">
                                                        <h6 class="mb-0 font-14">{{ $item->payment_id }}</h6>
                                                    </div>
                                                </div>
                                            </td>
                                            <td>{{ $item->user->eWallet->wallet_id }}</td>
                                            <td>{{ $item->user->name . ' ' . $item->user->lastName}}</td>
                                            <td>${{ $item->amount }}</td>                                            
                                            <td>{{ $item->created_at->format('d-m-Y') }}</td>
                                            <td>{{ __($item->status) }}</td>
                                            {{-- <td><button type="button" class="btn btn-primary btn-sm radius-30 px-4">View
                                                    Details</button>
                                            </td>
                                            <td>
                                                <div class="d-flex order-actions">
                                                    <a href="javascript:;" class=""><i class="bx bxs-edit"></i></a>
                                                    <a href="javascript:;" class="ms-3"><i class="bx bxs-trash"></i></a>
                                                </div>
                                            </td> --}}
                                        </tr>
                                        @endforeach
                    
                                    </tbody>
                                </table>
                                {{ $withdraws->links() }}
                            </div>
                        </div>
                    </div>
                </div>




        </div>
    </div>
    <!--end page wrapper -->

    <!-- Modal -->


<script>

        document.getElementById('status-btn').addEventListener('click', function(e) {
        e.preventDefault();
        var url = this.href;
        Swal.fire({
            title: "¿Estás seguro?",
            text: "Una vez aceptes, el estado de las órdenes de pago cambiarán a 'pagadas'.",
            icon: "warning",
            buttons: true,
            dangerMode: true,
        })
        .then((willDownload) => {
            if (willDownload) {
                axios({
                    url: url,
                    method: 'GET',
                })                
                .then(() => {
                    
                    location.reload();
                });
            }
        });
    });
    
</script>
</x-app-layout>
