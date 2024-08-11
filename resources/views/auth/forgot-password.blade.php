
@extends('layouts.flowAuth')

@section('title')

@endsection
    <title>FaithFlow -- Forgot Password</title>
@section('content')

<div class="col-lg-6 col-xl-5">
    <h2 class="mb-6 fs-8 fw-bolder">Forgot your password?</h2>
    <p class="text-dark fs-4 mb-7">Please enter the email address associated with your account and We will email you a link to reset your password.</p>

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

      <form method="POST" action="{{ route('password.email') }}">
        @csrf
          <div class="mb-7">
        <label for="email" class="form-label fw-bold">Email address</label>
        <input type="email" class="py-2 form-control" id="email" aria-describedby="emailHelp" name="email" :value="old('email')" required autofocus autocomplete="username">
      </div>
      <button type="submit" class="mb-3 btn btn-primary w-100 rounded-pill">Email Password Reset Link</button>
      <a href="{{ route('login') }}" class="btn bg-primary-subtle text-primary w-100 rounded-pill">Back
        to Login</a>
    </form>

</div>

  @endsection


