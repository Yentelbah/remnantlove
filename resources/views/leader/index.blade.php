
@extends('layouts.flow')

@section('title')
    <title>FaithFlow -- Leaders</title>
@endsection

@section('content')
  <div class="mb-3 overflow-hidden position-relative">
    <div class="px-3 d-sm-flex align-items-center justify-content-between">
      <h4 class="mb-0 fs-6">Leaders</h4>
      <nav aria-label="breadcrumb">
        <ol class="mb-0 breadcrumb">
          <li class="breadcrumb-item">
            <a href="{{ route('dashboard') }}">Dashboard</a>
          </li>
          <li class="breadcrumb-item">
            <a href="{{ route('member.index') }}">Members</a>
          </li>
          <li class="breadcrumb-item" aria-current="page">Leaders</li>
        </ol>
      </nav>
    </div>
  </div>

  <div class="card">
    <div class="card-body">
        <div class="justify-between mb-2 d-flex">
            <h4 class="mb-0 card-title">Leaders</h4>

            <div class="ms-auto">
                <a href="{{ route('leader.new') }}" class="px-4 mb-1 btn bg-success-subtle text-success fs-4 ms-auto me-1">Add Leader</a>
            </div>
        </div>

        <div class="p-3 table-responsive">
            <table class="table align-items-center table-flush table-hover" id="dataTableLeader">
                <thead class="thead-light">
                <tr>
                    <th>#</th>
                    <th>MemberID</th>
                    <th>Name</th>
                    <th>Gender</th>
                    <th>Phone</th>
                    <th>Group</th>
                    <th>Title</th>
                    <th></th>
                </tr>
                </thead>
                <tbody>
                @foreach($leaders as $key => $value)
                <tr>
                    <td>{{ $key + 1 }}</td>
                    <td>{{ $value->member->member_number }}</td>
                    <td>{{ $value->member->name }}</td>
                    <td>{{ $value->member->gender }}</td>
                    <td>{{ $value->member->phone }}</td>
                    <td>{{ $value->group->name }}</td>
                    <td>{{ $value->title }}</td>
                    <td>
                        <div class="dropdown">
                            <button id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false" class="px-1 shadow-none rounded-circle btn-transparent btn-sm btn">
                              <i class="ti ti-dots-vertical fs-4 d-block"></i>
                            </button>
                            <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="dropdownMenuButton1">
                                <li>
                                    <form action="{{ route('member.search') }}" method="POST" id="memberForm{{ $value->member->id }}">
                                        @csrf
                                        <input type="text" hidden value="{{ $value->member->id }}" name="query">
                                        <a href="javascript:void(0)" class="dropdown-item" value="{{ $value->member->id }}" onclick="document.getElementById('memberForm{{ $value->member->id }}').submit(); return false;">View</a>
                                    </form>

                                </li>
                                <li>
                                    <a href="javascript:void(0)" class="dropdown-item" value="{{ $value->member->id }}" data-bs-toggle="modal" data-bs-target="#followupModal" id="#modalCenter" onclick="openFollowupModal('{{ $value->member->id }}')">Follow-up</a>
                                </li>
                                @if ($nonExistingUsers->contains('member_id', $value->member_id))
                                <li>
                                    <a href="javascript:void(0)" class="dropdown-item" value="{{ $value->id }}" data-bs-toggle="modal" data-bs-target="#createModal" id="#modalCenter" onclick="openUserAccountModal('{{ $value->id }}')">+ User Account</a>
                                </li>
                                @endif
                              <li>
                                <a href="{{ route('leader.edit', ['id' => $value->id]) }}" class="dropdown-item">Edit</a>
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
    @include('leader.delete')
    @include('leader.account')
    @include('followup.add')


@endsection

@section('scripts')


    <script>

        function openFollowupModal(id) {
            $.ajax({
                url: '/members/' + id, // Replace with the appropriate route for fetching department details
                type: 'GET',
                success: function(response) {
                    // Update the modal content with the fetched department details
                    $('#fl_name').text(response.name);
                    $('#fl_origin').val('member');
                    $('#fl_selectedId').val(response.id);

                },
                error: function(xhr) {
                    // Handle error case
                    console.log(xhr);
                }
            });
        }

        function openDeleteModal(id) {
            $.ajax({
                url: '/leaders/' + id, // Replace with the appropriate route for fetching department details
                type: 'GET',
                success: function(response) {
                    // Update the modal content with the fetched department details
                    $('#del_name').text(response.member.name);
                    $('#del_selectedId').val(response.leader.id);
                },
                error: function(xhr) {
                    // Handle error case
                    console.log(xhr);
                }
            });
        }

        function openUserAccountModal(id) {
            $.ajax({
                url: '/leaders/' + id, // Replace with the appropriate route for fetching department details
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
        $("#dataTableLeader").DataTable({
            dom: "Bfrtip",
            buttons: ["copy", "csv", "excel", "pdf", "print",],
        });
        $(
            ".buttons-copy, .buttons-csv, .buttons-print, .buttons-pdf, .buttons-excel"
        ).addClass("btn btn-primary btn-sm");
    </script>

@endsection
