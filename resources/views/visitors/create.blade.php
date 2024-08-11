
@extends('layouts.flow')

@section('title')
    <title>FaithFlow -- Visitors</title>
@endsection

@section('content')
  <div class="mb-3 overflow-hidden position-relative">
    <div class="px-3 d-sm-flex align-items-center justify-content-between">
      <h4 class="mb-0 fs-6">Add Leader</h4>
      <nav aria-label="breadcrumb">
        <ol class="mb-0 breadcrumb">
          <li class="breadcrumb-item">
            <a href="{{ route('dashboard') }}">Dashboard</a>
          </li>
          <li class="breadcrumb-item">
            <a href="{{ route('visitors.index') }}">Visitors</a>
          </li>
          <li class="breadcrumb-item" aria-current="page">Add Visitor</li>
        </ol>
      </nav>
    </div>
  </div>


  <div class="card">
    <div class="card-body wizard-content">
      <h4 class="mb-6 card-title">New Visitor Information</h4>
      <br>
      <form action="{{ route('visitors.store') }}" method="POST" class="tab-wizard wizard-circle">
        @csrf

            <div class="mx-auto row d-flex">
                <!-- Input fields -->
                <div class="order-2 col-lg-8 col-12 order-lg-1">


                    <div class="mb-3 form-group">
                        <label class="form-label" for="name">Name</label>
                        <input class="form-control  @error('title') is-invalid @enderror" name="name" id="le_name">
                        @error('name')
                        <small class="invalid-feedback" role="alert">
                          {{ $message }}
                        </small>
                        @enderror
                    </div>

                    <div class="mb-3 form-group">
                        <label class="form-label" for="phone">Phone</label>
                        <input class="form-control  @error('phone') is-invalid @enderror" name="phone" id="le_phone">
                        @error('phone')
                        <small class="invalid-feedback" role="alert">
                          {{ $message }}
                        </small>
                        @enderror
                    </div>

                    <div class="mb-3 form-group">
                        <label class="form-label" for="date_visited">Date Visited</label>
                        <input type="date" name="date_visited" class="form-control  @error('name') is-invalid @enderror" id="date_visited">
                        @error('date_visited')
                        <small class="invalid-feedback" role="alert">
                        {{ $message }}
                        </small>
                        @enderror
                    </div>

                    <div class="mb-3 form-group">
                        <label class="form-label" for="location">Location</label>
                        <input class="form-control  @error('location') is-invalid @enderror" name="location" id="le_location">
                        @error('location')
                        <small class="invalid-feedback" role="alert">
                          {{ $message }}
                        </small>
                        @enderror
                    </div>


                </div>

                <!-- Image -->
                <div class="order-1 col-lg-4 col-12 d-flex justify-content-center order-lg-2">
                    <img src="../assets/images/backgrounds/new.svg" alt="" class="img-fluid" width="100%">
                </div>


            </div>



        </section>



          <div class="col-12">
            <div class="gap-6 mt-4 d-flex align-items-center justify-content-end">
              <button class="btn btn-success" type="submit">Save</button>
            </div>
        </div>
        </section>
      </form>
    </div>
  </div>
@endsection

@section('scripts')

@endsection
