<?php

namespace App\Http\Controllers;

use App\Models\Penjualan;
use App\Models\Pembayaran;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PembelianController extends Controller
{
    public function checkout($penjualan_id)
    {
        $penjualan = Penjualan::with('tiket')->findOrFail($penjualan_id);
        return view('user.pembayaran.checkout', compact('penjualan'));
    }

    public function processPayment(Request $request, $penjualan_id)
    {
        $penjualan = Penjualan::with('tiket')->findOrFail($penjualan_id);

        $jumlah_bayar = $penjualan->tiket->harga_tiket * $penjualan->pembayaran->jumlah_tiket;

        // Update Pembayaran record and complete Penjualan
        $penjualan->pembayaran->update([
            'jumlah_bayar' => $jumlah_bayar,
            'tanggal_pembayaran' => now(),
        ]);

        $penjualan->update(['status' => 'completed']);

        return redirect()->route('penjualan.show', $penjualan->id)->with('success', 'Pembayaran berhasil!');
    }
}
