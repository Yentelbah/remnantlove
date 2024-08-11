
@extends('layouts.flow')

@section('head')
{{-- <link href="{{ asset('assets/libs/datatables/dataTables.bootstrap4.min.css')}}" rel="stylesheet"> --}}
<link rel="stylesheet" href="{{ asset('assets/libs/datatables.net-bs5/css/dataTables.bootstrap5.min.css') }}">
@endsection

@section('title')
    <title>FaithFlow -- Groups</title>

@endsection

@section('content')

@section('content')

  <div class="mb-3 overflow-hidden position-relative">
    <div class="px-3 d-sm-flex align-items-center justify-content-between">
      <h4 class="mb-0 fs-6">Church Groups</h4>
      <nav aria-label="breadcrumb">
        <ol class="mb-0 breadcrumb">
          <li class="breadcrumb-item">
            <a href="{{ route('dashboard') }}">Dashboard</a>
          </li>
          <li class="breadcrumb-item" aria-current="page">Church Groups</li>
        </ol>
      </nav>
    </div>
  </div>

  <div class="course">
    <div class="card">
      <div class="card-body">
        <div class="pb-2 mb-4 d-flex align-items-center">
          <h4 class="mb-0 card-title">All Groups</h4>

          <div class="ms-auto">
            <button type="button" class="px-4 mb-1 btn bg-success-subtle text-success fs-4 ms-auto me-1" data-bs-toggle="modal" data-bs-target="#createModal">Add Group</button>

            {{-- <button type="button" class="px-4 mb-1 btn bg-info-subtle text-info fs-4" data-bs-toggle="modal" data-bs-target="#downloadModal">Download</button> --}}
          </div>
        </div>

        <div class="row">


            @forelse($groups as $key => $value)

                <div class="col-lg-4 col-md-6">
                    <div class="overflow-hidden card bg-success-subtle">
                        <div class="card-body">
                            <h6 class="pb-2 mb-2 fs-5">
                                {{ $value->name }}
                            </h6>
                            <p class="mb-2 fs-3 fw-normal text-muted">
                                {{ $value->description }}
                            </p>
                            <ul class="gap-3 pb-2 mb-4 hstack d-block d-sm-flex text-muted">
                            <li>
                                <a href="{{ route('group.members.list', $value->id) }}" class="text-muted d-flex align-items-center">
                                    <i class="fas fa-book fs-6 me-2 pe-1"></i>{{ $value->members_count }}
                                members
                                </a>
                            </li>
                            <li class="d-none d-sm-block">/</li>
                            <li>
                                <a href="javascript:void(0)" class="text-muted d-flex align-items-center">
                                    <i class="far fa-clock fs-6 me-2 pe-1"></i>{{ $value->created_at->format('d-m-Y') }}

                                </a>
                            </li>
                            </ul>
                            <div class="d-block d-sm-flex align-items-center justify-content-between">
                            <div class="gap-3 hstack">
                                <img src="../assets/images/profile/user-2.png" class="rounded-3" alt="spike-img" width="50" />
                                <div class="">
                                    <h6 class="mb-0">{{ $value->leader_name ?? 'No main leader'}}</h6>
                                    <p class="mb-0">Leader</p>
                                </div>
                            </div>
                            </div>
                            <br>

                            <div class="text-center">
                                <button type="button" class="btn btn-success btn-sm" data-bs-toggle="modal" data-bs-target="#addMember" value="{{ $value->id }}" onclick="openAddGroupMembersModal('{{ $value->id }}')" id="#modalCenter">Add Member</button>

                                <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#editModal" value="{{ $value->id }}" onclick="openEditModal('{{ $value->id }}')" id="#modalCenter">Update</button>

                                <button type="button" class="btn bg-danger-subtle text-danger me-3 btn-sm" data-bs-toggle="modal" data-bs-target="#deleteModal" value="{{ $value->id }}" onclick="openDeleteModal('{{ $value->id }}')" id="#modalCenter">Delete</button>
                            </div>

                        </div>
                    </div>
                </div>

            @empty
            <tr>
                <td colspan="10"><p>No groups found</p></td>
            </tr>
            @endforelse

            @include('group.create')
            @include('group.edit')
            @include('group.delete')
            {{-- @include('group.download') --}}
            @include('group.addMember')



        </div>
      </div>
    </div>
  </div>

  {{-- <div class="card">
    <div class="card-body">
      <h4 class="pb-2 mb-4 card-title">All Teachers Data</h4>
      <div class="pb-4 table-responsive">
        <table id="all-student" class="table align-middle border table-striped table-bordered text-nowrap">
          <thead>
            <!-- start row -->
            <tr>
              <th>Profile</th>
              <th>Sec.</th>
              <th>Subject</th>
              <th>D.O.B.</th>
              <th>Phone</th>
              <th>Email</th>
              <th></th>
            </tr>
            <!-- end row -->
          </thead>
          <tbody>
            <!-- start row -->
            <tr>
              <td>
                <div class="d-flex align-items-center">
                  <div class="me-3">
                    <img src="../assets/images/profile/user-2.jpg" alt="spike-img" width="45" class="rounded-circle" />
                  </div>

                  <div>
                    <h6 class="mb-1">Sakyu Basu</h6>
                    <p class="mb-0 fs-3">Class: 2</p>
                  </div>
                </div>
              </td>
              <td>A</td>
              <td>English</td>
              <td>25/05/2012</td>
              <td>+ 123 9988568</td>
              <td>kazifahim93@gmail.com</td>
              <td>
                <a href="../main/teacher-details.html" class="link-primary" data-bs-toggle="tooltip" data-bs-placement="top" title="View Details">
                  <i class="ti ti-eye fs-7"></i>
                </a>
              </td>
            </tr>
            <!-- end row -->

          </tbody>
        </table>
      </div>
    </div>
  </div> --}}

@endsection

@section('scripts')

    <script>
        function openEditModal(id) {
            $.ajax({
                url: '/group/' + id, // Replace with the appropriate route for fetching department details
                type: 'GET',
                success: function(response) {
                    // Update the modal content with the fetched department details
                    $('#editName').val(response.name);
                    $('#editDescription').val(response.description);
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
                url: '/group/' + id, // Replace with the appropriate route for fetching department details
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

        function openAddGroupMembersModal(id) {
            $.ajax({
                url: '/group/' + id, // Replace with the appropriate route for fetching department details
                type: 'GET',
                success: function(response) {
                    // Update the modal content with the fetched department details
                    $('#add_group_name').text(response.name);
                    $('#add_group_description').val(response.description);
                    $('#add_group_selectedId').val(response.id);
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
            $('#AddToGroupTable').DataTable();

        });
    </script>

    <script>
        $(document).ready(function() {
            // Add change event listener to select all checkbox
            $('#select-all').change(function() {
                // Get DataTable instance
                var table = $('#AddToGroupTable').DataTable();
                // Toggle checkbox selection for all rows across all pages
                $('td input[type="checkbox"]', table.rows().nodes()).prop('checked', $(this).prop('checked'));
            });
        });

        $(document).ready(function() {
            $('#saveBtn').click(function() {
                // Get DataTable instance
                var table = $('#AddToGroupTable').DataTable();
                var members = [];

                // Iterate over all rows in the table
                $('td input[type="checkbox"]:checked', table.rows().nodes()).each(function() {
                    // Push the ID of each selected member to the array
                    members.push($(this).val());
                });

                // Set the value of hidden input field with selected member IDs
                $('#members').val(members.join(','));

                // Submit the form
                $('#addMemberForm').submit();
            });
        });

    </script>

@endsection
