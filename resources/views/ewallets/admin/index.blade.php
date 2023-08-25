@if (Auth::user()->hasRole('Admin'))
<div class="row">

    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <div class="d-lg-flex align-items-center mb-4 gap-3">
                    {{-- <div class="position-relative">
                        <input type="text" class="form-control ps-5 radius-30" placeholder="Search Order"> <span
                            class="position-absolute top-50 product-show translate-middle-y"><i class="bx bx-search"></i></span>
                    </div> --}}
                           
        
                </div>
                <div class="table-responsive">
                    <table class="table mb-0">
                        <thead class="table-light">
                            <tr>
                                <th># Payment Order</th>
                                <th>Usuario</th>
                                <th>Transacción</th>
                                <th>Total</th>
                                <th>Estatus</th>
                                <th>Fecha</th>
                                <th></th>
                                {{-- <th>View Details</th>
                                <th>Actions</th> --}}
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($transations as $item)
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
                                <td>{{ $item->user->name . ' ' . $item->user->lastName}}</td>
                                <td>{{ $item->type }}</td>
                                <td>${{ $item->amount }}</td>
                                <td>{{ $item->status }}</td>
                                <td>{{ $item->created_at }}</td>
                                <td>
                                    <div class="d-flex order-actions">
                                    
                                    @if( $item->type == 'withdraw')
                                        <a href="javascript:;" class=""><i class="fadeIn animated bx bx-send"></i></a>
                                    @endif

                                    </div>
                                </td>
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
                    {{ $deposits->links() }}
                </div>
            </div>
        </div>
    </div>
</div>
@endif