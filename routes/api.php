<?php

use App\Http\Controllers\Api\ClientController;
use Illuminate\Support\Facades\Route;

Route::prefix('v1/')->group(function () {
    Route::delete('/clients/{id}', [ClientController::class, 'destroy'])->name('clients.destroy');
    Route::put('/clients/{id}', [ClientController::class, 'update'])->name('clients.update');
    Route::post('/clients', [ClientController::class, 'store'])->name('clients.store');
    Route::get('/clients/{id}', [ClientController::class, 'show'])->name('clients.show');
    Route::get('/clients', [ClientController::class, 'index'])->name('clients.index');
});
