<?php

namespace App\Http\Controllers;

use App\Models\UserTicket;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserTicketController extends Controller
{
    // In UserTicketController.php
    public function index()
    {
        // Fetch user tickets grouped by status
        $userTickets = UserTicket::where('user_id', Auth::id())->with('tiket')->get();

        return view('user.tickets.index', compact('userTickets'));
    }


    public function resell(Request $request, $id)
    {
        $userTicket = UserTicket::where('id', $id)->where('user_id', Auth::id())->firstOrFail();

        // Mark ticket as "for sale" with the specified price
        $userTicket->update(['status' => 'for_sale', 'price' => $request->price]);

        return redirect()->route('user.tickets.index')->with('success', 'Ticket has been put up for sale.');
    }

    public function releasedTickets()
    {
        // Retrieve all tickets marked as 'for_sale'
        $releasedTickets = UserTicket::where('status', 'for_sale')
            ->with('tiket', 'user')
            ->get();

        return view('user.tickets.released', compact('releasedTickets'));
    }
}