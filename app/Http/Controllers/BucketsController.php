<?php

namespace App\Http\Controllers;
use App\Http\Controllers\TransactionsController;
use Illuminate\Http\Request;
use App\Models\Buckets;


class BucketsController extends Controller
{
    public function index()
    {
        // Retrieve buckets from the database
        $buckets = Buckets::all();

        // Pass transactions data to the view and render the transactions index page
        return view('CRUD.Buckets.index', ['buckets' => $buckets]);
    }

    public function create()
    {
        // You can customize this view name and path as per your project structure
        return view('CRUD.Buckets.create');
    }

    public function store(Request $request) {
        // Validate the incoming request data
        $validation=$request->validate([
            'vendor' => 'required|string|max:255',
            'category' => 'required|string|max:255',
        ]);

        $data = Buckets::firstOrCreate(['vendor' => $validation['vendor']], $validation);
        if ($data->wasRecentlyCreated) {
            TransactionsController::recategorizeAll();
            session()->flash('success', 'Bucket created successfully');
        } else {
            session()->flash('error', 'Bucket vendor already exists');
        }
        return redirect()->route('buckets.index');
    }

    public static function getCategoryByVendor($vendor) {
        // Convert the transaction's vendor to lowercase
        $vendor = strtolower($vendor);

        // Find all buckets
        $buckets = Buckets::all();

        // Iterate over each bucket
        foreach ($buckets as $bucket) {
            // If the bucket's vendor is a substring of the transaction's vendor
            if (strpos($vendor, strtolower($bucket->vendor)) !== false) {
                // Return the bucket's category
                return $bucket->category;
            }
        }

        // If no bucket was found, return 'Miscellaneous'
        return 'Miscellaneous';
    }

    public function edit($id)
    {
        // Retrieve the bucket
        $bucket = Buckets::find($id);

        // Pass the bucket data to the view and render the buckets edit page
        return view('CRUD.Buckets.edit', ['bucket' => $bucket]);
    }

    public function update(Request $request, $id)
{
    // Retrieve the bucket
    $bucket = Buckets::findOrFail($id);

    // Validate the incoming request data
    $validation = $request->validate([
        'vendor' => 'required|string|max:255|unique:buckets,vendor,' . $bucket->id,
        'category' => 'required|string|max:255',
    ]);

    // Update the bucket with the validated data
    if ($bucket->update($validation)) {
        TransactionsController::recategorizeAll();
        session()->flash('success', 'Bucket updated successfully');
    } else {
        session()->flash('error', 'Bucket vendor already exists');
    }

    // Redirect the user to the buckets index page
    return redirect()->route('buckets.index');
}

}
