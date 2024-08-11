
@extends('layouts.flow')

@section('title')
    <title>FaithFlow -- Staff</title>
@endsection

@section('content')
  <div class="mb-3 overflow-hidden position-relative">
    <div class="px-3 d-sm-flex align-items-center justify-content-between">
      <h4 class="mb-0 fs-6">Staff</h4>
      <nav aria-label="breadcrumb">
        <ol class="mb-0 breadcrumb">
          <li class="breadcrumb-item">
            <a href="{{ route('dashboard') }}">Dashboard</a>
          </li>
          <li class="breadcrumb-item">
            <a href="{{ route('member.index') }}">Members</a>
          </li>
          <li class="breadcrumb-item" aria-current="page">Staff</li>
        </ol>
      </nav>
    </div>
  </div>

  <div class="card">
    <div class="card-body">
        <div class="justify-between mb-2 d-flex">
            <h4 class="mb-0 card-title">Staff</h4>

            <div class="ms-auto">
                <a href="{{ route('staff.create') }}" class="px-4 mb-1 btn bg-success-subtle text-success fs-4 ms-auto me-1">Add Staff</a>
            </div>
        </div>

        <div class="p-3 table-responsive">
            <table class="table align-items-center table-flush table-hover" id="dataTableStaff">
                <thead class="thead-light">
                <tr>
                    <th>#</th>
                    <th>MemberID</th>
                    <th>Name</th>
                    <th>Gender</th>
                    <th>Phone</th>
                    <th>Position</th>
                    <th></th>
                </tr>
                </thead>
                <tbody>
                @foreach($staff as $key => $value)
                <tr>
                    <td>{{ $key + 1 }}</td>
                    <td>{{ $value->member->member_number }}</td>
                    <td>{{ $value->member->name }}</td>
                    <td>{{ $value->member->gender }}</td>
                    <td>{{ $value->member->phone }}</td>
                    <td>{{ $value->position }}</td>
                    <td>
                        <div class="dropdown">
                            <button id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false" class="px-1 shadow-none rounded-circle btn-transparent btn-sm btn">
                              <i class="ti ti-dots-vertical fs-4 d-block"></i>
                            </button>
                            <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="dropdownMenuButton1">
                                @if ($nonExistingUsers->contains('member_id', $value->member_id))
                                <li>
                                    <a href="javascript:void(0)" class="dropdown-item" value="{{ $value->id }}" data-bs-toggle="modal" data-bs-target="#createModal" id="#modalCenter" onclick="openUserAccountModal('{{ $value->id }}')">+ User Account</a>
                                </li>
                                @endif
                                <li>
                                    <a href="javascript:void(0)" class="dropdown-item" value="{{ $value->id }}" data-bs-toggle="modal" data-bs-target="#editModal" id="#modalCenter" onclick="openEditModal('{{ $value->id }}')">Edit</a>
                                </li>

                                <li>
                                    <a href="javascript:void(0)" class="dropdown-item" value="{{ $value->id }}" data-bs-toggle="modal" data-bs-target="#deleteModal" id="#modalCenter" onclick="openDeleteModal('{{ $value->id }}')">Delete</a>
                                </li>

                            </ul>
                        </div>
                    </td>
                    </tr>
                @endforeach


                </tbody>
            </table>
        </div>

        </div>

  </div>
    @include('staff.edit')
    @include('staff.delete')
    @include('leader.account')


@endsection

@section('scripts')

    <script>
        function openEditModal(id) {
            $.ajax({
                url: '/staff/' + id, // Replace with the appropriate route for fetching department details
                type: 'GET',
                success: function(response) {
                    // Update the modal content with the fetched department details
                    $('#ed_name').val(response.member.name);
                    $('#ed_education_background').val(response.staff.ed_education_background);
                    $('#ed_position').val(response.staff.position);
                    $('#ed_hobbies').val(response.staff.hobbies_interests);
                    $('#ed_health').val(response.staff.health_status);
                    $('#ed_date_appointed').val(response.staff.date_appointed);
                    $('#ed_selectedId').val(response.staff.id);
                },
                error: function(xhr) {
                    // Handle error case
                    console.log(xhr);
                }
            });
        }

        function openDeleteModal(id) {
            $.ajax({
                url: '/staff/' + id, // Replace with the appropriate route for fetching department details
                type: 'GET',
                success: function(response) {
                    // Update the modal content with the fetched department details
                    $('#del_name').text(response.member.name);
                    $('#del_selectedId').val(response.staff.id);
                },
                error: function(xhr) {
                    // Handle error case
                    console.log(xhr);
                }
            });
        }

        function openUserAccountModal(id) {
            $.ajax({
                url: '/staff/' + id, // Replace with the appropriate route for fetching department details
                type: 'GET',
                success: function(response) {
                    // Update the modal content with the fetched department details
                    $('#acc_user_name').val(response.member.name);
                    $('#leader_id').val(response.member.id);
                },
                error: function(xhr) {
                    // Handle error case
                    console.log(xhr);
                }
            });
        }
    </script>

    <script>
        $("#dataTableStaff").DataTable({
            dom: "Bfrtip",
            buttons: ["copy", "csv", "excel", "pdf", "print",],
        });
        $(
            ".buttons-copy, .buttons-csv, .buttons-print, .buttons-pdf, .buttons-excel"
        ).addClass("btn btn-primary btn-sm");
    </script>

@endsection
