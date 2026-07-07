<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class GameGenreSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('game_genres')->insert([
            [
                'name'=>'Rol',
                'created_at' => now()
            ],
            [
                'name'=>'Acción',
                'created_at' => now()
            ],
            [
                'name'=>'Aventura',
                'created_at' => now()
            ],
            [
                'name'=>'Carreras',
                'created_at' => now()
            ],
            [
                'name'=>'Simulación',
                'created_at' => now()
            ]
        ]);
    }
}
