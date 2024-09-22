@extends('layouts.flow')

@section('title')
    <title>FaithFlow -- User Logs</title>
@endsection

@section('content')

<div class="mb-3 overflow-hidden position-relative">
    <div class="px-3 d-sm-flex align-items-center justify-content-between">
      <h4 class="mb-0 fs-6">User Logs</h4>
      <nav aria-label="breadcrumb">
        <ol class="mb-0 breadcrumb">
          <li class="breadcrumb-item">
            <a href="{{ route('dashboard') }}">Dashboard</a>
          </li>
          <li class="breadcrumb-item">
            <a href="{{ route('user.index') }}">User Accounts</a>
          </li>
          <li class="breadcrumb-item" aria-current="page">User Logs</li>
        </ol>
      </nav>
    </div>
  </div>


      <div class="widget-content searchable-container list">
        <div class="card card-body">
            <div class="mb-2 d-flex justify-content-between align-items-center">
                <h5 class="mb-0 card-title">All Logs</h5>
            </div>

                <div class="p-3 table-responsive">
                  <table class="table align-middle" id="table">
                    <thead class="header-item">
                      <th>#</th>
                      <th>Date</th>
                      <th>Action</th>
                      <th>Details</th>
                    </thead>
                    <tbody>
                      <!-- start row -->
                      @php $i = 1; @endphp
                      @foreach ($logs as $item)

                      <tr class="search-items">
                        <td scope="row">{{$i++}}</td>
                        <td>{{ $item->created_at }}</td>
                        <td>{{ $item->action }}</td>
                        <td>{{ $item->description }}</td>
                      </tr>
                      @endforeach
                    </tbody>
                  </table>

                </div>

              </div>

          </div>

@endsection

@section('scripts')

    <script>
        $(document).ready(function () {
            $('#table').DataTable(); // ID From dataTable with Hover
        });
    </script>

@endsection
