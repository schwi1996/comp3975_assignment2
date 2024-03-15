@extends('layouts.master')

@section('title', 'Create Transaction')

@section('content')
<div class="container">
    <h2>Create New Transaction</h2>
    @if (session() -> has('error'))
        <div class="bg-red-500 text-black px-4 py-2">
            {{ session('error') }}
        </div>
    @endif
    @csrf
    <form action="" method="POST">
        @csrf
        <div class="form-group">
            <label for="date">Date:</label>
            <input type="date" class="form-control" id="date" name="date">
        </div>
        <div class="form-group">
            <label for="vendor">Vendor:</label>
            <input type="text" class="form-control" id="vendor" name="vendor">
        </div>
        <div class="form-group">
            <label for="spend">Spend:</label>
            <input type="text" class="form-control" id="spend" name="spend">
        </div>
        <div class="form-group">
            <label for="deposit">Deposit:</label>
            <input type="text" class="form-control" id="deposit" name="deposit">
        </div>
        <div class="form-group">
            <label for="balance">Balance:</label>
            <input type="text" class="form-control" id="balance" name="balance">
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
        {{-- <button class="btn btn-secondary" onclick="location.href='{{ route('transactions.index') }}'">Cancel</button> --}}
        <a href="{{ route('transactions.index') }}" class="btn btn-secondary">Cancel</a>
    </form>
</div>
@endsection