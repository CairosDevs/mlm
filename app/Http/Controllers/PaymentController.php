<?php

namespace App\Http\Controllers;

use GuzzleHttp\Client;
use Illuminate\Support\Str;
use App\Models\OrderPayment;
use Illuminate\Http\Request;
use App\Services\EWalletService;
use App\Services\PaymentService;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use PrevailExcel\Nowpayments\Facades\Nowpayments;

class PaymentController extends Controller
{
    protected $paymentService;
    protected $EWalletService;

    public function __construct(
        PaymentService $paymentService,
        EWalletService $EWalletService
    )
    {
        $this->paymentService = $paymentService;
        $this->EWalletService = $EWalletService;
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
        if ($request->type != 'withdraw') {
            $data = $this->paymentService->charge($request->amount);
            if (isset($data['status']) && $data['status'] == false) {
                return back()->with(['error' => $data['message']]);
            }
            Log::debug("response API", [$data]);

            $uuid = (string) Str::uuid();
            $shortUuid = substr($uuid, 0, 8);
        
            $orderPayment = OrderPayment::create([
                'payment_id' => $shortUuid,
                'external_payment_id' => $data['payment_id'],
                'user_id' => Auth::user()->id,
                'amount' => $data['price_amount'],
                'type' => $request->type,
                'status' => 'pending',
            ]);
        }

        $this->EWalletService->transaction($request->amount, $request->type);


        if ($request->type == 'withdraw') {
            $uuid = (string) Str::uuid();
            $shortUuid = substr($uuid, 0, 8);
        
            $orderPayment = OrderPayment::create([
                'payment_id' => $shortUuid,
                'external_payment_id' => 0,
                'user_id' => Auth::user()->id,
                'amount' => $request->amount,
                'type' => $request->type,
                'status' => 'requested',
            ]);

            return view('dashboard')->with('success', 'retiro temporal exitoso');
        }

        if (!isset($data['error'])) {
            if ($request->type == 'withdraw') {
                return view('dashboard')->with('success', 'retiro temporal exitoso');
            } else {
                return view('payment.form')->with('payment_data', $data);
            }
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
            $this->updateOrderStatus($orderId, 'paid');

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

    public function updateOrderStatus($orderId, $status)
    {
        $orderPayment = OrderPayment::where('external_payment_id', $orderId)->first();

        $orderPayment->status = $status;
        $orderPayment->save();
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
