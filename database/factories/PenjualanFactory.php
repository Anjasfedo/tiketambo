<?php
namespace Database\Factories;

use App\Models\Penjualan;
use App\Models\Tiket;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class PenjualanFactory extends Factory
{
    protected $model = Penjualan::class;

    public function definition()
    {
        return [
            'nomor_pesanan' => $this->faker->unique()->numerify('ORD-#####'),
            'tiket_id' => Tiket::factory(), // Create a new tiket for each sale
            'status' => $this->faker->randomElement([Penjualan::STATUS_PENDING, Penjualan::STATUS_COMPLETED, Penjualan::STATUS_CANCELED]),
            'tanggal_pemesanan' => $this->faker->date,
            'user_id' => User::factory(), // Create a new user for each sale
            'seller_id' => 1, // Create a new user for each sale
        ];
    }
}