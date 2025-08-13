<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Restaurant extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'name',
        'email',
        'phone',
        'address',
        'image',
        'cuisine_type',
        'delivery_fee',
        'delivery_time',
        'minimum_order',
        'is_open',
        'opening_time',
        'closing_time',
        'rating',
    ];

    protected $casts = [
        'is_open' => 'boolean',
        'delivery_fee' => 'decimal:2',
        'minimum_order' => 'decimal:2',
        'rating' => 'decimal:1',
        'opening_time' => 'datetime:H:i',
        'closing_time' => 'datetime:H:i',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function products()
    {
        return $this->hasMany(Product::class);
    }

    public function offers()
    {
        return $this->hasMany(Offer::class);
    }
}
