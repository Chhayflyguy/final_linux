<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Product extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'qty', 'unit_price', 'category_id ' , 'product_image'];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}
