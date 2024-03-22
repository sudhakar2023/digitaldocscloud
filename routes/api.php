<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AwsMarketplaceController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/stripe/confirm', [\App\Http\Controllers\SubscriptionController::class, 'confirmStripePayment']);
Route::post('/aws/resolve', [AwsMarketplaceController::class, 'resolveCustomer']);
Route::post('/aws/entitlement/web-hook', [AwsMarketplaceController::class, 'handleNotification']);