<?php

namespace Database\Seeders;

use App\Models\Tag;
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
        Tag::create([
            'name'=>'Corta Fecha',
            'slug'=>'corta_fecha',
            'color'=>'red'
           ]);
        Tag::create([
            'name'=>'Promocion',
            'slug'=>'promocion',
            'color'=>'yellow'
           ]);
        Tag::create([
            'name'=>'2x1',
            'slug'=>'2x1',
            'color'=>'blue'
           ]);
    }
}
