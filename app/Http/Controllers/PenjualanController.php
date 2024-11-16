<?php

namespace App\Http\Controllers;

use App\Models\Penjualan;
use App\Models\Pembayaran;
use App\Models\Tiket;
use App\Models\UserTiket;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PenjualanController extends Controller
{
    public function create($tiket_id)
    {
        $tiket = Tiket::findOrFail($tiket_id);
        return view('user.penjualan.create', compact('tiket'));
    }

    public function store(Request $request, $tiket_id)
    {
        $tiket = Tiket::findOrFail($tiket_id);

        $validated = $request->validate([
            'jumlah_tiket' => 'required|integer|min:1|max:' . $tiket->stok,
            'metode_pembayaran' => 'required|string|max:50',  // Validate payment method
        ]);

        $nomor_pesanan = 'ORD-' . strtoupper(uniqid());

        // Determine if it's an admin sale or user resale
        $seller_id = $request->input('seller_id') ?? 1; // Admin ID as default seller

        // Create Penjualan with 'pending' status
        $penjualan = Penjualan::create([
            'nomor_pesanan' => $nomor_pesanan,
            'tiket_id' => $tiket->id,
            'status' => Penjualan::STATUS_PENDING,
            'tanggal_pemesanan' => now(),
            'user_id' => Auth::id(),
            'seller_id' => $seller_id, // Set seller
        ]);

        // Use harga_tiket for jumlah_bayar
        Pembayaran::create([
            'penjualan_id' => $penjualan->id,
            'metode_pembayaran' => $validated['metode_pembayaran'],
            'jumlah_tiket' => $validated['jumlah_tiket'],
            'jumlah_bayar' => $tiket->harga * $validated['jumlah_tiket'],
            'tanggal_pembayaran' => null,
        ]);

        // Update ticket stock
        $tiket->decrement('stok', $validated['jumlah_tiket']);

        // Create UserTiket and PenjualanDetail records
        for ($i = 0; $i < $validated['jumlah_tiket']; $i++) {
            $userTiket = UserTiket::create([
                'user_id' => Auth::id(),   // Buyer
                'tiket_id' => $tiket->id,
                // 'status' => 'active',      // Initial status as active
                'harga_jual' => $tiket->harga,
            ]);

            // Attach each UserTiket to the Penjualan via PenjualanDetail
            $penjualan->penjualanDetails()->create([
                'user_tiket_id' => $userTiket->id,
                'adalah_resale' => false, // Original sale
            ]);
        }

        return redirect()->route('penjualan.show', $penjualan->id)
            ->with('success', 'Tiket berhasil dipesan! Silakan lakukan pembayaran.');
    }

    /**
     * Display the specified ticket sale.
     */
    public function show($id)
    {
        $penjualan = Penjualan::with(['tiket', 'user', 'pembayaran'])->findOrFail($id);
        return view('user.penjualan.show', compact('penjualan'));
    }

    public function pendingCheckouts()
    {
        // Fetch all pending Penjualan records for the authenticated user
        $pendingCheckouts = Penjualan::with('tiket')
            ->where('user_id', Auth::id())
            ->where('status', Penjualan::STATUS_PENDING)
            ->get();

        return view('user.penjualan.pending-checkouts', compact('pendingCheckouts'));
    }

    public function cancelCheckout($id)
    {
        // Find the Penjualan record
        $penjualan = Penjualan::where('id', $id)
            ->where('user_id', Auth::id()) // Ensure the record belongs to the authenticated user
            ->firstOrFail();

        // Delete the associated Pembayaran record if it exists
        if ($penjualan->pembayaran) {
            $penjualan->pembayaran->delete();
        }

        // Delete the Penjualan record itself
        $penjualan->delete();

        // Redirect back with a success message
        return redirect()->route('penjualan.pending-checkouts')->with('success', 'Checkout has been canceled successfully.');
    }

    public function resell(Request $request, $penjualan_id)
    {
        $penjualan = Penjualan::where('id', $penjualan_id)
            ->where('user_id', Auth::id())
            ->firstOrFail();

        $originalPrice = $penjualan->tiket->harga_tiket;

        // Define the allowable price range (e.g., 50% - 150% of the original price)
        $minPrice = $originalPrice * 0.5; // 50% of original price
        $maxPrice = $originalPrice * 1.5; // 150% of original price

        // Validate the resale price
        $request->validate([
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

        // Update the ticket record for resale with a new sale price and status
        $penjualan->update([
            'status' => Penjualan::STATUS_PENDING,
            'seller_id' => Auth::id(),
        ]);

        return redirect()->back()->with('success', 'Tiket telah berhasil dipasang untuk dijual.');
    }

    //

    public function resaleShow(Request $request, $userTiketId)
    {
        $userTiket = UserTiket::where('id', $userTiketId)
            ->where('status', UserTiket::STATUS_FOR_SALE)
            ->firstOrFail();

        return view('user.penjualan.resale', compact('userTiket'));
    }

    public function resaleStore(Request $request, $userTiketId)
    {
        $userTiket = UserTiket::where('id', $userTiketId)
            ->where('status', UserTiket::STATUS_FOR_SALE)
            ->firstOrFail();

        // Validate the resale price
        $validated = $request->validate([
            'metode_pembayaran' => 'required|string|max:50|in:'. implode(',', Pembayaran::PAYMENT_METHODS), // Validate payment method
        ]);

        $nomor_pesanan = 'ORD-RESALE-' . strtoupper(uniqid());

        // Create a new Penjualan for the resale
        $resalePenjualan = Penjualan::create([
            'nomor_pesanan' => $nomor_pesanan,
            'tiket_id' => $userTiket->tiket_id,
            'status' => Penjualan::STATUS_PENDING,
            'tanggal_pemesanan' => now(),
            'user_id' => Auth::id(),
            'seller_id' => $userTiket->user_id,
        ]);

        // Use resale price for jumlah_bayar
        Pembayaran::create([
            'penjualan_id' => $resalePenjualan->id,
            'metode_pembayaran' => $validated['metode_pembayaran'],
            'jumlah_tiket' => 1,
            'jumlah_bayar' => $userTiket->harga_jual, // Resale price
            'tanggal_pembayaran' => null,
        ]);

        // Attach the UserTiket to the Penjualan via PenjualanDetail
        $resalePenjualan->penjualanDetails()->create([
            'user_tiket_id' => $userTiket->id,
            'is_resale' => true, // Mark as resale
        ]);

        // Update the UserTiket to the new owner and set it as 'active'
        // $userTiket->update([
        //     'user_id' => Auth::id(), // New owner
        //     'status' => 'active',    // Reset the status from 'for_sale' to 'active'
        // ]);

        return redirect()->route('penjualan.show', $resalePenjualan->id)
            ->with('success', 'Ticket purchase successful! Please proceed with payment.');
    }

    public function markTicketActive(Request $request, $userTiketId)
    {
        // Find the UserTiket owned by the authenticated user
        $userTiket = UserTiket::where('id', $userTiketId)
            ->where('user_id', Auth::id())
            ->where('status', 'sold') // Only allow reactivation if the ticket is currently sold
            ->firstOrFail();

        // Ensure the ticket's event date has not passed
        // $eventDate = $userTiket->tiket->acara->tanggal;
        // if (now()->greaterThanOrEqualTo($eventDate)) {
        //     return redirect()->back()->withErrors('This ticket cannot be reactivated as the event date has passed.');
        // }

        // Update the UserTiket status to "active"
        $userTiket->update([
            'status' => 'active',
        ]);

        return redirect()->back()->with('success', 'Your ticket is now active and can be resold.');
    }

}