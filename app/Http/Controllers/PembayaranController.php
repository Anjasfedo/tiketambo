<?php

namespace App\Http\Controllers;

use App\Models\Pembayaran;
use App\Models\Penjualan;
use App\Models\PenjualanDetail;
use App\Models\UserTiket;
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
        $penjualan = Penjualan::with('pembayaran', 'penjualanDetails')->findOrFail($penjualan_id);

        // Update Pembayaran record to complete the payment
        $penjualan->pembayaran->update([
            'tanggal_pembayaran' => now(),
        ]);

        // Mark the Penjualan as completed
        $penjualan->update(['status' => Penjualan::STATUS_COMPLETED]);

        // Update the UserTiket status to "active" or "sold" based on PenjualanDetail
        foreach ($penjualan->penjualanDetails as $detail) {
            $detail->userTiket->update([
                'user_id' => $penjualan->user_id, // Set new owner to the buyer's user_id
            ]);
        }

        // Add the payment amount to the seller's "money" balance
        $seller = $penjualan->seller;
        $seller->increment('saldo', $penjualan->pembayaran->jumlah_bayar);

        return redirect()->route('penjualan.show', $penjualan->id)->with('success', 'Pembayaran berhasil!');
    }
}