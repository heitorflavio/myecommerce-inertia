<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MelhorEnvio extends Model
{
    use HasFactory;
    protected $fillable = ['token', 'cep_origem'];
}
