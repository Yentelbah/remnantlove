@extends('layouts.main')

@section('title')
    <title>SMS Credit Accounts</title>
@endsection

@section('content')

<div class="container-fluid flex-grow-1 container-p-y">
    <h4 class="py-3 mb-0 fw-bold"><span class="text-muted fw-light">SMS Credit /</span> Accounts</h4>

    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h5 class="mb-0">Accounts</h5>

        </div>
        <div class="card-body">
            <div class="table-responsive text-nowrap">
                <table class="table table-striped">
                <thead>
                    <tr class="text-nowrap">
                    <th>#</th>
                    <th>Account Name</th>
                    <th>Balance</th>
                    </tr>
                </thead>
                <tbody>
                    @php
                    $i = 1;
                    @endphp

                    @forelse ($requests as $request)
                    <tr>
                        <td scope="row">{{ $i++ }}</td>
                        <td>{{ $request->school->name }}</td>
                        <td>{{ $request->balance }}</td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="9">No accounts found.</td>
                    </tr>
                    @endforelse                </tbody>
                </table>
            </div>

        </div>
        <!--MODALS-->


        @include('super.credit_request_confirm')

    </div>
    {{-- <div style="margin-top: 20px;">
        @include('layouts.partials.pagination', ['paginator' => $billings])
    </div> --}}

</div>

@endsection

@section('scripts')

    <script>
        function openConfirmModal(requestId) {
            $.ajax({
                url: '/sms_credits/' + requestId + '/details', // Replace with the appropriate route for fetching billing details
                type: 'GET',
                success: function(response) {
                    // Update the modal content with the fetched billing details
                    $('#con_quantity').val(response.number_of_credits);
                    $('#con_amount').val(response.amount);
                    $('#SelectedId').val(response.id);

                },
                error: function(xhr) {
                    // Handle error case
                    console.log(xhr);
                }
            });
        }
    </script>

@endsection
