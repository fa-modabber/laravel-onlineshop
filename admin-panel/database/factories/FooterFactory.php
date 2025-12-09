<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Footer;
/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Footer>
 */
class FooterFactory extends Factory
{
        protected $model = Footer::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'col_1_title' => $this->faker->sentence(3),
            'col_1_body_1' => $this->faker->words(3, true),
            'col_1_body_2' => $this->faker->optional()->words(3, true),

            'col_2_title' => $this->faker->sentence(3),
            'col_2_body' => $this->faker->sentence(6),

            'col_3_title' => $this->faker->sentence(3),
            'col_3_body' => $this->faker->sentence(6),

            'telegram_link' => $this->faker->optional()->url(),
            'whatsapp_link' => $this->faker->optional()->url(),
            'instagram_link' => $this->faker->optional()->url(),
            'youtube_link' => $this->faker->optional()->url(),

            'copyright' => '© ' . date('Y') . ' ' . $this->faker->company(),
        ];
    }
}
