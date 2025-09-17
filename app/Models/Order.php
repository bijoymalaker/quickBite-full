<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'email',
        'phone',
        'amount',
        'address',
        'status',
        'transaction_id',
        'currency',
        'payment_method',
        'items',
        'progress',
        'estimated_delivery',
    ];

    protected $casts = [
        'amount' => 'decimal:2',
        'items' => 'array',
        'progress' => 'array',
        'estimated_delivery' => 'datetime',
    ];
}
