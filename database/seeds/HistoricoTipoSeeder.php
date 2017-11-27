<?php

use Illuminate\Database\Seeder;

class HistoricoTipoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('historico_tipos')->insert([
            'descricao' => 'Enviado para arquivo morto',
        ]);
        DB::table('historico_tipos')->insert([
            'descricao' => 'Removido do arquivo morto',
        ]);
        DB::table('historico_tipos')->insert([
            'descricao' => 'Adicionado a uma equipe',
        ]);
        DB::table('historico_tipos')->insert([
            'descricao' => 'Exoneração',
        ]);
        DB::table('historico_tipos')->insert([
            'descricao' => 'Cadastro do profissional foi alterado',
        ]);
        DB::table('historico_tipos')->insert([
            'descricao' => 'Transferência',
        ]);
        DB::table('historico_tipos')->insert([
            'descricao' => 'Fim de contrato',
        ]);
        DB::table('historico_tipos')->insert([
            'descricao' => '',
        ]);
        DB::table('historico_tipos')->insert([
            'descricao' => '',
        ]);
        DB::table('historico_tipos')->insert([
            'descricao' => 'Licença ou afastamento excluído',
        ]);
    }
}
