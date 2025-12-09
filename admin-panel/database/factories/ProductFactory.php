<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\Category;
use App\Models\Product;

class ProductFactory extends Factory
{
        protected $model = Product::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $name = $this->faker->words(3, true);
        $price = $this->faker->numberBetween(100000, 900000);
        $sale_percent = $this->faker->numberBetween(1, 90);
        $sale_price = intval($price * (1 - $sale_percent / 100));
        return [
            'name' => $name,
            'slug' => Str::slug($name) . '-' . Str::random(4),

            'category_id' => Category::inRandomOrder()->first()->id ?? Category::factory(),

            'primary_image' => 'products/' . $this->faker->image('public/images/products', 640, 480, null, false),

            'description' => $this->faker->paragraph(4),

            'price' => $price,
            'quantity' => $this->faker->numberBetween(0, 50),

            'status' => $this->faker->boolean(90),

            'sale_price' => $sale_price,

            'sale_date_from' => $this->faker->optional()->dateTimeBetween('-1 month', 'now'),
            'sale_date_to'   => $this->faker->optional()->dateTimeBetween('now', '+1 month'),
        ];
    }
}
