<?php

namespace App\Models;

use App\Models\User;
use App\Models\Customer;
use App\Models\SaleItem;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Sale extends Model
{
    use HasFactory;
    protected $guarded = ['id','created_at','updated_at'];

     //RELACION UNO A MUCHOS INVERSA
     public function customer()
     {
         return $this->belongsTo(Customer::class);
         
     }

     public function sale_items()
    {
        return $this->hasMany(SaleItem::class);
      
    }

    public function created_by()
    {
        $user = User::find($this->user_created); 
        return $user;
    }

    


}
