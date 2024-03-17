@extends('layouts.master')

@section('title', 'Edit Bucket')

@section('content')

    <h1>Edit Bucket</h1>

    @if ($errors->any())
    <div class="alert alert-danger">
        @foreach ($errors->all() as $error)
            {{ $error }}
        @endforeach
    </div>
    @endif

    <form action="{{ route('buckets.update', $bucket->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label for="vendor">Vendor:</label>
            <input type="text" class="form-control" id="vendor" name="vendor" value="{{ $bucket->vendor }}">
        </div>
        <div class="form-group">
            <label for="category">Category:</label>
            <input type="text" class="form-control" id="category" name="category" value="{{ $bucket->category }}">
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
        <a href="{{ route('buckets.index') }}" class="btn btn-secondary">Cancel</a>
    </form>

@endsection