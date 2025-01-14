<?php

use App\Http\Controllers\OutletController;
use App\Models\Outlet;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


Route::get('outlet', [OutletController::class, 'index'])->name('outlet.index');
Route::post('outletAdd', [OutletController::class, 'store'])->name ('outlet.store');
Route::patch('outletUpdate/{id}', [OutletController::class, 'update'])->name ('outlet.update');
Route::delete('outletDelete/{id}', [OutletController::class, 'destroy'])->name ('outlet.destroy');

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');
