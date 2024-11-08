<?php
namespace Database\Factories;

use App\Models\Pembayaran;
use App\Models\PenjualanTiket;
use Illuminate\Database\Eloquent\Factories\Factory;

class PembayaranFactory extends Factory
{
    protected $model = Pembayaran::class;

    public function definition()
    {
        return [
            'penjualan_tiket_id' => PenjualanTiket::factory(), // Link to a new PenjualanTiket
            'metode_pembayaran' => $this->faker->randomElement(['credit_card', 'bank_transfer', 'paypal']),
            'jumlah_tiket' => $this->faker->numberBetween(1, 5),
            'jumlah_bayar' => $this->faker->randomFloat(2, 50, 500), // Random amount between 50 and 500
            'tanggal_pembayaran' => $this->faker->date,
        ];
    }
}