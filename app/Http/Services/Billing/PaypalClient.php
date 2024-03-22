<?php

namespace App\Http\Services\Billing;
use Carbon\Carbon;
use Carbon\Traits\Date;
use Srmklive\PayPal\Services\PayPal;
// use App\Http\Services\Billing\PaypalClient;

class PaypalClient
{
    protected $provider;

    public function __construct() {
        $this->provider = new Paypal;
        $this->provider->getAccessToken();
    }

    public function createProduct ($product_name, $product_type, $description, $category, $url) {
        return $this->provider->addProduct($product_name, $description, $product_type, $category);
    }

    public function listProducts () {
        return $this->provider->listProducts();        
    }


    public function createPlan ($product_id, $name, $price, $duration) {
        switch ($duration) {
            case 'Monthly':
                return $this->provider->addProductById($product_id)->addMonthlyPlan($name, $name, $price);
            case 'Yearly':
                return $this->provider->addProductById($product_id)->addAnnualPlan($name, $name, $price);
            default:
                return null;
        }
    }

    /**
     * @throws \Throwable
     */
    public function listPlans () {
        return $this->provider->listPlans(1, 50);
    }

    /**
     * @throws \Throwable
     */
    public function createSubscription ($product_id, $plan_id, $name, $email) {
        // Send the request to create the subscription
        $response = $this->provider
            ->addProductById($product_id)
            ->addBillingPlanById($plan_id)
            ->setReturnAndCancelUrl(env('APP_URL').'/subscription/paypal/confirm', env('APP_URL').'/subscription/paypal/cancel')
            ->setupSubscription($name, $email, Carbon::now()->addMinute(1)->toDateTimeString());

        if (isset($response['id']) && $response['id'] != null) {
            return $response['links'];
        } else {
            return null;
        }
    }

    public function cancelSubscription ($subscription_id, $reason = 'No reason provided') {
        $this->provider->cancelSubscription($subscription_id, $reason);
    }

    /**
     * @throws \Throwable
     */
    public function fetchSubscription ($subscriptionId): \Psr\Http\Message\StreamInterface|array|string
    {
        return $this->provider->showSubscriptionDetails($subscriptionId);
    }
}
