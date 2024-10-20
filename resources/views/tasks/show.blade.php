@extends('layouts.flow')

@section('title')
     <title>FaithFLow -- Task Details</title>
@endsection


@section('content')

<div class="mb-3 overflow-hidden position-relative">
    <div class="px-3 d-sm-flex align-items-center justify-content-between">
      <h4 class="mb-0 fs-6">Task</h4>
      <nav aria-label="breadcrumb">
        <ol class="mb-0 breadcrumb">
          <li class="breadcrumb-item">
            <a href="{{ route('dashboard') }}">Dashboard</a>
          </li>
          <li class="breadcrumb-item">
            <a href="{{ route('tasks.index') }}">Tasks</a>
          </li>
          <li class="breadcrumb-item" aria-current="page">Details</li>
        </ol>
      </nav>
    </div>
  </div>

  <div class="mx-10 tab-content" id="pills-tabContent">
    <div class="tab-pane fade show active" id="pills-profile" role="tabpanel" aria-labelledby="pills-profile-tab" tabindex="0">
      <div class="row">
        <div class="col-lg-4">
          <div class="card ">
            <div class="pt-4 pb-1 card-body">

              <h4 class="mb-2 fs-6">{{ $task->title }}</h4>
                <span class="border  badge fs-2 mb-9 fw-bold rounded-pill  @if($task->priority == 'high') bg-danger-subtle text-danger border-danger  @elseif($task->priority == 'medium') bg-warning-subtle text-warning border-warning @else bg-primary-subtle text-success border-success @endif ">{{ $task->priority }} priority</span>
                @if($task->status == 'completed')
                    <span class="badge bg-success">Completed</span>
                @elseif($task->status == 'in_progress')
                    <span class="badge bg-warning">In Progress</span>
                @else
                    <span class="badge bg-primary">Not Started</span>
                @endif

              <div class="py-9 border-top">

                <div class="mt-1 mb-4 border-bottom">
                  <div class="pb-2 mb-3 border-bottom">
                    <h6>{{ $task->description }}</h6>
                  </div>

                  <ul>

                    <li class="py-2">
                      <p class="mb-0 fw-normal text-dark">
                        Category:
                        <span class="fw-light ms-1">{{ $task->category->name }}</span>
                      </p>
                    </li>

                    <li class="py-2">
                      <p class="mb-0 fw-normal text-dark">
                        Due Date:
                        <span class="fw-light ms-1">{{ formatShortDates($task->due_date) }}</span>
                      </p>
                    </li>

                    <li class="py-2">
                      <p class="mb-0 fw-normal text-dark">
                        Assigner:
                        <span class="fw-light ms-1">{{ $task->creator->name }}</span>
                      </p>
                    </li>

                    <li class="py-2">
                      <p class="mb-0 fw-normal text-dark">
                        Assignee: <span class="fw-light ms-1">{{ $task->assignees->pluck('name')->join(', ') }}</span>
                        @if($task->created_by == Auth()->user()->id)
                        <a href="javascript:void(0);" class="mt-1 mb-1 cursor-pointer justify-content-center me-2 d-flex align-items-center badge rounded-pill fw-light ms-1 bg-primary-subtle text-primary border-primary" data-bs-toggle="modal" data-bs-target="#assignModal" id="#modalCenter" ><iconify-icon icon="solar:user-plus-bold-duotone" class="fs-6"></iconify-icon> Add more</a>

                        <a href="javascript:void(0);" class="cursor-pointer justify-content-center me-2 d-flex align-items-center badge rounded-pill fw-light ms-1 bg-danger-subtle text-danger border-danger" data-bs-toggle="modal" data-bs-target="#removeModal" id="#modalCenter"><iconify-icon icon="solar:user-minus-rounded-bold-duotone" class="fs-6"></iconify-icon> Remove assignee</a>
                        @endif

                      </p>
                    </li>

                  </ul>
                </div>

                <div class="mb-1 d-flex justify-content-between align-items-center">
                    <span>Progress</span>
                    <span>{{ number_format($completionPercentage, 1) }}% Completed</span>
                </div>
                <div class="mb-1 progress bg-primary-subtle">
                    <!-- Inject progress percentage dynamically into the width -->
                    <div class="progress-bar text-bg-primary" role="progressbar" style="width:{{ number_format($completionPercentage, 1) }}%;"
                    aria-valuenow="{{ number_format($completionPercentage, 1) }}%" aria-valuemin="0" aria-valuemax="100">
                    </div>
                </div>
                <span>{{ $completedSteps }} completed out of {{ $totalSteps }} steps</span>


                <div class="mt-4 row">
                    <div class="col-12">
                        <a href="javascript:void(0);" class="cursor-pointer justify-content-center me-2 d-flex align-items-center btn btn-sm btn-success fw-light ms-1 " data-bs-toggle="modal" data-bs-target="#commentModal" id="#modalCenter"><iconify-icon icon="solar:chat-line-line-duotone" class="fs-6 me-2"></iconify-icon> Comment on task</a>

                        @include('tasks.comments.add')

                        <div class="gap-6 mt-4 d-flex align-items-center justify-content-center">
                            <button type="submit" class="btn btn-sm btn-primary w-30" value="{{ $task->id }}" data-bs-toggle="modal" data-bs-target="#stepModal" id="#modalCenter" onclick="openEditModal('{{ $task->id }}')"><i class="ti ti-plus fs-5 me-1"></i> Step</button>
                            <button type="submit" class="btn btn-sm btn-primary w-30" value="{{ $task->id }}" data-bs-toggle="modal" data-bs-target="#editModal" id="#modalCenter" onclick="openEditModal('{{ $task->id }}')"><i class="ti ti-edit fs-5 me-1"></i> Edit</button>
                            <button type="submit" class="btn btn-sm btn-danger w-30" value="{{ $task->id }}" data-bs-toggle="modal" data-bs-target="#deleteModal" id="#modalCenter" onclick="openDeleteModal('{{ $task->id }}')"><i class="ti ti-trash fs-5 me-1"></i> Delete</button>
                        </div>
                    </div>
                </div>

              </div>

            </div>
          </div>
        </div>

        <div class="col-lg-8">
            <ul class="nav nav-tabs" id="myTab" role="tablist">
              <li class="nav-item me-2" role="presentation">
                <button class="nav-link active" id="steps" data-bs-toggle="tab" data-bs-target="#home" type="button" role="tab" aria-controls="home" aria-selected="true">
                  Task Steps
                </button>
              </li>
            </ul>

            <div class="mt-3 card">
              <div class="card-body">
                <div class="tab-content" id="myTabContent">
                  <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="steps">
                    {{-- <div class="pb-3 mb-4 border-bottom">
                      <h4 class="mb-0 card-title">Task Steps</h4>
                    </div> --}}
                    <div class="pt-3 overflow-x-auto table-responsive">
                      <table class="table align-middle text-nowrap">

                        <tbody class="border-top">
                            @foreach ($task->steps as $key => $step)
                          <tr>
                            <td>
                              <p class="mb-0 text-dark fw-normal">
                                {{ $step->description }}
                              </p>
                            </td>
                            <td>
                                <input type="checkbox" class="step-completed-checkbox" data-step-id="{{ $step->id }}"
                                       {{ $step->is_completed ? 'checked' : '' }}>
                            </td>
                            <td>
                                <div class="dropdown">
                                    <button id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false" class="px-1 shadow-none rounded-circle btn-transparent btn-sm btn">
                                      <i class="ti ti-dots-vertical fs-4 d-block"></i>
                                    </button>
                                    <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="dropdownMenuButton1">
                                        <li>
                                            <a href="javascript:void(0)" class="dropdown-item" value="{{ $step->id }}" data-bs-toggle="modal" data-bs-target="#editStepModal" id="#modalCenter" onclick="openEditStepModal('{{ $step->id }}')">Edit</a>
                                        </li>

                                        <li>
                                            <a href="javascript:void(0)" class="dropdown-item" value="{{ $step->id }}" data-bs-toggle="modal" data-bs-target="#deleteStepModal" id="#modalCenter" onclick="openDeleteStepModal('{{ $step->id }}')">Delete</a>
                                        </li>

                                    </ul>
                                </div>
                            </td>
                          </tr>
                          @endforeach

                        </tbody>
                      </table>
                    </div>

                  </div>

                  <div class="tab-pane fade" id="comments" role="tabpanel" aria-labelledby="comment">
                    <div class="pb-3 mb-4 border-bottom">
                      <h4 class="mb-0 card-title">Comments</h4>
                    </div>
                    <div class="pt-3 overflow-x-auto table-responsive">
                      <table class="table align-middle text-nowrap">

                        <tbody class="border-top">
                            @foreach ($task->comments as $key => $comment)
                          <tr>
                            <td>{{ formatShortDates($comment->created_at) }}</td>
                            <td>
                              <p class="mb-0 text-dark fw-normal">
                                {{ $comment->comment }}
                              </p>
                            </td>
                            <td>
                                <div class="dropdown">
                                    <button id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false" class="px-1 shadow-none rounded-circle btn-transparent btn-sm btn">
                                      <i class="ti ti-dots-vertical fs-4 d-block"></i>
                                    </button>
                                    <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="dropdownMenuButton1">
                                        <li>
                                            <a href="javascript:void(0)" class="dropdown-item" value="{{ $comment->id }}" data-bs-toggle="modal" data-bs-target="#editStepModal" id="#modalCenter" onclick="openEditStepModal('{{ $comment->id }}')">Edit</a>
                                        </li>

                                        <li>
                                            <a href="javascript:void(0)" class="dropdown-item" value="{{ $comment->id }}" data-bs-toggle="modal" data-bs-target="#deleteStepModal" id="#modalCenter" onclick="openDeleteStepModal('{{ $comment->id }}')">Delete</a>
                                        </li>

                                    </ul>
                                </div>
                            </td>
                          </tr>
                          @endforeach

                        </tbody>
                      </table>
                    </div>

                  </div>

                </div>
              </div>
            </div>

            <div class="ps-4 pe-4" >
                <div class="card-body">
                    <div class="gap-3 mb-2 d-flex align-items-center">
                        <h5 class="mb-0">Comments</h5>
                        <span class="px-6 py-8 rounded badge bg-success-subtle text-success fs-4 fw-semibold">{{ $countComments }}</span>
                    </div>

                  <div class="position-relative">
                    @foreach ($task->comments as $key => $comment)

                    <div class="p-3 mb-2 rounded-4 text-bg-light">
                      <div class="gap-3 d-flex align-items-center justify-content-between">
                        <div class="gap-3 d-flex align-items-center">
                            {{-- <img src="../assets/images/profile/user-2.jpg" alt="spike-img" class="rounded-circle" width="33" height="33"> --}}
                            <h6 class="mb-0 fs-4">{{ $comment->user->name }}</h6>
                            <span class="p-1 text-bg-muted rounded-circle d-inline-block"></span>
                            <span>{{ formatShortDates($comment->created_at) }}</span>
                        </div>
                        <div class="dropdown">
                            <button id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false" class="px-1 shadow-none rounded-circle btn-transparent btn-sm btn">
                              <i class="ti ti-dots-vertical fs-4 d-block"></i>
                            </button>
                            <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="dropdownMenuButton1">
                                <li>
                                    <a href="javascript:void(0)" class="dropdown-item" value="{{ $comment->id }}" data-bs-toggle="modal" data-bs-target="#editCommentModal" id="#modalCenter" onclick="openEditCommentModal('{{ $comment->id }}')">Edit</a>
                                </li>

                                <li>
                                    <a href="javascript:void(0)" class="dropdown-item" value="{{ $comment->id }}" data-bs-toggle="modal" data-bs-target="#deleteCommentModal" id="#modalCenter" onclick="openDeleteCommentModal('{{ $comment->id }}')">Delete</a>
                                </li>

                            </ul>
                        </div>

                      </div>
                      <p class="pt-2 my-0">{{ $comment->comment }}
                      </p>

                    </div>
                    @endforeach

                  </div>
                </div>
            </div>


            @include('tasks.assign')
            @include('tasks.remove')
            @include('tasks.edit')
            @include('tasks.delete')
            @include('tasks.steps.add')
            @include('tasks.steps.edit')
            @include('tasks.steps.delete')
            @include('tasks.comments.edit')
            @include('tasks.comments.delete')



        </div>
      </div>

    </div>
  </div>


