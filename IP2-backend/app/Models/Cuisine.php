<?php

// app/Models/Cuisine.php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Cuisine extends Model
{
    protected $primaryKey = 'cuisine_id';
    
    protected $fillable = ['name', 'description'];


    public function products(): HasMany
    {
        return $this->hasMany(Product::class, 'cuisine_id');
    }
}
