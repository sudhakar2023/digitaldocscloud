<?php

use Aws\Credentials\Credentials;
use Aws\MarketplaceMetering\MarketplaceMeteringClient;
use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;

/*
|--------------------------------------------------------------------------
| Console Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of your Closure based console
| commands. Each Closure is bound to a command instance allowing a
| simple approach to interacting with each command's IO methods.
|
*/


Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote');

//\Illuminate\Console\Scheduling\Schedule::call(function () {
//    $credentials = new Credentials(env('AWS_KEY'), env('AWS_SECRET'));
//    $meteringClient = new MarketplaceMeteringClient([
//        'credentials' =>  $credentials,
//        'region' => 'us-east-1',
//        'version' => 'latest',
//    ]);
//
//    $records = \DB::table('aws_usages')->where('created_at', '<=', \Carbon\Carbon::now()->subHour())->get();
//    $batchedRecords = [
//        "ProductCode" => env("AWS_PRODUCT_CODE"),
//        "UsageRecords" => []
//    ];
//    foreach ($records as $record) {
//        $batchedRecords['UsageRecords'][] = [
//            'CustomerIdentifier' => $record['aws_customer_id'],
//            'Dimension' => $record['dimension'],
//            'Timestamp' => $record['created_at'],
//            'Quantity' => $record['usage'],
//            'UsageAllocations' => [
//                [
//                    'AllocatedUsageQuantity' => $record['usage'],
//                    'Tags' => [
//                        [
//                            'Key' => $record['dimension'],
//                            'Value' => 'usage tokens for ' . $record['dimension']
//                        ]
//                    ]
//                ]
//            ]
//        ];
//    }
//
//    $meteringClient->batchMeterUsage($batchedRecords);
//})->hourly();