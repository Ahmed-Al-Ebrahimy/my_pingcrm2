<?php

namespace Database\Factories;

use App\Models\Occupation;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class OccupationFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Occupation::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->unique()->jobTitle,
            'user_id' => User::factory(),
        ];
    }
}
