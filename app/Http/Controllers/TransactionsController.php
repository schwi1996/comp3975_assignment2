<?php

namespace App\Http\Controllers;
use App\Http\Controllers\BucketsController;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\TransactionsImport;


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

    public function upload(Request $request)
    {
        $request->validate([
            'transactionFile' => 'required|file|mimes:xls,xlsx,csv',
        ]);

        Excel::import(new TransactionsImport, request()->file('transactionFile'));

        return back()->with('success', 'Transactions imported successfully!');
    }

    public function edit($id)
{
    // Fetch the transaction from the database
    $transaction = Transactions::findOrFail($id);

    // Pass the transaction data to the view along with the ID
    return view('CRUD.transactions.edit', compact('transaction'));
}

public function update(Request $request, $id)
{
    // Validate the incoming request data
    $validation = $request->validate([
        'date' => 'required|date',
        'vendor' => 'required|string|max:255',
        'spend' => 'required|numeric|between:0,999999.99',
        'deposit' => 'required|numeric|between:0,999999.99',
        'balance' => 'nullable|numeric|between:0,999999.99',
    ]);

    $category = BucketsController::getCategoryByVendor($validation['vendor']);

    try {
        // Find the transaction by its ID
        $transaction = Transactions::findOrFail($id);

        // Update the transaction with the validated data
        $transaction->update(array_merge($validation, ['category' => $category]));

        // Redirect the user back to the transaction index page with a success message
        return redirect()->route('transactions.index')->with('success', 'Transaction updated successfully!');
    } catch (\Exception $e) {
        // Handle any exceptions
        return redirect()->back()->withInput()->withErrors(['error' => 'Failed to update transaction. Please try again later.']);
    }
}

    public static function recategorizeAll() {

        // Retrieve all transactions
        $transactions = Transactions::all();

        // Iterate over each transaction
        foreach ($transactions as $transaction) {
            // Get the category for the transaction's vendor
            $category = BucketsController::getCategoryByVendor($transaction->vendor);

            // Update the transaction's category
            $transaction->category = $category;

            // Save the transaction
            $transaction->save();
        }
    }


}
