<div id="addMember" class="modal fade" tabindex="-1" aria-labelledby="success-header-modalLabel" aria-hidden="true">

    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
        <div class="text-white modal-header modal-colored-header bg-success">
            <h5 class="text-white modal-title" id="success-header-modalLabel"></h5>
            <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <h5 class="mb-4">Add Member to <span name="name" id="add_group_name"></span></h5>


            <form action="{{ route('group.member') }}" method="POST" id="addMemberForm">
                @csrf

                <p><strong><span name="description" id="add_group_description"></span></strong></p>

                <input hidden type="text" name="GroupId" class="form-control" id="add_group_selectedId">
                <input hidden type="text" name="members" id="members">

                <div class="pb-4 table-responsive">
                    <table class="table table-hover" id="AddToGroupTable">
                        <thead>
                            <tr>

                                <th><input type="checkbox" id="select-all" class="form-check-input select-all-checkbox"></th>
                                <th>#</th>
                                <th>Name</th>
                                <th>Phone Number</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($members as $key => $value)
                            <tr>
                                <td><input class="form-check-input" type="checkbox" value="{{ $value->id }}"></td>
                                <td>{{ $key + 1 }}</td>
                                <td>{{ $value->member_number }}</td>
                                <td>{{ $value->name }}</td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="5"><p>No members found</p></td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                <div class="col-12">
                    <div class="gap-6 mt-4 d-flex align-items-center justify-content-end">
                      <button class="btn btn-success" type="submit" id="saveBtn">Save</button>
                      <button class="btn bg-danger-subtle text-danger" type="button" data-bs-dismiss="modal">Cancel</button>
                    </div>
                </div>
              </form>
            </div>

            </div>
          </div>
          <!-- /.modal-content -->
        </div>
