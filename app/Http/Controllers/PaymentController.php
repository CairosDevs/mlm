<?php

namespace App\Http\Controllers;

use App\Models\Profit;
use GuzzleHttp\Client;
use Illuminate\Support\Str;
use App\Models\OrderPayment;
use Illuminate\Http\Request;
use App\Services\EmailService;
use Illuminate\Support\Carbon;
use App\Services\EWalletService;
use App\Services\PaymentService;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use App\Jobs\SendEmailPaymentConfirmedJob;
use anlutro\LaravelSettings\Facades\Setting;
use PrevailExcel\Nowpayments\Facades\Nowpayments;

class PaymentController extends Controller
{
    protected $paymentService;
    protected $EWalletService;
    protected $emailService;

    public function __construct(
        PaymentService $paymentService,
        EWalletService $EWalletService,
        EmailService $emailService
    )
    {
        $this->paymentService = $paymentService;
        $this->EWalletService = $EWalletService;
        $this->emailService = $emailService;
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
            if ($request->type == 'deposit') {
                if ($request->amount < Setting::get('deposito_minimo')) {
                    return back()->with(['error' => 'El monto minimo de deposito es de '. Setting::get('deposito_minimo').'$' ]);
                }
            }

            if ($request->amount > Setting::get('deposito_maximo')) {
                return back()->with(['error' => 'El monto máximo de deposito es de '. Setting::get('deposito_maximo').'$' ]);
            }

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

        if ($request->type == 'withdraw') {
            $lastMonday = Carbon::now()->subWeek()->startOfWeek();
            $lastFriday = Carbon::now()->subWeek()->endOfWeek()->subDays(2);

            $userWeek = Profit::where('user_id', Auth::user()->id)
                            ->where('start', $lastMonday)
                            ->where('end', $lastFriday)
                            ->first();

            if ($request->amount > $userWeek->profit) {
                return back()->with(['error' => 'Tus ganancias disponibles para retiro son de máximo '. $userWeek->profit .'$ para esta semana' ]);
            }

            $userWeek->profit -= $request->amount;
            $comission = $request->amount * Setting::get('porcentaje_comision')/100;
            $userWeek->profit -= $comission;
            $userWeek->save();

            $uuid = (string) Str::uuid();
            $shortUuid = substr($uuid, 0, 8);
        
            $orderPayment = OrderPayment::create([
                'payment_id' => $shortUuid,
                'external_payment_id' => 0,
                'user_id' => Auth::user()->id,
                'amount' => $request->amount + $comission,
                'type' => $request->type,
                'status' => 'requested',
            ]);

            return view('dashboard')->with('success', 'retiro temporal exitoso');
        }

        $this->EWalletService->transaction($request->amount, $request->type);


        if (!isset($data['error'])) {
            if ($request->type == 'withdraw') {
                return view('dashboard')->with('sweet-success', 'retiro temporal exitoso');
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
                'orderId' => $orderId,
                'success' => "La orden fue pagada exitosamente",
            ]);
        } else {
            return response()->json([
                'status' => false,
                'orderId' => $orderId,
                'error' => "No se ha realizado el pago",
            ]);
        }
    }

    public function updateOrderStatus($orderId, $status)
    {
        $orderPayment = OrderPayment::where('external_payment_id', $orderId)->first();

        $orderPayment->status = $status;
        $orderPayment->save();

        $this->emailService->sendPaymentConfirmation($orderPayment->user, $orderPayment, $status);
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
        Log::debug("Notificacion ", [$request->all()]);
    }
}
