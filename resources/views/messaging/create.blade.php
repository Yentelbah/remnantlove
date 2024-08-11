<div class="modal fade" id="singleSMSModal" tabindex="-1" role="dialog"daria-labelledby="Edit Group" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="text-white modal-header modal-colored-header bg-primary">
                <h5 class="text-white modal-title" id="primary-header-modalLabel"></h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
        <div class="modal-body">
            <h5 class="mb-4">Send SMS</h5>
            <form action="{{ route('sms.sendSingle') }}" method="POST">
                @csrf

                <input hidden type="text" name="sender" value="{{ Auth()->user()->name }}">

                <div class="row">
                    <div class="mb-3">
                        <label for="subject"  class="form-label">Subject</label>
                        <input type="text" class="form-control" name="subject" placeholder="Subject" required>
                    </div>
                    <div class="mb-3">

                        <label for="phone_number" class="form-label">Phone Number</label>
                        <input style="margin-top: 5px;" id="phone_number" type="text" class="form-control" name="phone_number" placeholder="E.g. 0200000000, 0240000000" required>

                        <label style="font-size: 12px; text-align:right; margin-top: 6px; color:rgb(137, 189, 238); margin-bottom: 8px;">Phone numbers should be followed by a comma(,) and space if more than one. </label>

                    </div>
                    <div class="">
                        <label for="message" class="form-label" >Message</label>
                        <textarea style="margin-top: 5px;" id="message_input" class="form-control" name="message" required></textarea>
                        <label id="charCount" style="font-size: 12px; text-align:right; margin-top: 6px; color:darkcyan;"></label>
                        <input type="hidden" id="numberOfPages" name="numberOfPages">
                    </div>
                </div>
                <div class="col-12">
                    <div class="gap-6 d-flex align-items-center justify-content-end">
                        <button class="btn btn-primary" type="submit" >Send</button>
                        <button class="btn bg-danger-subtle text-danger" type="button" data-bs-dismiss="modal">Cancel</button>
                    </div>
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
