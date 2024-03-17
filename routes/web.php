<?php

use App\Http\Controllers\BucketsController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TransactionsController;
use App\Http\Controllers\ExpenseReportController;

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

Route::get('/login', function () {
    return view('auth.login');
})->name('login');

Route::get('/register', function () {
    return view('auth.register');
})->name('register');

Route::get('/admin', function () {
    return view('auth.admin');
})->name('admin');
Route::get('/domain', function () {
    return view('domain');
})->name('domain');

// Route::get('/transactions', function () {
//     return view('CRUD.Transactions.index');
// })->name('transactions.index');

// Route::get('/buckets', function () {
//     return view('CRUD.Buckets.index');
// })->name('buckets');

Route::get('/charts', function () {
    return view('Charts.index');
})->name('charts');

Route::get('/transactions', [TransactionsController::class, 'index'])->name('transactions.index');
Route::get('/transactions/create', [TransactionsController::class, 'create'])->name('transactions.create');
Route::post('/transactions/create', [TransactionsController::class, 'store']);
Route::get('/transactions/edit/{id}', [TransactionsController::class, 'edit'])->name('transactions.edit');
Route::put('/transactions/{id}', [TransactionsController::class, 'update'])->name('transactions.update');
Route::delete('/transactions/{id}', [TransactionsController::class, 'destroy'])->name('transactions.destroy');


Route::get('/buckets', [BucketsController::class, 'index'])->name('buckets.index');
Route::get('/buckets/create', [BucketsController::class, 'create'])->name('buckets.create');
Route::post('/buckets/create', [BucketsController::class, 'store']);
Route::get('/buckets/edit/{id}', [BucketsController::class, 'edit'])->name('buckets.edit');
Route::put('/buckets/{id}', [BucketsController::class, 'update'])->name('buckets.update');
Route::delete('/buckets/{id}', [BucketsController::class, 'destroy'])->name('buckets.destroy');

Route::get('/charts', [ExpenseReportController::class, 'index'])->name('charts.index');
Route::post('/transactions/upload', [TransactionsController::class, 'upload'])->name('transactions.upload');



