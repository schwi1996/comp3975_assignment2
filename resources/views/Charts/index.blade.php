@extends('layouts.master')

@section('title', 'charts')

@section('content')
<div class="container">
    <h2 class="mt-3">Expense Report</h2>
    {{-- <form action="{{ route('expenseReport.index') }}" method="post" class="mb-3"> --}}
        @csrf
        <div class="form-group">
            <label for="year">Select Year:</label>
            <select name="year" id="year" class="form-control">
                {{-- @foreach ($availableYears as $availableYear)
                    <option value="{{ $availableYear }}" {{ $availableYear == $year ? 'selected' : '' }}>
                        {{ $availableYear }}
                    </option>
                @endforeach --}}
            </select>
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>

    {{-- @isset($expenseSummary) --}}
        {{-- Display your expense summary table here --}}
    {{-- @endisset --}}

    {{-- @isset($expenseChartData) --}}
        {{-- Display your expense pie chart here. Consider using a JavaScript charting library like Chart.js --}}
    {{-- @endisset --}}

    <button onclick="location.href='{{ url('/domain') }}'" class="btn btn-secondary mt-3">Back</button>
</div>
@endsection
