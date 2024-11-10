<?php

namespace Database\Seeders;

use App\Models\Acara;
use App\Models\Pembayaran;
use App\Models\Penjualan;
use App\Models\PenjualanDetail;
use App\Models\Tiket;
use App\Models\User;
use App\Models\UserTicket;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Create roles and permissions if they do not exist
        $adminRole = Role::firstOrCreate(['name' => 'admin']);

        // Create a test admin user
        $adminUser = User::factory()->create([
            'name' => 'Admin User',
            'email' => 'admin@example.com',
        ]);

        $user = User::factory()->create([
            'name' => 'Lorem User',
            'email' => 'lorem@example.com',
        ]);

        // Assign the admin role to the admin user
        $adminUser->assignRole($adminRole);

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
                $userTickets = UserTicket::factory()->count(3)->create([
                    'user_id' => $penjualan->user_id, // Associate user ticket with the buyer in the penjualan
                ]);

                // Link each user ticket to the penjualan through penjualan details
                foreach ($userTickets as $userTicket) {
                    PenjualanDetail::factory()->create([
                        'penjualan_id' => $penjualan->id,
                        'user_ticket_id' => $userTicket->id,
                        'is_resale' => true, // Set resale status as desired, or use random values
                    ]);
                }
            });
    }
}