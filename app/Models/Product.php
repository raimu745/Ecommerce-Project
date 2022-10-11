<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    protected $table = 'products';

    function category(){
        return $this->belongsTo(Category::class ,'cate_id','id');

    }
    function wishlist(){
        return $this->belongsTo(Whishlist::class,'prod_id','id');
    }
}
