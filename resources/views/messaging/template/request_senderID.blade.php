<div class="modal fade" id="senderIdModal" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="modalCenterTitle">Sender ID <strong><span id="serial_number"></span></strong></h5>
        <button
          type="button"
          class="btn-close"
          data-bs-dismiss="modal"
          aria-label="Close"
        ></button>
      </div>
      <div class="modal-body">
      <form action="{{ route('request.senderID') }}" method="POST">
        @csrf


        @if ($senderID == !null)

          <table class="table table-striped" >
              <tr>
                  <th>Sender ID</th>
                  <th>Status</th>
                  <th style="text-align: center">Action</th>
              </tr>
              <tr>
                  <td>{{$schoolAccount ->senderID}}</td>
                  <td>{{$schoolAccount->status}}</td>

                  <td style="text-align: center"><button type="button" value="{{ $schoolAccount->id }}" class="btn btn-sm" onclick="edit('{{ $schoolAccount->id }}')">
                    <span class="tf-icons bx bx-edit-alt"></span>
                </button>

                <a href="#senderID Status" onclick="check('{{ $schoolAccount->id }}')" class="btn btn-sm">
                  <span class="tf-icons bx bx-show"></span>
              </a>
                
                <script>
                    function edit(schoolId) {
                            $.ajax({  
                              url: '/sms/sender_id/' + schoolId, // Replace with the appropriate route for fetching sent details
                                type: 'GET',
                                success: function(response) {
                                    // Populate input fields with schoolAccount data
                                    $('#sender_name').val(response.senderID);
                                    $('#purpose').val(response.purpose);

                                    $('#editInputs').show();                                  },
                                error: function(xhr) {
                                    console.log(xhr.responseText);
                                }
                            });
                      }

                      function check(schoolId) {
                            $.ajax({  
                              url: '/sms/sender_id/' + schoolId, // Replace with the appropriate route for fetching sent details
                                type: 'POST',
                            });
                      }
                </script>
                
                
                </td>
              </tr>
          </table>

          <div id="editInputs" style="display: none;">

          <div class="mb-3 col">
            <label for="sender_name" class="form-label">Sender Name</label>
            <input name="sender_name" type="text" id="sender_name" class="form-control @error('sender_name') is-invalid @enderror"
                placeholder="Sender ID" value="{{ old('sender_name') }}"
            />
            @error('sender_name')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
        </div>

        <div class="mb-3 col">
          <label for="purpose" class="form-label">Purpose</label>
          <input name="purpose" type="text" id="purpose" class="form-control @error('purpose') is-invalid @enderror"
              placeholder="" value="{{ old('purpose') }}"
          />
          @error('purpose')
          <span class="invalid-feedback" role="alert">
              <strong>{{ $message }}</strong>
          </span>
          @enderror
      </div>

        <div class="justify-content-end d-flex">
            <button type="submit" class="btn btn-primary">Update</button>
        </div>

      </div>
          
      </label>
        
        @else

            <div class="mb-3 col">
                <label for="sender_name" class="form-label">Sender Name</label>
                <input name="sender_name" type="text" id="" class="form-control @error('sender_name') is-invalid @enderror"
                    placeholder="Sender ID" value="{{ old('sender_name') }}"
                />
                @error('sender_name')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>

            <div class="mb-3 col">
              <label for="purpose" class="form-label">Purpose</label>
              <input name="purpose" type="text" id="" class="form-control @error('purpose') is-invalid @enderror"
                  placeholder="" value="{{ old('purpose') }}"
              />
              @error('purpose')
              <span class="invalid-feedback" role="alert">
                  <strong>{{ $message }}</strong>
              </span>
              @enderror
          </div>

            <div class="justify-content-end d-flex">
                <button type="submit" class="btn btn-primary">Save</button>
            </div>

            @endif
        </form>
        </div>
      </div>
  </div>
</div>
