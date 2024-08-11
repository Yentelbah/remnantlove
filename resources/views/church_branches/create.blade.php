
@extends('layouts.flow')

@section('title')
    <title>FaithFlow -- Branches</title>
@endsection

@section('content')
  <div class="mb-3 overflow-hidden position-relative">
    <div class="px-3 d-sm-flex align-items-center justify-content-between">
      <h4 class="mb-0 fs-6">Create Branch</h4>
      <nav aria-label="breadcrumb">
        <ol class="mb-0 breadcrumb">
          <li class="breadcrumb-item">
            <a href="{{ route('dashboard') }}">Dashboard</a>
          </li>
          <li class="breadcrumb-item">
            <a href="{{ route('branch.index') }}">Branches</a>
          </li>
          <li class="breadcrumb-item" aria-current="page">Add Branch</li>
        </ol>
      </nav>
    </div>
  </div>


  <div class="card">
    <div class="card-body wizard-content">
      <h4 class="mb-6 card-title">New Branch Information</h4>
      <br>
      <form action="{{ route('branch.store') }}" method="POST" class="tab-wizard wizard-circle">
        @csrf

            <div class="mx-auto row d-flex">
                <!-- Input fields -->
                <div class="order-2 col-lg-8 col-12 order-lg-1">


                    <div class="row">
                        <div class="mb-3 col-md-6">
                            <label class="form-label" for="pastor_id">Branch Pastor</label>
                            <select class="form-select" id="pastor_id" name="pastor_id">
                                <option value="">Select Pastor</option>
                                @foreach ($pastors as $result)
                                <option value="{{ $result->id }}">{{ $result->member->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="mb-3 col-md-6">
                          <label for="name" class="form-label">Branch Name</label>
                          <input class="form-control @error('name') is-invalid @enderror" type="text" id="name" name="name" value="{{ session('data')->name ?? '' }}" autofocus />


                            @error('name')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>

                        <div class="mb-3 col-md-6">
                          <label for="address" class="form-label">Address</label>
                          <input class="form-control @error('address') is-invalid @enderror" type="text" name="address" id="address" value="{{ session('data')->address ?? '' }}" />
                          @error('address')
                          <span class="invalid-feedback" role="alert">
                              <strong>{{ $message }}</strong>
                          </span>
                          @enderror
                        </div>

                        <div class="mb-3 col-md-6">
                          <label for="city" class="form-label">City</label>
                          <input class="form-control @error('city') is-invalid @enderror" type="text" id="city" name="city" value="{{ session('data')->city ?? '' }}"/>
                          @error('city')
                          <span class="invalid-feedback" role="alert">
                              <strong>{{ $message }}</strong>
                          </span>
                          @enderror
                        </div>

                        <div class="mb-3 col-md-6">
                          <label for="region" class="form-label">Region</label>
                          <input type="text" class="form-control @error('region') is-invalid @enderror" id="region"
                              name="region" value="{{ session('data')->region ?? '' }}"/>
                          @error('region')
                          <span class="invalid-feedback" role="alert">
                              <strong>{{ $message }}</strong>
                          </span>
                          @enderror
                        </div>

                        <div class="mb-3 col-md-6">
                          <label for="country" class="form-label">Country</label>
                          <input type="text" class="form-control @error('country') is-invalid @enderror" id="country" name="country" value="{{ session('data')->country ?? '' }}"/>
                          @error('country')
                          <span class="invalid-feedback" role="alert">
                              <strong>{{ $message }}</strong>
                          </span>
                          @enderror
                        </div>

                        <div class="mb-3 col-md-6">
                          <label for="phone" class="form-label">Phone</label>
                          <input type="text" class="form-control @error('phone') is-invalid @enderror" id="phone" name="phone"value="{{ session('data')->phone ?? '' }}" />
                          @error('phone')
                          <span class="invalid-feedback" role="alert">
                              <strong>{{ $message }}</strong>
                          </span>
                          @enderror
                        </div>

                        <div class="mb-3 col-md-6">
                          <label for="phone2" class="form-label">Alternate Phone</label>
                          <input type="text" class="form-control @error('phone2') is-invalid @enderror" id="phone2" name="phone2" value="{{ session('data')->phone2 ?? '' }}"/>
                          @error('phone2')
                          <span class="invalid-feedback" role="alert">
                              <strong>{{ $message }}</strong>
                          </span>
                          @enderror
                        </div>

                      </div>

                </div>

                <!-- Image -->
                <div class="order-1 col-lg-4 col-12 d-flex justify-content-center order-lg-2">
                    <img src="../assets/images/backgrounds/branch2.svg" alt="" class="img-fluid" width="100%">
                </div>
            </div>
        </section>

          <div class="col-12">
            <div class="gap-6 mt-4 d-flex align-items-center justify-content-end">
              <button class="btn btn-primary" type="submit" >Create Branch</button>
            </div>
        </div>
        </section>
      </form>
    </div>
  </div>
@endsection

@section('scripts')

@endsection
