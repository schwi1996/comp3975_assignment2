@extends('layouts.master')

@section('title', 'Edit Transaction')

@section('content')

<h1>Edit Transaction</h1>

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

<form action="{{ route('transactions.update', $transaction->id) }}" method="POST">
    @csrf
    @method('PUT')
    <div class="form-group">
        <label for="date">Date:</label>
        <input type="date" class="form-control" id="date" name="date" value="{{ $transaction->date }}">
    </div>
    <div class="form-group">
        <label for="vendor">Vendor:</label>
        <input type="text" class="form-control" id="vendor" name="vendor" value="{{ $transaction->vendor }}">
    </div>
    <div class="form-group">
        <label for="spend">Spend:</label>
        <input type="text" class="form-control" id="spend" name="spend" value="{{ $transaction->spend }}">
    </div>
    <div class="form-group">
        <label for="deposit">Deposit:</label>
        <input type="text" class="form-control" id="deposit" name="deposit" value="{{ $transaction->deposit }}">
    </div>
    <div class="form-group">
        <label for="balance">Balance:</label>
        <input type="text" class="form-control" id="balance" name="balance" value="{{ $transaction->balance }}">
    </div>
    <button type="submit" class="btn btn-primary">Submit</button>
    <a href="{{ route('transactions.index') }}" class="btn btn-secondary">Cancel</a>
</form>

@endsection