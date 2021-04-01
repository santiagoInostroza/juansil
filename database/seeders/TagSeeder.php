<?php

namespace Database\Seeders;

use App\Models\Tag;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;

class TagSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {


        $brands = [
            [ 'Endulzantes','indigo'],
            [ 'Mayonesas','indigo'],
            [ 'Leches','indigo'],
            [ 'Aceite','indigo'],
            [ 'Azucar','indigo'],
            [ 'Atunes','indigo'],
            [ 'Salsas','indigo'],
            [ 'Pastas','indigo'],
            [ 'Arroz','indigo'],
            [ 'Snacks','pink'],
            [ 'Enlatados','pink'],
        ];
        
        foreach ($brands as  $brand) {
            Tag::create([
                'name'=>$brand[0],
                'slug'=>Str::slug($brand[0]),
                'color'=>$brand[1],
            ]);
        }
    }
}
