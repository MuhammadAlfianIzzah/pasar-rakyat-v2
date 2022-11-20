<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Negara>
 */
class NegaraFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $country = $this->faker->country;
        return [
            "nama" => $country,
            "slug" => Str::slug($country),
            "deskripsi" => $this->faker->text,
            "logo" => $this->faker->image,
            "lat" => $this->faker->latitude,
            "lang" => $this->faker->latitude,
        ];
    }
}
