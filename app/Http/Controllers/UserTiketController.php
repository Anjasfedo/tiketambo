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
        $activeTickets = UserTiket::where('user_id', auth()->id())
            ->where('status', UserTiket::STATUS_ACTIVE)
            ->paginate(12);

        $forSaleTickets = UserTiket::where('user_id', auth()->id())
            ->where('status', UserTiket::STATUS_FOR_SALE)
            ->paginate(12);

        $activeTicketsCount = UserTiket::where('user_id', auth()->id())
            ->where('status', UserTiket::STATUS_ACTIVE)
            ->count();

        $forSaleTicketsCount = UserTiket::where('user_id', auth()->id())
            ->where('status', UserTiket::STATUS_FOR_SALE)
            ->count();

        return view('user.tickets.index', compact('activeTickets', 'forSaleTickets', 'activeTicketsCount', 'forSaleTicketsCount'));
    }

    public function resell(Request $request, $id)
    {
        $userTicket = UserTiket::where('id', $id)->where('user_id', Auth::id())->firstOrFail();


        $minPrice = $userTicket->tiket->harga * 0.9; // 90% of original price
        $maxPrice = $userTicket->tiket->harga * 1.5; // 150% of original price

        // Validate the resale price
        $validated = $request->validate([
            'price' => [
                'required',
                'numeric',
                'min:' . $minPrice,
                'max:' . $maxPrice,
            ],
        ], [
            'price.min' => 'The resale price cannot be lower than ' . number_format($minPrice, 2),
            'price.max' => 'The resale price cannot be higher than ' . number_format($maxPrice, 2),
        ]);

        // Mark ticket as "for sale" with the specified price
        $userTicket->update(['status' => UserTiket::STATUS_FOR_SALE, 'harga_jual' => $validated['price']]);

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