<?php

namespace App\Models;

use App\Models\Product;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ProductMovement extends Model
{
    use HasFactory;
    protected $guarded=[];
    
    //RELACION POLIMORFICA
    public function itemable()
    {
        return $this->morphTo();
    }


    //RELACION UNO A MUCHOS INVERSA
    public function product()
    {
        return $this->belongsTo(Product::class);
        
    }

}
