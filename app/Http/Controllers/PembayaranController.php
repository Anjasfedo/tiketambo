<?php

namespace App\Http\Controllers;

use App\Models\Pembayaran;
use App\Models\Penjualan;
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

        // Calculate the total payment amount based on the ticket quantity and price
        $jumlah_bayar = $penjualan->tiket->harga_tiket * $penjualan->pembayaran->jumlah_tiket;

        // Update the existing Pembayaran record to mark it as completed
        $penjualan->pembayaran->update([
            'jumlah_bayar' => $jumlah_bayar,
            'tanggal_pembayaran' => now(),
        ]);

        // Update the status of the Penjualan to "completed"
        $penjualan->update(['status' => 'completed']);

        return redirect()->route('penjualan.show', $penjualan->id)->with('success', 'Pembayaran berhasil!');
    }
}