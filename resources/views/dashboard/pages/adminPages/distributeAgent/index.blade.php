@extends('dashboard.master.master')

    @section('content')
        <div class="card">
            <div class="card-header">
                <h3>Distribute: (Admin to Agent)</h3>
            </div>
            <div class="card-body col-8">
                @if (\Session::has('message'))
                    <div class="alert alert-danger">
                        <ul>
                            <li>{!! \Session::get('message') !!}</li>
                        </ul>
                    </div>
                @endif
                @if (\Session::has('messages'))
                    <div class="alert alert-success">
                        <ul>
                            <li>{!! \Session::get('messages') !!}</li>
                        </ul>
                    </div>
                @endif
                <form action="{{route('admin.distribute.agent.store')}}" method="post">
                    @csrf
                    <div class="mt-3">
                        <label for="phone">Phone Number*</label>
                        <input type="text" class="form-control" name="phone" value="{{old('phone')}}">
                    </div >
                    <div class="mt-3">
                        @error('phone')
                            <p class="alert alert-danger">{{$message}}</p>
                        @enderror
                    </div>
                    <div class="mt-3">
                        <label for="balance">Transfer Amount*</label>
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
                        <button type="submit" class="btn btn-info">Submit</button>
                    </div>
                </form>
            </div>
        </div>

    @endsection
