<?php

namespace App\Http\Services\Billing;
use Illuminate\Support\Facades\Crypt;
use Psy\Util\Str;
use Stripe;
use Stripe\Exception\ApiErrorException;

class StripeClient {
    public function __construct() {
        Stripe\Stripe::setApiKey(env('STRIPE_SECRET'));    
    }

    public function createCustomer ($name, $email) {
        return Stripe\Customer::create([
            'name' => $name,
            'email' => $email,
        ]);
    }

    public function listProducts () {
        return Stripe\Product::all();
    }

    public function createProduct ($name, $data = null) {
        //Create Product
        $product = Stripe\Product::create([
            'name' => $name
        ]);

        $price = Stripe\Price::create([
            'currency' => 'usd',
            'product' => $product->id,
            'unit_amount' => $data['price'] * 100,
            'recurring' => [
                'interval' => $data['duration'] === 'Monthly' ? 'month' : 'year'
            ]
        ]);

        $obj = new \stdClass();
        $obj->product = $product;
        $obj->price = $price;
        return $obj;
    }

    public function createPlan ($duration, $price, $name) {
        return Stripe\Plan::create([
            'amount' => 100 * $price,
            'currency' => 'usd',
            'interval' => $duration,
            'product' => [
                'name' => $name,
            ],
        ]);
    }  

    public function createSubscription ($priceId, $subId) {
        return Stripe\Checkout\Session::create([
            'line_items' => [
                [
                    'price' => $priceId,
                    'quantity' => 1
                ]
            ],
            'mode' => 'subscription',
            'success_url' => env('APP_URL').'/subscription/stripe/confirm?session_id={CHECKOUT_SESSION_ID}&sub_id='.Crypt::encrypt($subId),
            'cancel_url' => env('APP_URL').'/subscription/stripe/cancel?session_id={CHECKOUT_SESSION_ID}'
        ]);
    }


    public function cancelSubscription ($stripe_subscription_id) {
        return Stripe\Subscription::update(
            $stripe_subscription_id,
            [
                'cancel_at_period_end' => true,
            ]
        );
    }

    /**
     * @throws ApiErrorException
     */
    public function retrieveSessionDetails ($sessionId): Stripe\Checkout\Session
    {
        return Stripe\Checkout\Session::retrieve($sessionId);
    }
}