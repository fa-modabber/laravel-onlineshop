<?php

namespace Database\Seeders;

use App\Models\Feature;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class FeatureSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            [
                'icon' => 'bi-telephone-fill',
                'title' => 'پشتیبانی ۲۴ ساعته',
                'body' => 'لورم ایپسوم متن ساختگی با تولید سادگی نامفهوم از صنعت چاپ، و با استفاده از طراحان گرافیک است،'

            ],
            [
                'icon' => 'bi-clock',
                'title' => 'سایت آنلاین تمام مدت',
                'body' => 'لورم ایپسوم متن ساختگی با تولید سادگی نامفهوم از صنعت چاپ، و با استفاده از طراحان گرافیک است،'
            ],
            [
                'icon' => 'bi-geo-alt',
                'title' => 'ارسال به تمام نقاط ایران',
                'body' => 'لورم ایپسوم متن ساختگی با تولید سادگی نامفهوم از صنعت چاپ، و با استفاده از طراحان گرافیک است،'
            ]
        ];
        Feature::upsert($data, ['icon'], ['title', 'body']);
    }
}
