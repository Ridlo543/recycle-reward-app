<?php

use App\Http\Controllers\ComplaintController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('landing_page.landing_page');
});
Route::get('/pengaduan', [ComplaintController::class, 'create'])->name('pengaduan.create');
Route::post('/pengaduan', [ComplaintController::class, 'store'])->name('pengaduan.store');


// Route::middleware(['auth'])->group(function () {
//     Route::get('user/waste-exchange/create', [WasteExchangeController::class, 'create'])->name('filament.user.waste-exchange.create');
// });
