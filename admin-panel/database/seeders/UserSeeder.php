<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        
        $users = [
            [
                'name' => 'Fatemeh Modabber',
                'cellphone' => '09123456789',
                'status' => 1,
                'password' => Hash::make('1234')
            ],
            [
                'name' => 'Admin',
                'cellphone' => '09129876543',
                'status' => 1,
                'password' => Hash::make('5678')
            ]
        ];

        User::upsert($users, ['cellphone'], ['name', 'status']);
    }
}
