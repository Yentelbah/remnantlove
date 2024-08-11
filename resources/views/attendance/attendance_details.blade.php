@extends('layouts.flow')

@section('title')
    <title>FaithFlow -- Attendance Details</title>
@endsection

@section('content')
<div class="container-fluid">
    <div class="mb-5 page-titles">
      <div class="row">
        <div class="col-lg-8 col-md-6 col-12 align-self-center">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb align-items-center">
                  <li class="breadcrumb-item">
                    <a class="text-muted text-decoration-none" href="{{ route('dashboard') }}">
                      <i class="ti ti-home fs-5"></i>
                    </a>
                  </li>

                  <li class="breadcrumb-item">
                    <a class="text-muted text-decoration-none" href="{{ route('attendance.index') }}">
                      Attendance
                    </a>
                  </li>

                  <li class="breadcrumb-item" aria-current="page">Attendance Details</li>
                </ol>
              </nav>
              <h2 class="mb-0 fw-bolder fs-8">Journal Entry Details</h2>
        </div>
        <div class="col-lg-4 col-md-6 d-none d-md-flex align-items-center justify-content-end">
            <input class="w-auto border-0 form-control bg-primary-subtle" type="date" id="currentDate" value="" name="date">
        </div>

      </div>
    </div>


    <div class="gap-2 mb-4 text-center d-flex flex-column flex-sm-row align-items-center justify-content-sm-between text-sm-start">
      <div class="mb-2 mb-sm-0">
        <h4 class="mb-1">
           Attendance ID: {{ $attendance->id }}
        </h4>
        <p class="mb-0">
            {{ $attendance->service->service_date }}
            {{ $attendance->description }}
        </p>
      </div>
      @if (Auth::user()->role == 1 || Auth::user()->role == 2 )

      <div class="d-flex justify-content-center">
        <button type="button" value="{{ $attendance->id }}" class="bg-danger-subtle btn me-2 text-danger d-flex align-items-center" data-bs-target="#deleteModal" data-bs-toggle="modal" onclick="openDeleteModal('{{ $attendance->id }}')"><i class="ti ti-trash me-1 fs-5"></i> Delete Journal Entry</button>
      </div>

      @endif
    </div>


</div>

@endsection

@section('scripts')


@endsection
