
@extends('layouts.flowAuth')

@section('title')

@endsection
    <title>FaithFlow -- Reset Password</title>
@section('content')

<div class="col-lg-6 col-xl-5">
    <h2 class="mb-6 fs-8 fw-bolder">Reset your password</h2>
    <p class="text-dark fs-4 mb-7"></p>

    @if ($errors->any())
    <div class="text-danger">
        <ul class="mb-3">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif

    <form method="POST" action="{{ route('password.update') }}">
        @csrf

        <input type="hidden" name="token" value="{{ $request->route('token') }}">


        <div class="mb-3">
          <label for="email" class="form-label fw-bold">Email</label>
          <input type="email" class="py-2 form-control" id="email" aria-describedby="email" name="email" :value="old('email')" required autocomplete="username">
        </div>

        <div class="mb-3">
          <label for="password" class="form-label fw-bold">Password</label>
          <input type="password" class="py-2 form-control" id="password" name="password" required autocomplete="new-password" >
        </div>

        <div class="mb-4">
            <label for="password_confirmation" class="form-label fw-bold">Confirm Password</label>
            <input type="password" class="py-2 form-control" id="password_confirmation" name="password_confirmation" required autocomplete="new-password" >
        </div>

        <button type="submit" class="mb-3 btn btn-primary w-100 rounded-pill">Reset Password</button>

    </form>

</div>

  @endsection


