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
    
    /**
     * Store a new ticket sale and payment in storage.
     */
    public function store(Request $request, $tiket_id)
    {
        $tiket = Tiket::findOrFail($tiket_id);

        $validated = $request->validate([
            'jumlah_tiket' => 'required|integer|min:1|max:' . $tiket->stok_tiket,
            'metode_pembayaran' => 'required|string|max:50',
        ]);

        // Generate a unique order number
        $nomor_pesanan = 'ORD-' . strtoupper(uniqid());

        // Create a new PenjualanTiket record
        $penjualan = PenjualanTiket::create([
            'nomor_pesanan' => $nomor_pesanan,
            'tiket_id' => $tiket->id,
            'status' => 'pending',
            'tanggal_pemesanan' => now(),
            'user_id' => Auth::id(),
        ]);

        // Calculate total payment amount
        $jumlah_bayar = $validated['jumlah_tiket'] * $tiket->harga_tiket;

        // Create a new Pembayaran record
        Pembayaran::create([
            'penjualan_tiket_id' => $penjualan->id,
            'metode_pembayaran' => $validated['metode_pembayaran'],
            'jumlah_tiket' => $validated['jumlah_tiket'],
            'jumlah_bayar' => $jumlah_bayar,
            'tanggal_pembayaran' => now(),
        ]);

        // Decrement ticket stock
        $tiket->decrement('stok_tiket', $validated['jumlah_tiket']);

        return redirect()->route('penjualan.show', $penjualan->id)->with('success', 'Tiket berhasil dipesan!');
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