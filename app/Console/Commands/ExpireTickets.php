<?php

namespace App\Console\Commands;

use App\Models\UserTiket;
use Illuminate\Console\Command;
use Carbon\Carbon;
use Illuminate\Support\Facades\Log;

class ExpireTickets extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'expire-tickets';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Tandai tiket sebagai kadaluarsa jika tanggal acara sudah lewat';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        // Cari tiket yang terkait dengan acara dengan tanggal yang lebih lama dari hari ini, dan dengan status 'aktif' atau 'dijual'
        $expiredTickets = UserTiket::whereHas('tiket.acara', function ($query) {
            // Pastikan relasi acara dan tiket terhubung dengan benar
            $query->where('tanggal', '<', Carbon::today());
        })
            ->whereIn('status', [UserTiket::STATUS_ACTIVE, UserTiket::STATUS_FOR_SALE]) // Hanya tiket yang aktif atau dijual yang akan kadaluarsa
            ->get();

        // Log jumlah total tiket yang akan diubah statusnya
        $totalExpiredTickets = $expiredTickets->count();
        Log::info('Jumlah tiket yang akan kadaluarsa: ' . $totalExpiredTickets);

        // Loop melalui tiket yang kadaluarsa dan tandai mereka sebagai kadaluarsa
        foreach ($expiredTickets as $ticket) {
            // Log status tiket saat ini dan perubahan status
            Log::info('Tiket Pengguna ID: ' . $ticket->id . ' - Perubahan status dari ' . $ticket->status . ' menjadi kadaluarsa.');

            // Perbarui status tiket
            $ticket->update(['status' => UserTiket::STATUS_EXPIRED]);

            // Log konfirmasi perubahan status
            Log::info('Tiket Pengguna ID: ' . $ticket->id . ' - Status diperbarui menjadi kadaluarsa.');
        }

        // Output pesan sukses ke konsol
        $this->info('Tiket yang kadaluarsa telah diperbarui.');

        // Log jumlah tiket yang diperbarui
        Log::info('Jumlah tiket yang diperbarui menjadi kadaluarsa: ' . $totalExpiredTickets);
    }
}