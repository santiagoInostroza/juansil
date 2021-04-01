<?php

namespace Database\Seeders;

use App\Models\Brand;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;

class BrandSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() 
    {
        $names = [
            'Colun',
            'Traverso',
            'Soprole',
            'Tucapel',
            'La Patrona',
            'Iansa',
            'Rucas',
            'Kraft',
            'Daily',
            'Dorasol',
            'Robinson Crusoe',
            "D'ampezzo",
            "Vittorio",
            "Olivaz",
            "Antartic",
        ];
        
        foreach ($names as $name) {
            Brand::create([
                'name'=>$name,
                'slug'=>Str::slug($name),
               ]); 
        }
       
    }
}
