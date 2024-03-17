@extends('layouts.master')

@section('title', 'Charts')

@section('content')
<div class="container">
    <h2 class="mt-3">Expense Report</h2>
    <form action="{{ route('charts.index') }}" method="GET" class="mb-3"> {{-- Changed to GET for simplicity --}}
        @csrf
        <div class="form-group">
            <label for="year">Select Year:</label>
            <select name="year" id="year" class="form-control">
                @foreach ($availableYears as $availableYear)
                    <option value="{{ $availableYear }}" {{ $availableYear == $year ? 'selected' : '' }}>
                        {{ $availableYear }}
                    </option>
                @endforeach
            </select>
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
    <div style="margin-bottom: 20px;"></div>
    @isset($expenseSummary)
        <table class="table">
            <thead>
                <tr>
                    <th>Category</th>
                    <th>Amount</th>
                </tr>
            </thead>
            <tbody>
                @foreach($expenseSummary as $category => $sum)
                    <tr>
                        <td>{{ $category }}</td>
                        <td>${{ number_format($sum, 2) }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endisset

    {{-- Placeholder for Chart.js --}}
    @isset($expenseChartData)
        <canvas id="expenseChart"></canvas>
    @endisset

    <button onclick="location.href='{{ url('/domain') }}'" class="btn btn-secondary mt-3">Back</button>
</div>

{{-- Include Chart.js (You might want to include this in your master layout or specifically in this view) --}}
@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        @isset($expenseChartData)
            const ctx = document.getElementById('expenseChart').getContext('2d');
            const expenseChartData = @json($expenseChartData);
            const labels = expenseChartData.map(data => data.category);
            const data = expenseChartData.map(data => data.sum);

            new Chart(ctx, {
                type: 'pie',
                data: {
                    labels: labels,
                    datasets: [{
                        label: 'Expense by Category',
                        data: data,
                        // backgroundColor and borderColor settings...
                    }]
                },
                options: {
                    responsive: true, // Adjust size to fit the container size
                    maintainAspectRatio: true, // Maintain the aspect ratio defined below
                    aspectRatio: 2, // Adjust this value to control the chart size
                    plugins: {
                        legend: {
                            position: 'top',
                        },
                        title: {
                            display: true,
                            text: 'Expense Report Chart'
                        }
                    }
                },
            });
        @endisset
    </script>
@endpush

@endsection
