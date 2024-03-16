<?php

namespace App\Imports;

use App\Models\Transactions;
use App\Models\Buckets;
use Illuminate\Support\Str;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithStartRow;

class TransactionsImport implements ToModel, WithStartRow
{   

    protected $categories;

    public function __construct()
    {
        // Retrieve categories from the buckets table and store them in an associative array
        $this->categories = collect(Buckets::all()->pluck('category', 'vendor')->toArray());
    }

    /**
     * @return int
     */
    public function startRow(): int
    {
        return 2; // Start reading the data from the second row.
    }

    public function model(array $row)
    {
        // Create a DateTime object from the date string
        $date = \DateTime::createFromFormat('d/m/Y', $row[0]);
        // Format the date for storage (the database likely expects 'Y-m-d')
        $formattedDate = $date ? $date->format('Y-m-d') : null;

        // Convert the vendor from the transaction row to lowercase
        $lowercaseVendor = Str::lower($row[1]);
            
        // Get the category from the associative array based on the lowercase vendor
        $category = $this->categories->first(function ($value, $vendor) use ($lowercaseVendor) {
            return Str::contains($lowercaseVendor, Str::lower($vendor));
        });

        // If no matching category is found, set the default category to "Miscellaneous"
        $category = $category ?? "Miscellaneous";

        return new Transactions([
            'date' => $formattedDate,
            'vendor' => $row[1],
            'spending' => (float) $row[2], // Ensure this is cast to a float if it's a monetary value
            'deposit' => (float) $row[3], // Ensure this is cast to a float if it's a monetary value
            'balance' => (float) $row[4], // Ensure this is cast to a float if it's a monetary value
            'category' =>  $category
        ]);
    }
}