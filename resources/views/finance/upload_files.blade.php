@extends('layouts.template')

@section('title')
    <title>Loan Application</title>
@endsection

@section('content')

    <div class="container-fluid">
          <div class="page-titles mb-7 mb-md-5">
            <div class="row">
              <div class="col-lg-8 col-md-6 col-12 align-self-center">
                <nav aria-label="breadcrumb">
                  <ol class="breadcrumb align-items-center">
                    <li class="breadcrumb-item">
                      <a class="text-muted text-decoration-none" href="{{ route('dashboard') }}">
                        <i class="ti ti-home fs-5"></i>
                      </a>
                      <a class="text-muted text-decoration-none" href="{{ route('loan.index') }}">
                        Loan
                      </a>

                    </li>
                    <li class="breadcrumb-item" aria-current="page">New Loan</li>
                  </ol>
                </nav>
                <h2 class="mb-0 fw-bolder fs-8">New Loan</h2>
              </div>
              <div class="col-lg-4 col-md-6 d-none d-md-flex align-items-center justify-content-end">
                <input class="form-control w-auto bg-primary-subtle border-0" type="date" id="currentDate" value="" name="date">
             </div>
            </div>
          </div>

          <div class="card">
            <div class="card-body">

                <form action="{{ route('loan.store') }}" method="POST">
                    @csrf


                    <div class="col-12">
                        <div class="card w-100 border position-relative overflow-hidden mb-0">
                            <div class="card-body p-4">
                                <h4 class="card-title">Client Documents</h4>
                                <br>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="application_type" id="new" value="new">
                                    <label class="form-check-label" for="new">New Client Loan Application</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="application_type" id="existing" value="existing">
                                    <label class="form-check-label" for="existing">Existing Client Loan Application</label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <br>


                    <div class="col-12">
                        <div class="card border shadow-none">
                            <div class="card-body p-4">
                            <h4 class="card-title mb-3">Guarantor Documents</h4>
                            <div class="row">
                                <div class="col mb-3">
                                    <label for="name" class="form-label">Name</label>
                                    <input name="g_name" type="text" id="g_name" class="form-control @error('g_name') is-invalid @enderror" placeholder="Guarantor Name" value="{{ old('g_name') }}"/>
                                    @error('g_name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>

                                <div class="col mb-3">
                                    <label for="g_phone" class="form-label">Phone</label>
                                    <input name="g_phone" type="text" id="g_phone" class="form-control @error('g_phone') is-invalid @enderror" placeholder="+233" value="{{ old('phone') }}"/>
                                    @error('g_phone')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>

                                <div class="col mb-3">
                                    <label for="g_email" class="form-label">Email</label>
                                    <input name="g_email" type="email" id="g_email" class="form-control @error('g_email') is-invalid @enderror" placeholder="guarantor@mail.com" value="{{ old('g_email') }}"/>
                                    @error('g_email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        </div>
                    </div>

                    <div class="col-12">
                        <div class="card border shadow-none">
                            <div class="card-body p-4">
                            <h4 class="card-title mb-3">Loan Amount</h4>

                            <div class="row">
                                <div class="col mb-3">
                                    <input name="loan_amount" type="number" id="loan_amount" class="form-control @error('loan_amount') is-invalid @enderror" placeholder="GHS" value="{{ old('loan_amount') }}"/>
                                    @error('loan_amount')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>

                            </div>
                        </div>
                        </div>
                    </div>

                    <div class="col-12">
                      <div class="d-flex align-items-center justify-content-end gap-6">
                        <a href="{{ route('loan.index') }}" class="btn bg-danger-subtle text-danger">Cancel</a>
                        <button class="btn btn-primary">Process</button>
                        </div>
                    </div>
                </form>

                  </div>
                </div>

    </div>
@endsection

@section('scripts')

  <script>
    document.getElementById('uploadLogo').addEventListener('change', function () {
        // Check if a file is selected
        if (this.files.length > 0) {
            // Submit the form when a file is selected
            this.parentElement.submit();
        }
    });
  </script>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const newClientRadio = document.getElementById('new');
        const existingClientRadio = document.getElementById('existing');
        const selectExistingClientDiv = document.getElementById('selectExistingClient');
        const newClientDiv = document.getElementById('NewClient');

        newClientRadio.addEventListener('click', function () {
            selectExistingClientDiv.style.display = 'none';
            newClientDiv.style.display = 'block';
        });

        existingClientRadio.addEventListener('click', function () {
            selectExistingClientDiv.style.display = 'block';
            newClientDiv.style.display = 'none';
        });
    });
</script>

@endsection
