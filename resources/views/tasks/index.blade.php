@extends('layouts.flow')

@section('title')
    <title>FaithFlow -- Tasks</title>
@endsection

@section('content')

<div class="mb-3 overflow-hidden position-relative">
    <div class="px-3 d-sm-flex align-items-center justify-content-between">
      <h4 class="mb-0 fs-6">Tasks</h4>
      <nav aria-label="breadcrumb">
        <ol class="mb-0 breadcrumb">
          <li class="breadcrumb-item">
            <a href="{{ route('dashboard') }}">Dashboard</a>
          </li>
          <li class="breadcrumb-item" aria-current="page">Tasks</li>
        </ol>
      </nav>
    </div>
</div>

  <div class="flex-wrap gap-6 action-btn layout-top-spacing mb-7 d-flex align-items-center justify-content-between">
    <a data-bs-toggle="modal" data-bs-target="#createModal" id="#modalCenter" class="px-4 mb-1 btn bg-success-subtle text-success fs-4 ms-auto me-1">Add Task</a>
  </div>

  <div class="scrumboard" id="cancel-row">
    <div class="pb-3 layout-spacing">
      <div data-simplebar>
        <div class="task-list-section">

          <div class="task-list-container" data-action="sorting">
            <div class="connect-sorting connect-sorting-inprogress">
              <div class="task-container-header">
                <h6 class="mb-0 item-head fs-4 fw-semibold">Not Started</h6>
                <div class="gap-2 hstack">
                  <div class="dropdown">
                    <a class="dropdown-toggle" href="javascript:void(0)" role="button" id="dropdownMenuLink-1" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                      <i class="ti ti-dots-vertical text-dark"></i>
                    </a>
                    <div class="dropdown-menu dropdown-menu-end" aria-labelledby="dropdownMenuLink-1">
                      <a class="dropdown-item list-edit" href="javascript:void(0);">Manage Tasks</a>
                      <a class="dropdown-item list-clear-all" href="javascript:void(0);">Hide All</a>
                    </div>
                  </div>
                </div>
              </div>
              <div class="connect-sorting-content">
                @if($tasks->has('to_do'))
                    @foreach($tasks['to_do'] as $value)

                        <div class="card img-task">
                        <div class="card-body">
                            <div class="task-header">
                            <div>
                                <h4 data-item-title="Lets do some task on pd">{{ $value->title }}</h4>
                            </div>
                            <div class="dropdown">
                                <a class="dropdown-toggle" href="javascript:void(0)" role="button" id="dropdownMenuLink-1" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                                <i class="ti ti-dots-vertical text-dark"></i>
                                </a>
                                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="dropdownMenuLink-1">
                                    <a class="gap-1 cursor-pointer dropdown-item d-flex align-items-center" href="{{ route('task.view', $value->id) }}"><i class="ti ti-eye fs-5"></i>View</a>

                                    <a class="gap-1 cursor-pointer dropdown-item kanban-item-edit d-flex align-items-center" href="javascript:void(0);" value="{{ $value->id }}" data-bs-toggle="modal" data-bs-target="#editModal" id="#modalCenter" onclick="openEditModal('{{ $value->id }}')"><i class="ti ti-pencil fs-5"></i>Edit</a>

                                    <a class="gap-1 cursor-pointer dropdown-item d-flex align-items-center" href="javascript:void(0);"  value="{{ $value->id }}" data-bs-toggle="modal" data-bs-target="#deleteModal" id="#modalCenter" onclick="openDeleteModal('{{ $value->id }}')">
                                    <i class="ti ti-trash fs-5"></i>Delete
                                </a>

                                </div>
                            </div>
                            </div>
                            <div class="task-content">
                            <p class="mb-0">
                                {{ ucfirst($value->description) }}
                            </p>
                            </div>
                            <div class="task-body">
                            <div class="task-bottom">
                                <div class="tb-section-1">
                                <span class="gap-2 hstack fs-2" data-item-date="{{ \Carbon\Carbon::parse($value->due_date)->format('d M') }}">
                                    <i class="ti ti-calendar fs-5"></i> {{ \Carbon\Carbon::parse($value->due_date)->format('d M') }}
                                </span>
                                </div>
                                <div class="tb-section-2">
                                <span class="badge @if($value->priority == 'high') text-bg-danger @elseif($value->priority == 'medium') text-bg-warning @else text-bg-success @endif fs-1"> {{ ucfirst($value->category->name) }} </span>
                                </div>
                            </div>
                            </div>
                        </div>
                        </div>

                    @endforeach
                @else
                    <p>No pending tasks.</p>
                @endif

              </div>
            </div>
          </div>

          <div class="task-list-container" data-action="sorting">
            <div class="connect-sorting connect-sorting-pending">
              <div class="task-container-header">
                <h6 class="mb-0 item-head fs-4 fw-semibold">In Progress</h6>
                <div class="gap-2 hstack">
                  <div class="dropdown">
                    <a class="dropdown-toggle" href="javascript:void(0)" role="button" id="dropdownMenuLink-1" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                      <i class="ti ti-dots-vertical text-dark"></i>
                    </a>
                    <div class="dropdown-menu dropdown-menu-end" aria-labelledby="dropdownMenuLink-1">
                      <a class="dropdown-item list-edit" href="javascript:void(0);">Manage Tasks</a>
                      <a class="dropdown-item list-clear-all" href="javascript:void(0);">Clear All</a>
                    </div>
                  </div>
                </div>
              </div>
              <div class="connect-sorting-content" data-sortable="true">
                @if($tasks->has('in_progress'))
                    @foreach($tasks['in_progress'] as $value)

                        <div class="card img-task">
                        <div class="card-body">
                            <div class="task-header">
                            <div>
                                <h4 data-item-title="Lets do some task on pd">{{ $value->title }}</h4>
                            </div>
                            <div class="dropdown">
                                <a class="dropdown-toggle" href="javascript:void(0)" role="button" id="dropdownMenuLink-1" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                                <i class="ti ti-dots-vertical text-dark"></i>
                                </a>
                                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="dropdownMenuLink-1">
                                    <a class="gap-1 cursor-pointer dropdown-item d-flex align-items-center" href="{{ route('task.view', $value->id) }}">
                                        <i class="ti ti-eye fs-5"></i>View
                                    </a>

                                    <a class="gap-1 cursor-pointer dropdown-item kanban-item-edit d-flex align-items-center" href="javascript:void(0);" value="{{ $value->id }}" data-bs-toggle="modal" data-bs-target="#editModal" id="#modalCenter" onclick="openEditModal('{{ $value->id }}')"><i class="ti ti-pencil fs-5"></i>Edit</a>

                                    <a class="gap-1 cursor-pointer dropdown-item d-flex align-items-center" href="javascript:void(0);"  value="{{ $value->id }}" data-bs-toggle="modal" data-bs-target="#deleteModal" id="#modalCenter" onclick="openDeleteModal('{{ $value->id }}')">
                                        <i class="ti ti-trash fs-5"></i>Delete
                                    </a>

                                </div>
                            </div>
                            </div>
                            <div class="task-content">
                            <p class="mb-0">
                                {{ ucfirst($value->description) }}
                            </p>
                            </div>
                            <div class="task-body">
                            <div class="task-bottom">
                                <div class="tb-section-1">
                                <span class="gap-2 hstack fs-2" data-item-date="{{ \Carbon\Carbon::parse($value->due_date)->format('d M') }}">
                                    <i class="ti ti-calendar fs-5"></i> {{ \Carbon\Carbon::parse($value->due_date)->format('d M') }}
                                </span>
                                </div>
                                <div class="tb-section-2">
                                <span class="badge @if($value->priority == 'high') text-bg-danger @elseif($value->priority == 'medium') text-bg-warning @else text-bg-success @endif fs-1"> {{ ucfirst($value->category->name) }} </span>
                                </div>
                            </div>
                            </div>
                        </div>
                        </div>

                    @endforeach
                @else
                    <p>No tasks in progress.</p>
                @endif
              </div>
            </div>
          </div>

          <div class="task-list-container" data-action="sorting">
            <div class="connect-sorting connect-sorting-done">
              <div class="task-container-header">
                <h6 class="mb-0 item-head fs-4 fw-semibold">Completed</h6>
                <div class="gap-2 hstack">
                  <div class="dropdown">
                    <a class="dropdown-toggle" href="javascript:void(0)" role="button" id="dropdownMenuLink-1" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                      <i class="ti ti-dots-vertical text-dark"></i>
                    </a>
                    <div class="dropdown-menu dropdown-menu-end" aria-labelledby="dropdownMenuLink-1">
                      <a class="dropdown-item list-edit" href="javascript:void(0);">Manage Tasks</a>
                      <a class="dropdown-item list-clear-all" href="javascript:void(0);">Clear All</a>
                    </div>
                  </div>
                </div>
              </div>
              <div class="connect-sorting-content" data-sortable="true">
                @if($tasks->has('completed'))
                    @foreach($tasks['completed'] as $value)

                        <div class="card img-task">
                        <div class="card-body">
                            <div class="task-header">
                            <div>
                                <h4 data-item-title="Lets do some task on pd">{{ $value->title }}</h4>
                            </div>
                            <div class="dropdown">
                                <a class="dropdown-toggle" href="javascript:void(0)" role="button" id="dropdownMenuLink-1" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                                <i class="ti ti-dots-vertical text-dark"></i>
                                </a>
                                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="dropdownMenuLink-1">
                                    <a class="gap-1 cursor-pointer dropdown-item d-flex align-items-center" href="{{ route('task.view', $value->id) }}">
                                        <i class="ti ti-eye fs-5"></i>View
                                    </a>

                                    <a class="gap-1 cursor-pointer dropdown-item kanban-item-edit d-flex align-items-center" href="javascript:void(0);" value="{{ $value->id }}" data-bs-toggle="modal" data-bs-target="#editModal" id="#modalCenter" onclick="openEditModal('{{ $value->id }}')"><i class="ti ti-pencil fs-5"></i>Edit</a>

                                    <a class="gap-1 cursor-pointer dropdown-item d-flex align-items-center" href="javascript:void(0);"  value="{{ $value->id }}" data-bs-toggle="modal" data-bs-target="#deleteModal" id="#modalCenter" onclick="openDeleteModal('{{ $value->id }}')">
                                        <i class="ti ti-trash fs-5"></i>Delete
                                    </a>

                                </div>
                            </div>
                            </div>
                            <div class="task-content">
                            <p class="mb-0">
                                {{ ucfirst($value->description) }}
                            </p>
                            </div>
                            <div class="task-body">
                            <div class="task-bottom">
                                <div class="tb-section-1">
                                <span class="gap-2 hstack fs-2" data-item-date="{{ \Carbon\Carbon::parse($value->due_date)->format('d M') }}">
                                    <i class="ti ti-calendar fs-5"></i> {{ \Carbon\Carbon::parse($value->due_date)->format('d M') }}
                                </span>
                                </div>
                                <div class="tb-section-2">
                                <span class="badge @if($value->priority == 'high') text-bg-danger @elseif($value->priority == 'medium') text-bg-warning @else text-bg-success @endif fs-1"> {{ ucfirst($value->category->name) }} </span>
                                </div>
                            </div>
                            </div>
                        </div>
                        </div>

                    @endforeach
                @else
                    <p>No completed tasks.</p>
                @endif
              </div>
            </div>
          </div>

          <div data-item="item-todo" class="task-list-container" data-action="sorting">
            <div class="connect-sorting connect-sorting-todo">
              <div class="task-container-header">
                <h6 class="mb-0 item-head fs-4 fw-semibold" data-item-title="Todo">Task Categories</h6>
                <div class="gap-2 hstack">
                  <div class="add-kanban-title">
                    <a class="gap-1 d-flex align-items-center justify-content-center lh-sm" data-bs-toggle="modal" data-bs-placement="top" data-bs-title="Add Task Category" data-bs-target="#createCatModal" id="#modalCenter" >
                      <i class="ti ti-plus text-dark"></i>
                    </a>
                  </div>

                </div>
              </div>

                <div data-draggable="true" class="card img-task">
                    <div class="card-body">

                      <div class="task-content">
                        <h4 class="mb-3 card-title">Categories</h4>
                        @foreach ($category as $value)
                        <ul class="list-group">
                          <li class="list-group-item d-flex align-items-center">
                            <i class="ti ti-box fs-4 me-2 text-primary"></i>
                            {{ $value->name }}
                            <span class="badge bg-light-primary text-primary ms-auto">
                                <div class="dropdown">
                                    <a class="dropdown-toggle" href="javascript:void(0)" role="button" id="dropdownMenuLink-1" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                                      {{-- <i class="ti ti-dots-vertical text-dark"></i> --}}
                                    </a>
                                    <div class="dropdown-menu dropdown-menu-end" aria-labelledby="dropdownMenuLink-1">
                                      <a class="gap-1 cursor-pointer dropdown-item d-flex align-items-center" href="javascript:void(0);" value="{{ $value->id }}" data-bs-toggle="modal" data-bs-target="#editCatModal" id="#modalCenter" onclick="openCatEditModal('{{ $value->id }}')">
                                        <i class="ti ti-pencil fs-5"></i>Edit
                                      </a>
                                      <a class="gap-1 cursor-pointer dropdown-item d-flex align-items-center" href="javascript:void(0);" value="{{ $value->id }}" data-bs-toggle="modal" data-bs-target="#deleteCatModal" id="#modalCenter" onclick="openCatDeleteModal('{{ $value->id }}')">
                                        <i class="ti ti-trash fs-5"></i>Delete
                                      </a>
                                    </div>
                                  </div>
                            </span>
                          </li>
                        </ul>
                        @endforeach

                      </div>
                      <div class="task-body">
                        <div class="task-bottom">
                            <div class="d-flex justify-content-center">
                                {{ $category->links() }}
                            </div>
                            {{-- <nav aria-label="Page navigation example">
                                <ul class="pagination">
                                  <li class="page-item">
                                    <a class="page-link link" href="javascript:void(0)" aria-label="Previous">
                                      <span aria-hidden="true">
                                        <i class="ti ti-chevrons-left fs-4"></i>
                                      </span>
                                    </a>
                                  </li>
                                  <li class="page-item">
                                    <a class="page-link link" href="javascript:void(0)">1</a>
                                  </li>
                                  <li class="page-item">
                                    <a class="page-link link" href="javascript:void(0)">2</a>
                                  </li>
                                  <li class="page-item">
                                    <a class="page-link link" href="javascript:void(0)">3</a>
                                  </li>
                                  <li class="page-item">
                                    <a class="page-link link" href="javascript:void(0)" aria-label="Next">
                                      <span aria-hidden="true">
                                        <i class="ti ti-chevrons-right fs-4"></i>
                                      </span>
                                    </a>
                                  </li>
                                </ul>
                            </nav> --}}

                        </div>
                      </div>
                    </div>
                </div>
            </div>
          </div>

      </div>
      </div>
    </div>
  </div>

  @include('tasks.category.create')
  @include('tasks.category.delete')
  @include('tasks.category.edit')
  @include('tasks.create')
  @include('tasks.edit')
  @include('tasks.delete')

