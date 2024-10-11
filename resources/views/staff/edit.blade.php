<div class="modal fade" id="editModal" tabindex="-1" role="dialog"daria-labelledby="Edit Group" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalCenterTitle">Update  Staff Information</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
              </div>
              <div class="modal-body">

            <form action="{{ route('staff.update') }}" method="POST" class="tab-wizard wizard-circle">
                @csrf
                @method('PUT')
                    <div class="mx-auto row d-flex">
                        <!-- Input fields -->
                        <div class="order-2 col-lg-8 col-12 order-lg-1">
                            <input type="text" hidden class="form-control" id="ed_selectedId" name="selectedId">

                            <div class="row">
                                <div class="mb-3 form-group">
                                    <label class="form-label" for="member">Staff Name</label>
                                    <input type="text" class="form-control" id="ed_name" name="name">
                                </div>

                                <div class="mb-3 form-group col-md-6">
                                    <label class="form-label" for="education_background">Education Background</label>
                                    <input type="text" class="form-control" id="ed_education_background" name="education_background">
                                </div>


                                <div class="mb-3 form-group col-md-6">
                                    <label class="form-label" for="position">Position</label>
                                    <input class="form-control  @error('position') is-invalid @enderror" name="position" id="ed_position">
                                    @error('position')
                                    <small class="invalid-feedback" role="alert">
                                    {{ $message }}
                                    </small>
                                    @enderror
                                </div>

                                <div class="mb-3 form-group col-md-6">
                                    <label class="form-label" for="health_status">Health Status</label>
                                    <textarea class="form-control" id="ed_health" name="health_status" rows="3"></textarea>
                                </div>

                                <div class="mb-3 form-group col-md-6">
                                    <label class="form-label" for="hobbies_interests">Hobbies and Interests</label>
                                    <textarea class="form-control" id="ed_hobbies" name="hobbies_interests" rows="3"></textarea>
                                </div>

                                <div class="mb-3 form-group">
                                    <label class="form-label" for="date_appointed">Date Appointed</label>
                                    <input type="date" name="date_appointed" class="form-control  @error('name') is-invalid @enderror" id="ed_date_appointed">
                                    @error('date_appointed')
                                    <small class="invalid-feedback" role="alert">
                                        {{ $message }}
                                    </small>
                                    @enderror
                                </div>

                            </div>

                        </div>

                        <!-- Image -->
                        <div class="order-1 col-lg-4 col-12 d-flex justify-content-center order-lg-2">
                            <img src="../assets/images/backgrounds/certify.svg" alt="" class="img-fluid" width="100%">
                        </div>
                    </div>
                </section>


                <div class="col-12">
                    <div class="gap-6 mt-4 d-flex align-items-center justify-content-end">
                        <button class="btn btn-primary" type="submit" >Update</button>
                        <button class="btn bg-danger-subtle text-danger" type="button" data-bs-dismiss="modal">Cancel</button>
                    </div>
                </div>
            </form>
            </div>
        </div>
    </div>
</div>
