
@extends('layouts.flow')

@section('title')
    <title>FaithFlow -- Group Details</title>
@endsection

@section('content')

    <div class="mb-3 overflow-hidden position-relative">
        <div class="px-3 d-sm-flex align-items-center justify-content-between">
        <h4 class="mb-0 fs-6">Group Details</h4>
        <nav aria-label="breadcrumb">
            <ol class="mb-0 breadcrumb">
            <li class="breadcrumb-item">
                <a href="{{ route('dashboard') }}">Dashboard</a>
            </li>
            <li class="breadcrumb-item">
                <a href="{{ route('group.index') }}">Groups</a>
            </li>
            <li class="breadcrumb-item" aria-current="page">Group Details</li>
            </ol>
        </nav>
        </div>
    </div>

    <div class="card">
        <div class="card-body">
            <form action="{{ route('group.member.remove') }}" method="POST" id="removeMemberForm">
                @csrf

                <input hidden type="text" name="GroupId" value="{{ $group->id }}">
                <input hidden type="text" name="members" id="selected_members">

                <div class="d-sm-flex justify-content-between align-items-start">
                    <div>
                        <h4 class="mb-0 card-title">{{ $group->name }}</h4>
                        <p class="mb-0 card-subtitle">{{ $group->description }}</p>
                    </div>

                    <button class="text-white btn btn-danger d-none" id="deleteBtn" type="submit">
                        <div class="d-sm-flex justify-content-start align-items-center">
                            <i class="mdi mdi-account-remove"></i>Remove  Selected
                        </div>
                    </button>

                </div>


                <div class="p-3 table-responsive">
                    <table class="table table-hover" id="GroupMemberTable">
                        <thead>
                            <tr>
                                <th><input type="checkbox" id="select-all" class="form-check-input select-all-checkbox"></th>
                                <th>#</th>
                                <th>MemberID</th>
                                <th>Name</th>
                                <th>Status</th>
                                <th></th>
                                {{-- <th style="text-align: center"><i class="mdi mdi-dots-vertical"></th> --}}
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($members as $key => $value)

                            <tr>
                                <td><input class="form-check-input" type="checkbox" value="{{ $value->id }}"></td>
                                <td>{{ $key + 1 }}</td>
                                <td>{{ $value->member_number }}</td>
                                <td>{{ $value->name }} </td>
                                <td>
                                    @if($value->status == 'Leader')
                                        {{ $value->title }}
                                    @else
                                        {{ $value->pivot->status }}
                                    @endif
                                </td>

                                <td>
                                    <div class="dropdown">
                                        <button id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false" class="px-1 shadow-none rounded-circle btn-transparent btn-sm btn">
                                          <i class="ti ti-dots-vertical fs-4 d-block"></i>
                                        </button>
                                        <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="dropdownMenuButton1">
                                        @if( $value->pivot->status == 'Member')
                                          <li>
                                            <a href="javascript:void(0)" class="dropdown-item" value="{{ $value->id }}" data-bs-toggle="modal" data-bs-target="#addPosition" id="#modalCenter" onclick="makeLeader('{{ $value->id }}')">Make Leader</a>
                                          </li>
                                        @else
                                          <li>
                                            <a href="javascript:void(0)" class="dropdown-item" value="{{ $value->id }}" data-bs-toggle="modal" data-bs-target="#updatePosition" id="#modalCenter" onclick="updateLeader('{{ $value->id }}')">Change Tile</a>
                                          </li>

                                          <li>
                                            <a href="javascript:void(0)" class="dropdown-item" value="{{ $value->id }}" data-bs-toggle="modal" data-bs-target="#revokePosition" id="#modalCenter" onclick="revokeLeader('{{ $value->id }}')">Revoke Leader</a>
                                          </li>

                                          @endif

                                        </ul>
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

            </form>

        </div>
    </div>

    @include('group.addPosition')
    @include('group.revokePosition')
    @include('group.updatePosition')

@endsection

@section('scripts')

<script>

    function makeLeader(id) {
        $.ajax({
            url: '/members/' + id, // Replace with the appropriate route for fetching department details
            type: 'GET',
            success: function(response) {
                $('#le_name').val(response.name);
                $('#le_selectedId').val(response.id);
            },
            error: function(xhr) {
                // Handle error case
                console.log(xhr);
            }
        });
    }

    function revokeLeader(id) {
        $.ajax({
            url: '/members/' + id, // Replace with the appropriate route for fetching department details
            type: 'GET',
            success: function(response) {
                $('#revoke_name').val(response.name);
                $('#revoke_selectedId').val(response.id);
            },
            error: function(xhr) {
                // Handle error case
                console.log(xhr);
            }
        });
    }

    function updateLeader(id) {
        $.ajax({
            url: '/members/' + id, // Replace with the appropriate route for fetching department details
            type: 'GET',
            success: function(response) {
                $('#update_name').val(response.name);
                $('#update_selectedId').val(response.id);
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
        $('#GroupMemberTable').DataTable(); // ID From dataTable with Hover

    });

    $(document).ready(function() {
        // Add change event listener to select all checkbox
        $('#select-all').change(function() {
            // Get DataTable instance
            var table = $('#GroupMemberTable').DataTable();
            // Toggle checkbox selection for all rows across all pages
            $('td input[type="checkbox"]', table.rows().nodes()).prop('checked', $(this).prop('checked'));
        });
    });

    $(document).ready(function() {
        $('#deleteBtn').click(function() {
            // Get DataTable instance
            var table = $('#GroupMemberTable').DataTable();
            var members = [];

            // Iterate over all rows in the table
            $('td input[type="checkbox"]:checked', table.rows().nodes()).each(function() {
                // Push the ID of each selected member to the array
                members.push($(this).val());
            });

            // Set the value of hidden input field with selected member IDs
            $('#selected_members').val(members.join(','));

            // Submit the form
            $('#removeMemberForm').submit();
        });
    });

    $(document).ready(function() {
        // Add change event listener to checkboxes
        $('input[type="checkbox"]').change(function() {
            // Check if any checkbox is checked
            var anyChecked = $('input[type="checkbox"]:checked').length > 0;

            // Show or hide the delete button based on checkbox state
            if (anyChecked) {
                $('#deleteBtn').removeClass('d-none');
            } else {
                $('#deleteBtn').addClass('d-none');
            }
        });
    });
</script>

@endsection
