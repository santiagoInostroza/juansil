<?php

namespace Database\Seeders;

use App\Models\CustomerData;
use Illuminate\Database\Seeder;
use Database\Seeders\RoleSeeder;
use Database\Seeders\SaleSeeder;
use Database\Seeders\UserSeeder;
use Database\Seeders\BrandSeeder;
use Database\Seeders\ComunaSeeder;
use Database\Seeders\ProductSeeder;
use Database\Seeders\CategorySeeder;
use Database\Seeders\CustomerSeeder;
use Database\Seeders\SupplierSeeder;
use Database\Seeders\SalePriceSeeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
       $this->call(RoleSeeder::class);
       $this->call(UserSeeder::class);
       $this->call(CategorySeeder::class);
       $this->call(BrandSeeder::class);
       $this->call(TagSeeder::class);
       $this->call(ProductSeeder::class);
       $this->call(SalePriceSeeder::class);
       $this->call(SupplierSeeder::class);
       $this->call(PurchaseSeeder::class);
       $this->call(CustomerSeeder::class);
       $this->call(SaleSeeder::class);
       $this->call(ComunaSeeder::class);

       


    }
}
