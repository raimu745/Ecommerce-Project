<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'prod_id','review'];

     function user(){
        return $this->hasMany(User::class,'user_id','id');
     }
}
