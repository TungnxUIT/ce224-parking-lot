<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/welcome', [App\Http\Controllers\ActionController::class, 'welcome']);

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/user/{id}', [App\Http\Controllers\UserController::class, 'show'])->name('profile')->middleware('auth');


Route::get('/register-card/{id}', [App\Http\Controllers\UserController::class, 'getRegisterCard'])->name('get.registercard');
Route::post('/register-card/{id}', [App\Http\Controllers\UserController::class, 'postRegisterCard'])->name('post.registercard');

Route::get('/payment/{id}', [App\Http\Controllers\PaymentController::class, 'getPayment'])->name('get.payment')->middleware('auth');
Route::post('/payment-momo/{id}', [App\Http\Controllers\PaymentController::class, 'payment_momo'])->name('post.momo')->middleware('auth');
Route::get('/complete-payment-momo/{id}/{amount}', [App\Http\Controllers\PaymentController::class, 'complete_momo'])->name('payment.complete')->middleware('auth');
Route::post('/delete-user-card/{cardId}/{id}', [App\Http\Controllers\UserController::class, 'deleteRegistedCard'])->name('delete.usercard')->middleware('auth');