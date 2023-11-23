<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductVariant extends Model
{
    use HasFactory;
    protected $fillable = [
        'product_id',
        'name',
        'multi_choice'
    ];
    public function product()
    {
        return $this->belongsTo(Product::class);
    }
    public function productVariantItems()
    {
        return $this->hasMany(ProductVariantItem::class);
    }
}
