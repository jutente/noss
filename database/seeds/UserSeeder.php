<?php

use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'name' => 'ju',
            'email' => 'ju@gmail.com',
            'password' => bcrypt('123456'),
            'acesso' => 'S',
            'perfil_id' => 1,
          
        ]);
    }
}
