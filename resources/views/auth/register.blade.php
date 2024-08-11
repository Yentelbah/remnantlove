
@extends('layouts.flowAuth')

@section('title')

@endsection
    <title>FaithFlow -- Register</title>
@section('content')

<div class="col-lg-6 col-xl-5">
    <h2 class="mb-6 fs-8 fw-bolder">Register An Account</h2>
    <p class="text-dark fs-4 mb-7">This sets up a new user and a new church profile.</p>

    @if ($errors->any())
    <div class="text-danger">
        <ul class="mb-3">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif

    <form method="POST" action="{{ route('register') }}">
        @csrf
        <div class="row">
            <div class="mb-3 col-md-6">
                <label for="name" class="form-label fw-bold">Name</label>
                <input class="py-2 form-control" id="name" type="text" placeholder="" aria-label="name" name="name" :value="old('name')" required autofocus autocomplete="name">
            </div>

            <div class="mb-3 col-md-6">
                <label for="email" class="form-label fw-bold">Email</label>
                <input type="email" class="py-2 form-control" id="email" aria-describedby="email" name="email" :value="old('email')" required autocomplete="username">
            </div>

            <div class="mb-3 col-md-6">
                <label for="password" class="form-label fw-bold">Password</label>
                <input type="password" class="py-2 form-control" id="password" name="password" required autocomplete="new-password" >
            </div>

            <div class="mb-3 col-md-6">
                    <label for="password_confirmation" class="form-label fw-bold">Confirm Password</label>
                    <input type="password" class="py-2 form-control" id="password_confirmation" name="password_confirmation" required autocomplete="new-password" >
            </div>

            <div class="mb-3 col-md-6">
                <label for="church" class="form-label fw-bold">Name of Church</label>
                <input class="py-2 form-control" id="church" type="text" placeholder="" aria-label="church" name="church" :value="old('church')" required >
            </div>

            <div class="mb-3 col-md-6">
                <label for="phone" class="form-label fw-bold">Phone</label>
                <input class="py-2 form-control" id="phone" type="text" placeholder="" aria-label="phone" name="phone" :value="old('phone')" required >
            </div>

        </div>

        {{-- @if (Laravel\Jetstream\Jetstream::hasTermsAndPrivacyPolicyFeature()) --}}
        <div class="mb-4 form-check mb-md-4">
            <input class="form-check-input primary" type="checkbox" value="" id="terms" name="terms" required>
            <label class="form-check-label text-dark fs-3" for="terms"><a href="">Terms of Use</a></label>
        </div>
        {{-- @endif --}}

        <button type="submit" class="mb-3 btn btn-primary w-100 rounded-pill">Register</button>
        <div class="d-flex align-items-center">
          <p class="mb-0 fs-3 fw-medium">Already have an Account?</p>
          <a class="text-primary fw-bold ms-2 fs-3" href="{{ route('login') }}">Log In</a>
        </div>
    </form>

</div>

  @endsection


