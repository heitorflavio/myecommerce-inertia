<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customers extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'name',
        'email',
        'document',
        'phone',
        'address',
        'number',
        'district',
        'city',
        'state',
        'zip',
        'cart'
    ];
     
}
