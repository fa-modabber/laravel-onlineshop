<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            [
                'name' => 'تیشرت',
                'status' => 1
            ],
            [
                'name' => 'ماگ',
                'status' => 1
            ],
            [
                'name' => 'شلوار',
                'status' => 1
            ],
            [
                'name' => 'هودی',
                'status' => 1
            ],
            [
                'name' => 'دفترچه',
                'status' => 1
            ],
        ];

        Category::upsert($data, ['name'], ['status']);
    }
}
