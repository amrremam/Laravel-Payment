<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\payController;


Route::get('/', function () {
    return view('welcome');
});

Route::get('/go-payment',[payController::class,'goPay'])->name('payment.go');
Route::get('/payment',[payController::class,'payment'])->name('payment');
Route::get('/cancel',[payController::class,'cancel'])->name('cancel');
Route::get('/payment/success',[payController::class,'success'])->name('payment.success');