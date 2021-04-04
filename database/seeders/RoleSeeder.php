<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RoleSeeder extends Seeder
{
    
    public function run()
    {
       
      $superAdmin = Role::create(['name' => 'SuperAdmin']);
      $admin = Role::create(['name' => 'Admin']);
      $vendedor = Role::create(['name' => 'Vendedor']);
      $chofer = Role::create(['name' => 'Chofer']);
      $cliente = Role::create(['name' => 'Cliente']);

      Permission::create(['name' => 'admin.home','description'=>'Ver el dashboard'])->syncRoles([$superAdmin,$admin,$vendedor,$cliente]);

      Permission::create(['name' => 'admin.users.index','description'=>'Ver listado de usuarios'])->syncRoles([$superAdmin]);
      Permission::create(['name' => 'admin.users.edit','description'=>'Asignar rol'])->syncRoles([$superAdmin]);

      Permission::create(['name' => 'admin.categories.index','description'=>'Ver listado de categorias'])->syncRoles([$superAdmin, $admin ]);
      Permission::create(['name' => 'admin.categories.create','description'=>'Crear categorias'])->syncRoles([$superAdmin, $admin ]);
      Permission::create(['name' => 'admin.categories.edit','description'=>'Editar categorias'])->syncRoles([$superAdmin, $admin ]);
      Permission::create(['name' => 'admin.categories.destroy','description'=>'Eliminar categorias'])->syncRoles([$superAdmin, $admin ]);

      Permission::create(['name' => 'admin.tags.index','description'=>'Ver listado de etiquetas'])->syncRoles([$superAdmin, $admin]);
      Permission::create(['name' => 'admin.tags.create','description'=>'Crear etiquetas'])->syncRoles([$superAdmin, $admin]);
      Permission::create(['name' => 'admin.tags.edit','description'=>'Editar etiquetas'])->syncRoles([$superAdmin, $admin]);
      Permission::create(['name' => 'admin.tags.destroy','description'=>'Eliminar etiquetas'])->syncRoles([$superAdmin, $admin]);

      Permission::create(['name' => 'admin.products.index','description'=>'Ver listado de productos'])->syncRoles([ $superAdmin, $admin ]);
      Permission::create(['name' => 'admin.products.create','description'=>'Crear productos'])->syncRoles([ $superAdmin, $admin]);
      Permission::create(['name' => 'admin.products.edit','description'=>'Editar productos'])->syncRoles([ $superAdmin, $admin ]);
      Permission::create(['name' => 'admin.products.destroy','description'=>'Eliminar productos'])->syncRoles([ $superAdmin, $admin ]);

      Permission::create(['name' => 'admin.purchases.index','description'=>'Ver listado de productos'])->syncRoles([ $superAdmin, $admin ]);
      Permission::create(['name' => 'admin.purchases.create','description'=>'Crear productos'])->syncRoles([ $superAdmin, $admin]);
      Permission::create(['name' => 'admin.purchases.edit','description'=>'Editar productos'])->syncRoles([ $superAdmin, $admin ]);
      Permission::create(['name' => 'admin.purchases.destroy','description'=>'Eliminar productos'])->syncRoles([ $superAdmin, $admin ]);

      Permission::create(['name' => 'admin.sales.index','description'=>'Ver listado de ventas'])->syncRoles([$superAdmin, $admin, $vendedor]);
      Permission::create(['name' => 'admin.sales.create','description'=>'Crear ventas'])->syncRoles([$superAdmin, $admin, $vendedor]);
      Permission::create(['name' => 'admin.sales.edit','description'=>'Editar ventas'])->syncRoles([$superAdmin, $admin, $vendedor]);
      Permission::create(['name' => 'admin.sales.destroy','description'=>'Eliminar ventas'])->syncRoles([$superAdmin, $admin, $vendedor]);

      Permission::create(['name' => 'admin.deliveries.index','description'=>'Ver listado de repartos'])->syncRoles([$superAdmin, $admin, $chofer]);
      Permission::create(['name' => 'admin.deliveries.create','description'=>'Crear repartos'])->syncRoles([$superAdmin, $admin, $chofer]);
      Permission::create(['name' => 'admin.deliveries.edit','description'=>'Editar repartos'])->syncRoles([$superAdmin, $admin, $chofer]);
      Permission::create(['name' => 'admin.deliveries.destroy','description'=>'Eliminar repartos'])->syncRoles([$superAdmin, $admin, $chofer]);


      
    }
}
