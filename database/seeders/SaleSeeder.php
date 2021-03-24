<?php

namespace Database\Seeders;

use App\Models\Sale;
use App\Models\SaleItem;
use Illuminate\Database\Seeder;

class SaleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
       $sale = Sale::create([
           'customer_id' => '1',
           'total' => '150000',
           'date' => '2021-01-27',
           'payment_amount' => '150000',
           'payment_status' => '3',
           'pending_amount' => '0',
           'delivery' => '0',
           'delivery_date' => null,
           'delivery_stage' => null,
           'comments' => '',
       ]);
       SaleItem::create([
        'sale_id' => $sale->id,
        'product_id' => 1,
        'cantidad' => 10,
        'cantidad_por_caja' => 12,
        'cantidad_total' => 120,
        'precio' => 9800,
        'precio_por_caja' => 19800,
        'precio_total' => 198000,
       ]);
       SaleItem::create([
        'sale_id' => $sale->id,
        'product_id' => 2,
        'cantidad' => 20,
        'cantidad_por_caja' => 24,
        'cantidad_total' => 480,
        'precio' => 460,
        'precio_por_caja' => 15000,
        'precio_total' => 3500000,
       ]);

        $sale = Sale::create([
           'customer_id' => '1',
           'total' => '270000',
           'date' => '2021-01-27',
           'payment_amount' => '270000',
           'payment_status' => '3',
           'pending_amount' => '0',
           'delivery' => '1',
           'delivery_date' => '2021-01-27',
           'delivery_stage' =>'1',
           'comments' => '',
       ]);

       SaleItem::create([
        'sale_id' => $sale->id,
        'product_id' => 1,
        'cantidad' => 10,
        'cantidad_por_caja' => 12,
        'cantidad_total' => 120,
        'precio' => 9800,
        'precio_por_caja' => 19800,
        'precio_total' => 198000,
       ]);
       SaleItem::create([
        'sale_id' => $sale->id,
        'product_id' => 1,
        'cantidad' => 10,
        'cantidad_por_caja' => 12,
        'cantidad_total' => 120,
        'precio' => 9800,
        'precio_por_caja' => 19800,
        'precio_total' => 198000,
       ]);

       $sale = Sale::create([
           'customer_id' => '2',
           'total' => '327000',
           'date' => '2021-02-15',
           'payment_amount' => '127000',
           'payment_status' => '2',
           'pending_amount' => '200000',
           'delivery' => '1',
           'delivery_date' => '2021-03-01',
           'delivery_stage' => '0',
           'comments' => 'Entregar en la mañana',
       ]);
       SaleItem::create([
        'sale_id' => $sale->id,
        'product_id' => 1,
        'cantidad' => 10,
        'cantidad_por_caja' => 12,
        'cantidad_total' => 120,
        'precio' => 9800,
        'precio_por_caja' => 19800,
        'precio_total' => 198000,
       ]);
       SaleItem::create([
        'sale_id' => $sale->id,
        'product_id' => 1,
        'cantidad' => 10,
        'cantidad_por_caja' => 12,
        'cantidad_total' => 120,
        'precio' => 9800,
        'precio_por_caja' => 19800,
        'precio_total' => 198000,
       ]);

       $sale = Sale::create([
           'customer_id' => '2',
           'total' => '122000',
           'date' => '2021-02-22',
           'payment_amount' => '0',
           'payment_status' => '1',
           'pending_amount' => '327000',
           'delivery' => '1',
           'delivery_date' => '2021-03-01',
           'delivery_stage' => '0',
           'comments' => 'Entregar en la mañana',
       ]);
       SaleItem::create([
        'sale_id' => $sale->id,
        'product_id' => 1,
        'cantidad' => 10,
        'cantidad_por_caja' => 12,
        'cantidad_total' => 120,
        'precio' => 9800,
        'precio_por_caja' => 19800,
        'precio_total' => 198000,
       ]);
       SaleItem::create([
        'sale_id' => $sale->id,
        'product_id' => 1,
        'cantidad' => 10,
        'cantidad_por_caja' => 12,
        'cantidad_total' => 120,
        'precio' => 9800,
        'precio_por_caja' => 19800,
        'precio_total' => 198000,
       ]);


      
    }
}
