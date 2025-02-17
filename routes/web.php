<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SuporteController;
use App\Http\Controllers\FeedbackController;

Route::get('/', function () {
    return view('welcome');
});

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
    Route::get('{id}/feedback', [FeedbackController::class, 'showFeedback'])->name('show');
    Route::get('{id}/edit', [FeedbackController::class, 'editFeedback'])->name('edit');
    Route::put('{id}/update', [FeedbackController::class, 'updateFeedback'])->name('update');
    Route::delete('{id}/delete', [FeedbackController::class, 'deleteFeedback'])->name('delete');
});

Route::prefix('suportes')->name('suportes.')->group(function(){
      route::get('/',[SuporteController::class,'indexSuporte'])->name('index');
      route::get('/create',[SuporteController::class,'createSuporte'])->name('create');
      route::post('/store',[SuporteController::class,'storeSuporte'])->name('store');
      route::get('/{id}/edit',[SuporteController::class,'editSuporte'])->name('edit');
      route::put('/{id}/update',[SuporteController::class,'updateSuporte'])->name('update');
      route::delete('/{id}/delete',[SuporteController::class,'deleteSuporte'])->name('delete');
}); 

require __DIR__.'/auth.php';