@endsection

@section('scripts')

    <script>
        function openCatEditModal(id) {
            $.ajax({
                url: '/task_categories/' + id, // Replace with the appropriate route for fetching department details
                type: 'GET',
                success: function(response) {
                    // Update the modal content with the fetched department details
                    $('#ed_cat_name').val(response.name);
                    $('#ed_cat_selectedId').val(response.id);
                },
                error: function(xhr) {
                    // Handle error case
                    console.log(xhr);
                }
            });
        }

        function openCatDeleteModal(id) {
            $.ajax({
                url: '/task_categories/' + id, // Replace with the appropriate route for fetching department details
                type: 'GET',
                success: function(response) {
                    // Update the modal content with the fetched department details
                    $('#del_cat_name').text(response.name);
                    $('#del_cat_selectedId').val(response.id);
                },
                error: function(xhr) {
                    // Handle error case
                    console.log(xhr);
                }
            });
        }
    </script>

    <script>

        $(document).ready(function() {
            $('#set_reminder').change(function() {
                if ($(this).is(':checked')) {
                    // Show the time input when checkbox is checked
                    $('#reminder_time_group').show();
                } else {
                    // Hide the time input when checkbox is unchecked
                    $('#reminder_time_group').hide();
                }
            });
        });


        function openEditModal(id) {
            $.ajax({
                url: '/tasks/' + id, // Replace with the appropriate route for fetching department details
                type: 'GET',
                success: function(response) {
                    // Update the modal content with the fetched department details
                    $('#ed_task_title').val(response.title);
                    $('#ed_task_category').val(response.category_id);
                    $('#ed_task_priority').val(response.priority);
                    $('#ed_task_due_date').val(response.due_date);
                    $('#ed_task_description').val(response.description);
                    $('#ed_task_selectedId').val(response.id);
                },
                error: function(xhr) {
                    // Handle error case
                    console.log(xhr);
                }
            });
        }

        function openDeleteModal(id) {
            $.ajax({
                url: '/tasks/' + id, // Replace with the appropriate route for fetching department details
                type: 'GET',
                success: function(response) {
                    // Update the modal content with the fetched department details
                    $('#del_name').text(response.name);
                    $('#del_selectedId').val(response.id);
                },
                error: function(xhr) {
                    // Handle error case
                    console.log(xhr);
                }
            });
        }
    </script>

    <script>
        $("#facilities").DataTable({
            dom: "Bfrtip",
            buttons: ["copy", "csv", "excel", "pdf", "print",],
        });
        $(
            ".buttons-copy, .buttons-csv, .buttons-print, .buttons-pdf, .buttons-excel"
        ).addClass("btn btn-primary btn-sm");
    </script>

    <script src="../assets/js/apps/kanban.js"></script>

    <script>
        // Toggle between template and custom task steps
        document.getElementById('template_task').addEventListener('click', function () {
            document.getElementById('template-selection').style.display = 'block';
            document.getElementById('custom-steps').style.display = 'none';
        });

        document.getElementById('custom_task').addEventListener('click', function () {
            document.getElementById('template-selection').style.display = 'none';
            document.getElementById('custom-steps').style.display = 'block';
        });

        // Add more steps dynamically
        document.getElementById('add-step').addEventListener('click', function () {
            let stepCount = document.querySelectorAll('#steps-wrapper .step-input').length + 1;

            let stepHtml = `
                <div class="mb-2 step-input">
                    <input type="text" name="steps[]" class="form-control" placeholder="Step ${stepCount}">
                    <input hidden type="number" name="levels[]" class="mt-2 form-control" placeholder="Level ${stepCount}" min="1" value="${stepCount}">
                </div>
            `;

            document.getElementById('steps-wrapper').insertAdjacentHTML('beforeend', stepHtml);
        });
    </script>

@endsection
