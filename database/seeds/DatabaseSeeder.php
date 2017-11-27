<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->call(PerfilsSeeder::class);
    	$this->call(PerPageSeeder::class);
    	$this->call(UserSeeder::class);
    	$this->call(DistritosTableSeeder::class);
        $this->call(CargaHorariasSeeder::class);
        $this->call(VinculosSeeder::class);
    }
}
