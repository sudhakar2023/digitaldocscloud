<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BillingTransaction extends Model
{
    use HasFactory;

    protected $fillable = ['subscription_id', 'provider', 'transaction_id'];
}
