@extends('layouts.flow')

@section('title')
    <title>FaithFlow -- Foundation School</title>
@endsection

@section('content')
  <div class="mb-3 overflow-hidden position-relative">
    <div class="px-3 d-sm-flex align-items-center justify-content-between">
      <h4 class="mb-0 fs-6">Foundation School</h4>
      <nav aria-label="breadcrumb">
        <ol class="mb-0 breadcrumb">
          <li class="breadcrumb-item">
            <a href="{{ route('dashboard') }}">Dashboard</a>
          </li>
          <li class="breadcrumb-item">
            <a href="{{ route('foundation-modules.index') }}">Modules</a>
          </li>
          <li class="breadcrumb-item" aria-current="page">Add Module</li>
        </ol>
      </nav>
    </div>
  </div>


  <div class="card">
    <div class="card-body wizard-content">
      <h4 class="mb-6 card-title">New Foundation School Module</h4>
      <br>
      <form action="{{ route('foundation-modules.store') }}" method="POST" class="tab-wizard wizard-circle">
        @csrf
            <div class="mx-auto row d-flex">
                <!-- Input fields -->
                <div class="order-2 col-lg-8 col-12 order-lg-1">
                    <div class="mb-3 form-group">
                        <label class="form-label" for="module_name">Module Name</label>
                        <input class="form-control  @error('module_name') is-invalid @enderror" name="module_name" id="le_name">
                        @error('module_name')
                        <small class="invalid-feedback" role="alert">
                          {{ $message }}
                        </small>
                        @enderror
                    </div>

                    <div class="mb-3 form-group">
                        <label for="description" class="form-label">Description</label>
                        <textarea placeholder="" class="form-control @error('description') is-invalid @enderror" name="description" id="description" rows="3"></textarea>
                        @error('description')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                </div>

                <!-- Image -->
                <div class="order-1 col-lg-4 col-12 d-flex justify-content-center order-lg-2">
                    <img src="../assets/images/backgrounds/module.svg" alt="" class="img-fluid" width="100%">
                </div>

            </div>

        </section>

          <div class="col-12">
            <div class="gap-6 mt-4 d-flex align-items-center justify-content-end">
              <button class="btn btn-success" type="submit">Save</button>
            </div>
        </div>
        </section>
      </form>
    </div>
  </div>
@endsection

@section('scripts')

@endsection
