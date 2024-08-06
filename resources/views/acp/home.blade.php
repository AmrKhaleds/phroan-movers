@extends('acp.layout.app')

@section('title')
    @lang('back.dashborad')
@endsection
@section('content')

    <!-- start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-flex align-items-center justify-content-between">
                <h4 class="mb-0">@lang('back.dashborad')</h4>

                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item active">@lang('back.dashborad')</li>
                    </ol>
                </div>

            </div>
        </div>

    </div>
    <!-- end page title -->

    <!-- start page title -->
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="float-end">
                        <div class="dropdown">
                            <a class="dropdown-toggle text-reset" href="#" id="dropdownMenuButton5"
                               data-bs-toggle="dropdown" aria-haspopup="true"
                               aria-expanded="false">
                                <span class="fw-semibold">@lang('back.report_period') : </span> <span
                                        class="text-muted">@lang('back.'.$period)<i
                                            class="mdi mdi-chevron-down ms-1"></i></span>
                            </a>

                            <div class="dropdown-menu dropdown-menu-end" aria-labelledby="dropdownMenuButton5">
                                <a class="dropdown-item" href="{{route('home','period=today')}}">@lang('back.today')</a>
                                <a class="dropdown-item" href="{{route('home','period=week')}}">@lang('back.week')</a>
                                <a class="dropdown-item" href="{{route('home','period=month')}}">@lang('back.month')</a>
                                <a class="dropdown-item" href="{{route('home','period=year')}}">@lang('back.year')</a>
                            </div>
                        </div>
                    </div>

                </div> <!-- end card-body-->
            </div> <!-- end card-->

        </div>

    </div>
    <!-- end page title -->



    <div class="row">
        <div class="col-md-6 col-xl-3">
            <div class="card">
                <div class="card-body">
                    <div class="float-end mt-2">
                        <i class="uil-money-withdraw text-warning" style="font-size: 55px"></i>
                    </div>
                    <div>
                        <h4 class="mb-1 mt-1"> @lang('back.L.E') <span
                                    data-plugin="counterup">{{$bookings->whereNotNull('vehicle_id')->sum(['price']) - $expenses}}</span>
                        </h4>
                        <p class="text-muted mb-0">@lang('back.total_revenue')</p>
                    </div>

                </div>
            </div>
        </div> <!-- end col-->

        <div class="col-md-6 col-xl-3">
            <div class="card">
                <div class="card-body">
                    <div class="float-end mt-2">
                        <i class="uil-calendar-alt text-success" style="font-size: 55px"></i>
                    </div>
                    <div>
                        <h4 class="mb-1 mt-1"><span data-plugin="counterup">{{$bookings->count()}}</span></h4>
                        <p class="text-muted mb-0"> @lang('back.bookings') </p>
                    </div>
                </div>
            </div>
        </div> <!-- end col-->

        <div class="col-md-6 col-xl-3">
            <div class="card">
                <div class="card-body">
                    <div class="float-end mt-2">
                        <i class="uil-money-insert text-info" style="font-size: 55px"></i>
                    </div>
                    <div>
                        <h4 class="mb-1 mt-1"> @lang('back.L.E') <span data-plugin="counterup">{{$expenses}}</span></h4>
                        <p class="text-muted mb-0">@lang('back.total_expenses')</p>
                    </div>

                </div>
            </div>
        </div> <!-- end col-->
        <div class="col-md-6 col-xl-3">
            <div class="card">
                <div class="card-body">
                    <div class="float-end mt-2">
                        <i class="uil-car text-pink" style="font-size: 55px"></i>
                    </div>
                    <div>
                        <h4 class="mb-1 mt-1"><span data-plugin="counterup">{{$vehicles->count()}}</span></h4>
                        <p class="text-muted mb-0">@lang('back.vehicle_count')</p>
                    </div>

                </div>
            </div>
        </div> <!-- end col-->

    </div> <!-- end row-->


    <div class="row">

        <div class="col-md-6 col-xl-3">
            <div class="card">
                <div class="card-body">
                    <div class="float-end mt-2">
                        <i class="uil-car text-pink" style="font-size: 55px"></i>
                    </div>
                    <div>
                        <h4 class="mb-1 mt-1"><span data-plugin="counterup">{{$bookings->pluck('vehicle_id')->unique()->filter()->count()}}</span></h4>
                        <p class="text-muted mb-0">@lang('back.cranes_available') </p>
                    </div>
                </div>
            </div>
        </div> <!-- end col-->


        <div class="col-md-6 col-xl-3">

            <div class="card">
                <div class="card-body">
                    <div class="float-end mt-2">
                        <i class="uil-car-wash text-success" style="font-size: 55px"></i>
                    </div>
                    <div>
                        <h4 class="mb-1 mt-1"><span
                                    data-plugin="counterup">{{$vehicles->where('status', 'available')->count()}}</span>
                        </h4>
                        <p class="text-muted mb-0">@lang('back.vehicles') @lang('back.avalble') </p>
                    </div>

                </div>
            </div>
        </div> <!-- end col-->


        <div class="col-md-6 col-xl-3">
            <div class="card">
                <div class="card-body">
                    <div class="float-end mt-2">
                        <i class="uil-car-slash text-warning" style="font-size: 55px"></i>
                    </div>
                    <div>
                        <h4 class="mb-1 mt-1"><span
                                    data-plugin="counterup">{{$vehicles->where('status','damage')->count()}}</span></h4>
                        <p class="text-muted mb-0"> @lang('back.vehicles') @lang('back.damage') </p>
                    </div>
                </div>
            </div>
        </div> <!-- end col-->

        <div class="col-md-6 col-xl-3">
            <div class="card">
                <div class="card-body">
                    <div class="float-end mt-2">
                        <i class="uil-parking-square text-primary" style="font-size: 55px"></i>
                    </div>
                    <div>
                        <h4 class="mb-1 mt-1"><span
                                    data-plugin="counterup">{{$vehicles->where('status','garage')->count()}}</span></h4>
                        <p class="text-muted mb-0">@lang('back.vehicles') @lang('back.garage')</p>
                    </div>

                </div>
            </div>
        </div> <!-- end col-->

    </div> <!-- end row-->

    <div class="row">
        <div class="col-xl-12">
            <div class="card">
                <div class="card-body">

                    <h4 class="card-title mb-4">@lang('back.analytics_orders')</h4>

                    <div class="mt-1">
                        <ul class="list-inline main-chart mb-0">
                            <li class="list-inline-item chart-border-left me-0 border-0">
                                <h3><span data-plugin="counterup">{{array_sum($valuesSeries[0]['data'])}}</span><span
                                            class="text-muted d-inline-block font-size-15 ms-3">@lang('back.canceling')</span>
                                </h3>
                            </li>
                            <li class="list-inline-item chart-border-left me-0">
                                <h3><span data-plugin="counterup">{{array_sum($valuesSeries[1]['data'])}}</span><span
                                            class="text-muted d-inline-block font-size-15 ms-3">@lang('back.sure')</span>
                                </h3>
                            </li>
                            <li class="list-inline-item chart-border-left me-0">
                                <h3><span data-plugin="counterup">{{array_sum($valuesSeries[2]['data'])}}</span><span
                                            class="text-muted d-inline-block font-size-15 ms-3">@lang('back.waiting')</span>
                                </h3>
                            </li>
                        </ul>
                    </div>

                    <div class="mt-3">
                        <div id="column_chart" class="apex-charts" dir="ltr"></div>
                    </div>
                </div> <!-- end card-body-->
            </div> <!-- end card-->
        </div> <!-- end col-->
    </div> <!-- end row-->
    <div class="row">
        <div class="col-xl-6">
            <div class="card">
                <div class="card-body">

                    <h4 class="card-title mb-4">@lang('back.analytics_drivers')</h4>

                    <div class="mt-3">
                        <div id="bar_chart" class="apex-charts" dir="ltr"></div>
                    </div>
                </div> <!-- end card-body-->
            </div> <!-- end card-->
        </div> <!-- end col-->
        <div class="col-xl-6">
            <div class="card">
                <div class="card-body">

                    <h4 class="card-title mb-4">@lang('back.analytics_callCenter')</h4>

                    <div class="mt-3">
                        <div id="bar_chart2" class="apex-charts" dir="ltr"></div>
                    </div>
                </div> <!-- end card-body-->
            </div> <!-- end card-->
        </div> <!-- end col-->
    </div> <!-- end row-->

    <div class="row">

        <div class="col-xl-6">
            <div class="card">
                <div class="card-body">

                    <h4 class="card-title mb-4">@lang('back.analytics_vehicles')</h4>

                    <div id="pie_chart" class="apex-charts" dir="ltr"></div>

                </div> <!-- end card-body-->
            </div> <!-- end card-->
        </div> <!-- end col-->
    </div> <!-- end row-->


