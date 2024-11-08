<?php
namespace Database\Factories;

use App\Models\PenjualanTiket;
use App\Models\Tiket;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class PenjualanTiketFactory extends Factory
{
    protected $model = PenjualanTiket::class;

    public function definition()
    {
        return [
            'nomor_pesanan' => $this->faker->unique()->numerify('ORD-#####'),
            'tiket_id' => Tiket::factory(), // Create a new tiket for each sale
            'status' => $this->faker->randomElement(['pending', 'completed', 'canceled']),
            'tanggal_pemesanan' => $this->faker->date,
            'user_id' => User::factory(), // Create a new user for each sale
        ];
    }
}