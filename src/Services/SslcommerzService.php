<?php

namespace Syedmahamudul\Sslcommerz\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class SslcommerzService
{
    protected $config;
    protected $payload = [];

    public function __construct($config)
    {
        $this->config = $config;
    }

    public function init($data)
    {
      
        // Get route names from config
        $successRoute = config('sslcommerz.routes.success', 'sslcommerz.success');
        $failureRoute = config('sslcommerz.routes.failure', 'sslcommerz.failure');
        $cancelRoute = config('sslcommerz.routes.cancel', 'sslcommerz.cancel');
        $ipnRoute = config('sslcommerz.routes.ipn', 'sslcommerz.ipn');

        // Generate transaction ID
        $tranId = $data['tran_id'] ?? 'SSL' . time() . '_' . uniqid();

        // Build base payload with V4 required fields
        $this->payload = [
            // Store credentials
            'store_id' => $this->config['store_id'],
            'store_passwd' => $this->config['store_password'],
            
            // Transaction details
            'total_amount' => $data['total_amount'] ?? 0,
            'currency' => $data['currency'] ?? $this->config['currency'] ?? 'BDT',
            'tran_id' => $tranId,
            
            // Product details (REQUIRED for V4)
            'product_name' => $data['product_name'] ?? 'Product',
            'product_category' => $data['product_category'] ?? 'General',
            'product_profile' => $data['product_profile'] ?? 'general',
            
            // URLs (REQUIRED for V4)
            'success_url' => route($successRoute),
            'fail_url' => route($failureRoute),
            'cancel_url' => route($cancelRoute),
            'ipn_url' => route($ipnRoute),
            
            // EMI options
            'emi_option' => $data['emi_option'] ?? 0,
            'emi_max_inst_option' => $data['emi_max_inst_option'] ?? 0,
            'emi_selected_inst' => $data['emi_selected_inst'] ?? null,
            
            // Card BIN
            'multi_card_name' => $data['multi_card_name'] ?? 'mastercard,visacard,amexcard',
            'allowed_bin' => $data['allowed_bin'] ?? null,
        ];

        // Add customer data if provided
        if (isset($data['customer'])) {
            $this->payload = array_merge($this->payload, $data['customer']);
        }

        // Remove null values
        $this->payload = array_filter($this->payload, function ($value) {
            return $value !== null;
        });

        return $this;
    }

    public function setCustomer($customer)
    {
        $this->payload = array_merge($this->payload, [
            'cus_name' => $customer['name'] ?? null,
            'cus_email' => $customer['email'] ?? null,
            'cus_phone' => $customer['phone'] ?? null,
            'cus_add1' => $customer['address'] ?? null,
            'cus_add2' => $customer['address2'] ?? null,
            'cus_city' => $customer['city'] ?? null,
            'cus_state' => $customer['state'] ?? null,
            'cus_postcode' => $customer['postcode'] ?? '1000',
            'cus_country' => $customer['country'] ?? 'Bangladesh',
            'cus_fax' => $customer['fax'] ?? null,
        ]);

        return $this;
    }

    public function setShipping($shipping)
    {
        $this->payload = array_merge($this->payload, [
            'shipping_method' => $shipping['method'] ?? 'NO',
            'ship_name' => $shipping['name'] ?? null,
            'ship_add1' => $shipping['address'] ?? null,
            'ship_add2' => $shipping['address2'] ?? null,
            'ship_city' => $shipping['city'] ?? null,
            'ship_state' => $shipping['state'] ?? null,
            'ship_postcode' => $shipping['postcode'] ?? '1000',
            'ship_country' => $shipping['country'] ?? 'Bangladesh',
        ]);

        return $this;
    }

    public function addProduct($product)
    {
        if (!isset($this->payload['products'])) {
            $this->payload['products'] = [];
        }

        $this->payload['products'][] = [
            'product_name' => $product['name'] ?? null,
            'product_amount' => $product['amount'] ?? 0,
            'quantity' => $product['quantity'] ?? 1,
        ];

        return $this;
    }

