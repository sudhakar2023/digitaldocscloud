<?php
namespace App\Providers;

use App\Http\Services\Aws;
use App\Models\BillingProduct;
use App\Models\PaypalProduct;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;
use App\Http\Services\Billing\PaypalClient;
use App\Http\Services\Billing\StripeClient;


class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
            Schema::defaultStringLength(191);
//
            $this->app->singleton(PaypalClient::class, function () {
                $client = new PaypalClient();
                $paypalProduct = PaypalProduct::first();
                if (!$paypalProduct) {
                    $product = $client->createProduct(
                        'Digital Docs Cloud',
                        'SERVICE',
                        'Digital DocsCloud. Digital Record and Document Management System',
                        'SOFTWARE',
                        'https://digitaldocscloud.com'
                    );
                    PaypalProduct::create([
                        'product_id' => $client->listProducts()['products'][0]['id']
                    ]);
                }
                return $client;
            });
//
//            $this->app->singleton(StripeClient::class, function () {
//                $client = new StripeClient();
//                $stripeProduct = BillingProduct::where('provider', 'stripe')->first();
//                if (!$stripeProduct) {
//                    $product_id = $client->createProduct('Digital Docs Cloud. Digital Record Management System')->id;
//                    BillingProduct::create([
//                        'product_id' => $product_id,
//                        'provider' => 'stripe',
//                    ]);
//                }
//
//                return $client;
//            });

            $this->app->singleton(Aws::class, function () {
                return new Aws();
            });
    }
}
