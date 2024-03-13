@extends('layouts.master')

@section('title', 'domain')

@section('content')
<div class="container mt-4">
    {{-- Display flash messages from session --}}
    {{-- @if(session('messages'))
        <div class="alert alert-success">
            @foreach(session('messages') as $message)
                <p>{{ $message }}</p>
            @endforeach
        </div>
    @endif --}}

    {{-- Example conditional content for admin users --}}
    {{-- @if(Auth::check() && Auth::user()->is_admin)
        <div class="mb-3">
            <a href="{{ route('admin.dashboard') }}" class="btn btn-primary">Admin Dashboard</a>
        </div>
    @endif --}}

    <div class="row">
        <div class="col-md-12">
            {{-- <h2>Welcome, {{ Auth::user()->name }}!</h2> --}}
            <p>This is your main dashboard.</p>

            {{-- Additional user-specific content here --}}
        </div>
    </div>

    {{-- Example of a form for file upload --}}
    <div class="row mt-4">
        <div class="col-md-6">
            <h3>Upload Transactions File</h3>
            {{-- <form action="{{ route('transactions.upload') }}" method="POST" enctype="multipart/form-data"> --}}
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