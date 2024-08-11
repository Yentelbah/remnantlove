
@extends('layouts.flowAuth')

@section('title')

@endsection
    <title>FaithFlow -- Confirm Password</title>
@section('content')

<div class="col-lg-6 col-xl-5">
    <h2 class="mb-6 fs-8 fw-bolder">Confirm password!</h2>
    <p class="text-dark fs-4 mb-7">This is a secure area of the application. Please confirm your password before continuing.</p>

    @if ($errors->any())
    <div class="text-danger">
        <ul class="mb-3">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif

      <form method="POST" action="{{ route('password.confirm') }}">
        @csrf
          <div class="mb-7">
            <label for="password" class="form-label fw-bold">Password</label>
            <input type="password" class="py-2 form-control" id="password" name="password" required autofocus autocomplete="current-password">
        </div>

      <button type="submit" class="mb-3 btn btn-primary w-100 rounded-pill">Confirm</button>
    </form>

</div>

  @endsection


