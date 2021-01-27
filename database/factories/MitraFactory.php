<?php

namespace Database\Factories;

use App\Models\MitraRs;
use Illuminate\Database\Eloquent\Factories\Factory;

class MitraFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = MitraRs::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            "mitra_name" => "RS. ".$this->faker->name,
            "mitra_address" => $this->faker->address,
            "mitra_phone" => '081'.$this->faker->randomNumber(),
            "mitra_type" => $this->faker->randomElement(['swab','rapid','all']),
            "created_by" => "system",
            "updated_by" => "system"
        ];
    }
}
