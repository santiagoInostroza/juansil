<?php

namespace Database\Seeders;

use App\Models\Purchase;
use Illuminate\Database\Seeder;

class PurchaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //COMPRA 1
      /*  $purchase = Purchase::create([
            'supplier_id' => '1',
            'total' => '150000',
            'fecha' => '2021-02-15',
            'comments' => 'Compra efectuada a colun'
        ]);


        $purchase->products()->attach([
            [
                'product_id' => '1',
                'cantidad' => '10',
                'cantidad_por_caja' => '12',
                'cantidad_total' => '120',
                'precio' => '1000',
                'precio_por_caja' => '10000',
                'total' => '100000',
            ],
            [
                'product_id' => '2',
                'cantidad' => '10',
                'cantidad_por_caja' => '12',
                'cantidad_total' => '120',
                'precio' => '1000',
                'precio_por_caja' => '10000',
                'total' => '100000',
            ]
        ]);*/
        /*Image::create([
            'url' => 'products/leche.png',
            'imageable_id' => $producto->id,
            'imageable_type' => Product::class,
        ]);*/
    }
}
