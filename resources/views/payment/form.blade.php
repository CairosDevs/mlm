<x-app-layout>
    <!--start page wrapper -->
    <div class="page-wrapper">
        <div class="page-content">
            <div class="row row-cols-3 product-grid">
                <div class="col"></div>
                <div class="col">
                    <div class="card shadow-lg">
                        <div class="card-header card-header-divider text-center pt-4">
                            <span id="contenedorqr"></span>
                            <input type="hidden" id="orderId" name="orderId" value="{{ $payment_data['payment_id'] }}">
                        </div>
                        <div class="card-body px-0">
                            <p>Orden de pago <span style="font-weight:bold;">{{ $payment_data['payment_id'] }}</span></p>
                            <p class="text-center">Envia {{ $payment_data['price_amount'] }} USDT (en UN pago) a:
                                no se incluye el fee de la transacción en este monto</p>
                            <p class="text-center"><small><strong id="pay_address">{{ $payment_data['pay_address'] }}</strong></small></p>
                            <p class="text-muted text-center">Escanee el código QR y envie el pago<br>
                            </p>
                        </div>
                    </div>
                </div>
                <div class="col"></div>
            </div>

            <div class="row row-cols-3 product-grid">
                <div class="col"></div>
                <div class="col text-center">
                    Tiempo restante para realizar pago:
                    <div style="font-weight:bold; font-size:36px;" class="text-center" id="timer"></div>
                </div>
                <div class="col"></div>
            </div>

        </div>
    </div>
    <!--end page wrapper -->

<script>
    $(document).ready(function(){
        //mostrar QR
            var pay_address = $('#pay_address').text();    
            $('#contenedorqr').qrcode({
                text    : pay_address,
                render  : "canvas",
                background : "#ffffff",
                foreground : "#000000",
                width : 200, 
                height: 200 
            });

        //mostrar reloj
            var time = 300;
            var display = $('#timer');
            startTimer(time, display);

            function startTimer(time, display) {
                var timer = time, minutes, seconds;
                function updateTimer() {
                    minutes = parseInt(timer / 60, 10);
                    seconds = parseInt(timer % 60, 10);

                    minutes = minutes < 10 ? "0" + minutes : minutes;
                    seconds = seconds < 10 ? "0" + seconds : seconds;

                    display.text(minutes + ":" + seconds);

                    if (--timer < 0) {
                        cancelOrderPayment();
                    }else {
                        setTimeout(updateTimer, 1000);
                    }
                }
                updateTimer();
            }
        
        //cancelar order
            function cancelOrderPayment() { 
                var orderId = $('#orderId').val();

                $.ajax({ 
                    url: '{{ route('payment.cancel') }}' , 
                    type: 'POST' , 
                    data: { orderId },
                    beforeSend: function(xhr) {
                        xhr.setRequestHeader('X-CSRF-TOKEN', $('meta[name="csrf-token"]').attr('content'));
                    },
                    success: function(response) { 
                        Swal.fire({
                            title: "Se agoto el tiempo",
                            text: response.error,
                            icon: "error",
                            button: "Aceptar"
                        }).then(function() {
                            window.location.replace('/membership');
                        });
                    },
                    error: function(response) {
                        Swal.fire({
                            title: "Error al cancelar la orden",
                            text: response.responseJSON.message,
                            icon: "error",
                        }).then(function() {
                            window.location.replace('/membership');
                        });
                    } 
                }); 
            }
        //validar status de orden
            var time = 300000; 
            var interval = setInterval(checkOrderStatus, 10000); 

            function checkOrderStatus() {
                var orderId = $('#orderId').val();
                $.ajax({
                    url: '/orderStatus/' + orderId,
                    type: 'GET',
                    success: function(response) {
                        if (response.status === true) {
                            Swal.fire({
                                title: "Gracias por pago",
                                text: response.success,
                                icon: "success",
                            }).then(function() {
                                window.location.replace('/dashboard');
                            });
                            
                        } 

                        time -= 10000;
                        if (time <= 0) {
                            clearInterval(interval);
                        }
                    }
                });
            }

    });
</script>
</x-app-layout>

