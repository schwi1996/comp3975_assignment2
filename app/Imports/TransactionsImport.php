<?php

namespace App\Imports;

use App\Models\Transactions;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithStartRow;
use App\Http\Controllers\BucketsController;

class TransactionsImport implements ToModel, WithStartRow
{
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

        return new Transactions([
            'date' => $formattedDate,
            'vendor' => $row[1],
            'spending' => (float) $row[2], // Ensure this is cast to a float if it's a monetary value
            'deposit' => (float) $row[3], // Ensure this is cast to a float if it's a monetary value
            'balance' => (float) $row[4], // Ensure this is cast to a float if it's a monetary value
            'category' =>  ''
        ]);
    }
}