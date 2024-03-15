<?php

namespace App\Http\Controllers;
use App\Http\Controllers\BucketsController;


use Illuminate\Http\Request;
use App\Models\Transactions;
use Illuminate\Support\Facades\Validator;


class TransactionsController extends Controller
{

    public function index()
    {
        // Retrieve transactions from the database
        $transactions = Transactions::all();

        // Pass transactions data to the view and render the transactions index page
        return view('CRUD.Transactions.index', ['transactions' => $transactions]);
    }

    public function create()
    {
        // You can customize this view name and path as per your project structure
        return view('CRUD.Transactions.create');
    }

    public function store(Request $request) {      

        $validation=$request->validate([
            'date' => 'required|date',
            'vendor' => 'required|string|max:255',
            'spend' => 'required|numeric|min:0',
            'deposit' => 'required|numeric|min:0',
            'balance' => 'nullable|numeric|min:0',
        ]);
        $validation['spend'] = floatval($validation['spend']);
        $validation['deposit'] = floatval($validation['deposit']);
        if (isset($validation['balance'])) {
            $validation['balance'] = floatval($validation['balance']);
        }
        $bucketsController = new BucketsController();
        $category = $bucketsController->getCategoryByVendor($validation['vendor']);
        $data = Transactions::create(array_merge($validation, ['category' => $category]));
        if ($data) {
            session()->flash('success', 'Transaction created successfully');
            return redirect()->route('transactions.index');
        } else {
            session()->flash('error', 'Transaction creation failed');
            return redirect()->route('transactions.create');
        }
}

}
