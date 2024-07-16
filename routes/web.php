<?php

use App\Http\Controllers\ItemController;
use App\Http\Controllers\pymentController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/', [App\Http\Controllers\HomeController::class, 'index']);

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::resource('item', ItemController::class)->middleware(['auth']);

Route::group(['prefix' => 'payment' , 'middleware' => ['auth']], function () {
    Route::get('/',  [pymentController::class , 'create'] )->name('payment.create');
    Route::get('/procicing',  [pymentController::class , 'procicing'] )->name('payment.procicing');
    Route::get('/index',  [pymentController::class , 'index'] )->name('payment.index');

});
