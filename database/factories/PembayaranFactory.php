<?php
namespace Database\Factories;

use App\Models\Pembayaran;
use App\Models\Penjualan;
use Illuminate\Database\Eloquent\Factories\Factory;

class PembayaranFactory extends Factory
{
    protected $model = Pembayaran::class;

    public function definition()
    {
        return [
            'penjualan_id' => Penjualan::factory(), // Link to a new Penjualan
            'metode_pembayaran' => $this->faker->randomElement([
                Pembayaran::METODE_CREDIT_CARD,
                Pembayaran::METODE_BANK_TRANSFER
            ]),
            'jumlah_tiket' => $this->faker->numberBetween(1, 5),
            'jumlah_bayar' => $this->faker->randomFloat(2, 50, 500), // Random amount between 50 and 500
            'tanggal_pembayaran' => $this->faker->date,
        ];
    }
}