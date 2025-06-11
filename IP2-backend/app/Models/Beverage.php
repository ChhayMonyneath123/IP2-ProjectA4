<?php

// app/Models/Beverage.php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Beverage extends Model
{
    protected $primaryKey = 'beverage_type_id';
    
    protected $fillable = ['category_id', 'name', 'image_url'];

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class, 'category_id');
    }

    public function products(): HasMany
    {
        return $this->hasMany(Product::class, 'beverage_type_id');
    }
}