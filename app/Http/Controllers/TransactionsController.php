<?php

namespace App\Http\Controllers;

use App\Models\Transactions;
use Illuminate\Http\Request;

class TransactionsController extends Controller
{
    public function index() {
        $transactions = Transactions::all();
        return view('transactions', ['transactions' => $transactions]);
    }

    public function add() {
        return view('create_transaction');
    }

    public function save(Request $request) {
        dd($request -> input());
    }
}
