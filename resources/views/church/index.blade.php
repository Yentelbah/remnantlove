
    <div class="mb-4 d-flex justify-content-between align-items-center">
        <h4 class="mb-0">Church Profile</h4>
        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#editComModal">Update Church Profile </button>
    </div>

    <div class="">
        <div class="">
            <h4>{{ isset($church) ? $church->name : '' }}</h4>
            <div class="row">
                <div class="col-sm-6">
                   <p>Address:<br><strong>{{ isset($church) ? $church->address : '' }}</strong></p>
                   <p>City:<br> <strong>{{ isset($church) ? $church->city : '' }}, {{ isset($church) ? $church->region : '' }}</strong></p>
                   <p>Country:<br> <strong>{{ isset($church) ? $church->country : '' }}</strong></p>
                </div>
                <div class="col-sm-6">
                   <p>Phone:<br> <strong>{{ isset($church) ? $church->phone : '' }}</strong></p>
                   <p>Alternate Phone: <br><strong>{{ isset($church) ? $church->phone2 : '' }}</strong></p>
                   <p>Email: <br><strong>{{ isset($church) ? $church->email : '' }}</strong></p>
                </div>
             </div>
        </div>
    </div>

    @include('church.edit')



