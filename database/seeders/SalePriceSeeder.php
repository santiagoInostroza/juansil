<?php

namespace Database\Seeders;

use App\Models\SalePrice;
use Illuminate\Database\Seeder;

class SalePriceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        SalePrice::create([
            'product_id'=>'1',
            'quantity'=>'1',
            'price'=>'800.0',
            'total_price'=>'800.0',
           ]);
        SalePrice::create([
            'product_id'=>'1',
            'quantity'=>'12',
            'price'=>'750',
            'total_price'=>'9000',
           ]);
        SalePrice::create([
            'product_id'=>'2',
            'quantity'=>'12',
            'price'=>'460',
            'total_price'=>'5520',
           ]);
        SalePrice::create([
            'product_id'=>'3',
            'quantity'=>'1',
            'price'=>'5600',
            'total_price'=>'5600',
           ]);
        
    }
}
