<?php

namespace App\Models;

use App\Models\Sale;
use App\Models\PurchaseItem;
use App\Models\PurchasePrice;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class MovementSale extends Model
{
    use HasFactory;
    protected $guarded = ['id','created_at','updated_at'];

     //RELACIONES UNO A MUCHOS INVERSA
    public function sale(){
        return $this->belongsTo(Sale::class);
    }
    public function purchase_price(){
        return $this->belongsTo(PurchasePrice::class);
    }
    public function product(){
        return $this->belongsTo(Product::class);
    }

}
