<?php

namespace Database\Factories;

use App\Models\Negara;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Provinsi>
 */
class ProvinsiFactory extends Factory
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
            "negara_id" => Negara::factory()->create()->id
        ];
    }
}
