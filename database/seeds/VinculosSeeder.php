<?php

use Illuminate\Database\Seeder;

class VinculosSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
		DB::table('vinculos')->insert([
            'nome' => 'FAMUC',
        ]);
        DB::table('vinculos')->insert([
            'nome' => 'PMC',
        ]);
    }
}
