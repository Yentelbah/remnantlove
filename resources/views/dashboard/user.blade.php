@extends('layouts.flow')

@section('title')
  <title>Dashboard</title>
@endsection


@section('content')
<div class="col-lg-12 col-xl-12">
    <div class="card">
      <div class="card-body position-relative">
        <div>
          <h4 class="mb-1 card-title">Welcome {{ Auth()->user()->name }}</h4>
          <p class="pb-1 mb-3 card-subtitle">You are welcome.</p>
          <p class="pb-1 mb-3 card-subtitle">You account setup is incomplete. Complete the setup proces by setting up your church.</p>
          <button class="btn btn-primary rounded-pill" type="button">
            Complete Setup
          </button>
        </div>
        <div class="school-img d-none d-sm-block">
          <img src="../assets/images/backgrounds/school.png" class="img-fluid" alt="spike-img" />
        </div>

        <div class="text-center d-sm-none d-block">
          <img src="../assets/images/backgrounds/school.png" class="img-fluid" alt="spike-img" />
        </div>
      </div>
    </div>
  </div>
@endsection

@section('scripts')


@endsection
