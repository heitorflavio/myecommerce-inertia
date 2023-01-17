<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Products extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'Fulldescription',
        'image',
        'price',
        'sku',
        'stock',
        'onSalePrice',
        'onSale',
        'onSaleDate',
        'weight',
        'length',
        'height',
        'width',
        'insurance_value',
    ];
}
