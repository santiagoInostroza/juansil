<?php

namespace App\Models;

use App\Models\Purchase;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class PurchaseItem extends Model
{
    use HasFactory;

     //RELACION UNO A MUCHOS INVERSA
     public function purchase(){
        return $this->belongsTo(Purchase::class);
    }

    //RELACION UNO A MUCHOS INVERSA
    public function product(){
        return $this->belongsTo(Product::class); 
     }

     



}
