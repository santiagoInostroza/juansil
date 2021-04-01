<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $names = [
            'Lacteos',
            'Abarrotes',
            'Articulos de aseo',
        ];
        
        foreach ($names as  $name) {
            Category::create([
                'name'=>$name,
                'slug'=>Str::slug($name),
               ]);
        }
        
       
       
       
        
    }
}
