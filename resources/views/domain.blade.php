@extends('layouts.master')

@section('title', 'domain')

@push('styles')
<style>
    .container {
        background-color: #f8f9fa;
    }
</style>
@endpush

@section('content')
<div class="container mt-4">
    {{-- Display flash messages from session --}}
     @if (session() -> has('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif
   @if ($errors->any())
        <div class="alert alert-danger">
            @foreach ($errors->all() as $error)
                <p>{{ $error }}</p>
            @endforeach
        </div>
    @endif

    <div class="row">
        <div class="col-md-12">
            <h2>Welcome, {{ Auth::user()->name }}!</h2>
        </div>
    </div>

    {{-- Example of a form for file upload --}}
    <div class="row mt-4">
        <div class="col-md-6">
            <h3>Upload Transactions File</h3>
        <form action="{{ route('transactions.upload') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label for="transactionFile">Transaction CSV File:</label>
                <input type="file" class="form-control-file" id="transactionFile" name="transactionFile" required>
            </div>
            <button type="submit" class="btn btn-success">Upload</button>
        </form>
        </div>
    </div>
</div>
@endsection