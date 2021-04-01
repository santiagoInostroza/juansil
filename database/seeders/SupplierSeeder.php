<?php

namespace Database\Seeders;

use App\Models\Supplier;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;

class SupplierSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $names = [
            'Ajuste de Stock',
            'Colun',
            'Bodegas Sumar',
        ];
        
        foreach ($names as  $name) {
            Supplier::create([
                'name'=>$name,
                'slug'=>Str::slug($name),
            ]);
        }

     
    }
}
