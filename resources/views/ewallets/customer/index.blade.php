@if (Auth::user()->hasRole('Customer'))
<div class="row">

    <!-- Modal depositos-->
    <div class="modal fade" id="depositModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content bg-dark">
                <div class="modal-body text-white">
                    <div class="row">
                        <div class="col-3"></div>
                        <div class="col-6">
                            <div class="card bg-gradient-deepblue rounded-4 border border-4 border-white shadow">
                                <form action="{{ route('payment.form') }}" method="post">
                                    @csrf
                                    <div class="card-body">
                                        <div class="d-flex align-items-center justify-content-between">
                                            <div class="">
                                                <h4 class="mb-0 text-white">Depositar</h4>
                                            </div>
                                            <div class="widgets-icons rounded-circle bg-light-transparent-2 text-white">
                                                <i class="bx bx-dollar"></i>
                                            </div>
                                        </div>
                                        <div class="mt-3">
                                            <input
                                                style="font-size:36px; border: none !important; outline: none !important;"
                                                class="mb-0 bg-transparent text-white" type="number" id="deposit_amount"
                                                name="amount" value="{{ Setting::get('deposito_minimo') }}">
                                            <input type="hidden" name="type" value="deposit">
                                        </div>
                                        <div class="mt-3">
                                            <button id="deposit_plus" type="button"
                                                class="btn btn-primary rounded-circle">+</button>
                                            <button id="deposit_minus" type="button"
                                                class="btn btn-primary rounded-circle">-</button>
                                        </div>
                                        <div class="d-flex align-items-center justify-content-between">
                                            <div class="">

                                            </div>
                                            <div class="">
                                                <button id="deposit_enviar" type="submit"
                                                    class="btn btn-primary">Enviar</button>
                                            </div>
                                        </div>

                                    </div>
                                </form>
                            </div>
                        </div>
                        <div class="col-3"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal retiros-->
    <div class="modal fade" id="withdrawModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content bg-dark">
                <div class="modal-body text-white">
                    <div class="row">
                        <div class="col-3"></div>
                        <div class="col-6">
                            <div class="card bg-gradient-deepblue rounded-4 border border-4 border-white shadow">
                                <form action="{{ route('payment.form') }}" method="post">
                                    @csrf
                                    <div class="card-body">
                                        <div class="d-flex align-items-center justify-content-between">
                                            <div class="">
                                                <h4 class="mb-0 text-white">Retirar</h4>
                                            </div>
                                            <div class="widgets-icons rounded-circle bg-light-transparent-2 text-white">
                                                <i class="bx bx-dollar"></i>
                                            </div>
                                        </div>
                                        <div class="mt-3">
                                            <input
                                                style="font-size:36px; border: none !important; outline: none !important;"
                                                class="mb-0 bg-transparent text-white" type="number"
                                                id="withdraw_amount" name="amount" value="0">
                                            <input type="hidden" name="type" value="withdraw">
                                        </div>
                                        <div class="mt-3">
                                            <button id="withdraw_plus" type="button"
                                                class="btn btn-primary rounded-circle">+</button>
                                            <button id="withdraw_minus" type="button"
                                                class="btn btn-primary rounded-circle">-</button>
                                        </div>
                                        <div class="d-flex align-items-center justify-content-between">
                                            <div class="">

                                            </div>
                                            <div class="">
                                                <button id="withdraw_enviar" type="submit"
                                                    class="btn btn-primary">Enviar</button>
                                            </div>
                                        </div>

                                    </div>
                                </form>
                            </div>
                        </div>
                        <div class="col-3"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <div class="col-3">
        <div class="card bg-gradient-deepblue rounded-4 border border-4 border-white shadow">
            <div class="card-body">
                <div class="d-flex align-items-center justify-content-between">
                    <div class="">
                        <h4 class="mb-0 text-white">Balance</h4>
                    </div>
                    <div class="widgets-icons rounded-circle bg-light-transparent-2 text-white">
                        <i class="bx bx-dollar"></i>
                    </div>
                </div>
                <div class="mt-3">
                    <h3 class="mb-0 text-white">$ {{ Auth::user()->balanceInt }} </h3>
                </div>
            </div>
        </div>
    </div>

    <div class="col-9">
        <div style="border:0px; box-shadow: 0px 0px 0px white;" class="card">
            <div class="card-body">
                <ul class="nav nav-tabs nav-primary justify-content-center" role="tablist">
                    <li class="nav-item" role="presentation">
                        <a class="nav-link active" data-bs-toggle="tab" href="#primaryhome" role="tab"
                            aria-selected="true">
                            <div class="d-flex align-items-center">
                                <div class="tab-icon">
                                    <i style="font-size:24px;" class="lni lni-arrow-down-circle p-2"></i>
                                </div>
                                <div class="tab-title ml-1"> Depositos</div>
                            </div>
                        </a>
                    </li>
                    <li class="nav-item" role="presentation">
                        <a class="nav-link" data-bs-toggle="tab" href="#primaryprofile" role="tab" aria-selected="false"
                            tabindex="-1">
                            <div class="d-flex align-items-center">
                                <div class="tab-icon">
                                    <i style="font-size:24px;" class="lni lni-arrow-up-circle p-2"></i>
                                </div>
                                <div class="tab-title ml-1"> Retiros</div>
                            </div>
                        </a>
                    </li>
                </ul>

                {{-- tabla de ordenes --}}
                <div class="tab-content py-3">
                    {{-- depositos --}}
                    <div class="tab-pane fade active show" id="primaryhome" role="tabpanel">
                        <div class="card">
                            <div class="card-body">
                                <div class="d-lg-flex align-items-center mb-4 gap-3">
                                    {{-- <div class="position-relative">
                                        <input type="text" class="form-control ps-5 radius-30"
                                            placeholder="Search Order"> <span
                                            class="position-absolute top-50 product-show translate-middle-y"><i
                                                class="bx bx-search"></i></span>
                                    </div> --}}
                                    <div class="ms-auto">
                                        <button type="button" class="btn btn-primary radius-30 mt-2 mt-lg-0"
                                            data-bs-toggle="modal" data-bs-target="#depositModal">
                                            <i class="bx bxs-plus-square"></i>Agregar deposito
                                        </button>
                                    </div>


                                </div>
                                <div class="table-responsive">
                                    <table class="table mb-0">
                                        <thead class="table-light">
                                            <tr>
                                                <th># Orden de pago</th>
                                                <th>Total</th>
                                                <th>Estatus</th>
                                                <th>Fecha</th>
                                                {{-- <th>View Details</th>
                                                <th>Actions</th> --}}
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($deposits as $item)
                                            <tr>
                                                <td>
                                                    <div class="d-flex align-items-center">
                                                        <div>
                                                            <input class="form-check-input me-3" type="checkbox"
                                                                value="" aria-label="...">
                                                        </div>
                                                        <div class="ms-2">
                                                            <h6 class="mb-0 font-14">{{ $item->payment_id }}</h6>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td>${{ $item->amount }}</td>
                                                <td>{{ __($item->status) }}</td>
                                                <td>{{ $item->created_at }}</td>
                                                {{-- <td><button type="button"
                                                        class="btn btn-primary btn-sm radius-30 px-4">View
                                                        Details</button>
                                                </td>
                                                <td>
                                                    <div class="d-flex order-actions">
                                                        <a href="javascript:;" class=""><i class="bx bxs-edit"></i></a>
                                                        <a href="javascript:;" class="ms-3"><i
                                                                class="bx bxs-trash"></i></a>
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

                    {{-- retiros --}}
                    <div class="tab-pane fade" id="primaryprofile" role="tabpanel">
                        <div class="card">
                            <div class="card-body">
                                <div class="d-lg-flex align-items-center mb-4 gap-3">
                                    {{-- <div class="position-relative">
                                        <input type="text" class="form-control ps-5 radius-30"
                                            placeholder="Search Order"> <span
                                            class="position-absolute top-50 product-show translate-middle-y"><i
                                                class="bx bx-search"></i></span>
                                    </div> --}}
                                    @if(!Auth::user()->can_withdraw)
                                    <div class="ms-auto" data-bs-toggle="tooltip" data-placement="top"
                                        title="Los retiros de ganancias solo estan disponibles los viernes luego de las 16:00">
                                    @else
                                    <div class="ms-auto">
                                    @endif
                                        <button id="solicitar_retiros" type="button" class="btn btn-primary radius-30 mt-2 mt-lg-0"
                                            data-bs-toggle="modal" data-bs-target="#withdrawModal" 
                                            
                                            @if(!Auth::user()->can_withdraw)disabled @endif>
                                            <i class="bx bxs-minus-square"></i>Solicitar retiro
                                        </button>
                                    </div>
                                </div>
                                <div class="table-responsive">
                                    <table class="table mb-0">
                                        <thead class="table-light">
                                            <tr>
                                                <th># Orden de pago</th>
                                                <th>Total</th>
                                                <th>Estatus</th>
                                                <th>Fecha</th>
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
                                                            <input class="form-check-input me-3" type="checkbox"
                                                                value="" aria-label="...">
                                                        </div>
                                                        <div class="ms-2">
                                                            <h6 class="mb-0 font-14">#{{ $item->payment_id }}</h6>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td>${{ $item->amount }}</td>
                                                <td>{{ $item->status }}</td>
                                                <td>{{ $item->created_at }}</td>
                                                {{-- <td><button type="button"
                                                        class="btn btn-primary btn-sm radius-30 px-4">View
                                                        Details</button>
                                                </td>
                                                <td>
                                                    <div class="d-flex order-actions">
                                                        <a href="javascript:;" class=""><i class="bx bxs-edit"></i></a>
                                                        <a href="javascript:;" class="ms-3"><i
                                                                class="bx bxs-trash"></i></a>
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
        </div>
    </div>
</div>
@endif