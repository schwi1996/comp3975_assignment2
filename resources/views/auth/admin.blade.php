@extends('layouts.master')

@section('title', 'admin')

@section('content')

<div class="container">
    <h2>Admin User Approval</h2>
    <table class="table">
        <thead class="thead-light">
            <tr>
                <th>User ID</th>
                <th>Email</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            {{-- @foreach ($unapprovedUsers as $user)
                <tr>
                    <td>{{ $user->user_id }}</td>
                    <td>{{ $user->email }}</td>
                    <td>
                        <form method="post" action="{{ route('admin.approve') }}">
                            @csrf
                            <input type="hidden" name="approve_user_id" value="{{ $user->user_id }}">
                            <button type="submit" class="btn btn-primary">Approve</button>
                        </form>
                    </td>
                </tr>
            @endforeach --}}
        </tbody>
    </table>
    <button class="btn btn-secondary" onclick="window.location='{{ url('/') }}'">Back</button>
</div>
@endsection
