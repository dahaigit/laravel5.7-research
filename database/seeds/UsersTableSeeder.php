<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \DB::table('users')->insert([
            'name' => str_random(10),
            'email' => rand(10000,100000) . '@qq.com',
            'password' => \Hash::make('123456'),
        ]);
    }
}
