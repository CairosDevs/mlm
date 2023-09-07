<x-app-layout>
    <!--start page wrapper -->
    <div class="page-wrapper">
        <div class="page-content">
                <div class="row">
                    <div class="row">
                        <div class="col-3">
                            <div class="card bg-gradient-deepblue rounded-4 border border-4 border-white shadow">
                                <div class="card-body">
                                    <div class="d-flex align-items-center justify-content-between">
                                        <div class="">
                                            <h4 class="mb-0 text-white">Capital</h4>
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
                        <div class="col-3">
                            <div class="card bg-gradient-deepblue rounded-4 border border-4 border-white shadow">
                                <div class="card-body">
                                    <div class="d-flex align-items-center justify-content-between">
                                        <div class="">
                                            <h4 class="mb-0 text-white">Total de ganancia</h4>
                                        </div>
                                        <div class="widgets-icons rounded-circle bg-light-transparent-2 text-white">
                                            <i class="bx bx-dollar"></i>
                                        </div>
                                    </div>
                                    <div class="mt-3">
                                        <h3 class="mb-0 text-white">$ 0 </h3>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-3">
                            <div class="card bg-gradient-deepblue rounded-4 border border-4 border-white shadow">
                                <div class="card-body">
                                    <div class="d-flex align-items-center justify-content-between">
                                        <div class="">
                                            <h4 class="mb-0 text-white">Ganancia semanal</h4>
                                        </div>
                                        <div class="widgets-icons rounded-circle bg-light-transparent-2 text-white">
                                            <i class="bx bx-dollar"></i>
                                        </div>
                                    </div>
                                    <div class="mt-3">
                                        <h3 class="mb-0 text-white">0% </h3>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-3">
                            <div class="card bg-gradient-deepblue rounded-4 border border-4 border-white shadow">
                                <div class="card-body">
                                    <div class="d-flex align-items-center justify-content-between">
                                        <div class="">
                                            <h4 class="mb-0 text-white">Ganancia mensual</h4>
                                        </div>
                                        <div class="widgets-icons rounded-circle bg-light-transparent-2 text-white">
                                            <i class="bx bx-dollar"></i>
                                        </div>
                                    </div>
                                    <div class="mt-3">
                                        <h3 class="mb-0 text-white">0% </h3>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

<div class="row">
    <div class="col-12 col-lg-8 d-flex">
        <div class="card rounded-4 w-100">
            <div class="card-body">
                <div class="d-flex align-items-cente">
                    <div>
                        <h6 class="mb-0">Sales Overview</h6>
                    </div>
                    <div class="dropdown ms-auto">
                        <a class="dropdown-toggle dropdown-toggle-nocaret" href="#" data-bs-toggle="dropdown"><i
                                class='bx bx-dots-horizontal-rounded font-22 text-option'></i>
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
                        </ul>
                    </div>
                </div>
                <div id="chart1"></div>
            </div>
        </div>
    </div>
    <div class="col-12 col-lg-4 d-flex">
        <div class="card rounded-4 w-100">
            <div class="card-body">
                <div class="d-flex align-items-center">
                    <div>
                        <h6 class="mb-0">Monthly Orders</h6>
                    </div>
                    <div class="dropdown ms-auto">
                        <a class="dropdown-toggle dropdown-toggle-nocaret" href="#" data-bs-toggle="dropdown"><i
                                class='bx bx-dots-horizontal-rounded font-22 text-option'></i>
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
                        </ul>
                    </div>
                </div>
                <div id="chart2"></div>
            </div>
        </div>
    </div>
</div>
<!--end row-->


        </div>
    </div>
    <!--end page wrapper -->

    <!-- Modal -->


<script>
</script>
</x-app-layout>
