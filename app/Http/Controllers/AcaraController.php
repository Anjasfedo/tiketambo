<?php

namespace App\Http\Controllers;

use App\Models\Acara;
use Illuminate\Http\Request;

class AcaraController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $acaras = Acara::all();
        return view('acaras.index', compact('acaras'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('acaras.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'lokasi' => 'required|string|max:255',
            'tanggal' => 'required|date',
            'jam' => 'required',
            'user_id' => 'required|exists:users,id',
            'deskripsi' => 'nullable|string',
            'gambar' => 'nullable|string'
        ]);

        Acara::create($validated);

        return redirect()->route('acaras.index')->with('success', 'Event created successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $acara = Acara::findOrFail($id);

        return view('acaras.show', compact('acara'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $acara = Acara::findOrFail($id);

        return view('acaras.edit', compact('acara'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validated = $request->validate([
            'lokasi' => 'required|string|max:255',
            'tanggal' => 'required|date',
            'jam' => 'required',
            'deskripsi' => 'nullable|string',
            'gambar' => 'nullable|string'
        ]);

        $acara = Acara::findOrFail($id);

        $acara->update($validated);

        return redirect()->route('acaras.index')->with('success', 'Event updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $acara = Acara::findOrFail($id);
        $acara->delete();

        return redirect()->route('acaras.index')->with('success', 'Event deleted successfully!');
    }
}
