@extends('dashboard.master.master')

    @section('content')
        <div class="card">
            <div class="card-header">
                <h3>All User List:</h3>
            </div>
            <div class="card-body">
                <table class="table">
                    <tr>
                        <th>Sl</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Phone</th>
                        <th>Balance</th>
                        <th>Role</th>
                        <th>Creator</th>
                        <th>Date</th>
                        <th>Status</th>
                    </tr>
                    @foreach ($users as $user)
                        <tr>
                            <td>{{$loop->index+1}}</td>
                            <td>{{$user->name}}</td>
                            <td>{{$user->email}}</td>
                            <td>{{$user->phone}}</td>
                            <td>{{$user->balance}}</td>
                            <td>{{$user->role}}</td>
                            <td>
                                @if ($user->creator_id == '0')
                                    <p>none</p>
                                @else
                                    {{$user->getUserCretor->name}}
                                @endif
                            </td>
                            <td>
                                {{ $user->created_at->format('d-m-Y') }}
                            </td>
                            <td>
                                @if ($user->status == 1)
                                    <a class="btn btn-success" href="{{route('admin.makeInactive', $user->id)}}">Active</a>
                                @else
                                    <a class="btn btn-danger"  href="{{route('admin.makeActive', $user->id)}}">Inactive</a>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </table>
                {{ $users->links() }}
            </div>
        </div>
    @endsection
