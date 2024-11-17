<?php

namespace App\Http\Controllers;

use App\Models\Acara;
use App\Models\Penjualan;
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
        $acaras = Acara::paginate(10);
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
            'waktu' => 'required',
            'deskripsi' => 'nullable|string',
            'gambar' => 'nullable|file|mimes:jpeg,png,jpg,gif,svg,pdf,docx|max:2048'  // Accept various file types
        ]);

        // Handle file upload if present
        if ($request->hasFile('gambar')) {
            $validated['gambar'] = $this->storageService->upload($request->file('gambar'));
        }

        // Set the logged-in user's ID
        $validated['user_id'] = Auth::id();

        $validated['details'] = ['lorem' => 'ipsum', 'dolor' => 'res'];

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
            'waktu' => 'required',
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

    public function adminIndex(Request $request)
    {
        $query = Acara::with(['tiket']);

        // Filter by event name or location
        if ($search = $request->input('search')) {
            $query->where(function ($query) use ($search) {
                $query->where('nama', 'like', "%$search%")
                    ->orWhere('lokasi', 'like', "%$search%");
            });
        }

        // Filter by ticket name or price
        if ($ticketSearch = $request->input('ticket_search')) {
            $query->whereHas('tiket', function ($q) use ($ticketSearch) {
                $q->where('nama', 'like', "%$ticketSearch%")
                    ->orWhere('harga', 'like', "%$ticketSearch%");
            });
        }

        // Filter by month
        if ($month = $request->input('tanggal')) {
            $query->whereRaw("strftime('%Y-%m', tanggal) = ?", [$month]);
        }

        // Get all distinct months for the dropdown
        $months = Acara::selectRaw("DISTINCT strftime('%Y-%m', tanggal) as month")
            ->orderBy('month', 'desc')
            ->pluck('month');

        // Pagination for acara
        $acaras = $query->paginate(10);

        // Handle date range filter for sales
        $startDate = $request->input('start_date');
        $endDate = $request->input('end_date');

        $salesQuery = Penjualan::selectRaw("
        strftime('%Y-%m', tanggal_pemesanan) as month,
        COUNT(*) as total_sales,
        SUM(pembayarans.jumlah_bayar) as total_revenue
    ")
            ->join('pembayarans', 'penjualans.id', '=', 'pembayarans.penjualan_id');

        if ($startDate && $endDate) {
            $salesQuery->whereBetween('tanggal_pemesanan', [$startDate, $endDate]);
        }

        $salesByMonth = $salesQuery->groupBy('month')
            ->orderBy('month', 'desc')
            ->paginate(10)
            ->mapWithKeys(function ($item) {
                return [
                    $item->month => [
                        'total_sales' => $item->total_sales,
                        'total_revenue' => $item->total_revenue,
                    ]
                ];
            });

        return view('admin.acaras.index', compact('acaras', 'salesByMonth', 'months', 'startDate', 'endDate'));
    }


    public function salesByMonthDetail($month)
    {
        // Fetch sales details for the given month
        $salesDetails = Penjualan::with(['pembayaran', 'buyer', 'tiket.acara'])
            ->whereRaw("strftime('%Y-%m', tanggal_pemesanan) = ?", [$month])
            ->get();

        return view('admin.acaras.sales_detail', compact('salesDetails', 'month'));
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
        $penjualans = Penjualan::with(['pembayaran', 'user'])
            ->where('tiket_id', $ticket_id)
            ->get();

        return view('admin.acaras.sales', compact('ticket', 'penjualans'));
    }
}