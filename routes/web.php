<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Eventcontroller;


Route::get('/',  [Eventcontroller::class, 'index'])->name('welcome');
Route::get('/evento/cadastro',  [Eventcontroller::class, 'cadastrar']); 
Route::post('/events', [EventController::class, 'store'])->name('events.store');

Route::get('/exibir_evento/{id}',  [Eventcontroller::class, 'exibir'])->name('evento'); 

Route::get('/evento', function () {
    return view('evento');
});

Route::get('/Dashboarde', function () {
    return view('ui-elements');
})->middleware(['auth', 'verified'])->name('ui-elements');

Route::get('/tabelas', [Eventcontroller::class, 'index1'])->name('tables');

Route::get('/in', [Eventcontroller::class, 'index2'])->name('index');

Route::get('/dashboard', function () {
    return view('/perfil/dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
