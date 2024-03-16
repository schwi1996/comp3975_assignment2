<?php
namespace App\Http\Controllers;

use App\Models\Transactions;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ExpenseReportController extends Controller
{
    public function index(Request $request)
    {
        $year = $request->input('year', date('Y'));

        // Adjust the query to use string manipulation to extract the year part
        $transactions = Transactions::whereRaw("SUBSTR(date, 1, 4) = ?", [$year])->get();

        $expenseSummary = $transactions->groupBy('category')
            ->map(function ($items, $category) {
                return $items->sum('spend'); // Ensure 'amount' matches your column name
            });

        $expenseChartData = $expenseSummary->map(function ($sum, $category) {
            return ['category' => $category, 'sum' => $sum];
        })->values();

        // Adjust the query to determine available years using string manipulation
        $availableYears = Transactions::selectRaw("SUBSTR(date, 1, 4) as year")
            ->groupBy('year')
            ->orderBy('year', 'desc')
            ->get()
            ->pluck('year');

        return view('Charts.index', compact('expenseSummary', 'expenseChartData', 'availableYears', 'year'));
    }
}
?>
