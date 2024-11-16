<?php

namespace Database\Factories;

use App\Models\Tiket;
use App\Models\User;
use App\Models\UserTiket;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\UserTiket>
 */
class UserTiketFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    protected $model = UserTiket::class;

    public function definition()
    {
        return [
            'user_id' => User::factory(), // Link to a new User
            'tiket_id' => Tiket::factory(), // Link to a new Tiket
            'status' => $this->faker->randomElement([UserTiket::STATUS_ACTIVE, UserTiket::STATUS_FOR_SALE, UserTiket::STATUS_EXPIRED]), // Status acak menggunakan enum
            'harga_jual' => $this->faker->randomFloat(2, 10, 500), // Random price between 10 and 500
        ];
    }
}