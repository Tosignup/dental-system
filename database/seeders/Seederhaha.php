<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;

class Seederhaha extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('users')->insert([
            [
                'username' => 'Admin',
                'email' => 'admin@gmail.com',
                'password' => bcrypt('1234'),
                'role' => 'admin',
            ],
            [
                'username' => 'Staff',
                'email' => 'staff@gmail.com',
                'password' => bcrypt('1234'),
                'role' => 'staff',
            ],
            [
                'username' => 'Client',
                'email' => 'client@gmail.com',
                'password' => bcrypt('1234'),
                'role' => 'client',
            ],
        ]);
    }
}
