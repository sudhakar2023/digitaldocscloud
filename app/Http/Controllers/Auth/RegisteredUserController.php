<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use App\Models\Subscription;
use Illuminate\Http\Request;
use App\Http\Services\Billing;
use App\Models\StripeCustomer;
use Illuminate\Validation\Rules;
use Spatie\Permission\Models\Role;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Auth\Events\Registered;
use App\Providers\RouteServiceProvider;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        if ($request->query('evnt') === 'aws') {
            $aws_customer = AwsMarketplaceCustomer::where('customer_id', $request->query('customer_id'))->first();
            $subscription = Subscription::where('product_code', $aws_customer['product_code'])->first();
            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'type' => 'admin',
                'subscription' => $subscription->id,
                'lang' => 'english',
            ]);

            //Update AWS Marketplace Customer
            // $aws_customer->user_id = $user->id;
            // $aws_customer->save();
            
        } else {
            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'type' => 'admin',
                'lang' => 'english',
            ]);
        }

        event(new Registered($user));
        $role_r = Role::findByName('owner');
        $user->assignRole($role_r);
        Auth::login($user);

        return redirect(RouteServiceProvider::HOME);
    }
}