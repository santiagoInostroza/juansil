<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RoleSeeder extends Seeder
{
    
    public function run()
    {
       
      $role1 = Role::create(['name' => 'SuperAdmin']);
      $role2 = Role::create(['name' => 'Admin']);
      $role3 = Role::create(['name' => 'Vendedor']);
      $role4 = Role::create(['name' => 'Chofer']);
      $role5 = Role::create(['name' => 'Cliente']);

      Permission:: create(['name' => 'admin.home'])->syncRoles([$role1,$role2,$role3,$role4]);

      Permission:: create(['name' => 'admin.categories.index'])->syncRoles([$role1,$role2,$role3,$role4]);
      Permission:: create(['name' => 'admin.categories.create'])->syncRoles([$role1,$role2,$role3,$role4]);
      Permission:: create(['name' => 'admin.categories.edit'])->syncRoles([$role1,$role2,$role3,$role4]);
      Permission:: create(['name' => 'admin.categories.destroy'])->syncRoles([$role1,$role2,$role3,$role4]);

      Permission:: create(['name' => 'admin.tags.index'])->syncRoles([$role1,$role2,$role3,$role4]);
      Permission:: create(['name' => 'admin.tags.create'])->syncRoles([$role1,$role2,$role3,$role4]);
      Permission:: create(['name' => 'admin.tags.edit'])->syncRoles([$role1,$role2,$role3,$role4]);
      Permission:: create(['name' => 'admin.tags.destroy'])->syncRoles([$role1,$role2,$role3,$role4]);

      Permission:: create(['name' => 'admin.products.index'])->syncRoles([$role1,$role2,$role3,$role4]);
      Permission:: create(['name' => 'admin.products.create'])->syncRoles([$role1,$role2,$role3,$role4]);
      Permission:: create(['name' => 'admin.products.edit'])->syncRoles([$role1,$role2,$role3,$role4]);
      Permission:: create(['name' => 'admin.products.destroy'])->syncRoles([$role1,$role2,$role3,$role4]);

      
    }
}
