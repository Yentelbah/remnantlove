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
    <div class="overflow-hidden position-relative rounded-3">
      <img src="../assets/images/backgrounds/profilebg-2.jpg" alt="spike-img" class="w-100">
    </div>
    <div class="card mx-9 mt-n5">
      <div class="pb-0 card-body">
        <div class="text-center d-md-flex align-items-center justify-content-between text-md-start">
          <div class="d-md-flex align-items-center">
            <div class="rounded-circle position-relative mb-9 mb-md-0 d-inline-block">
              <img src="../assets/images/profile/user-1.jpg" alt="spike-img" class="img-fluid rounded-circle" width="100" height="100">
              <span class="bottom-0 p-1 text-white border border-2 border-white text-bg-primary rounded-circle d-flex align-items-center justify-content-center position-absolute end-0">
                <i class="ti ti-plus"></i>
              </span>
            </div>
            <div class="ms-0 ms-md-3 mb-9 mb-md-0">
              <div class="mb-1 d-flex align-items-center justify-content-center justify-content-md-start">
                <h4 class="mb-0 me-7 fs-7">{{ $member->name }}</h4>
                <span class="border badge fs-2 fw-bold rounded-pill bg-primary-subtle text-primary border-primary">Admin</span>
              </div>
              <div class="d-flex align-items-center justify-content-center justify-content-md-start">
                <span class="p-1 bg-success rounded-circle"></span>
                <h6 class="mb-0 ms-2">{{ $member->member_number }}</h6>
              </div>
            </div>
          </div>
          <a href="javascript:void(0)" class="px-3 shadow-none btn btn-primary" value="{{ $member->id }}" data-bs-toggle="modal" data-bs-target="#editModal" id="#modalCenter" onclick="openEditModal('{{ $member->id }}')">Edit Details</a>

        </div>

        @include('member.edit')

        @include('member.delete')

        <ul class="mt-4 nav nav-pills user-profile-tab justify-content-center justify-content-md-start" id="pills-tab" role="tablist">
          <li class="nav-item me-2 me-md-3" role="presentation">
            <button class="py-6 bg-transparent nav-link position-relative rounded-0 active d-flex align-items-center justify-content-center" id="pills-profile-tab" data-bs-toggle="pill" data-bs-target="#pills-profile" type="button" role="tab" aria-controls="pills-profile" aria-selected="true">
              <i class="ti ti-user-circle me-0 me-md-6 fs-6"></i>
              <span class="d-none d-md-block">My Profile</span>
            </button>
          </li>
          <li class="nav-item me-2 me-md-3" role="presentation">
            <button class="py-6 bg-transparent nav-link position-relative rounded-0 d-flex align-items-center justify-content-center" id="pills-followers-tab" data-bs-toggle="pill" data-bs-target="#pills-followers" type="button" role="tab" aria-controls="pills-followers" aria-selected="false">
              <i class="ti ti-users me-0 me-md-6 fs-6"></i>
              <span class="d-none d-md-block">Teams</span>
            </button>
          </li>
          <li class="nav-item me-2 me-md-3" role="presentation">
            <button class="py-6 bg-transparent nav-link position-relative rounded-0 d-flex align-items-center justify-content-center" id="pills-friends-tab" data-bs-toggle="pill" data-bs-target="#pills-friends" type="button" role="tab" aria-controls="pills-friends" aria-selected="false">
              <i class="ti ti-layout-grid-add me-0 me-md-6 fs-6"></i>
              <span class="d-none d-md-block">Projects</span>
            </button>
          </li>
          <li class="nav-item" role="presentation">
            <button class="py-6 bg-transparent nav-link position-relative rounded-0 d-flex align-items-center justify-content-center" id="pills-gallery-tab" data-bs-toggle="pill" data-bs-target="#pills-gallery" type="button" role="tab" aria-controls="pills-gallery" aria-selected="false">
              <i class="ti ti-id me-0 me-md-6 fs-6"></i>
              <span class="d-none d-md-block">Connections</span>
            </button>
          </li>
        </ul>
      </div>
    </div>
  </div>

