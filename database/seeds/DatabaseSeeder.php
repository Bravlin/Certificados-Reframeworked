<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(AdministradorTableSeeder::class);
        $this->call(ProvinciaTableSeeder::class);
        $this->call(CiudadTableSeeder::class);
        $this->call(CaracterTableSeeder::class);
        $this->call(CategoriaTableSeeder::class);
    }
}
