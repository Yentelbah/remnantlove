
@extends('layouts.flow')

@section('title')
    <title>FaithFlow -- Documents</title>
@endsection

@section('content')
  <div class="mb-3 overflow-hidden position-relative">
    <div class="px-3 d-sm-flex align-items-center justify-content-between">
      <h4 class="mb-0 fs-6">Documents</h4>
      <nav aria-label="breadcrumb">
        <ol class="mb-0 breadcrumb">
          <li class="breadcrumb-item">
            <a href="{{ route('dashboard') }}">Dashboard</a>
          </li>
          <li class="breadcrumb-item">
            <a href="{{ route('member.index') }}">Members</a>
          </li>
          <li class="breadcrumb-item" aria-current="page">Documents</li>
        </ol>
      </nav>
    </div>
  </div>

  <div class="card">
    <div class="card-body">
        <p>Upload documents to storage</p>

    </div>

  </div>

@endsection

@section('scripts')

@endsection
