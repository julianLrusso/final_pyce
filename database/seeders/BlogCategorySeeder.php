<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BlogCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('blog_categories')->insert([
            [
                'name'=>'Novedad',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name'=>'Aviso',
                'created_at' => now(),
                'updated_at' => now()
            ]
        ]);
    }
}
