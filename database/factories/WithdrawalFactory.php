<?php

namespace Database\Factories;

use App\Models\User;
use App\Models\Withdrawal;
use Illuminate\Database\Eloquent\Factories\Factory;

class WithdrawalFactory extends Factory
{
    protected $model = Withdrawal::class;

    public function definition()
    {
        return [
            'user_id' => User::factory(), // Buat pengguna baru untuk penarikan
            'jumlah' => $this->faker->randomFloat(2, 10, 1000), // Jumlah acak antara 10 dan 1000
            'status' => $this->faker->randomElement([
                Withdrawal::STATUS_PENDING,
                Withdrawal::STATUS_COMPLETED,
                Withdrawal::STATUS_FAILED
            ]), // Menggunakan konstanta enum
        ];
    }
}