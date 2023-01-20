<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CartProducts extends Model
{
    use HasFactory;

    protected $fillable = [
        'cart_id',
        'name',
        'product_id',
        'quantity',
        'description',
        'sku',
        'price',
        'image',
        'status',
        'weight',
        'length',
        'height',
        'width',
        'insurance_value',
    ];
}
