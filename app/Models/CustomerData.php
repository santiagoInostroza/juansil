<?php

namespace App\Models;

use App\Models\Customer;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class CustomerData extends Model
{
    use HasFactory;

    protected $guarded = [];


    public function customer()
    {
        return $this->hasMany(Customer::class);
        //return $this->belongsTo(Producto::class);
    }

}
