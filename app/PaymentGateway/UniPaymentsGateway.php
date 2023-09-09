<?php

namespace App\PaymentGateway;

use GuzzleHttp\Client;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Redirect;

class UniPaymentsGateway
{
    protected $uni_payments_enviroment;
    protected $client;

    protected $uni_payments_client_id;
    protected $uni_payments_client_secret;
    
    protected $uni_payments_app_id;

    protected $uni_payments_base_url;

    public function __construct()
    {
        $this->uni_payments_base_url = 'https://api.nowpayments.io/';
        $this->uni_payments_enviroment = config('services.unipayments.enviroment');

        $this->uni_payments_app_id = config('services.unipayments.app_id');
        $this->uni_payments_client_id = config('services.unipayments.client_id');
        $this->uni_payments_client_secret = config('services.unipayments.client_secret');

        $this->client = new \UniPayment\Client\UniPaymentClient();
        $this->client->getConfig()->setClientId($this->uni_payments_client_id);
        $this->client->getConfig()->setClientSecret($this->uni_payments_client_secret);

        if ($this->uni_payments_enviroment == 'sandbox') {
            $this->client->getConfig()->setIsSandbox(true);
        }
    }

    /**
     * Retorna el estatus actual del API de nowpayments
     *
     * @return boolean
     */
    public function is_available()
    {

        try {
            $response = Http::get($this->uni_payments_base_url.'v1/status');
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
                'x-api-key' => $this->uni_payments_api_key,
            ];
            $response = Http::withHeaders($headers)->get($this->now_payments_base_url.'payment/'.$orderId);
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
     * Crea la factura de pago al gateway
     *
     * @param float $amount
     * @return array
     */
    public function create_payment($amount) //: array
    {
        try {
            $createInvoiceRequest = new \UniPayment\Client\Model\CreateInvoiceRequest();
            $createInvoiceRequest->setAppId($this->uni_payments_app_id);
            $createInvoiceRequest->setPriceAmount((float) $amount);
            $createInvoiceRequest->setPriceCurrency("USD");
            $createInvoiceRequest->setNotifyUrl("https://example.com/notify");
            $createInvoiceRequest->setRedirectUrl("https://example.com/redirect");
            $createInvoiceRequest->setOrderId("#123456");
            $createInvoiceRequest->setTitle("MacBook Air");
            $createInvoiceRequest->setDescription("MacBookAir (256#)");

            $response = $this->client->createInvoice($createInvoiceRequest);
            $data = json_decode($response->getBody(), true);

            dd($response);
                    
            return $data;
        } catch (\Exception $e) {
            return Redirect::back()->withMessage(['msg' => "There's an error in the data", 'type' => 'error']);
        }
    }
}
