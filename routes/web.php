<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Eventcontroller;
use App\Http\Controllers\FeedbackController;


Route::get('/',  [Eventcontroller::class, 'index'])->name('welcome');
Route::get('/evento/cadastro',  [Eventcontroller::class, 'cadastrar']); 
Route::post('/events', [EventController::class, 'store'])->name('events.store');
Route::get('/eventosObrigatorios', [EventController::class, 'showMandatoryEvents'])->name('permanentes');

// Rota para exibir os feedbacks de um evento
Route::get('/evento/{id}/feedback', [FeedbackController::class, 'show'])->name('event.feedback');

// Rota para armazenar um novo feedback
Route::post('/evento/{id}/feedback', [FeedbackController::class, 'store'])->name('feedback.store');
Route::get('/event/{id}/feedback', [FeedbackController::class, 'ver'])->name('feedback.ver');

Route::get('/exibir_evento/{id}',  [Eventcontroller::class, 'exibir'])->name('evento'); 


// DELETAR, EDITAR EVENTOS E UPDATE DO EVENTO
Route::delete('/exibir_evento/{id}',  [Eventcontroller::class, 'destroy']); 
Route::get('/exibir_evento/edit/{id}',  [Eventcontroller::class, 'edit']); 
Route::put('/exibir_evento/update/{id}',  [Eventcontroller::class, 'update']); 

//ROTAS PARA FAVORITAR EVENTO
Route::post('/evento/{eventId}/favoritar', [EventController::class, 'favoriteEvent'])->middleware(['auth', 'verified'])->name('event.favorite');
Route::get('/eventos-favoritos', [EventController::class, 'showFavoriteEvents'])->middleware(['auth', 'verified'])->name('tables');

//FILTRO EVENTOS POR CATEGORIA
// Route::get('/eventos/filtrar', [EventController::class, 'filter'])->name('events.filter');


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

Route::get('/sobre', function () {
    return view('/sobre_site');
});

// so entra ne view se estiver logado
// Route::get('/dashboard', function () {
//     return view('/perfil/dashboard');
// })->middleware(['auth', 'verified'])->middleware('auth');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
