<?php

// app/Models/Cuisine.php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Subcategory extends Model
{
    protected $primaryKey = 'subcategory_id';
    
    protected $fillable = ['name', 'description', 'category_id'];


    public function products(): HasMany
    {
        return $this->hasMany(Product::class, 'subcategory_id');
    }
    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class, 'category_id');
    }
}
