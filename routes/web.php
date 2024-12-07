<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProposalController;
use App\Http\Controllers\AuthController;

Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Halaman Home
Route::get('/', function () {
    return view('home');
})->name('home');

// Halaman About
Route::get('/about', function () {
    return view('about');
});

// View untuk Admin (Daftar Proposal)
Route::middleware(['auth'])->group(function () {
    Route::get('/admin', [ProposalController::class, 'index'])->name('admin.index');
    Route::get('/mahasiswa', function () {
        return view('mahasiswa.create');
    })->name('mahasiswa.create');
    Route::post('/mahasiswa', [ProposalController::class, 'store'])->name('mahasiswa.store');
});

Route::get('/admin/proposal/{id}/edit', [ProposalController::class, 'edit'])->name('admin.proposal.edit');
Route::delete('/admin/proposal/{id}', [ProposalController::class, 'destroy'])->name('admin.proposal.destroy');
Route::put('/admin/proposal/{id}', [ProposalController::class, 'update'])->name('admin.proposal.update');
