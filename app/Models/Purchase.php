<?php

namespace App\Models;

use App\Models\User;
use App\Models\Product;
use App\Models\Supplier;
use App\Models\PurchaseItem;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Purchase extends Model
{
    use HasFactory;
    protected $guarded = ['id','created_at','updatd_at'];

      //RELACION UNO A MUCHOS INVERSA
      public function supplier()
      {
          return $this->belongsTo(Supplier::class);
          
      }

        public function purchase_items(){
            return $this->hasMany(PurchaseItem::class);
        }

      //RELACION MUCHOS A MUCHOS
    public function products(){
        return $this->belongsToMany(Product::class)
        ->withPivot('id','cantidad','cantidad_por_caja','cantidad_total','precio','precio_por_caja','total')
        ->withTimestamps();
    }

    
    public function created_by(){
        $user = User::find($this->user_created); 
        return $user;
    }

     
}
