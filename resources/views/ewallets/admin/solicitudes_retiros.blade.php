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
                                <div class="ms-auto">
                                    <button type="button" class="btn btn-primary radius-30 mt-2 mt-lg-0" data-bs-toggle="modal"
                                        data-bs-target="#depositModal">
                                        <i class="bx bxs-plus-square"></i>Generar Excel
                                    </button>
                                </div>
                    
                    
                            </div>
                            <div class="table-responsive">
                                <table class="table mb-0">
                                    <thead class="table-light">
                                        <tr>
                                            <th># Withdraw Order</th>
                                            <th>Wallet</th>
                                            <th>Usuario</th>
                                            <th>Monto</th>
                                            <th>Fecha</th>
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
                                            <td>{{ $item->created_at }}</td>
                                            <td>{{ $item->status }}</td>
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
</script>
</x-app-layout>
