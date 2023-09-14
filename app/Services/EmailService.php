<?php

namespace App\Services;

use App\Jobs\SendEmailPaymentConfirmedJob;
use Illuminate\Support\Facades\Auth;

class EmailService
{
    public function sendPaymentConfirmation($user, $order, $status)
    {
        if ($status) {

            $emailDetails = [
                'title' => 'Confirmación de deposito',
                'orden' => $order->external_payment_id,
                'monto' => $order->amount,
            ];
            
            dispatch(new SendEmailPaymentConfirmedJob($user->email, $emailDetails));
        }
    }
}
