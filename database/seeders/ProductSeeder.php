<?php

namespace Database\Seeders;

use App\Models\Tag;
use App\Models\Image;
use App\Models\Product;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Storage;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {


        
            //PRODUCTO 1
           /* $producto = Product::create([
                'name' => 'Leche Colun Entera 1 litro',
                'slug' => 'leche-colun-entera-1-litro',
                'stock' => 120,
                'status' => 1,
                'category_id' => '1',
                'brand_id' => '1'
            ]);
            $producto->tags()->attach([1, 2]);
            Image::create([
                'url' => 'products/leche.png',
                'imageable_id' => $producto->id,
                'imageable_type' => Product::class,
            ]);*/




        
    }
}
