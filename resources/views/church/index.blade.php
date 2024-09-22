@extends('layouts.flow')

@section('title')
     <title>FaithFLow -- Church Profile</title>
@endsection


@section('content')

    <div class="mb-3 overflow-hidden position-relative">
        <div class="px-3 d-sm-flex align-items-center justify-content-between">
        <h4 class="mb-0 fs-6">Church Profile</h4>
        <nav aria-label="breadcrumb">
            <ol class="mb-0 breadcrumb">
            <li class="breadcrumb-item">
                <a href="{{ route('dashboard') }}">Dashboard</a>
            </li>
            <li class="breadcrumb-item" aria-current="page">Church Profile</li>
            </ol>
        </nav>
        </div>
    </div>

    <div class="overflow-hidden position-relative rounded-3">
      <img src="../assets/images/backgrounds/profilebg-2.jpg" alt="spike-img" class="w-100">
    </div>

    <div class="card mx-9 mt-n5">
      <div class="pb-0 mb-4 card-body ">
        <div class="text-center d-md-flex align-items-center justify-content-between text-md-start">
          <div class="d-md-flex align-items-center">
            <div class="rounded-circle position-relative mb-9 mb-md-0 d-inline-block">
                <img src="{{ $church->logo == '' ?  '../assets/images/profile/user-1.jpg' : asset('storage/' . $church->logo) }}" alt="spike-img" class="img-fluid rounded-1 preview" width="100" height="100">

                <span class="bottom-0 p-1 text-white border border-2 border-white text-bg-primary rounded-circle d-flex align-items-center justify-content-center position-absolute end-0">
                <i class="ti ti-plus" data-bs-toggle="modal" data-bs-target="#imageModal" id="#modalCenter"></i>
              </span>

            </div>
            <div class="ms-0 ms-md-3 mb-9 mb-md-0">
              <div class="mb-1 d-flex align-items-center justify-content-center justify-content-md-start">
                <h4 class="mb-0 me-7 fs-7">{{ isset($church) ? $church->name : '' }}</h4>
                <span class="border badge fs-2 fw-bold rounded-pill bg-primary-subtle text-primary border-primary">Main</span>
              </div>
              <div class="d-flex align-items-center justify-content-center justify-content-md-start">
                <button type="button" class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#editComModal">Update Church Profile </button>
            </div>
            </div>
          </div>
        </div>
      </div>
    </div>

    @include('church.uploadimage')
    @include('church.edit')

    <div class="card">
        <div class="card-body">
                <div class="row">
                    <div class="col-sm-6">
                        <p>Address:<br><strong>{{ isset($church) ? $church->address : '' }}</strong></p>
                        <p>City:<br> <strong>{{ isset($church) ? $church->city : '' }}, {{ isset($church) ? $church->region : '' }}</strong></p>
                        <p>Country:<br> <strong>{{ isset($church) ? $church->country : '' }}</strong></p>
                    </div>
                    <div class="col-sm-6">
                        <p>Phone:<br> <strong>{{ isset($church) ? $church->phone : '' }}</strong></p>
                        <p>Alternate Phone: <br><strong>{{ isset($church) ? $church->phone2 : '' }}</strong></p>
                        <p>Email: <br><strong>{{ isset($church) ? $church->email : '' }}</strong></p>
                    </div>
                </div>
        </div>
    </div>
@endsection

