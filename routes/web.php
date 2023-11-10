<?php

use App\Http\Controllers\FileUpload;
use App\Http\Controllers\Pdf\PdfController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Reservation\ReservationController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Announce;
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

Route::get('/', [Announce\AnnounceController::class, 'index'])
    ->name('announces.index');

Route::get('/annonces/create', [Announce\AnnounceController::class, 'create'])
    ->middleware(['auth', 'verified'])->name('announces.create');

Route::post('/annonces', [Announce\AnnounceController::class, 'store'])
    ->middleware(['auth', 'verified'])->name('announces.store');

Route::get('/annonces/{announce}', [Announce\AnnounceController::class, 'show'])
    ->name('announces.show');

Route::get('/annonces/{announce}/edit', [Announce\AnnounceController::class, 'edit'])
    ->middleware(['auth', 'verified'])->name('announces.edit');

Route::patch('/annonces/{announce}', [Announce\AnnounceController::class, 'update'])
    ->middleware(['auth', 'verified'])->name('announces.update');

Route::delete('/annonces/{announce}', [Announce\AnnounceController::class, 'destroy'])
    ->middleware(['auth', 'verified'])->name('announces.destroy');

Route::middleware(['auth', 'verified'])->group(function () {
    Route::resource('reservations', ReservationController::class);

    Route::post('/session', 'App\Http\Controllers\StripeController@session')->name('session');
    Route::get('/success/{token}', 'App\Http\Controllers\StripeController@success')->name('success');

    Route::get('/facture/{reservation}/pdf', [PdfController::class, 'generatePdf']);
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
