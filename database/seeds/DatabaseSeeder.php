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
        for ($i=0; $i < 5; $i++) { 

        	DB::table('users')->insert([
	            'name' => "admin".$i,
	            'email' => "admin".$i.'@gmail.com',
	            'password' => bcrypt('admin'.$i),
	            'role' => 'admin',
                'confirmed' => '0',
                'confirmation_code' => str_random(30),
        	]);
        }
    }
}
