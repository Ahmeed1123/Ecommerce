<?php

use App\Http\Controllers\ItemController;
use App\Http\Controllers\paymentController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/', [App\Http\Controllers\HomeController::class, 'index']);

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::resource('item', ItemController::class)->middleware(['auth']);

Route::group(['prefix' => 'payment' , 'middleware' => ['auth']], function () {
    Route::post('/',  [paymentController::class , 'create'] )->name('payment.create');
    Route::get('/processPayment',  [paymentController::class , 'processPayment'] )->name('payment.processPayment');
    Route::get('/index',  [paymentController::class , 'index'] )->name('payment.index');

});
