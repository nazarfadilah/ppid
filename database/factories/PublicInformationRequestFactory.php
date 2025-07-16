<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\PublicInformationRequest>
 */
class PublicInformationRequestFactory extends Factory
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
            'request_category' => $this->faker->randomElement(['individual', 'organization', 'group']),
            'nama_pemohon' => $this->faker->name(),
            'nik' => $this->faker->numerify(str_repeat('#', 16)),
            'no_hp' => substr(preg_replace('/\D/', '', $this->faker->phoneNumber()), 0, 15),
            'email' => $this->faker->unique()->safeEmail(),
            'informasi_terkait' => $this->faker->sentence(),
            'alasan_informasi' => $this->faker->sentence(),
            'nama_pengguna_informasi' => $this->faker->name(),
            'nik_pengguna_informasi' => $this->faker->numerify(str_repeat('#', 16)),
            'alamat_pengguna_informasi' => $this->faker->address(),
            'no_hp_pengguna_informasi' => substr(preg_replace('/\D/', '', $this->faker->phoneNumber()), 0, 15),
            'email_pengguna_informasi' => $this->faker->unique()->safeEmail(),
            'alasan_pengguna_informasi' => $this->faker->sentence(),
            'cara_mendapatkan_informasi' => $this->faker->optional()->randomElement(['melihat', 'membaca', 'mendengarkan', 'mencatat', 'lainnya']),
            'cara_mendapatkan_informasi_lainnya' => $this->faker->optional()->sentence(),
            'formats' => $this->faker->optional()->randomElement(['hardcopy', 'softcopy', 'lainnya']),
            'format_lainnya' => $this->faker->optional()->word(),
            'pengiriman_informasi' => $this->faker->optional()->randomElement(['langsung', 'email', 'pos', 'lainnya']),
            'pengiriman_informasi_lainnya' => $this->faker->optional()->word(),
            // Simulate binary KTP data as random bytes
            'ktp' => $this->faker->regexify('[A-Za-z0-9]{100}'),
            'status' => $this->faker->randomElement(['Approved', 'Checking', 'Rejected']),
            'reject_reason' => $this->faker->optional()->sentence(),
        ];
    }
}
