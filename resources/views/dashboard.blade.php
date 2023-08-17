<x-app-layout>
    <!--start page wrapper -->
    <div class="page-wrapper">
        <div class="page-content">
            <div class="row">
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
            </div>
    
            
            <!--end row-->
    
            {{-- <div class="row">
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
            </div> --}}
            <!--end row-->
    
            {{-- <div class="row">
                <div class="col-12">
                    <div class="card rounded-4">
                        <div class="card-header">
                            <div class="d-flex align-items-center">
                                <div>
                                    <h6 class="mb-0">Recent Orders</h6>
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
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table align-middle mb-0">
                                    <thead class="table-light">
                                        <tr>
                                            <th>Product</th>
                                            <th>Photo</th>
                                            <th>Product ID</th>
                                            <th>Status</th>
                                            <th>Amount</th>
                                            <th>Date</th>
                                            <th>Shipping</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>Iphone 5</td>
                                            <td><img src="assets/images/products/01.png" class="product-img-2"
                                                    alt="product img"></td>
                                            <td>#9405822</td>
                                            <td><span
                                                    class="btn btn-outline-success btn-sm px-4 rounded-5 w-100">Completed</span>
                                            </td>
                                            <td>$1250.00</td>
                                            <td>03 Feb 2020</td>
                                            <td>
                                                <div class="progress" style="height: 6px;">
                                                    <div class="progress-bar bg-gradient-quepal" role="progressbar"
                                                        style="width: 100%"></div>
                                                </div>
                                            </td>
                                        </tr>
    
                                        <tr>
                                            <td>Earphone GL</td>
                                            <td><img src="assets/images/products/02.png" class="product-img-2"
                                                    alt="product img"></td>
                                            <td>#8304620</td>
                                            <td><span
                                                    class="btn btn-outline-warning btn-sm px-4 rounded-5 w-100">Pending</span>
                                            </td>
                                            <td>$1500.00</td>
                                            <td>05 Feb 2020</td>
                                            <td>
                                                <div class="progress" style="height: 6px;">
                                                    <div class="progress-bar bg-gradient-blooker" role="progressbar"
                                                        style="width: 60%"></div>
                                                </div>
                                            </td>
                                        </tr>
    
                                        <tr>
                                            <td>HD Hand Camera</td>
                                            <td><img src="assets/images/products/03.png" class="product-img-2"
                                                    alt="product img"></td>
                                            <td>#4736890</td>
                                            <td><span
                                                    class="btn btn-outline-danger btn-sm px-4 rounded-5 w-100">Failed</span>
                                            </td>
                                            <td>$1400.00</td>
                                            <td>06 Feb 2020</td>
                                            <td>
                                                <div class="progress" style="height: 6px;">
                                                    <div class="progress-bar bg-gradient-bloody" role="progressbar"
                                                        style="width: 70%"></div>
                                                </div>
                                            </td>
                                        </tr>
    
                                        <tr>
                                            <td>Clasic Shoes</td>
                                            <td><img src="assets/images/products/04.png" class="product-img-2"
                                                    alt="product img"></td>
                                            <td>#8543765</td>
                                            <td><span
                                                    class="btn btn-outline-success btn-sm px-4 rounded-5 w-100">Paid</span>
                                            </td>
                                            <td>$1200.00</td>
                                            <td>14 Feb 2020</td>
                                            <td>
                                                <div class="progress" style="height: 6px;">
                                                    <div class="progress-bar bg-gradient-quepal" role="progressbar"
                                                        style="width: 100%"></div>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Sitting Chair</td>
                                            <td><img src="assets/images/products/06.png" class="product-img-2"
                                                    alt="product img"></td>
                                            <td>#9629240</td>
                                            <td><span
                                                    class="btn btn-outline-warning btn-sm px-4 rounded-5 w-100">Pending</span>
                                            </td>
                                            <td>$1500.00</td>
                                            <td>18 Feb 2020</td>
                                            <td>
                                                <div class="progress" style="height: 6px;">
                                                    <div class="progress-bar bg-gradient-blooker" role="progressbar"
                                                        style="width: 60%"></div>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Hand Watch</td>
                                            <td><img src="assets/images/products/05.png" class="product-img-2"
                                                    alt="product img"></td>
                                            <td>#8506790</td>
                                            <td><span
                                                    class="btn btn-outline-danger btn-sm px-4 rounded-5 w-100">Failed</span>
                                            </td>
                                            <td>$1800.00</td>
                                            <td>21 Feb 2020</td>
                                            <td>
                                                <div class="progress" style="height: 6px;">
                                                    <div class="progress-bar bg-gradient-bloody" role="progressbar"
                                                        style="width: 40%"></div>
                                                </div>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div> --}}
            <!--end row-->
        </div>
    </div>
    <!--end page wrapper -->

</x-app-layout>
