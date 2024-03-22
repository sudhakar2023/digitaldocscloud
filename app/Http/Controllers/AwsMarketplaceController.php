<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\User;
use App\Http\Services\Aws;
use App\Models\AwsCustomer;
use App\Models\Subscription;
use Illuminate\Http\Request;
use App\Http\Services\Billing;
use App\Models\StripeCustomer;
use App\Http\Helpers\AwsHelper;
use App\Mail\AWSCustomerCreated;
use Illuminate\Testing\Fluent\Concerns\Has;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Validator;


class AwsMarketplaceController extends Controller
{
    public function register () {
        return view('aws.register');
    }

    public function resolveCustomer (Request $request) {
        try {
            $validate = Validator::make($request->all(), [
                'x-amzn-marketplace-token' => 'required',
            ]);
        
            if ($validate->fails()) {
                return redirect()->back()->with('error', "Error validating marketplace token");
            }
            
            $customer_results = \app(Aws::class)->resolveCustomer($request['x-amzn-marketplace-token']);
            if (!$customer_results || !isset($customer_results['CustomerIdentifier'])) {
                throw new Exception("Error resolving customer");
            }

            $entitlement_results = \app(Aws::class)->getCustomerEntitlements($customer_results['CustomerIdentifier'], $customer_results['ProductCode']);

            if (!count($entitlement_results['Entitlements'])) {
                return redirect()->back()->with('error', 'Could not find an active subscription. If you already registered please try again');    
            }

            foreach ($entitlement_results['Entitlements'] as $entitlement) {
                AwsHelper::handleActiveSubscription($customer_results['CustomerIdentifier'], $entitlement['Dimension'], $entitlement['ExpirationDate'], $entitlement['Value']['IntegerValue'] ?? 1);
            }

            return redirect('/aws/register?customer_id='.$customer_results['CustomerIdentifier']);
        } catch (\Throwable $th) {
            dd($th);
            return redirect('/register')->with('error', $th->getMessage());
        }
    }

    public function registerCustomer (Request $request) {
        try {
            $customer_id = $request->customer_id;
            $aws_customer = AwsCustomer::where('customer_id', $customer_id)->with('aws_subscriptions')->first();
            if (!$aws_customer) {
                return redirect()->back()->with('error', 'Account not found. Please contact support if it persists');    
            }

            //Generate new Name
            $name = bin2hex(random_bytes(6));
            //Generate new password
            $password = bin2hex(random_bytes(8));

            //Create New User
            $user = User::create([
                'name' => $name,
                'email' => $request->email,
                'password' => Hash::make($password),
                'type' => 'admin',
                'lang' => 'english',
                'email_verified_at' => now()
            ]);

            //Iterate And Assign Subscriptions To User
            $sub_id = null;
            $expiry_date = null;

            $total_document_usage = 0;
            $total_user_usage = 0;

            foreach ($aws_customer->aws_subscriptions as $subscription) {
                $subscriptionModel = Subscription::findOrFail($subscription->id);
                $document_usage = $subscription->quantity > 1 ? -($subscriptionModel->total_document * $subscription->quantity) : 0;
                $total_document_usage += $document_usage;

                $user_usage = $subscription->quantity > 1 ? -($subscriptionModel->total_document * $subscription->quantity) : 0;
                $total_user_usage += $user_usage;

                $sub_id = $subscription->id;
                $expiry_date = $subscription->expiry_date;
            }

            $user->user_usage = $total_user_usage;
            $user->document_usage = $total_document_usage;
            $user->subscription = $sub_id;
            $user->subscription_expire_date = $expiry_date;
            $user->save();

            event(new Registered($user));
            $role_r = Role::findByName('owner');
            $user->assignRole($role_r);

            $user->assignSubscription($sub_id);
            $aws_customer->user_id = $user->id;
            $aws_customer->save();

            $stripe_customer = Billing::createCustomer('stripe', $user);            
            StripeCustomer::create([
                'user_id' => $user->id,
                'customer_id' => $stripe_customer->id,
            ]);

            event(new Registered($user));
            $role_r = Role::findByName('owner');
            $user->assignRole($role_r);
            // Auth::login($user);

            Mail::to($user)->send(new AWSCustomerCreated($password));
            return redirect()->back()->with('success', 'Please check you email for account information');
        } catch (\Throwable $th) {
            //throw $th;
                dd($th);
//            dd($th->getMessage(), $th->getCode());
            return redirect()->back()->with('error', 'Something went wrong, please try again later.');
        }
    }

    public function handleNotification(Request $request)
    {
        $data = json_decode($request->getContent(), true);
        Log::debug($data);
        switch ($data['Type']) {
            case 'SubscriptionConfirmation':
                Log::debug("Subscription Confirmation Test Working!!!!!!!!!!!!!!!!!!!!!!!!!!!!");
                break;     
            case 'EntitlementNotification':
                $results = \app(Aws::class)->getAllEntitlements();
                foreach ($results['Entitlements'] as $entitlement) {
                    switch ($entitlement['Status']) {
                        case 'ACTIVE':
                            // Handle new or upgraded entitlement
                            AwsHelper::handleActiveSubscription($entitlement['CustomerIdentifier'], $entitlement['Dimension'], $entitlement['ExpirationDate']);
                            break;
                        case 'PENDING':
                            // Handle pending entitlement (usually renewal)
                            AwsHelper::handlePendingSubscription($entitlement['CustomerIdentifier']);
                            break;
                        case 'EXPIRED':
                            // Handle expired entitlement
                            AwsHelper::handleUnsubscribe($entitlement['CustomerIdentifier']);
                            break;
                        case 'SUSPENDED':
                            // Handle suspended entitlement
                            AwsHelper::handleUnsubscribe($entitlement['CustomerIdentifier']);
                            break;
                        case 'TERMINATED':
                            AwsHelper::handleUnsubscribe($entitlement['CustomerIdentifier']);
                            // Handle terminated entitlement
                            break;
                        case 'CANCELLED':
                            AwsHelper::handleUnsubscribe($entitlement['CustomerIdentifier']);
                            // Handle cancelled entitlement
                            break;
                    }
                }
                Log::debug("Entitlement notification Test Working!!!!!!!!!!!!!!!!!!!!!!!!!!!!");
                break;
            default:
                Log::debug("Message type not handled: ${$data['type']}");
                break;
        }

        http_response_code(200);
    }
}
