<div class="">
    <div class="mb-4 d-flex justify-content-between align-items-center">
        <h4 class="mb-0">Accounts & Journals</h4>
        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#createAccount_Modal">
        New Account
        </button>
    </div>
    <div class="">
        <div class="">
            <div class="table-responsive text-nowrap">
                <table class="table ">
                <thead>
                    <tr class="text-nowrap">
                    <th>#</th>
                    <th>Name</th>
                    <th>Type </th>
                    <th style="text-align: center;">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @php
                    $i = 1;
                    @endphp

                    @foreach ($accounts as $item)
                    <tr>
                        <th scope="row">{{ $i++ }}</th>
                        <td>{{ $item->name }}</td>
                        <td>{{ $item->type }}
                                @if($item->is_deleted == 1)
                            <span class="badge bg-label-danger">Deleted</span>
                            @endif</td>
                        <td style="text-align: center;">

                            <a type="button" value="{{ $item->id }}" class="text-info edit me-2" data-bs-toggle="modal" data-bs-target="#editAccount_Modal" onclick="openAccountModal('{{ $item->id }}')">
                                <i class="ti ti-eye fs-5"></i>
                            </a>

                            @if ($item->is_deleted == 1)
                            <a type="button" value="{{ $item->id }}" class="text-primary" data-bs-toggle="modal" data-bs-target="#restoreAccount_Modal" onclick="openAccountRestoreModal('{{ $item->id }}')">
                                <i class="ti ti-refresh fs-5"></i>
                            </a>

                            @elseif($item->is_deleted == 0)

                            <a type="button" value="{{ $item->id }}" class="text-danger delete" data-bs-toggle="modal" data-bs-target="#deleteAccount_Modal" onclick="openAccountDeleteModal('{{ $item->id }}')">
                                <i class="ti ti-trash fs-5"></i>
                            </a>
                            @endif

                        </td>
                    </tr>
                    @endforeach
                </tbody>
                </table>
            </div>

        </div>
    </div>
    <!--MODALS-->
    @include('accounts.edit')

    @include('accounts.delete')

    @include('accounts.restore')

    @include('accounts.create')
</div>

<script>
    function openAccountModal(accountId) {
        $.ajax({
            url: '/account/' + accountId + '/details', // Replace with the appropriate route for fetching account details
            type: 'GET',
            success: function(response) {
                // Update the modal content with the fetched account details
                $('#account_type').val(response.type);
                $('#account_name').val(response.name);
                $('#selectedAccountId').val(response.id);
            },
            error: function(xhr) {
                // Handle error case
                console.log(xhr);
            }
        });
    }
</script>


<script>
    function openAccountDeleteModal(accountId) {
        $.ajax({
            url: '/account/' + accountId + '/details', // Replace with the appropriate route for fetching account details
            type: 'GET',
            success: function(response) {
                // Update the modal content with the fetched account details

                $('#del_account_name').text(response.name);

                $('#del_account_Id').val(response.id);
            },
            error: function(xhr) {
                // Handle error case
                console.log(xhr);
            }
        });
    }
</script>

<script>
    function openAccountRestoreModal(accountsId) {
        $.ajax({
            url: '/account/' + accountsId + '/details', // Replace with the appropriate route for fetching accounts details
            type: 'GET',
            success: function(response) {
                // Update the modal content with the fetched accounts details

                $('#res_account_name').text(response.name);

                $('#res_account_Id').val(response.id);

            },
            error: function(xhr) {
                // Handle error case
                console.log(xhr);
            }
        });
    }
</script>
