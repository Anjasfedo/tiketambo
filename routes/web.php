<?php

use App\Http\Controllers\AcaraController;
use App\Http\Controllers\PembelianController;
use App\Http\Controllers\PenjualanController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TiketController;
use App\Http\Controllers\PembayaranController;
use App\Http\Controllers\UserTicketController;
use App\Http\Controllers\WithdrawalController;
use Illuminate\Support\Facades\Route;
use App\Models\Tiket;

Route::get('/', function () {
    return view('welcome');
});


Route::get('/dashboard', function () {
    $tikets = Tiket::with('acara')->where('stok_tiket', '>', 0)->get(); // Fetch tickets with available stock
    return view('dashboard', compact('tikets'));
})->middleware(['auth', 'verified'])->name('dashboard');


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

//

Route::resource('acaras', AcaraController::class);

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

Route::prefix('admin')->middleware(['auth'])->group(function () {
    Route::get('/acaras', [AcaraController::class, 'adminIndex'])->name('admin.acaras.index');
    Route::get('/acaras/{acara}/tikets', [AcaraController::class, 'showTickets'])->name('admin.acaras.tikets');
    Route::get('/tikets/{ticket}/sales', [AcaraController::class, 'showSales'])->name('admin.acaras.sales');
});

// Route::post('user-tickets/{id}/resell', [UserTicketController::class, 'resell'])->name('user-tickets.resell');

Route::post('withdrawals/request', [WithdrawalController::class, 'request'])->name('withdrawals.request');

// Ticket Sales (Penjualan)
Route::post('penjualan/store/{tiket}', [PenjualanController::class, 'store'])->name('penjualan.store');
Route::post('penjualan/{penjualan}/resell', [PenjualanController::class, 'resell'])->name('penjualan.resell');

// Ticket Purchases (Pembelian)
Route::get('pembelian/checkout/{penjualan}', [PembelianController::class, 'checkout'])->name('pembelian.checkout');
Route::post('pembelian/process/{penjualan}', [PembelianController::class, 'processPayment'])->name('pembelian.process');

Route::get('user/tickets', [UserTicketController::class, 'index'])->name('user.tickets.index');
Route::post('user/tickets/{id}/resell', [UserTicketController::class, 'resell'])->name('user.tickets.resell');

Route::get('/released-tickets', [UserTicketController::class, 'releasedTickets'])->name('released-tickets');

Route::post('penjualan/resale/{userTicketId}', [PenjualanController::class, 'resaleStore'])->name('penjualan.resale');


Route::post('/user-ticket/{userTicketId}/activate', [PenjualanController::class, 'markTicketActive'])->name('user-ticket.activate');

Route::middleware(['auth'])->group(function () {
    Route::get('/withdrawal', [WithdrawalController::class, 'index'])->name('withdrawal.index');
    Route::post('/withdrawal/request', [WithdrawalController::class, 'request'])->name('withdrawal.request');
    Route::post('/withdrawal/{withdrawalId}/process', [WithdrawalController::class, 'process'])->name('withdrawal.process'); // For admin use
    Route::post('/withdrawal/{withdrawalId}/cancel', [WithdrawalController::class, 'cancel'])->name('withdrawal.cancel');
});

// Route::prefix('admin')->middleware(['auth'])->group(function () {
//     Route::get('/tikets', [TiketController::class, 'adminIndex'])->name('admin.tikets.index');
//     Route::get('/tikets/{ticket}/sales', [TiketController::class, 'showSales'])->name('admin.tikets.sales');
// });



require __DIR__.'/auth.php';
