<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subcategory extends Model
{
    use HasFactory;
    function rel_to_category(){
        return $this->hasMany(Category::class , 'id' , 'category_id');
    }
    function rel_to_product(){
        return $this->hasMany(Product::class , 'subcategory_id' , 'id');
    }
}
