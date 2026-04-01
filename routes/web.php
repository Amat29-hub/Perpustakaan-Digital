<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\IndexController;
use App\Http\Controllers\BukuController;

/*
|--------------------------------------------------------------------------
| FRONTEND
|--------------------------------------------------------------------------
*/

Route::get('/', [IndexController::class, 'index'])->name('home');


/*
|--------------------------------------------------------------------------
| BACKEND ADMIN
|--------------------------------------------------------------------------
*/

Route::prefix('admin')->name('admin.')->group(function () {

    /*
    |--------------------------------
    | Dashboard
    |--------------------------------
    */

    Route::get('/', function () {
        return view('backend.dashboard.index');
    })->name('dashboard');


    /*
    |--------------------------------
    | Data Buku (CRUD)
    |--------------------------------
    */

    Route::get('/databuku', [BukuController::class, 'index'])->name('databuku.index');

    Route::get('/databuku/create', [BukuController::class, 'create'])->name('databuku.create');

    Route::post('/databuku', [BukuController::class, 'store'])->name('databuku.store');

    Route::get('/databuku/{id}', [BukuController::class, 'show'])->name('databuku.show');

    Route::get('/databuku/{id}/edit', [BukuController::class, 'edit'])->name('databuku.edit');

    Route::put('/databuku/{id}', [BukuController::class, 'update'])->name('databuku.update');

    Route::delete('/databuku/{id}', [BukuController::class, 'destroy'])->name('databuku.destroy');

});


/*
|--------------------------------------------------------------------------
| FRONTEND BUKU
|--------------------------------------------------------------------------
*/

Route::get('/buku', [BukuController::class, 'list'])->name('buku.list');

Route::get('/buku/{id}', [BukuController::class, 'detail'])->name('buku.detail');