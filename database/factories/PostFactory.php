<?php

namespace Database\Factories;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;

class PostFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'title' => $this->faker->sentence(),
            'content' => $this->faker->sentence(),
            'image' => 'photo1.png',
            //'date' => '2021-12-10',
            'views' => $this->faker->numberBetween(10, 100),
            'category_id' => 7,
            //'tags' => [1,2],
            'user_id' => 1,
            'status' => 1,
            'is_featured' => 0,
        ];
    }
}
