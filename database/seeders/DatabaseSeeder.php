<?php

namespace Database\Seeders;

use App\Models\Acara;
use App\Models\Pembayaran;
use App\Models\Penjualan;
use App\Models\PenjualanDetail;
use App\Models\Tiket;
use App\Models\User;
use App\Models\UserTiket;
use App\Models\Withdrawal;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Create a test admin user
        $adminUser = User::factory()->create([
            'name' => 'Admin User',
            'email' => 'admin@example.com',
            'role' => User::ROLE_ADMIN
        ]);

        $user = User::factory()->create([
            'name' => 'Lorem User',
            'email' => 'lorem@example.com',
        ]);

        // Create events (acaras) and associated tickets (tikets)
        Acara::factory()
            ->count(10) // Create 10 events
            ->has(Tiket::factory()->count(5)) // Each acara has 5 tickets
            ->create();

        // Create penjualan (sales) with associated penjualan details and user tickets
        Penjualan::factory()
            ->count(20) // Create 20 sales
            ->has(Pembayaran::factory()) // Each sale has one pembayaran
            ->create()
            ->each(function ($penjualan) {
                // For each penjualan, create user tickets and link to penjualan details
                $userTikets = UserTiket::factory()->count(3)->create([
                    'user_id' => $penjualan->user_id, // Associate user ticket with the buyer in the penjualan
                ]);

                // Link each user ticket to the penjualan through penjualan details
                foreach ($userTikets as $userTiket) {
                    PenjualanDetail::factory()->create([
                        'penjualan_id' => $penjualan->id,
                        'user_tiket_id' => $userTiket->id,
                        'adalah_resale' => true, // Set resale status as desired, or use random values
                    ]);
                }
            });

        // Create withdrawals for each user
        Withdrawal::factory()
            ->count(5) // Create 5 withdrawals
            ->create([
                'user_id' => $user->id, // Associate with specific user
            ]);

        // Optional: Create withdrawals for random users
        User::all()->each(function ($user) {
            Withdrawal::factory()->count(3)->create([
                'user_id' => $user->id,
            ]);
        });
    }
}
