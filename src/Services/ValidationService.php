<?php

namespace Syedmahamudul\Sslcommerz\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class ValidationService
{
    protected array $config;

    public function __construct(array $config)
    {
        $this->config = $config;
    }

    public function validate(array $data, string $transactionId, float $amount): bool
    {
        try {
            // Check if it's already validated
            if (isset($data['status']) && $data['status'] === 'VALID' && isset($data['val_id'])) {
                // Verify with SSLCommerz
                $validationData = [
                    'store_id' => $this->config['store_id'],
                    'store_passwd' => $this->config['store_password'],
                    'tran_id' => $transactionId,
                    'val_id' => $data['val_id'],
                    'amount' => $amount,
                    'currency' => $this->config['currency'],
                ];

                $endpoint = $this->getEndpoint('validate');
                $response = Http::asForm()->post($endpoint, $validationData);

                if ($response->successful()) {
                    $result = $response->json();
                    return isset($result['status']) && $result['status'] === 'VALID';
                }
            }

            return false;

        } catch (\Exception $e) {
            Log::error('SSLCommerz Validation Error', [
                'message' => $e->getMessage(),
                'transaction_id' => $transactionId,
            ]);
            return false;
        }
    }

    protected function getEndpoint(string $type): string
    {
        $mode = $this->config['sandbox'] ? 'sandbox' : 'live';
        return $this->config['endpoints'][$type][$mode] ?? '';
    }
}