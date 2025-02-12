<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
class Product extends Model
{
     use HasFactory;
    protected $fillable = [
        'name', 'slug', 'description', 'price', 'stock', 'image',
        'category_id', 'brand_id', 'discount_id'
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function brand()
    {
        return $this->belongsTo(Brand::class);
    }
    public function orders()
    {
        return $this->hasMany(Order::class);
    }

    public function discount()
    {
        return $this->belongsTo(Discount::class);
    }

    public function reviews() {
        return $this->hasMany(Review::class);
    }
}
