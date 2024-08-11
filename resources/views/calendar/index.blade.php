@extends('layouts.flow')

@section('title')
    <title>FaithFlow -- Calendar</title>

@endsection

@section('content')

  <div class="mb-3 overflow-hidden position-relative">
    <div class="px-3 d-sm-flex align-items-center justify-content-between">
      <h4 class="mb-0 fs-6">Calendar</h4>
      <nav aria-label="breadcrumb">
        <ol class="mb-0 breadcrumb">
          <li class="breadcrumb-item">
            <a href="{{ route('dashboard') }}">Dashboard</a>
          </li>
          <li class="breadcrumb-item" aria-current="page">Calendar</li>
        </ol>
      </nav>
    </div>
  </div>

<div class="card">
    <div class="card-body calender-sidebar app-calendar">
      <div id="calendar"></div>
    </div>
  </div>

  <!-- BEGIN MODAL -->
  <div class="modal fade" id="eventModal" tabindex="-1" aria-labelledby="eventModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="eventModalLabel">
            Add / Edit Event
          </h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">



        <form action="{{ route('event.update') }}" method="POST">

            @csrf
            @method('PUT')

            <input type="hidden" id="selectedId" name="selectedId">

            <div class="row">
                <div class="mt-6 col-md-12">
                <div>
                    <label class="form-label">Event Title</label>
                    <input id="event-title" name="title" type="text" class="form-control" />
                </div>
                </div>

                <div class="mt-6 col-md-12">
                    <div>
                    <label class="form-label">Event Description</label>
                    <input id="description" name="description" type="text" class="form-control  @error('description') is-invalid @enderror" />
                    @error('description')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                    </div>
                </div>

                <div class="mt-6 col-md-12">
                <div>
                    <label class="form-label">Event Color</label>
                </div>
                <div class="d-flex">
                    <div class="n-chk">
                    <div class="form-check form-check-primary form-check-inline">
                        <input class="form-check-input" type="radio" name="event_level" value="Danger" id="modalDanger" />
                        <label class="form-check-label" for="modalDanger">Danger</label>
                    </div>
                    </div>

                    <div class="n-chk">
                    <div class="form-check form-check-warning form-check-inline">
                        <input class="form-check-input" type="radio" name="event_level" value="Success" id="modalSuccess" />
                        <label class="form-check-label" for="modalSuccess">Success</label>
                    </div>
                    </div>
                    <div class="n-chk">
                    <div class="form-check form-check-success form-check-inline">
                        <input class="form-check-input" type="radio" name="event_level" value="Primary" id="modalPrimary" />
                        <label class="form-check-label" for="modalPrimary">Primary</label>
                    </div>
                    </div>
                    <div class="n-chk">
                    <div class="form-check form-check-danger form-check-inline">
                        <input class="form-check-input" type="radio" name="event_level" value="Warning" id="modalWarning" />
                        <label class="form-check-label" for="modalWarning">Warning</label>
                    </div>
                    </div>
                </div>
                </div>

                <div class="mt-6 col-md-6">
                <div>
                    <label class="form-label">Enter Start Date</label>
                    <input id="event-start-date" type="datetime-local" name="start_datetime" class="form-control @error('start_datetime') is-invalid @enderror" />
                </div>
                </div>

                <div class="mt-6 col-md-6">
                <div>
                    <label class="form-label">Enter End Date</label>
                    <input id="event-end-date" type="datetime-local"  name="end_datetime" class="form-control @error('end_datetime') is-invalid @enderror" />
                    @error('end_datetime')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                </div>
            </div>

        </div>
        <div class="modal-footer">
          <button type="button" class="btn bg-danger-subtle text-danger" data-bs-dismiss="modal">
            Close
          </button>
          <button type="submit" class="btn btn-success btn-update-event" data-fc-event-public-id="">
            Update changes
          </button>
          <button type="submit" class="btn btn-primary btn-add-event">
            Add Event
          </button>
        </form>
        </div>
      </div>
    </div>
  </div>

@endsection

