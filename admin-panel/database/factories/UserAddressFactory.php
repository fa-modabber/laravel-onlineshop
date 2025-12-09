<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\User;
use App\Models\Province;
use App\Models\City;
use App\Models\UserAddress;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\UserAddress>
 */
class UserAddressFactory extends Factory
{
    protected $model = UserAddress::class;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'title' => $this->faker->word(),
            'address' => $this->faker->address(),
            'cellphone' => $this->faker->numerify('09#########'),
            'postal_code' => $this->faker->numerify('#########'),

            'user_id' => User::inRandomOrder()->first()?->id,

            'province_id' => Province::inRandomOrder()->first()?->id,
            'city_id' => City::inRandomOrder()->first()?->id,

            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
