<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PaypalProduct extends Model
{
    use HasFactory;

    protected $fillable = [
        'product_id',
    ];
}
