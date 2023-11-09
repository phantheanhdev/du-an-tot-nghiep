<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use HasFactory,SoftDeletes;
    protected $table = 'products';
    protected $primaryKey = 'id';
    protected $fillable = [
        'name',
        'price',
        'item',
        'image',
        'status',
        'description',
        'category_id',
    ];

    public function orderdetails(){
        return  $this->hasMany(OrderDetail::class,'product_id','id');
    }
}
