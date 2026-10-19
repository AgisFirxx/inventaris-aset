<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect()->route('login');
});
use App\Models\Asset;
use App\Models\Loan;

Route::get('/dashboard', function () {
    $totalAssets = Asset::count();
    $availableAssets = Asset::where('status', 'available')->count();
    $borrowedAssets = Asset::where('status', 'dipinjam')->count();
    $rusakAssets = Asset::where('kondisi', '!=', 'baik')->count();

    $activeLoans = Loan::where('status', 'dipinjam')->count();
    $lateLoans = Loan::where('status', 'dipinjam')
        ->where('tanggal_kembali_rencana', '<', now())
        ->count();

    $recentLoans = Loan::with(['user', 'asset'])->latest()->take(5)->get();

    return view('dashboard', compact(
        'totalAssets', 'availableAssets', 'borrowedAssets', 'rusakAssets',
        'activeLoans', 'lateLoans', 'recentLoans'
    ));
})->middleware(['auth', 'verified'])->name('dashboard');                        

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\AssetController;
use App\Http\Controllers\LoanController;
use App\Http\Controllers\UserController;

Route::middleware(['auth'])->group(function () {
    Route::middleware('admin')->group(function () {
        Route::resource('categories', CategoryController::class);
        Route::resource('assets', AssetController::class);
        Route::resource('users', UserController::class)->except(['create', 'store', 'show']);
    });

    Route::get('loans/export/excel', [LoanController::class, 'export'])->name('loans.export');
    Route::resource('loans', LoanController::class)->except(['show', 'edit', 'update']);
    Route::put('loans/{loan}/return', [LoanController::class, 'returnAsset'])->name('loans.return');
    Route::get('loans/{loan}/print', [LoanController::class, 'printReceipt'])->name('loans.print');
});
