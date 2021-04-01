<?php

namespace Database\Seeders;

use App\Models\Customer;
use Illuminate\Support\Str;
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

       

       

        CustomerData::create([
            'total_credito' => 0,
        ]);
        $name = "Silvy Inostroza";
        Customer::create([
           'name' => $name,
           'slug' => Str::slug($name),
           'direccion' => 'Pelluco 0878',
           'comuna' => 'La granja',
           'customer_data_id' => 1,
        ]);

        CustomerData::create([
            'total_credito' => 0,
        ]);
        $name = "Shelly Inostroza";
        Customer::create([
           'name' => $name,
           'slug' => Str::slug($name),
           'direccion' => 'Los angeles 8280',
           'comuna' => 'La granja',
           'customer_data_id' => 2,
        ]);

        CustomerData::create([
            'total_credito' => 0,
        ]);
        $name = "Dany Pando";
        Customer::create([
           'name' => $name,
           'slug' => Str::slug($name),
           'direccion' => 'Pelluco 0878',
           'comuna' => 'La granja',
           'customer_data_id' => 3,
        ]);

     
    }
}
