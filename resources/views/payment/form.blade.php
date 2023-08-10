<x-app-layout>
    <!--start page wrapper -->
    <div class="page-wrapper">
        <div class="page-content">

<div class="container py-5">
    
    <div class="row">
        <div class="col-lg-6 mx-auto">
            <div class="card ">
                <div class="card-header">
                    
                    <!-- Credit card form content -->
                    <div class="tab-content">
                        <!-- credit card info-->
                        <div id="credit-card" class="tab-pane fade show active pt-3">
                            <form role="form" onsubmit="event.preventDefault()">
                                <div class="form-group"> <label for="username">
                                        <h6>Card Owner</h6>
                                    </label> <input type="text" name="username" placeholder="Card Owner Name" required
                                        class="form-control "> </div>
                                <div class="form-group"> <label for="cardNumber">
                                        <h6>Card number</h6>
                                    </label>
                                    <div class="input-group"> <input type="text" name="cardNumber"
                                            placeholder="Valid card number" class="form-control " required>
                                        <div class="input-group-append"> <span class="input-group-text text-muted"> <i
                                                    class="fab fa-cc-visa mx-1"></i> <i
                                                    class="fab fa-cc-mastercard mx-1"></i> <i
                                                    class="fab fa-cc-amex mx-1"></i> </span> </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-8">
                                        <div class="form-group"> <label><span class="hidden-xs">
                                                    <h6>Expiration Date</h6>
                                                </span></label>
                                            <div class="input-group"> <input type="number" placeholder="MM" name=""
                                                    class="form-control" required> <input type="number" placeholder="YY"
                                                    name="" class="form-control" required> </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-4">
                                        <div class="form-group mb-4"> <label data-toggle="tooltip"
                                                title="Three digit CV code on the back of your card">
                                                <h6>CVV <i class="fa fa-question-circle d-inline"></i></h6>
                                            </label> <input type="text" required class="form-control"> </div>
                                    </div>
                                </div>
                                <div class="card-footer"> <button type="button"
                                        class="subscribe btn btn-primary btn-block shadow-sm"> Confirm Payment </button>
                            </form>
                        </div>
                    </div> <!-- End -->
                    <!-- Paypal info -->
                    <div id="paypal" class="tab-pane fade pt-3">
                        <h6 class="pb-2">Select your paypal account type</h6>
                        <div class="form-group "> <label class="radio-inline"> <input type="radio" name="optradio"
                                    checked> Domestic </label> <label class="radio-inline"> <input type="radio"
                                    name="optradio" class="ml-5">International </label></div>
                        <p> <button type="button" class="btn btn-primary "><i class="fab fa-paypal mr-2"></i> Log into
                                my Paypal</button> </p>
                        <p class="text-muted"> Note: After clicking on the button, you will be directed to a secure
                            gateway for payment. After completing the payment process, you will be redirected back to
                            the website to view details of your order. </p>
                    </div> <!-- End -->
                    <!-- bank transfer info -->
                    <div id="net-banking" class="tab-pane fade pt-3">
                        <div class="form-group "> <label for="Select Your Bank">
                                <h6>Select your Bank</h6>
                            </label> <select class="form-control" id="ccmonth">
                                <option value="" selected disabled>--Please select your Bank--</option>
                                <option>Bank 1</option>
                                <option>Bank 2</option>
                                <option>Bank 3</option>
                                <option>Bank 4</option>
                                <option>Bank 5</option>
                                <option>Bank 6</option>
                                <option>Bank 7</option>
                                <option>Bank 8</option>
                                <option>Bank 9</option>
                                <option>Bank 10</option>
                            </select> </div>
                        <div class="form-group">
                            <p> <button type="button" class="btn btn-primary "><i class="fas fa-mobile-alt mr-2"></i>
                                    Proceed Payment</button> </p>
                        </div>
                        <p class="text-muted">Note: After clicking on the button, you will be directed to a secure
                            gateway for payment. After completing the payment process, you will be redirected back to
                            the website to view details of your order. </p>
                    </div> <!-- End -->
                    <!-- End -->
                </div>
            </div>


            
        </div>

        
    </div>

    <div class="container">
        <div class="row mx-0 pt-5 d-flex justify-content-center">
            <div class="col-xs-4 col-sm-6 col-md-5 col-lg-4 col-xl-3">
                <div class="card shadow-lg">
                    <div class="card-header card-header-divider text-center pt-4"> <img
                            src="https://apirone.com/static/promo/bitcoin_logo_vector.svg" class="img-fluid"
                            style="max-height: 42px;" width="205" alt=""><br>
                        <img src="https://chart.googleapis.com/chart?chs=300x300&cht=qr&chl=bitcoin%3A1DonateWffyhwAjskoEwXt83pHZxhLTr8H%3Famount%3D0.15050000"
                            style="max-width: 190px;" alt="">
                    </div>
                    <div class="card-body px-0">
                        <p>20 USDT</p>
                        <p>Send 20 USDT (in ONE payment) to:
                        don't include transaction fee in this amount</p>
                        <p class="text-center"><small><strong>1DonateWffyhwAjskoEwXt83pHZxhLTr8H</strong></small></p>
                        <p class="text-muted text-center">Scan QR code and top-up your<br>
                            Bitcoin balance for any amount.<br>
                            Payment will be credited after 1 confirmation.<br>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>

        </div>
    </div>
    <!--end page wrapper -->

<script>
    $(function() {
        $('[data-toggle="tooltip"]').tooltip()
    })
</script>
</x-app-layout>

