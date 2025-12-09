<?php

namespace Database\Factories;

use App\Models\ContactUs;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\ContactUs>
 */
class ContactUsFactory extends Factory
{
    protected $model = ContactUs::class;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->name(), 
            'email' => $this->faker->safeEmail(), 
            'subject' => $this->faker->sentence(3),
            'body' => $this->faker->paragraph(2), 
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
