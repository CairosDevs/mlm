<?php

namespace App\PaymentGateway;

use GuzzleHttp\Client;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Redirect;

class NowPaymentsGateway
{
    protected $now_payments_enviroment;
    protected $now_payments_user;
    protected $now_payments_password;
    protected $now_payments_api_key;
    protected $now_payments_ipn_key;
    protected $now_payments_jwt_token;
    protected $now_payments_api_key_dev;
    protected $now_payments_ipn_key_dev;

    public function __construct()
    {
        $this->now_payments_enviroment = config('services.nowpayments.enviroment');

        //prod
        $this->now_payments_user = config('services.nowpayments.user');
        $this->now_payments_password = config('services.nowpayments.password');

        $this->now_payments_api_key = config('services.nowpayments.api_key');
        $this->now_payments_ipn_key = config('services.nowpayments.ipn_key');
        $this->now_payments_jwt_token = config('services.nowpayments.jwt_token');

        //dev
        $this->now_payments_api_key_dev = config('services.nowpayments.api_key_dev');
        $this->now_payments_ipn_key_dev = config('services.nowpayments.ipn_key_dev');
    }

    /**
     * Retorna el estatus actual del API de nowpayments
     *
     * @return boolean
     */
    public function is_available()
    {

        try {
            $response = Http::get('https://api-sandbox.nowpayments.io/v1/status');
            $data = json_decode($response->getBody(), true);

            if ($data['message'] == 'OK') {
                return true;
            } else {
                return false;
            }
        } catch (\Exception $e) {
            Log::error("Ocurrió un error al hacer la llamada HTTP: " . $e->getMessage());
            return false;
        }
    }

    /**
     * Retorna si una orden esta paga
     *
     * @param float $amount
     */
    public function payment_status($orderId)
    {
        try {
            $headers = [
                'x-api-key' => $this->now_payments_api_key_dev,
            ];
            $response = Http::withHeaders($headers)->get('https://api-sandbox.nowpayments.io/v1/payment/'.$orderId);
            $data = json_decode($response->getBody(), true);

            switch ($data['payment_status']) {
                case 'waiting':
                    return false;
                    break;
                
                case 'finished':
                    return true;
                    break;

                case 'refunded':
                    return true;
                    break;
                
                default:
                    return true;
                    break;
            }
        } catch (\Exception $e) {
            Log::error("Ocurrió un error al hacer la llamada HTTP: " . $e->getMessage());
            return false;
        }
    }

    /**
     * Crea la solicitud de pago al gateway
     *
     * @param float $amount
     * @return array
     */
    public function create_payment($amount) : array
    {
        if ($this->is_available()) {
            try {
                    $headers = [
                        'x-api-key' => $this->now_payments_api_key_dev,
                        'Content-Type' => 'application/json',
                    ];

                    $body = [
                        "price_amount" => (float) $amount,
                        "pay_amount" => (float) $amount,
                        "price_currency" => "usd",
                        "pay_currency" => "usdt",
                        "ipn_callback_url" => "http://192.168.0.105/ipn_novo/",
                        "order_id" => "RGDBP-21314",
                        // "case" => "failed",
                        "case" => "success",
                    ];
                    //https://api.nowpayments.io/v1/payment
                    //https://api-sandbox.nowpayments.io/v1/payment
                    $response = Http::withHeaders($headers)->post('https://api-sandbox.nowpayments.io/v1/payment', $body);
                    
                    $data = json_decode($response->getBody(), true);
                    
                    return $data;
            } catch (\Exception $e) {
                return Redirect::back()->withMessage(['msg' => "There's an error in the data", 'type' => 'error']);
            }
        } else {
            return ['error' => 'La pasarela de pago no se encuentra disponible'];
        }
    }
}
