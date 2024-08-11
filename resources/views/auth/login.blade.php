
@extends('layouts.flowAuth')

@section('title')

@endsection
    <title>FaithFlow -- Login</title>
@section('content')

<div class="col-lg-6 col-xl-5">
    <h2 class="mb-6 fs-8 fw-bolder">Log in to your account!</h2>
    <p class="text-dark fs-4 mb-7">Provide you account credentials.</p>

    @if (session('status'))
        <div class="mb-4 text-sm font-medium text-success">
            {{ session('status') }}
        </div>
    @endif

    @if ($errors->any())
    <div class="text-danger">
        <ul class="mb-3">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif

    <form method="POST" action="{{ route('login') }}">
        @csrf
        <div class="mb-3">
          <label for="email" class="form-label fw-bold">Username</label>
          <input type="email" class="py-2 form-control" id="email" aria-describedby="emailHelp" name="email" :value="old('email')" required autofocus autocomplete="username">
        </div>

        <div class="mb-3">
          <label for="password" class="form-label fw-bold">Password</label>
          <input type="password" class="py-2 form-control" id="password"  name="password" required autocomplete="current-password">
        </div>

        <div class="pb-1 mb-3 d-md-flex align-items-center justify-content-between">
          <div class="mb-3 form-check mb-md-0">
            <input class="form-check-input primary" type="checkbox" value="" id="remember_me" name="remember" checked>
            <label class="form-check-label text-dark fs-3" for="remember_me">Remeber me</label>
          </div>

          @if (Route::has('password.request'))
          <a class="text-primary fw-medium fs-3 fw-bold" href="{{ route('password.request') }}">Forgot your password?</a>
          @endif
        </div>

        <button type="submit" class="mb-3 btn btn-primary w-100 rounded-pill">Log In</button>
        <div class="d-flex align-items-center">
          <p class="mb-0 fs-3 fw-medium">You do not have an account?</p>
          <a class="text-primary fw-bold ms-2 fs-3" href="{{ route('register') }}">Register</a>
        </div>
    </form>
</div>

  @endsection


