<?php

use Illuminate\Database\Seeder;

class PerPageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('per_pages')->insert([
            'valor' => 5,
            'nome' => 'Mostrar 5 resultados',
        ]);
        DB::table('per_pages')->insert([
            'valor' => 10,
            'nome' => 'Mostrar 10 resultados',
        ]);
        DB::table('per_pages')->insert([
            'valor' => 15,
            'nome' => 'Mostrar 15 resultados',
        ]);
        DB::table('per_pages')->insert([
            'valor' => 20,
            'nome' => 'Mostrar 20 resultados',
        ]);
        DB::table('per_pages')->insert([
            'valor' => 30,
            'nome' => 'Mostrar 30 resultados',
        ]);
        DB::table('per_pages')->insert([
            'valor' => 40,
            'nome' => 'Mostrar 40 resultados',
        ]);
        DB::table('per_pages')->insert([
            'valor' => 50,
            'nome' => 'Mostrar 50 resultados',
        ]);
    }
}
