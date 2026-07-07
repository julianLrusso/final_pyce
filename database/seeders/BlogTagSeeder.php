<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BlogTagSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('blog_tags')->insert([
            [
                'name'=>'Felicidad',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name'=>'Bienvenida',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name'=>'Tristeza',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name'=>'Juegos',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name'=>'Precios',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name'=>'Alerta',
                'created_at' => now(),
                'updated_at' => now()
            ]
        ]);
    }
}
