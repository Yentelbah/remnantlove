
@extends('layouts.flowAuth')

@section('title')

@endsection
    <title>FaithFlow -- Verify Email</title>
@section('content')

<div class="col-lg-6 col-xl-5">
    <h2 class="mb-6 fs-8 fw-bolder">Verify your email!</h2>
    <p class="text-dark fs-4 mb-7">Before continuing, could you verify your email address by clicking on the link we just emailed to you? If you didn\'t receive the email, we will gladly send you another.</p>

    @if (session('status') == 'verification-link-sent')
        <div class="mb-4 text-sm font-medium text-success">
            {{ __('A new verification link has been sent to the email address you provided in your profile settings.') }}
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

    <form method="POST" action="{{ route('verification.send') }}">
        @csrf

        <button type="submit" class="mb-3 btn btn-primary w-100 rounded-pill">Resend Verification Email</button>


    </form>

    <div>
        <a href="{{ route('profile.show') }}" class="text-sm text-gray-600 underline rounded-md hover:text-gray-900 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">{{ __('Edit Profile') }}</a>

        <form method="POST" action="{{ route('logout') }}" class="inline">
            @csrf

            <button type="submit" class="text-sm text-gray-600 underline rounded-md hover:text-gray-900 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 ms-2">{{ __('Log Out') }}</button>
        </form>
    </div>

</div>

  @endsection


