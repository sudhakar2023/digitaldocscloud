<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class AwsCustomer extends Model
{
    use HasFactory;

    protected $fillable = ['email', 'customer_id', 'user_id', 'expiry_date'];

    public function aws_subscriptions (): HasMany {
        return $this->hasMany(AwsSubscription::class, 'aws_customer_id', 'id');
    }
}
