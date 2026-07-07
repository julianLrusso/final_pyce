<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BlogTagsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('tags_blogs')->insert([
            [
                'blog_id'=>1,
                'tag_id'=>1,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'blog_id'=>1,
                'tag_id'=>2,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'blog_id'=>2,
                'tag_id'=>3,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'blog_id'=>2,
                'tag_id'=>4,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'blog_id'=>2,
                'tag_id'=>5,
                'created_at' => now(),
                'updated_at' => now()
            ]
        ]);
    }
}
