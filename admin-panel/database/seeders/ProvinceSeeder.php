<?php

namespace Database\Seeders;

use App\Models\Province;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProvinceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            ['id' => 1, "name" => "اردبيل"],
            ['id' => 2, "name" => "اصفهان"],
            ['id' => 3, "name" => "البرز"],
            ['id' => 4, "name" => "ايلام"],
            ['id' => 5, "name" => "آذربايجان شرقي"],
            ['id' => 6, "name" => "آذربايجان غربي"],
            ['id' => 7, "name" => "بوشهر"],
            ['id' => 8, "name" => "تهران"],
            ['id' => 9, "name" => "چهارمحال وبختياري"],
            ['id' => 10, "name" => "خراسان جنوبي"],
            ['id' => 11, "name" => "خراسان رضوي"],
            ['id' => 12, "name" => "خراسان شمالي"],
            ['id' => 13, "name" => "خوزستان"],
            ['id' => 14, "name" => "زنجان"],
            ['id' => 15, "name" => "سمنان"],
            ['id' => 16, "name" => "سيستان وبلوچستان"],
            ['id' => 17, "name" => "فارس"],
            ['id' => 18, "name" => "قزوين"],
            ['id' => 19, "name" => "قم"],
            ['id' => 20, "name" => "كردستان"],
            ['id' => 21, "name" => "كرمان"],
            ['id' => 22, "name" => "كرمانشاه"],
            ['id' => 23, "name" => "كهگيلويه وبويراحمد"],
            ['id' => 24, "name" => "گلستان"],
            ['id' => 25, "name" => "گيلان"],
            ['id' => 26, "name" => "لرستان"],
            ['id' => 27, "name" => "مازندران"],
            ['id' => 28, "name" => "مركزي"],
            ['id' => 29, "name" => "هرمزگان"],
            ['id' => 30, "name" => "همدان"],
            ['id' => 31, "name" => "يزد"],

        ];

        Province::upsert($data, ['id'], ['name']);
    }
}
