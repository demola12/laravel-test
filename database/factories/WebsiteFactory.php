<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\User;
use App\Models\Category;
use Ramsey\Uuid\Uuid;
/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Website>
 */
class WebsiteFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'title' => $this->faker->sentence,
            'url' => 'http://huels.com/'.Uuid::uuid4()->toString(),
            'description' => $this->faker->paragraph,
            'user_id' => User::all()->random()->id,
             'category_id' => Category::all()->random()->id,
        ];
    }
}
