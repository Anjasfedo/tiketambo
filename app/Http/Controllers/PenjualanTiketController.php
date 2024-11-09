<?php

namespace App\Http\Controllers;

use App\Models\PenjualanTiket;
use App\Models\Pembayaran;
use App\Models\Tiket;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PenjualanTiketController extends Controller
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
            'jumlah_tiket' => 'required|integer|min:1|max:' . $tiket->stok_tiket,
            'metode_pembayaran' => 'required|string|max:50',  // Validate payment method
        ]);

        $nomor_pesanan = 'ORD-' . strtoupper(uniqid());

        // Step 1: Create PenjualanTiket with 'pending' status
        $penjualan = PenjualanTiket::create([
            'nomor_pesanan' => $nomor_pesanan,
            'tiket_id' => $tiket->id,
            'status' => 'pending',  // Status will stay pending until payment is confirmed
            'tanggal_pemesanan' => now(),
            'user_id' => Auth::id(),
        ]);

        // Step 2: Create an initial Pembayaran record in 'pending' status
        $jumlah_bayar = $validated['jumlah_tiket'] * $tiket->harga_tiket;

        Pembayaran::create([
            'penjualan_tiket_id' => $penjualan->id,
            'metode_pembayaran' => $validated['metode_pembayaran'],
            'jumlah_tiket' => $validated['jumlah_tiket'],
            'jumlah_bayar' => $jumlah_bayar,
            'tanggal_pembayaran' => null,  // No payment date yet, since payment is pending
        ]);

        // Step 3: Decrement ticket stock
        $tiket->decrement('stok_tiket', $validated['jumlah_tiket']);

        // Redirect to the sale details with a message
        return redirect()->route('penjualan.show', $penjualan->id)
            ->with('success', 'Tiket berhasil dipesan! Silakan lakukan pembayaran.');
    }

    /**
     * Display the specified ticket sale.
     */
    public function show($id)
    {
        $penjualan = PenjualanTiket::with(['tiket', 'user', 'pembayaran'])->findOrFail($id);
        return view('user.penjualan.show', compact('penjualan'));
    }
}