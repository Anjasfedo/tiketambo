<?php
namespace Database\Factories;

use App\Models\Tiket;
use App\Models\Acara;
use Illuminate\Database\Eloquent\Factories\Factory;

class TiketFactory extends Factory
{
    protected $model = Tiket::class;

    public function definition()
    {
        return [
            'acara_id' => Acara::factory(), // Create a new acara for each tiket
            'nama' => $this->faker->word,
            'harga' => $this->faker->randomFloat(2, 10, 500), // Harga acak antara 10 dan 500
            'stok' => $this->faker->numberBetween(50, 200),
        ];
    }
}