@extends('layouts.admin_panel.main')
@section('content')
    @push('style')
        <!-- INTERNAL Fullcalendar css-->
        <link href="{{asset('admin_panel/assets/plugins/fullcalendar/fullcalendar.css')}}" rel="stylesheet">
    @endpush
    @if (session('success'))
        <div class="alert alert-success" role="alert">
            <button class="close" data-dismiss="alert" aria-hidden="true">×</button>
            {{ session('success') }}
        </div>
    @endif
    <!-- Row -->
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <div id="calendar"></div>
                </div>
            </div>
        </div>
    </div>


    <!-- Modal -->
    <div class="modal fade" id="eventModal" tabindex="-1" aria-labelledby="eventModalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">@lang('plans.event_details')</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form method="POST" action="{{ route('calender.delete') }}">
                    @csrf
                    <div class="modal-body">
                        <div class="form-group">
                            <label class="form-group">@lang('plans.start_at') :</label> <input class="form-control" disabled type="text" id="eventStartTime" >
                        </div>
                        <div class="form-group">
                            <label class="form-group">@lang('plans.end_at') :</label> <input class="form-control" disabled type="text" id="eventEndTime" >
                        </div>
                        <div class="form-group">
                            <label class="form-group">@lang('plans.description') :</label> <input class="form-control" disabled type="text" id="eventdiscription" >
                        </div>
                        <input value="" type="hidden" id="eventId" name="id">

                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-danger" id="deleteEventButton">Delete</button>
                        <button type="button" class="btn btn-light" data-dismiss="modal">Close</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    @push('js')
        <!-- INTERNAL Full-calendar js-->
        <script src="{{asset('admin_panel/assets/plugins/fullcalendar/fullcalendar.min.js')}}"></script>
        <script src="{{asset('admin_panel/assets/js/app-calendar-events.js')}}"></script>
        <script>
            (() => {
                "use strict";

                function e(e, t, r) {
                    return t in e ? Object.defineProperty(e, t, {
                        value: r,
                        enumerable: true,
                        configurable: true,
                        writable: true
                    }) : e[t] = r;
                }

                var t = moment().format("YYYY"),
                    r = moment().format("MM"),
                    n = {
                        id: 1,
                        events: [
                                @foreach ($events as $event)
                            {
                                start: '{{\Carbon\Carbon::parse($event->start_at)->format('Y-m-d\TH:i:s')}}',
                                end: '{{\Carbon\Carbon::parse($event->end_at)->format('Y-m-d\TH:i:s')}}',
                                title: '{{$event->description}}',
                                eventId: '{{$event->id}}',
                                backgroundColor: "{{$event->color}}",
                            },
                            @endforeach
                        ]
                    };

                document.addEventListener("DOMContentLoaded", () => {
                    var r = document.getElementById("calendar");
                    var s = new FullCalendar.Calendar(r, {
                        headerToolbar: {
                            left: "prev,next today",
                            center: "title",
                            right: "dayGridMonth,timeGridWeek,timeGridDay"
                        },
                        navLinks: true,
                        businessHours: true,
                        editable: true,
                        selectable: true,
                        selectMirror: true,
                        droppable: true,
                        eventClick: function (info) {
                            // set the modal content with the event data
                            document.getElementById('eventStartTime').value = info.event.start.toLocaleTimeString();
                            document.getElementById('eventEndTime').value = info.event.end.toLocaleTimeString();
                            document.getElementById('eventdiscription').value = info.event.title;
                            document.getElementById('eventId').value = info.event.extendedProps.eventId;
                            // show the modal
                            $('#eventModal').modal('show');
                        },
                        eventSources: [n]
                    });

                    s.render();

                });
            })();
        </script>
    @endpush

@endsection
