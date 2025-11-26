<?php

namespace Database\Factories;

use App\Models\Shipment;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class ShipmentFactory extends Factory
{
    protected $model = Shipment::class;

    public function definition(): array
    {
        return [
            'title'        => $this->faker->sentence(3), // short title
            'from_city'    => $this->faker->city,
            'from_country' => 'USA',
            'to_city'      => $this->faker->city,
            'to_country'   => $this->faker->country,
            'price'        => $this->faker->numberBetween(50, 500), // random price
            'status'       => $this->faker->randomElement(['pending', 'shipped', 'delivered']),
            'user_id'      => User::factory(), // automatically creates a user if none exists
            'details'      => $this->faker->paragraph, // longer description
        ];
    }
}
