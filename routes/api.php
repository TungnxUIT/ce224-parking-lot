<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('/createCard', [App\Http\Controllers\CardController::class, 'create'])->name('create.card');
Route::get('/destroyCard', [App\Http\Controllers\CardController::class, 'destroy'])->name('destroy.card');

Route::post('/action', [App\Http\Controllers\ActionController::class, 'control'])->name('control.inout');

Route::get('/', [App\Http\Controllers\HomeController::class, 'welcome']);