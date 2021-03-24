<?php

namespace App\Models;

use App\Models\ProductMovement;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ProductPurchase extends Model
{
    use HasFactory;
    protected $guarded=[];
    
    protected $table = 'product_purchase';

    //RELACION 1 A 1 POLIMORFICA
    public function productMovements()
    {
       return $this->morphOne(ProductMovement::class,'itemable');
    }
}
