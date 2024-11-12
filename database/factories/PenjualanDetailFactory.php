<?php

namespace Database\Factories;

use App\Models\Penjualan;
use App\Models\UserTiket;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\PenjualanDetail>
 */
class PenjualanDetailFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'penjualan_id' => Penjualan::factory(), // Link to a new Penjualan
            'user_tiket_id' => UserTiket::factory(), // Link to a new UserTicket
            'is_resale' => $this->faker->boolean, // Randomly determine if it’s a resale
        ];
    }
}