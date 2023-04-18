<?php

namespace Database\Factories;
use App\Models\Author;
use App\Models\Genre;

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
            'title' => $this->faker->words($nb = rand(1,3), $asText = true),
            'genre_id' => Genre::all()->random()->id,
            'author_id' => Author::all()->random()->id,
            'slug' => $this->faker->slug(),
            'publisher' => $this->faker->company(),
            'description' => $this->faker->text($maxNbChars = 250),
            'language' => $this->faker->word(),
            'isbn' => $this->makeIsbn(),
            'published_at' => $this->faker->date($format = 'Y-m-d', $max = 'now'),
            'reserved_to' => $this->faker->dateTimeBetween($startDate = 'now', $endDate = '+2 month'),
        ];
    }

    private function makeIsbn(): string
    {
        return 'ISBN ' . 
            $this->faker->randomNumber($nbDigits = 4) . 
            '-' . $this->faker->randomNumber($nbDigits = 1, $strict = true) .
            '-' . $this->faker->randomNumber($nbDigits = 5, $strict = true) .
            '-' . $this->faker->randomNumber($nbDigits = 3, $strict = true);
    }
}