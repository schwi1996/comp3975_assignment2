<?php

use App\Http\Controllers\TransactionsController;
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

Route::get('/transactions', [TransactionsController::class, 'index']) -> name('transactions.index');
Route::get('/transactions/create', [TransactionsController::class, 'add']) -> name('transactions.create');
Route::post('/create_transaction', [TransactionsController::class, 'save'])-> name('transactions.store');
