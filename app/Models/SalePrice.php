<?php

namespace App\Models;

use App\Models\Product;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class SalePrice extends Model
{
    use HasFactory;
    protected $fillable = ['product_id','quantity','price','total_price','special_price'];


     //RELACION UNO A MUCHOS INVERSA
     public function product()
     {
         return $this->belongsTo(Product::class);
         
     }

}
