<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Whistle>
 */
class WhistleFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'user_id' => 4, // Assuming user_id can be nullable
            'nama' => $this->faker->name(),
            'no_hp' => $this->faker->numerify(str_repeat('#', fake()->numberBetween(10, 15))),
            'email' => $this->faker->unique()->safeEmail(),
            'tindakan' => $this->faker->sentence(),
            'nama_terlapor' => $this->faker->name(),
            'jabatan_terlapor' => $this->faker->jobTitle(),
            'tanggal_waktu' => $this->faker->dateTime(),
            'lokasi_kejadian' => $this->faker->address(),
            'kronologis' => $this->faker->paragraph(),
            'nominal_korupsi' => $this->faker->randomFloat(2, 1000, 1000000),
            'foto_bukti' => $this->faker->imageUrl(),
            'alasan' => $this->faker->sentence(),
            'status' => $this->faker->randomElement(['pending','rejected','confirmed', 'finished']),
        ];
    }
}
