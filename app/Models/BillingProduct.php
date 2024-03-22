<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BillingProduct extends Model
{
    use HasFactory;

    protected $fillable = [
        'product_id',
        'provider',
        'price_id',
        'subscription_id'
    ];
}
