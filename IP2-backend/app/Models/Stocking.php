<?php

// app/Models/Stocking.php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Stocking extends Model
{
    protected $primaryKey = 'stock_id';
    
    protected $fillable = [
        'product_id', 'quantity_available', 'status'
    ];

    protected $casts = [
        'updated_at' => 'datetime'
    ];

    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class, 'product_id');
    }
}
