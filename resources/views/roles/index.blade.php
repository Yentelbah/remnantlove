        <div class="">
            <div class="mb-4 d-flex justify-content-between align-items-center">
                <h4>Role Roles & Permissions</h4>

                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#createRoleModal">
                    Add New Roles
                     </button>
            </div>
            <div class="">
                <div class="table-responsive text-nowrap long" >

                    <table class="table">
                    <thead>
                        <tr class="text-nowrap">
                        <th>#</th>
                        <th>Name</th>
                        <th>Description</th>
                        <th>Permission Level</th>
                        <th style="text-align: center">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                        $i = 1;
                        @endphp

                        @foreach ($churchRoles as $value)
                        <tr>
                            <th scope="row">{{ $i++ }}</th>
                            <td>{{ $value->name }}</td>
                            <td>{{ $value->description }}</td>
                            <td>{{ $value->role->name }}</td>

                            <td style="text-align: center">

                                {{-- @if (Auth::user()->companyRole->role->name === 'Company Admin' || Auth::user()->companyRole->role->name === 'Owner') --}}
                                <a type="button" value="{{ $value->id }}" class="text-info edit me-2" data-bs-toggle="modal" data-bs-target="#editRoleModal" onclick="openRoleEditModal('{{ $value->id }}')">
                                    <i class="ti ti-eye fs-5"></i>
                                </a>

                                {{-- @endif

                                @if (Auth::user()->churchRole->role->name === 'Owner') --}}
                                @if ($value->is_deleted == 1)
                                    <a type="button" value="{{ $value->id }}" class="text-success" data-bs-toggle="modal" data-bs-target="#restoreRoleModal" onclick="openRoleRestoreModal('{{ $value->id }}')">
                                        <i class="ti ti-refresh fs-5"></i>
                                    </a>

                                    @elseif($value->is_deleted == 0)

                                    <a type="button" value="{{ $value->id }}"class="text-danger" data-bs-toggle="modal" data-bs-target="#deleteRoleModal" onclick="openRoleDeleteModal('{{ $value->id }}')">
                                        <i class="ti ti-trash fs-5"></i>
                                    </a>
                                    @endif
                                {{-- @endif --}}

                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                    </table>
                </div>
            </div>


        </div>
            <!--MODALS-->
            @include('roles.create')
            @include('roles.edit')
            @include('roles.restore')
            @include('roles.delete')

    <script>
        function openRoleEditModal(roleId) {
            $.ajax({
                url: '/role/' + roleId + '/details', // Replace with the appropriate route for fetching role details
                type: 'GET',
                success: function(response) {
                    // Update the modal content with the fetched role details
                    $('#role_name').val(response.name);
                    $('#role_description').val(response.description);
                    $('#role_role_id').val(response.role_id);
                    $('#selectedRoleId').val(response.id);

                },
                error: function(xhr) {
                    // Handle error case
                    console.log(xhr);
                }
            });
        }


        function openRoleDeleteModal(roleId) {
            $.ajax({
                url: '/role/' + roleId + '/details', // Replace with the appropriate route for fetching role details
                type: 'GET',
                success: function(response) {
                    // Update the modal content with the fetched role details

                    $('#role_del_name').text(response.name);

                    $('#del_selectedRoleId').val(response.id);

                    // Set the selected category without clearing existing options
                    var selectCategory = $('#select_category');
                    selectCategory.val(response.category_id);
                },
                error: function(xhr) {
                    // Handle error case
                    console.log(xhr);
                }
            });
        }

        function openRoleRestoreModal(role) {
            $.ajax({
                url: '/role/' + role + '/details', // Replace with the appropriate route for fetching role details
                type: 'GET',
                success: function(response) {
                    // Update the modal content with the fetched role details

                    $('#role_res_name').text(response.name);

                    $('#res_selectedRoleId').val(response.id);

                },
                error: function(xhr) {
                    // Handle error case
                    console.log(xhr);
                }
            });
        }
    </script>

