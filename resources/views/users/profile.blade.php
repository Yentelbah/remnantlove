@extends('layouts.main')

@section('title')
    <title>Profile</title>
@endsection

@section('content')



  <div class="container-fluid flex-grow-1 container-p-y">

    <div class="card mb-4">
        <h5 class="card-header">Profile Details</h5>
        <div class="card-body">
            <div class="d-flex align-items-start align-items-sm-center gap-4">
              <div class="button-wrapper">
                  <form action="{{ route('upload.profile.image') }}" method="POST" enctype="multipart/form-data">
                      @csrf
                      <label for="uploadLogo" class="btn btn-primary me-2 mb-4">
                          <i class="bx bx-upload"></i> Choose Profile Photo
                      </label>
                      <input type="file" name="logo" id="uploadLogo" accept="image/*" class="inputfile" hidden>
                  </form>

                  <p class="text-muted mb-0">Allowed JPG or PNG.</p>
              </div>
                @if($userDetails->photo)
                  <img src="{{ asset('storage/' . $userDetails->photo) }}"  alt="logo"
                    class="d-block rounded"
                    height="100"
                    width="100"
                    id="photo">
                @endif
            </div>
        </div>
        <!-- Account -->
        <div class="card-body">

            <div class="row">
                <div class="mb-3 col-md-6">
                    <label for="name" class="form-label">Staff Number</label>
                    <input
                      class="form-control"
                      type="text"
                      id="name"
                      name="name" disabled
                      value="{{ $userDetails->employee->employee_number ?? '' }}"
                      autofocus
                    />
                  </div>

              <div class="mb-3 col-md-6">
                <label for="name" class="form-label">Name</label>
                <input
                  class="form-control"
                  type="text"
                  id="name"
                  name="name"
                  value="{{ $userDetails->name ?? '' }}"
                  autofocus
                />
              </div>
              <div class="mb-3 col-md-6">
                <label for="gender" class="form-label">Gender</label>
                <input class="form-control" type="text" name="gender" id="gender" value="{{ $userDetails->employee->gender ?? '' }}" />
              </div>
              <div class="mb-3 col-md-6">
                <label for="dob" class="form-label">Date of birth</label>
                <input class="form-control" type="text" name="dob" id="dob" value="{{ $userDetails->employee->dob ?? '' }}" />
              </div>
              <div class="mb-3 col-md-6">
                <label for="email" class="form-label">E-mail</label>
                <input
                  class="form-control"
                  type="text"
                  id="email"
                  name="email"
                  value="{{ $userDetails->email ?? '' }}"
                  placeholder="john.doe@example.com"
                />
              </div>
              <div class="mb-3 col-md-6">
                <label for="phone" class="form-label">Phone</label>
                <input
                  type="text"
                  class="form-control"
                  id="phone"
                  name="phone"
                  value="{{ $userDetails->phone ?? '' }}"
                />
              </div>
              <div class="mb-3 col-md-6">
                <label for="phone2" class="form-label">Second Phone</label>
                <input
                  type="text"
                  class="form-control"
                  id="phone2"
                  name="phone2"
                  value="{{ $userDetails->employee->phone2 ?? '' }}"
                />
              </div>
              <div class="mb-3 col-md-6">
                <label for="address" class="form-label">Address</label>
                <input type="text" class="form-control" id="address" name="address" value="{{ $userDetails->employee->address ?? '' }}" />
              </div>
              <div class="mb-3 col-md-6">
                <label for="location" class="form-label">Location</label>
                <input class="form-control" type="text" id="location" name="location" value="{{ $userDetails->employee->location ?? '' }}" />
              </div>
              <div class="mb-3 col-md-6">
                <label for="qualifcation" class="form-label">Qualification</label>
                <input
                  type="text"
                  class="form-control"
                  id="qualifcation"
                  name="qualifcation"
                  value="{{ $userDetails->employee->qualification ?? '' }}"
                />
              </div>

              <div class="mb-3 col-md-6">
                <label for="job_title" class="form-label">Job Title</label>
                <input
                  type="text"
                  class="form-control"
                  id="job_title"
                  name="job_title"
                  value="{{ $userDetails->employee->job_title ?? '' }}"
                  maxlength="6"
                />
              </div>

              <div class="mb-3 col-md-6">
                <label for="employ_date" class="form-label">Date of employment</label>
                <input
                  type="text"
                  class="form-control"
                  id="employ_date"
                  name="employ_date"
                  value="{{ $userDetails->employee->employ_date ?? '' }}"
                  maxlength="6"
                />
              </div>

              <div class="mb-3 col-md-6">
                <label for="role" class="form-label">User Role</label>
                <input
                  type="text"
                  class="form-control"
                  id="role"
                  name="role"
                  value="{{ $userDetails->companyRole->name ?? '' }}"
                  maxlength="6"
                />
              </div>
            </div>
        </div>
        <!-- /Account -->
    </div>

  </div>


@endsection

@section('scripts')

  <script>
    document.getElementById('uploadLogo').addEventListener('change', function () {
        // Check if a file is selected
        if (this.files.length > 0) {
            // Submit the form when a file is selected
            this.parentElement.submit();
        }
    });
  </script>

@endsection
