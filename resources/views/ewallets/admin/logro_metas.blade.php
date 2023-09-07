<x-app-layout>
    <!--start page wrapper -->
    <div class="page-wrapper">
        <div class="page-content">
                <div class="row">
                    <div class="row">
                        <div class="col-6">
                            <div class="card bg-gradient-deepblue rounded-4 border border-4 border-white shadow">
                                <div class="card-body">
                                    <div class="d-flex align-items-center justify-content-between">
                                        <div class="">
                                            <h4 class="mb-0 text-white">Total en capital</h4>
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
                        <div class="col-6">
                            <div class="card bg-gradient-deepblue rounded-4 border border-4 border-white shadow">
                                <div class="card-body">
                                    <div class="d-flex align-items-center justify-content-between">
                                        <div class="">
                                            <h4 class="mb-0 text-white">Porcentaje de ganancia a las garantia</h4>
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
                        <div class="col-6">
                            <div class="card bg-gradient-deepblue rounded-4 border border-4 border-white shadow">
                                <div class="card-body">
                                    <div class="d-flex align-items-center justify-content-between">
                                        <div class="">
                                            <h4 class="mb-0 text-white">Total de porcentaje</h4>
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
                        <div class="col-6">
                            <div class="card">
                                <div class="card-body">
                                    <header>
                                        <h2 class="text-lg font-medium text-gray-900">
                                            Porcentaje logrado semanal
                                        </h2>
                                    </header>
                                    <br>
                                    <form id="send-verification" method="post" action="http://localhost/email/verification-notification">
                                        <input type="hidden" name="_token" value="nYRWLnQIPwZP1j53HTV7SSw8cLpIbF6huJ3IZmVd">
                                    </form>
                                    <form method="post" action="http://localhost/profile" class="mt-6 space-y-6 row g-3">
                                        <input type="hidden" name="_token" value="nYRWLnQIPwZP1j53HTV7SSw8cLpIbF6huJ3IZmVd"> <input type="hidden"
                                            name="_method" value="patch">
                                        <div class="row mb-3">
                                            
                                            <div class="col-sm-8 text-secondary">
                                                <input id="name" name="name" type="text" class="form-control" value="Admin" required="" autofocus=""
                                                    autocomplete="Name">
                                                <div data-lastpass-icon-root="true"
                                                    style="position: relative !important; height: 0px !important; width: 0px !important; float: left !important;">
                                                </div>
                                            </div>
                                            <div class="col-sm-3 text-secondary">
                                                <input type="submit" class="btn btn-primary px-4" value="Guardar cambios">
                                            </div>
                                        </div>
                                    </form>
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
</script>
</x-app-layout>
