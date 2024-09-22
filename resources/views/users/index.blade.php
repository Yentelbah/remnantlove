@extends('layouts.flow')

@section('title')
    <title>User Accounts</title>
@endsection

@section('content')

<div class="mb-3 overflow-hidden position-relative">
    <div class="px-3 d-sm-flex align-items-center justify-content-between">
      <h4 class="mb-0 fs-6">User Accounts</h4>
      <nav aria-label="breadcrumb">
        <ol class="mb-0 breadcrumb">
          <li class="breadcrumb-item">
            <a href="{{ route('dashboard') }}">Dashboard</a>
          </li>
          <li class="breadcrumb-item" aria-current="page">User Accounts</li>
        </ol>
      </nav>
    </div>
  </div>


      <div class="widget-content searchable-container list">
        <div class="card card-body">
            <div class="mb-2 d-flex justify-content-between align-items-center">
                <h5 class="mb-0 card-title">Users</h5>
                <nav aria-label="breadcrumb">
                    <ol class="mb-0 breadcrumb">
                      <li class="breadcrumb-item">
                        <a href="{{ route('role.index') }}">User Roles</a>
                      </li>
                      <li class="breadcrumb-item" aria-current="page">
                        <a href="{{ route('logs.index') }}">User Logs</a>
                      </li>
                    </ol>
                  </nav>
            </div>

                <div class="p-3 table-responsive">
                  <table class="table align-middle search-table text-nowrap" id="table">
                    <thead class="header-item">
                      <th>#</th>
                      <th>Name</th>
                      <th>Email</th>
                      <th>Level</th>
                      <th>Status</th>
                      <th>Action</th>
                    </thead>
                    <tbody>
                      <!-- start row -->
                      @php $i = 1; @endphp
                      @foreach ($users as $user)

                      <tr class="search-items">

                        <th scope="row">{{ $i++ }}</th>
                        <td>
                          <div class="d-flex align-items-center">

                            <img src="{{ $user->profile_pic ? asset('storage/' . $user->profile_pic ) : asset('assets/images/profile/user-1.jpg') }}" alt="User avatar" class="rounded-circle" width="35" />

                            <div class="ms-3">
                              <div class="user-meta-info">
                                <h6 class="mb-0 user-name" data-name="{{ $user->name }}">{{ $user->name }}</h6>
                                <span class="user-work fs-3" data-occupation="{{ $user->churchRole->name ?? '' }}">{{ $user->churchRole->name ?? '' }}</span>
                              </div>
                            </div>
                          </div>
                        </td>
                        <td>
                          <span class="usr-email-addr" data-email="{{ $user->email }}">{{ $user->email }}</span>
                        </td>

                        <td>
                          <span class="usr-ph-no" data-phone="{{ $user->churchRole->role->name ?? '' }}">{{ $user->churchRole->role->name ?? '' }}</span>
                        </td>

                        <td>
                            @if ($user->status == 'Active' )
                            <span class="mb-1 badge bg-success-subtle text-success">{{ $user->status }}</span>
                            @elseif ($user->status == 'Inactive')
                                <span class="mb-1 badge bg-secondary-subtle text-secondary">{{ $user->status }}</span>
                            @elseif ($user->status == 'Blocked')
                                <span class="mb-1 badge bg-danger-subtle text-danger">{{ $user->status }}</span>
                            @endif
                        </td>

                        <td>
                            <div class="dropdown dropstart">
                                <a href="javascript:void(0)" class="text-muted" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-expanded="false">
                                  <i class="ti ti-dots-vertical fs-6"></i>
                                </a>
                                <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                 @if($user->status == 'Active')
                                  <li>
                                    <a class="gap-3 dropdown-item d-flex align-items-center" href="javascript:void(0)" data-bs-toggle="modal" data-bs-target="#revokeUserModal" onclick="openRevokeModal('{{ $user->id }}')">
                                      <i class="fs-4 ti ti-x"></i>Block
                                    </a>

                                  </li>
                                  @endif

                                  @if($user->status == 'Blocked')
                                  <li>
                                    <a class="gap-3 dropdown-item d-flex align-items-center" href="javascript:void(0)" data-bs-toggle="modal" data-bs-target="#accessModal" onclick="openAccessModal('{{ $user->id }}')">
                                      <i class="fs-4 ti ti-eye"></i>Access
                                    </a>
                                  </li>
                                  @endif
                                  <li>
                                    <a class="gap-3 dropdown-item d-flex align-items-center" href="javascript:void(0)" data-bs-toggle="modal" data-bs-target="#editUserModal" onclick="openEditModal('{{ $user->id }}')">
                                      <i class="fs-4 ti ti-edit"></i>Edit
                                    </a>
                                  </li>

                                  <li>
                                    <a class="gap-3 dropdown-item d-flex align-items-center" href="javascript:void(0)" data-bs-toggle="modal" data-bs-target="#deleteUserModal" onclick="openDeleteModal('{{ $user->id }}')">
                                      <i class="fs-4 ti ti-trash"></i>Delete
                                    </a>
                                  </li>
                                </ul>
                            </div>
                        </td>
                      </tr>
                      @endforeach
                    </tbody>
                  </table>

                </div>
                  <!--MODALS-->
                    @include('users.addUser')
                    @include('users.edit')
                    @include('users.delete')
                    @include('users.revoke')
                    @include('users.access')

              </div>

          </div>
      </div>
    </div>

  </div>
@endsection

@section('scripts')

    <script>
        function openEditModal(userId) {
            $.ajax({
                url: '/user/' + userId + '/details', // Replace with the appropriate route for fetching user details
                type: 'GET',
                success: function(response) {
                    // Update the modal content with the fetched user details
                    $('#ed_user_name').val(response.name);
                    $('#user_role').val(response.church_role_id);
                    $('#selectedUserId').val(response.id);
                },
                error: function(xhr) {
                    // Handle error case
                    console.log(xhr);
                }
            });
        }

        function openRevokeModal(userId) {
            $.ajax({
                url: '/user/' + userId + '/details', // Replace with the appropriate route for fetching user details
                type: 'GET',
                success: function(response) {
                    // Update the modal content with the fetched user details
                    $('#rev_user_name').text(response.name);
                    $('#rev_selectedUserId').val(response.id);
                },
                error: function(xhr) {
                    // Handle error case
                    console.log(xhr);
                }
            });
        }

        function openAccessModal(userId) {
            $.ajax({
                url: '/user/' + userId + '/details', // Replace with the appropriate route for fetching user details
                type: 'GET',
                success: function(response) {
                    // Update the modal content with the fetched user details
                    $('#acc_user_name').text(response.name);
                    $('#acc_selectedUserId').val(response.id);
                },
                error: function(xhr) {
                    // Handle error case
                    console.log(xhr);
                }
            });
        }
    </script>
    </script>



<script>
    function openDeleteModal(userId) {
        $.ajax({
            url: '/user/' + userId + '/details', // Replace with the appropriate route for fetching user details
            type: 'GET',
            success: function(response) {
                // Update the modal content with the fetched user details
                $('#del_user_name').text(response.name);
                $('#del_selectedUserId').val(response.id);
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
