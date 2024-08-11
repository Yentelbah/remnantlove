
@extends('layouts.flowAuth')

@section('title')

@endsection
    <title>FaithFlow</title>
@section('content')


<div class="col-lg-6 col-xl-5">
    <h2 class="mb-6 text-center fs-8 fw-bolder">Welcome</h2>
    <p class="text-center text-dark fs-4 mb-7">Manage and Grow your church with ease.</p>
    <form>
        @if (Route::has('login'))
        <div class="z-10 p-6 text-right sm:fixed sm:top-0 sm:right-0">
            @auth
            <a href="{{ url('/dashboard') }}" class="mb-3 btn btn-primary w-100 rounded-pill">Go to Dashboard</a>
            @else
                <a href="{{ route('login') }}" class="mb-3 btn btn-primary w-100 rounded-pill">Log In</a>

                @if (Route::has('register'))
                <a href="{{ route('register') }}" class="mb-3 btn btn-primary w-100 rounded-pill">Register</a>
            @endif
            @endauth
        </div>
        @endif
    </form>
  </div>

  @endsection
