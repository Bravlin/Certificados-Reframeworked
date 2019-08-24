<?php

use Illuminate\Database\Seeder;

class CaracterTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('caracter')->insert(['caracter' => 'Asistente']);
        DB::table('caracter')->insert(['caracter' => 'Disertante']);
        DB::table('caracter')->insert(['caracter' => 'Evaluador']);
        DB::table('caracter')->insert(['caracter' => 'Organizador']);
    }
}
