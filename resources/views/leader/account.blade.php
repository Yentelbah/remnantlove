<div id="createModal" class="modal fade" tabindex="-1" aria-labelledby="primary-header-modalLabel" aria-hidden="true">

    <div class="modal-dialog modal-dialog-centered modal-lg">
      <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="modalCenterTitle">Add User Account</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            <form action="{{ route('user.store') }}" method="POST" class="tab-wizard wizard-circle">
                @csrf
                    <input hidden name="member_id" id="leader_id">

                    <div class="mx-auto row d-flex">
                        <!-- Input fields -->
                        <div class="order-2 col-lg-8 col-12 order-lg-1">
                            <div class="row">
                                <div class="mb-3">
                                    <label class="form-label" for="name">Name</label>
                                    <input type="text" class="form-control  @error('name') is-invalid @enderror" name="name" id="acc_user_name">
                                </div>
                            </div>

                            <div class="mb-3 form-group">
                                <label class="form-label" for="church_role">Role</label>
                                    <select name="role" id="acc_user_role" class="form-select @error('church_role') is-invalid @enderror">
                                        <option value="">Select user role</option>
                                        @foreach($churchRoles as $key => $value)
                                        <option value="{{ $value->id }}">{{ $value->name }}</option>
                                        @endforeach
                                    </select>
                                    @error('church_role')
                                    <small class="invalid-feedback" role="alert">
                                        {{ $message }}
                                    </small>
                                    @enderror
                            </div>

                        </div>

                        <!-- Image -->
                        <div class="order-1 col-lg-4 col-12 d-flex justify-content-center order-lg-2">
                            <img src="../assets/images/backgrounds/user.svg" alt="" class="img-fluid" width="100%">
                        </div>

                    </div>

                </section>


                <div class="col-12">
                    <div class="gap-6 mt-4 d-flex align-items-center justify-content-end">
                    <button class="btn btn-primary" type="submit" >Save</button>
                    <button class="btn bg-danger-subtle text-danger" type="button" data-bs-dismiss="modal">Cancel</button>
                    </div>
                </div>
            </form>
          </div>

    </div>
  </div>
</div>
