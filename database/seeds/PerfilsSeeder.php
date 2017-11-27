<?php

use Illuminate\Database\Seeder;

class PerfilsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('perfils')->insert([
            'descricao' => 'administrador',
        ]);
        DB::table('perfils')->insert([
            'descricao' => 'operador',
        ]);
        DB::table('perfils')->insert([
            'descricao' => 'leitura',
        ]);

    }
}
