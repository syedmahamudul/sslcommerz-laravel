<?php

use Illuminate\Support\Facades\Route;
use Syedmahamudul\Sslcommerz\Http\Controllers\SslcommerzController;

Route::group([
    'prefix' => 'sslcommerz',
    'as' => 'sslcommerz.',
    'middleware' => ['web']
], function () {
    Route::post('success', [SslcommerzController::class, 'success'])->name('success');
    Route::post('failure', [SslcommerzController::class, 'failure'])->name('failure');
    Route::post('cancel', [SslcommerzController::class, 'cancel'])->name('cancel');
    Route::post('ipn', [SslcommerzController::class, 'ipn'])->name('ipn');
});