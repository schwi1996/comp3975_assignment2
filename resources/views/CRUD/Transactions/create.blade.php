@extends('layouts.master')

@section('title', 'Create Transaction')

@section('content')
<div class="container">
    <h2>Create New Transaction</h2>
    @if (session() -> has('error'))
        <div class="alert alert-danger">
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
        <button type="submit" class="btn btn-primary">Submit</button>
        <a href="{{ route('transactions.index') }}" class="btn btn-secondary">Cancel</a>
    </form>
</div>
@endsection
