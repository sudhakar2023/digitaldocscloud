<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AwsSubscription extends Model
{
    use HasFactory;

    protected $fillable = ['subscription_id', 'aws_customer_id', 'quantity', 'expiry_date'];
}