<div class="gap-2 px-3 mb-4 text-center d-flex flex-column flex-sm-row align-items-center justify-content-sm-between text-sm-start">
    <div class="mb-2 mb-sm-0">
      <h4 class="mb-1">
        Member ID # {{ $member->member_number }}
      </h4>
      <p class="mb-0">
        {{ $member->created_at }}
      </p>
    </div>
    @if (Auth::user()->role == 'Admin' || Auth::user()->role == 'System_admin' )

    <div class="d-flex justify-content-center">
      <button type="button" value="{{ $member->id }}" class="bg-danger-subtle btn me-2 text-danger d-flex align-items-center" data-bs-target="#deleteModal" data-bs-toggle="modal" onclick="openDeleteModal('{{ $member->id }}')"><i class="ti ti-trash me-1 fs-5"></i> Delete Member</button>
    </div>

    @endif
  </div>


<div class="mx-10 tab-content" id="pills-tabContent">
    <div class="tab-pane fade show active" id="pills-profile" role="tabpanel" aria-labelledby="pills-profile-tab" tabindex="0">
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

              </div>
            </div>
          </div>

        </div>
        <div class="col-lg-8">
          <div class="row">
            <div class="col-md-4">
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
            <div class="col-md-4">
              <div class="card">
                <div class="p-4 card-body">
                  <div class="d-flex align-items-center">
                    <div class="p-6 bg-success-subtle text-success fs-7 rounded-circle d-flex align-items-center justify-content-center">
                      <i class="ti ti-layout-grid-add"></i>
                    </div>
                    <div class="ms-6">
                      <h6 class="mb-1 fs-6">42</h6>
                      <p class="mb-0">Projects</p>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-md-4">
              <div class="card">
                <div class="p-4 card-body">
                  <div class="d-flex align-items-center">
                    <div class="p-6 bg-danger-subtle text-danger fs-7 rounded-circle d-flex align-items-center justify-content-center">
                      <i class="ti ti-id"></i>
                    </div>
                    <div class="ms-6">
                      <h6 class="mb-1 fs-6">$780</h6>
                      <p class="mb-0">Sales</p>
                    </div>
                  </div>
                </div>
              </div>
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
    <div class="tab-pane fade" id="pills-followers" role="tabpanel" aria-labelledby="pills-followers-tab" tabindex="0">
      <div class="mt-3 mb-4 d-sm-flex align-items-center justify-content-between">
        <h3 class="mb-3 mb-sm-0 fw-semibold d-flex align-items-center">Followers <span class="px-2 py-1 badge text-bg-secondary fs-2 rounded-4 ms-2">20</span>
        </h3>
        <form class="position-relative">
          <input type="text" class="py-2 form-control search-chat ps-5" id="text-srh" placeholder="Search Followers">
          <i class="ti ti-search position-absolute top-50 start-0 translate-middle-y text-dark ms-3"></i>
        </form>
      </div>
      <div class="row">
        <div class=" col-md-6 col-xl-4">
          <div class="card">
            <div class="gap-3 p-4 card-body d-flex align-items-center">
              <img src="../assets/images/profile/user-2.jpg" alt="spike-img" class="rounded-circle" width="40" height="40">
              <div>
                <h5 class="mb-0 fw-semibold">Betty Adams</h5>
                <span class="fs-2 d-flex align-items-center">
                  <i class="ti ti-map-pin text-dark fs-3 me-1"></i>Sint
                  Maarten
                </span>
              </div>
              <button class="px-2 py-1 btn btn-outline-primary ms-auto">Follow</button>
            </div>
          </div>
        </div>
      </div>
    </div>

    <div class="tab-pane fade" id="pills-friends" role="tabpanel" aria-labelledby="pills-friends-tab" tabindex="0">
      <div class="mt-3 mb-4 d-sm-flex align-items-center justify-content-between">
        <h3 class="mb-3 mb-sm-0 fw-semibold d-flex align-items-center">Projects <span class="px-2 py-1 badge text-bg-secondary fs-2 rounded-4 ms-2">20</span>
        </h3>
        <form class="position-relative">
          <input type="text" class="py-2 form-control search-chat ps-5" id="text-srh" placeholder="Search Friends">
          <i class="ti ti-search position-absolute top-50 start-0 translate-middle-y text-dark ms-3"></i>
        </form>
      </div>
      <div class="row">
        <div class="col-sm-6 col-lg-4">
          <div class="overflow-hidden card hover-img">
            <div class="p-4 text-center card-body border-bottom">
              <img src="../assets/images/profile/user-2.jpg" alt="spike-img" class="mb-3 rounded-circle" width="80" height="80">
              <h5 class="mb-0 fw-semibold">Betty Adams</h5>
              <span class="text-dark fs-2">Medical Secretary</span>
            </div>
            <ul class="px-2 py-2 mb-0 text-bg-light list-unstyled d-flex align-items-center justify-content-center">
              <li class="position-relative">
                <a class="p-2 text-primary d-flex align-items-center justify-content-center fs-5 rounded-circle fw-semibold" href="javascript:void(0)">
                  <i class="ti ti-brand-facebook"></i>
                </a>
              </li>
              <li class="position-relative">
                <a class="p-2 text-danger d-flex align-items-center justify-content-center fs-5 rounded-circle fw-semibold " href="javascript:void(0)">
                  <i class="ti ti-brand-instagram"></i>
                </a>
              </li>
              <li class="position-relative">
                <a class="p-2 text-info d-flex align-items-center justify-content-center fs-5 rounded-circle fw-semibold " href="javascript:void(0)">
                  <i class="ti ti-brand-github"></i>
                </a>
              </li>
              <li class="position-relative">
                <a class="p-2 text-secondary d-flex align-items-center justify-content-center fs-5 rounded-circle fw-semibold " href="javascript:void(0)">
                  <i class="ti ti-brand-twitter"></i>
                </a>
              </li>
            </ul>
          </div>
        </div>
      </div>
    </div>

    <div class="tab-pane fade" id="pills-gallery" role="tabpanel" aria-labelledby="pills-gallery-tab" tabindex="0">

      <div class="row">
        <div class="col-md-6 col-lg-4">
          <div class="overflow-hidden card hover-img">
            <div class="p-0 card-body">
              <img src="../assets/images/products/s1.jpg" alt="spike-img" height="220" class="w-100 object-fit-cover">
              <div class="p-4 d-flex align-items-center justify-content-between">
                <div>
                  <h6 class="mb-0 fs-4">Isuava wakceajo fe.jpg</h6>
                  <span class="text-dark fs-2">Wed, Dec 14, 2024</span>
                </div>
                <div class="dropdown">
                  <a class="p-1 text-muted fw-semibold d-flex align-items-center" href="javascript:void(0)" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                    <i class="ti ti-dots-vertical"></i>
                  </a>
                  <ul class="overflow-hidden dropdown-menu">
                    <li>
                      <a class="dropdown-item" href="javascript:void(0)">Isuava wakceajo fe.jpg</a>
                    </li>
                  </ul>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="col-md-6 col-lg-4">
          <div class="overflow-hidden card hover-img">
            <div class="p-0 card-body">
              <img src="../assets/images/products/s2.jpg" alt="spike-img" height="220" class="w-100 object-fit-cover">
              <div class="p-4 d-flex align-items-center justify-content-between">
                <div>
                  <h6 class="mb-0 fs-4">Ip docmowe vemremrif.jpg</h6>
                  <span class="text-dark fs-2">Wed, Dec 14, 2024</span>
                </div>
                <div class="dropdown">
                  <a class="p-1 text-muted fw-semibold d-flex align-items-center" href="javascript:void(0)" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                    <i class="ti ti-dots-vertical"></i>
                  </a>
                  <ul class="overflow-hidden dropdown-menu">
                    <li>
                      <a class="dropdown-item" href="javascript:void(0)">Ip docmowe vemremrif.jpg</a>
                    </li>
                  </ul>
                </div>
              </div>
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
