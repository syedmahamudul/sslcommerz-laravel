<?php

namespace Syedmahamudul\Sslcommerz\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Log;
use Syedmahamudul\Sslcommerz\Facades\Sslcommerz;

class SslcommerzController extends Controller
{
    public function success(Request $request)
    {
        $transactionId = $request->input('tran_id');
        $amount = $request->input('amount');

        if (Sslcommerz::validate($request->all(), $transactionId, $amount)) {
            Log::info('SSLCommerz Payment Success', ['transaction' => $transactionId]);
            return redirect('/')->with('success', 'Payment successful!');
        }

        return redirect('/')->with('error', 'Payment validation failed!');
    }

    public function failure(Request $request)
    {
        Log::info('SSLCommerz Payment Failed', ['request' => $request->all()]);
        return redirect('/')->with('error', 'Payment failed!');
    }

    public function cancel(Request $request)
    {
        Log::info('SSLCommerz Payment Cancelled', ['request' => $request->all()]);
        return redirect('/')->with('info', 'Payment cancelled.');
    }

    public function ipn(Request $request)
    {
        Log::info('SSLCommerz IPN Received', ['request' => $request->all()]);
        return response()->json(['status' => 'SUCCESS']);
    }
}