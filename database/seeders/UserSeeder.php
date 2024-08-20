<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UserSeeder extends Seeder
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
