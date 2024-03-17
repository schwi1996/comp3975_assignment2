@extends('layouts.master')

@section('title', 'buckets')

@section('content')
<div class="container">
    
    <button class="btn btn-primary mb-3" onclick="location.href='{{ route('buckets.create') }}'">Create Bucket</button>
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
                <th>Transaction Name</th>
                <th>Category</th>
                <th style="width: 14%;">Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($buckets as $bucket)
                <tr>
                    <td>{{ $bucket->id }}</td>
                    <td>{{ $bucket->vendor }}</td>
                    <td>{{ $bucket->category }}</td>
                    <td>
                        <button class="btn btn-primary mb-3" onclick="location.href='{{ route('buckets.edit', $bucket->id) }}'">Update</button>
                        <form action="{{ route('buckets.destroy', $bucket->id) }}" method="POST" style="display: inline-block;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger mb-3" onclick="return confirm('Are you sure you want to delete this bucket?')">Delete</button>
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
