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

    public function binanceWebhook(Request $request)
    {
        {
        $callbackResponse = file_get_contents('php://input');
        Log::channel('binance')->info($callbackResponse);
        $callbackResponse = $callbackResponse.PHP_EOL;

        $log = json_decode($callbackResponse, true);

        if (isset($log['bizStatus']) && isset($log['bizId'])) {
            $payment_id = "BI_".$log['bizIdStr'];
            Log::debug($payment_id);
            try {
                $payment = Payment::where('payment_id', $payment_id)->first();

                if ($payment->payment_status == "pending" && $log['bizStatus'] == 'PAY_SUCCESS') {
                    $payment->payment_status = "approved";
                    $payment->save();

                    $order = Order::where('payment_id', $payment_id)->first();

                    $tic = $this->generarTickets($payment->payer_id, $order->event, $order->quantity);
                    $url_ref = url('/referral'.'/'.$payment->user->referral_link.'/'. $tic[0] .'/'.$order->event);

                    $factura = str_pad($order->event, 4, '0', STR_PAD_LEFT). "-" . str_pad($order->id, 4, '0', STR_PAD_LEFT);

                    $data_invoice = [
                        'factura_id' => $factura,
                        'fecha' => date("d/m/Y"),
                        'nombre' => $payment->user->name,
                        'direccion' => $payment->user->address,
                        'tlf' => $payment->user->phone,
                        'payment' => $payment->currency == 'COP' ? "MercadoPago" : "Binance",
                        'tickets' => $tic,
                        'total' => $payment->amount,
                        'evento' => eventName($order->event),
                    ];

                    Mail::to($payment->payer_email)->send(new UserTicketsPurchasedMKNotification($tic, $url_ref, $data_invoice));
                }
                response()->json(['success' => 'success'], 200);
            } catch (Exception $e) {
                Log::debug($e);
                return $e->getMessage();
            }
        } else {
            Log::error("Error con response de binance", [$callbackResponse]);
        }
        }
    }

    public function getEpochTime($minutes)
    {
        // Obtener la fecha y hora actual
        $now = time();

        // Agregar los minutos especificados al tiempo actual
        $targetTime = strtotime("+{$minutes} minutes", $now);

        // Retornar el valor del timestamp en epoch en milisegundos
        return $targetTime * 1000;
    }
}
