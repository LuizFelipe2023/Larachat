<?php

use App\Http\Controllers\ChatController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::match(['get','post'],'/chat',[ChatController::class,'handle'])->name('chat');
