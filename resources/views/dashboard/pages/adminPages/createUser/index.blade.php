@extends('dashboard.master.master')

    @section('content')
        <div class="card">
            <div class="card-body col-8">
                <form action="{{route('admin.create.user.store')}}" method="post">
                    @csrf
                    @if (\Session::has('messages'))
                        <div class="alert alert-danger">
                            <ul>
                                <li>{!! \Session::get('messages') !!}</li>
                            </ul>
                        </div>
                    @endif
                    @if (\Session::has('message'))
                        <div class="alert alert-success">
                            <ul>
                                <li>{!! \Session::get('message') !!}</li>
                            </ul>
                        </div>
                    @endif
                    <div class="mt-3">
                        <label for="name">Name*</label>
                        <input type="text" class="form-control" name="name" value="{{old('name')}}">
                    </div>
                    <div class="mt-3">
                        @error('name')
                            <p class="alert alert-danger">{{$message}}</p>
                        @enderror
                    </div>
                    <div class="mt-3">
                        <label for="email">Email*</label>
                        <input type="email" class="form-control" name="email" value="{{old('email')}}">
                        @error('email')
                            <p class="alert alert-danger">{{$message}}</p>
                        @enderror
                    </div>
                    <div class="mt-3">
                        <label for="phone">Phone*</label>
                        <input type="text" class="form-control" name="phone" value="{{old('phone')}}">
                    </div >
                    <div class="mt-3">
                        @error('phone')
                            <p class="alert alert-danger">{{$message}}</p>
                        @enderror
                    </div>
                    <div class="mt-3">
                        <label for="balance">Balance</label>
                        <input type="text" class="form-control" name="balance" value="{{old('balance')}}">
                    </div>
                    <div class="mt-3">
                        @error('balance')
                            <p class="alert alert-danger">{{$message}}</p>
                        @enderror
                    </div>
                    <div class="mt-3">
                        <label for="password">Password*</label>
                        <input type="password" class="form-control" name="password">
                    </div>
                    <div class="mt-3">
                        @error('password')
                            <p class="alert alert-danger">{{$message}}</p>
                        @enderror
                    </div>

                    <div class="mt-3">
                        <select name="role" class="form-select" aria-label="Default select example">
                            <option>Select User Type*</option>
                            @foreach($role as $role)
                            <option value="{{$role->value}}">{{$role->name}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mt-3">
                        @error('role')
                            <p class="alert alert-danger">{{$message}}</p>
                        @enderror
                    </div>
                    <div class="mt-3">
                        <button type="submit" class="btn btn-info">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    @endsection
