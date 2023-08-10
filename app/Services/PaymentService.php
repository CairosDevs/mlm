<?php

namespace App\Services;

use App\PaymentGateway\BinanceGateway;
use App\PaymentGateway\NowPaymentsGateway;


class PaymentService
{
    protected $gateway;

    public function __construct(BinanceGateway $gateway)
    {
        $this->gateway = $gateway;
    }

    public function processPayment($amount, $paymentMethod)
    {
        // Llamar al método charge del gateway para procesar el pago
        $result = $this->gateway->charge($amount, $paymentMethod);

        // TODO Guardar en la BD
        
        return $result;
    }

    public function charge($amount, $paymentMethod)
    {
        $gateway = new BinanceGateway();
        $result = $gateway->charge($amount, $paymentMethod);

        if ($result) {
            echo 'El pago fue exitoso';
            //return redirect(json_decode($result)->data->checkoutUrl);
        } else {
            echo 'El pago falló';
        }
    }

    public function ipn(Request $request)
    {
        
    }

}
