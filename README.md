# SSLCommerz Payment Gateway Package for Laravel

[![Latest Stable Version](https://poser.pugx.org/syedmahamudul/sslcommerz-laravel/v/stable)](https://packagist.org/packages/syedmahamudul/sslcommerz-laravel)
[![Total Downloads](https://poser.pugx.org/syedmahamudul/sslcommerz-laravel/downloads)](https://packagist.org/packages/syedmahamudul/sslcommerz-laravel)
[![Latest Unstable Version](https://poser.pugx.org/syedmahamudul/sslcommerz-laravel/v/unstable)](https://packagist.org/packages/syedmahamudul/sslcommerz-laravel)
[![License](https://poser.pugx.org/syedmahamudul/sslcommerz-laravel/license)](https://packagist.org/packages/syedmahamudul/sslcommerz-laravel)
[![GitHub stars](https://img.shields.io/github/stars/syedmahamudul/sslcommerz-laravel)](https://github.com/syedmahamudul/sslcommerz-laravel)
[![Monthly Downloads](https://poser.pugx.org/syedmahamudul/sslcommerz-laravel/d/monthly)](https://packagist.org/packages/syedmahamudul/sslcommerz-laravel)
[![Daily Downloads](https://poser.pugx.org/syedmahamudul/sslcommerz-laravel/d/daily)](https://packagist.org/packages/syedmahamudul/sslcommerz-laravel)
[![composer.lock](https://poser.pugx.org/syedmahamudul/sslcommerz-laravel/composerlock)](https://packagist.org/packages/syedmahamudul/sslcommerz-laravel)
[![PHP Version](https://img.shields.io/packagist/php-v/syedmahamudul/sslcommerz-laravel)](https://packagist.org/packages/syedmahamudul/sslcommerz-laravel)

This package is built for [SSLCommerz](https://www.sslcommerz.com) online payment gateway in Bangladesh. It supports **Laravel 5.6+, 6.x, 7.x, 8.x, 9.x, 10.x, and 11.x, 12.x, 13.x** and works with **PHP 7.4 to 8.6+**.

## 🚀 Features

- ✅ **Easy Installation** - One command installation
- ✅ **Fluent API** - Chainable methods for building payment requests
- ✅ **Automatic Validation** - Built-in payment validation
- ✅ **IPN Support** - Instant Payment Notification handling
- ✅ **Refund Functionality** - Process refunds easily
- ✅ **Transaction Query** - Check transaction status
- ✅ **Sandbox/Live Mode** - Easy switching between test and production
- ✅ **All Laravel Versions** - Works with Laravel 5.5 to 13.x
- ✅ **PHP 7.4 to 8.6+** - Compatible with all PHP versions
- ✅ **No Version Conflicts** - Works with any Laravel project
- ✅ **Comprehensive Error Handling** - Detailed error messages
- ✅ **Event-driven Architecture** - Events for payment statuses
- ✅ **Comprehensive Logging** - Debug and track payments
- ✅ **EMI Support** - Easy EMI payment integration
- ✅ **Card BIN Restriction** - Restrict payments to specific card BINs
- ✅ **Custom Callback URLs** - Customize success/failure URLs
- ✅ **Multiple Products** - Support for multiple products in one transaction
- ✅ **Checkout Integration** - AJAX/JSON checkout mode support

## 📋 Table of Contents

- [Installation](#installation)
  - [Requirements](#requirements)
  - [Install via Composer](#install-via-composer)
  - [Publish Configuration](#publish-configuration)
  - [Setup Environment](#setup-environment)
  - [Create Routes](#create-routes)
  - [CSRF Exception](#csrf-exception)
  - [Clear Cache](#clear-cache)
- [Usage](#usage)
  - [Basic Payment](#basic-payment)
  - [Payment with Customer Details](#payment-with-customer-details)
  - [Payment with Shipping](#payment-with-shipping)
  - [Multiple Products](#multiple-products)
  - [Validate Payment](#validate-payment)
  - [Payment with Callback Methods](#payment-with-callback-methods)
  - [Refund Process](#refund-process)
  - [Transaction Query](#transaction-query)
  - [IPN Handling](#ipn-handling)
- [Available Methods](#available-methods)
  - [Required Methods](#required-methods)
  - [Optional Methods](#optional-methods)
  - [Response Methods](#response-methods)
- [Advanced Usage](#advanced-usage)
  - [Checkout Integration](#checkout-integration)
  - [Events](#events)
  - [Error Handling](#error-handling)
  - [Custom Callback URLs](#custom-callback-urls)
  - [Custom Currency](#custom-currency)
  - [EMI Payment](#emi-payment)
  - [Card BIN Restriction](#card-bin-restriction)
  - [Airline Ticket Profile](#airline-ticket-profile)
  - [Travel Vertical Profile](#travel-vertical-profile)
  - [Telecom Vertical Profile](#telecom-vertical-profile)
  - [Set Extras](#set-extras)
- [Security](#security)
- [Testing](#testing)
- [Troubleshooting](#troubleshooting)
  - [Common Issues](#common-issues)
  - [Debugging](#debugging)
- [Changelog](#changelog)
- [License](#license)

---

## Installation

### Requirements

- PHP 7.4 or higher
- Laravel 5.6 or higher
- SSLCommerz Merchant Account (Sandbox or Live)

### Install via Composer

```bash
composer require syedmahamudul/sslcommerz-laravel
```

## Publish Configuration

After installing the package, publish the configuration file.

### Option 1: Automatic Installation (Recommended)

Run the installer command:

```bash
php artisan sslcommerz:install
```

This command will:

- Publish the configuration file
- Create the required configuration
- Display the next setup instructions

---

### Option 2: Manual Configuration

If you don't want to use the automatic installer, you can publish the configuration file manually.

Run the following command:

```bash
php artisan vendor:publish --tag=sslcommerz-config
```

After running the command, Laravel will publish the package configuration file to your application.

You should see output similar to:

```text
INFO  Publishing [sslcommerz-config] assets.

Copied File:
config/sslcommerz.php
```

The published configuration file will be located at:

```text
config/sslcommerz.php
```

You can now customize the package settings and configure your SSLCommerz credentials using your `.env` file.

> **Note:** After publishing the configuration file, clear Laravel's configuration cache to ensure the new settings are loaded.

```bash
php artisan config:clear
php artisan cache:clear
php artisan optimize:clear
```

### Verify the Configuration

After publishing, ensure the configuration file exists:

```text
config/
└── sslcommerz.php
```

### Setup Environment

Update your .env file with SSLCommerz credentials:

### Sandbox/Test Mode:

Update your `.env` file with your sandbox credentials:

```env
SSLC_SANDBOX=true
SSLC_STORE_ID=your_sandbox_store_id
SSLC_STORE_PASSWORD=your_sandbox_store_password
SSLC_CURRENCY=BDT
```

### Live/Production Mode:`

Update your `.env` file with your live credentials:

```env
SSLC_SANDBOX=false
SSLC_STORE_ID=your_live_store_id
SSLC_STORE_PASSWORD=your_live_store_password
SSLC_CURRENCY=BDT
```

### CSRF Exception

SSLCommerz callbacks are sent from the payment gateway, so they must be excluded from CSRF verification.



#### Laravel 13+

Open `bootstrap/app.php` and exclude the callback routes using the `validateCsrfTokens` middleware configuration:

```php
->withMiddleware(function (Middleware $middleware): void {
    $middleware->preventRequestForgery(except: [
              'sslcommerz/*',
      ]);
})
```


#### Laravel 11 and 12

Open `bootstrap/app.php` and exclude the callback routes using the `validateCsrfTokens` middleware configuration:

```php
->withMiddleware(function (Middleware $middleware): void {
    $middleware->validateCsrfTokens(except: [
        'sslcommerz/*',
    ]);
})
```
#### Laravel 10 and Earlier

Open `app/Http/Middleware/VerifyCsrfToken.php` and add the following routes to the `$except` array:

```php
protected $except = [
    'sslcommerz/*',
];
```
---




### Important View File

You must create a view file for the folder payment and view file name form.blade.php, failed.blade.php, success.blade.php,  Or use your custom view file name    



### Create Routes

Create routes for SSLCommerz callbacks in routes/web.php:

```php

use App\Http\Controllers\SslcommerzPaymentController;


Route::prefix('sslcommerz')->group(function () {
    Route::get('/form', [SslcommerzPaymentController::class, 'showPaymentForm'])->name('payment.form'); // for form
    Route::post('/payment/process', [SslcommerzPaymentController::class, 'processPayment'])->name('sslcommerz.payment.process');
    Route::post('success', [SslcommerzPaymentController::class, 'success'])->name('sslcommerz.success');
    Route::post('failed', [SslcommerzPaymentController::class, 'failed'])->name('sslcommerz.failed');
    Route::post('cancel', [SslcommerzPaymentController::class, 'cancel'])->name('sslcommerz.cancel');
    Route::post('ipn', [SslcommerzPaymentController::class, 'ipn'])->name('sslcommerz.ipn');
});


```


### Create Migration Product Table

```bash
php artisan make:model Product -m
```

```php
<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable();
            $table->string('slug')->nullable();
            $table->string('description')->nullable();
            $table->string('sku')->nullable();
            $table->string('image')->nullable();
            $table->text('price')->nullable();
            $table->timestamps();
        });
    }   

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};


```




### Create Migration Order Table

```bash
php artisan make:model Order -m
```

```php
<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->foreignId('product_id')->constrained()->cascadeOnDelete();
            $table->string('transaction_id')->unique()->nullable();
            $table->string('validation_id')->unique()->nullable();
            $table->string('customer_name')->nullable();
            $table->string('customer_email')->nullable();
            $table->string('customer_phone')->nullable();
            $table->text('customer_address')->nullable();
            $table->string('customer_city')->nullable();
            $table->string('customer_country')->nullable();
            $table->string('customer_postcode')->nullable();
            $table->string('product_name')->nullable();
            $table->integer('quantity')->nullable();
            $table->decimal('total_amount', 10, 2)->nullable();
            $table->string('store_id')->nullable();
            $table->string('verify_sign_sha2')->nullable();
            $table->string('bank_transaction_id')->nullable();
            $table->string('card_type')->nullable();
            $table->string('card_brand')->nullable();
            $table->string('card_issuer')->nullable();
            $table->string('card_issuer_country')->nullable();
            $table->string('currency')->nullable();
            $table->string('store_amount')->nullable();
            $table->string('verify_sign')->nullable();
            $table->string('payment_date')->nullable();
            $table->string('tran_date')->nullable();
            $table->string('cart_status')->nullable();
            $table->enum('status', [
                'pending',
                'completed',
                'failed',
                'cancelled',
                'refunded'
            ])->default('pending')->nullable();

            $table->timestamps();

            $table->index('transaction_id');
            $table->index('status');
        });
    }

    public function down()
    {
        Schema::dropIfExists('orders');
    }
};


```
### Create Migration Order Item Table


```bash
php artisan make:model OrderItem -m
```

```php
<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('order_items', function (Blueprint $table) {
            $table->id();
            $table->foreignId('order_id')->constrained()->onDelete('cascade');
            $table->foreignId('product_id')->nullable()->constrained()->onDelete('set null');
            $table->string('product_name');
            $table->string('product_sku')->nullable();
            $table->string('product_image')->nullable();
            $table->decimal('unit_price', 10, 2);
            $table->integer('quantity');
            $table->decimal('total_price', 10, 2);
            $table->decimal('discount', 10, 2)->default(0);
            $table->decimal('tax', 10, 2)->default(0);
            $table->json('attributes')->nullable();
            $table->text('notes')->nullable();
            
            $table->timestamps();
            
            // Indexes
            $table->index('order_id');
            $table->index('product_id');
        });
    }

    public function down()
    {
        Schema::dropIfExists('order_items');
    }
};




```




### Create Controller

Create a controller to handle SSLCommerz payment requests and callback responses.

```php
<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Syedmahamudul\Sslcommerz\Facades\Sslcommerz;

class SslcommerzPaymentController extends Controller
{


    public function showPaymentForm()
    {
        $products = Product::all(); // Fetch all products from the database
        return view('payment.form', compact('products'));
    }

    public function processPayment(Request $request)
    {
        $request->validate([
            'product_id' => 'required|numeric',
            'quantity' => 'required|numeric|min:1',
            'customer_name' => 'required|string|max:255',
            'customer_email' => 'required|email|max:255',
            'customer_phone' => 'required|string|max:20',
            'customer_address' => 'required|string|max:500',
            'customer_city' => 'required|string|max:100',
            'customer_postcode' => 'nullable|string|max:20'
        ]);

        $productId = $request->product_id;
        $quantity = $request->quantity;

        $price = $this->getProductPrice($productId);
        $productName = $this->getProductName($productId);

        $totalAmount = $price * $quantity;
        $transactionId = 'SSL' . time() . '_' . uniqid();

        try {

            // Create Order
            $order = new Order();
            $order->transaction_id = $transactionId;
            $order->product_id = $productId;
            $order->product_name = $productName;
            $order->quantity = $quantity;
            $order->total_amount = $totalAmount;

            $order->customer_name = $request->customer_name; 
            $order->customer_email = $request->customer_email;
            $order->customer_phone = $request->customer_phone;
            $order->customer_address = $request->customer_address;
            $order->customer_city = $request->customer_city;
            $order->customer_country = $request->customer_country;
            $order->customer_postcode = $request->customer_postcode ?? '1000';

            $order->status = 'pending';

            $order->save();

            // Create Order Items (can be multiple)
            $orderItems = [];

            // If you have multiple items from request
            if ($request->has('products') && is_array($request->products)) {
                foreach ($request->products as $item) {
                    $orderItem = new OrderItem();
                    $orderItem->order_id = $order->id;
                    $orderItem->product_id = $item['product_id'] ?? null;
                    $orderItem->product_sku = $item['product_sku'] ?? null;
                    $orderItem->unit_price = $item['unit_price'] ?? 0;
                    $orderItem->quantity = $item['quantity'] ?? 1;
                    $orderItem->total_price = ($item['unit_price'] ?? 0) * ($item['quantity'] ?? 1);
                    $orderItem->discount = $item['discount'] ?? 0;
                    $orderItem->tax = $item['tax'] ?? 0;
                    $orderItem->attributes = $item['attributes'] ?? null;
                    $orderItem->notes = $item['notes'] ?? null;
                    $orderItem->save();
                    $orderItems[] = $orderItem;
                }
            } else {
                // Single item (fallback for backward compatibility)
                $orderItem = new OrderItem();
                $orderItem->order_id = $order->id;
                $orderItem->product_id = $productId;
                $orderItem->product_name = $productName;
                $orderItem->product_sku = null;
                $orderItem->product_image = null;
                $orderItem->unit_price = $price;
                $orderItem->quantity = $quantity;
                $orderItem->total_price = $totalAmount;
                $orderItem->discount = 0;
                $orderItem->tax = 0;
                $orderItem->attributes = null;
                $orderItem->notes = null;
                $orderItem->save();
                $orderItems[] = $orderItem;
            }

            Log::info('Order created with pending status', [  //you will remove this in production
                'order_id' => $order->id,
                'transaction_id' => $transactionId,
                'customer_name' => $request->customer_name,
                'items_count' => count($orderItems),
            ]);

            // Prepare SSLCommerz products
            $sslProducts = [];

            if ($request->has('items') && is_array($request->items)) {
                // Multiple products
                foreach ($request->items as $item) {
                    $sslProducts[] = [
                        'name' => $item['product_name'] ?? 'Product',
                        'amount' => ($item['unit_price'] ?? 0) * ($item['quantity'] ?? 1),
                        'quantity' => $item['quantity'] ?? 1,
                    ];
                }
            } else {
                // Single product
                $sslProducts[] = [
                    'name' => $productName,
                    'amount' => $totalAmount,
                    'quantity' => $quantity,
                ];
            }

            $sslcommerz = Sslcommerz::init([
                'total_amount' => $totalAmount,
                'product_name' => count($sslProducts) > 1 ? 'Multiple Products' : $sslProducts[0]['name'],
                'product_category' => 'General',
                'tran_id' => $transactionId,
            ])
                ->setCustomer([
                    'name' => $request->customer_name,
                    'email' => $request->customer_email,
                    'phone' => $request->customer_phone,
                    'address' => $request->customer_address,
                    'city' => $request->customer_city,
                    'country' => $request->customer_country,
                    'postcode' => $request->customer_postcode ?? '1000',
                ])
                ->setShipping([
                    'method' => 'NO',
                    'name' => $request->customer_name,
                    'address' => $request->customer_address,
                    'city' => $request->customer_city,
                    'country' => $request->customer_country,
                    'postcode' => $request->customer_postcode ?? '1000',
                ]);

            // Add all products to SSLCommerz
            foreach ($sslProducts as $product) {
                $sslcommerz->addProduct($product);
            }

            $response = $sslcommerz->execute();

            if ($response->success()) {
                return redirect($response->gatewayPageURL());
            }

            $order->status = 'failed';
            $order->save();

            return back()->with('error', 'Payment initiation failed: ' . $response->error());

        } catch (\Exception $e) {

            Log::error('SSLCommerz Payment Exception', [
                'message' => $e->getMessage(),
                'trace' => $e->getTraceAsString(),
            ]);

            if (isset($order)) {
                $order->status = 'failed';
                $order->save();
            }

            return back()->with('error', 'Something went wrong: ' . $e->getMessage());
        }
    }

    public function success(Request $request)
    {
        // Get all data from SSLCommerz
        $transactionId = $request->input('tran_id');
        $amount = $request->input('amount');
        $bankTransactionId = $request->input('bank_tran_id');
        $validationId = $request->input('val_id');
        $cardType = $request->input('card_type');
        $cardBrand = $request->input('card_brand');
        $cardIssuer = $request->input('card_issuer');
        $cardIssuerCountry = $request->input('card_issuer_country');
        $tranDate = $request->input('tran_date');
        $currency = $request->input('currency');
        $storeAmount = $request->input('store_amount');
        $verifySign = $request->input('verify_sign');
        $storeId = $request->input('store_id');
        $status = $request->input('status');
        $verifySignSha2 = $request->input('verify_sign_sha2');

        // Log::info('SSLCommerz Success Callback', [  //you will remove this in production
        //     'transaction_id' => $transactionId,
        //     'amount' => $amount,
        //     'card_type' => $cardType,
        //     'status' => $status
        // ]);

        // --- FIND THE ORDER BY TRANSACTION ID ---
        $order = DB::table('orders')
            ->where('transaction_id', $transactionId)
            ->first();

        if (!$order) {
            Log::error('Order not found', ['transaction_id' => $transactionId]);
            return redirect()->route('sslcommerz.failed')->with('error', 'Order not found!');
        }

        // Log::info('Order found', [   //you will remove this in production
        //     'order_id' => $order->id,
        //     'current_status' => $order->status,
        //     'customer_name' => $order->customer_name
        // ]);

        // --- VALIDATE PAYMENT WITH SSLCOMMERZ ---
        if (Sslcommerz::validate($request->all(), $transactionId, $amount)) {
               
            try {
                // --- UPDATE ORDER WITH PAYMENT DETAILS ---
                DB::table('orders')
                    ->where('transaction_id', $transactionId)
                    ->update([
                        'status' => 'completed',
                        'bank_transaction_id' => $bankTransactionId,
                        'validation_id' => $validationId,
                        'card_type' => $cardType,
                        'card_brand' => $cardBrand,
                        'card_issuer' => $cardIssuer,
                        'card_issuer_country' => $cardIssuerCountry,
                        'currency' => $currency,
                        'store_amount' => $storeAmount,
                        'store_id' => $storeId,
                        'verify_sign_sha2' => $verifySignSha2,
                        'verify_sign' => $verifySign,
                        'cart_status' => $status,
                        'payment_date' => now(),
                        'tran_date' => $tranDate,
                        'updated_at' => now(),
                    ]);

                Log::info('Order updated to completed', [  //you will remove this in production
                    'order_id' => $order->id,
                    'transaction_id' => $transactionId,
                    'customer_name' => $order->customer_name
                ]);

                // --- GET UPDATED ORDER DATA ---
                $updatedOrder = DB::table('orders')
                    ->where('transaction_id', $transactionId)
                    ->first();

                // --- RETURN SUCCESS VIEW WITH ORDER DATA ---
                return view('payment.success', [
                    'order' => $updatedOrder,
                    'transactionId' => $transactionId,
                    'bankTransactionId' => $bankTransactionId,
                    'amount' => $amount,
                    'cardType' => $cardType,
                    'cardBrand' => $cardBrand,
                    'paymentDate' => now()->toDateTimeString(),
                ]);

            } catch (\Exception $e) {
                Log::error('Failed to update order', [
                    'error' => $e->getMessage(),
                    'transaction_id' => $transactionId,
                    'trace' => $e->getTraceAsString()
                ]);

                return redirect()->route('sslcommerz.failed')->with('error', 'Failed to update order!');
            }
        }

        // If validation fails, update order status to failed
        DB::table('orders')
            ->where('transaction_id', $transactionId)
            ->update([
                'status' => 'failed',
                'updated_at' => now(),
            ]);

        Log::warning('Payment validation failed', [
            'transaction_id' => $transactionId
        ]);

        return redirect()->route('sslcommerz.failed')->with('error', 'Payment validation failed!');
    }

    public function failed(Request $request)
    {
        $transactionId = $request->input('tran_id');

        if ($transactionId) {
            // Update order status to failed
            DB::table('orders')
                ->where('transaction_id', $transactionId)
                ->update([
                    'status' => 'failed',
                    'updated_at' => now(),
                ]);

            Log::info('Order marked as failed', ['transaction_id' => $transactionId]);  //you will remove this in production
        }

        return view('payment.failed')->with('error', 'Payment failed! Please try again.');
    }

    public function cancel(Request $request)
    {
        $transactionId = $request->input('tran_id');

        if ($transactionId) {
            // Update order status to cancelled
            DB::table('orders')
                ->where('transaction_id', $transactionId)
                ->update([
                    'status' => 'cancelled',
                    'updated_at' => now(),
                ]);

            Log::info('Order cancelled', ['transaction_id' => $transactionId]);  //you will remove this in production
        }

        return redirect()->route('payment.form')->with('error', 'Payment cancelled!');
    }

    public function ipn(Request $request)
    {
        $transactionId = $request->input('tran_id');
        $status = $request->input('status');

        Log::info('IPN Received', [  //you will remove this in production
            'transaction_id' => $transactionId,
            'status' => $status,
            'all_data' => $request->all()
        ]);

        if ($transactionId) {
            $updateData = ['updated_at' => now()];

            if ($status === 'VALID') {
                $updateData['status'] = 'completed';
                $updateData['bank_transaction_id'] = $request->input('bank_tran_id');
                $updateData['payment_date'] = now();
            } elseif ($status === 'FAILED') {
                $updateData['status'] = 'failed';
            }

            DB::table('orders')
                ->where('transaction_id', $transactionId)
                ->update($updateData);

            Log::info('Order updated via IPN', [
                'transaction_id' => $transactionId,
                'status' => $status
            ]);
        }

        return response()->json(['status' => 'success']);
    }

    // Helper methods
    private function getProductPrice($productId)
    {
        $prices = [
            1 => 100,
            2 => 200,
            3 => 300,
        ];
        return $prices[$productId] ?? 100;
    }

    private function getProductName($productId)
    {
        $names = [
            1 => 'Product 1',
            2 => 'Product 2',
            3 => 'Product 3',
        ];
        return $names[$productId] ?? 'Product';
    }
}


```

### Create Controller if You want after success than order data will save in database .

Create a controller to handle SSLCommerz payment requests and callback responses.



### Create a Migration

Create the required database migration(s) for your application, such as the `orders` and `order_items` tables, to store order information after a successful payment.

### Store the Payment Session

Create a `PaymentSession` model and use Eloquent to temporarily store the order data before redirecting the customer to the SSLCommerz payment gateway.


```bash
php artisan make:model PaymentSession -m
```

```php

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('payment_sessions', function (Blueprint $table) {
            $table->id();
            $table->string('transaction_id')->unique()->index();
            $table->text('data');
            $table->timestamp('expires_at');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('payment_sessions');
    }
};



```

> **Note:** The order data is stored temporarily and should only be persisted to the `orders` table after the payment is completed successfully.


### Create a Controller

Create a controller to handle class SslcommerzPaymentController extends Controller
 payment requests and callback responses. If you want to save the order data only after a successful payment, implement the order creation logic inside the success callback.


```php
<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;
use Syedmahamudul\Sslcommerz\Facades\Sslcommerz;

class SslcommerzPaymentController extends Controller
{


    public function showPaymentForm()
    {
        $products = Product::all(); // Fetch all products from the database
        return view('payment.form', compact('products'));
    }
    public function processPayment(Request $request)
    {
        $request->validate([
            'product_id' => 'required|numeric',
            'quantity' => 'required|numeric|min:1',
            'customer_name' => 'required|string|max:255',
            'customer_email' => 'required|email|max:255',
            'customer_phone' => 'required|string|max:20',
            'customer_address' => 'required|string|max:500',
            'customer_city' => 'required|string|max:100',
            'customer_country' => 'required|string|max:100',
            'customer_postcode' => 'nullable|string|max:20',
        ]);

        $productId = $request->input('product_id');
        $quantity = $request->input('quantity');
        $price = $this->getProductPrice($productId);
        $totalAmount = $price * $quantity;
        $transactionId = 'SSL' . time() . '_' . uniqid();

        $orderData = [
            'transaction_id' => $transactionId,
            'product_id' => $productId,
            'product_name' => $this->getProductName($productId),
            'quantity' => $quantity,
            'total_amount' => $totalAmount,
            'customer_name' => $request->input('customer_name'),
            'customer_email' => $request->input('customer_email'),
            'customer_phone' => $request->input('customer_phone'),
            'customer_address' => $request->input('customer_address'),
            'customer_city' => $request->input('customer_city'),
            'customer_country' => $request->input('customer_country'),
            'customer_postcode' => $request->input('customer_postcode') ?? '1000',
        ];

        // SAVE TO DATABASE - NO SESSION 
        DB::table('payment_sessions')->insert([
            'transaction_id' => $transactionId,
            'data' => json_encode($orderData),
            'expires_at' => now()->addMinutes(30),
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        // Store transaction ID in URL for later use
        // We'll pass it as a query parameter if needed
        $successUrl = route('sslcommerz.success') . '?tran_id=' . $transactionId;

        try {
            $response = Sslcommerz::init([
                'total_amount' => $totalAmount,
                'product_name' => $this->getProductName($productId),
                'product_category' => 'General',
                'tran_id' => $transactionId,
            ])
                ->setCustomer([
                    'name' => $request->input('customer_name'),
                    'email' => $request->input('customer_email'),
                    'phone' => $request->input('customer_phone'),
                    'address' => $request->input('customer_address'),
                    'city' => $request->input('customer_city'),
                    'country' => $request->input('customer_country'),
                    'postcode' => $request->input('customer_postcode') ?? '1000',
                ])
                ->setShipping([
                    'method' => 'NO',
                    'name' => $request->input('customer_name'),
                    'address' => $request->input('customer_address'),
                    'city' => $request->input('customer_city'),
                    'country' => $request->input('customer_country'),
                    'postcode' => $request->input('customer_postcode') ?? '1000',
                ])
                ->addProduct([
                    'name' => $this->getProductName($productId),
                    'amount' => $totalAmount,
                    'quantity' => $quantity,
                ])
                ->execute();

            if ($response->success()) {
                return redirect($response->gatewayPageURL());
            }

            // Clean up on failure
            DB::table('payment_sessions')->where('transaction_id', $transactionId)->delete();
            return back()->with('error', 'Payment initiation failed: ' . $response->error());

        } catch (\Exception $e) {
            Log::error('SSLCommerz Payment Exception', [
                'message' => $e->getMessage(),
            ]);

            DB::table('payment_sessions')->where('transaction_id', $transactionId)->delete();
            return back()->with('error', 'Something went wrong: ' . $e->getMessage());
        }
    }
    public function success(Request $request)
    {
        // Get all data from SSLCommerz
        $transactionId = $request->input('tran_id');
        $amount = $request->input('amount');
        $bankTransactionId = $request->input('bank_tran_id');
        $validationId = $request->input('val_id');
        $cardType = $request->input('card_type');
        $cardBrand = $request->input('card_brand');
        $cardIssuer = $request->input('card_issuer');
        $cardIssuerCountry = $request->input('card_issuer_country');
        $tranDate = $request->input('tran_date');
        $currency = $request->input('currency');
        $storeAmount = $request->input('store_amount');
        $verifySign = $request->input('verify_sign');
        $productId = $request->input('product_id');
        $productName = $this->getProductName($productId);
        $verifySign = $request->input('verify_sign');
        $storeId = $request->input('store_id');
        $status = $request->input('status');
        $verifySignSha2 = $request->input('verify_sign_sha2');


        Log::info('SSLCommerz Success Callback', [
            'transaction_id' => $transactionId,
            'amount' => $amount,
            'card_type' => $cardType
        ]);

        // --- GET ORDER DATA FROM DATABASE (NO SESSION) ---
        $tempData = DB::table('payment_sessions')
            ->where('transaction_id', $transactionId)
            ->where('expires_at', '>', now())
            ->first();

        if (!$tempData) {
            Log::error('Payment session not found in database', [
                'transaction_id' => $transactionId
            ]);
            return redirect()->route('sslcommerz.failed')->with('error', 'Order data not found!');
        }

        $orderData = json_decode($tempData->data, true);

        DB::table('payment_sessions')->where('transaction_id', $transactionId)->delete();

        Log::info('Order data retrieved from database', [
            'order_data' => $orderData
        ]);

        // Validate payment with SSLCommerz
        if (Sslcommerz::validate($request->all(), $transactionId, $amount)) {

            try {
                $order = new Order();
                $order->transaction_id = $transactionId;
                $order->product_id = $orderData['product_id'] ?? null;
                $order->product_name = $orderData['product_name'] ?? null;
                $order->quantity = $orderData['quantity'] ?? 1;
                $order->total_amount = $orderData['total_amount'] ?? 0;
                $order->customer_name = $orderData['customer_name'] ?? null;
                $order->customer_email = $orderData['customer_email'] ?? null;
                $order->customer_phone = $orderData['customer_phone'] ?? null;
                $order->customer_address = $orderData['customer_address'] ?? null;
                $order->customer_city = $orderData['customer_city'] ?? null;
                $order->customer_country = $orderData['customer_country'] ?? null;
                $order->customer_postcode = $orderData['customer_postcode'] ?? null;
                $order->bank_transaction_id = $bankTransactionId;
                $order->validation_id = $validationId;
                $order->card_type = $cardType;
                $order->card_brand = $cardBrand;
                $order->card_issuer = $cardIssuer;
                $order->card_issuer_country = $cardIssuerCountry;
                $order->currency = $currency;
                $order->store_id = $storeId;
                $order->store_amount = $storeAmount;
                $order->verify_sign_sha2 = $verifySignSha2;
                $order->verify_sign = $verifySign;
                $order->cart_status = $status;
                $order->payment_date = now();
                $order->tran_date = $tranDate;
                $order->updated_at = now();
                $order->save();
                // Create Order Items (can be multiple)
                $orderItems = [];

                // If you have multiple items from request
                if ($request->has('products') && is_array($request->products)) {
                    foreach ($request->products as $item) {
                        $orderItem = new OrderItem();
                        $orderItem->order_id = $order->id;
                        $orderItem->product_id = $item['product_id'] ?? null;
                        $orderItem->product_name = $item['product_name'] ?? '';
                        $orderItem->product_sku = $item['product_sku'] ?? null;
                        $orderItem->product_image = $item['product_image'] ?? null;
                        $orderItem->unit_price = $item['unit_price'] ?? 0;
                        $orderItem->quantity = $item['quantity'] ?? 1;
                        $orderItem->total_price = ($item['unit_price'] ?? 0) * ($item['quantity'] ?? 1);
                        $orderItem->discount = $item['discount'] ?? 0;
                        $orderItem->tax = $item['tax'] ?? 0;
                        $orderItem->attributes = $item['attributes'] ?? null;
                        $orderItem->notes = $item['notes'] ?? null;
                        $orderItem->save();
                        $orderItems[] = $orderItem;
                    }
                } else {
                    // Single item (fallback for backward compatibility)
                    $orderItem = new OrderItem();
                    $orderItem->order_id = $order->id;
                    $orderItem->product_id = $productId;
                    $orderItem->product_name = $productName;
                    $orderItem->product_sku = null;
                    $orderItem->product_image = null;
                    $orderItem->unit_price = $orderData['total_amount'] ?? 0;
                    $orderItem->quantity = $orderData['quantity'] ?? 1;
                    $orderItem->total_price = ($orderItem->unit_price ?? 0) * ($orderData['quantity'] ?? 1);
                    $orderItem->discount = 0;
                    $orderItem->tax = 0;
                    $orderItem->attributes = null;
                    $orderItem->notes = null;
                    $orderItem->save();
                    $orderItems[] = $orderItem;
                }

                // Return success view with data (not using session)
                return view('payment.success', [
                    'orderId' => $order->id,
                    'transactionId' => $transactionId,
                    'bankTransactionId' => $bankTransactionId,
                    'amount' => $amount,
                    'cardType' => $cardType,
                    'cardBrand' => $cardBrand,
                    'paymentDate' => now()->toDateTimeString(),
                    'customerName' => $orderData['customer_name'],
                    'productName' => $orderData['product_name'],
                    'quantity' => $orderData['quantity'],
                    'totalAmount' => $orderData['total_amount']
                ]);

            } catch (\Exception $e) {
                Log::error('Failed to save order', [
                    'error' => $e->getMessage(),
                    'transaction_id' => $transactionId,
                    'trace' => $e->getTraceAsString()
                ]);
                return redirect()->route('sslcommerz.failed')->with('error', 'Failed to save order data!');
            }
        }

        Log::warning('Payment validation failed', [
            'transaction_id' => $transactionId
        ]);

        return redirect()->route('sslcommerz.failed')->with('error', 'Payment validation failed!');
    }

    public function paymentSuccess()
    {
        $paymentData = Session::get('payment_success');
        $orderData = Session::get('order_data');

        if (empty($paymentData) || empty($orderData)) {
            return redirect()->route('home')->with('error', 'No payment data found!');
        }

        return view('payment.success', compact('paymentData', 'orderData'));
    }

    public function failed(Request $request)
    {
        $transactionId = $request->input('tran_id');

        if ($transactionId) {
            // Update order status to failed
            DB::table('orders')
                ->where('transaction_id', $transactionId)
                ->update([
                    'status' => 'failed',
                    'updated_at' => now(),
                ]);

            Log::info('Order marked as failed', ['transaction_id' => $transactionId]);
        }

        return view('payment.failed')->with('error', 'Payment failed! Please try again.');
    }

    public function cancel(Request $request)
    {
        $transactionId = $request->input('tran_id');

        if ($transactionId) {
            // Update order status to cancelled
            DB::table('orders')
                ->where('transaction_id', $transactionId)
                ->update([
                    'status' => 'cancelled',
                    'updated_at' => now(),
                ]);

            Log::info('Order cancelled', ['transaction_id' => $transactionId]);
        }

        return redirect()->route('payment.form')->with('error', 'Payment cancelled!');
    }

    public function ipn(Request $request)
    {
        $transactionId = $request->input('tran_id');
        $status = $request->input('status');

        Log::info('IPN Received', [
            'transaction_id' => $transactionId,
            'status' => $status,
            'all_data' => $request->all()
        ]);

        if ($transactionId) {
            $updateData = ['updated_at' => now()];

            if ($status === 'VALID') {
                $updateData['status'] = 'completed';
                $updateData['bank_transaction_id'] = $request->input('bank_tran_id');
                $updateData['payment_date'] = now();
            } elseif ($status === 'FAILED') {
                $updateData['status'] = 'failed';
            }

            DB::table('orders')
                ->where('transaction_id', $transactionId)
                ->update($updateData);

            Log::info('Order updated via IPN', [
                'transaction_id' => $transactionId,
                'status' => $status
            ]);
        }

        return response()->json(['status' => 'success']);
    }


```
## Create the Payment Form

Create a payment form where customers can enter their order and billing information before initiating the payment.

Create a Blade view at:

```text
resources/views/payment/form.blade.php
```


```html
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>SSLCommerz Payment Demo</title>

    <link
      href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css"
      rel="stylesheet"
    />
  </head>

  <body class="bg-light">
    <div class="container py-5">
      <div class="row justify-content-center">
        <div class="col-md-8">
          <div class="card shadow-sm">
            <div class="card-header text-center">
              <h3>SSLCommerz Payment Demo</h3>
            </div>
            <div class="card-body">
              @if(session('success'))
              <div class="alert alert-success">{{ session('success') }}</div>
              @endif @if(session('error'))
              <div class="alert alert-danger">{{ session('error') }}</div>
              @endif
              <form
                action="{{ route('sslcommerz.payment.process') }}"
                method="POST"
              >
                @csrf
                <div class="mb-3">
                  <label class="form-label">Product</label>
                  <select name="product_id" class="form-select" required>
                    <option value="">Select Product</option>

                    @foreach($products as $product)
                    <option value="{{ $product['id'] }}">
                      {{ $product['name'] }} - {{ $product['price'] }} BDT
                    </option>
                    @endforeach
                  </select>
                </div>
                <div class="mb-3">
                  <label class="form-label">Quantity</label>
                  <input
                    type="number"
                    class="form-control"
                    name="quantity"
                    value="1"
                    min="1"
                    required
                  />
                </div>
                <hr />
                <div class="row">
                  <div class="col-md-6 mb-3">
                    <label class="form-label">Customer Name</label>
                    <input
                      type="text"
                      class="form-control"
                      name="customer_name"
                      required
                    />
                  </div>

                  <div class="col-md-6 mb-3">
                    <label class="form-label">Email</label>
                    <input
                      type="email"
                      class="form-control"
                      name="customer_email"
                      required
                    />
                  </div>
                </div>

                <div class="mb-3">
                  <label class="form-label">Phone</label>
                  <input
                    type="text"
                    class="form-control"
                    name="customer_phone"
                    required
                  />
                </div>

                <div class="mb-3">
                  <label class="form-label">Address</label>
                  <textarea
                    class="form-control"
                    name="customer_address"
                    rows="2"
                    required
                  ></textarea>
                </div>

                <div class="row">
                  <div class="col-md-6 mb-3">
                    <label class="form-label">City</label>
                    <input
                      type="text"
                      class="form-control"
                      name="customer_city"
                      required
                    />
                  </div>

                  <div class="col-md-6 mb-3">
                    <label class="form-label">Postcode</label>
                    <input
                      type="text"
                      class="form-control"
                      name="customer_postcode"
                    />
                  </div>
                </div>

                <div class="mb-4">
                  <label class="form-label">Country</label>
                  <input
                    type="text"
                    class="form-control"
                    name="customer_country"
                    value="Bangladesh"
                    required
                  />
                </div>

                <button type="submit" class="btn btn-primary w-100">
                  Pay Now
                </button>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js"></script>
  </body>
</html>
```

### Clear Cache

After configuration:

```bash
php artisan config:clear
php artisan cache:clear
php artisan optimize:clear
```

## Usage

### Basic Payment

Create a payment initiation method in your controller:

```php
use Syedmahamudul\Sslcommerz\Facades\Sslcommerz;

public function initiatePayment()
{
    $response = Sslcommerz::init([
        'total_amount' => 100,
        'product_name' => 'Demo Product',
    ])
    ->execute();

    if ($response->success()) {
        return redirect($response->gatewayPageURL());
    }

    return back()->with('error', $response->error());
}
```

Payment with Customer Details

```php

$response = Sslcommerz::init([
    'total_amount' => 100,
    'product_name' => 'Demo Product',
])
->setCustomer([
    'name' => 'John Doe',
    'email' => 'john@example.com',
    'phone' => '01700000000',
    'address' => 'Dhaka, Bangladesh',
    'city' => 'Dhaka',
    'country' => 'Bangladesh',
])
->execute();
```

Payment with Shipping

```php

$response = Sslcommerz::init([
    'total_amount' => 100, // Total amount in BDT
    'product_name' => 'Demo Product', // it will be dynamic
])
->setCustomer([
    'name' => 'John Doe',
    'email' => 'john@example.com',
    'phone' => '01700000000',
])
->setShipping([
    'method' => 'NO',
    'name' => 'John Doe',
    'address' => 'Dhaka, Bangladesh',
    'city' => 'Dhaka',
    'country' => 'Bangladesh',
    'postcode' => '1000',
])
->execute();
```

Multiple Products

```php
$response = Sslcommerz::init([
    'total_amount' => 200,
])
->setCustomer([...])
->addProduct([
    'name' => 'Product 1',
    'amount' => 100,
    'quantity' => 1,
])
->addProduct([
    'name' => 'Product 2',
    'amount' => 100,
    'quantity' => 1,
])
->execute();
```

Validate Payment
In your success callback:

```php

use Syedmahamudul\Sslcommerz\Facades\Sslcommerz;

public function success(Request $request)
{
    $transactionId = $request->input('tran_id');
    $amount = $request->input('amount');

    if (Sslcommerz::validate($request->all(), $transactionId, $amount)) {
        // Payment is valid
        // Update your database
        // Mark order as paid
        $bankID = $request->input('bank_tran_id'); // Keep for refund

        return redirect()->route('home')->with('success', 'Payment successful!');
    }

    return redirect()->route('home')->with('error', 'Payment validation failed!');
}
```

Payment with Callback Methods

```php
public function success(Request $request)
{
    $validate = Sslcommerz::validate($request->all(), $request->input('tran_id'), $request->input('amount'));

    if ($validate) {
        $bankID = $request->input('bank_tran_id'); // Store this for refund

        // Update your database
        // Send confirmation email
        // Redirect to success page
    }
}

public function failure(Request $request)
{
    // Payment failed
    // Update order status
    // Redirect to failure page
}

public function cancel(Request $request)
{
    // Payment cancelled by user
    // Update order status
    // Redirect to cart or home page
}

public function ipn(Request $request)
{
    // Handle IPN (Instant Payment Notification)
    // This is called by SSLCommerz server
    // No response is expected

    $transactionId = $request->input('tran_id');
    $amount = $request->input('amount');

    if (Sslcommerz::validate($request->all(), $transactionId, $amount)) {
        // Process payment in background
        // Update database, send emails, etc.
    }

    return response()->json(['status' => 'SUCCESS']);
}
```

Refund Process

```php

use Syedmahamudul\Sslcommerz\Facades\Sslcommerz;

public function refund($bankID)
{
    $refund = Sslcommerz::refund($bankID, 100, 'Customer request');

    if ($refund['status'] === 'SUCCESS') {
        return back()->with('success', 'Refund processed successfully!');
    }

    return back()->with('error', 'Refund failed!');
}
```

Transaction Query

```php

use Syedmahamudul\Sslcommerz\Facades\Sslcommerz;

public function getTransactionStatus($transactionId)
{
    $transaction = Sslcommerz::query($transactionId);

    if ($transaction['status'] === 'VALID') {
        dd($transaction); // Transaction details
    }

    return back()->with('error', 'Transaction not found!');
}
```

## IPN Handling

```php

use Syedmahamudul\Sslcommerz\Facades\Sslcommerz;

public function ipn(Request $request)
{
    $transactionId = $request->input('tran_id');
    $amount = $request->input('amount');

    if (Sslcommerz::validate($request->all(), $transactionId, $amount)) {
        // Process payment in background
        // Update database, send emails, etc.
    }

    return response()->json(['status' => 'SUCCESS']);
}
```

## Available Methods

## Required Methods

| Method          | Parameters | Description                                | Usage                                                                                   |
| --------------- | ---------- | ------------------------------------------ | --------------------------------------------------------------------------------------- |
| `init()`        | `array`    | Initialize payment with amount and product | `Sslcommerz::init(['total_amount' => 100, 'product_name' => 'Product'])`                |
| `setCustomer()` | `array`    | Set customer information                   | `->setCustomer(['name' => 'John', 'email' => 'john@example.com', 'phone' => '017...'])` |
| `execute()`     | None       | Execute the payment                        | `->execute()`                                                                           |

---

## Optional Methods

| Method          | Parameters              | Description               | Usage                                                                       |
| --------------- | ----------------------- | ------------------------- | --------------------------------------------------------------------------- |
| `setShipping()` | `array`                 | Set shipping details      | `->setShipping(['method' => 'NO', 'name' => 'John', 'address' => 'Dhaka'])` |
| `addProduct()`  | `array`                 | Add multiple products     | `->addProduct(['name' => 'Product', 'amount' => 100, 'quantity' => 1])`     |
| `validate()`    | `array, string, float`  | Validate payment response | `Sslcommerz::validate($request->all(), $transactionId, $amount)`            |
| `refund()`      | `string, float, string` | Process refund            | `Sslcommerz::refund($bankID, $amount, $reason)`                             |
| `query()`       | `string`                | Query transaction status  | `Sslcommerz::query($transactionId)`                                         |

---

## Response Methods

| Method             | Description                     | Usage                         |
| ------------------ | ------------------------------- | ----------------------------- |
| `success()`        | Check if payment was successful | `$response->success()`        |
| `failed()`         | Check if payment failed         | `$response->failed()`         |
| `gatewayPageURL()` | Get SSLCommerz payment page URL | `$response->gatewayPageURL()` |
| `transactionId()`  | Get transaction ID              | `$response->transactionId()`  |
| `validationId()`   | Get validation ID               | `$response->validationId()`   |
| `error()`          | Get error message               | `$response->error()`          |
| `all()`            | Get all response data           | `$response->all()`            |

---

## Advanced Usage

## Checkout Integration

For AJAX/JSON checkout integration:

```php
$response = Sslcommerz::init([
    'total_amount' => 100,
    'product_name' => 'Demo Product',
])
->setCustomer([
    'name' => 'John Doe',
    'email' => 'john@example.com',
    'phone' => '01700000000',
])
->execute();

if ($response->success()) {
    return response()->json([
        'status' => 'success',
        'redirect_url' => $response->gatewayPageURL(),
    ]);
}
```

---

## Events

The package dispatches the following events:

- `PaymentSuccess`
- `PaymentFailed`
- `PaymentCancelled`
- `PaymentIpnReceived`

Register them in `EventServiceProvider`.

```php
protected $listen = [
    \Syedmahamudul\Sslcommerz\Events\PaymentSuccess::class => [
        \App\Listeners\HandleSuccessfulPayment::class,
    ],
];
```

---

## Error Handling

```php
try {
    $response = Sslcommerz::init([
        'total_amount' => 100,
        'product_name' => 'Demo Product',
    ])->execute();

    if ($response->success()) {
        // Handle success
    } else {
        Log::error($response->error());
    }
} catch (\Exception $e) {
    Log::error($e->getMessage());

    return back()->with('error', 'Something went wrong!');
}
```

---

## Custom Callback URLs

```php
$response = Sslcommerz::init([
    'total_amount' => 100,
    'product_name' => 'Demo Product',
    'success_url' => route('custom.success'),
    'fail_url' => route('custom.failure'),
    'cancel_url' => route('custom.cancel'),
    'ipn_url' => route('custom.ipn'),
])
->setCustomer([...])
->execute();
```

---

## Custom Currency

```php
$response = Sslcommerz::init([
    'total_amount' => 100,
    'product_name' => 'Demo Product',
    'currency' => 'USD',
])
->setCustomer([...])
->execute();
```

---

## EMI Payment

```php
$response = Sslcommerz::init([
    'total_amount' => 100,
    'product_name' => 'Demo Product',
    'emi_option' => 1,
    'emi_max_inst_option' => 12,
])
->setCustomer([...])
->execute();
```

---

## Card BIN Restriction

```php
$response = Sslcommerz::init([
    'total_amount' => 100,
    'product_name' => 'Demo Product',
    'multi_card_name' => 'mastercard,visacard,amexcard',
    'allowed_bin' => '371598,371599,376947',
])
->setCustomer([...])
->execute();
```

---

## Airline Ticket Profile

```php
$response = Sslcommerz::init([
    'total_amount' => 100,
    'product_name' => 'Airline Ticket',
    'product_profile' => 'airline-tickets',
])
->setCustomer([...])
->setAirlineTicketProfile([
    'flight_type' => 'bus',
    'hours_till_departure' => 3,
    'pnr' => 1,
    'journey_from_to' => 'DHK-RAJ',
    'third_party_booking' => null,
])
->execute();
```

---

## Travel Vertical Profile

```php
$response = Sslcommerz::init([
    'total_amount' => 100,
    'product_name' => 'Hotel Booking',
    'product_profile' => 'travel-vertical',
])
->setCustomer([...])
->setTravelVerticalProfile([
    'hotel_name' => 'Dalas Hotel',
    'length_of_stay' => 3,
    'check_in_time' => '12:00pm',
    'hotel_city' => 'Rajshahi',
])
->execute();
```

---

## Telecom Vertical Profile

```php
$response = Sslcommerz::init([
    'total_amount' => 100,
    'product_name' => 'Mobile Recharge',
    'product_profile' => 'telecom-vertical',
])
->setCustomer([...])
->setTelecomVerticleProfile([
    'product_type' => 'Flexiload',
    'topup_number' => '01700000000',
    'country_topup' => 'BD',
])
->execute();
```

---

## Set Extras

```php
$response = Sslcommerz::init([
    'total_amount' => 100,
    'product_name' => 'Demo Product',
])
->setCustomer([...])
->setExtras([
    'extra1' => 'Order ID: 12345',
    'extra2' => 'User ID: 1001',
])
->execute();
```

---

## Security

- ✅ Callback URLs are automatically excluded from CSRF verification.
- ✅ IPN requests are validated.
- ✅ Amount and Transaction ID are verified.
- ✅ No sensitive data is stored in logs.
- ✅ Sandbox mode supported.
- ✅ SSL/TLS encryption.
- ✅ Validation against SSLCommerz API.

---

## Testing

Run the following command:

```bash
php artisan sslcommerz:make-payment 100 --product="Test Product"
```

This command initiates a sandbox payment and displays the payment URL.

---

## Troubleshooting

## 1. Could not find a matching version

**Cause**

Package version not tagged.

**Solution**

Use `dev-main` or create a Git tag.

---

## 2. CSRF Token Mismatch

**Cause**

Callback route protected by CSRF.

**Solution**

Add:

```php
'sslcommerz/*'
```

to your CSRF exceptions.

---


## Debugging

Enable logging:

```env
SSLC_LOGGING=true
SSLC_LOG_CHANNEL=daily
SSLC_LOG_LEVEL=debug
```

Logs are stored in:

```text
storage/logs/laravel.log
```

---

## Author

**Syed Mahamudul Hassan**
- GitHub: [syedmahamudul](https://github.com/syedmahamudul)
- Email: syedmahamudhassan@gmail.com


---

## License

This package is open-sourced software licensed under the **MIT License**.

See the **LICENSE** file for more information.

---

## Support

If this package helps you, please consider giving it a ⭐ on GitHub.

---

Made with ❤️ in Bangladesh.
