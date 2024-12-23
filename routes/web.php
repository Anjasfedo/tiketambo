<?php

use App\Http\Controllers\AcaraController;
use App\Http\Controllers\PembelianController;
use App\Http\Controllers\PenjualanController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TiketController;
use App\Http\Controllers\PembayaranController;
use App\Http\Controllers\UserTiketController;
use App\Http\Controllers\WithdrawalController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('landing');
})->name('landing');

// Public Routes
Route::prefix('acaras')->group(function () {
    Route::get('/', function () {
        $query = request()->input('search');
        $acaras = \App\Models\Acara::when($query, function ($queryBuilder) use ($query) {
            $queryBuilder->where('nama', 'like', '%' . $query . '%')
                ->orWhere('lokasi', 'like', '%' . $query . '%')
                ->orWhere('deskripsi', 'like', '%' . $query . '%');
        })->paginate(20);

        return view('acaras', compact('acaras'));
    })->name('acaras');

    Route::get('/{id}', function ($id) {
        $acara = \App\Models\Acara::with('tiket')->find($id);
        return view('acaras_show', compact('acara'));
    })->name('acaras_show');
});

Route::get('/tikets', function () {
    $query = request()->input('search');
    $tikets = \App\Models\UserTiket::where('status', \App\Models\UserTiket::STATUS_FOR_SALE)
        ->with(['tiket', 'user'])
        ->when($query, function ($queryBuilder) use ($query) {
            $queryBuilder->whereHas('tiket', function ($subQuery) use ($query) {
                $subQuery->where('nama', 'like', '%' . $query . '%')
                    ->orWhere('harga', 'like', '%' . $query . '%');
            })->orWhereHas('user', function ($subQuery) use ($query) {
                $subQuery->where('name', 'like', '%' . $query . '%');
            });
        })
        ->latest()
        ->paginate(8);

    return view('tikets', compact('tikets'));
})->name('tikets');

