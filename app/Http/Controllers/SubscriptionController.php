<?php

namespace App\Http\Controllers;

use App\Http\Helpers\BillingHelper;
use App\Http\Services\Billing\StripeClient;
use App\Models\Order;
use App\Models\BillingPlan;
use App\Models\Subscription;
use Illuminate\Http\Request;
use App\Http\Services\Billing;
use App\Models\BillingProduct;
use App\Models\BillingTransaction;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Redirect;

class SubscriptionController extends Controller
{

    public function index()
    {
        if (\Auth::user()->type == 'super admin' || \Auth::user()->type == 'admin') {
            $subscriptions = Subscription::get();

            return view('subscription.index', compact('subscriptions'));
        } else {
            return redirect()->back()->with('error', __('Permission Denied!'));
        }
    }


    public function create()
    {
        $durations = Subscription::$duration;

        return view('subscription.create', compact('durations'));
    }


    public function store(Request $request)
    {
        try {
            if (\Auth::user()->type == 'super admin' ) {
                $validator = \Validator::make(
                    $request->all(), [
                    'name' => 'required|regex:/^[\s\w-]*$/',
                    'price' => 'required',
                    'duration' => 'required',
                    'total_user' => 'required',
                    'total_document' => 'required',
                ], [
                        'regex' => __('The Name format is invalid, Contains letter, number and only alphanum'),
                    ]
                );
                if ($validator->fails()) {
                    $messages = $validator->getMessageBag();
    
                    return redirect()->back()->with('error', $messages->first());
                }
    
                $subscription = Subscription::create(
                    [
                        'name' => $request->name,
                        'price' => $request->price,
                        'duration' => $request->duration,
                        'total_user' => $request->total_user,
                        'total_document' => $request->total_document,
                        'enabled_document_history' => isset($request->enabled_document_history)?1:0,
                        'enabled_logged_history' => isset($request->enabled_logged_history)?1:0,
                        'description' => $request->description,
                    ]
                );
                $stripe_billing_product = Billing::createProduct('stripe', $subscription->name, $subscription->price, $subscription->duration);
                BillingProduct::create([
                    'provider' => "stripe",
                    'subscription_id' => $subscription->id,
                    'product_id' => $stripe_billing_product->product->id,
                    'price_id' => $stripe_billing_product->price->id
                ]);

                $stripe_plan_id = Billing::createPlan('stripe', $subscription);
                $paypal_plan_id =  Billing::createPlan('paypal', $subscription);
                
                BillingPlan::insert([
                    [
                        'provider' => 'stripe',
                        'plan_id' => $stripe_plan_id,
                        'subscription_id' => $subscription->id
                    ], [
                        'provider' => 'paypal',
                        'plan_id' => $paypal_plan_id,
                        'subscription_id' => $subscription->id
                    ]
                ]);
                return redirect()->route('subscriptions.index')->with('success', __('Subscription successfully created!'));
            } else {
                return redirect()->back()->with('error', __('Permission Denied!'));
            }
        } catch (\Throwable $th) {
            //throw $th;
            dd($th);
            return redirect()->back()->with('error', __('Something went wrong, Please try again!'));
        }
    }


    public function show($ids)
    {
        if (\Auth::user()->type == 'admin') {
            $id = Crypt::decrypt($ids);
            $subscription = Subscription::find($id);

            return view('subscription.show', compact('subscription'));
        } else {
            return redirect()->back()->with('error', __('Permission Denied!'));
        }
    }


    public function edit(subscription $subscription)
    {
        $durations = Subscription::$duration;

        return view('subscription.edit', compact('durations', 'subscription'));
    }


