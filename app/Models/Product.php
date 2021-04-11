<?php

namespace App\Models;

use App\Models\Tag;
use App\Models\Brand;
use App\Models\Image;
use App\Models\Category;
use App\Models\Purchase;
use App\Models\SaleItem;
use App\Models\SalePrice;
use App\Models\PurchasePrice;
use App\Models\ProductMovement;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Product extends Model
{
    use HasFactory;
    //protected $fillable=['name','slug'];
    protected $guarded = ['id','created_at','updated_at'];

    //RELACION UNO A MUCHOS INVERSA
    public function category()
    {
        return $this->belongsTo(Category::class);
        
    }
    //RELACION UNO A MUCHOS INVERSA
    public function brand()
    {
        return $this->belongsTo(Brand::class);
        
    }

    //RELACION MUCHOS A MUCHOS
    public function tags()
    {
        return $this->belongsToMany(Tag::class);
    }

    //RELACION 1 A 1 POLIMORFICA
    public function image()
    {
       return $this->morphOne(Image::class,'imageable');
    }

    public function salePrices(){
        return $this->hasMany(SalePrice::class);
    }

    public function getRouteKeyName()
    {
        return 'slug';
    }

    //RELACION MUCHOS A MUCHOS
    public function purchases(){
        return $this->belongsToMany(Purchase::class);
    }

    public function movements()
    {
        return $this->hasMany(ProductMovement::class);
        //return $this->belongsTo(Producto::class);
    }

    public function purchasePrices()
    {
        return $this->hasMany(PurchasePrice::class);
        //return $this->belongsTo(Producto::class);
    }

    public function sale_items()
    {
        return $this->hasMany(SaleItem::class);
      
    }

}
