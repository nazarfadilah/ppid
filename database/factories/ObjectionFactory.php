<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Objection>
 */
class ObjectionFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'nama_pemohon' => $this->faker->name(),
            'alamat_pemohon' => $this->faker->address(),
            'pekerjaan_pemohon' => $this->faker->jobTitle(),
            'no_hp_pemohon' => substr(preg_replace('/\D/', '', $this->faker->phoneNumber()), 0, 15),
            'email_pemohon' => $this->faker->unique()->safeEmail(),
            'nama_kuasa_pemohon' => $this->faker->optional()->name(),
            'alamat_kuasa_pemohon' => $this->faker->optional()->address(),
            'no_hp_kuasa_pemohon' => $this->faker->optional()->numerify('08###########'),
            'alasan_pengajuan' => $this->faker->sentence(),
            'kasus_posisi' => $this->faker->text(100),
            // Simulate binary file content for ktp_pemohon (nullable)
            'ktp_pemohon' => $this->faker->optional()->randomElement([null, random_bytes(100)]),
            'status' => $this->faker->randomElement(['Approved', 'Rejected', 'Checking']),
            'reject_reason' => $this->faker->optional()->text(),
        ];
    }
}
