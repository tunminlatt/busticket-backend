<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\SeatingPlan>
 */
class SeatingPlanFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'bus_id' => \App\Models\Bus::inRandomOrder()->first()->id,
            'row' => 25,
            'column' => 4,
        ];
    }
}
