<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'table_id',
        'note',
        'total_price',
        'status',
        'customer_name',
        'customer_phone',
        'order_day'
    ];

    public function orderdetail(){
       return $this->hasMany(OrderDetail::class);
    }

    public function tables (){
        return $this->belongsTo(Table::class);
    }

}
