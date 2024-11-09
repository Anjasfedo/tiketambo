<?php

namespace App\Http\Controllers;

use App\Models\Tiket;
use App\Models\Acara;
use Illuminate\Http\Request;

class TicketController extends Controller
{
    /**
     * Display a listing of tickets for a specific Acara.
     */
    public function index($acara_id)
    {
        $acara = Acara::findOrFail($acara_id);
        $tikets = $acara->tiket; // Assuming 'tiket' relationship is defined in the Acara model
        return view('tikets.index', compact('tikets', 'acara'));
    }

    public function show($acara_id, $id)
    {
        $acara = Acara::findOrFail($acara_id);
        $tiket = Tiket::where('acara_id', $acara->id)->findOrFail($id);
        return view('tikets.show', compact('tiket', 'acara'));
    }

    /**
     * Show the form for creating a new ticket for a specific Acara.
     */
    public function create($acara_id)
    {
        $acara = Acara::findOrFail($acara_id);
        return view('tikets.create', compact('acara'));
    }

    /**
     * Store a newly created ticket in storage.
     */
    public function store(Request $request, $acara_id)
    {
        $acara = Acara::findOrFail($acara_id);

        $validated = $request->validate([
            'nama' => 'required|string|max:255',
            'harga_tiket' => 'required|numeric',
            'stok_tiket' => 'required|integer|min:1'
        ]);

        $validated['acara_id'] = $acara->id;
        Tiket::create($validated);

        return redirect()->route('acaras.show', $acara->id)->with('success', 'Tiket berhasil ditambahkan!');
    }

    /**
     * Show the form for editing a specific ticket.
     */
    public function edit($acara_id, $id)
    {
        $acara = Acara::findOrFail($acara_id);
        $tiket = Tiket::where('acara_id', $acara->id)->findOrFail($id);
        return view('tikets.edit', compact('tiket', 'acara'));
    }

    /**
     * Update the specified ticket in storage.
     */
    public function update(Request $request, $acara_id, $id)
    {
        $acara = Acara::findOrFail($acara_id);
        $tiket = Tiket::where('acara_id', $acara->id)->findOrFail($id);

        $validated = $request->validate([
            'nama' => 'required|string|max:255',
            'harga_tiket' => 'required|numeric',
            'stok_tiket' => 'required|integer|min:1'
        ]);

        $tiket->update($validated);

        return redirect()->route('acaras.show', $acara->id)->with('success', 'Tiket berhasil diperbarui!');
    }

    /**
     * Remove the specified ticket from storage.
     */
    public function destroy($acara_id, $id)
    {
        $acara = Acara::findOrFail($acara_id);
        $tiket = Tiket::where('acara_id', $acara->id)->findOrFail($id);
        $tiket->delete();

        return redirect()->route('acaras.show', $acara->id)->with('success', 'Tiket berhasil dihapus!');
    }
}
