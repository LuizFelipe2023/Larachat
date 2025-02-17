<?php

use App\Http\Controllers\ChatController;
use App\Http\Controllers\FeedbackController;
use App\Http\Controllers\SuporteController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::match(['get','post'],'/chat',[ChatController::class,'handle'])->name('chat');

Route::prefix('feedbacks')->name('feedbacks.')->group(function() {
    Route::get('/', [FeedbackController::class, 'index'])->name('index');
    Route::get('{id}/feedback', [FeedbackController::class, 'showFeedback'])->name('show');
    Route::get('{id}/edit', [FeedbackController::class, 'editFeedback'])->name('edit');
    Route::put('{id}/update', [FeedbackController::class, 'updateFeedback'])->name('update');
    Route::delete('{id}/delete', [FeedbackController::class, 'deleteFeedback'])->name('delete');
});

Route::prefix('suportes')->name('feedbacks.')->group(function(){
      route::get('/',[SuporteController::class,'indexSuporte'])->name('index');
      route::get('/create',[SuporteController::class,'createSuporte'])->name('create');
      route::post('/store',[SuporteController::class,'storeSuporte'])->name('store');
      route::get('/{id}/edit',[SuporteController::class,'editSuporte'])->name('edit');
      route::put('/{id}/update',[SuporteController::class,'updateSuporte'])->name('update');
      route::delete('/{id}/delete',[SuporteController::class,'deleteSuporte'])->name('delete');
});