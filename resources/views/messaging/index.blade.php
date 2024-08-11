
@extends('layouts.flow')

@section('title')
    <title>FaithFlow -- Message Center</title>
@endsection

@section('content')
    <div class="mb-3 overflow-hidden position-relative">
        <div class="px-3 d-sm-flex align-items-center justify-content-between">
        <h4 class="mb-0 fs-6">Messaging</h4>
        <nav aria-label="breadcrumb">
            <ol class="mb-0 breadcrumb">
            <li class="breadcrumb-item">
                <a href="{{ route('dashboard') }}">Dashboard</a>
            </li>
            <li class="breadcrumb-item" aria-current="page">Messaging</li>
            </ol>
        </nav>
        </div>
    </div>

    <div class="row">

        <div class="col-lg-5">
            <div class="row">
                <div class="col-lg-6">
                    <a data-bs-toggle="modal" data-bs-target="#singleSMSModal" href="javascript:void(0)">
                        <div class="overflow-hidden shadow-none card info-card bg-primary-subtle">
                            <div class="card-body">
                              <div class="mb-0 d-flex align-items-center justify-content-between">
                                <h5 class="mb-0 fs-4 fw-bold">Send Quick SMS</h5>
                              </div>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col-lg-6">
                    <a data-bs-toggle="modal" data-bs-target="#bulkSMSModal" href="javascript:void(0)">
                        <div class="overflow-hidden shadow-none card info-card bg-info-subtle">
                            <div class="card-body">
                              <div class="mb-0 d-flex align-items-center justify-content-between">
                                <h5 class="mb-0 fs-4 fw-bold">Send Bulk SMS</h5>
                              </div>
                            </div>
                        </div>
                    </a>
                </div>
            </div>

            <div class="card">
                <div class="card-body">
                <div class="d-flex align-items-center ">
                    <div>
                    <h4 class="card-title">{{ $credits->balance ?? 0 }}</h4>
                    <p class="card-subtitle">Credits Balance</p>
                    </div>
                    <div class="ms-auto">
                    <a class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#purchaseModal" href="javascript:void(0)"><i class='bx bx-scan me-1'></i>Top Up</a>
                    </div>
                </div>
                </div>
            </div>

            <div class="card">
                <div class="card-body">
                <div class="d-flex align-items-center ">
                    <div>
                    <h4 class="card-title">Confirm Top Up</h4>
                    <p class="card-subtitle">Enter code</p>
                    </div>
                    <div class="ms-auto">
                    <a class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#confirmModal" href="javascript:void(0)"><i class='bx bx-scan me-1'></i>Top Up</a>
                    </div>
                </div>
                </div>
            </div>

            <div class="card">
            <div class="card-body">
                <div class="d-flex align-items-center ">
                <div>
                    <h4 class="card-title">{{ $credits->senderID ?? 'Not Set' }}</h4>
                    <p class="card-subtitle">SenderID</p>
                </div>
                <div class="ms-auto">
                    <a class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#senderIdModal" href="javascript:void(0)"><i class='bx bx-scan me-1'></i>Udpdate</a>
                </div>
                </div>
            </div>
            </div>

        </div>
        <!-- column -->
        <div class="col-lg-7">
            <div class="card">
            <div class="card-body">
                <div class="d-md-flex align-items-center">
                <div>
                    <h4 class="card-title">Recently Sent Messages</h4>
                    {{-- <p class="card-subtitle"></p> --}}
                </div>
                {{-- <div class="mt-3 ms-auto mt-md-0">
                    <select class="border-0 form-select theme-select" aria-label="Default select example">
                    <option value="1">March 2024</option>
                    <option value="2">March 2024</option>
                    <option value="3">March 2024</option>
                    </select>
                </div> --}}
                </div>
                <div class="mt-1 table-responsive">
                    <table class="table align-middle search-table text-nowrap" id="multi_col_order">

                    <thead>
                    <tr>
                        <th scope="col" class="px-0 text-muted">#</th>
                        <th scope="col" class="px-0 text-muted">Date</th>
                        <th scope="col" class="px-0 text-muted">Subject</th>
                        <th scope="col" class="px-0 text-muted">Type</th>
                        <th scope="col" class="px-0 text-center text-muted">Action</th>
                    </tr>
                    </thead>
                    <tbody>
                        @php
                        $i = 1;
                        @endphp

                        @forelse ($sent_messages as $sent)
                        <tr>
                            <th class="px-0" scope="row">{{ $i++ }}</th>
                            <td class="px-0">{{ formatDateForDisplay($sent->created_at) }}</td>
                            <td class="px-0">{{ $sent->subject }}</td>
                            <td class="px-0">{{ $sent->type }}</td>

                            <td class="px-0 text-center text-muted">
                            <div class="action-btn">
                                <a href="javascript:void(0)" value="{{ $sent->id }}" class="text-primary edit"  data-bs-toggle="modal" data-bs-target="#viewModal" onclick="openViewModal('{{ $sent->id }}')">
                                <i class="ti ti-eye fs-5"></i>
                                </a>

                                <a href="javascript:void(0)" value="{{ $sent->id }}" class="text-dark delete ms-2"  data-bs-toggle="modal" data-bs-target="#deleteModal" onclick="openDeleteModal('{{ $sent->id }}')">
                                <i class="ti ti-trash fs-5"></i>
                                </a>

                            </div>

                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="7">No sent messages found.</td>
                        </tr>
                        @endforelse
                    </tbody>

                </table>
                </div>


            </div>
            </div>
        </div>

        @include('messaging.purchase_credit')

        @include('messaging.view')

        @include('messaging.senderID')

        @include('messaging.delete')

        @include('messaging.credit_request_confirm')

        @include('messaging.create')

        @include('messaging.createBulk')

    </div>

@endsection

@section('scripts')

<script>
function openViewModal(sentId) {
    $.ajax({
        url: '/sms/' + sentId + '/details', // Replace with the appropriate route for fetching sent details
        type: 'GET',
        success: function(response) {
            // Update the modal content with the fetched sent details
            $('#recipient').text(response.recipient);
            $('#message').text(response.message);
            $('#subject').text(response.subject);
            $('#selectedNoticeId').val(response.id);
        },
        error: function(xhr) {
            // Handle error case
            console.log(xhr);
        }
    });
}

function openDeleteModal(sentId) {
    $.ajax({
        url: '/sms/' + sentId + '/details', // Replace with the appropriate route for fetching sent details
        type: 'GET',
        success: function(response) {
            // Update the modal content with the fetched sent details

            $('#del_selectedSentId').val(response.id);
        },
        error: function(xhr) {
            // Handle error case
            console.log(xhr);
        }
    });
}

</script>

@endsection
