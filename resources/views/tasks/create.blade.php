      <!-- Modal -->
      <div class="modal fade" id="createModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="modalCenterTitle">Add New Task</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">

                <form action="{{ route('tasks.store') }}" method="POST">
                    @csrf

                    <!-- Task Title -->
                    <div class="row">
                        <!-- Task Template or Custom -->
                        <div class="mb-4 col-md-6">
                            <label for="task_type" class="form-label">Select Task Type</label>
                            <div>
                                <input type="radio" id="template_task" name="task_type" value="template" checked>
                                <label for="template_task">Create From Template</label>

                                <input type="radio" id="custom_task" name="task_type" value="custom">
                                <label for="custom_task">Create New Task</label>
                            </div>
                        </div>

                        <!-- Task Templates Dropdown (Shown if template is selected) -->
                        <div class="mb-2 col" id="template-selection">
                            <label for="template_id" class="form-label">Select a Template</label>
                            <select name="template_id" class="form-control">
                                @foreach($templates as $template)
                                    <option value="{{ $template->id }}">{{ $template->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3 col-md-12">
                            <label for="title" class="form-label">Task Title</label>
                            <input type="text" name="title" class="form-control" required>
                        </div>

                        <div class="mb-3 col-md-6">
                            <label for="category" class="form-label">Category</label>
                            <select name="category_id" class="form-control">
                                @foreach($task_category as $option)
                                    <option value="{{ $option->id }}">{{ $option->name }}</option>
                                @endforeach
                            </select>
                        </div>


                        <!-- Priority Selection -->
                        <div class="mb-3 col-md-6">
                            <label for="priority" class="form-label">Task Priority</label>
                            <select name="priority" class="form-control" required>
                                <option value="low">Low</option>
                                <option value="medium" selected>Medium</option>
                                <option value="high">High</option>
                            </select>
                        </div>

                        <div class="mb-3 col-md-6">
                            <label for="description" class="form-label">Description</label>
                            <textarea placeholder="Task Description" class="form-control @error('description') is-invalid @enderror" name="description" id="description" rows="4"></textarea>
                            @error('description')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3 col-md-6">
                            <label for="assignees" class="form-label">Assign Users</label>
                            <select class="form-select" id="assignees" name="assignees[]" multiple required>
                                @foreach($users as $user) <!-- Assuming you have a $users variable passed to the view -->
                                    <option value="{{ $user->id }}">{{ $user->name }}</option>
                                @endforeach
                            </select>
                            <small>Hold down the Ctrl or Command button for multiple selection.</small>
                        </div>

                        <div class="mb-3 col-md-6">
                            <div class="mb-3">
                                <label for="due_date" class="form-label">Due Date</label>
                                <input type="date" name="due_date" class="form-control" required>
                            </div>

                            <!-- Set Reminder Checkbox -->
                            <div class="mb-3">
                                <input class="form-check-input primary" type="checkbox" value="set" id="set_reminder" name="set_reminder">
                                <label class="form-check-label text-dark fs-3" for="set_reminder">Set a reminder</label>
                            </div>

                        </div>

                        <!-- Reminder Time Input (Initially Hidden) -->
                        <div class="mb-3 col-md-6" id="reminder_time_group" style="display: none;">
                            <label for="reminder_time" class="form-label">Reminder Time</label>
                            <input type="datetime-local" name="reminder_time" id="reminder_time" class="form-control">
                        </div>

                    </div>

                    <!-- Custom Steps (Hidden if template is selected) -->
                    <div id="custom-steps" class="mb-3 col" style="display: none;">
                        <label for="steps[]" class="form-label">Task Steps</label>
                        <div id="steps-wrapper">
                            <!-- First step and level -->
                            <div class="mb-2 step-input">
                                <input type="text" name="steps[]" class="form-control" placeholder="Step 1">
                                <input hidden type="number" name="levels[]" class="mt-2 form-control" placeholder="Level 1" min="1" value="1">
                            </div>
                        </div>
                        <button type="button" id="add-step" class="mt-2 btn btn-sm btn-secondary">Add Step</button>
                    </div>


                    <!-- Submit Button -->
                    <div class="col-12">
                        <div class="gap-6 mt-4 d-flex align-items-center justify-content-end">
                            <button type="submit" class="btn btn-primary">Create Task</button>
                            <button class="btn bg-danger-subtle text-danger" type="button" data-bs-dismiss="modal">Cancel</button>
                        </div>
                    </div>
                </form>
            </div>


            </div>
        </div>
      </div>
      </div>
