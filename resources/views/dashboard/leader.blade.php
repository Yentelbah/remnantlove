@extends('layouts.flow')

@section('title')
  <title>FaithFlow -- Leader Dashboard</title>
@endsection

@section('content')

<div class="row">
    <div class="col-lg-12 col-xl-12">
      <div class="card">
        <div class="card-body position-relative">
          <div>
            <h3 class="mb-3 card-title ">{{ $greeting[0] }},</h3>
            <h3 class="mb-3 card-title ">{{ Auth()->user()->name }},</h3>
            <p class="pb-0 mb-0 card-subtitle fs-3 col-lg-7 col-md-7 col-sm-7">{{ $greeting[1] }}</p>
          </div>
          <div class="school-img d-none d-sm-block">
            <img src="../assets/images/backgrounds/school.png" class="img-fluid" alt="spike-img" />
          </div>

          <div class="text-center d-sm-none d-block">
            <img src="../assets/images/backgrounds/school.png" class="img-fluid" alt="spike-img" />
          </div>
        </div>
      </div>
    </div>

    {{-- Reminders  --}}

    <div class="col-lg-6">
        <div class="card">
            <div class="card-body">

            <div class="d-flex justify-content-between align-items-center">
                <h4 class="mb-0 card-title">Reminders</h4>
                {{-- <div class="dropdown">
                <button id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false" class="px-1 shadow-none rounded-circle btn-transparent btn-sm btn">
                    <i class="ti ti-dots-vertical fs-7 d-block"></i>
                </button>
                <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="dropdownMenuButton1">
                    <li>
                    <a class="dropdown-item" href="{{ route('member.index') }}">Members</a>
                    </li>


                </ul>
                </div> --}}
            </div>

            </div>
        </div>
    </div>

    {{-- Tasks --}}
    <div class="col-lg-6">
        <div class="card">
            <div class="card-body">

            <div class="d-flex justify-content-between align-items-center">
                <h4 class="mb-0 card-title">Pending tasks</h4>
                <div class="dropdown">
                <button id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false" class="px-1 shadow-none rounded-circle btn-transparent btn-sm btn">
                    <i class="ti ti-dots-vertical fs-7 d-block"></i>
                </button>
                <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="dropdownMenuButton1">
                    <li>
                    <a class="dropdown-item" href="{{ route('tasks.index') }}">View all</a>
                    </li>
                </ul>
                </div>
            </div>

        </div>
        </div>
    </div>


    {{-- REVENUE AND EXPENSES --}}

    {{-- ATTENDANCE --}}

</div>

@endsection

@section('scripts')

<script>
    document.addEventListener('DOMContentLoaded', function() {
        var calendarEl = document.getElementById('calendar');
        var calendar = new FullCalendar.Calendar(calendarEl, {
            initialView: 'dayGridMonth',
            events: [
                // Here you'll need to dynamically populate events from your database
                // You can fetch events from your Laravel backend using AJAX or directly pass them as JSON
                @foreach($events as $event)
                    {
                        title: '{{ $event->title }}',
                        start: '{{ $event->start_datetime }}',
                        end: '{{ $event->end_datetime }}',
                        color: 'orange',
                        // Add more event properties as needed
                    },
                @endforeach

                @foreach($projects as $event)
                    {
                        title: '{{ $event->name }}',
                        start: '{{ $event->start_date }}',
                        end: '{{ $event->end_date }}',
                        color: 'blue',
                        // Add more event properties as needed
                    },
                @endforeach
            ]
        });
        calendar.render();
    });
</script>


@endsection



