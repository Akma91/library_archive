<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Post>
 */
class PostFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {

        $paragraphs = $this->faker->paragraphs(rand(6, 15));
        $paragraphCounter = 0;

        $exerpt = '';
        $fullBody = '';

        foreach($paragraphs as $paragraph) {
            if($paragraphCounter < 5) {
                $exerpt .= '<p>'.$paragraph.'</p>';
            }

            $fullBody .= '<p>'.$paragraph.'</p>';
            $paragraphCounter ++;
        }

        return [
            'title' => $this->faker->sentence(),
            'slug' => $this->faker->slug(),
            'exerpt' => $exerpt,
            'body' => $fullBody,
            'published_at' => $this->faker->dateTimeBetween('-3 year', 'now')
        ];
    }
}
