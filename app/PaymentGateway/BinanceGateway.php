<?php

namespace App\PaymentGateway;

use Illuminate\Support\Facades\Log;

class BinanceGateway
{
    protected $binance_pay_key;
    protected $binance_pay_secret;

    public function __construct()
    {
        $this->binance_pay_key = config('services.binance.key');
        $this->binance_pay_secret = config('services.binance.secret');
    }

    public function charge($amount, $paymentMethod)
    {
            // Generar el nonce, el timestamp, el payload y la firma
            $nonce = \Str::random(32);
            $ch = curl_init();
            $timestamp = round(microtime(true) * 1000);
        
            // Request body
            $req = [
                        "env" => [
                                    "terminalType" => "APP",
                                 ],
                        "merchantTradeNo" => mt_rand(982538, 9825382937292),
                        "orderAmount" => $amount,
                        "currency" => 'USDT',
                        "goods" => [
                                    "goodsType" => "02",
                                    "goodsCategory" => "Z000",
                                    "referenceGoodsId" => 001, //TODO id de la orden
                                    "goodsName" => "Pago suscripcion"
                        ],
                        "returnUrl" => route('payment.success'),
                        "cancelUrl" => route('payment.error'),
                        "orderExpireTime" => $this->getEpochTime(5),
                        ];
        
            $json_request = json_encode($req);

            $payload = $timestamp."\n".$nonce."\n".$json_request."\n";


            // Hacer la llamada a la API de Binance con curl
            $binance_pay_key = env('API_KEY_BINANCE');
            $binance_pay_secret = env('SECRET_KEY_BINANCE');

            $signature = strtoupper(hash_hmac('SHA512', $payload, $binance_pay_secret));

            $headers = array();
            $headers[] = "Content-Type: application/json";
            $headers[] = "BinancePay-Timestamp: $timestamp";
            $headers[] = "BinancePay-Nonce: $nonce";
            $headers[] = "BinancePay-Certificate-SN: $binance_pay_key";
            $headers[] = "BinancePay-Signature: $signature";

            curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
            curl_setopt($ch, CURLOPT_URL, "https://bpay.binanceapi.com/binancepay/openapi/v2/order");
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
            curl_setopt($ch, CURLOPT_POST, 1);
            curl_setopt($ch, CURLOPT_POSTFIELDS, $json_request);

            $result = curl_exec($ch);

            // Verificar el resultado del pago
            if (json_decode($result)->status == "FAIL") {
                Log::debug("Error FAIL binance", [$result]);
                throw new \Exception("Error al procesar el pago con Binance: " . $result);
                // return false;
            }

            if (curl_errno($ch)) {
                echo 'Error:' . curl_error($ch);
                throw new \Exception("Error al interactuar con la API de Binance: " . curl_error($ch));
            }
            curl_close($ch);
            
            // Devolver true si el pago fue exitoso, false en caso contrario
            return true;
    }
}
