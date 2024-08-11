
<div class="modal fade" id="sendReminder" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="modalCenterTitle">Send Reminder</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" ></button>
        </div>
        <div class="modal-body">
            <form action="{{ route('reminder.message') }}" method="POST">
                @csrf
                <div class="row">


                    <div class="mb-3">
                        <label for="phone_number" class="form-label">Phone Number</label>
                        <input style="margin-top: 5px;" id="phone_number" type="text" class="form-control" name="phone_number" placeholder="E.g. 0200000000, 0240000000" required>

                        <label style="font-size: 12px; text-align:right; margin-top: 6px; color:darkcyan; margin-bottom: 10px;">Phone numbers should be followed by a comma(,) and space if more than one. </label>

                    </div>
                    <div class="mb-3">
                        <label for="message" class="form-label" >Message</label>
                        <textarea style="margin-top: 5px;" id="message_input" class="form-control" name="message" required></textarea>
                        <label id="charCount" style="font-size: 12px; text-align:right; margin-top: 6px; color:darkcyan;"></label>
                        <input type="hidden" id="numberOfPages" name="numberOfPages">
                    </div>
                </div>
                <div class="d-flex justify-content-end">
                    <button type="submit" class="btn btn-primary">Send</button>
                </div>
            </form>
          </div>
        </div>
    </div>
  </div>


<script>
    document.addEventListener('DOMContentLoaded', function() {
        var maxLength = 160; // Set your desired maximum character count
        var messageTextarea = document.getElementById('message_input');
        var charCountElement = document.getElementById('charCount');
        var numberOfPagesInput = document.getElementById('numberOfPages');

        messageTextarea.addEventListener('input', function() {
            var currentLength = messageTextarea.value.length;
            var pages = Math.ceil(currentLength / maxLength);

            if (pages === 1) {
                charCountElement.textContent = '1 page';
            } else {
                charCountElement.textContent = pages + ' pages';
            }

            numberOfPagesInput.value = pages; // Update the hidden input with the number of pages
        });
    });
</script>
