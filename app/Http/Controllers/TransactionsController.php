<?php

namespace App\Http\Controllers;
use App\Http\Controllers\BucketsController;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\TransactionsImport;
use App\Models\StartBalance;
use Illuminate\Support\Facades\File;
use Illuminate\Http\Request;
use App\Models\Transactions;
use Illuminate\Support\Facades\Validator;


class TransactionsController extends Controller {

    public function index() {
        // Retrieve transactions from the database
        $transactions = Transactions::orderBy('date', 'asc')->get();

        // Pass transactions data to the view and render the transactions index page
        return view('CRUD.Transactions.index', ['transactions' => $transactions]);
    }

    public function create() {
        return view('CRUD.Transactions.create');
    }

    public function store(Request $request) {      

        $validation=$request->validate([
            'date' => 'required|date',
            'vendor' => 'required|string|max:255',
            'spend' => 'required|numeric|min:0',
            'deposit' => 'required|numeric|min:0',
        ]);
        $validation['spend'] = floatval($validation['spend']);
        $validation['deposit'] = floatval($validation['deposit']);
        $balance = 0;
        $bucketsController = new BucketsController();
        $category = $bucketsController->getCategoryByVendor($validation['vendor']);
        $data = Transactions::create(array_merge($validation, ['category' => $category, 'balance' => $balance]));
        TransactionsController::recalculateBalance();
        if ($data) {
            session()->flash('success', 'Transaction created successfully');
            return redirect()->route('transactions.index');
        } else {
            session()->flash('error', 'Transaction creation failed');
            return redirect()->route('transactions.create');
        }
    }


    public function upload(Request $request) {
        // Get the file from the request
        $file = $request->file('transactionFile');

        // Define the new path for the file
        $destinationPath = public_path('/imported');

        // Check if the directory exists, if not create it
        if (!File::exists($destinationPath)) {
            File::makeDirectory($destinationPath, $mode = 0777, true, true);
        }

        // Get the original file name
        $originalFileName = $file->getClientOriginalName(). '.' . $file->getClientOriginalExtension() . '.imported';

        // Move the file to the new location
        $file->move($destinationPath, $originalFileName);

        // Import the data from the file
        Excel::import(new TransactionsImport, $destinationPath . '/' . $originalFileName);

        TransactionsController::recalculateBalance();

        return back()->with('success', 'Transactions imported successfully!');
    }

    public function edit($id) {
        // Fetch the transaction from the database
        $transaction = Transactions::findOrFail($id);

        // Pass the transaction data to the view along with the ID
        return view('CRUD.transactions.edit', compact('transaction'));
    }

    public function update(Request $request, $id) {
        // Validate the incoming request data
        $validation = $request->validate([
            'date' => 'required|date',
            'vendor' => 'required|string|max:255',
            'spend' => 'required|numeric|min:0',
            'deposit' => 'required|numeric|min:0',
        ]);

        $category = BucketsController::getCategoryByVendor($validation['vendor']);

        try {
            // Find the transaction by its ID
            $transaction = Transactions::findOrFail($id);

            // Update the transaction with the validated data
            $transaction->update(array_merge($validation, ['category' => $category]));

            TransactionsController::recalculateBalance();
            
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

    public function destroy($id) {
        // Find the transaction by ID
        $transaction = Transactions::findOrFail($id);
        
        // Delete the transaction
        $transaction->delete();

        TransactionsController::recalculateBalance();
        
        // Redirect back with success message
        return redirect()->route('transactions.index')->with('success', 'Transaction deleted successfully!');
    }

    public static function recalculateBalance() {
        $transactions = Transactions::orderBy('date', 'asc')->get();
        $balance = StartBalance::first()->balance;
        foreach ($transactions as $transaction) {
            $balance = $balance - $transaction->spend + $transaction->deposit;
            $transaction->balance = $balance;
            $transaction->save();
        }
    }

}
