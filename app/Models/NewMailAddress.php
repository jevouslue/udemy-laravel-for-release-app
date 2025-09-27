<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NewMailAddress extends Model
{
    /** @use HasFactory<\Database\Factories\NewMailAddressFactory> */
    use HasFactory;

    protected $fillable = ['user_id', 'email'];
}