    public function update(Request $request, subscription $subscription)
    {

        if (\Auth::user()->type == 'super admin') {
            $validator = \Validator::make(
                $request->all(), [
                'name' => 'required|regex:/^[\s\w-]*$/',
                'price' => 'required',
                'duration' => 'required',
                'total_user' => 'required',
                'total_document' => 'required',
            ], [
                    'regex' => __('The Name format is invalid, Contains letter, number and only alphanum'),
                ]
            );
            if ($validator->fails()) {
                $messages = $validator->getMessageBag();

                return redirect()->back()->with('error', $messages->first());
            }


            $subscription->name = $request->name;
            $subscription->price = $request->price;
            $subscription->duration = $request->duration;
            $subscription->total_user = $request->total_user;
            $subscription->total_document = $request->total_document;
            $subscription->enabled_document_history = isset($request->enabled_document_history)?1:0;
            $subscription->enabled_logged_history = isset($request->enabled_logged_history)?1:0;
            $subscription->description = $request->description;
            $subscription->save();

            return redirect()->route('subscriptions.index')->with('success', __('Subscription successfully updated!'));
        } else {
            return redirect()->back()->with('error', __('Permission Denied!'));
        }
    }


    public function destroy(subscription $subscription)
    {
        if (\Auth::user()->type == 'super admin') {
            $subscription->delete();

            return redirect()->route('subscriptions.index')->with('success', __('Subscription successfully deleted!'));
        } else {
            return redirect()->back()->with('error', __('Permission Denied!'));
        }
    }

    public function transaction()
    {
        if (\Auth::user()->type == 'admin' || \Auth::user()->type == 'super admin') {
            $transactions = Order::select(
                [
                    'orders.*',
                    'users.name as user_name',
                ]
            )->join('users', 'orders.user_id', '=', 'users.id')->orderBy('orders.created_at', 'DESC')->get();

            return view('subscription.transaction', compact('transactions'));
        } else {
            return redirect()->back()->with('error', __('Permission Denied!'));
        }
    }

    public function stripePayment(Request $request, $ids)
    {
        if (\Auth::user()->type == 'admin') {
            $authUser = \Auth::user();
            $id = \Illuminate\Support\Facades\Crypt::decrypt($ids);
            $subscription = Subscription::find($id);

            if ($subscription) {
                try {
                    $orderID = uniqid('', true);
                    if ($subscription->price > 0.0) {
                        $transaction = new BillingTransaction();
                        switch ($request->payment_type) {
                            case 'stripe':
                                $session = Billing::createSubscription('stripe', $subscription);
//                                $transaction_resp = BillingHelper::handleStripeTransaction($data, $subscription, $orderID);
//                                $transaction->provider = 'stripe';
                                return Redirect::to($session->url);
                            case 'paypal':
                                $links = Billing::createSubscription('paypal', $subscription, ['token' => $request->stripeToken, 'orderID' => $orderID]);
//                                $transaction_resp = BillingHelper::handlePaypalTransaction($data, $subscription, $orderID);
//                                $transaction->provider = 'paypal';
                                foreach ($links as $link) {
                                    if ($link['rel'] == 'approve') {
                                        return Redirect::to($link['href']);
                                    }
                                }
                            default:
                                return redirect()->route('subscriptions.index')->with('error', __('Unsupported Payment Gateway'));
                        }
                    } else {
                        $data['amount_refunded'] = 0;
                        $data['failure_code'] = '';
                        $data['paid'] = 1;
                        $data['captured'] = 1;
                        $data['status'] = 'succeeded';
                    }

//                    if ($transaction_resp['status']) {
//                        $transaction->order_id = $orderID;
//                        $transaction->transaction_id = $data['id'];
//                        $transaction->save();
//                        return redirect()->route('subscriptions.index')->with('success', __('Transaction Successfully complete'));
//                    } else {
//                        return redirect()->route('subscriptions.index')->with('error', __($transaction_resp['message']));
//                    }
                } catch (\Exception $e) {
                    dd($e);
                    return redirect()->route('subscriptions.index')->with('error', __($e->getMessage()));
                }
            } else {
                return redirect()->route('subscriptions.index')->with('error', __('Subscription is deleted.'));
            }
        } else {
            return redirect()->back()->with('error', __('Permission denied.'));
        }

    }

