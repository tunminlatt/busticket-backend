<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Booking>
 */
class BookingFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $seatIds = \App\Models\SeatID::where('is_available', true)
            ->inRandomOrder()
            ->limit(fake()->numberBetween(1, 10))
            ->pluck('id')
            ->toArray();

        return [
            'bus_id' => \App\Models\Bus::inRandomOrder()->first()->id,
            'seat_ids' => $seatIds,
            'passenger_name' => fake()->name,
            'passenger_email' => fake()->email,
            'passenger_phone' => fake()->phoneNumber,
        ];
    }
}
