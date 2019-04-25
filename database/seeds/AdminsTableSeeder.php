<?php

use Illuminate\Database\Seeder;
use App\Admin;
class AdminsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Admin::create([
        	'username' => 'admin',
        	'password' => bcrypt('admin12345'),
        	'remember_token' => str_random(10)
        ]);
    }
}
