<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BlogSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('blogs')->insert([
            [
                'title'=>'Abrimos',
                'text'=>'Nos complace anunciar que abrimos las puertas de la carreta ambulante. Los viajantes podrán descansar aquí y comprar provisiones para los tiempos libres.',
                'user_id'=>1,
                'category_id'=>1,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'title'=>'Aumentamos los precios',
                'text'=>'Como todos saben, la cosa está difícil. El alquiler de la carretilla sube sin parar. Lamentablemente voy a tener que subir los precios para subsistir. Deberán matar más monstruos para juntar esas monedas doradas si quieren comprar algo.',
                'user_id'=>1,
                'category_id'=>2,
                'created_at' => now(),
                'updated_at' => now()
            ],
        ]);
    }
}
