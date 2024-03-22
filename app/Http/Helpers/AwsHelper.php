<?php

namespace App\Http\Helpers;

use App\Models\AwsSubscription;
use Error;
use App\Models\User;
use App\Models\AwsCustomer;
use App\Models\Subscription;

class AwsHelper {
    public static function handleActiveSubscription (string $customerId, string $dimension, string $expiryDate, int $quantity)
    {
        $subscription = Subscription::where('name', $dimension)->first();
        if (!$subscription) throw new Error("Could not find a package with provided dimensions");
        
        $aws_customer = AwsCustomer::where('customer_id', $customerId)->first();
        if ($aws_customer) throw new Error("Aws Account Already Set Up");

        $aws_customer = AwsCustomer::create([
            'customer_id' => $customerId,
        ]);
        return AwsSubscription::create([
            'subscription_id' => $subscription->id,
            'aws_customer_id' => $aws_customer->id,
            'quantity' => $quantity,
            'expiry_date' => $expiryDate
        ]);
    }

    public static function handlePendingSubscription ($customerId) {
        //Send reminder email maybe
        $aws_customer = AwsCustomer::where('user_id', $customerId)->firstOrFail();
        self::cancelSubscription($aws_customer->user_id);
    }

    public static function handleUnsubscribe ($customerId) {
        $aws_customer = AwsCustomer::where('user_id', $customerId)->firstOrFail();
        self::cancelSubscription($aws_customer->user_id);
    }

    private static function cancelSubscription ($userId) {
        $user = User::find($userId);
        $user->subscription = null;
        $user->subscription_expire_date = null;
        $user->save();
    }

}