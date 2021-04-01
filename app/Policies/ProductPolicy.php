<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Product;
use Illuminate\Auth\Access\HandlesAuthorization;

class ProductPolicy
{
    use HandlesAuthorization;

    public function author(User $user, Product $product)
    {
      return true;
    }

    public function published(?User $user, Product $product)
    {
      if($product->status==1){
        return true;
      }else{
          return false;
      }
    }


}
