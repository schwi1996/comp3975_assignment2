@extends('layouts.master')

@section('title', 'transactions')

@section('content')
<div class="container">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <button class="btn btn-primary" onclick="location.href='{{ route('transactions.create') }}'">Create Transaction</button>
        <div>
            {{ $transactions->links() }}
        </div>
    </div>    
    @if (session() -> has('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif
    @if (session() -> has('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif
    <div style="margin-bottom: 20px;"></div>
    <table class="table table-bordered">
        <thead class="thead-light">
            <tr>
                <th style="width: 4%;">ID</th>
                <th style="width: 8%;">Date</th>
                <th>Vendor</th>
                <th>Expense</th>
                <th>Deposit</th>
                <th>Balance</th>
                <th>Category</th>
                <th style="width: 14%;">Actions</th>
            </tr>
        </thead>
       <tbody>
    @foreach($transactions as $transaction)
    <tr>
        <td>{{ $transaction->id }}</td>
        <td>{{ $transaction->date }}</td>
        <td>{{ $transaction->vendor }}</td> 
        <td>{{ number_format($transaction->spend, 2) }}</td>
        <td>{{ number_format($transaction->deposit, 2) }}</td> 
        <td>{{ number_format($transaction->balance, 2) }}</td> 
        <td>{{ $transaction->category }}</td>
        <td>
            <button class="btn btn-primary mb-3" onclick="location.href='{{ route('transactions.edit', $transaction->id) }}'">Update</button>
            <form action="{{ route('transactions.destroy', $transaction->id) }}" method="POST" style="display: inline-block;">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger mb-3" onclick="return confirm('Are you sure you want to delete this transaction?')">Delete</button>
            </form>
        </td>
    </tr>
    @endforeach
</tbody>
    </table>
    <button class="btn btn-secondary" onclick="location.href='{{ url('/domain') }}'">Back</button>
    <div style="margin-bottom: 20px;"></div>
</div>
@endsection