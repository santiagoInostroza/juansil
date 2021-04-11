<?php

namespace App\Models;

use App\Models\Sale;
use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Pay extends Model{
    use HasFactory;

      //RELACION MUCHOS A MUCHOS
      public function sales(){
        return $this->belongsToMany(Sale::class);
    }

    public function created_by()
    {
      return User::find($this->user_created);
    }
}
