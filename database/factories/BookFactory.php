<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Book>
 */
class BookFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'category_name' => ucwords($this->faker->word),
            'title' => $this->faker->sentence,
            'price' => $this->faker->numberBetween(10000, 300000),
            'author' => $this->faker->name,
            'publisher' => $this->faker->company,
            'published_date' => $this->faker->date,
            'cover' => $this->faker->imageUrl(),
            'description' => $this->faker->paragraph,
        ];
    }
}
