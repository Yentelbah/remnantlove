
@extends('layouts.flow')

@section('title')
    <title>FaithFlow -- Staff</title>
@endsection

@section('content')
  <div class="mb-3 overflow-hidden position-relative">
    <div class="px-3 d-sm-flex align-items-center justify-content-between">
      <h4 class="mb-0 fs-6">Add Staff</h4>
      <nav aria-label="breadcrumb">
        <ol class="mb-0 breadcrumb">
          <li class="breadcrumb-item">
            <a href="{{ route('dashboard') }}">Dashboard</a>
          </li>
          <li class="breadcrumb-item">
            <a href="{{ route('member.index') }}">Members</a>
          </li>
          <li class="breadcrumb-item">
            <a href="{{ route('staff.index') }}">Staff</a>
          </li>
          <li class="breadcrumb-item" aria-current="page">Add Staff</li>
        </ol>
      </nav>
    </div>
  </div>


  <div class="card">
    <div class="card-body wizard-content">
      <h4 class="mb-6 card-title">New Staff Information</h4>
      <br>
      <form action="{{ route('staff.store') }}" method="POST" class="tab-wizard wizard-circle">
        @csrf

            <div class="mx-auto row d-flex">
                <!-- Input fields -->
                <div class="order-2 col-lg-8 col-12 order-lg-1">

                    <div class="mb-3 form-group">
                        <label class="form-label" for="member">Select Member</label>
                        <select class="form-select" id="member" name="member_id">
                            <option value="">Select a member</option>
                            @foreach ($members as $result)
                            <option value="{{ $result->id }}">{{ $result->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="row">
                        <div class="mb-3 form-group col-md-6">
                            <label class="form-label" for="education_background">Education Background</label>
                            <input type="text" class="form-control" id="education_background" name="education_background">
                        </div>


                        <div class="mb-3 form-group col-md-6">
                            <label class="form-label" for="position">Position</label>
                            <input class="form-control  @error('position') is-invalid @enderror" name="position" id="le_position">
                            @error('position')
                            <small class="invalid-feedback" role="alert">
                              {{ $message }}
                            </small>
                            @enderror
                        </div>

                        <div class="mb-3 form-group col-md-6">
                            <label class="form-label" for="health_status">Health Status</label>
                            <textarea class="form-control" id="health_status" name="health_status" rows="3"></textarea>
                          </div>

                          <div class="mb-3 form-group col-md-6">
                            <label class="form-label" for="hobbies_interests">Hobbies and Interests</label>
                            <textarea class="form-control" id="hobbies_interests" name="hobbies_interests" rows="3"></textarea>
                          </div>
                    </div>




                      <div class="mb-3 form-group">
                          <label class="form-label" for="date_appointed">Date Appointed</label>
                          <input type="date" name="date_appointed" class="form-control  @error('name') is-invalid @enderror" id="date_appointed">
                          @error('date_appointed')
                          <small class="invalid-feedback" role="alert">
                            {{ $message }}
                          </small>
                          @enderror
                     </div>

                </div>

                <!-- Image -->
                <div class="order-1 col-lg-4 col-12 d-flex justify-content-center order-lg-2">
                    <img src="../assets/images/backgrounds/certify.svg" alt="" class="img-fluid" width="80%">
                </div>
            </div>
        </section>

          <div class="col-12">
            <div class="gap-6 mt-4 d-flex align-items-center justify-content-end">
              <button class="btn btn-success" type="submit" >Create Staff</button>
            </div>
        </div>
        </section>
      </form>
    </div>
  </div>
@endsection

@section('scripts')

@endsection
