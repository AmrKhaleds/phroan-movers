@extends('acp.layout.app')

@section('title')
    @lang('back.calender')
@endsection
@section('css')

    <link href="{{url('acp/libs/@fullcalendar/core/main.min.css')}}" rel="stylesheet" type="text/css"/>
    <link href="{{url('acp/libs/@fullcalendar/daygrid/main.min.css')}}" rel="stylesheet" type="text/css"/>
    <link href="{{url('acp/libs/@fullcalendar/bootstrap/main.min.css')}}" rel="stylesheet" type="text/css"/>
    <link href="{{url('acp/libs/@fullcalendar/timegrid/main.min.css')}}" rel="stylesheet" type="text/css"/>
    <style>
        .external-event {
            cursor: auto !important;
        }

        .fc-content {
            text-align: center;
            display: flex;
            float: right;
        }
        .fc-day-grid-event {
            height: 20px;
        }
    </style>
@endsection
@section('content')

    <!-- start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-flex align-items-center justify-content-between">
                <h4 class="mb-0">@lang('back.calender')</h4>

                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item active">@lang('back.calender')</li>
                        <li class="breadcrumb-item ">@lang('back.dashborad')</li>
                    </ol>
                </div>

            </div>
        </div>

    </div>
    <!-- end page title -->



    <div class="row">
        <div class="col-12">

            <div class="row">
                <div class="col-xl-3 col-lg-4">
                    <div class="card">
                        <div class="card-body">

                            <div id="external-events" class="mt-2">
                                <br>
                                <p class="text-muted">@lang('back.map_calender')</p>
                                <div class="external-event fc-event bg-success"
                                     data-class="bg-success">
                                    <i class="mdi mdi-checkbox-blank-circle font-size-11 me-2"></i>@lang('back.completed')
                                </div>
                                <div class="external-event fc-event bg-primary"
                                     data-class="bg-success">
                                    <i class="mdi mdi-checkbox-blank-circle font-size-11 me-2"></i>@lang('back.primary')
                                </div>
                                <div class="external-event fc-event bg-warning"
                                     data-class="bg-warning">
                                    <i class="mdi mdi-checkbox-blank-circle font-size-11 me-2"></i>@lang('back.warning')
                                </div>
                                {{--<div class="external-event fc-event bg-danger" data-class="bg-danger">
                                    <i class="mdi mdi-checkbox-blank-circle font-size-11 me-2"></i>@lang('back.danger')
                                </div>--}}
                                <div class="external-event fc-event bg-dark" data-class="bg-dark">
                                    <i class="mdi mdi-checkbox-blank-circle font-size-11 me-2"></i>@lang('back.dark')
                                </div>
                            </div>

                            <div class="row justify-content-center mt-5">
                                <div class="col-lg-12 col-sm-6">
                                    <img src="{{url('acp/images/undraw-calendar.svg')}}" alt=""
                                         class="img-fluid d-block">
                                </div>
                            </div>

                        </div>
                    </div>
                </div>

                <div class="col-xl-9 col-lg-8">
                    <div class="card">
                        <div class="card-body">
                            <div id="external-events" class="mt-2">
                            </div>

                            <div id="calendar"></div>
                        </div>
                    </div>
                </div> <!-- end col -->

            </div>


        </div>
    </div>

@endsection
@section('js')

    <!-- plugin js -->
    <script src="{{url('acp/libs/moment/min/moment.min.js')}}"></script>
    <script src="{{url('acp/libs/jquery-ui-dist/jquery-ui.min.js')}}"></script>
    <script src="{{url('acp/libs/@fullcalendar/core/main.min.js')}}"></script>
    <script src="{{url('acp/libs/@fullcalendar/bootstrap/main.min.js')}}"></script>
    <script src="{{url('acp/libs/@fullcalendar/daygrid/main.min.js')}}"></script>
    <script src="{{url('acp/libs/@fullcalendar/timegrid/main.min.js')}}"></script>
    <script src="{{url('acp/libs/@fullcalendar/interaction/main.min.js')}}"></script>
    <script src='https://cdn.jsdelivr.net/npm/fullcalendar@3.10.5/dist/locale-all.min.js'></script>


    <script>

        document.addEventListener('DOMContentLoaded', function () {
            var initialLocaleCode = 'ar';
            var calendarEl = document.getElementById('calendar');
            var calendar = new FullCalendar.Calendar(calendarEl, {
                plugins: ['dayGrid', 'timeGrid'],// plugins to load
                header: {
                    left: 'dayGridMonth,timeGridWeek,timeGridDay',
                    center: 'title',
                    right: 'custom2 prevYear,prev,next,nextYear'
                },
                locale: initialLocaleCode,
                themeSystem: "timeGrid",
                events: '{{route('get.ajax.calendar')}}',
                selectable: true,
                selectHelper: true,
                editable: true,
                eventLimit: true // allow "more" link when too many events

            });

            calendar.render();
        });
        $(document).ready(function () {
            $('.fc-dayGridMonth-button').text('شهر');
            $('.fc-timeGridWeek-button').text('اسبوع');
            $('.fc-timeGridDay-button').text('يوم');
        });


    </script>
    <!-- Calendar init -->
    {{--    <script src="{{url('acp/js/pages/calendar.init.js')}}"></script>--}}

@endsection