<?php

namespace App\Models;

use App\Models\Sale;
use App\Models\Product;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class SaleItem extends Model
{
    use HasFactory;
    protected $guarded = ['id','created_at','updated_at'];


     //RELACION UNO A MUCHOS INVERSA
     public function product(){
        return $this->belongsTo(Product::class); 
     }

     //RELACION UNO A MUCHOS INVERSA
     public function sale(){
         return $this->belongsTo(Sale::class);
     }
}
