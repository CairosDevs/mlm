<?php

namespace App\Services;

use App\PaymentGateway\BinanceGateway;
use App\PaymentGateway\NowPaymentsGateway;

class PaymentService
{
    protected $gateway;

    public function __construct(NowPaymentsGateway $gateway)
    {
        $this->gateway = $gateway;
    }

    /**
     * Envia solicitud de pago a pasarela
     *
     * @param float $amount
     */
    public function charge($amount)
    {
        return $this->gateway->create_payment($amount);
    }

    /**
     * Valida si orden esta paga
     *
     * @param float $amount
     */
    public function isPaid($orderId)
    {
        return $this->gateway->payment_status($orderId);
    }


    public function ipn(Request $request)
    {
    }

}