@endsection
@section('js')

    <!-- apexcharts -->
    <script src="{{url('acp/libs/apexcharts/apexcharts.min.js')}}"></script>

    <script>

        options = {
            chart: {height: 350, type: "bar", toolbar: {show: !1}},
            plotOptions: {bar: {horizontal: !1, columnWidth: "45%", endingShape: "rounded"}},
            dataLabels: {enabled: !1},
            stroke: {show: !0, width: 2, colors: ["transparent"]},
            series:@json($valuesSeries),
            colors: ["#a90707", "#34c38f", "#bf990c"],
            xaxis: @json($label),
            grid: {borderColor: "#f1f1f1"},
            fill: {opacity: 1},
            tooltip: {
                y: {
                    formatter: function (e) {
                        return "$ " + e + " thousands"
                    }
                }
            }
        };
        (chart = new ApexCharts(document.querySelector("#column_chart"), options)).render();

        options = {
            chart: {height: 350, type: "bar", toolbar: {show: !1}},
            plotOptions: {bar: {horizontal: !0}},
            dataLabels: {enabled: !1},
            series: [{data: @json($booking_drivers)}],
            colors: ["#34c38f"],
            grid: {borderColor: "#f1f1f1"},
            xaxis: {categories: @json($drivers)}
        };
        (chart = new ApexCharts(document.querySelector("#bar_chart"), options)).render();


        options = {
            chart: {height: 350, type: "bar", toolbar: {show: !1}},
            plotOptions: {bar: {horizontal: !0}},
            dataLabels: {enabled: !1},
            series: [{data: @json($booking_callcenters)}],
            colors: ["#34c38f"],
            grid: {borderColor: "#f1f1f1"},
            xaxis: {categories: @json($call_center)}
        };
        (chart = new ApexCharts(document.querySelector("#bar_chart2"), options)).render();


        options = {
            chart: {height: 320, type: "pie"},
            series: [{{$vehicleData->where('status','damage')->count()}}, {{$vehicleData->where('status','available')->count()}}, {{$vehicleData->where('status','garage')->count()}}],
            labels: ["@lang('back.maintenance')", "@lang('back.avalble')", "@lang('back.garage')"],
            colors: ["#f46a6a", "#34c38f", "#f1b44c"],
            legend: {
                show: !0,
                position: "bottom",
                horizontalAlign: "center",
                verticalAlign: "middle",
                floating: !1,
                fontSize: "14px",
                offsetX: 0
            },
            responsive: [{breakpoint: 600, options: {chart: {height: 240}, legend: {show: !1}}}]
        };
        (chart = new ApexCharts(document.querySelector("#pie_chart"), options)).render();


    </script>
    {{--<script src="{{url('acp/js/pages/dashboard.init.js')}}"></script>
--}}
@endsection
