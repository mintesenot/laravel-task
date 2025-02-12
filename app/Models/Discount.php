<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
class Discount extends Model
{
    use HasFactory;

    protected $fillable = ['code', 'percentage', 'start_date', 'end_date'];

    public function products()
    {
        return $this->hasMany(Product::class);
    }
}
