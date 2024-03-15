@extends('layouts.master')

@section('title', 'buckets')

@section('content')
<div class="container">
    {{-- @can('create', App\Models\Bucket::class)
        <button onclick="window.location='{{ route('buckets.create') }}'">Create Bucket</button>
    @endcan --}}

    <table class="table">
        <thead>
            <tr>
                <th>Bucket ID</th>
                <th>Transaction Name</th>
                <th>Category</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            {{-- @foreach($buckets as $bucket)
                <tr>
                    <td>{{ $bucket->bucket_id }}</td>
                    <td>{{ $bucket->transaction_name }}</td>
                    <td>{{ $bucket->category }}</td>
                    <td>
                        @can('update', $bucket)
                            <button onclick="location.href='{{ route('buckets.edit', $bucket->bucket_id) }}'">Update</button>
                        @endcan
                        @can('delete', $bucket)
                            <form action="{{ route('buckets.destroy', $bucket->bucket_id) }}" method="POST" onsubmit="return confirm('Are you sure?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit">Delete</button>
                            </form>
                        @endcan
                    </td>
                </tr>
            @endforeach --}}
        </tbody>
    </table>

    <button onclick="location.href='{{ url('/domain') }}'">Back</button>
</div>
@endsection