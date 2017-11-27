<?php

use Illuminate\Database\Seeder;

class CargaHorariasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('carga_horarias')->insert([
            'nome' => '20 h/semana',
        ]);
        DB::table('carga_horarias')->insert([
            'nome' => '30 h/semana',
        ]);
        DB::table('carga_horarias')->insert([
            'nome' => '40 h/semana',
        ]);
    }
}
