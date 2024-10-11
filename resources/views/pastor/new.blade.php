
@extends('layouts.flow')

@section('title')
    <title>FaithFlow -- Pastors</title>
@endsection

@section('content')
  <div class="mb-3 overflow-hidden position-relative">
    <div class="px-3 d-sm-flex align-items-center justify-content-between">
      <h4 class="mb-0 fs-6">Pastors</h4>
      <nav aria-label="breadcrumb">
        <ol class="mb-0 breadcrumb">
          <li class="breadcrumb-item">
            <a href="{{ route('dashboard') }}">Dashboard</a>
          </li>
          <li class="breadcrumb-item">
            <a href="{{ route('member.index') }}">Members</a>
          </li>
          <li class="breadcrumb-item">
            <a href="{{ route('pastor.index') }}">Pastors</a>
          </li>
          <li class="breadcrumb-item" aria-current="page">Add Pastor</li>
        </ol>
      </nav>
    </div>
  </div>


  <div class="card">
    <div class="card-body wizard-content">
      <h4 class="mb-0 card-title">New Pastor Information</h4>
      <h6 class="mb-3 card-subtitle"></h6>
      <form action="{{ route('pastor.store') }}" method="POST" class="tab-wizard wizard-circle">
        @csrf
        <!-- Step 1 -->
        <h6>Basic Info</h6>
        <section>
            <div class="mx-auto row d-flex">
                <!-- Input fields -->
                <div class="order-2 col-lg-8 col-12 order-lg-1">
                    <div class="mb-3">
                        <label class="form-label" for="firstName1">Member type:</label>
                        <select class="form-select" id="memberType" name="member_type">
                            <option value="">Select member type</option>
                            <option value="new_member">New Member</option>
                            <option value="existing_member">Existing Member</option>
                        </select>
                    </div>

                    <div class="" id="newMember" style="display: none">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                  <label class="form-label" for="lastName1">Name</label>
                                  <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" id="name" />
                                  @error('name')
                                  <div class="invalid-feedback">{{ $message }}</div>
                                  @enderror
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="mb-3 form-group">
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
                            </div>

                            <div class="col-md-6">
                                <div class="mb-3">
                                  <label class="form-label" for="date1">Date of Birth</label>
                                  <input type="date" name="dob" class="form-control @error('dob') is-invalid @enderror" id="date1" />
                                  @error('dob')
                                  <div class="invalid-feedback">{{ $message }}</div>
                                  @enderror
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="mb-3 form-group">
                                    <label for="phone">Phone</label>
                                    <input type="text" name="phone" class="form-control @error('phone') is-invalid @enderror" id="phone">
                                    @error('phone')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                  </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="email">Email</label>
                                    <input type="text" name="email" class="form-control @error('email') is-invalid @enderror" id="email" placeholder="">
                                    @error('email')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="mb-3 form-group">
                                    <label for="location">Location</label>
                                    <input type="text" name="location" class="form-control @error('location') is-invalid @enderror" id="location" placeholder="">
                                    @error('location')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="mb-3 form-group">
                                <label for="address">Address</label>
                                <textarea placeholder="Postal address and House number" class="form-control @error('address') is-invalid @enderror" name="address" id="address" rows="3"></textarea>
                                @error('address')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>


                        </div>

                    </div>

                    <div class="mb-3" id="existingMember" style="display: none">
                        <label class="form-label" for="emailAddress1">Choose Existing Member</label>
                        <select class="form-select" id="existingMemberSelect" name="member_id">
                            <option value="">Select existing member</option>
                            @foreach ($members as $result)
                                <option value="{{ $result->id }}">{{ $result->name }} ({{ $result->member_number }})</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <!-- Image -->
                <div class="order-1 col-lg-4 col-12 d-flex justify-content-center order-lg-2">
                    <img src="../assets/images/backgrounds/form.svg" alt="" class="img-fluid" width="100%">
                </div>
            </div>

        </section>
        <!-- Step 2 -->
        <h6>Education & Trianing</h6>
        <section>
          <div class="row">
            <div class="col-md-6">
                <div class="mb-3 form-group">
                    <label for="education_background">Education Background</label>
                    <input type="text" class="form-control" id="education_background" name="education_background">
                </div>

                <div class="mb-3 form-group">
                    <label for="ministry_training">Ministry Training</label>
                    <textarea class="form-control" id="ministry_training" name="ministry_training" rows="3"></textarea>
                </div>

                <div class="mb-3">
                    <label class="form-label" for="jobTitle2">Ordination Date</label>
                    <input type="date" class="form-control" id="ordination_date" name="ordination_date"/>
                  </div>
            </div>
            <div class="col-md-6">
                <div class="mb-3 form-group">
                    <label for="church_roles">Church Roles</label>
                    <textarea class="form-control" id="church_roles" name="church_roles" rows="3"></textarea>
                </div>


                <div class="mb-3 form-group">
                    <label for="publications">Publications</label>
                    <textarea class="form-control" id="publications" name="publications" rows="3"></textarea>
                </div>
            </div>

          </div>
        </section>
        <!-- Step 3 -->
        <h6>Family & Health</h6>
        <section>
          <div class="row">
            <div class="col-md-12">
                <div class="mb-3 form-group">
                    <label for="family_details">Family Details</label>
                    <textarea class="form-control" id="family_details" name="family_details" rows="3"></textarea>
                </div>

                <div class="mb-3 form-group">
                    <label for="health_status">Health Status</label>
                    <textarea class="form-control" id="health_status" name="health_status" rows="3"></textarea>
                </div>
            </div>

          </div>
        </section>
        <!-- Step 4 -->
        <h6>Hobbies & Finish</h6>
        <section>
          <div class="row">

            <div class="mx-auto row d-flex">
                <!-- Input fields -->
                <div class="order-1 col-lg-8 col-12 order-lg-1">

                    <div class="mb-3 form-group">
                        <label for="hobbies_interests">Hobbies and Interests</label>
                        <textarea class="form-control" id="hobbies_interests" name="hobbies_interests" rows="3"></textarea>
                    </div>

                    <div class="mb-3">
                        <label class="form-label" for="date1">Date Added</label>
                        <input type="date" class="form-control" id="date1" />
                    </div>

                </div>

                <!-- Image -->
                <div class="order-2 col-lg-4 col-12 d-flex justify-content-center order-lg-2">
                    <img src="../assets/images/backgrounds/certify.svg" alt="" class="img-fluid" width="50%">
                </div>
            </div>
          </div>
          <div class="col-12">
            <div class="gap-6 mt-4 d-flex align-items-center justify-content-end">
              <button class="btn btn-success" type="submit" >Save</button>
            </div>
        </div>
        </section>
      </form>
    </div>
  </div>
@endsection

@section('scripts')

<script>
    document.addEventListener("DOMContentLoaded", function() {
        var memberTypeSelect = document.getElementById('memberType');
        var existingMemberDiv = document.getElementById('existingMember');
        var newMemberDiv = document.getElementById('newMember');

        memberTypeSelect.addEventListener('change', function() {
            if (this.value === 'existing_member') {
                existingMemberDiv.style.display = 'block';
                newMemberDiv.style.display = 'none';

            } else {
                existingMemberDiv.style.display = 'none';
                newMemberDiv.style.display = 'block';

            }
        });
    });
</script>



<script src="../assets/libs/jquery-steps/build/jquery.steps.min.js"></script>
<script src="../assets/libs/jquery-validation/dist/jquery.validate.min.js"></script>
<script src="../assets/js/forms/form-wizard.js"></script>


@endsection
