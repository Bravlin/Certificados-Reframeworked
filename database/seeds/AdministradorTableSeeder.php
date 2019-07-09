<?php

use Illuminate\Database\Seeder;

class AdministradorTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('administrador')->insert([
            'email' => 'administrador@ficertif.com',
            'password' => bcrypt('admin')
        ]);
    }
}
