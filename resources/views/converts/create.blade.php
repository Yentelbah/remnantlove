
@extends('layouts.flow')

@section('title')
    <title>FaithFlow -- Converts</title>
@endsection

@section('content')
  <div class="mb-3 overflow-hidden position-relative">
    <div class="px-3 d-sm-flex align-items-center justify-content-between">
      <h4 class="mb-0 fs-6">Add Convert</h4>
      <nav aria-label="breadcrumb">
        <ol class="mb-0 breadcrumb">
          <li class="breadcrumb-item">
            <a href="{{ route('dashboard') }}">Dashboard</a>
          </li>
          <li class="breadcrumb-item">
            <a href="{{ route('converts.index') }}">Converts</a>
          </li>
          <li class="breadcrumb-item" aria-current="page">Add Convert</li>
        </ol>
      </nav>
    </div>
  </div>


  <div class="card">
    <div class="card-body wizard-content">
      <h4 class="mb-6 card-title">New Convert Information</h4>
      <br>
      <form action="{{ route('converts.store') }}" method="POST" class="tab-wizard wizard-circle">
        @csrf

            <div class="mx-auto row d-flex">
                <!-- Input fields -->
                <div class="order-2 col-lg-8 col-12 order-lg-1">

                    <div class="mb-3 col-md-6">
                        <label class="form-label" for="name">Name</label>
                        <input class="form-control  @error('name') is-invalid @enderror" name="name" id="le_name">
                        @error('name')
                        <small class="invalid-feedback" role="alert">
                          {{ $message }}
                        </small>
                        @enderror
                    </div>

                    <div class="mb-3 col-md-6">
                        <label for="gender">Gender</label>
                        <select class="form-control @error('gender') is-invalid @enderror" id="gender" name="gender">
                            <option value="">Select gender</option>
                            <option value="Male">Male</option>
                            <option value="Female">Female</option>
                        </select>
                        @error('gender')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3 col-md-6">
                        <label class="form-label" for="name">Date of birth</label>
                        <input type="date" name="dob" class="form-control @error('dob') is-invalid @enderror" id="dob">
                        @error('dob')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3 col-lg-6">
                        <label class="form-label" for="occupation">Occupation</label>
                        <input class="form-control  @error('occupation') is-invalid @enderror" name="occupation" id="le_occupation">
                        @error('occupation')
                        <small class="invalid-feedback" role="alert">
                        {{ $message }}
                        </small>
                        @enderror
                    </div>


                    <div class="mb-3 col-md-6">
                        <label class="form-label" for="phone">Phone</label>
                        <input class="form-control  @error('phone') is-invalid @enderror" name="phone" id="le_phone">
                        @error('phone')
                        <small class="invalid-feedback" role="alert">
                          {{ $message }}
                        </small>
                        @enderror
                    </div>

                    <div class="mb-3 col-md-6">
                        <label class="form-label" for="email">Email</label>
                        <input type="email" class="form-control  @error('email') is-invalid @enderror" name="email" id="le_email">
                        @error('email')
                        <small class="invalid-feedback" role="alert">
                          {{ $message }}
                        </small>
                        @enderror
                    </div>

                    <div class="mb-3 col-lg-6">
                        <label class="form-label" for="preferred_contact">Preferred Contact</label>
                        <select class="form-control @error('preferred_contact') is-invalid @enderror" id="preferred_contact" name="preferred_contact">
                            <option value="">Select</option>
                            <option value="Email">Email</option>
                            <option value="Phone">Phone</option>
                            <option value="Text">Text Message</option>
                        </select>
                        @error('preferred_contact')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3 col-lg-6">
                        <label class="form-label" for="best_time">Best Time to Ring</label>
                        <input type="text" name="best_time" class="form-control  @error('best_time') is-invalid @enderror" placeholder="Morning 8:00am" id="best_time">
                        @error('best_time')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>


                    <div class="mb-3 col-md-6">
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
                    <img src="../assets/images/backgrounds/convert.svg" alt="" class="img-fluid" width="100%">
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
