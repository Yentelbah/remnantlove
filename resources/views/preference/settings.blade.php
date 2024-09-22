@extends('layouts.flow')

@section('title')
    <title>Perferences</title>
@endsection

@section('content')

<div class="mb-3 overflow-hidden position-relative">
    <div class="px-3 d-sm-flex align-items-center justify-content-between">
      <h4 class="mb-0 fs-6">Settings</h4>
      <nav aria-label="breadcrumb">
        <ol class="mb-0 breadcrumb">
          <li class="breadcrumb-item">
            <a href="{{ route('dashboard') }}">Dashboard</a>
          </li>
          <li class="breadcrumb-item" aria-current="page">Settings</li>
        </ol>
      </nav>
    </div>
  </div>

    <div class="mb-4 card">
        <div class="card-body">


            <div class="mb-4 d-flex justify-content-between align-items-center">
                <h4 class="mb-0">General Settings</h4>
            </div>

            <div class="">
                <div class="">
                    <div class="mb-4 col-md-12 col-12 mb-md-0">
                        <div class="table-responsive">
                            <table class="table table-striped table-borderless border-bottom">

                                <tbody>
                                <tr>
                                    <td colspan="2"> <b class="setting_th">SMS Notification</b></td>
                                </tr>
                                <tr>
                                    <td class="text-nowrap">Send SMS to all contacts</td>
                                    <td>
                                        <div class="form-check d-flex justify-content-center">
                                            <form id="sms_notificationForm" action="{{ route('update.sms.notification') }}" method="POST">
                                                @csrf
                                                <input type="hidden" name="notification" value="false">

                                                <input name="notification" class="form-check-input" type="checkbox" id="defaultCheck2" onchange="updateBillNotification()" {{ $settings && $settings->sms_notification ? 'checked' : '' }}>
                                            </form>

                                            <script>
                                                function updateBillNotification() {
                                                    var checkbox = document.getElementById('defaultCheck2');
                                                    if (checkbox.checked) {
                                                        checkbox.value = 'true';
                                                    } else {
                                                        checkbox.value = 'false';
                                                    }
                                                    document.getElementById('sms_notificationForm').submit();
                                                }
                                            </script>

                                        </div>
                                    </td>
                                </tr>

                                <tr>
                                    <td class="text-nowrap">Send SMS notification after payments</td>
                                    <td>
                                    <div class="form-check d-flex justify-content-center">
                                        <form id="notificationForm" action="{{ route('update.notification') }}" method="POST">
                                            @csrf
                                            <input type="hidden" name="notification" value="false">

                                            <input name="notification" class="form-check-input" type="checkbox" id="defaultCheck1" onchange="updateNotification()" {{ $settings && $settings->pay_notification ? 'checked' : '' }}>
                                        </form>

                                        <script>
                                            function updateNotification() {
                                                var checkbox = document.getElementById('defaultCheck1');
                                                if (checkbox.checked) {
                                                    checkbox.value = 'true';
                                                } else {
                                                    checkbox.value = 'false';
                                                }
                                                document.getElementById('notificationForm').submit();
                                            }
                                        </script>

                                    </div>
                                    </td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>


@endsection

@section('scripts')

<script>
    $(document).ready(function() {
        // Function to show the corresponding pane based on URL anchor
        function showPaneFromURL() {
            var hash = window.location.hash; // Get the anchor from the URL

            if (hash) {
                $('.list-group-item').removeClass('active'); // Remove active class from all list items
                $('a[href="' + hash + '"]').addClass('active'); // Add active class to the corresponding list item

                $('.tab-pane').removeClass('show active'); // Hide all panes
                $(hash).addClass('show active'); // Show the corresponding pane
            }
        }

        // Call the function on page load
        showPaneFromURL();

        // Capture click event on list group items
        $('.list-group-item').click(function(e) {
            e.preventDefault(); // Prevent default behavior

            var href = $(this).attr('href'); // Get the href attribute value (pane ID)
            history.pushState(null, null, href); // Update the URL without refreshing the page

            $('.list-group-item').removeClass('active');
            $(this).addClass('active');

            $('.tab-pane').removeClass('show active');
            $(href).addClass('show active');
        });
    });
</script>


@endsection
