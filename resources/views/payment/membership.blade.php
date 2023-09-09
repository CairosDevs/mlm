<x-app-layout>
    <!--start page wrapper -->
    <div class="page-wrapper">
        <div class="page-content">
            <div class="row row-cols-3 product-grid">
                <div class="col"></div>
                <div class="col">
                    <div class="card rounded-4 bg-gradient-deepblue">
                        <form action="{{ route('payment.form') }}" method="post">
                        @csrf
                        <input type="hidden" name="type" value="membership">
                        <div class="card-body text-center">
                            <div class="row row-cols-2">
                                <div class="col"><h5 class="text-white">Membresia</h5></div>
                                <div class="col"><span class="mb-0 text-white">25 $</span></div>
                            </div>
                            <br>
                            <h4 class="text-white">Forma de pago</h4>
                            <br>
                            <div class="row row-cols-3">
                                <div class="col">
                                    <img width="30px" src="{{ asset('template/assets/images/USDT.png') }}" alt="" srcset="">
                                </div>
                                <div class="col">
                                    <h3 class="text-white">USDT</h3>
                                </div>
                                <div class="col">
                                    <span class="mb-0 text-white">25 USDT</span>
                                </div>
                            </div>                            
                            <input type="hidden" name="amount" value="25">
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

