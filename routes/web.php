<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PemasukanController;
use App\Http\Controllers\PengeluaranController;
use App\Http\Controllers\LaporanController;
use App\Http\Controllers\AuthController;


Route::get('/', function () {
    return view('pages.pemasukan'); 
});

Route::middleware('auth')->group(function () {

    Route::get('/', function () {
        return view('pages.pemasukan');
    });

    Route::get('/pemasukan', [PemasukanController::class, 'index'])->name('pemasukan.index');
    Route::get('/pemasukan/create', [PemasukanController::class, 'create'])->name('pemasukan.create');
    Route::post('/pemasukan', [PemasukanController::class, 'store'])->name('pemasukan.store');

    Route::get('/pengeluaran', [PengeluaranController::class, 'index'])->name('pengeluaran.index');
    Route::get('/pengeluaran/create', [PengeluaranController::class, 'create'])->name('pengeluaran.create');
    Route::post('/pengeluaran', [PengeluaranController::class, 'store'])->name('pengeluaran.store');

    Route::get('/laporan', [LaporanController::class, 'index'])->name('laporan.index');

});



Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);

Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
Route::post('/register', [AuthController::class, 'register']);

Route::post('/logout', [AuthController::class, 'logout'])->name('logout');