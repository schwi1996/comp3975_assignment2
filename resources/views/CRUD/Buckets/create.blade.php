@extends('layouts.master')

@section('title', 'Create Bucket')

@section('content')
<div class="container">
    <h2>Create New Bucket</h2>
    @if (session() -> has('error'))
        <div class="bg-red-500 text-black px-4 py-2">
            {{ session('error') }}
        </div>
    @endif
    @csrf
    <form action="" method="POST">
        @csrf
        <div class="form-group">
            <label for="vendor">Vendor:</label>
            <input type="text" class="form-control" id="vendor" name="vendor">
        </div>
        <div class="form-group">
            <label for="category">Category:</label>
            <input type="text" class="form-control" id="category" name="category">
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
        {{-- <button class="btn btn-secondary" onclick="location.href='{{ route('transactions.index') }}'">Cancel</button> --}}
        <a href="{{ route('buckets.index') }}" class="btn btn-secondary">Cancel</a>
    </form>
</div>
@endsection
