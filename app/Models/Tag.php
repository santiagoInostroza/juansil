<?php

namespace App\Models;

use App\Models\Product;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Tag extends Model
{

    use HasFactory;
    protected $fillable=['name','slug','color'];



     //RELACION MUCHOS A MUCHOS
     public function products()
     {
         return $this->belongsToMany(Product::class);
     }
     public function getRouteKeyName()
    {
        return 'slug';
    }
}
