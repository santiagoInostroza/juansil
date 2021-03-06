<?php

namespace App\Models;

use App\Models\Product;
use App\Models\MovementSale;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class PurchasePrice extends Model
{
    use HasFactory;
    protected $guarded = ['id','created_at','updated_at'];

     //RELACION UNO A MUCHOS INVERSA
     public function product(){
        return $this->belongsTo(Product::class); 
     }

    //  RELACIONES UNO A MUCHOS
     public function movement_sales(){
        return $this->belongsTo(MovementSale::class); 
     }




}
