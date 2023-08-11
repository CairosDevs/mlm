<?php

namespace App\Http\Controllers;

use GuzzleHttp\Client;
use Illuminate\Support\Str;
use App\Models\OrderPayment;
use Illuminate\Http\Request;
use App\Services\PaymentService;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use PrevailExcel\Nowpayments\Facades\Nowpayments;

class PaymentController extends Controller
{
    protected $paymentService;

    public function __construct(PaymentService $paymentService)
    {
        $this->paymentService = $paymentService;
    }
    
    /**
     * Vista seleccion de membresia
     */
    public function membership()
    {
        return view('payment.membership');
    }

    /**
     * Vista form de pago
     */
    public function paymentForm(Request $request)
    {
        $data = $this->paymentService->charge($request->amount);
        
        $uuid = (string) Str::uuid();
        $shortUuid = substr($uuid, 0, 8);

        $orderPayment = OrderPayment::create([
            'payment_id' => $shortUuid,
            'external_payment_id' => $data['payment_id'],
            'user_id' => Auth::user()->id,
            'amount' => $data['price_amount'],
            'type' => 'membership',
            'status' => 'pending',
        ]);

        if (!isset($data['error'])) {
            return view('payment.form')->with('payment_data', $data);
        } else {
            return back()->with(['error' => 'La pasarela de pago no se encuentra disponible']);
        }
    }

    /**
     * Crea orden pago
     */
    public function store(Request $request)
    {
        $request->validate([
            'amount' => 'required|numeric',
            'payment_method' => 'required|string',
        ]);

        // Procesar el pago
        $result = $this->paymentService
                        ->processPayment(
                            $request->input('amount'),
                            $request->input('payment_method')
                        );

        // Redirigir al usuario a la página de éxito o fracaso
        if ($result) {
            return redirect()->route('payment.success');
        } else {
            return redirect()->route('payment.failure');
        }
    }

    /**
     * Status de orden de pago
     */
    public function orderStatus(Request $request, $orderId)
    {
        $status = $this->paymentService->isPaid($orderId);
        
        if ($status) {
            return response()->json([
                'status' => true,
                'success' => "La orden fue pagada exitosamente",
            ]);
        } else {
            return response()->json([
                'status' => false,
                'error' => "No se ha realizado el pago",
            ]);
        }
    }

    /**
     * Cancela orden al vncer tiempo
     */
    public function cancelOrderPayment(Request $request)
    {
        $orderPayment = OrderPayment::where('external_payment_id', $request->orderId)->first();

        if ($orderPayment->status == 'pending') {
            $orderPayment->status = 'canceled';
            $orderPayment->save();
        }

        return response()->json([
            'error' => "La orden fue cancelada, intente nuevamente",
        ]);
    }

    public function ipnHandler(Request $request)
    {
        Log::debug("Hola", [$request->all()]);
    }
}
