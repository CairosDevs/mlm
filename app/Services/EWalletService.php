<?php

namespace App\Services;

use Illuminate\Support\Facades\Auth;
use App\PaymentGateway\BinanceGateway;
use App\PaymentGateway\NowPaymentsGateway;

class EWalletService
{

    /**
     * Procesa la solicitud de deposito o retiro en la wallet
     *
     * @param float $amount
     * @param string $type
     */
    public function transaction($amount, $type)
    {
        // dd($amount);

        switch ($type) {
            case 'deposit':
                Auth::user()->deposit((integer) $amount);
                break;
            
            case 'withdraw':
                Auth::user()->withdraw((integer) $amount);
                break;
            
            default:
                Auth::user()->balanceInt;
                break;
        }
        

        // $user = User::first();
        // $user->balanceInt; // 0

        // $user;

        // return $this->gateway->create_payment($amount);
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
