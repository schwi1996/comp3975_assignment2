@extends('layouts.master')

@section('title', 'transactions')

@section('content')
<div class="container">
    {{-- <button class="btn btn-primary mb-3" onclick="location.href='{{ route('transactions.create') }}'">Create Transaction</button> --}}
        <button class="btn btn-primary mb-3" onclick="location.href='{{ route('transactions.create') }}'">Create Transaction</button> {{-- Adjust route as necessary --}}
    @if (session() -> has('success'))
        <div class="bg-green-500 text-black px-4 py-2">
            {{ session('success') }}
        </div>
    @endif
    <table class="table table-bordered">
        <thead class="thead-light">
            <tr>
                <th>ID</th>
                <th>Date</th>
                <th>Vendor</th>
                <th>Expense</th>
                <th>Deposit</th>
                <th>Budget</th>
                <th>Category</th>
                <th></th>
            </tr>
        </thead>
       <tbody>
    @foreach($transactions as $transaction)
    <tr>
        <td>{{ $transaction->id }}</td>
        <td>{{ $transaction->date }}</td>
        <td>{{ $transaction->vendor }}</td> 
        <td>{{ $transaction->spend }}</td>
        <td>{{ $transaction->deposit }}</td> 
        <td>{{ $transaction->balance }}</td> 
        <td>{{ $transaction->category }}</td>
        <td>
            {{-- <a href="{{ route('transactions.edit', $transaction->id) }}" class="btn btn-sm btn-info mr-1">Update</a>
            <form action="{{ route('transactions.destroy', $transaction->id) }}" method="POST" style="display: inline-block;">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-sm btn-danger">Delete</button>
            </form> --}}
        </td>
    </tr>
    @endforeach
</tbody>
    </table>
    <button class="btn btn-secondary" onclick="location.href='{{ url('/domain') }}'">Back</button>
</div>
@endsection