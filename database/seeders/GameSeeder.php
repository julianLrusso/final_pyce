<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class GameSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('games')->insert([
            [
                'title'        => 'Diablo 2',
                'description'  => 'Diablo II es un videojuego de rol de acción. Fue lanzado para Windows y Mac OS en el año 2000 por Blizzard Entertainment, y fue desarrollado por Blizzard North. Es la secuela directa de Diablo el exitoso juego de PC de lanzado en 1996. Diablo II fue uno de los juegos más populares del año 2000. Los principales factores que contribuyeron al éxito de Diablo II incluyen la continuación de los populares temas de fantasía oscura y terror del juego anterior, y su acceso al servicio de juego libre en línea, Battle.net',
                'price'        => '120000',
                'release_date' => '2000-06-29',
                'image'        => 'img/covers/diablo2.webp',
                'genre_id'     => 1,
                'created_at'   => now(),
                'updated_at'   => now()
            ],
            [
                'title'        => 'Toy Story Racer',
                'description'  => 'Toy Story Racer es un videojuego de carreras, basado en la película Toy Story, similar a la saga de juegos de Nintendo Mario Kart. El juego fue lanzado en el 2001 para las consolas PlayStation y Game Boy Color',
                'price'        => '90000',
                'release_date' => '2001-04-06',
                'image'        => 'img/covers/toystoryracer.webp',
                'genre_id'     => 4,
                'created_at'   => now(),
                'updated_at'   => now()
            ],
            [
                'title'        => 'Mario Kart 64',
                'description'  => 'Mario Kart 64 es un videojuego de carreras desarrollado y distribuido por Nintendo para la consola Nintendo 64. Es la segunda entrega de la serie Mario Kart y el sucesor de Super Mario Kart, de la consola SNES. Como su predecesor, es un juego de conducción de karts protagonizado por personajes famosos de Nintendo del Universo Mario, en el cual se tiene que vencer las copas en las distintas cilindradas.',
                'price'        => '180000',
                'release_date' => '1996-12-14',
                'image'        => 'img/covers/mariokart64.webp',
                'genre_id'     => 4,
                'created_at'   => now(),
                'updated_at'   => now()
            ],
            [
                'title'        => 'Mickey\'s Ultimate Challenge',
                'description'  => 'Mickey está acostado en la cama leyendo un libro de cuentos de hadas. Piensa para sí mismo lo maravilloso que sería vivir en una tierra lejana en un castillo mágico. Mickey se queda dormido y sueña que se entera de problemas en Beanswick. Hay un extraño estruendo en el castillo y nadie puede explicarlo. Mickey (o Minnie) se ofrece como voluntario para investigar. Debe superar una serie de desafíos en varias habitaciones del castillo para recolectar frijoles mágicos y artículos.',
                'price'        => '60000',
                'release_date' => '2000-06-29',
                'image'        => 'img/covers/mickeyuc.webp',
                'genre_id'     => 3,
                'created_at'   => now(),
                'updated_at'   => now()
            ]
        ]);

//        DB::table('users_have_games')->insert([
//            [
//                'user_id' => 2,
//                'game_id' => 1
//            ],
//            [
//                'user_id' => 2,
//                'game_id' => 4
//            ]
//        ]);
    }
}
