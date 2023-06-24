@extends('dashboard.master.master')

    @section('content')

        <div class="card-body col-10">
            <div class="h1 text-center mt-4">
                <h2>Welcome To My Payment System</h2>
            </div>
            @if (empty(Auth::user()->id))
                <div class="mt-4 text-center">
                    <span><a class="btn " href="{{route('login')}}">Log In</a></span>
                    <span><a class="btn " href="{{route('register')}}">Register</a></span>
                </div>

            @else
                <div class="mt-4 text-center">
                    <span><a class="btn " href="{{route('dashboard')}}">Dashboard</a></span>
                </div>

            @endif

        </div>

    @endsection
