<?php

namespace App\Http\Helpers;

class BillingHelper {
    public static function handleStripeTransaction ($data, $subscription, $orderID) {
        if ($data['amount_refunded'] == 0 && empty($data['failure_code']) && $data['paid'] == 1 && $data['captured'] == 1) {
            $orders = Order::create(
                [
                    'order_id' => $orderID,
                    'name' => $data->name,
                    'card_number' => isset($data['payment_method_details']['card']['last4']) ? $data['payment_method_details']['card']['last4'] : '',
                    'card_exp_month' => isset($data['payment_method_details']['card']['exp_month']) ? $data['payment_method_details']['card']['exp_month'] : '',
                    'card_exp_year' => isset($data['payment_method_details']['card']['exp_year']) ? $data['payment_method_details']['card']['exp_year'] : '',
                    'subscription' => $subscription->name,
                    'subscription_id' => $subscription->id,
                    'price' => $subscription->price,
                    'price_currency' => isset($data['currency']) ? $data['currency'] : '',
                    'txn_id' => isset($data['balance_transaction']) ? $data['balance_transaction'] : '',
                    'payment_status' => isset($data['status']) ? $data['status'] : 'succeeded',
                    'payment_type' => __('STRIPE'),
                    'receipt' => isset($data['receipt_url']) ? $data['receipt_url'] : '',
                    'user_id' => auth()->id(),
                ]
            );

            if ($data['status'] == 'succeeded') {
                $assignPlan = auth()->user()->assignSubscription($subscription->id);
                if ($assignPlan['is_success']) {
                    return ['status' => true, 'data' => $orders];
                } else {
                    return ['status' => false, 'message' => __($assignPlan['error'])];
                }
            } else {
                return ['status' => false, 'message' => __('Your payment has failed.')];
            }
        } else {
            return ['status' => false, 'message' => __('Transaction has been failed.')];
        }   
    }

    public static function handlePaypalTransaction ($data, $subscription, $orderID) {
        if ($data['status'] === 'ACTIVE') {
            $orders = Order::create(
                [
                    'order_id' => $orderID,
                    'name' => $request->name,
                    'card_number' => isset($data['payment_method_details']['card']['last4']) ? $data['payment_method_details']['card']['last4'] : '',
                    'card_exp_month' => isset($data['payment_method_details']['card']['exp_month']) ? $data['payment_method_details']['card']['exp_month'] : '',
                    'card_exp_year' => isset($data['payment_method_details']['card']['exp_year']) ? $data['payment_method_details']['card']['exp_year'] : '',
                    'subscription' => $subscription->name,
                    'subscription_id' => $subscription->id,
                    'price' => $subscription->price,
                    'price_currency' => isset($data['currency']) ? $data['currency'] : '',
                    'txn_id' => isset($data['balance_transaction']) ? $data['balance_transaction'] : '',
                    'payment_status' => isset($data['status']) ? $data['status'] : 'succeeded',
                    'payment_type' => __('PAYPAL'),
                    'receipt' => isset($data['receipt_url']) ? $data['receipt_url'] : '',
                    'user_id' => auth()->id(),
                ]
            );

            $assignPlan = auth()->user()->assignSubscription($subscription->id);

            if ($assignPlan['is_success']) {
                return ['status' => true, 'data' => $orders];
            } else {
                return ['status' => false, 'message' => __($assignPlan['error'])];
            }
        }
        return ['status' => false, 'message' => __('Transaction has been failed.')];
    }
}