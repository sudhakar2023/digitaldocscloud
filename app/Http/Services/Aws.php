<?php
namespace App\Http\Services;
use Aws\Sns\SnsClient;
use Aws\Credentials\Credentials;
use Aws\MarketplaceMetering\MarketplaceMeteringClient;
use Aws\MarketplaceEntitlementService\MarketplaceEntitlementServiceClient;

class Aws {
    public $metering_client;
    public $entitlement_client;
    public $sns_client;

    private $topicArn = 'arn:aws:sns:us-east-1:287250355862:aws-mp-entitlement-notification-4pgosl68ks3yl2t183k049o0c';
    private $endpoint;
    
    public function __construct() {
        try {
            // $this->endpoint = url("/aws/entitlement/web-hook");
            $this->endpoint = "https://533f-196-202-162-46.ngrok-free.app/api/aws/entitlement/web-hook";
            $credentials = new Credentials(env('AWS_ACCESS_KEY_ID'), env('AWS_SECRET_ACCESS_KEY'));
            $this->metering_client = new MarketplaceMeteringClient([
                'version' => 'latest',
                'region' => 'us-east-1',
                'credentials' => $credentials,
            ]);

            $this->entitlement_client = new MarketplaceEntitlementServiceClient([
                'version' => 'latest',
                'region' => 'us-east-1',
                'credentials' => $credentials,
            ]);

            $this->sns_client = new SnsClient([
                // 'profile' => 'default',
                'region' => 'us-east-1',
                'version' => 'latest',
                'credentials' => $credentials
            ]);
            

            $this->sns_client->subscribe([
                'Protocol' => 'https',
                'Endpoint' => $this->endpoint,
                'TopicArn' => $this->topicArn
            ]);
        } catch (\Throwable $th) {
            //throw $th;
            dd("AWS Constructor Error", $th);
        }
    }

    public function resolveCustomer($token) {       
        $result = $this->metering_client->resolveCustomer([
            'RegistrationToken' => $token,
        ]);
        return $result;
    }

    public function getAllEntitlements () {
        return $this->entitlement_client->getEntitlements();
    }

    public function getCustomerEntitlements($customer_id, $product_code) {
        $result = $this->entitlement_client->getEntitlements([
            'CustomerIdentifier' => $customer_id,
            'ProductCode' => $product_code,
        ]);

        return $result;
    }
}