    public function cancel (Request $request, $ids) {
        if (\Auth::user()->type == 'admin') { 
            $id = \Illuminate\Support\Facades\Crypt::decrypt($ids);
            $subscription = Subscription::find($id);

            $transaction = BillingTransaction::where('subscription_id', $subscription->id)->first();
            switch ($transaction->provider) {
                case 'stripe':
                    Billing::cancelSubscription('stripe', $subscription->id);
                    break;
                case 'paypal':
                    Billing::cancelSubscription('stripe', $subscription->id);
                    break;
                default:
                    return redirect()->route('subscriptions.index')->with('error', __('Unsupported Payment Gateway'));
            }
            return redirect()->route('subscriptions.index')->with('success', __('Subscription Cancelled Successfully'));
        } else {
            return redirect()->back()->with('error', __('Permission denied.'));
        }
    }


    public function confirmStripePayment (Request $request) {
        try {
            $subscriptionId = Crypt::decrypt($request->get('sub_id'));
            $subscription = Subscription::findOrFail($subscriptionId);
            $sessionId = $request->query('session_id');
            $session = \app(StripeClient::class)->retrieveSessionDetails($sessionId);

            if ($session->payment_status !== 'paid') {
                return response()->redirectTo('/subscriptions')->with('error', 'Payment failed. Please try again');
            }
            $orderID = uniqid('', true);
            $authUser = \Auth::user();
            Order::create(
                [
                    'order_id' => $orderID,
                    'name' => $session->customer_details->name,
                    'card_number' => '',
                    'card_exp_month' => '',
                    'card_exp_year' => '',
                    'subscription' => $subscription->name,
                    'subscription_id' => $subscription->id,
                    'price' => $session->amount_total / 100,
                    'price_currency' => $session->currency,
                    'txn_id' => '',
                    'payment_status' => 'succeeded',
                    'payment_type' => __('STRIPE'),
                    'receipt' => '',
                    'user_id' => $authUser->id,
                ]
            );
            $assignPlan = $authUser->assignSubscription($subscription->id);
            if ($assignPlan['is_success']) {
                return redirect()->route('subscriptions.index')->with('success', __('Subscription successfully activated.'));
            } else {
                return redirect()->route('subscriptions.index')->with('error', __($assignPlan['error']));
            }
        } catch (e) {
            return response()->redirectTo('/subscriptions')->with('error', 'Payment failed. Please try again');
        }
    }

    public function confirmPaypalPayment (Request $request) {
        try {
            $paypal_sub_id = $request->get('subscription_id');
            $paypal_sub = \app(Billing\PaypalClient::class)->fetchSubscription($paypal_sub_id);

            $billingPlan = BillingPlan::where('plan_id', $paypal_sub['plan_id'])->first();
            $subscription = Subscription::find($billingPlan['subscription_id']);

            $orderID = uniqid('', true);
            $authUser = \Auth::user();

            Order::create(
                [
                    'order_id' => $orderID,
                    'name' => $paypal_sub['subscriber']['name']['given_name'].' '.$paypal_sub['subscriber']['name']['surname'],
                    'card_number' => '',
                    'card_exp_month' => '',
                    'card_exp_year' => '',
                    'subscription' => $subscription->name,
                    'subscription_id' => $subscription->id,
                    'price' => $paypal_sub['billing_info']['last_payment']['amount']['value'],
                    'price_currency' => $paypal_sub['billing_info']['last_payment']['amount']['currency_code'],
                    'txn_id' => '',
                    'payment_status' => 'succeeded',
                    'payment_type' => __('PAYPAL'),
                    'receipt' => '',
                    'user_id' => $authUser->id,
                ]
            );
            $assignPlan = $authUser->assignSubscription($subscription->id);
            if ($assignPlan['is_success']) {
                return redirect()->route('subscriptions.index')->with('success', __('Subscription successfully activated.'));
            } else {
                return redirect()->route('subscriptions.index')->with('error', __($assignPlan['error']));
            }
        } catch (e) {
            return response()->redirectTo('/subscriptions')->with('error', 'Payment failed. Please try again');
        }
    }
}
