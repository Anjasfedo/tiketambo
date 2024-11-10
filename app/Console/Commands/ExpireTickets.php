<?php

namespace App\Console\Commands;

use App\Models\UserTicket;
use Illuminate\Console\Command;
use Carbon\Carbon;

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
        $expiredTickets = UserTicket::whereHas('tiket.acara', function ($query) {
                $query->where('tanggal', '<', Carbon::today());
            })
            ->whereIn('status', ['active', 'for_sale']) // Only expire tickets that are active or for sale
            ->get();

        foreach ($expiredTickets as $ticket) {
            $ticket->update(['status' => 'expired']);
        }

        $this->info('Expired tickets have been updated.');
    }
}