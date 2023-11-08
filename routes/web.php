<?php

use App\Http\Controllers\ProfileController;
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

Route::get('/', [Announce\AnnounceController::class, 'index'])->name('announce.index');

// Afficher le formulaire de création d'une nouvelle annonce
Route::get('/annonces/create', [Announce\AnnounceController::class, 'create'])
    ->middleware(['auth', 'verified'])->name('annonces.create');

// Enregistrer une nouvelle annonce
Route::post('/annonces', [Announce\AnnounceController::class, 'store'])
    ->middleware(['auth', 'verified'])->name('annonces.store');

// Afficher une annonce spécifique
Route::get('/annonces/{announce}', [Announce\AnnounceController::class, 'show'])->name('annonces.show');

// Afficher le formulaire d'édition d'une annonce spécifique
Route::get('/annonces/{announce}/edit', [Announce\AnnounceController::class, 'edit'])
    ->middleware(['auth', 'verified'])->name('annonces.edit');

// Mettre à jour une annonce spécifique
Route::patch('/annonces/{announce}', [Announce\AnnounceController::class, 'update'])
    ->middleware(['auth', 'verified'])->name('annonces.update');

// Supprimer une annonce spécifique
Route::delete('/annonces/{announce}', [Announce\AnnounceController::class, 'destroy'])
    ->middleware(['auth', 'verified'])->name('annonces.destroy');


Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
