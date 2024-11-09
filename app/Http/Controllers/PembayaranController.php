<?php

namespace App\Http\Controllers;

use App\Models\Pembayaran;
use App\Models\Penjualan;
use App\Models\UserTicket;
use Illuminate\Http\Request;

class PembayaranController extends Controller
{
    /**
     * Show the checkout page for the specified ticket sale.
     */
    public function checkout($penjualan_id)
    {
        $penjualan = Penjualan::with('tiket')->findOrFail($penjualan_id);
        return view('user.pembayaran.checkout', compact('penjualan'));
    }

    /**
     * Process the payment and update the payment record to mark it as completed.
     */
    public function processPayment(Request $request, $penjualan_id)
    {
        $penjualan = Penjualan::with('tiket')->findOrFail($penjualan_id);

        // Update Pembayaran record and complete Penjualan
        $penjualan->pembayaran->update([
            'tanggal_pembayaran' => now(),
        ]);

        $penjualan->update(['status' => 'completed']);

        return redirect()->route('penjualan.show', $penjualan->id)->with('success', 'Pembayaran berhasil!');
    }
}