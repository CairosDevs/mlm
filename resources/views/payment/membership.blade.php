<x-app-layout>
    <!--start page wrapper -->
    <div class="page-wrapper">
        <div class="page-content">
            <div class="row row-cols-3 product-grid">
                <div class="col"></div>
                <div class="col">
                    <div class="card rounded-4 bg-gradient-primary">
                        <form action="{{ route('payment.form') }}" method="post">
                        @csrf                        
                        <div class="card-body text-center">
                            <h3 class="text-white">Membresia</h3>
                            <p class="mb-0 text-white">20 USDT</p>
                            <div class="widgets-icons-2 mx-auto my-4 bg-white rounded-circle text-dark">
                                <i class="bx bx-line-chart-down"></i>
                            </div>
                            <p class="mb-0 text-white">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor
                                incididunt ut labore et dolore magna aliqua. Ut enim ad minim</p>
                            <input type="hidden" name="amount" value="20">
                            <button type="submit" class="btn btn-white px-4 rounded-5 mt-4">Pagar membresia</button>
                        </div>
                        </form>
                    </div>
                </div>
                <div class="col"></div>
            </div>
        </div>
    </div>
    <!--end page wrapper -->

<script>
    
    
</script>
</x-app-layout>

