<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call(AboutUsSeeder::class);
        $this->call(CategorySeeder::class);
        $this->call(ContactUsSeeder::class);
        $this->call(CouponSeeder::class);
        $this->call(FeatureSeeder::class);
        $this->call(FooterSeeder::class);
        $this->call(ProductSeeder::class);
        $this->call(SliderSeeder::class);
        $this->call(UserAddressSeeder::class);
        $this->call(UserSeeder::class);
        $this->call(WishlistSeeder::class);
    }
}
