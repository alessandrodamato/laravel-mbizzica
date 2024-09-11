<?php

use App\Http\Controllers\CommentController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\NoAuthPasteController;
use App\Http\Controllers\PasteController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\VoteController;
use App\Http\Controllers\TwoFactorController;
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

// home
Route::get('/', [PasteController::class, 'getPublicPastes'])->name('home');

// dashboard
Route::get('/dashboard', [DashboardController::class, 'index'])->middleware(['auth', 'verified', 'twofactor'])->name('admin.dashboard');

// pastes
Route::resource('/pastes', PasteController::class)->except('edit', 'update', 'destroy');
Route::resource('/noauth-pastes', NoAuthPasteController::class)->only('create', 'store');
Route::get('/search', [PasteController::class, 'getPublicPastesBySearch'])->name('search');

// comments
Route::resource('/comments', CommentController::class)->only('store');

// votes
Route::post('/paste/{id}/vote', [VoteController::class, 'handleVote'])->name('votes.handle');

// profile
Route::middleware('auth', 'twofactor')->group(function () {
  Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
  Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
  Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// 2fa
Route::middleware(['auth', 'twofactor'])->group(function () {
  Route::get('verify/resend', [TwoFactorController::class, 'resend'])->name('verify.resend');
  Route::resource('verify', TwoFactorController::class)->only(['index', 'store']);
});

require __DIR__ . '/auth.php';
