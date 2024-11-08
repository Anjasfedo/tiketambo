<?php

namespace Database\Seeders;

use App\Models\Acara;
use App\Models\Pembayaran;
use App\Models\PenjualanTiket;
use App\Models\Tiket;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Create roles and permissions if not exists
        $adminRole = Role::firstOrCreate(['name' => 'admin']);

        // Create a test admin user
        $adminUser = User::factory()->create([
            'name' => 'Admin User',
            'email' => 'admin@example.com',
        ]);

        // Assign admin role to the admin user
        $adminUser->assignRole($adminRole);

        Acara::factory()
            ->count(10) // Create 10 events
            ->has(Tiket::factory()->count(5)) // Each acara has 5 tickets
            ->create();

        // Seed additional penjualan_tiket and pembayaran
        PenjualanTiket::factory()
            ->count(20) // Create 20 sales
            ->has(Pembayaran::factory()) // Each sale has one pembayaran
            ->create();
    }
}