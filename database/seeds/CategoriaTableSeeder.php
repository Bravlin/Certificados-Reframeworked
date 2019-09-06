<?php

use Illuminate\Database\Seeder;

class CategoriaTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('categoria')->insert(['nombre' => 'Alimentos']);
        DB::table('categoria')->insert(['nombre' => 'Computación']);
        DB::table('categoria')->insert(['nombre' => 'Eléctrica']);
        DB::table('categoria')->insert(['nombre' => 'Electromecánica']);
        DB::table('categoria')->insert(['nombre' => 'Electrónica']);
        DB::table('categoria')->insert(['nombre' => 'Industrial']);
        DB::table('categoria')->insert(['nombre' => 'Informática']);
        DB::table('categoria')->insert(['nombre' => 'Materiales']);
        DB::table('categoria')->insert(['nombre' => 'Mecánica']);
        DB::table('categoria')->insert(['nombre' => 'Química']);
    }
}
