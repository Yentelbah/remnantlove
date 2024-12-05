
@extends('layouts.flow')

@section('title')
    <title>Family Members</title>
@endsection

@section('content')

    <div class="mb-3 overflow-hidden position-relative">
        <div class="px-3 d-sm-flex align-items-center justify-content-between">
        <h4 class="mb-0 fs-6">Family Members</h4>
        <nav aria-label="breadcrumb">
            <ol class="mb-0 breadcrumb">
            <li class="breadcrumb-item">
                <a href="{{ route('dashboard') }}">Dashboard</a>
            </li>
            <li class="breadcrumb-item">
                <a href="{{ route('family.index') }}">Families</a>
            </li>
            <li class="breadcrumb-item" aria-current="page">Family Members</li>
            </ol>
        </nav>
        </div>
    </div>

    <div class="card">
        <div class="card-body">
            <form action="{{ route('family.member.remove') }}" method="POST" id="removeMemberForm">
                @csrf

                <input hidden type="text" name="familyID" value="{{ $thisFamily->id }}">
                <input hidden type="text" name="members" id="selected_members">

                <div class="d-sm-flex justify-content-between align-items-start">
                    <div>
                        <h4 class="mb-0 card-title">{{ $thisFamily->name }}</h4>
                        <p class="mb-0 card-subtitle">{{ $thisFamily->description }}</p>
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
                            @foreach($familyMembers as $key => $value)

                            <tr>
                                <td><input class="form-check-input" type="checkbox" value="{{ $value->id }}"></td>
                                <td>{{ $key + 1 }}</td>
                                <td>{{ $value->member_number }}</td>
                                <td>{{ $value->name }} </td>
                                <td>{{ $value->relation }}</td>

                                <td>
                                    <div class="dropdown">
                                        <button id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false" class="px-1 shadow-none rounded-circle btn-transparent btn-sm btn">
                                          <i class="ti ti-dots-vertical fs-4 d-block"></i>
                                        </button>
                                        <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="dropdownMenuButton1">

                                          <li>
                                            <a href="javascript:void(0)" class="dropdown-item" value="{{ $value->id }}" data-bs-toggle="modal" data-bs-target="#updateRelation" id="#modalCenter" onclick="updateRelation('{{ $value->id }}')">Relation</a>
                                          </li>

                                          <li>
                                            <a href="javascript:void(0)" class="dropdown-item" value="{{ $value->id }}" data-bs-toggle="modal" data-bs-target="#removeModal" id="#modalCenter" onclick="removeMember('{{ $value->id }}')">Remove</a>
                                          </li>

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

    @include('family.updateRelation')
    @include('family.removeMember')

@endsection

@section('scripts')

<script>

    function removeMember(id) {
        $.ajax({
            url: '/members/' + id,
            type: 'GET',
            success: function(response) {
                $('#remove_name').text(response.name);
                $('#remove_selectedId').val(response.id);
            },
            error: function(xhr) {
                // Handle error case
                console.log(xhr);
            }
        });
    }

    function updateRelation(id) {
        $.ajax({
            url: '/family_members_details/' + id,
            type: 'GET',
            success: function(response) {
                $('#rel_name').val(response.memberName);
                $('#rel_relation').val(response.relation);
                $('#update_selectedId').val(response.memberId);
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
