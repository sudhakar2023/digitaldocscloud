<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AwsMarketplaceCustomer extends Model
{
    use HasFactory;

    protected $fillable = [
        'customer_id',
        'customer_aws_account_id',
        'product_code',
    ];
}
