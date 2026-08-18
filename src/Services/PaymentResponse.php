<?php

namespace Syedmahamudul\Sslcommerz\Services;

class PaymentResponse
{
    protected $data;

    public function __construct($data)
    {
        $this->data = $data;
    }

    public function success()
    {
        return isset($this->data['status']) 
            && strtoupper($this->data['status']) === 'SUCCESS';
    }

    public function failed()
    {
        return isset($this->data['status']) 
            && strtoupper($this->data['status']) === 'FAILED';
    }

    public function gatewayPageURL()
    {
        return $this->data['GatewayPageURL'] 
            ?? $this->data['redirectGatewayURL'] 
            ?? null;
    }

    public function transactionId()
    {
        return $this->data['tran_id'] ?? null;
    }

    public function validationId()
    {
        return $this->data['val_id'] ?? null;
    }

    public function sessionKey()
    {
        return $this->data['sessionkey'] ?? null;
    }

    public function error()
    {
        return $this->data['failedreason'] 
            ?? $this->data['failed_reason'] 
            ?? $this->data['error'] 
            ?? $this->data['error_message'] 
            ?? 'Unknown error occurred';
    }

    public function rawResponse()
    {
        return $this->data;
    }

    public function all()
    {
        return $this->data;
    }

    public function __get($key)
    {
        return $this->data[$key] ?? null;
    }
}