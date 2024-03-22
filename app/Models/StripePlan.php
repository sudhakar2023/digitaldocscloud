<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StripePlan extends Model
{
    use HasFactory;

    protected $fillable = [
        'subscription_id',
        'plan_id'
    ];
}
