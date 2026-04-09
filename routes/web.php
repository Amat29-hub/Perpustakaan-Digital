<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| CONTROLLERS
|--------------------------------------------------------------------------
*/

use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\Frontend\HomeController;

use App\Http\Controllers\Backend\DashboardController;
use App\Http\Controllers\Backend\BukuController;
use App\Http\Controllers\Backend\AnggotaController;
use App\Http\Controllers\Backend\PetugasController;
use App\Http\Controllers\Backend\PeminjamanController;
use App\Http\Controllers\Backend\LaporanController;


/*
|--------------------------------------------------------------------------
| ROOT REDIRECT
|--------------------------------------------------------------------------
*/

Route::get('/', function () {

    if (!auth()->check()) {
        return redirect()->route('login');
    }

    return auth()->user()->role === 'anggota'
        ? redirect()->route('home')
        : redirect()->route('admin.dashboard');

});


/*
|--------------------------------------------------------------------------
| AUTH (GUEST)
|--------------------------------------------------------------------------
*/

Route::middleware('guest')->group(function () {

    Route::get('/login',[AuthController::class,'loginForm'])
        ->name('login');

    Route::post('/login',[AuthController::class,'login'])
        ->name('login.process');

    Route::get('/register',[AuthController::class,'register'])
        ->name('register');

    Route::post('/register',[AuthController::class,'registerStore'])
        ->name('register.store');

});


/*
|--------------------------------------------------------------------------
| LOGOUT
|--------------------------------------------------------------------------
*/

Route::post('/logout',[AuthController::class,'logout'])
    ->middleware('auth')
    ->name('logout');


/*
|--------------------------------------------------------------------------
| FRONTEND (ANGGOTA)
|--------------------------------------------------------------------------
*/

Route::middleware(['auth','role:anggota'])
->controller(HomeController::class)
->group(function () {

    /*
    |--------------------------------------------------------------------------
    | HOME
    |--------------------------------------------------------------------------
    */

    Route::get('/home','index')
        ->name('home');


    /*
    |--------------------------------------------------------------------------
    | DETAIL BUKU
    |--------------------------------------------------------------------------
    */

    Route::get('/buku/{id}','show')
        ->name('buku.detail');

    Route::post('/buku/pinjam/{id}','pinjam')
        ->name('buku.pinjam');


    /*
    |--------------------------------------------------------------------------
    | BUKU SAYA
    |--------------------------------------------------------------------------
    */

    Route::get('/buku-saya','bukuSaya')
        ->name('buku.saya');


    /*
    |--------------------------------------------------------------------------
    | KELOLA PEMINJAMAN ANGGOTA
    |--------------------------------------------------------------------------
    */

    Route::put('/peminjaman/{id}/kembalikan','kembalikan')
        ->name('peminjaman.kembalikan');

    /*
    |--------------------------------------------------------------------------
    | BAYAR DENDA
    |--------------------------------------------------------------------------
    */

    Route::post('/peminjaman/{id}/bayar-denda','bayarDenda')
        ->name('peminjaman.bayarDenda');


    Route::delete('/peminjaman/{id}/hapus','hapus')
        ->name('peminjaman.hapus');

});


/*
|--------------------------------------------------------------------------
| BACKEND (ADMIN / PETUGAS / KEPALA)
|--------------------------------------------------------------------------
*/

Route::prefix('admin')
->name('admin.')
->middleware(['auth','role:petugas,kepala'])
->group(function () {

    /*
    |--------------------------------------------------------------------------
    | DASHBOARD
    |--------------------------------------------------------------------------
    */

    Route::get('/',[DashboardController::class,'index'])
        ->name('dashboard');


    /*
    |--------------------------------------------------------------------------
    | DATA BUKU
    |--------------------------------------------------------------------------
    */

    Route::resource('databuku',BukuController::class);


    /*
    |--------------------------------------------------------------------------
    | DATA ANGGOTA
    |--------------------------------------------------------------------------
    */

    Route::resource('dataanggota',AnggotaController::class);

    Route::put(
        'dataanggota/{id}/toggle',
        [AnggotaController::class,'toggle']
    )->name('dataanggota.toggle');


    /*
    |--------------------------------------------------------------------------
    | DATA PETUGAS
    |--------------------------------------------------------------------------
    */

    Route::resource('datapetugas',PetugasController::class);

    Route::put(
        'datapetugas/{id}/toggle',
        [PetugasController::class,'toggle']
    )->name('datapetugas.toggle');


    /*
    |--------------------------------------------------------------------------
    | PEMINJAMAN
    |--------------------------------------------------------------------------
    */

    Route::resource('peminjaman',PeminjamanController::class);


    /*
    |--------------------------------------------------------------------------
    | AKSI PEMINJAMAN
    |--------------------------------------------------------------------------
    */

    Route::put(
        'peminjaman/{id}/setujui',
        [PeminjamanController::class,'setujui']
    )->name('peminjaman.setujui');


    Route::put(
        'peminjaman/{id}/tolak',
        [PeminjamanController::class,'tolak']
    )->name('peminjaman.tolak');


    Route::put(
        'peminjaman/{id}/kembalikan',
        [PeminjamanController::class,'kembalikan']
    )->name('peminjaman.kembalikan');


    /*
    |--------------------------------------------------------------------------
    | TERLAMBAT (MANUAL)
    |--------------------------------------------------------------------------
    */

    Route::put(
        'peminjaman/{id}/terlambat',
        [PeminjamanController::class,'terlambat']
    )->name('peminjaman.terlambat');


    /*
    |--------------------------------------------------------------------------
    | LAPORAN
    |--------------------------------------------------------------------------
    */
    
    Route::get(
        'laporan/peminjaman',
        [LaporanController::class,'peminjaman']
    )->name('laporan.peminjaman');
    
    Route::get(
        'laporan/pengembalian',
        [LaporanController::class,'pengembalian']
    )->name('laporan.pengembalian');

    Route::get(
        'laporan/peminjaman/cetak',
        [LaporanController::class,'cetakPeminjaman']
    )->name('laporan.peminjaman.cetak');

    Route::get(
        'laporan/pengembalian/cetak',
        [LaporanController::class,'cetakPengembalian']
    )->name('laporan.pengembalian.cetak');

});