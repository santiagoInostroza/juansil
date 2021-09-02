<?php

namespace App\Models;

use App\Models\Sale;
use App\Models\CustomerData;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Customer extends Model
{
    use HasFactory;
    
    protected $guarded = ['id','created_at','updated_at'];

    // public function getRouteKeyName()
    // {
    //     return 'slug';
    // }


      //RELACION UNO A MUCHOS INVERSA
      public function customer_data()
      {
          return $this->belongsTo(CustomerData::class);
          
      }

      public function sales(){
          return $this->hasMany(Sale::class);
          //return $this->belongsTo(Producto::class);
      }

      public function pending(){
          $pending = Sale::where('customer_id',$this->id)->where('payment_status',"!=", 3)->get();
          return $pending;
      }

      //RELACION UNO A MUCHOS INVERSA
     public function user(){
        return $this->belongsTo(User::class);
    }


}
