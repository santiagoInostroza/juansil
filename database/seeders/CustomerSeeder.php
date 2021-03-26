<?php

namespace Database\Seeders;

use App\Models\Customer;
use App\Models\CustomerData;
use Illuminate\Database\Seeder;

class CustomerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

       
       Customer::create([
           'name' => 'Ajuste de Stock',
           'slug' => 'ajuste-de-stock',
       ]);

    //     CustomerData::create([
    //         'total_credito' => 0,
    //         ]);
    //    Customer::create([
    //        'name' => 'Silvy Inostroza',
    //        'slug' => 'silvy-inostroza',
    //        'direccion' => 'Pelluco 0878',
    //        'comuna' => 'La granja',
    //        'customer_data_id' => 1,
    //    ]);

       
    //    CustomerData::create([
    //     'total_credito' => 0,
    //     ]);


    //    Customer::create([
    //        'name' => 'Shelly Inostroza',
    //        'slug' => 'shelly-inostroza',
    //        'direccion' => 'Los angeles 8280',
    //        'comuna' => 'La granja',
    //        'customer_data_id' => 2,
    //    ]);

    //    CustomerData::create([
    //     'total_credito' => 0,
    //     ]);

    //    Customer::create([
    //     'name' => 'Daniel Pando',
    //     'slug' => 'daniel-pando',
    //     'direccion' => 'Pelluco 0878',
    //     'comuna' => 'La granja',
    //     'customer_data_id' => 3,
    // ]);

     
    }
}
