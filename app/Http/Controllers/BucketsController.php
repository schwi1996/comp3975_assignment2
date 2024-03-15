<?php

namespace App\Http\Controllers;

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

        // $data = Buckets::create($validation);
        $data = Buckets::firstOrCreate(['vendor' => $validation['vendor']], $validation);
        if ($data->wasRecentlyCreated) {
            session()->flash('success', 'Bucket created successfully');
            return redirect()->route('buckets.index');
        } else {
            session()->flash('error', 'Bucket creation failed');
            return redirect()->route('buckets.index');
        }
    }

    public function getCategoryByVendor($vendor) {
    // Find the first bucket that matches the vendor
    $bucket = Buckets::whereRaw('LOWER(vendor) LIKE LOWER(?)', [$vendor])->first();

    // If a bucket was found, return its category
    if ($bucket) {
        return $bucket->category;
    }

    // If no bucket was found, return 'Miscellaneous'
    return 'Miscellaneous';
    }

}
