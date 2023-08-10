<?php

namespace App\Http\Controllers;

use GuzzleHttp\Client;
use Illuminate\Http\Request;
use App\Services\PaymentService;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Http;
use App\Http\Controllers\PaymentController;
use PrevailExcel\Nowpayments\Facades\Nowpayments;

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

    public function membership()
    {
        return view('payment.membership');
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

    /**
     * Collect Order data and create Payment
     *
     * @return Url
     */
    // public function createCryptoPayment()
    // {
    //     try {
    //         $client = new Client();
    //         $headers = [
    //             'x-api-key' => 'YX93KEM-H8QMHSX-JZZCVXC-0CVHSKV',
    //             'Content-Type' => 'application/json',
    //         ];

    //         $body = [
    //             "price_amount" => 100.5,
    //             "price_currency" => "usd",
    //             "pay_amount" => 50.8102725,
    //             "pay_currency" => "usdt",
    //             "ipn_callback_url" => "http://192.168.0.105/ipn_novo/",
    //             "order_id" => "RGDBP-21314",
    //             "order_description" => "Apple Macbook Pro 2019 x 1",
    //             // "case" => "failed"
    //             "case" => "success"
    //         ];

    //         $response = Http::withHeaders($headers)->post('https://api-sandbox.nowpayments.io/v1/payment', $body);
    //         echo $response->getBody();

            
    //         Log::debug("que carajo", [$res->getBody()]);
    //         // Now you have the payment details,
    //         // you can then redirect or do whatever you want

    //         // return Redirect::back()->with(['msg' => "Payment created successfully", 'type' => 'success'], 'data' => $paymentDetails);
    //     } catch (\Exception $e) {
    //         // return Redirect::back()->withMessage(['msg' => "There's an error in the data", 'type' => 'error']);
    //     }
    // }

    // public function createCryptoPayment()
    // {
    //     //con factura
        
    //     try {
    //         $client = new Client();
    //         $headers = [
    //             'x-api-key' => 'YX93KEM-H8QMHSX-JZZCVXC-0CVHSKV',
    //             'Content-Type' => 'application/json',
    //         ];

    //         $body = [
    //             "iid" => random_int(999, 9999),
    //             "pay_currency" => "usdt",
    //             // "order_id" => "RGDBP-21314",
    //             "order_description" => "Apple Macbook Pro 2019 x 1",

    //             // "price_amount" => 5000.5,
    //             // "price_currency" => "usd",
    //             // "ipn_callback_url" => "http://192.168.0.105/ipn_novo/",
    //             // "case" => "failed"
    //             "case" => "success"
    //         ];

    //         $res = Http::withHeaders($headers)->post('https://api.nowpayments.io/v1/invoice-payment', $body);
    //         echo $res->getBody();
            
    //         Log::debug("que carajo", [$res->getBody()]);
    //         // Now you have the payment details,
    //         // you can then redirect or do whatever you want

    //         // return Redirect::back()->with(['msg' => "Payment created successfully", 'type' => 'success'], 'data' => $paymentDetails);
    //     } catch (\Exception $e) {
    //         // return Redirect::back()->withMessage(['msg' => "There's an error in the data", 'type' => 'error']);
    //     }
    // }

    // public function createCryptoPayment()
    // {
    //     //get jwt
                
    //     try {
    //         $client = new Client();
    //         $headers = [
    //             'Content-Type' => 'application/json',
    //         ];

    //         $body = [
    //             "email" => "sosaheriberto2001@gmail.com",
    //             "password" => "Amy2023*",
    //         ];

    //         $res = Http::withHeaders($headers)->post('https://api.nowpayments.io/v1/auth', $body);
    //         echo $res->getBody();
            
    //         Log::debug("que carajo", [$res->getBody()]);
    //         // Now you have the payment details,
    //         // you can then redirect or do whatever you want

    //         // return Redirect::back()->with(['msg' => "Payment created successfully", 'type' => 'success'], 'data' => $paymentDetails);
    //     } catch (\Exception $e) {
    //         // return Redirect::back()->withMessage(['msg' => "There's an error in the data", 'type' => 'error']);
    //     }
    // }

    public function createCryptoPayment()
    {
        //lista pagos
        
        try {
            $client = new Client();
            $headers = [
                'x-api-key' => 'VJSEG49-JV3M54S-M4Q8J5F-0185AVC',
                'Authorization' => 'eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJpZCI6IjQ1Njc0MjE3NTciLCJpYXQiOjE2OTE1MjE1MjIsImV4cCI6MTY5MTUyMTgyMn0.IBPyVRrbtkpDj3_ICJ74692_oV8wk2Qk8Lgzb5-h6B4',
            ];

            $res = Http::withHeaders($headers)->get('https://api.nowpayments.io/v1/payment/?dateFrom=2020-01-01&dateTo=2023-07-01&invoiceId');
            echo $res->getBody();
            
            Log::debug("que carajo", [$res->getBody()]);
            // Now you have the payment details,
            // you can then redirect or do whatever you want

            // return Redirect::back()->with(['msg' => "Payment created successfully", 'type' => 'success'], 'data' => $paymentDetails);
        } catch (\Exception $e) {
            // return Redirect::back()->withMessage(['msg' => "There's an error in the data", 'type' => 'error']);
        }
    }

    public function ipnHandler(Request $request)
    {

        Log::debug("Hola", [$request->all()]);
    }
}
