<?php

// app/Models/Delivery.php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Delivery extends Model
{
    protected $primaryKey = 'delivery_id';
    
    protected $fillable = [
        'order_id', 'user_id', 'delivery_address',
        'delivery_status', 'delivery_contact', 'delivery_time'
    ];

    public function order(): BelongsTo
    {
        return $this->belongsTo(Order::class, 'order_id');
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}