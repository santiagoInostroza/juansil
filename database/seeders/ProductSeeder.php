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
            $producto = Product::create([
                'name' => 'Leche Colun Entera 1 litro',
                'slug' => 'leche-colun-entera-1-litro',
                'stock' => 120,
                'status' => 1,
                'category_id' => '1',
                'brand_id' => '1'
            ]);
            $producto->tags()->attach([1, 2]);
            /*Image::create([
                'url' => 'products/leche.png',
                'imageable_id' => $producto->id,
                'imageable_type' => Product::class,
            ]);*/


                //PRODUCTO 2
            $producto = Product::create([
                'name' => 'Pastas Vitorio x 12',
                'slug' => 'pastas-vitorio-x-12',
                'stock' => 24,
                'status' => 1,
                'category_id' => '2',
                'brand_id' => '2'
            ]);
            $producto->tags()->attach([2, 3]);
            /*Image::create([
                'url' => 'products/fideos.png',
                'imageable_id' => $producto->id,
                'imageable_type' => Product::class,
            ]);*/



            //Producto 3
            $producto = Product::create([
                'name' => 'Detergente Omo matic 400g x 24',
                'slug' => 'detergente-omo-matic-400g-x-24',
                'stock' => 240,
                'status' => 1,
                'category_id' => '3',
                'brand_id' => '3'
            ]);
            $producto->tags()->attach([1, 3]);
           /* Image::create([
                'url' => 'products/omo.png',
                'imageable_id' => $producto->id,
                'imageable_type' => Product::class,
            ]);*/
        
    }
}
