<?php

use App\Http\Controllers\GraficoController;
use App\Http\Controllers\MelhoriaController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SuporteController;
use App\Http\Controllers\FeedbackController;
use App\Http\Controllers\Auth\PasswordResetLinkController;
use App\Http\Controllers\Auth\NewPasswordController;
use App\Http\Controllers\ChatController;

Route::match(['get', 'post'], '/chat',[ChatController::class,'handle'])->name('chat');

Route::middleware('guest')->group(function () {
    Route::get('/forgot-password', [PasswordResetLinkController::class, 'create'])
         ->name('password.request');
    
    Route::post('/forgot-password', [PasswordResetLinkController::class, 'store'])
         ->name('password.email');
    
    Route::get('/reset-password/{token}', [NewPasswordController::class, 'create'])
         ->name('password.reset');
    
    Route::post('/reset-password', [NewPasswordController::class, 'store'])
         ->name('password.update');
});


Route::get('/', function () {
    return view('welcome');
})->name('home');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::prefix('feedbacks')->name('feedbacks.')->group(function() {
    Route::get('/', [FeedbackController::class, 'index'])->name('index');
    Route::get('/public',[FeedbackController::class,'publicFeedbacks'])->name('public');
    Route::get('{id}/feedback', [FeedbackController::class, 'showFeedback'])->name('show');
    Route::get('{id}/edit', [FeedbackController::class, 'editFeedback'])->name('edit');
    Route::put('{id}/update', [FeedbackController::class, 'updateFeedback'])->name('update');
    Route::delete('{id}/delete', [FeedbackController::class, 'deleteFeedback'])->name('delete');
    Route::put('/{id}/situacao',[FeedbackController::class,'updateSituacao'])->name('alterarSituacao');
});

Route::prefix('suportes')->name('suportes.')->group(function(){
      route::get('/',[SuporteController::class,'indexSuporte'])->name('index');
      route::get('/create',[SuporteController::class,'createSuporte'])->name('create');
      route::post('/store',[SuporteController::class,'storeSuporte'])->name('store');
      route::get('/{id}/edit',[SuporteController::class,'editSuporte'])->name('edit');
      route::put('/{id}/update',[SuporteController::class,'updateSuporte'])->name('update');
      route::delete('/{id}/delete',[SuporteController::class,'deleteSuporte'])->name('delete');
}); 

Route::prefix('graficos')->name('graficos.')->group(function(){
      route::get('/',[GraficoController::class,'graficosIndex'])->name('index');
});

Route::prefix('melhorias')->name('melhorias.')->group(function(){
      Route::post('/store',[MelhoriaController::class,'storeMelhoria'])->name('store');
      Route::put('/{id}/update',[MelhoriaController::class,'updateMelhoria'])->name('update');
      Route::delete('/{id}/delete',[MelhoriaController::class,'deleteMelhoria'])->name('delete');
});

require __DIR__.'/auth.php';
