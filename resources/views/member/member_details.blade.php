@extends('layouts.flow')

@section('title')
    <title>FaithFlow -- Member Details</title>
@endsection

@section('content')

<div class="mb-3 overflow-hidden position-relative">
    <div class="px-3 d-sm-flex align-items-center justify-content-between">
      <h4 class="mb-0 fs-6">Member Details</h4>
      <nav aria-label="breadcrumb">
        <ol class="mb-0 breadcrumb">
          <li class="breadcrumb-item">
            <a href="{{ route('dashboard') }}">Dashboard</a>
          </li>
          <li class="breadcrumb-item">
            <a href="{{ route('member.index') }}">Members</a>
          </li>
          <li class="breadcrumb-item" aria-current="page">Member Details</li>
        </ol>
      </nav>
    </div>
</div>

<div class="overflow-hidden position-relative">

    <div class="card">
        <div class="pb-0 mb-4 card-body ">
          <div class="text-center d-md-flex align-items-center justify-content-between text-md-start">
            <div class="d-md-flex align-items-center">
              <div class="rounded-circle position-relative mb-9 mb-md-0 d-inline-block">
                <img src="{{ $member->photo == '' ?  '../assets/images/profile/user-1.jpg' : asset('storage/' .$member->photo) }}" alt="member_img" class="img-fluid rounded-circle preview" width="100" height="100">
                <span class="bottom-0 p-1 text-white border-2 border-white text-bg-primary rounded-circle d-flex align-items-center justify-content-center position-absolute end-0">

                    <i class="ti ti-plus"  value="{{ $member->id }}" data-bs-toggle="modal" data-bs-target="#imageModal" id="#modalCenter"></i>
                  </span>
              </div>
              <div class="ms-0 ms-md-3 mb-9 mb-md-0">
                <div class="mb-1 d-flex align-items-center justify-content-center justify-content-md-start">
                  <h4 class="mb-0 me-7 fs-7">{{ $member->name }}</h4>
                  {{-- <span class="border badge fs-2 fw-bold rounded-pill bg-primary-subtle text-primary border-primary">{{ $member->status }}</span> --}}
                </div>
                <div class="d-flex align-items-center justify-content-center justify-content-md-start">
                  <span class="p-1 bg-primary rounded-circle"></span>
                  <h6 class="mb-0 ms-2">{{ $member->member_number }}</h6>
                </div>
              </div>
            </div>

            <a href="javascript:void(0)" class="px-3 shadow-none btn btn-primary" value="{{ $member->id }}" data-bs-toggle="modal" data-bs-target="#editModal" id="#modalCenter" onclick="openEditModal('{{ $member->id }}')">Edit Details</a>

          </div>

        </div>
      </div>
      @include('member.edit')
      @include('member.loadimage')
      @include('member.delete')

    <div class="">

        {{-- <div class="gap-2 px-3 mb-4 text-center d-flex flex-column flex-sm-row align-items-center justify-content-sm-between text-sm-start">

            @if (Auth::user()->role == 'Admin' || Auth::user()->role == 'System_admin' || Auth::user()->role == 'Church_admin' )

            <div class="d-flex justify-content-center">
            <button type="button" value="{{ $member->id }}" class="bg-danger-subtle btn me-2 text-danger d-flex align-items-center" data-bs-target="#deleteModal" data-bs-toggle="modal" onclick="openDeleteModal('{{ $member->id }}')"><i class="ti ti-trash me-1 fs-5"></i> Delete Member</button>
            </div>

            @endif
        </div>
        --}}

        <div class="row">
            <div class="col-lg-4">
            <div class="card ">
                <div class="p-4 card-body">
                <h4 class="fs-6 mb-9">About me</h4>

                <div class="py-9 border-top">
                    <h5 class="mb-9">Basic Information</h5>
                    <div class="d-flex align-items-center mb-9">
                    <div class="bg-danger-subtle text-danger fs-14 round-40 rounded-circle d-flex align-items-center justify-content-center">
                        <i class="ti ti-user"></i>
                    </div>
                    <div class="ms-6">
                        <h6 class="mb-1">Name</h6>
                        <p class="mb-0">{{ $member->name }}</p>
                    </div>
                    </div>

                    <div class="d-flex align-items-center mb-9">
                    <div class="bg-success-subtle text-success fs-14 round-40 rounded-circle d-flex align-items-center justify-content-center">
                        <i class="ti ti-mail"></i>
                    </div>
                    <div class="ms-6">
                        <h6 class="mb-1">Gender</h6>
                        <p class="mb-0">{{ $member->gender ?? '' }}</p>
                    </div>
                    </div>

                    <div class="d-flex align-items-center mb-9">
                        <div class="bg-info-subtle text-info fs-14 round-40 rounded-circle d-flex align-items-center justify-content-center">
                        <i class="ti ti-calendar"></i>
                        </div>
                        <div class="ms-6">
                        <h6 class="mb-1">Date of birth</h6>
                        <p class="mb-0">{{ $member->dob ?? '' }}</p>
                        </div>
                    </div>
                </div>

                <div class="py-9 border-top">
                    <h5 class="mb-9">Contact</h5>
                    <div class="d-flex align-items-center mb-9">
                    <div class="bg-danger-subtle text-danger fs-14 round-40 rounded-circle d-flex align-items-center justify-content-center">
                        <i class="ti ti-phone"></i>
                    </div>
                    <div class="ms-6">
                        <h6 class="mb-1">Phone</h6>
                        <p class="mb-0">{{ $member->phone ?? '' }}</p>
                    </div>
                    </div>

                    <div class="d-flex align-items-center mb-9">
                    <div class="bg-success-subtle text-success fs-14 round-40 rounded-circle d-flex align-items-center justify-content-center">
                        <i class="ti ti-mail"></i>
                    </div>
                    <div class="ms-6">
                        <h6 class="mb-1">Email</h6>
                        <p class="mb-0">{{ $member->email ?? '' }}</p>
                    </div>
                    </div>

                </div>

                <div class="pt-9 border-top">
                    <h5 class="mb-9">Other</h5>
                    <div class="d-flex align-items-center mb-9">
                    <div class="bg-warning-subtle text-warning fs-14 round-40 rounded-circle d-flex align-items-center justify-content-center">
                        <i class="ti ti-map-pin"></i>
                    </div>
                    <div class="ms-6">
                        <h6 class="mb-1">Location</h6>
                        <p class="mb-0">{{ $member->location ?? '' }}</p>
                    </div>
                    </div>
                    <div class="d-flex align-items-center mb-9">
                    <div class="bg-success-subtle text-success fs-14 round-40 rounded-circle d-flex align-items-center justify-content-center">
                        <i class="ti ti-mailbox"></i>
                    </div>
                    <div class="ms-6">
                        <h6 class="mb-1">Address</h6>
                        <p class="mb-0">{{ $member->address ?? '' }}</p>
                    </div>
                    </div>

                    <div class="d-flex align-items-center mb-9">
                        <div class="bg-info-subtle text-info fs-14 round-40 rounded-circle d-flex align-items-center justify-content-center">
                        <i class="ti ti-calendar"></i>
                        </div>
                        <div class="ms-6">
                        <h6 class="mb-1">Date Joined</h6>
                        <p class="mb-0">{{ $member->created_at ?? '' }}</p>
                        </div>
                    </div>
                </div>
                </div>
            </div>

            </div>
            <div class="col-lg-8">
            <div class="row">
                <div class="col-md-6">
                <div class="card">
                    <div class="p-4 card-body">
                    <div class="d-flex align-items-center">
                        <div class="p-6 bg-primary-subtle text-primary fs-7 rounded-circle d-flex align-items-center justify-content-center">
                        <i class="ti ti-template"></i>
                        </div>
                        <div class="ms-6">
                        <h6 class="mb-1 fs-6">{{ $groups }}</h6>
                        <p class="mb-0">Groups</p>
                        </div>
                    </div>
                    </div>
                </div>
                </div>
                <div class="col-md-6">
                <div class="card">
                    <div class="p-4 card-body">
                    <div class="d-flex align-items-center">
                        <div class="p-6 bg-success-subtle text-success fs-7 rounded-circle d-flex align-items-center justify-content-center">
                        <i class="ti ti-layout-grid-add"></i>
                        </div>
                        <div class="ms-6">
                        <h6 class="mb-1 fs-6">0</h6>
                        <p class="mb-0">Tasks</p>
                        </div>
                    </div>
                    </div>
                </div>
                </div>
                <div class="col-md-4">

                </div>
            </div>

            <div class="card">
                <div class="card-body">
                <h5 class="mb-9">Groups of member</h5>

                @foreach($groupDetails as $value)
                <div class="d-flex align-items-center mb-9">
                    <div class="bg-info-subtle text-info fs-14 round-40 rounded-circle d-flex align-items-center justify-content-center">
                    <i class="ti ti-user-plus"></i>
                    </div>
                    <div class="ms-6">
                    <h6 class="mb-1">{{ $value->group->name }}</h6>
                    <p class="mb-0">{{ $value->group->description }}</p>
                    </div>
                </div>
                @endforeach

                </div>
            </div>

            <div class="card">
                <div class="p-4 card-body">

                </div>
            </div>
            </div>
        </div>
    </div>
</div>



@endsection

@section('scripts')

    <script>
        function openEditModal(id) {
            $.ajax({
                url: '/members/' + id, // Replace with the appropriate route for fetching department details
                type: 'GET',
                success: function(response) {
                    // Update the modal content with the fetched department details
                    $('#ed_name').val(response.name);
                    $('#ed_gender').val(response.gender);
                    $('#ed_dob').val(response.dob);
                    $('#ed_phone').val(response.phone);
                    $('#ed_address').val(response.address);
                    $('#ed_location').val(response.location);
                    $('#ed_email').val(response.email);
                    $('#selectedId').val(response.id);
                },
                error: function(xhr) {
                    // Handle error case
                    console.log(xhr);
                }
            });
        }

        function openDeleteModal(id) {
            $.ajax({
                url: '/members/' + id, // Replace with the appropriate route for fetching department details
                type: 'GET',
                success: function(response) {
                    // Update the modal content with the fetched department details
                    $('#del_name').text(response.name);
                    $('#del_selectedId').val(response.id);
                },
                error: function(xhr) {
                    // Handle error case
                    console.log(xhr);
                }
            });
        }
    </script>

@endsection
