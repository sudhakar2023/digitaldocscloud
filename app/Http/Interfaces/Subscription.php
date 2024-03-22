<?php

namespace App\Http\Interfaces;

interface Subscription {
    public static function createSubscription($paymentType, $package, $extraData = null);
}