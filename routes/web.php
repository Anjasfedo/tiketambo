<?php

use App\Http\Controllers\AcaraController;
use App\Http\Controllers\PembelianController;
use App\Http\Controllers\PenjualanController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TiketController;
use App\Http\Controllers\PembayaranController;
use App\Http\Controllers\UserTiketController;
use App\Http\Controllers\WithdrawalController;
use App\Models\Acara;
use App\Models\UserTiket;
use Illuminate\Support\Facades\Route;
use App\Models\Tiket;

Route::get('/', function () {
    return view('landing');
})->name('landing');

Route::get('/acaras', function () {
    $query = request()->input('search');
    $acaras = Acara::when($query, function ($queryBuilder) use ($query) {
        $queryBuilder->where('nama', 'like', '%' . $query . '%')
            ->orWhere('lokasi', 'like', '%' . $query . '%')
            ->orWhere('deskripsi', 'like', '%' . $query . '%');
    })->paginate(20);

    return view('acaras', compact('acaras'));
})->name('acaras');

Route::get('/acaras/{id}', function ($id) {
    $acara = Acara::with('tiket')->find($id);
    return view('acaras_show', compact('acara'));
})->name('acaras_show');

Route::get('/tikets', function () {
    $query = request()->input('search');
    $tikets = UserTiket::where('status', UserTiket::STATUS_FOR_SALE)
        ->with(['tiket', 'user'])
        ->when($query, function ($queryBuilder) use ($query) {
            $queryBuilder->whereHas('tiket', function ($subQuery) use ($query) {
                $subQuery->where('nama', 'like', '%' . $query . '%')
                    ->orWhere('harga', 'like', '%' . $query . '%');
            })
                ->orWhereHas('user', function ($subQuery) use ($query) {
                    $subQuery->where('name', 'like', '%' . $query . '%');
                });
        })
        ->latest()
        ->paginate(8);

    return view('tikets', compact('tikets'));
})->name('tikets');


Route::get('/dashboard', function () {
    $tikets = Tiket::with('acara')->where('stok', '>', 0)->get(); // Fetch tickets with available stock
    return view('dashboard', compact('tikets'));
})->middleware(['auth', 'verified'])->name('dashboard');


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

//

Route::resource('/admin/acaras', AcaraController::class);

Route::prefix('acaras/{acara}')->group(function () {
    Route::resource('tikets', TiketController::class)->except(['index']);
});

Route::prefix('penjualan')->group(function () {
    Route::get('create/{tiket}', [PenjualanController::class, 'create'])->name('penjualan.create');
    // Route::post('store/{tiket}', [PenjualanController::class, 'store'])->name('penjualan.store');
    Route::get('show/{id}', [PenjualanController::class, 'show'])->name('penjualan.show');

    Route::get('pending-checkouts', [PenjualanController::class, 'pendingCheckouts'])->name('penjualan.pending-checkouts');
});

Route::delete('penjualan/{id}/cancel', [PenjualanController::class, 'cancelCheckout'])->name('penjualan.cancel');


Route::prefix('pembayaran')->group(function () {
    Route::get('/checkout/{penjualan}', [PembayaranController::class, 'checkout'])->name('pembayaran.checkout');
    Route::post('/process/{penjualan}', [PembayaranController::class, 'processPayment'])->name('pembayaran.process');
});

Route::prefix('penjualan')->middleware(['auth'])->group(function () {
    Route::get('/acaras', [AcaraController::class, 'adminIndex'])->name('admin.acaras.index');
    Route::get('/acaras/{acara}/tikets', [AcaraController::class, 'showTickets'])->name('admin.acaras.tikets');
    Route::get('/tikets/{ticket}/sales', [AcaraController::class, 'showSales'])->name('admin.acaras.sales');
});

// Route::post('user-tickets/{id}/resell', [UserTiketController::class, 'resell'])->name('user-tickets.resell');

// Route::post('withdrawals/request', [WithdrawalController::class, 'request'])->name('withdrawals.request');

Route::middleware('auth')->group(function () {

    // Ticket Sales (Penjualan)
    Route::post('penjualan/store/{tiket}', [PenjualanController::class, 'store'])->name('penjualan.store');
    Route::post('penjualan/{penjualan}/resell', [PenjualanController::class, 'resell'])->name('penjualan.resell');
});

Route::get('user/tickets', [UserTiketController::class, 'index'])->name('user.tickets.index');
Route::post('user/tickets/{id}/resell', [UserTiketController::class, 'resell'])->name('user.tickets.resell');

Route::get('/released-tickets', [UserTiketController::class, 'releasedTickets'])->name('released-tickets');

Route::get('penjualan/resale/{userTiketId}', [PenjualanController::class, 'resaleShow'])->name('penjualan.resaleShow');
Route::post('penjualan/resale/{userTiketId}', [PenjualanController::class, 'resaleStore'])->name('penjualan.resale');


Route::post('/user-ticket/{userTiketId}/activate', [PenjualanController::class, 'markTicketActive'])->name('user-ticket.activate');

Route::middleware(['auth'])->group(function () {
    Route::get('/admin/withdrawal', [WithdrawalController::class, 'admin'])->name('withdrawal.admin');
    Route::get('/withdrawal', [WithdrawalController::class, 'index'])->name('withdrawal.index');
    Route::post('/withdrawal/request', [WithdrawalController::class, 'request'])->name('withdrawal.request');
    Route::post('/withdrawal/{withdrawalId}/process', [WithdrawalController::class, 'process'])->name('withdrawal.process'); // For admin use
    Route::post('/withdrawal/{withdrawalId}/cancel', [WithdrawalController::class, 'cancel'])->name('withdrawal.cancel');
});

// Route::prefix('admin')->middleware(['auth'])->group(function () {
//     Route::get('/tikets', [TiketController::class, 'adminIndex'])->name('admin.tikets.index');
//     Route::get('/tikets/{ticket}/sales', [TiketController::class, 'showSales'])->name('admin.tikets.sales');
// });



require __DIR__ . '/auth.php';