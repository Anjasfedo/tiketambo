<?php

namespace App\Http\Controllers;

use App\Models\Acara;
use App\Models\PenjualanTiket;
use App\Models\Tiket;
use Illuminate\Http\Request;
use App\Services\StorageService;
use Illuminate\Support\Facades\Auth;

class AcaraController extends Controller
{
    protected $storageService;

    /**
     * Create a new controller instance and inject StorageService.
     *
     * @param  StorageService  $storageService
     * @return void
     */
    public function __construct(StorageService $storageService)
    {
        $this->storageService = $storageService;
    }

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
            'nama' => 'required|string|max:255',
            'lokasi' => 'required|string|max:255',
            'tanggal' => 'required|date',
            'jam' => 'required',
            'deskripsi' => 'nullable|string',
            'gambar' => 'nullable|file|mimes:jpeg,png,jpg,gif,svg,pdf,docx|max:2048'  // Accept various file types
        ]);

        // Handle file upload if present
        if ($request->hasFile('gambar')) {
            $validated['gambar'] = $this->storageService->upload($request->file('gambar'));
        }

        // Set the logged-in user's ID
        $validated['user_id'] = Auth::id();

        Acara::create($validated);

        return redirect()->route('acaras.index')->with('success', 'Acara berhasil dibuat!');
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
            'nama' => 'required|string|max:255',
            'lokasi' => 'required|string|max:255',
            'tanggal' => 'required|date',
            'jam' => 'required',
            'deskripsi' => 'nullable|string',
            'gambar' => 'nullable|file|mimes:jpeg,png,jpg,gif,svg,pdf,docx|max:2048'  // Accept various file types
        ]);

        $acara = Acara::findOrFail($id);

        // Update the file if a new one is provided
        if ($request->hasFile('gambar')) {
            $validated['gambar'] = $this->storageService->update($request->file('gambar'), $acara->gambar);
        }

        $acara->update($validated);

        return redirect()->route('acaras.index')->with('success', 'Acara berhasil diperbarui!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $acara = Acara::findOrFail($id);

        // Delete the associated file if it exists
        $this->storageService->delete($acara->gambar);

        $acara->delete();

        return redirect()->route('acaras.index')->with('success', 'Acara berhasil dihapus!');
    }

    public function adminIndex()
    {
        $acaras = Acara::all();
        return view('admin.acaras.index', compact('acaras'));
    }

    /**
     * Show all tickets (Tikets) for a specific event (Acara) for the admin.
     */
    public function showTickets($acara_id)
    {
        $acara = Acara::with('tiket')->findOrFail($acara_id);
        return view('admin.acaras.tikets', compact('acara'));
    }

    public function showSales($ticket_id)
    {
        $ticket = Tiket::with('acara')->findOrFail($ticket_id);
        $sales = PenjualanTiket::with(['pembayaran', 'user'])
            ->where('tiket_id', $ticket_id)
            ->get();

        return view('admin.acaras.sales', compact('ticket', 'sales'));
    }
}
