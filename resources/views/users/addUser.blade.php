<div class="modal fade" id="addContactModal" tabindex="-1" role="dialog" aria-labelledby="addContactModalTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header d-flex align-items-center">
          <h5 class="modal-title">Contact</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <div class="add-contact-box">
            <div class="add-contact-content">
              <form id="addContactModalTitle">
                <div class="row">
                  <div class="col-md-6">
                    <div class="mb-3 contact-name">
                      <input type="text" id="c-name" class="form-control" placeholder="Name" />
                      <span class="validation-text text-danger"></span>
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="mb-3 contact-email">
                      <input type="text" id="c-email" class="form-control" placeholder="Email" />
                      <span class="validation-text text-danger"></span>
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-md-6">
                    <div class="mb-3 contact-occupation">
                      <input type="text" id="c-occupation" class="form-control" placeholder="Occupation" />
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="mb-3 contact-phone">
                      <input type="text" id="c-phone" class="form-control" placeholder="Phone" />
                      <span class="validation-text text-danger"></span>
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-md-12">
                    <div class="mb-3 contact-location">
                      <input type="text" id="c-location" class="form-control" placeholder="Location" />
                    </div>
                  </div>
                </div>
              </form>
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <div class="d-flex gap-6 m-0">
            <button id="btn-add" class="btn btn-success">Add</button>
            <button id="btn-edit" class="btn btn-success">Save</button>
            <button class="btn bg-danger-subtle text-danger" data-bs-dismiss="modal"> Discard
            </button>
          </div>

        </div>
      </div>
    </div>
  </div>
