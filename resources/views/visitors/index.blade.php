
@extends('layouts.flow')

@section('title')
    <title>FaithFlow -- Visitors</title>
@endsection

@section('content')
<div class="mb-3 overflow-hidden position-relative">
    <div class="px-3 d-sm-flex align-items-center justify-content-between">
      <h4 class="mb-0 fs-6">Visitors</h4>
      <nav aria-label="breadcrumb">
        <ol class="mb-0 breadcrumb">
          <li class="breadcrumb-item">
            <a href="{{ route('dashboard') }}">Dashboard</a>
          </li>
          <li class="breadcrumb-item" aria-current="page">Visitors</li>
        </ol>
      </nav>
    </div>
  </div>

  <div class="card">
    <div class="card-body">
      <div class="justify-between mb-2 d-flex">
        <h4 class="mb-0 card-title">Visitors</h4>

        <div class="ms-auto">
            <a href="{{ route('visitors.create') }}" class="px-4 mb-1 btn bg-success-subtle text-success fs-4 ms-auto me-1">Add Visitor</a>
        </div>
      </div>
    <div class="mb-3 row">

        <div class="p-2 table-responsive">
            <table class="table align-items-center table-flush table-hover" id="facilities">
              <thead class="thead-light">
                <tr>
                  <th>#</th>
                  <th>Name</th>
                  <th>Phone</th>
                  <th>Location</th>
                  <th>Date Visited</th>
                  <td>Action</td>
                </tr>
              </thead>
              <tbody>
                @foreach($visitors as $key => $value)
                <tr>
                    <td>{{ $key + 1 }}</td>
                    <td>{{ $value->name }}</td>
                    <td>{{ $value->phone }}</td>
                    <td>{{ $value->location }}</td>
                    <td class="px-0">{{ formatShortDates($value->date_visited) }}</td>

                    <td>
                        <form action="{{ route('visitors.convert', $value->id) }}" method="POST">
                            @csrf
                            <button class="btn btn-primary btn-sm" type="submit">Convert to Member</button>
                        </form>
                    </td>

                    </td>
                  </tr>
                @endforeach

              </tbody>
            </table>

          </div>
        </div>
      </div>

  </div>

@endsection

@section('scripts')

    <script>
        function openEditModal(id) {
            $.ajax({
                url: '/facility/' + id, // Replace with the appropriate route for fetching department details
                type: 'GET',
                success: function(response) {
                    // Update the modal content with the fetched department details
                    $('#ed_name').val(response.name);
                    $('#ed_date_acquired').val(response.date_acquired);
                    $('#ed_description').val(response.description);
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
                url: '/facility/' + id, // Replace with the appropriate route for fetching department details
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
    </script>

    <script>
        $("#facilities").DataTable({
            dom: "Bfrtip",
            buttons: ["copy", "csv", "excel", "pdf", "print",],
        });
        $(
            ".buttons-copy, .buttons-csv, .buttons-print, .buttons-pdf, .buttons-excel"
        ).addClass("btn btn-primary btn-sm");
    </script>

@endsection
