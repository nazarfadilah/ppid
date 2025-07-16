<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Galleries>
 */
class GalleriesFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'link' => $this->faker->url(),
            'file_path' => $this->faker->optional()->filePath(),
            'title' => $this->faker->sentence(4),
            'type' => $this->faker->randomElement([
                \App\Models\Galleries::TYPE_FOTO,
                \App\Models\Galleries::TYPE_VIDEO,
                \App\Models\Galleries::TYPE_COMIC,
                \App\Models\Galleries::TYPE_PODCAST,
            ]),
            'description' => $this->faker->paragraph(),
            'date' => $this->faker->date('Y-m-d'),
        ];
    }
}
