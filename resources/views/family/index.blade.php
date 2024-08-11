
@extends('layouts.flow')

@section('title')
    <title>FaithFlow -- Families</title>

@endsection

@section('content')

@section('content')

  <div class="mb-3 overflow-hidden position-relative">
    <div class="px-3 d-sm-flex align-items-center justify-content-between">
      <h4 class="mb-0 fs-6">Member Families</h4>
      <nav aria-label="breadcrumb">
        <ol class="mb-0 breadcrumb">
          <li class="breadcrumb-item">
            <a href="{{ route('dashboard') }}">Dashboard</a>
          </li>
          <li class="breadcrumb-item" aria-current="page">Member Families</li>
        </ol>
      </nav>
    </div>
  </div>

  <div class="widget-content searchable-container list">
    <div class="card card-body">
      <div class="row">
        <div class="col-md-4 col-xl-3">
          {{-- <form class="position-relative">
            <input type="text" class="form-control product-search ps-5" id="input-search" placeholder="Search Contacts..." />
            <i class="ti ti-search position-absolute top-50 start-0 translate-middle-y fs-6 text-dark ms-3"></i>
          </form> --}}
        </div>
        <div class="mt-3 col-md-8 col-xl-9 text-end d-flex justify-content-md-end justify-content-center mt-md-0">
          <a href="javascript:void(0)" id="btn-add-contact" class="btn btn-primary d-flex align-items-center" data-bs-toggle="modal" data-bs-target="#createModal">
            <i class="text-white ti ti-users me-1 fs-5"></i> Add Family
          </a>
        </div>
      </div>
    </div>

    @include('family.create')
    @include('family.edit')
    @include('family.delete')


    <div class="row">
        @forelse($family as $key => $value)
        <div class="col-lg-4 col-md-6">
            <div class="overflow-hidden card hover-img">
                <div class="p-4 text-center card-body border-bottom">
                  {{-- <img src="../assets/images/profile/user-2.jpg" alt="spike-img" class="mb-3 rounded-circle" width="80" height="80"> --}}
                  <h6 class="mb-0 fw-semibold">{{ $value->name }}'s Family</h6>
                  <span class="text-dark fs-2">{{ $value->members_count }} Members</span>
                </div>
                <ul class="px-2 py-2 mb-0 text-bg-light list-unstyled d-flex align-items-center justify-content-center">
                  <li class="position-relative">
                    <a class="p-2 text-primary d-flex align-items-center justify-content-center fs-3 rounded-circle fw-semibold" href="{{ route('family.members.list', $value->id) }}">
                        View members
                    </a>
                  </li>
                  <span class="text-primary">|</span>

                  <li class="position-relative">
                    <a class="p-2 text-danger d-flex align-items-center justify-content-center fs-3 rounded-circle fw-semibold " href="{{ route('family.list', $value->id) }}">
                      Add Member
                    </a>
                  </li>
                  <span class="text-primary">|</span>

                  <li class="position-relative">
                    <a class="p-2 text-primary d-flex align-items-center justify-content-center fs-5 rounded-circle fw-semibold " href="javascript:void(0)" data-bs-toggle="modal" data-bs-target="#editModal" value="{{ $value->id }}" onclick="openEditModal('{{ $value->id }}')" id="#modalCenter">
                      <i class="ti ti-edit"></i>
                    </a>
                  </li>

                  <li class="position-relative">
                    <a class="p-2 text-danger d-flex align-items-center justify-content-center fs-5 rounded-circle fw-semibold " href="javascript:void(0)"data-bs-toggle="modal" data-bs-target="#deleteModal" value="{{ $value->id }}" onclick="openDeleteModal('{{ $value->id }}')" id="#modalCenter">
                      <i class="ti ti-trash"></i>
                    </a>
                  </li>
                </ul>
              </div>
            </div>
        @endforeach
    </div>


@endsection

@section('scripts')

    <script>
        function openEditModal(id) {
            $.ajax({
                url: '/family/' + id, // Replace with the appropriate route for fetching department details
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
                url: '/family/' + id, // Replace with the appropriate route for fetching department details
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
                url: '/family/' + id, // Replace with the appropriate route for fetching department details
                type: 'GET',
                success: function(response) {
                    // Update the modal content with the fetched department details
                    $('#add_family_name').text(response.name);
                    $('#add_family_description').val(response.description);
                    $('#add_family_selectedId').val(response.id);
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
