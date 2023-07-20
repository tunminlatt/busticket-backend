<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

use App\Models\Destination;
/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Bus>
 */
class BusFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $fromDestination = Destination::inRandomOrder()->first();
        $toDestination = Destination::where('id', '!=', $fromDestination->id)->inRandomOrder()->first();

        return [
            'name' => fake()->company,
            'model' => fake()->word,
            'seating_capacity' => 100,
            'from' => $fromDestination->id,
            'to' => $toDestination->id,
        ];
    }
}
