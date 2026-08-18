<?php

namespace Syedmahamudul\Sslcommerz\Console\Commands;

use Illuminate\Console\Command;
use Syedmahamudul\Sslcommerz\Facades\Sslcommerz;

class MakePaymentCommand extends Command
{
    protected $signature = 'sslcommerz:make-payment 
                            {amount=100 : Payment amount}
                            {--product=Test Product : Product name}
                            {--email=test@example.com : Customer email}
                            {--phone=01700000000 : Customer phone}';
    
    protected $description = 'Test SSLCommerz payment';

    public function handle()
    {
        $amount = $this->argument('amount');
        $product = $this->option('product');
        $email = $this->option('email');
        $phone = $this->option('phone');

        $this->info('💳 Initiating test payment...');

        try {
            $response = Sslcommerz::init([
                'total_amount' => $amount,
                'product_name' => $product,
            ])
            ->setCustomer([
                'name' => 'Test Customer',
                'email' => $email,
                'phone' => $phone,
                'address' => 'Dhaka, Bangladesh',
                'city' => 'Dhaka',
                'country' => 'Bangladesh',
            ])
            ->setShipping([
                'method' => 'NO',
                'name' => 'Test Customer',
                'address' => 'Dhaka, Bangladesh',
                'city' => 'Dhaka',
                'country' => 'Bangladesh',
                'postcode' => '1000',
            ])
            ->addProduct([
                'name' => $product,
                'amount' => $amount,
                'quantity' => 1,
            ])
            ->execute();

            if ($response->success()) {
                $this->info('✅ Payment initiated successfully!');
                $this->info('Transaction ID: ' . $response->transactionId());
                $this->info('Payment URL: ' . $response->gatewayPageURL());
            } else {
                $this->error('❌ Payment initiation failed!');
                $this->error('Error: ' . $response->error());
            }

        } catch (\Exception $e) {
            $this->error('❌ Error: ' . $e->getMessage());
        }
    }
}