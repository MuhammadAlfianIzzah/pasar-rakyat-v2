<?php

namespace Database\Factories;

use App\Models\Provinsi;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Kabupaten>
 */
class KabupatenFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $country = $this->faker->city;
        return [
            "nama" => $country,
            "slug" => Str::slug($country),
            "deskripsi" => $this->faker->text,
            "logo" => $this->faker->image,
            "lat" => $this->faker->latitude,
            "lang" => $this->faker->latitude,
            "provinsi_id" => Provinsi::factory()->create()->id
        ];
    }
}
