
@extends('layouts.flow')

@section('title')
    <title>FaithFlow -- Family Members</title>

@endsection

@section('content')

@section('content')

  <div class="mb-3 overflow-hidden position-relative">
    <div class="px-3 d-sm-flex align-items-center justify-content-between">
      <h4 class="mb-0 fs-6">Add Members to {{ $thisFamily->name }} Family</h4>
      <nav aria-label="breadcrumb">
        <ol class="mb-0 breadcrumb">
          <li class="breadcrumb-item">
            <a href="{{ route('dashboard') }}">Dashboard</a>
          </li>
          <li class="breadcrumb-item">
            <a href="{{ route('family.index') }}">Families</a>
          </li>
          <li class="breadcrumb-item" aria-current="page">Add Members</li>
        </ol>
      </nav>
    </div>
  </div>

  <div class="widget-content searchable-container list">

    <div class="row">
        <div class="col-lg-9">
            <div class="card">
                <div class="card-body">
                  <h4 class="pb-2 mb-4 card-title">Church Members Without a Family</h4>
                  <div class="pb-4 table-responsive">


                    <form action="{{ route('family.member') }}" method="POST" id="addMemberForm">
                        @csrf

                        <p><strong><span name="description" id="add_family_description"></span></strong></p>

                        <input hidden type="text" name="FamilyId" class="form-control" value="{{ $thisFamily->id }}">

                        <div class="pb-4 table-responsive">
                            <table class="table table-hover" id="AddToFamilyTable">
                                <thead>
                                    <tr>
                                        <th><input type="checkbox" id="select-all" class="form-check-input select-all-checkbox"></th>
                                        <th>#</th>
                                        <th>Name</th>
                                        <th>Relation</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($members as $key => $value)
                                    <tr>
                                        <td><input class="form-check-input member-checkbox" type="checkbox" value="{{ $value->id }}"></td>
                                        <td>{{ $key + 1 }}</td>
                                        <td>{{ $value->name }}</td>
                                        <td>
                                            <select class="relation-select" style="border:none; background: none;">
                                                <option value="">Select</option>
                                                <option value="Spouse">Spouse</option>
                                                <option value="Child">Child</option>
                                                <option value="Parent">Parent</option>
                                                <option value="Sibling">Sibling</option>
                                                <option value="Other">Other</option>
                                            </select>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>

                        <!-- Hidden inputs to store selected member IDs and relations -->
                        <input type="hidden" name="member_ids">
                        <input type="hidden" name="relations">

                        <div class="col-12">
                            <div class="gap-6 mt-4 d-flex align-items-center justify-content-end">
                                <button class="btn btn-success" type="submit" id="saveBtn">Save</button>
                                <a href="{{ route('family.index') }}" class="btn bg-danger-subtle text-danger" type="button">Cancel</a>
                            </div>
                        </div>
                    </form>


                  </div>
                </div>
              </div>
        </div>
{{-- Family Members --}}
        <div class="col-lg-3">
            <div class="card">
                <div class="card-body">
                  <h4 class="pb-2 mb-4 card-title">Family Members</h4>

                  <ol>
                    @forelse($familyMembers as $key => $value)
                    <li>{{ $value->name }}</li>
                    @empty
                        <p>No family members.</p>
                    @endforelse
                  </ol>

                </div>
              </div>
        </div>
    </div>

@endsection

@section('scripts')

<script>
    $(document).ready(function () {
        var table = $('#AddToFamily').DataTable();

        // Event listener for relation select change
        $(document).on('change', '.relation-select', function() {
            var $checkbox = $(this).closest('tr').find('.member-checkbox');
            var isChecked = $(this).val() !== ""; // Check the checkbox if a relation is selected

            $checkbox.prop('checked', isChecked);
        });

        // Before form submission, remove unchecked members and their relations
        $('#addMemberForm').submit(function(e) {
            var memberIds = [];
            var relations = [];

            $('.member-checkbox:checked').each(function() {
                var memberId = $(this).val();
                var relation = $(this).closest('tr').find('.relation-select').val();

                memberIds.push(memberId);
                relations.push(relation);
            });

            // Replace original arrays with selected member IDs and relations
            $('input[name="member_ids"]').val(JSON.stringify(memberIds));
            $('input[name="relations"]').val(JSON.stringify(relations));
        });
    });
</script>



@endsection
