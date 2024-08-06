@extends('acp.layout.app')

@section('title')
    @lang('back.createQuick_bookings')
@endsection
@section('css')
    <link href="{{url('acp/libs/select2/css/select2.min.css')}}" rel="stylesheet" type="text/css"/>
    <style>
        th {
            text-align: center;
        }

        .truck-td {
            border-width: 1px;
        }

        .truck {
            width: 100%;
            max-width: 100%;
            height: 176px;
            background-image: url(https://3.khater.xyz/orders-page/photos/truck.jpg);
            background-repeat: no-repeat;
            padding-left: 100px;
            padding-top: 25px;
            direction: ltr;
            margin-top: 40%;
        }

        .truck-water {
            width: 100%;
            max-width: 400px;
            height: 176px;
            background-image: url(https://3.khater.xyz/orders-page/photos/truck.jpg);
            background-repeat: no-repeat;
            background-size: 100%;
            padding-left: 100px;
            padding-top: 25px;
            direction: ltr
        }

        .truck-chiller {
            width: 100%;
            max-width: 800px;
            height: 260px;
            background-image: url(https://3.khater.xyz/orders-page/photos/truck.jpg);
            background-repeat: no-repeat;
            background-size: 100% 100%;
            padding-left: 100px;
            padding-top: 25px;
            direction: ltr
        }

        .truck-table {
            width: 100%;
            max-width: 290px;
            height: 100px
        }

        .truck-td {
            width: 20%;
            height: 25%;
            text-align: center;
            vertical-align: middle
        }
    </style>
@endsection
@section('content')

    <!-- start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-flex align-items-center justify-content-between">
                <h4 class="mb-0">@lang('back.createQuick_bookings')</h4>

                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item active">@lang('back.createQuick_bookings')</li>
                        <li class="breadcrumb-item ">@lang('back.bookings')</li>
                        <li class="breadcrumb-item">@lang('back.dashborad')</li>
                    </ol>
                </div>

            </div>
        </div>
    </div>
    <!-- end page title -->



    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                @if(Session::has('msg'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <i class="uil uil-check me-2"></i>
                        {!! session('msg') !!}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">

                        </button>
                    </div>

                @endif
                @if($errors->any())
                    @foreach($errors->all() as $error)
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <p></p>
                            <i class="uil uil-exclamation-octagon me-2"></i>
                            {{ $error }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">

                            </button>
                        </div>
                    @endforeach
                @endif
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12 col-xl-12">
            <div class="card bg-warning border-primary text-white">
                <div class="card-body " >
                    <h4 class="mb-1 mt-1 text-center text-white">@lang('back.reservations_chedule')</h4>
                </div>
            </div>
        </div>

    </div> <!-- end col-->



    <div class="row">
        <div class="col-md-4 col-xl-4">
            <div class="card bg-primary border-primary text-white" data-bs-toggle="modal" data-bs-target=".bs-example-modal-xl-booking_basic_in">
                <div class="card-body " >
                    <h4 class="mb-1 mt-1 text-center text-white">@lang('back.booking_basic_in')</h4>
                </div>
                <p class="text-center text-white">@lang('back.booking_basic_in_datils')</p>
            </div>
        </div>

        <div class="col-md-4 col-xl-4">
            <div class="card bg-info border-info text-white">
                <div class="card-body">
                    <h4 class="mb-1 mt-1 text-center text-white">@lang('back.booking_basic_out')</h4>
                </div>
                <p class="text-center text-white">@lang('back.booking_basic_out_datils')</p>
            </div>
        </div>

        <div class="col-md-4 col-xl-4">
            <div class="card bg-danger border-info text-white">
                <div class="card-body">
                    <h4 class="mb-1 mt-1 text-center text-white">@lang('back.booking_advanced')</h4>
                </div>
                <p class=" text-white text-center ">@lang('back.booking_advanced_datils')</p>
            </div>
        </div>

    </div> <!-- end col-->

    <div class="row">
        <div class="col-md-4 col-xl-4">
            <div class="card bg-warning border-info text-white">
                <div class="card-body">

                    <h4 class="mb-1 mt-1 text-center text-white">@lang('back.booking_vip')</h4>

                </div>
                <p class="text-white text-center ">@lang('back.booking_vip_datils')</p>
            </div>
        </div>

        <div class="col-md-4 col-xl-4">
            <div class="card bg-success border-info text-white">
                <div class="card-body">

                    <h4 class="mb-1 mt-1 text-center text-white">@lang('back.booking_crane_up')</h4>

                </div>
                <p class="text-white text-center ">@lang('back.booking_crane_up_datils')</p>
            </div>
        </div>

        <div class="col-md-4 col-xl-4">
            <div class="card bg-dark border-white ">
                <div class="card-body">

                    <h4 class="mb-1 mt-1 text-center text-white">@lang('back.booking_crane_up')</h4>

                </div>
                <p class="text-white text-center ">@lang('back.booking_crane_down_datils')</p>
            </div>
        </div>

    </div> <!-- end col-->

    <div class="row">
        <div class="col-md-4 col-xl-4">
            <div class="card bg-info border-info text-white">
                <div class="card-body">

                    <h4 class="mb-1 mt-1 text-center text-white">@lang('back.booking_crane_electrec')</h4>

                </div>
                <p class="text-white text-center ">@lang('back.booking_crane_electrec_datils')</p>
            </div>
        </div>

        <div class="col-md-4 col-xl-4">
            <div class="card bg-danger border-info text-white">
                <div class="card-body">

                    <h4 class="mb-1 mt-1 text-center text-white">@lang('back.booking_car_hours')</h4>

                </div>
                <p class="text-white text-center ">@lang('back.booking_car_hours_datils')</p>
            </div>
        </div>



    </div> <!-- end col-->


    <div class="row">
        <div class="col-md-12 col-xl-12">
            <div class="card bg-warning border-primary text-white">
                <div class="card-body " >
                    <h4 class="mb-1 mt-1 text-center text-white">@lang('back.trakings')</h4>
                </div>
            </div>
        </div>

    </div> <!-- end col-->


    <div class="row">
        <div class="col-md-12 col-xl-12">
            <div class="card bg-success border-primary text-white">
                <div class="card-body " >
                    <h4 class="mb-1 mt-1 text-center text-white">@lang('back.tomorrow_batch')</h4>
                </div>
            </div>
        </div>

    </div> <!-- end col-->


    <!--  Extra Large modal example -->
    <div class="modal fade bs-example-modal-xl-booking_basic_in" tabindex="-1" role="dialog" aria-labelledby="myExtraLargeModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="myExtraLargeModalLabel">@lang('back.client_datils')</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                    </button>
                </div>
                <div class="modal-body">

                    <form>
                        <div class="row">
                            <div class="col-lg-4">
                                <div class="mb-3">
                                    <label for="basicpill-firstname-input">@lang('back.name')</label>
                                    <input type="text" class="form-control" id="basicpill-firstname-input"
                                           placeholder="@lang('back.name')" name="name"
                                           value="{{old('name')}}">
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="mb-3">
                                    <label for="basicpill-phone-input">@lang('back.phone')</label>
                                    <input type="text" class="form-control phone_number"
                                           id="basicpill-phone-input" placeholder="@lang('back.phone')"
                                           name="phone" value="{{old('phone')}}">
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="mb-3">
                                    <label for="basicpill-phone2-input">@lang('back.phone2')</label>
                                    <input type="text" class="form-control phone_number"
                                           id="basicpill-phone2-input" placeholder="@lang('back.phone2')"
                                           name="phone2" value="{{old('phone2')}}">
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-lg-4">
                                <div class="mb-3">
                                    <label for="basicpill-from_area-input">@lang('back.from_address')</label>
                                    <select name="from_area" class="form-control select2 other" required>
                                        <option value="">@lang('back.select_one')</option>
                                        @foreach($areas as $FromAreas)
                                            <optgroup label="{{$FromAreas->name}}">
                                                @foreach($FromAreas->children as $FromChildren)
                                                    <option value="{{$FromChildren->id}}">{{$FromChildren->name}}</option>
                                                @endforeach
                                            </optgroup>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="mb-3">
                                    <label for="basicpill-to-input">@lang('back.to_address')</label>
                                    <select name="to_area" class="form-control select2 other" required>
                                        <option value="">@lang('back.select_one')</option>
                                        @foreach($areas as $ToAreas)
                                            <optgroup label="{{$ToAreas->name}}">
                                                @foreach($ToAreas->children as $ToChildren)
                                                    <option value="{{$ToChildren->id}}">{{$ToChildren->name}}</option>
                                                @endforeach
                                            </optgroup>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="mb-3">
                                    <label for="basicpill-nanonal_id-input">@lang('back.nanonal_id')</label>
                                    <input type="text" class="form-control nanonal_id"
                                           id="basicpill-nanonal_id-input"
                                           placeholder="@lang('back.nanonal_id')" name="nanonal_id"
                                           value="{{old('nanonal_id')}}">
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-lg-4">
                                <div class="mb-3">
                                    <label for="basicpill-from_floor-input">@lang('back.from_floor')</label>
                                    <input type="number" class="form-control"
                                           id="basicpill-from_floor-input"
                                           placeholder="@lang('back.from_floor')" name="from_floor"
                                           value="{{old('from_floor')}}">

                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="mb-3">
                                    <label for="basicpill-to_floor-input">@lang('back.to_floor')</label>
                                    <input type="number" class="form-control" id="basicpill-to_floor-input"
                                           placeholder="@lang('back.to_floor')" name="to_floor"
                                           value="{{old('to_floor')}}">

                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="mb-3">
                                    <h5 class="font-size-14 mb-3">@lang('back.count_rooms') @lang('back.count_cars')</h5>
                                    <div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="formRadios" id="switch2" >
                                            <label class="form-check-label" for="switch2">
                                                @lang('back.count_rooms')
                                            </label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="formRadios" id="switch1">
                                            <label class="form-check-label" for="switch1">
                                                @lang('back.count_cars')
                                            </label>
                                        </div>

                                        <input type="number" class="form-control car"
                                               id="basicpill-car_count-input"
                                               placeholder="@lang('back.type_count')" name="car_count"
                                               disabled style="display:none" value="{{old('car_count')}}">
                                        <input type="number" class="form-control room"
                                               id="basicpill-room_count-input"
                                               placeholder="@lang('back.type_count')" name="room_count"
                                               disabled style="display:none" value="{{old('room_count')}}">
                                    </div>

                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-lg-4">
                                <div class="mb-3">
                                    <div class="mb-3">
                                        <h5 class="font-size-14 mb-3">@lang('back.assanger')
                                            &nbsp;&nbsp; @lang('back.ladder_wide')
                                            &nbsp;&nbsp; @lang('back.corridor')</h5>
                                        <div>
                                            <input type="checkbox" id="switch4" switch="none"/>
                                            <label for="switch4" data-on-label="On" name="assanger"
                                                   data-off-label="Off"></label>&nbsp;&nbsp;&nbsp;&nbsp;
                                            <input type="checkbox" id="switch5" switch="none"/>
                                            <label for="switch5" data-on-label="On" name="ladder_wide"
                                                   data-off-label="Off"></label>&nbsp;&nbsp;&nbsp;&nbsp;
                                            <input type="checkbox" id="switch6" switch="none"/>
                                            <label for="switch6" data-on-label="On" name="corridor"
                                                   data-off-label="Off"></label>&nbsp;&nbsp;&nbsp;&nbsp;
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="mb-3">
                                    <h5 class="font-size-14 mb-3">@lang('back.winch_up')</h5>
                                    <div>
                                        <input type="checkbox" id="switch7" switch="none"/>
                                        <label for="switch7" data-on-label="On"
                                               data-off-label="Off"></label>&nbsp;&nbsp;&nbsp;&nbsp;
                                        <input type="number" class="form-control winch_up"
                                               id="basicpill-winch_up-input"
                                               placeholder="@lang('back.winch_up')" name="winch_up" disabled
                                               style="display:none" value="{{old('winch_up')}}">

                                    </div>

                                </div>
                            </div>

                            <div class="col-lg-4">
                                <div class="mb-3">
                                    <h5 class="font-size-14 mb-3">@lang('back.winch_down')</h5>
                                    <div>
                                        <input type="checkbox" id="switch8" switch="none"/>
                                        <label for="switch8" data-on-label="On"
                                               data-off-label="Off"></label>&nbsp;&nbsp;&nbsp;&nbsp;
                                        <input type="number" class="form-control winch_down"
                                               id="basicpill-winch_down-input"
                                               placeholder="@lang('back.winch_down')" name="winch_down"
                                               disabled style="display:none" value="{{old('winch_down')}}">

                                    </div>

                                </div>
                            </div>
                        </div>
                    </form>

                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->

@endsection
@section('js')



    <script src="{{url('acp/libs/select2/js/select2.min.js')}}"></script>



    <!-- form wizard init -->
    <script src="{{url('acp/js/pages/form-wizard.init.js')}}"></script>

    <script>

        $("#switch2").on('change', function () {
            if ($(this).is(':checked')) {
                $(".car").removeAttr("disabled");
                $(".car").show();
                $(".room").hide();
            } else {
                $(".car").attr("disabled");
                $(".car").hide();

            }
        });


        $("#switch1").on('change', function () {
            if ($(this).is(':checked')) {
                $(".room").removeAttr("disabled");
                $(".room").show();
                $(".car").hide();
            } else {
                $(".room").attr("disabled");
                $(".room").hide();
            }
        });

        $("#switch7").on('change', function () {
            if ($(this).is(':checked')) {
                $(".winch_up").removeAttr("disabled");
                $(".winch_up").show();
            } else {
                $(".winch_up").attr("disabled");
                $(".winch_up").hide();
            }
        });

        $("#switch8").on('change', function () {
            if ($(this).is(':checked')) {
                $(".winch_down").removeAttr("disabled");
                $(".winch_down").show();
            } else {
                $(".winch_down").attr("disabled");
                $(".winch_down").hide();
            }
        });


        $(".phone_number").inputmask({
            "mask": "019-99-99-99-99"
        });


        /*
                jQuery('#repet').on('click', function (e) {
                    jQuery(".copy").clone().appendTo(".addons");
                });
                jQuery('#destroy').on('click', function (e) {
                    jQuery(".addons").remove();
                });
        */


        $(function () {
            var minlength = 3;

            $(".phone_number").keyup(function () {
                var that = this,
                    value = $(this).val();

                if (value.length >= minlength) {
                    if (searchRequest != null)
                        searchRequest.abort();
                    searchRequest = $.ajax({
                        type: "GET",
                        url: "{{route('bookings.search.phone')}}",
                        data: {
                            'phone': value
                        },
                        dataType: "text",
                        success: function (Result) {
                            if (JSON.parse(Result).length > 0) {


                                $(".all_table").css("display", "block");

                                $(".append_ajax").empty();
                                //we need to check if the value is the same
                                $.each(JSON.parse(Result), function (key, value) {
                                    $('.append_ajax').append('<tr><th>' + (key + 1) + '</th><th>' + value.client_name + '</th><th>' + value.client_phone + '</th><th>' + value.created + '</th><th>' + value.from_address + '</th><th>' + value.to_address + '</th><th>' + value.price + '</th><th>' + value.status_lable + '</th><td>' + value.vehicle_brand + '</td><td>' + value.vehicle_status + '</td><td>' + value.create_by + '</td></tr>');
                                })
                            } else {
                                $(".all_table").css("display", "block");

                                $(".append_ajax").empty();

                                $('.append_ajax').append('<tr><th colspan="11"><div class="alert alert-warning alert-dismissible fade show" role="alert"> @lang('back.no_data') </div></th></tr>');

                                console.log('no data')
                            }
                        }
                    });
                }
            });
        });


    </script>


    <!-- jquery step -->
    <script src="{{url('acp/libs/jquery-steps/build/jquery.steps.min.js')}}"></script>
    {{--    <script type="text/javascript" src="https://3.khater.xyz/orders-page/script/create-order.js"></script>--}}
    <!-- init js -->
    {{--        <script src="{{url('acp/js/pages/form-advanced.init.js')}}"></script>--}}


    {{--

    <script>

        $(".other").select2({
            tags: true
        });

    </script>
    --}}

@endsection
