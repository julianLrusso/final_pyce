<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PurchaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('purchases')->insert([
            [
                'total_amount' => 120000,
                'status'       => 1,
                'user_id'      => 2,
                'created_at'   => now(),
                'updated_at'   => now()
            ],
            [
                'total_amount' => 270000,
                'status'       => 1,
                'user_id'      => 2,
                'created_at'   => now(),
                'updated_at'   => now()
            ],
            [
                'total_amount' => 180000,
                'status'       => 0,
                'user_id'      => 2,
                'created_at'   => now(),
                'updated_at'   => now()
            ]
        ]);

        DB::table('purchases_have_games')->insert([
            [
                'purchase_id'      => 1,
                'game_id'          => 1,
                'individual_price' => 120000,
                'quantity'         => 1
            ],
            [
                'purchase_id'      => 2,
                'game_id'          => 2,
                'individual_price' => 90000,
                'quantity'         => 1
            ],
            [
                'purchase_id'      => 2,
                'game_id'          => 3,
                'individual_price' => 180000,
                'quantity'         => 1
            ],
            [
                'purchase_id'      => 3,
                'game_id'          => 4,
                'individual_price' => 60000,
                'quantity'         => 3
            ]
        ]);
    }
}
