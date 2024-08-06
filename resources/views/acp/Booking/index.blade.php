@extends('acp.layout.app')

@section('title')
    @lang('back.bookings')
@endsection

@section('css')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>
    <!-- DataTables -->
    <link href="{{url('acp/libs/datatables.net-bs4/css/dataTables.bootstrap4.min.css')}}" rel="stylesheet"
          type="text/css"/>
    <link href="{{url('acp/libs/datatables.net-buttons-bs4/css/buttons.bootstrap4.min.css" ')}}rel="
          stylesheet" type="text/css" />

    <!-- Responsive datatable examples -->
    <link href="{{url('acp/libs/datatables.net-responsive-bs4/css/responsive.bootstrap4.min.css')}}" rel="stylesheet"
          type="text/css"/>

    <style type="text/css">
        .ajax-load {
            background: #e1e1e1;
            padding: 10px 0px;
            width: 100%;
        }
        td {
            width: 87px;
        }
    </style>
@endsection

@section('content')

    <!-- start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-flex align-items-center justify-content-between">
                <h4 class="mb-0">@lang('back.bookings')</h4>

                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item active">@lang('back.bookings')</li>
                        <li class="breadcrumb-item ">@lang('back.dashborad')</li>
                    </ol>
                </div>

            </div>
        </div>
    </div>
    <!-- end page title -->

    <!-- start page title -->
    <div class="row">

        <div class="col-12">
            <div class="d-flex flex-wrap gap-3 align-items-center justify-content-center ">
                <div class="btn-group btn-group-lg" role="group" aria-label="Basic example">
                    @foreach($date_array as $kdate_array => $date)
                        <a href="{{route('bookings.index')}}?date={{$date[1]}}" class="btn btn-{{$date[1] == \Carbon\Carbon::now()->format('Y-m') || $date[1] == $request->date  ? '' : 'outline-'}}warning">{{$date[0]}}</a>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
    <!-- end page title -->

    <div class="row mb-2">
        <div class="col-md-6">

                <a href="{{route('bookings.create')}}" class="btn btn-warning waves-effect waves-light">
                    @lang('back.create') @lang('back.bookings') <i class="uil uil-plus-square ms-2"></i>
                </a>


        </div>

        {{--<div class="col-md-6">
            <form action="?" method="get">
                <div class="form-inline float-md-end mb-3">
                    <div class="search-box ms-2">
                        <div class="position-relative">
                            <input type="text" class="form-control rounded border-0 search" name="search"
                                   value="{{$request->search}}" placeholder="Search...">
                            <i class="mdi mdi-magnify search-icon"></i>
                        </div>
                    </div>

                </div>
            </form>
        </div>

--}}
    </div>
    <!-- end row -->

    <div class="row" id="post-data">
        @if(Session::has('msg'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <i class="uil uil-check me-2"></i>
                {!! session('msg') !!}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">

                </button>
            </div>

        @endif
        <div class="card">
            <div class="card-body">
                <!-- start page title -->
                <div class="row">
                    <div class="col-12">
                        <div class="d-flex align-items-center justify-content-center gap-2  text-center">
                            <button type="button" class="btn btn-primary waves-effect waves-light">
                                @lang('back.sure') <i class="uil uil-arrow-right ms-2"></i>
                            </button>
                            <button type="button" class="btn btn-danger waves-effect waves-light">
                                <i class="uil uil-times me-2"></i> @lang('back.canceled')
                            </button>
                            <button type="button" class="btn btn-info waves-effect waves-light">
                                <i class="fas fa-random me-2"></i> @lang('back.assigned')
                            </button>
                            <button type="button" class="btn btn-success waves-effect waves-light">
                                <i class="uil uil-check me-2"></i> @lang('back.finished')
                            </button>
                            <button type="button" class="btn btn-warning waves-effect waves-light">
                                <i class="uil uil-exclamation-triangle me-2"></i> @lang('back.waiting')
                            </button>
                            <button type="button" class="btn btn-dark waves-effect waves-light">
                                <i class="uil uil-exclamation-octagon me-2"></i> @lang('back.total')
                            </button>
                        </div>

                    </div>
                </div>
                <!-- end page title -->

                <!-- start page title -->
                <div class="row">

                    <div class="col-12">
                        <table id="datatable" class="table  table-sm table-bordered dt-responsive nowrap"
{{--                               style="border-collapse: collapse; border-spacing: 0; width: 100%;">--}}
                               style="font-size:12px">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>@lang('back.client_name')</th>
                                <th>@lang('back.client_phone')</th>
                                <th>@lang('back.client_whatsapp')</th>
                                <th>@lang('back.call_at')</th>
                                <th>@lang('back.order_at')</th>
                                <th>@lang('back.time_at')</th>
                                <th>@lang('back.from_area')</th>
                                <th>@lang('back.to_area')</th>
                                <th>@lang('back.from_floor')</th>
                                <th>@lang('back.to_floor')</th>
                                <th>@lang('back.price')</th>
                                <th>@lang('back.created_by')</th>
                                <th>@lang('back.action')</th>
                            </tr>
                            </thead>


                            <tbody>
                            @foreach($bookings as $k => $booking)
                                <tr>
                                    <td><a href="{{route('bookings.show',$booking->id)}}">#{{$booking->id}}</a></td>
                                    <td>{{$booking->client_name}}</td>
                                    <td>{{$booking->client_phone}}</td>
                                    <td>
                                        <a target="_blank" href="https://web.whatsapp.com/send?phone=+2{{$booking->client_phone}}&text={{$booking->whatsappClient}}" class="btn btn-success waves-effect waves-light btn-sm">
                                            <i class="fab fa-whatsapp me-2"></i> وتساب
                                        </a>

                                    </td>
                                    <td>{{$booking->created_at}}</td>
                                    <td>{{$booking->booking_at}} <br> ( {{ $booking->order_day }} )</td>
                                    <td>{{$booking->order_time}}</td>
                                    <td>{{$booking->fromArea ? $booking->fromArea->name : ''}}</td>
                                    <td>{{$booking->toArea ? $booking->toArea->name : ''}}</td>
                                    <td>{{$booking->from_floor}}</td>
                                    <td>{{$booking->to_floor}}</td>
                                    <td>{{$booking->price}}  @lang('back.L.E')</td>
                                    <td>{{$booking->user->name}}</td>
                                    <td>
                                        <a href="{{route('bookings.edit',$booking->id)}}" class="btn btn-outline-warning btn-sm"
                                           title="@lang('back.edit')">
                                            <i class="fas fa-pencil-alt"></i>
                                        </a>
                                        {{--<a href="{{route('bookings.destroy',$booking->id)}}"
                                           class="btn btn-outline-danger btn-sm" title="@lang('back.delete')">
                                            <i class="fas fa-times"></i>
                                        </a>--}}
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>

                    </div>
                </div>
                <!-- end page title -->

            </div>
        </div>
        {{--

                @include('acp.Booking.scroll')
        --}}

    </div> <!-- end row -->


    {{--

        <div class="row">
            <div class="col-12">

                <div class="ajax-load text-center" style="display:none">
                    <div class="spinner-grow text-danger m-1" role="status">
                        <span class="sr-only">Loading...</span>
                    </div>

                </div>
            </div>
        </div>

    --}}


@endsection
@section('js')

    <!-- Required datatable js -->
    <script src="{{url('acp/libs/datatables.net/js/jquery.dataTables.min.js')}}"></script>
    <script src="{{url('acp/libs/datatables.net-bs4/js/dataTables.bootstrap4.min.js')}}"></script>
    <!-- Buttons examples -->
    <script src="{{url('acp/libs/datatables.net-buttons/js/dataTables.buttons.min.js')}}"></script>
    <script src="{{url('acp/libs/datatables.net-buttons-bs4/js/buttons.bootstrap4.min.js')}}"></script>
    <script src="{{url('acp/libs/jszip/jszip.min.js')}}"></script>
    <script src="{{url('acp/libs/pdfmake/build/pdfmake.min.js')}}"></script>
    <script src="{{url('acp/libs/pdfmake/build/vfs_fonts.js')}}"></script>
    <script src="{{url('acp/libs/datatables.net-buttons/js/buttons.html5.min.js')}}"></script>
    <script src="{{url('acp/libs/datatables.net-buttons/js/buttons.print.min.js')}}"></script>
    <script src="{{url('acp/libs/datatables.net-buttons/js/buttons.colVis.min.js')}}"></script>

    <!-- Responsive examples -->
    <script src="{{url('acp/libs/datatables.net-responsive/js/dataTables.responsive.min.js')}}"></script>
    <script src="{{url('acp/libs/datatables.net-responsive-bs4/js/responsive.bootstrap4.min.js')}}"></script>

    <!-- Datatable init js -->
    <script src="{{url('acp/js/pages/datatables.init.js')}}"></script>

        <script type="text/javascript">
            $('#datatable').dataTable({
                bAutoWidth: false,
            });

        </script>

    {{--
        <script type="text/javascript">
            var page = 1;
            $(window).scroll(function () {
                if ($(window).scrollTop() + $(window).height() >= $(document).height()) {
                    page++;
                    loadMoreData(page);
                }
            });


            function loadMoreData(page) {
                $.ajax(
                    {
                        url: '?page=' + page,
                        type: "get",
                        beforeSend: function () {
                            $('.ajax-load').show();
                        }
                    })
                    .done(function (data) {
                        if (data.html == " ") {
                            $('.ajax-load').html("No more records found");
                            return;
                        }
                        $('.ajax-load').hide();
                        $("#post-data").append(data.html);
                    })
                    .fail(function (jqXHR, ajaxOptions, thrownError) {
                        alert('server not responding...');
                    });
            }


        </script>
        --}}
@endsection