@endsection

@section('scripts')

    <script>
        function openEditStepModal(id) {
            $.ajax({
                url: '/step/' + id, // Replace with the appropriate route for fetching department details
                type: 'GET',
                success: function(response) {
                    // Update the modal content with the fetched department details
                    $('#ed_step_description').val(response.description);
                    $('#ed_step_selectedId').val(response.id);

                },
                error: function(xhr) {
                    // Handle error case
                    console.log(xhr);
                }
            });
        }

        function openDeleteStepModal(id) {
            $.ajax({
                url: '/step/' + id, // Replace with the appropriate route for fetching department details
                type: 'GET',
                success: function(response) {
                    // Update the modal content with the fetched department details
                    $('#del_step_selectedId').val(response.id);
                },
                error: function(xhr) {
                    // Handle error case
                    console.log(xhr);
                }
            });
        }
    </script>

    <script>
        function openEditCommentModal(id) {
            $.ajax({
                url: '/comment/' + id, // Replace with the appropriate route for fetching department details
                type: 'GET',
                success: function(response) {
                    // Update the modal content with the fetched department details
                    $('#ed_comment').val(response.comment);
                    $('#ed_comment_selectedId').val(response.id);

                },
                error: function(xhr) {
                    // Handle error case
                    console.log(xhr);
                }
            });
        }

        function openDeleteCommentModal(id) {
            $.ajax({
                url: '/comment/' + id, // Replace with the appropriate route for fetching department details
                type: 'GET',
                success: function(response) {
                    // Update the modal content with the fetched department details
                    $('#del_comment_selectedId').val(response.id);
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

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            // Event listener for step completion checkbox
            document.querySelectorAll('.step-completed-checkbox').forEach(function (checkbox) {
                checkbox.addEventListener('change', function () {
                    var stepId = this.dataset.stepId;
                    var isCompleted = this.checked ? 1 : 0;

                    // Make an AJAX request to update the step's completion status
                    fetch(`/steps/${stepId}/update-status`, {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': '{{ csrf_token() }}' // Include CSRF token
                        },
                        body: JSON.stringify({
                            is_completed: isCompleted
                        })
                    })
                    .then(response => {
                        if (response.ok) {
                            // If the request is successful, refresh the page to show updates
                            location.reload(); // Refresh the page
                        } else {
                            return response.json().then(errorData => {
                                throw new Error(errorData.message);
                            });
                        }
                    })
                    .catch(error => {
                        console.error('Error:', error);
                    });
                });
            });
        });
    </script>

    <script>

        // Add more steps dynamically
        document.getElementById('add-step').addEventListener('click', function () {
            let stepCount = document.querySelectorAll('#steps-wrapper .step-input').length + 1;

            let stepHtml = `
                <div class="mb-2 step-input">
                    <input type="text" name="steps[]" class="form-control" placeholder="Step ${stepCount}">
                </div>
            `;

            document.getElementById('steps-wrapper').insertAdjacentHTML('beforeend', stepHtml);
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

@endsection
