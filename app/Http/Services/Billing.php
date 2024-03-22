<?php

namespace App\Http\Services;

use App\Models\BillingPlan;
use App\Models\BillingProduct;
use App\Models\PaypalProduct;
use App\Models\StripeCustomer;
use App\Http\Interfaces\Subscription;
use App\Http\Services\Billing\PaypalClient;
use App\Http\Services\Billing\StripeClient;

class Billing implements Subscription {
    public static function createPlan ($paymentType, $subscription) {
        switch ($paymentType) {
            case 'paypal':
                $billing_product = PaypalProduct::first();
                $plan  = \app(PaypalClient::class)->createPlan($billing_product['product_id'], $subscription->name, $subscription->price, $subscription->duration);
                return ((array)$plan)["\x00*\x00billing_plan"]["id"];
            case 'stripe':
                return \app(StripeClient::class)->createPlan($subscription->duration == 'Monthly' ? 'month' : 'year', $subscription->price, $subscription->name)->id;
            default:
                return null;
        }
    }
    
    public static function createProduct ($paymentType, $name, $price, $duration = null) {
        switch ($paymentType) {
            case 'stripe':
                return \app(StripeClient::class)->createProduct($name, ['price' => $price, 'duration' => $duration]);
            default:
                # code...
                break;
        }
        return null;
    }

    public static function createSubscription($paymentType, $package, $extraData = null) {
        switch ($paymentType) {
            case 'paypal':
                $billing_product = PaypalProduct::first();
                $billing_plan = BillingPlan::where('provider', $paymentType)->where('subscription_id', $package->id)->first();
                $user = auth()->user();
                return \app(PaypalClient::class)->createSubscription($billing_product['id'], $billing_plan['plan_id'], $user->name, $user->email);
            case 'stripe':
                // Fetch Customer
                $billing_product = BillingProduct::where('subscription_id', $package->id)->first();
                return \app(StripeClient::class)->createSubscription($billing_product['price_id'], $package->id);
            default:
                return null;
        }
    }

    public static function cancelSubscription ($paymentType, $subscription_id) {
        $billing_plan = BillingPlan::where('provider', $paymentType)->where('subscription_id', $subscription_id)->first();
        switch ($paymentType) {
            case 'paypal':
                return \app(PaypalClient::class)->cancelSubscription($billing_plan->plan_id);
            case 'stripe':
                return \app(StripeClient::class)->cancelSubscription($billing_plan->plan_id);
            default:
                return null;
        }
 
    }

    public static function createCustomer ($paymentType, $user) {
        switch ($paymentType) {
            // case 'paypal':
                // return \app(PaypalClient::class)->cancelSubscription($billing_plan->plan_id);
            case 'stripe':
                return \app(StripeClient::class)->createCustomer($user->name, $user->email);
            default:
                return null;
        }
    }

    public static function createSession () {

    }

}