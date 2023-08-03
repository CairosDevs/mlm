<?php

namespace App\Services;

use App\PaymentGateway\BinanceGateway;

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

    public function binanceWebhook(Request $request)
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
