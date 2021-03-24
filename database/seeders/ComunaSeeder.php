<?php

namespace Database\Seeders;

use App\Models\Comuna;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;

class ComunaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $name="CERRILLOS";
        Comuna::create([
            'name' => $name,
            'slug' => Str::slug($name),
            'valor_despacho' => '2990',
            'dia' => '0',
            'sector' => '2',
            'descuento' => '0',
            
        ]);
        $name="CERRO NAVIA";
        Comuna::create([
            'name' => $name,
            'slug' => Str::slug($name),
            'valor_despacho' => '2990',
            'dia' => '2',
            'sector' => '3',
            'descuento' => '1000',
        ]);
        $name="CONCHALÍ";
        Comuna::create([
            'name' => $name,
            'slug' => Str::slug($name),
            'valor_despacho' => '2990',
            'dia' => '2',
            'sector' => '3',
            'descuento' => '1000',
        ]);
        $name="EL BOSQUE";
        Comuna::create([
            'name' => $name,
            'slug' => Str::slug($name),
            'valor_despacho' => '2990',
            'dia' => '0',
            'sector' => '2',
            'descuento' => '0',
        ]);
        $name="ESTACIÓN CENTRAL";
        Comuna::create([
            'name' => $name,
            'slug' => Str::slug($name),
            'valor_despacho' => '2990',
            'dia' => '0',
            'sector' => '2',
            'descuento' => '0',
        ]);
        $name="HUECHURABA";
        Comuna::create([
            'name' => $name,
            'slug' => Str::slug($name),
            'valor_despacho' => '4990',
            'dia' => '2',
            'sector' => '4',
            'descuento' => '2000',
        ]);
        $name="INDEPENDENCIA";
        Comuna::create([
            'name' => $name,
            'slug' => Str::slug($name),
            'valor_despacho' => '2990',
            'dia' => '2',
            'sector' => '3',
            'descuento' => '1000',
        ]);
        $name="LA CISTERNA";
        Comuna::create([
            'name' => $name,
            'slug' => Str::slug($name),
            'valor_despacho' => '2990',
            'dia' => '0',
            'sector' => '2',
            'descuento' => '0',

        ]);
        $name="LA FLORIDA";
        Comuna::create([
            'name' => $name,
            'slug' => Str::slug($name),
            'valor_despacho' => '2990',
            'dia' => '0',
            'sector' => '2',
            'descuento' => '0',
        ]);
        $name="LA GRANJA";
        Comuna::create([
            'name' => $name,
            'slug' => Str::slug($name),
            'valor_despacho' => '2990',
            'dia' => '2',
            'sector' => '2',
            'descuento' => '1000',
        ]);
        $name="LA PINTANA";
        Comuna::create([
            'name' => $name,
            'slug' => Str::slug($name),
            'valor_despacho' => '2990',
            'dia' => '0',
            'sector' => '2',
            'descuento' => '0',
        ]);
        $name="LA REINA";
        Comuna::create([
            'name' => $name,
            'slug' => Str::slug($name),
            'valor_despacho' => '3990',
            'dia' => '3',
            'sector' => '3',
            'descuento' => '1000',
        ]);
        $name="LAS CONDES";
        Comuna::create([
            'name' => $name,
            'slug' => Str::slug($name),
            'valor_despacho' => '4990',
            'dia' => '3',
            'sector' => '4',
            'descuento' => '2000',
        ]);
        $name="LO BARNECHEA";
        Comuna::create([
            'name' => $name,
            'slug' => Str::slug($name),
            'valor_despacho' => '8990',
            'dia' => '4',
            'sector' => '5',
            'descuento' => '4000',
        ]);
        $name="LO ESPEJO";
        Comuna::create([
            'name' => $name,
            'slug' => Str::slug($name),
            'valor_despacho' => '2990',
            'dia' => '0',
            'sector' => '2',
            'descuento' => '0',
        ]);
        $name="LO PRADO";
        Comuna::create([
            'name' => $name,
            'slug' => Str::slug($name),
            'valor_despacho' => '2990',
            'dia' => '2',
            'sector' => '3',
            'descuento' => '1000',
        ]);
        $name="MACUL";
        Comuna::create([
            'name' => $name,
            'slug' => Str::slug($name),
            'valor_despacho' => '2990',
            'dia' => '0',
            'sector' => '2',
            'descuento' => '0',
        ]);
        $name="MAIPÚ";
        Comuna::create([
            'name' => $name,
            'slug' => Str::slug($name),
            'valor_despacho' => '4990',
            'dia' => '1',
            'sector' => '4',
            'descuento' => '2000',
        ]);
        $name="ÑUÑOA";
        Comuna::create([
            'name' => $name,
            'slug' => Str::slug($name),
            'valor_despacho' => '2990',
            'dia' => '0',
            'sector' => '2',
            'descuento' => '0',
        ]);
        $name="PADRE HURTADO";
        Comuna::create([
            'name' => $name,
            'slug' => Str::slug($name),
            'valor_despacho' => '4990',
            'dia' => '1',
            'sector' => '4',
            'descuento' => '2000',
        ]);
        $name="PEDRO AGUIRRE CERDA";
        Comuna::create([
            'name' => $name,
            'slug' => Str::slug($name),
            'valor_despacho' => '2990',
            'dia' => '0',
            'sector' => '2',
            'descuento' => '0',
        ]);
        $name="PEÑALOLÉN";
        Comuna::create([
            'name' => $name,
            'slug' => Str::slug($name),
            'valor_despacho' => '2990',
            'dia' => '0',
            'sector' => '2',
            'descuento' => '0',
        ]);
        $name="PROVIDENCIA";
        Comuna::create([
            'name' => $name,
            'slug' => Str::slug($name),
            'valor_despacho' => '2990',
            'dia' => '0',
            'sector' => '2',
            'descuento' => '0',
        ]);
        $name="PUDAHUEL";
        Comuna::create([
            'name' => $name,
            'slug' => Str::slug($name),
            'valor_despacho' => '4990',
            'sector' => '4',
            'dia' => '1',
            'sector' => '3',
            'descuento' => '1000',
        ]);
        $name="PUENTE ALTO";
        Comuna::create([
            'name' => $name,
            'slug' => Str::slug($name),
            'valor_despacho' => '2990',
            'dia' => '0',
            'sector' => '2',
            'descuento' => '0',
        ]);
        $name="QUILICURA";
        Comuna::create([
            'name' => $name,
            'slug' => Str::slug($name),
            'valor_despacho' => '4990',
            'dia' => '2',
            'sector' => '3',
            'descuento' => '0',
        ]);
        $name="QUINTA NORMAL";
        Comuna::create([
            'name' => $name,
            'slug' => Str::slug($name),
            'valor_despacho' => '2990',
            'dia' => '2',
            'sector' => '3',
            'descuento' => '1000',
        ]);
        $name="RECOLETA";
        Comuna::create([
            'name' => $name,
            'slug' => Str::slug($name),
            'valor_despacho' => '2990',
            'dia' => '2',
            'sector' => '3',
            'descuento' => '1000',
        ]);
        $name="RENCA";
        Comuna::create([
            'name' => $name,
            'slug' => Str::slug($name),
            'valor_despacho' => '2990',
            'dia' => '2',
            'sector' => '3',
            'descuento' => '1000',
        ]);
        $name="SAN BERNARDO";
        Comuna::create([
            'name' => $name,
            'slug' => Str::slug($name),
            'valor_despacho' => '2990',
            'dia' => '0',
            'sector' => '2',
            'descuento' => '0',
        ]);
        $name="SAN JOAQUÍN";
        Comuna::create([
            'name' => $name,
            'slug' => Str::slug($name),
            'valor_despacho' => '2990',
            'dia' => '0',
            'sector' => '2',
            'descuento' => '0',
        ]);
        $name="SAN MIGUEL";
        Comuna::create([
            'name' => $name,
            'slug' => Str::slug($name),
            'valor_despacho' => '2990',
            'dia' => '0',
            'sector' => '2',
            'descuento' => '0',
        ]);
        $name="SAN RAMÓN";
        Comuna::create([
            'name' => $name,
            'slug' => Str::slug($name),
            'valor_despacho' => '2990',
            'dia' => '0',
            'sector' => '2',
            'descuento' => '0',
        ]);
        $name="SANTIAGO";
        Comuna::create([
            'name' => $name,
            'slug' => Str::slug($name),
            'valor_despacho' => '2990',
            'dia' => '0',
            'sector' => '2',
            'descuento' => '0',
        ]);
        $name="VITACURA";
        Comuna::create([
            'name' => $name,
            'slug' => Str::slug($name),
            'valor_despacho' => '4990',
            'dia' => '3',
            'sector' => '4',
            'descuento' => '2000',
        ]);
    }
}
