<?php

namespace Database\Factories;

use App\Models\Book;
use App\Repository\Eloquent\BookRepository;
use Illuminate\Database\Eloquent\Factories\Factory;

class BookFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $ageRatings = [
            '0+', '6+', '12+', '16+', '18+',
        ];

        return [
            'name' => $this->faker->name(),
            'date_publish' => $this->faker->date('Y-m-d'),
            'cover_img' => null,
            'pages_quantity' => $this->faker->numberBetween(100, 1000),
            'description' => $this->faker->text(255),
            'age_rating' => $ageRatings[mt_rand(0, 4)],
            'is_novelty' => (string) mt_rand(0, 1),
            'is_popular' => (string) mt_rand(0, 1),
            'is_recommended' => (string) mt_rand(0, 1),
        ];
    }
}
