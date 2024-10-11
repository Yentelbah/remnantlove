<div class="modal fade" id="editModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="modalCenterTitle">Update Task</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">

            <form action="{{ route('tasks.update') }}" method="POST">
                @csrf
                @method('PUT')

                <input hidden type="text" id="ed_task_selectedId" name="selectedId">

                <!-- Task Title -->
                <div class="row">

                    <div class="mb-3 col-md-6">
                        <label for="title" class="form-label">Task Title</label>
                        <input type="text" name="title" id="ed_task_title" class="form-control" required>
                    </div>

                    <div class="mb-3 col-md-6">
                        <label for="category" class="form-label">Category</label>
                        <select name="category_id" class="form-control" id="ed_task_category">
                            @foreach($task_category as $option)
                                <option value="{{ $option->id }}">{{ $option->name }}</option>
                            @endforeach
                        </select>
                    </div>


                    <!-- Priority Selection -->
                    <div class="mb-3 col-md-6">
                        <label for="priority" class="form-label">Task Priority</label>
                        <select name="priority" class="form-control" required id="ed_task_priority">
                            <option value="low">Low</option>
                            <option value="medium" selected>Medium</option>
                            <option value="high">High</option>
                        </select>
                    </div>


                    <div class="mb-3 col-md-6">
                        <div class="mb-3">
                            <label for="due_date" class="form-label">Due Date</label>
                            <input type="date" name="due_date" id="ed_task_due_date" class="form-control" required>
                        </div>
                    </div>

                    <div class="mb-3 col-md-12">
                        <label for="description" class="form-label">Description</label>
                        <textarea placeholder="Task Description" class="form-control @error('description') is-invalid @enderror" name="description" id="ed_task_description" rows="4"></textarea>
                        @error('description')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                </div>
                <div class="col-12">
                    <div class="gap-6 mt-4 d-flex align-items-center justify-content-end">
                        <button type="submit" class="btn btn-primary">Update Task</button>
                        <button class="btn bg-danger-subtle text-danger" type="button" data-bs-dismiss="modal">Cancel</button>
                    </div>
                </div>
            </form>

        </div>
        </div>
    </div>
</div>
