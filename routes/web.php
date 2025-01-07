<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/evento', function () {
    return view('evento');
});

Route::get('/Dashboarde', function () {
    return view('ui-elements');
})->middleware(['auth', 'verified'])->name('ui-elements');

Route::get('/tabelas', function () {
    return view('tables');
})->middleware(['auth', 'verified'])->name('tables');

Route::get('/cadastrar-evento', function () {
    return view('forms');
})->middleware(['auth', 'verified'])->name('form');

Route::get('/in', function () {
    return view('index');
})->middleware(['auth', 'verified'])->name('index');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
