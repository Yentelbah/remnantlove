@extends('layouts.template')

@section('title')
    <title>User Profiles</title>
@endsection

@section('content')

<div class="container-fluid">
    <div class="page-titles mb-5">
      <div class="row">
        <div class="col-lg-8 col-md-6 col-12 align-self-center">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb align-items-center">
                  <li class="breadcrumb-item">
                    <a class="text-muted text-decoration-none" href="{{ route('dashboard') }}">
                      <i class="ti ti-home fs-5"></i>
                    </a>
                  </li>
                  <li class="breadcrumb-item">
                    <a class="text-muted text-decoration-none" href="{{ route('archieve.index') }}">
                      Archieves
                    </a>
                  </li>
                  <li class="breadcrumb-item" aria-current="page">User Profiles</li>
                </ol>
              </nav>
              <h2 class="mb-0 fw-bolder fs-8">User Profiles</h2>
        </div>
        <div class="col-lg-4 col-md-6 d-none d-md-flex align-items-center justify-content-end">
            <input class="form-control w-auto bg-primary-subtle border-0" type="date" id="currentDate" value="" name="date">
        </div>

      </div>
    </div>

      <div class="widget-content searchable-container list">

        <div class="card card-body">
          <div class="table-responsive">
            <table class="table search-table align-middle text-nowrap" id="table">
              <thead class="header-item">

                <th>#</th>
                <th>ID</th>
                <th>Name</th>
                <th>Email</th>
                <th>Status</th>
                <th>Action</th>
              </thead>
              <tbody>
                <!-- start row -->
                @php $i = 1; @endphp
                @foreach ($users as $user)

                <tr class="search-items">

                  <th scope="row">{{ $i++ }}</th>
                  <th scope="row">{{ $user->userID }}</th>
                  <td>
                    <div class="d-flex align-items-center">
                      {{-- <img src="{{ asset('assets/images/profile/nophoto2.png') }}" alt="avatar" class="rounded-circle" width="35" /> --}}
                      <div class="ms-0">
                        <div class="user-meta-info">
                          <h6 class="user-name mb-0" data-name="{{ $user->name }}">{{ $user->name }}</h6>
                          <span class="user-work fs-3" data-occupation=""></span>
                        </div>
                      </div>
                    </div>
                  </td>
                  <td>
                    <span class="usr-ph-no" data-email="{{ $user->email }}">{{ $user->email }}</span>
                  </td>

                  <td>
                    @if ($user->is_deleted == 0 )
                    <span class="mb-1 badge  bg-success-subtle text-success">Approva Pending</span>
                    @elseif ($user->is_deleted == 1)
                        <span class="mb-1 badge bg-secondary-subtle text-secondary">Inactive</span>
                    @endif
                  </td>

                  <td>
                    <a href="javascript:void(0)" class="text-muted" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-expanded="false">
                        <i class="ti ti-dots-vertical fs-6"></i>
                      </a>
                      <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton">

                        <li>
                            <a class="dropdown-item d-flex align-items-center gap-3" value="{{ $user->id }}" data-bs-toggle="modal" data-bs-target="#restoreModal" onclick="openRestoreModal('{{ $user->id }}')">
                              <i class="fs-4 ti ti-recycle"></i>Restore
                            </a>
                          </li>
                      </ul>

                  </td>

                </tr>
                @endforeach

              </tbody>
            </table>

          </div>
            <!--MODALS-->
            @include('archieve.user_profiles.restore')

            @include('archieve.user_profiles.approve')

        </div>
      </div>
    </div>

  </div>
@endsection

@section('scripts')

<script src="{{ asset('assets/js/apps/contact.js') }}"></script>

    <script>
        function openRestoreModal(user) {
            $.ajax({
                url: '/user/' + user + '/details', // Replace with the appropriate route for fetching user details
                type: 'GET',
                success: function(response) {
                    // Update the modal content with the fetched user details

                    $('#res_fname').text(response.fname);
                    $('#res_lnames').text(response.lname);

                    $('#res_user_id').val(response.id);

                },
                error: function(xhr) {
                    // Handle error case
                    console.log(xhr);
                }
            });
        }
    </script>

    <script>
        function openApproveModal(userId) {
            $.ajax({
                url: '/user/' + userId + '/details', // Replace with the appropriate route for fetching user details
                type: 'GET',
                success: function(response) {
                    // Update the modal content with the fetched user details

                    $('#app_fname').text(response.fname);
                    $('#app_lname').text(response.lname);

                    $('#app_userID').val(response.id);

                },
                error: function(xhr) {
                    // Handle error case
                    console.log(xhr);
                }
            });
        }
    </script>

    <script>
        $(document).ready(function () {
            $('#table').DataTable(); // ID From dataTable with Hover
        });
    </script>

@endsection
