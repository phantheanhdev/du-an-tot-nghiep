<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'qr_code',
        'product_id',
        'quantity',
        'note',
        'price',
        'total_price',
        'status',
        'customer_name',
        'customer_phone',
    ];

}
