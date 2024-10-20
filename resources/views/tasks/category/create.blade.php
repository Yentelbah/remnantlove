      <!-- Modal -->
      <div class="modal fade" id="createCatModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="modalCenterTitle">Add New Task Category</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="{{ route('tasks.category.store') }}" method="POST">
                    @csrf
                    <div class="row">
                        <div class="mb-3 col">
                            <label for="name" class="form-label">Category name</label>
                            <input type="text" name="name" class="form-control" required>
                        </div>
                    </div>

                    <div class="d-flex justify-content-end">
                        <button type="submit" class="btn btn-primary">Create Category</button>
                    </div>

                    </div>
                </form>
            </div>
        </div>
      </div>
