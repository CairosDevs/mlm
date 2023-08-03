<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\PaymentService;
use App\Http\Controllers\PaymentController;

class PaymentController extends Controller
{
    protected $paymentService;

    public function __construct(PaymentService $paymentService)
    {
        $this->paymentService = $paymentService;
    }

    public function paymentForm()
    {
        return view('payment.form');
    }

    public function store(Request $request)
    {
        // Validar los datos del formulario
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
}
