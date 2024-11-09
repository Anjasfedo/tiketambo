<?php

use App\Http\Controllers\AcaraController;
use App\Http\Controllers\PenjualanTiketController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TicketController;
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
    Route::resource('tikets', TicketController::class)->except(['index']);
});

Route::prefix('penjualan')->group(function () {
    Route::get('create/{tiket}', [PenjualanTiketController::class, 'create'])->name('penjualan.create');
    Route::post('store/{tiket}', [PenjualanTiketController::class, 'store'])->name('penjualan.store');
    Route::get('show/{id}', [PenjualanTiketController::class, 'show'])->name('penjualan.show');
});

use App\Http\Controllers\PembayaranController;

Route::prefix('pembayaran')->group(function () {
    Route::get('/checkout/{penjualan}', [PembayaranController::class, 'checkout'])->name('pembayaran.checkout');
    Route::post('/process/{penjualan}', [PembayaranController::class, 'processPayment'])->name('pembayaran.process');
});


require __DIR__.'/auth.php';
