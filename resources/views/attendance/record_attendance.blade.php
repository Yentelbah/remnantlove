@extends('layouts.flow')

@section('title')
    <title>FaithFlow -- Attendance</title>
@endsection

@section('content')


<div class="mb-3 overflow-hidden position-relative">
    <div class="px-3 d-sm-flex align-items-center justify-content-between">
    <h4 class="mb-0 fs-6">Record Attendance</h4>
    <nav aria-label="breadcrumb">
        <ol class="mb-0 breadcrumb">
        <li class="breadcrumb-item">
            <a href="{{ route('dashboard') }}">Dashboard</a>
        </li>
        <li class="breadcrumb-item">
            <a href="{{ route('attendance.index') }}">Attendance</a>
        </li>
        <li class="breadcrumb-item" aria-current="page">Record Attendance</li>
        </ol>
    </nav>
    </div>
</div>

<div class="card">
    <div class="card-body">

        <form action="{{ route('attendance.store') }}" method="POST">
            @csrf

            <h4 class="mb-3 card-title">Details</h4>
            <p class="mb-4 card-subtitle">Provide acurate information</p>

            <div class="row">
                <div class="mb-3 col-lg-12">
                    <label for="service_id" class="form-label">Service Name</label>
                    <select name="service_id" id="service_id" class="form-select @error('service_id') is-invalid @enderror">
                        @foreach($services as $service)
                            <option value="{{ $service->id }}">{{ $service->name }} - {{ $service->service_date }}</option>
                        @endforeach
                    </select>
                    @error('service_id')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
                {{--
                <div class="mb-3 col-lg-6">
                    <label for="service_date" class="form-label">Date</label>
                    <input class="form-control @error('service_date') is-invalid @enderror" type="date" name="service_date" id="service_date">
                    @error('service_date')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div> --}}

                <div class="mb-3 col-lg-6">
                    <label for="children_males" class="form-label">Total Male Children</label>
                    <input name="children_males" type="number" id="children_males" class="form-control @error('children_males') is-invalid @enderror"  value="{{ old('children_males') }}"/>
                    @error('children_males')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>

                <div class="mb-3 col-lg-6">
                    <label for="children_females" class="form-label">Total Female Children</label>

                    <input name="children_females" type="number" id="children_females" class="form-control @error('children_females') is-invalid @enderror"  value="{{ old('children_females') }}"/>
                    @error('children_females')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>

                <div class="mb-3 col-lg-6">
                    <label for="adult_males" class="form-label">Total Adult Males</label>

                    <input name="adult_males" type="number" id="adult_males" class="form-control @error('adult_males') is-invalid @enderror"  value="{{ old('adult_males') }}"/>
                    @error('adult_males')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>

                <div class="mb-3 col-lg-6">
                    <label for="adult_females" class="form-label">Total Adult Females</label>

                    <input name="adult_females" type="number" id="adult_females" class="form-control @error('adult_females') is-invalid @enderror"  value="{{ old('adult_females') }}"/>
                    @error('adult_females')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
            </div>

            <div class="col-12">
                <div class="gap-6 d-flex align-items-center justify-content-end">
                <a href="{{ route('attendance.index') }}" class="btn bg-danger-subtle text-danger">Cancel</a>
                <button class="btn btn-primary">Record</button>
                </div>
            </div>
        </form>

    </div>
</div>

    </div>
@endsection

@section('scripts')

@endsection
