<?php

namespace App\Http\Controllers;

use App\Models\UserTiket;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserTiketController extends Controller
{
    // In UserTicketController.php
    public function index()
    {
        // Fetch user tickets grouped by status
        $userTickets = UserTiket::where('user_id', Auth::id())->with('tiket')->get();

        return view('user.tickets.index', compact('userTickets'));
    }


    public function resell(Request $request, $id)
    {
        $userTicket = UserTiket::where('id', $id)->where('user_id', Auth::id())->firstOrFail();

        // Mark ticket as "for sale" with the specified price
        $userTicket->update(['status' => 'for_sale', 'price' => $request->price]);

        return redirect()->route('user.tickets.index')->with('success', 'Ticket has been put up for sale.');
    }

    public function releasedTickets()
    {
        // Retrieve all tickets marked as 'for_sale'
        $releasedTickets = UserTiket::where('status', UserTiket::STATUS_FOR_SALE)
            ->with('tiket', 'user')
            ->get();

        return view('user.tickets.released', compact('releasedTickets'));
    }
}