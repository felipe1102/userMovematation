<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserMovementeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('user_movements')->insert([
            'id_user' => 1,
            'value' => 500.00,
            'type' => 'debit',
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
        ]);

        DB::table('user_movements')->insert([
            'id_user' => 1,
            'value' => 30.00,
            'type' => 'credit',
            'reversed' => 1,
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
        ]);

        DB::table('user_movements')->insert([
            'id_user' => 2,
            'value' => 80.00,
            'type' => 'credit',
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
        ]);

        DB::table('user_movements')->insert([
            'id_user' => 1,
            'value' => 500.00,
            'type' => 'credit',
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
        ]);

        DB::table('user_movements')->insert([
            'id_user' => 1,
            'value' => 100.00,
            'type' => 'debit',
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
        ]);


        DB::table('user_movements')->insert([
            'id_user' => 2,
            'value' => 400.00,
            'type' => 'debit',
            'reversed' => 1,
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
        ]);

        DB::table('user_movements')->insert([
            'id_user' => 1,
            'value' => 340.00,
            'type' => 'credit',
            'reversed' => 1,
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
        ]);

        DB::table('user_movements')->insert([
            'id_user' => 2,
            'value' => 754.00,
            'type' => 'credit',
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
        ]);

        DB::table('user_movements')->insert([
            'id_user' => 1,
            'value' => 50.00,
            'type' => 'credit',
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
        ]);

        DB::table('user_movements')->insert([
            'id_user' => 2,
            'value' => 120.00,
            'type' => 'debit',
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
        ]);
    }
}
