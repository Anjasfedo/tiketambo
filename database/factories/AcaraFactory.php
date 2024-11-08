<?php

namespace Database\Factories;
use App\Models\Acara;
use App\Models\User;
use
Illuminate\Database\Eloquent\Factories\Factory;
class AcaraFactory extends Factory
{
    protected $model = Acara::class;
    public function definition()
    {
        return [
            'lokasi' => $this->faker->address,
            'deskripsi' => $this->faker->paragraph,
            'tanggal' => $this->faker->date,
            'jam' => $this->faker->time,
            'gambar' => $this->faker->imageUrl(640, 480, 'event', true),
            'user_id' => User::factory(), // Create a new user for each acara
        ];
    }
}