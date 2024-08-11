@extends('layouts.flow')

@section('title')
     <title>FaithFLow -- User Profile</title>
@endsection


@section('content')

<div class="mb-3 overflow-hidden position-relative">
    <div class="px-3 d-sm-flex align-items-center justify-content-between">
      <h4 class="mb-0 fs-6">Profile</h4>
      <nav aria-label="breadcrumb">
        <ol class="mb-0 breadcrumb">
          <li class="breadcrumb-item">
            <a href="{{ route('dashboard') }}">Dashboard</a>
          </li>
          <li class="breadcrumb-item" aria-current="page">Profile</li>
        </ol>
      </nav>
    </div>
  </div>

  <div class="overflow-hidden position-relative">
    <div class="overflow-hidden position-relative rounded-3">
      <img src="../assets/images/backgrounds/profilebg-2.jpg" alt="spike-img" class="w-100">
    </div>
    <div class="card mx-9 mt-n5">
      <div class="pb-0 mb-4 card-body ">
        <div class="text-center d-md-flex align-items-center justify-content-between text-md-start">
          <div class="d-md-flex align-items-center">
            <div class="rounded-circle position-relative mb-9 mb-md-0 d-inline-block">
              <img src="../assets/images/profile/user-1.jpg" alt="spike-img" class="img-fluid rounded-circle" width="100" height="100">
            </div>
            <div class="ms-0 ms-md-3 mb-9 mb-md-0">
              <div class="mb-1 d-flex align-items-center justify-content-center justify-content-md-start">
                <h4 class="mb-0 me-7 fs-7">{{ Auth()->user()->name }}</h4>
                <span class="border badge fs-2 fw-bold rounded-pill bg-primary-subtle text-primary border-primary">Admin</span>
              </div>
              <div class="d-flex align-items-center justify-content-center justify-content-md-start">
                <span class="p-1 bg-success rounded-circle"></span>
                <h6 class="mb-0 ms-2">Active</h6>
              </div>
            </div>
          </div>
        </div>

      </div>
    </div>
  </div>

  <div class="mx-10 tab-content" id="pills-tabContent">
    <div class="tab-pane fade show active" id="pills-profile" role="tabpanel" aria-labelledby="pills-profile-tab" tabindex="0">
      <div class="row">
        <div class="col-lg-4">
          <div class="card ">
            <div class="p-4 card-body">
              <h4 class="fs-6 mb-9">About me</h4>
              {{-- <p class="mb-0 pb-9 text-dark">Biography</p> --}}
              <div class="py-9 border-top">
                <h5 class="mb-9">Contact</h5>


                <div class="d-flex align-items-center mb-9">
                  <div class="bg-success-subtle text-success fs-14 round-40 rounded-circle d-flex align-items-center justify-content-center">
                    <i class="ti ti-mail"></i>
                  </div>
                  <div class="ms-6">
                    <h6 class="mb-1">Email</h6>
                    <p class="mb-0">{{ Auth()->user()->email }}</p>
                  </div>
                </div>


              </div>

            </div>
          </div>

          <div class="">
            <div class="col-lg-12">
                <div class="card">
                    <div class="mt-10 sm:mt-0">
                        @livewire('profile.logout-other-browser-sessions-form')
                    </div>
                </div>
            </div>
          </div>

          {{-- <div class="">
            <div class="col-lg-12">
                <div class="card">
                    @if (Laravel\Jetstream\Jetstream::hasAccountDeletionFeatures())
                        <div class="mt-10 sm:mt-0">
                            @livewire('profile.delete-user-form')
                        </div>
                    @endif
                </div>
            </div>
          </div> --}}

        </div>

        <div class="col-lg-8">
          {{-- <div class="row">
            <div class="col-md-4">
              <div class="card">
                <div class="p-4 card-body">
                  <div class="d-flex align-items-center">
                    <div class="p-6 bg-primary-subtle text-primary fs-7 rounded-circle d-flex align-items-center justify-content-center">
                      <i class="ti ti-template"></i>
                    </div>
                    <div class="ms-6">
                      <h6 class="mb-1 fs-6">680</h6>
                      <p class="mb-0">Tasks Done</p>
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
          </div> --}}

          <div class="">
            <div class="col-lg-12">
                <div class="card">
                    @if (Laravel\Fortify\Features::canUpdateProfileInformation())
                        @livewire('profile.update-profile-information-form')
                    @endif
                </div>
            </div>

            <div class="col-lg-12">
                <div class="card">
                    @if (Laravel\Fortify\Features::enabled(Laravel\Fortify\Features::updatePasswords()))
                        <div class="mt-10 sm:mt-0">
                            @livewire('profile.update-password-form')
                        </div>
                    @endif
                </div>
            </div>

            {{-- <div class="col-lg-12">
                <div class="card">
                    @if (Laravel\Fortify\Features::canManageTwoFactorAuthentication())
                        <div class="mt-10 sm:mt-0">
                            @livewire('profile.two-factor-authentication-form')
                        </div>
                    @endif
                </div>
            </div> --}}
          </div>
        </div>
      </div>

    </div>
  </div>


@endsection