    public function execute()
    {
        try {
            // Get V4 endpoint
            $endpoint = $this->config['sandbox'] 
                ? 'https://sandbox.sslcommerz.com/gwprocess/v4/api.php'
                : 'https://securepay.sslcommerz.com/gwprocess/v4/api.php';

            // Log request
            Log::info('SSLCommerz V4 Request', [
                'endpoint' => $endpoint,
                'payload' => $this->payload
            ]);

            // Make request with Guzzle
            $client = new \GuzzleHttp\Client([
                'verify' => false,
                'timeout' => 60,
                'connect_timeout' => 60,
                'headers' => [
                    'User-Agent' => 'SSLCommerz-Laravel/1.0',
                    'Accept' => 'application/json',
                ]
            ]);

            $response = $client->post($endpoint, [
                'form_params' => $this->payload,
            ]);

            $responseBody = $response->getBody()->getContents();
            $responseData = json_decode($responseBody, true);

            // Log response
            Log::info('SSLCommerz V4 Response', [
                'status_code' => $response->getStatusCode(),
                'response' => $responseData
            ]);

            // Check if response is successful
            if ($response->getStatusCode() === 200 && isset($responseData['status']) && $responseData['status'] === 'SUCCESS') {
                return new PaymentResponse($responseData);
            }

            // Get error message
            $errorMessage = $responseData['failedreason'] 
                ?? $responseData['failed_reason'] 
                ?? $responseData['error'] 
                ?? $responseData['error_message'] 
                ?? 'Unknown error occurred';

            return new PaymentResponse([
                'status' => 'FAILED',
                'failed_reason' => $errorMessage,
                'raw_response' => $responseData,
            ]);

        } catch (\Exception $e) {
            Log::error('SSLCommerz V4 Exception', [
                'message' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);

            return new PaymentResponse([
                'status' => 'FAILED',
                'failed_reason' => $e->getMessage()
            ]);
        }
    }

    public function validate($data, $transactionId, $amount)
    {
        try {
            // V4 validation endpoint
            $endpoint = $this->config['sandbox'] 
                ? 'https://sandbox.sslcommerz.com/validator/api/validationserverAPI.php'
                : 'https://securepay.sslcommerz.com/validator/api/validationserverAPI.php';

            $payload = [
                'val_id' => $data['val_id'] ?? null,
                'store_id' => $this->config['store_id'],
                'store_passwd' => $this->config['store_password'],
                'format' => 'json',
            ];

            $client = new \GuzzleHttp\Client(['verify' => false]);
            $response = $client->get($endpoint, ['query' => $payload]);
            $responseData = json_decode($response->getBody(), true);

            if (isset($responseData['status']) && $responseData['status'] === 'VALID') {
                return true;
            }

            return false;

        } catch (\Exception $e) {
            Log::error('SSLCommerz Validation Error', [
                'message' => $e->getMessage(),
                'transaction_id' => $transactionId
            ]);
            return false;
        }
    }

    public function refund($bankTransactionId, $amount, $reason = '')
    {
        try {
            $endpoint = $this->config['sandbox']
                ? 'https://sandbox.sslcommerz.com/validator/api/merchantTransIDvalidationAPI.php'
                : 'https://securepay.sslcommerz.com/validator/api/merchantTransIDvalidationAPI.php';

            $payload = [
                'bank_tran_id' => $bankTransactionId,
                'refund_trans_id' => 'REF_' . time() . '_' . uniqid(),
                'refund_amount' => $amount,
                'refund_remarks' => $reason,
                'store_id' => $this->config['store_id'],
                'store_passwd' => $this->config['store_password'],
                'format' => 'json',
            ];

            $client = new \GuzzleHttp\Client(['verify' => false]);
            $response = $client->get($endpoint, ['query' => $payload]);
            return json_decode($response->getBody(), true);

        } catch (\Exception $e) {
            Log::error('SSLCommerz Refund Error', [
                'message' => $e->getMessage()
            ]);
            return ['status' => 'FAILED', 'message' => $e->getMessage()];
        }
    }

    public function query($transactionId)
    {
        try {
            $endpoint = $this->config['sandbox']
                ? 'https://sandbox.sslcommerz.com/validator/api/merchantTransIDvalidationAPI.php'
                : 'https://securepay.sslcommerz.com/validator/api/merchantTransIDvalidationAPI.php';

            $payload = [
                'tran_id' => $transactionId,
                'store_id' => $this->config['store_id'],
                'store_passwd' => $this->config['store_password'],
                'format' => 'json',
            ];

            $client = new \GuzzleHttp\Client(['verify' => false]);
            $response = $client->get($endpoint, ['query' => $payload]);
            return json_decode($response->getBody(), true);

        } catch (\Exception $e) {
            Log::error('SSLCommerz Query Error', [
                'message' => $e->getMessage()
            ]);
            return ['status' => 'FAILED', 'message' => $e->getMessage()];
        }
    }
}