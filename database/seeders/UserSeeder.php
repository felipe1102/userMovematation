<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

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
            'name' => 'João',
            'email' => 'joao@joao.com',
            'birthday' => '1996-05-07',
            'password' => Hash::make('123456'),
        ]);

        DB::table('users')->insert([
            'name' => 'Maria',
            'email' => 'maria@maria.com',
            'birthday' => '2000-08-10',
            'password' => Hash::make('123456'),
        ]);
    }
}
