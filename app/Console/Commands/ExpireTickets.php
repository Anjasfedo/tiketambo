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
    protected $description = 'Mark tickets as expired if the event date has passed';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        // Find tickets linked to events with a date earlier than today, and with status 'active' or 'for_sale'
        $expiredTickets = UserTiket::whereHas('tiket.acara', function ($query) {
            // Make sure acara and tiket relationships are set up properly
            $query->where('tanggal', '<', Carbon::today());
        })
            ->whereIn('status', [UserTiket::STATUS_ACTIVE, UserTiket::STATUS_FOR_SALE]) // Only expire tickets that are active or for sale
            ->get();

        // Loop through the expired tickets and mark them as expired
        foreach ($expiredTickets as $ticket) {
            // Log the ticket's current status and the change
            Log::info('Ticket ID: ' . $ticket->id . ' - Status change from ' . $ticket->status . ' to expired.');

            // Update the ticket status
            $ticket->update(['status' => UserTiket::STATUS_EXPIRED]);

            // Log the status change confirmation
            Log::info('Ticket ID: ' . $ticket->id . ' - Status updated to expired.');
        }

        // Output a success message to the console
        $this->info('Expired tickets have been updated.');
    }
}