@section('scripts')

    <script src="../assets/libs/fullcalendar/index.global.min.js"></script>

    <script>
        document.addEventListener("DOMContentLoaded", function () {
            var newDate = new Date();

            function getDynamicMonth() {
                let getMonthValue = newDate.getMonth();
                let _getUpdatedMonthValue = getMonthValue + 1;
                return _getUpdatedMonthValue < 10 ? `0${_getUpdatedMonthValue}` : `${_getUpdatedMonthValue}`;
            }

            var getModalTitleEl = document.querySelector("#event-title");
            var getModalDescriptionEl = document.querySelector("#description");
            var getModalStartDateEl = document.querySelector("#event-start-date");
            var getModalEndDateEl = document.querySelector("#event-end-date");
            var getModalAddBtnEl = document.querySelector(".btn-add-event");
            var getModalUpdateBtnEl = document.querySelector(".btn-update-event");
            var getModalSelectedIdEl = document.querySelector("#selectedId");

            var calendarsEvents = {
                Danger: "danger",
                Success: "success",
                Primary: "primary",
                Warning: "warning",
            };

            var calendarEl = document.querySelector("#calendar");

            var checkWidowWidth = function () {
                return window.innerWidth <= 1199;
            };

            var calendarHeaderToolbar = {
                left: "prev next addEventButton",
                center: "title",
                right: "dayGridMonth,timeGridWeek,timeGridDay",
            };

            var calendarEventsList = [
                @foreach($events as $event)
                {
                    eventID: '{{ $event->id }}',
                    publicId: '{{ $event->id }}',
                    title: '{{ $event->title }}',
                    description: '{{ $event->description }}',
                    start: '{{ $event->start_datetime }}',
                    end: '{{ $event->end_datetime }}',
                    extendedProps: { calendar: "{{ $event->event_level}}" },
                },
                @endforeach

                @foreach($projects as $event)
                {
                    title: '{{ $event->name }}',
                    description: '{{ $event->description }}',
                    start: '{{ $event->start_date }}',
                    end: '{{ $event->end_date }}',
                    extendedProps: { calendar: "Primary" },
                },
                @endforeach
            ];


            var calendarSelect = function (info) {
                getModalAddBtnEl.style.display = "block";
                getModalUpdateBtnEl.style.display = "none";

                myModal.show();
                getModalStartDateEl.value = info.startStr;
                getModalEndDateEl.value = info.endStr;
            };

            var calendarAddEvent = function () {
                var currentDate = new Date();
                var dd = String(currentDate.getDate()).padStart(2, "0");
                var mm = String(currentDate.getMonth() + 1).padStart(2, "0");
                var yyyy = currentDate.getFullYear();
                var combineDate = `${yyyy}-${mm}-${dd}T00:00:00`;

                myModal.show();
                getModalStartDateEl.value = combineDate;

            };

            var calendarEventClick = function (info) {
                var eventObj = info.event;

                if (eventObj.url) {
                    window.open(eventObj.url);
                    info.jsEvent.preventDefault();
                } else {
                    var getModalEventId = eventObj._def.extendedProps.eventID;
                    var getModalEventDescription = eventObj._def.extendedProps.description;
                    var getModalEventLevel = eventObj._def.extendedProps["calendar"];
                    var getModalCheckedRadioBtnEl = document.querySelector(`input[value="${getModalEventLevel}"]`);

                    getModalTitleEl.value = eventObj.title;
                    getModalDescriptionEl.value = getModalEventDescription;
                    getModalStartDateEl.value = eventObj.start.toISOString().slice(0, 16);
                    getModalEndDateEl.value = eventObj.end ? eventObj.end.toISOString().slice(0, 16) : "";

                    if (getModalCheckedRadioBtnEl) {
                        getModalCheckedRadioBtnEl.checked = true;
                    }

                    getModalUpdateBtnEl.setAttribute("data-fc-event-public-id", getModalEventId);
                    getModalSelectedIdEl.value = getModalEventId;

                    getModalAddBtnEl.style.display = "none";
                    getModalUpdateBtnEl.style.display = "block";
                    myModal.show();
                }
            };

            var calendar = new FullCalendar.Calendar(calendarEl, {
                selectable: true,
                height: window.innerWidth <= 1199 ? 900 : 1052,
                initialView: window.innerWidth <= 1199 ? "listWeek" : "dayGridMonth",
                initialDate: `${newDate.getFullYear()}-${(newDate.getMonth() + 1).toString().padStart(2, '0')}-07`,
                headerToolbar: {
                    left: "prev next addEventButton",
                    center: "title",
                    right: "dayGridMonth,timeGridWeek,timeGridDay",
                },
                events: calendarEventsList,
                select: calendarSelect,
                customButtons: {
                    addEventButton: {
                        text: "Add Event",
                        click: calendarAddEvent,
                    },
                },
                eventClassNames: function ({ event: calendarEvent }) {
                    return ["event-fc-color fc-bg-" + calendarsEvents[calendarEvent._def.extendedProps.calendar]];
                },
                eventClick: calendarEventClick,

                windowResize: function () {
                    if (window.innerWidth <= 1199) {
                        calendar.changeView("listWeek");
                        calendar.setOption("height", 900);
                    } else {
                        calendar.changeView("dayGridMonth");
                        calendar.setOption("height", 1052);
                    }
                },
            });


            calendar.render();
                var myModal = new bootstrap.Modal(document.getElementById("eventModal"));

                document.getElementById("eventModal").addEventListener("hidden.bs.modal", function () {
                    getModalTitleEl.value = "";
                    getModalDescriptionEl.value = "";
                    getModalStartDateEl.value = "";
                    getModalEndDateEl.value = "";
                    var getModalIfCheckedRadioBtnEl = document.querySelector('input[name="event_level"]:checked');
                    if (getModalIfCheckedRadioBtnEl !== null) {
                        getModalIfCheckedRadioBtnEl.checked = false;
                    }
                });
        });
    </script>

@endsection
