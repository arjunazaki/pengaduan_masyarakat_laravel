<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'nik' => null,
            'nomor_telepon' => '081234567890',
            'name' => 'arjuna',
            'email' => 'juna@gmail.com',
            'password' => Hash::make('12345678'),
            'level' => 'admin',
        ]);
    }
}