// Authenticated Routes
Route::middleware(['auth'])->group(function () {
    // Dashboard
    Route::get('/dashboard', function () {
        $tikets = \App\Models\Tiket::with('acara')->where('stok', '>', 0)->get();
        return view('dashboard', compact('tikets'));
    })->middleware('verified')->name('dashboard');

    // Profile
    Route::prefix('profile')->group(function () {
        Route::get('/', [ProfileController::class, 'edit'])->name('profile.edit');
        Route::patch('/', [ProfileController::class, 'update'])->name('profile.update');
        Route::delete('/', [ProfileController::class, 'destroy'])->name('profile.destroy');
    });

    // Admin Routes
    Route::prefix('admin')->middleware('role:admin')->group(function () {
        Route::resource('acaras', AcaraController::class);
        Route::get('withdrawal', [WithdrawalController::class, 'admin'])->name('withdrawal.admin');

        Route::prefix('acaras/{acara}')->group(function () {
            Route::resource('tikets', TiketController::class)->except(['index']);
        });

        // View Users (Index)
        Route::get('users', function (Illuminate\Http\Request $request) {
            $query = App\Models\User::query();

            // Search by name or email
            if ($search = $request->input('search')) {
                $query->where('name', 'like', "%$search%")
                    ->orWhere('email', 'like', "%$search%");
            }

            // Filter by role
            if ($role = $request->input('role')) {
                $query->where('role', $role);
            }

            // Paginate the results
            $users = $query->paginate(10);

            return view('admin.users.index', compact('users'));
        })->name('admin.users.index');

        // Create User (Form)
        Route::get('users/create', function () {
            return view('admin.users.create');
        })->name('admin.users.create');

        // View User (Show)
        Route::get('users/{user}', function (App\Models\User $user) {
            return view('admin.users.show', compact('user'));
        })->name('admin.users.show');

        // Store User (Submit Form)
        Route::post('users', function (Illuminate\Http\Request $request) {
            $validated = $request->validate([
                'name' => 'required|string|max:255',
                'email' => 'required|email|unique:users,email',
                'password' => 'required|string|min:8',
                'saldo' => 'required|numeric|min:0',
                'role' => 'required|in:admin,user',
            ]);

            App\Models\User::create([
                'name' => $validated['name'],
                'email' => $validated['email'],
                'password' => bcrypt($validated['password']),
                'saldo' => $validated['saldo'],
                'role' => $validated['role'],
            ]);

            return redirect()->route('admin.users.index')->with('success', 'User berhasil dibuat.');
        })->name('admin.users.store');

        // Edit User (Form)
        Route::get('users/{user}/edit', function (App\Models\User $user) {
            return view('admin.users.edit', compact('user'));
        })->name('admin.users.edit');

        // Update User (Submit Form)
        Route::put('users/{user}', function (Illuminate\Http\Request $request, App\Models\User $user) {
            $validated = $request->validate([
                'name' => 'required|string|max:255',
                'email' => 'required|email|unique:users,email,' . $user->id,
                'password' => 'nullable|string|min:8',
                'saldo' => 'required|numeric|min:0',
                'role' => 'required|in:admin,user',
            ]);

            $user->update([
                'name' => $validated['name'],
                'email' => $validated['email'],
                'password' => $validated['password'] ? bcrypt($validated['password']) : $user->password,
                'saldo' => $validated['saldo'],
                'role' => $validated['role'],
            ]);

            return redirect()->route('admin.users.index')->with('success', 'User berhasil diperbarui.');
        })->name('admin.users.update');

        // Delete User
        Route::delete('users/{user}', function (App\Models\User $user) {
            $user->delete();
            return redirect()->route('admin.users.index')->with('success', 'User berhasil dihapus.');
        })->name('admin.users.destroy');
    });

    // User Routes

    Route::middleware(['role:admin,user'])->group(function () {
        // Ticket Sales (Penjualan)
        Route::prefix('penjualan')->group(function () {
            Route::get('/acaras', [AcaraController::class, 'adminIndex'])->name('admin.acaras.index');
            Route::get('/acaras/{acara}/tikets', [AcaraController::class, 'showTickets'])->name('admin.acaras.tikets');
            Route::get('/tikets/{ticket}/sales', [AcaraController::class, 'showSales'])->name('admin.acaras.sales');
            
            Route::get('/acaras/sales/{month}', [AcaraController::class, 'salesByMonthDetail'])->name('admin.acaras.sales.detail');


            Route::get('/create/{tiket}', [PenjualanController::class, 'create'])->name('penjualan.create');
            Route::post('/store/{tiket}', [PenjualanController::class, 'store'])->name('penjualan.store');
            Route::get('/show/{id}', [PenjualanController::class, 'show'])->name('penjualan.show');
            Route::get('/pending-checkouts', [PenjualanController::class, 'pendingCheckouts'])->name('penjualan.pending-checkouts');
            Route::delete('/{id}/cancel', [PenjualanController::class, 'cancelCheckout'])->name('penjualan.cancel');

            Route::get('/resale/{userTiketId}', [PenjualanController::class, 'resaleShow'])->name('penjualan.resaleShow');
            Route::post('/resale/{userTiketId}', [PenjualanController::class, 'resaleStore'])->name('penjualan.resale');

        });

        // Payments (Pembayaran)
        Route::prefix('pembayaran')->group(function () {
            Route::get('/checkout/{penjualan}', [PembayaranController::class, 'checkout'])->name('pembayaran.checkout');
            Route::post('/process/{penjualan}', [PembayaranController::class, 'processPayment'])->name('pembayaran.process');
        });

        // User Tickets
        Route::prefix('user/tickets')->group(function () {
            Route::get('/', [UserTiketController::class, 'index'])->name('user.tickets.index');
            Route::post('/{id}/resell', [UserTiketController::class, 'resell'])->name('user.tickets.resell');
            Route::get('/released-tickets', [UserTiketController::class, 'releasedTickets'])->name('released-tickets');
        });

        // Withdrawals
        Route::prefix('withdrawal')->group(function () {
            Route::get('/', [WithdrawalController::class, 'index'])->name('withdrawal.index');
            Route::post('/request', [WithdrawalController::class, 'request'])->name('withdrawal.request');
            Route::post('/{withdrawalId}/process', [WithdrawalController::class, 'process'])->name('withdrawal.process');
            Route::post('/{withdrawalId}/cancel', [WithdrawalController::class, 'cancel'])->name('withdrawal.cancel');
        });
    });
});

require __DIR__ . '/auth.php';