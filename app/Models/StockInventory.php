<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StockInventory extends Model{
    use HasFactory;

     //RELACION UNO A MUCHOS INVERSA
     public function product(){
        return $this->belongsTo(Product::class); 
     }
}


