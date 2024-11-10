<?php

namespace Database\Factories;

use App\Models\Tiket;
use App\Models\User;
use App\Models\UserTicket;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\UserTicket>
 */
class UserTicketFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    protected $model = UserTicket::class;

    public function definition()
    {
        return [
            'user_id' => User::factory(), // Link to a new User
            'tiket_id' => Tiket::factory(), // Link to a new Tiket
            'status' => $this->faker->randomElement(['active', 'for_sale', 'sold']), // Random status
            'price' => $this->faker->randomFloat(2, 10, 500), // Random price between 10 and 500
        ];
    }
}