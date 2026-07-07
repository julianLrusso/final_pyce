<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
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
            [
                'name'       => 'Usuario Admin',
                'email'      => 'usuario@admin.com',
                'password'   => Hash::make('asdasd123'),
                'created_at' => now(),
                'updated_at' => now(),
                'admin'      => 1
            ],
            [
                'name'       => 'Usuario test',
                'email'      => 'usuario@test.com',
                'password'   => Hash::make('asdasd123'),
                'created_at' => now(),
                'updated_at' => now(),
                'admin'      => 0
            ]
        ]);
    }
}
