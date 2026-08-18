<?php

namespace Syedmahamudul\Sslcommerz\Contracts;

interface SslcommerzInterface
{
    public function init(array $data): self;
    public function setCustomer(array $customer): self;
    public function setShipping(array $shipping): self;
    public function addProduct(array $product): self;
    public function execute(): \Syedmahamudul\Sslcommerz\Services\PaymentResponse;
    public function validate(array $data, string $transactionId, float $amount): bool;
    public function refund(string $transactionId, float $amount, string $reason = ''): array;
    public function query(string $transactionId): array;
}