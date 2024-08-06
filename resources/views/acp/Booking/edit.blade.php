@extends('acp.layout.app')

@section('title')
    @lang('back.edit') @lang('back.bookings')
@endsection
@section('css')
    <link href="{{url('acp/libs/select2/css/select2.min.css')}}" rel="stylesheet" type="text/css"/>
    <style>
        .form-control {
            appearance: auto !important;
        }

        th {
            text-align: center;
        }

        .truck {
            width: 100%;
            max-width: 400px;
            height: 176px;
            background-image: url(https://3.khater.xyz/orders-page/photos/truck.jpg);
            background-repeat: no-repeat;
            padding-left: 100px;
            padding-top: 25px;
            direction: ltr;


        }

        .truck-table {
            width: 100%;
            max-width: 290px;
            height: 100px;
        }

        .truck-td {
            border-width: 1px;
            width: 20%;
            height: 25%;
            text-align: center;
            vertical-align: middle
        }

        input.largerCheckbox {
            width: 30px;
            height: 30px;
        }

        #sum td {
            line-height: 15px;
            padding-top: 20px;
            padding-bottom: 0px;
        }
    </style>
@endsection

@section('content')

    <!-- start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-flex align-items-center justify-content-between">
                <h4 class="mb-0">@lang('back.edit') @lang('back.bookings')</h4>

                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item active">@lang('back.edit') @lang('back.bookings')</li>
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

                    <div class="card-body">

                        <div class="row all_table" style="display: none;">
                            <h4 class="card-title">@lang('back.order_client_older')</h4>

                            <div class="col-lg-12">
                                <table class="table table-striped mb-0">

                                    <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>@lang('back.client_name')</th>
                                        <th>@lang('back.client_phone')</th>
                                        <th>@lang('back.created_at')</th>
                                        <th>@lang('back.from_address')</th>
                                        <th>@lang('back.to_address')</th>
                                        <th>@lang('back.price')</th>
                                        <th>@lang('back.status')</th>
                                        <th>@lang('back.vehicle_brand')</th>
                                        <th>@lang('back.vehicle_status')</th>
                                        <th>@lang('back.created_by')</th>
                                    </tr>
                                    </thead>
                                    <tbody class="append_ajax">


                                    </tbody>
                                </table>
                            </div>
                        </div>

                        <div class="row all_table_old" style="display: none;">
                            <h4 class="card-title">@lang('back.order_client_older') (سيستم القديم)</h4>

                            <div class="col-lg-12">
                                <table class="table table-striped mb-0">

                                    <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>@lang('back.client_name')</th>
                                        <th>@lang('back.client_phone')</th>
                                        <th>@lang('back.created_at')</th>
                                        <th>@lang('back.from_address')</th>
                                        <th>@lang('back.to_address')</th>
                                        <th>@lang('back.price')</th>
                                    </tr>
                                    </thead>
                                    <tbody class="append_ajax_old">


                                    </tbody>
                                </table>
                            </div>
                        </div>


                        <div class="row">

                            <form method="post" action="{{route('bookings.update',$booking->id)}}" class="custom-validation">
                                @csrf

                                <!-- Seller Details -->
                                    <h3>@lang('back.contact_data')</h3>
                                    <section>
                                        <div class="row">
                                            <div class="col-lg-4">
                                                <div class="mb-3">
                                                    <label for="basicpill-firstname-input">@lang('back.name')</label>
                                                    <input type="text" class="form-control" id="basicpill-firstname-input"
                                                           placeholder="@lang('back.name')" name="name"
                                                           value="{{old('name',$booking->client_name)}}" required>
                                                </div>
                                            </div>
                                            <div class="col-lg-4">
                                                <div class="mb-3">
                                                    <label for="basicpill-phone-input">@lang('back.phone')</label>
                                                    <input type="text" class="form-control phone_number"
                                                           id="basicpill-phone-input" placeholder="@lang('back.phone')"
                                                           name="phone" value="{{old('phone',$booking->client_phone)}}" required>
                                                </div>
                                            </div>
                                            <div class="col-lg-4">
                                                <div class="mb-3">
                                                    <label for="basicpill-phone2-input">@lang('back.phone2')</label>
                                                    <input type="text" class="form-control phone_number"
                                                           id="basicpill-phone2-input" placeholder="@lang('back.phone2')"
                                                           name="phone2" value="{{old('phone2',$booking->client_phone2)}}">
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
                                                                    <option {{$booking->from_area == $FromChildren->id ? 'selected' : ''}}  value="{{$FromChildren->id}}">{{$FromChildren->name}}</option>
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
                                                                    <option {{$booking->to_area == $ToChildren->id ? 'selected' : ''}} value="{{$ToChildren->id}}">{{$ToChildren->name}}</option>
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
                                                           id="basicpill-nanonal_id-input" required
                                                           placeholder="@lang('back.nanonal_id')" name="nanonal_id"
                                                           value="{{old('nanonal_id',$booking->nanonal_id)}}">
                                                </div>
                                                <span id='national_number_result2'>
                                        </span>

                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-lg-4">
                                                <div class="mb-3">
                                                    <label for="basicpill-from_floor-input">@lang('back.from_floor')</label>
                                                    <input type="number" class="form-control"
                                                           id="basicpill-from_floor-input" required
                                                           placeholder="@lang('back.from_floor')" name="from_floor"
                                                           value="{{old('from_floor',$booking->from_floor)}}">

                                                </div>
                                            </div>
                                            <div class="col-lg-4">
                                                <div class="mb-3">
                                                    <label for="basicpill-to_floor-input">@lang('back.to_floor')</label>
                                                    <input type="number" class="form-control" id="basicpill-to_floor-input"
                                                           placeholder="@lang('back.to_floor')" name="to_floor" required
                                                           value="{{old('to_floor',$booking->to_floor)}}">

                                                </div>
                                            </div>
                                            <div class="col-lg-4">
                                                <div class="row">
                                                    <div class="col-lg-6">
                                                        <div class="mb-3">
                                                            <label for="know_through">@lang('back.know_through') </label>
                                                            <select name="know_through" class="form-control" id="know_through">
                                                                <option value="">اختر واحدة</option>
                                                                @foreach($knows as $know)
                                                                    <option {{$booking->know_through == $know->id ? 'selected' : ''}}  value="{{$know->id}}">{{$know->title}}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-6">
                                                        <div class="mb-3">
                                                            <label for="received_by_phone">@lang('back.received_by_phone')</label>
                                                            <select name="received_phone" class="form-control"
                                                                    id="received_by_phone">
                                                                <option value="">اختر واحدة</option>
                                                                @foreach($receiveds as $received)
                                                                    <option {{$booking->received_phone == $received->id ? 'selected' : ''}}  value="{{$received->id}}">{{$received->title}}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                    </div>

                                                </div>

                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-lg-12">
                                                <div class="mt-3">
                                                    <div class="form-check form-check-inline">
                                                        <input class="largerCheckbox form-check-input" id="switch4"
                                                               name="assanger" type="checkbox" {{$booking->assanger == 'on' ? 'checked' : ''}} >
                                                        <label class="form-check-label" for="switch4">
                                                            &nbsp;&nbsp; @lang('back.assanger') &nbsp;&nbsp;
                                                        </label>
                                                    </div>

                                                    <div class="form-check form-check-inline">
                                                        <input class="largerCheckbox form-check-input" id="switch5"
                                                               name="ladder_wide" type="checkbox" {{$booking->ladder_wide == 'on' ? 'checked' : ''}}>
                                                        <label class="form-check-label" for="switch5">
                                                            &nbsp;&nbsp; @lang('back.ladder_wide') &nbsp;&nbsp;
                                                        </label>
                                                    </div>
                                                    <div class="form-check form-check-inline">
                                                        <input class="largerCheckbox form-check-input" id="switch6"
                                                               name="corridor" type="checkbox" {{$booking->corridor == 'on' ? 'checked' : ''}}>
                                                        <label class="form-check-label" for="switch6">
                                                            &nbsp;&nbsp; @lang('back.corridor') &nbsp;&nbsp;
                                                        </label>
                                                    </div>
                                                    <div class="form-check form-check-inline">
                                                        <input class="largerCheckbox form-check-input" id="switch7"
                                                               name="check_winch_up" type="checkbox" {{$booking->check_winch_up == 'on' ? 'checked' : ''}}>
                                                        <label class="form-check-label" for="switch7">
                                                            &nbsp;&nbsp; @lang('back.winch_up') &nbsp;&nbsp;
                                                        </label>
                                                    </div>
                                                    <div class="form-check form-check-inline">
                                                        <input class="largerCheckbox form-check-input" id="switch8"
                                                               name="check_winch_down" type="checkbox" {{$booking->check_winch_down == 'on' ? 'checked' : ''}}>
                                                        <label class="form-check-label" for="switch8">
                                                            &nbsp;&nbsp; @lang('back.winch_down') &nbsp;&nbsp;
                                                        </label>


                                                        <input type="number" class="form-control winch_down"
                                                               id="basicpill-winch_down-input"
                                                               placeholder="@lang('back.winch_down')" name="winch_down"
                                                               disabled style="display:none" value="{{old('winch_down',$booking->winch_down)}}">

                                                    </div>

                                                </div>
                                            </div>

                                        </div>
                                    </section>

                                    <!-- Company Document -->
                                    <h3>@lang('back.load_car')</h3>
                                    <section>
@php
    $load = json_decode($booking->load_car);
@endphp

                                        <div class="row">
                                            <div class="col-lg-12">
                                                <div class="table-responsive mb-0" data-pattern="priority-columns">
                                                    <table class="table table-bordered table-responsive" id="items">

                                                        <thead>
                                                        <tr>
                                                            <th>@lang('back.furniture')</th>
                                                            <td>@lang('back.bedroom')</td>
                                                            <td>@lang('back.children_room')</td>
                                                            <td>@lang('back.nich')</td>
                                                            <td>@lang('back.trip')</td>
                                                            <td>@lang('back.buffet')</td>
                                                            <td>@lang('back.IKEA_bedroom')</td>
                                                            <td>@lang('back.inter')</td>
                                                            <td>@lang('back.salon')</td>
                                                            <td>@lang('back.living')</td>
                                                            <td>@lang('back.corner')</td>
                                                            <td>@lang('back.kitchen')</td>
                                                            <td>@lang('back.office')</td>
                                                            <td>@lang('back.library')</td>
                                                            <td>@lang('back.carton&bags')</td>
                                                        </tr>
                                                        </thead>
                                                        <tbody>
                                                        <tr>
                                                            <td>@lang('back.count')</td>
                                                            <td><input class="furntire largerCheckbox " name="load[bedroom]"
                                                                       type="checkbox" value="1" {{isset($load->bedroom) && $load->bedroom == 1 ? 'checked' : ''}} ></td>
                                                            <td><input class="furntire largerCheckbox " name="load[kidroom]"
                                                                       type="checkbox" value="1" {{isset($load->kidroom) && $load->kidroom == 1 ? 'checked' : ''}}></td>
                                                            <td><input class="furntire largerCheckbox " name="load[dinnerroom]"
                                                                       type="checkbox" value="1" {{isset($load->dinnerroom) && $load->dinnerroom == 1 ? 'checked' : ''}}></td>
                                                            <td><input class="furntire largerCheckbox " name="load[neesh]"
                                                                       type="checkbox" value="1" {{isset($load->neesh) && $load->neesh == 1 ? 'checked' : ''}}></td>
                                                            <td><input class="furntire largerCheckbox " name="load[bofue]"
                                                                       type="checkbox" value="1" {{isset($load->bofue) && $load->bofue == 1 ? 'checked' : ''}}></td>
                                                            <td><input class="furntire largerCheckbox " name="load[bedroom_eka]"
                                                                       type="checkbox" value="1" {{isset($load->bedroom_eka) && $load->bedroom_eka == 1 ? 'checked' : ''}}></td>
                                                            <td><input class="furntire largerCheckbox " name="load[antreh]"
                                                                       type="checkbox" value="1" {{isset($load->antreh) && $load->antreh == 1 ? 'checked' : ''}}></td>
                                                            <td><input class="furntire largerCheckbox " name="load[salon]"
                                                                       type="checkbox" value="1" {{isset($load->salon) && $load->salon == 1 ? 'checked' : ''}}></td>
                                                            <td><input class="furntire largerCheckbox " name="load[living]"
                                                                       type="checkbox" value="1" {{isset($load->living) && $load->living == 1 ? 'checked' : ''}}></td>
                                                            <td><input class="furntire largerCheckbox " name="load[rokna]"
                                                                       type="checkbox" value="1" {{isset($load->rokna) && $load->rokna == 1 ? 'checked' : ''}}></td>
                                                            <td><input class="furntire largerCheckbox " name="load[kitchen]"
                                                                       type="checkbox" value="1" {{isset($load->kitchen) && $load->kitchen == 1 ? 'checked' : ''}}></td>
                                                            <td><input class="furntire largerCheckbox " name="load[office]"
                                                                       type="checkbox" value="1" {{isset($load->office) && $load->office == 1 ? 'checked' : ''}}></td>
                                                            <td><input class="furntire largerCheckbox " name="load[library]"
                                                                       type="checkbox" value="1" {{isset($load->library) && $load->library == 1 ? 'checked' : ''}}></td>
                                                            <td><input class="furntire largerCheckbox " style="width:100px;"
                                                                       name="load[cases]"
                                                                       type="number" value="{{isset($load->cases) ? $load->cases : 0}}"></td>
                                                        </tr>

                                                        {{--
                                                        <tr>
                                                            <td>@lang('back.count')</td>
                                                            <td><input class="furntire largerCheckbox " name="bedroom"
                                                                       type="checkbox" value="1"></td>
                                                            <td><input class="furntire largerCheckbox " name="kidroom"
                                                                       type="checkbox" value="1"></td>
                                                            <td><input class="furntire largerCheckbox " name="dinnerroom"
                                                                       type="checkbox" value="1"></td>
                                                            <td><input class="furntire largerCheckbox " name="neesh"
                                                                       type="checkbox" value="1"></td>
                                                            <td><input class="furntire largerCheckbox " name="bofue"
                                                                       type="checkbox" value="1"></td>
                                                            <td><input class="furntire largerCheckbox " name="bedroom_eka"
                                                                       type="checkbox" value="1"></td>
                                                            <td><input class="furntire largerCheckbox " name="antreh"
                                                                       type="checkbox" value="1"></td>
                                                            <td><input class="furntire largerCheckbox " name="salon"
                                                                       type="checkbox" value="1"></td>
                                                            <td><input class="furntire largerCheckbox " name="living"
                                                                       type="checkbox" value="1"></td>
                                                            <td><input class="furntire largerCheckbox " name="rokna"
                                                                       type="checkbox" value="1"></td>
                                                            <td><input class="furntire largerCheckbox " name="kitchen"
                                                                       type="checkbox" value="1"></td>
                                                            <td><input class="furntire largerCheckbox " name="office"
                                                                       type="checkbox" value="1"></td>
                                                            <td><input class="furntire largerCheckbox " name="library"
                                                                       type="checkbox" value="1"></td>
                                                            <td><input class="furntire largerCheckbox "
                                                                       style="width:100px;" name="cases"
                                                                       type="number" value="0"></td>
                                                        </tr>

                                                        --}}
                                                        </tbody>
                                                    </table>
                                                </div>

                                                <div class="table-responsive mb-0" data-pattern="priority-columns">
                                                    <table class="table table-bordered table-responsive" id="items">

                                                        <thead>
                                                        <tr>
                                                            <th>@lang('back.hardware')</th>
                                                            <td>@lang('back.refrigerator')</td>
                                                            <td>@lang('back.deep_frazier')</td>
                                                            <td>@lang('back.washer')</td>
                                                            <td>@lang('back.potogaz')</td>
                                                            <td>@lang('back.dishwasher')</td>
                                                            <td>@lang('back.boiler')</td>
                                                            <td>@lang('back.television')</td>
                                                            <td>@lang('back.conditioning')</td>
                                                            <td>@lang('back.microwave')</td>
                                                            <td>@lang('back.chandelier')</td>
                                                            <td>@lang('back.carpets')</td>
                                                            <td>@lang('back.mattresses')</td>
                                                            <td>@lang('back.trabies')</td>
                                                            <td>@lang('back.penalty')</td>
                                                        </tr>
                                                        </thead>
                                                        <tbody>
                                                        <tr>
                                                            <td>@lang('back.count')</td>
                                                            <td><input class="devices largerCheckbox " name="load[fridge]"
                                                                       type="checkbox" value="1" {{isset($load->fridge) && $load->fridge == 1 ? 'checked' : ''}}></td>
                                                            <td><input class="devices largerCheckbox " name="load[deep_freezer]"
                                                                       type="checkbox" value="1" {{isset($load->deep_freezer) && $load->deep_freezer == 1 ? 'checked' : ''}}></td>
                                                            <td><input class="devices largerCheckbox " name="load[wacher]"
                                                                       type="checkbox" value="1" {{isset($load->wacher) && $load->wacher == 1 ? 'checked' : ''}}></td>
                                                            <td><input class="devices largerCheckbox " name="load[cocker]"
                                                                       type="checkbox" value="1" {{isset($load->cocker) && $load->cocker == 1 ? 'checked' : ''}}></td>
                                                            <td><input class="devices largerCheckbox " name="load[dish_wacher]"
                                                                       type="checkbox" value="1" {{isset($load->dish_wacher) && $load->dish_wacher == 1 ? 'checked' : ''}}></td>
                                                            <td><input class="devices largerCheckbox " name="load[heater]"
                                                                       type="checkbox" value="1" {{isset($load->heater) && $load->heater == 1 ? 'checked' : ''}}></td>
                                                            <td><input class="devices largerCheckbox " name="load[tv]"
                                                                       type="checkbox" value="1" {{isset($load->tv) && $load->tv == 1 ? 'checked' : ''}}></td>
                                                            <td><input class="devices largerCheckbox " name="load[condiner]"
                                                                       type="checkbox" value="1" {{isset($load->condiner) && $load->condiner == 1 ? 'checked' : ''}}></td>
                                                            <td><input class="devices largerCheckbox " name="load[microwave]"
                                                                       type="checkbox" value="1" {{isset($load->microwave) && $load->microwave == 1 ? 'checked' : ''}}></td>
                                                            <td><input class="devices largerCheckbox " name="load[nagaf]"
                                                                       type="checkbox" value="1" {{isset($load->nagaf) && $load->nagaf == 1 ? 'checked' : ''}}></td>
                                                            <td><input class="devices largerCheckbox " name="load[carpet]"
                                                                       type="checkbox" value="1" {{isset($load->carpet) && $load->carpet == 1 ? 'checked' : ''}}></td>
                                                            <td><input class="devices largerCheckbox " name="load[martb]"
                                                                       type="checkbox" value="1" {{isset($load->martb) && $load->martb == 1 ? 'checked' : ''}}></td>
                                                            <td><input class="devices largerCheckbox " name="load[tables]"
                                                                       type="checkbox" value="1" {{isset($load->tables) && $load->tables == 1 ? 'checked' : ''}}></td>
                                                            <td><input class="devices largerCheckbox " name="load[shoser]"
                                                                       type="checkbox" value="1" {{isset($load->shoser) && $load->shoser == 1 ? 'checked' : ''}}></td>
                                                        </tr>
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div><!-- end col-lg-6 -->

                                        </div><!-- end row -->
                                        <div class="row">
                                            <div class="col-lg-12">

                                            </div><!-- end col-lg-12 -->
                                        </div><!-- end row -->


                                    </section>

                                    <!-- Bank Details -->
                                    <h3>@lang('back.extra_charge')</h3>
                                    <section>
                                        @php
                                            $expenses = (array) json_decode($booking->expenses);
                                            $service = (array) json_decode($booking->service);
                                        @endphp
                                        <div>
                                            <div class="row">
                                                <div class="col-lg-6">
                                                    <div class="mb-3">
                                                        <table class="table table-bordered table-responsive table-sm m-0" id="sum"
                                                               style="width: 100%">
                                                            <tbody>
                                                            @foreach($settings as $k =>$setting)
                                                                <tr>
                                                                    <td width="1%">{{$k+1}}</td>
                                                                    <td width="40%">@lang('back.'.$setting->name)
                                                                        ( {{$setting->value}} @lang('back.L.E') )
                                                                    </td>
                                                                    <td width="19%" style="margin-top: -15px;">
                                                                        <div class="input-group">
                                                                            <div class="input-group-text">X</div>
                                                                            <input
                                                                                    name="num[{{$setting->name}}]" type="number"
                                                                                    value="{{old('num['.$setting->name.']',$expenses[$setting->name])}}"
                                                                                    id="{{$setting->name}}"
                                                                                    class="count_num form-control">
                                                                        </div>

                                                                    </td>
                                                                    <td width="20%" style="margin-top: -15px;">
                                                                        <div class="input-group">
                                                                            <div class="input-group-text">=</div>
                                                                            <input
                                                                                    class="total form-control"
                                                                                    id="{{$setting->name}}_total"
                                                                                    name="service[{{$setting->name}}]"
                                                                                    type="number" value="{{$service[$setting->name] != 0 ? $service[$setting->name] : ''}}">
                                                                        </div>
                                                                    </td>
                                                                    {{--                                                            <p id="{{$setting->name}}_total_span"></p>--}}
                                                                </tr>
                                                                {{--<script>
                                                                    $("#{{$setting->name}}").keyup(function () {
                                                                        var value = $(this).val();
                                                                        $("#{{$setting->name}}_total").val(value * {{$setting->value}});
                                                                        $("#{{$setting->name}}_total_span").text(value * {{$setting->value}});

                                                                    }).keyup();
                                                                </script>--}}
                                                            @endforeach
                                                            </tbody>
                                                        </table>
                                                        <table class="table table-bordered"
                                                               style="width: 100%; table-layout: fixed;">
                                                            <tbody>
                                                            <tr>
                                                                <td>السبب</td>
                                                                <td><input style="width:80%;line-height:1 !important" name="discount_reson" type="text" value="{{$booking->discount_reson}}"></td>
                                                                <td> خصم</td>
                                                                <td><input style="width:70%;line-height:1 !important" min="0" name="discount" type="number" value="{{$booking->discount}}" class="discount"></td>
                                                            </tr>
                                                            <tr>
                                                                <td>السبب</td>
                                                                <td><input style="width:80%;line-height:1 !important" name="increese_reson" type="text" value="{{$booking->increese_reson}}"></td>
                                                                <td> زياده</td>
                                                                <td><input style="width:70%;line-height:1 !important" min="0" name="increese" type="number" class="increese" value="{{$booking->increese}}">
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td colspan="2" class=""><span style="font-size:18px"> الإجمالى بعد الخصم و الزياده</span>
                                                                </td>
                                                                <td colspan="1" class=""><span style="font-size:18px"
                                                                                               id="totalafterAlltext">{{$booking->price}}</span></td>
                                                                <td colspan="1"><input id="totalafterAll"
                                                                                       style="width:100%;line-height:1 !important"
                                                                                       min="0" name="totalafterAll"
                                                                                       type="number" value="{{$booking->price}}">
                                                                </td>
                                                            </tr>
                                                            </tbody>
                                                        </table>
                                                        <table class="table table-bordered"
                                                               style="width: 100%; table-layout: fixed;">
                                                            <tbody>
                                                            <tr>
                                                                <td> هذا العميل يحتاج الي عدد (<span
                                                                            style="font-size: 36px; font-weight: bolder; padding-left: 5px; padding-right: 5px;"
                                                                            id="client_services_num"> {{count($expenses)}} </span>) خدمات
                                                                </td>
                                                                <td style="text-align: center; font-weight: bolder; font-size: 25px;">
                                                                    إكرامية العمال
                                                                    <label for="rooms">
                                                                        <input name="tips" type="number" class="form-control tips"
                                                                               value="{{old('tips',$booking->tips)}}">
                                                                    </label>

                                                                </td>
                                                                <td id="client_services"></td>
                                                            </tr>


                                                            </tbody>

                                                        </table>


                                                    </div>
                                                </div><!-- end col-lg-6 -->

                                                <div class="col-lg-6">
                                                    <div class="mt-1">
                                                        <div id="truck1" class="truck">

                                                            <table class="truck-table" cellspacing="0" cellpadding="0"
                                                                   border="1">
                                                                <tbody>
                                                                <tr>
                                                                    <td class="truck-td" truck-row="0" truck-col="0"
                                                                        style="background-color: rgb(255, 255, 255);">
                                                                        1
                                                                    </td>
                                                                    <td class="truck-td" truck-row="0" truck-col="1"
                                                                        style="background-color: rgb(255, 255, 255);">
                                                                        5
                                                                    </td>
                                                                    <td class="truck-td" truck-row="0" truck-col="2"
                                                                        style="background-color: rgb(255, 255, 255);">
                                                                        9
                                                                    </td>
                                                                    <td class="truck-td" truck-row="0" truck-col="3"
                                                                        style="background-color: rgb(255, 255, 255);">
                                                                        13
                                                                    </td>
                                                                    <td class="truck-td" truck-row="0" truck-col="4"
                                                                        style="background-color: rgb(255, 255, 255);">
                                                                        17
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <td class="truck-td" truck-row="1" truck-col="0"
                                                                        style="background-color: rgb(255, 255, 255);">
                                                                        2
                                                                    </td>
                                                                    <td class="truck-td" truck-row="1" truck-col="1"
                                                                        style="background-color: rgb(255, 255, 255);">
                                                                        6
                                                                    </td>
                                                                    <td class="truck-td" truck-row="1" truck-col="2"
                                                                        style="background-color: rgb(255, 255, 255);">
                                                                        10
                                                                    </td>
                                                                    <td class="truck-td" truck-row="1" truck-col="3"
                                                                        style="background-color: rgb(255, 255, 255);">
                                                                        14
                                                                    </td>
                                                                    <td class="truck-td" truck-row="1" truck-col="4"
                                                                        style="background-color: rgb(255, 255, 255);">
                                                                        18
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <td class="truck-td" truck-row="2" truck-col="0"
                                                                        style="background-color: rgb(255, 255, 255);">
                                                                        3
                                                                    </td>
                                                                    <td class="truck-td" truck-row="2" truck-col="1"
                                                                        style="background-color: rgb(255, 255, 255);">
                                                                        7
                                                                    </td>
                                                                    <td class="truck-td" truck-row="2" truck-col="2"
                                                                        style="background-color: rgb(255, 255, 255);">
                                                                        11
                                                                    </td>
                                                                    <td class="truck-td" truck-row="2" truck-col="3"
                                                                        style="background-color: rgb(255, 255, 255);">
                                                                        15
                                                                    </td>
                                                                    <td class="truck-td" truck-row="2" truck-col="4"
                                                                        style="background-color: rgb(255, 255, 255);">
                                                                        19
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <td class="truck-td" truck-row="3" truck-col="0"
                                                                        style="background-color: rgb(255, 255, 255);">
                                                                        4
                                                                    </td>
                                                                    <td class="truck-td" truck-row="3" truck-col="1"
                                                                        style="background-color: rgb(255, 255, 255);">
                                                                        8
                                                                    </td>
                                                                    <td class="truck-td" truck-row="3" truck-col="2"
                                                                        style="background-color: rgb(255, 255, 255);">
                                                                        12
                                                                    </td>
                                                                    <td class="truck-td" truck-row="3" truck-col="3"
                                                                        style="background-color: rgb(255, 255, 255);">
                                                                        16
                                                                    </td>
                                                                    <td class="truck-td" truck-row="3" truck-col="4"
                                                                        style="background-color: rgb(255, 255, 255);">
                                                                        20
                                                                    </td>
                                                                </tr>
                                                                </tbody>
                                                                {{--
                                                                                                                        <tbody>
                                                                                                                        @php($xarr=[])

                                                                                                                        @for($x=1;$x<=20;$x++)
                                                                                                                            @php($xarr[]=$x)
                                                                                                                        @endfor

                                                                                                                        --}}{{--                                                                <tr class="truck-td">{{$num}}--}}{{--

                                                                                                                        @foreach(array_chunk($xarr,5) as $k => $numarr)
                                                                                                                            <tr>
                                                                                                                                ١
                                                                                                                                --}}{{--@dd(array_chunk($xarr,4),$numarr)--}}{{--
                                                                                                                                --}}{{--                                                            @foreach($numarr as $num)--}}{{--
                                                                                                                                --}}{{--                                                             @foreach($num as $val)--}}{{--
                                                                                                                                --}}{{--                                                                    <td class="truck-td" truck-row="{{$k}}" truck-col="{{$num}}" style="background-color: rgb(255, 255, 255);">{{$num}}</td>--}}{{--
                                                                                                                                --}}{{--                                                             @endforeach--}}{{--
                                                                                                                                --}}{{--                                                            @endforeach--}}{{--
                                                                                                                            </tr>

                                                                                                                        @endforeach
                                                                                                                        </tbody>

                                                                                                                        --}}
                                                            </table>


                                                        </div>
                                                        <div id="truck2" class="truck" style="display: none;">
                                                            <table id="truck-table" cellspacing="0" cellpadding="0" border="1"
                                                                   class="truck-table">
                                                                <tr>
                                                                    <td class="truck-td" truck-row="4" truck-col="0">
                                                                        1
                                                                    </td>
                                                                    <td class="truck-td" truck-row="4" truck-col="1">
                                                                        5
                                                                    </td>
                                                                    <td class="truck-td" truck-row="4" truck-col="2">
                                                                        9
                                                                    </td>
                                                                    <td class="truck-td" truck-row="4" truck-col="3">
                                                                        13
                                                                    </td>
                                                                    <td class="truck-td" truck-row="4" truck-col="4">
                                                                        17
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <td class="truck-td" truck-row="5" truck-col="0">
                                                                        2
                                                                    </td>
                                                                    <td class="truck-td" truck-row="5" truck-col="1">
                                                                        6
                                                                    </td>
                                                                    <td class="truck-td" truck-row="5" truck-col="2">
                                                                        10
                                                                    </td>
                                                                    <td class="truck-td" truck-row="5" truck-col="3">
                                                                        14
                                                                    </td>
                                                                    <td class="truck-td" truck-row="5" truck-col="4">
                                                                        18
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <td class="truck-td" truck-row="6" truck-col="0">
                                                                        3
                                                                    </td>
                                                                    <td class="truck-td" truck-row="6" truck-col="1">
                                                                        7
                                                                    </td>
                                                                    <td class="truck-td" truck-row="6" truck-col="2">
                                                                        11
                                                                    </td>
                                                                    <td class="truck-td" truck-row="6" truck-col="3">
                                                                        15
                                                                    </td>
                                                                    <td class="truck-td" truck-row="6" truck-col="4">
                                                                        19
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <td class="truck-td" truck-row="7" truck-col="0">
                                                                        4
                                                                    </td>
                                                                    <td class="truck-td" truck-row="7" truck-col="1">
                                                                        8
                                                                    </td>
                                                                    <td class="truck-td" truck-row="7" truck-col="2">
                                                                        12
                                                                    </td>
                                                                    <td class="truck-td" truck-row="7" truck-col="3">
                                                                        16
                                                                    </td>
                                                                    <td class="truck-td" truck-row="7" truck-col="4">
                                                                        20
                                                                    </td>
                                                                </tr>
                                                            </table>
                                                        </div>
                                                        <div id="truck3" class="truck" style="display: none;">
                                                            <table id="truck-table" cellspacing="0" cellpadding="0" border="1"
                                                                   class="truck-table">
                                                                <tr>
                                                                    <td class="truck-td" truck-row="8" truck-col="0">
                                                                        1
                                                                    </td>
                                                                    <td class="truck-td" truck-row="8" truck-col="1">
                                                                        5
                                                                    </td>
                                                                    <td class="truck-td" truck-row="8" truck-col="2">
                                                                        9
                                                                    </td>
                                                                    <td class="truck-td" truck-row="8" truck-col="3">
                                                                        13
                                                                    </td>
                                                                    <td class="truck-td" truck-row="8" truck-col="4">
                                                                        17
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <td class="truck-td" truck-row="9" truck-col="0">
                                                                        2
                                                                    </td>
                                                                    <td class="truck-td" truck-row="9" truck-col="1">
                                                                        6
                                                                    </td>
                                                                    <td class="truck-td" truck-row="9" truck-col="2">
                                                                        10
                                                                    </td>
                                                                    <td class="truck-td" truck-row="9" truck-col="3">
                                                                        14
                                                                    </td>
                                                                    <td class="truck-td" truck-row="9" truck-col="4">
                                                                        18
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <td class="truck-td" truck-row="10" truck-col="0">
                                                                        3
                                                                    </td>
                                                                    <td class="truck-td" truck-row="10" truck-col="1">
                                                                        7
                                                                    </td>
                                                                    <td class="truck-td" truck-row="10" truck-col="2">
                                                                        11
                                                                    </td>
                                                                    <td class="truck-td" truck-row="10" truck-col="3">
                                                                        15
                                                                    </td>
                                                                    <td class="truck-td" truck-row="10" truck-col="4">
                                                                        19
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <td class="truck-td" truck-row="11" truck-col="0">
                                                                        4
                                                                    </td>
                                                                    <td class="truck-td" truck-row="11" truck-col="1">
                                                                        8
                                                                    </td>
                                                                    <td class="truck-td" truck-row="11" truck-col="2">
                                                                        12
                                                                    </td>
                                                                    <td class="truck-td" truck-row="11" truck-col="3">
                                                                        16
                                                                    </td>
                                                                    <td class="truck-td" truck-row="11" truck-col="4">
                                                                        20
                                                                    </td>
                                                                </tr>
                                                            </table>
                                                        </div>
                                                    </div>

                                                    <div class="mb-3">
                                            <textarea name="note" rows="5" class="form-control"
                                                      placeholder="@lang('back.note')">{{$booking->note}}</textarea>
                                                    </div>
                                                    <div class="table-responsive">
                                                        <table class="table table-bordered border-dark border-2 mb-0">

                                                            <thead>
                                                            <tr>
                                                                <th style="transform: rotate(-60deg);text-align: center;width: 25%;">
                                                                    <p>عدد الاوردرات</p>
                                                                    <hr style="color: black;">
                                                                    <p>الاوناش</p></th>
                                                                <th>الاوردر الاول</th>
                                                                <th>الاوردر الثاني</th>
                                                                <th>الاوردر الثالث</th>
                                                            </tr>
                                                            </thead>
                                                            <tbody>
                                                            @foreach($vehicleData->whereNotNull('assign_car_id') as $with_drivers)
                                                                <tr>
                                                                    <th scope="row">{{$with_drivers->car_name}}
                                                                        ({{$with_drivers->driver_name}})
                                                                    </th>
                                                                    <td class="table-success text-center display-6"><i
                                                                                class="fas fa-check"></i></td>
                                                                    <td class="table-danger text-center display-6"><i
                                                                                class="far fa-window-close"></i></td>
                                                                    <td class="table-danger text-center display-6"><i
                                                                                class="far fa-window-close"></i></td>
                                                                </tr>
                                                            @endforeach
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </div><!-- end col-lg-6 -->

                                            </div><!-- end row -->
                                        </div>
                                    </section>

                                    <!-- Confirm Details -->
                                    <h3>@lang('back.date_detail_order')</h3>
                                    <section>
                                        <div class="row justify-content-center">

                                            <div class="col-lg-12">
                                                <table class="table table-bordered table-responsive" id="summry"
                                                       style="width: 100%; table-layout: fixed;">
                                                    <tbody>
                                                    <tr>
                                                        <td>
                                                            ميعاد الأوردر
                                                            <input
                                                                    style="line-height:1 !important"
                                                                    required="required" name="booking_at" type="date"
                                                                    class="form-control" value="{{old('booking_at',$booking->booking_at)}}">
                                                        </td>
                                                        <td>
                                                            توقيت الأوردر
                                                            <input
                                                                    style="line-height:1 !important"
                                                                    required="required" name="order_time" type="time"
                                                                    class="form-control" value="{{old('order_time',$booking->order_time)}}">
                                                        </td>
                                                        <td>
                                                            الموافق
                                                            <input name="order_day" type="text" value="{{old('order_day',$booking->order_day)}}"
                                                                   class="form-control" required>
                                                        </td>
                                                        <td>
                                                            حالة الاوردر
                                                            <select name="status" class="form-control" required>
                                                                <option value="">اختر واحدة</option>
                                                                <option {{$booking->status == 'sure' ? 'selected' : ''}} value="sure">مؤكد</option>
                                                                <option {{$booking->status == 'waiting' ? 'selected' : ''}} value="waiting">في الانتظار</option>
                                                                <option {{$booking->status == 'canceled' ? 'selected' : ''}} value="canceled">ملغي</option>
                                                            </select>

                                                        </td>

                                                    </tr>
                                                    </tbody>
                                                </table>
                                            </div><!-- end col-lg-12 -->
                                        </div><!-- end row -->
                                    </section>


                                    <div class="row justify-content-end">
                                    <div class="col-sm-9">
                                        <div class="d-flex flex-wrap gap-3">
                                            <button type="submit"
                                                    class="btn btn-danger waves-effect waves-light w-md">@lang('back.submit')</button>
                                        </div>
                                    </div>
                                </div>

                            </form>
                        </div>


                    </div>


            </div>
        </div>
    </div>

@endsection
@section('js')

    <script src="{{url('acp/libs/select2/js/select2.min.js')}}"></script>

    <script src="{{url('acp/js/create.js')}}"></script>



    <script>

        $(".other").select2({
            tags: true
        });

        // $("span").removeClass("select2-selection__rendered");


        $(".phone_number").inputmask({
            "mask": "019-99-99-99-99"
        });


        $("input[name='nanonal_id']").inputmask({
            "mask": "99-99-99-99-99-99-99"
        });
        var searchRequest = null;


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
                            console.log(JSON.parse(Result)[0]);
                            if (JSON.parse(Result)[0].length > 0) {


                                $(".all_table").css("display", "block");

                                $(".append_ajax").empty();
                                //we need to check if the value is the same
                                $.each(JSON.parse(Result)[0], function (key, value) {
                                    $('.append_ajax').append('<tr><th>' + (key + 1) + '</th><th>' + value.client_name + '</th><th>' + value.client_phone + '</th><th>' + value.created + '</th><th>' + value.from_address + '</th><th>' + value.to_address + '</th><th>' + value.price + '</th><th>' + value.status_lable + '</th><td>' + value.create_by + '</td></tr>');
                                })
                            } else {
                                $(".all_table").css("display", "block");

                                $(".append_ajax").empty();

                                $('.append_ajax').append('<tr><th colspan="11"><div class="alert alert-warning alert-dismissible fade show" role="alert"> @lang('back.no_data') </div></th></tr>');

                                console.log('no data')
                            }
                            if (JSON.parse(Result)[1].length > 0) {


                                $(".all_table_old").css("display", "block");

                                $(".append_ajax_old").empty();
                                //we need to check if the value is the same
                                $.each(JSON.parse(Result)[1], function (key, value) {
                                    $('.append_ajax_old').append('<tr><th>' + (key + 1) + '</th><th>' + value.client_name + '</th><th>' + value.phone1 + '</th><th>' + value.created_at + '</th><th>' + value.from_detail + '</th><th>' + value.to_detail + '</th><th>' + value.totalafterAll + '</th></tr>');
                                })
                            } else {
                                $(".all_table_old").css("display", "block");

                                $(".append_ajax_old").empty();

                                $('.append_ajax_old').append('<tr><th colspan="11"><div class="alert alert-warning alert-dismissible fade show" role="alert"> @lang('back.no_data') </div></th></tr>');

                                console.log('no data')
                            }
                        }
                    });
                }
            });
        });

        $(function () {

            $(".count_num").keyup(function () {
                var matches = 0;
                $(".count_num").each(function (i, val) {
                    if ($(this).val() != "") {
                        matches++;
                    }
                });
                $("span#client_services_num").text(matches);

                var calculated_total_sum = 0;

                $(".total").each(function () {
                    var get_textbox_value = $(this).val();
                    if ($.isNumeric(get_textbox_value)) {
                        calculated_total_sum += parseFloat(get_textbox_value);
                    }
                });
                $("span#totalafterAlltext").text(calculated_total_sum);
                $("#totalafterAll").val(calculated_total_sum);
            }).keyup();

            $(".total").keyup(function () {
                var calculated_total_sum = 0;

                $(".total").each(function () {
                    var get_textbox_value = $(this).val();
                    if ($.isNumeric(get_textbox_value)) {
                        calculated_total_sum += parseFloat(get_textbox_value);
                    }
                });
                $("span#totalafterAlltext").text(calculated_total_sum);
                $("#totalafterAll").val(calculated_total_sum);

            }).keyup();


            // increese
        });


        $(document).ready(function () {

            $(".discount").change(function () {
                var discount = parseFloat($("#totalafterAll").val()) - parseFloat(this.value)
                $("#totalafterAll").val(discount);
                $("span#totalafterAlltext").text(discount);
            });
            $(".increese").change(function () {
                var increese = parseFloat($("#totalafterAll").val()) + parseFloat(this.value);
                $("#totalafterAll").val(increese);
                $("span#totalafterAlltext").text(increese);
            });

            $(".tips").change(function () {
                var tips = parseFloat($("#totalafterAll").val()) + parseFloat(this.value);
                $("#totalafterAll").val(tips);
                $("span#totalafterAlltext").text(tips);
            });

        });



        $(document).ready(function () {


            $('input[name="booking_at"]').on('change', function () {
                // console.log($(this).val());
                // Date.setClientTimezoneOffset(300) ;
                var order_date = $(this).val()
                order_date = order_date.split('-');
                // console.log(order_date[0]+order_date[1]+order_date[2]);
                var d = new Date(order_date[0], order_date[1] - 1, order_date[2]);

                //console.log(d);
                //console.log(d.getDay({timeZone: "Africa/Cairo"}));
                var weekday = new Array(7);
                weekday[0] = "الأحد";
                weekday[1] = "الإثنين";
                weekday[2] = "الثلاثاء";
                weekday[3] = "الأربعاء";
                weekday[4] = "الخميس";
                weekday[5] = "الجمعه";
                weekday[6] = "السبت";

                $('input[name="order_day"]').val(weekday[d.getDay({timeZone: "Africa/Cairo"})]);

            });


            function getAge(birth) {
                ageMS = Date.parse(Date()) - Date.parse(birth);
                age = new Date();
                age.setTime(ageMS);
                ageYear = age.getFullYear() - 1970;

                return ageYear;

                // ageMonth = age.getMonth(); // Accurate calculation of the month part of the age
                // ageDay = age.getDate();    // Approximate calculation of the day part of the age
            }


            function isEven(n) {
                return n % 2 == 0;
            }

            function isOdd(n) {
                return Math.abs(n % 2) == 1;
            }


            $("input[name='nanonal_id']").on('keyup', function (e) {

                // console.log(this.value);
                var value = this.value;

                var birth;
                var type;
                var region;
                value = value.replace(/-/g, '');
                value = value.replace(/_/g, '');
                value = String(value);


                if (value.length == 14) {
                    //    console.log("enter");
                    if (value[0] == 2) {
                        birth = "19";
                    } else
                        birth = "20";
                    birth += value[1] + value[2] + "/" + value[3] + value[4] + "/" + value[5] + value[6];
                    if (isEven(value[12])) {
                        type = "أنثي ";
                    }
                    if (isOdd(value[12])) {
                        type = " ذكر";
                    }
                    var temp = value[7] + value[8];

                    if (temp == "01") {
                        region = "القاهرة";
                    } else if (temp == '02') {
                        region = 'الإسكندرية';
                    } else if (temp == '03') {
                        region = 'بورسعيد';
                    } else if (temp == '04') {
                        region = 'السويس';
                    } else if (temp == '11') {
                        region = 'دمياط';
                    } else if (temp == '12') {
                        region = 'الدقهلية';
                    } else if (temp == '13') {
                        region = 'الشرقية';
                    } else if (temp == '14') {
                        region = 'القليوبية';
                    } else if (temp == '15') {
                        region = 'كفر الشيخ';
                    } else if (temp == '16') {
                        region = 'الغربية';
                    } else if (temp == '17') {
                        region = 'المنوفية	';
                    } else if (temp == '18') {
                        region = 'البحيرة';
                    } else if (temp == '18') {
                        region = 'الإسماعيلية';
                    } else if (temp == '21') {
                        region = 'الجيزة';
                    } else if (temp == '22') {
                        region = 'بني سويف';
                    } else if (temp == '23') {
                        region = 'الفيوم';
                    } else if (temp == '24') {
                        region = 'المنيا';
                    } else if (temp == '25') {
                        region = 'أسيوط';
                    } else if (temp == '26') {
                        region = 'سوهاج';
                    } else if (temp == '27') {
                        region = 'قنا';
                    } else if (temp == '28') {
                        region = 'أسوان';
                    } else if (temp == '39') {
                        region = 'الأقصر';
                    } else if (temp == '31') {
                        region = 'البحر الأحمر';
                    } else if (temp == '32') {
                        region = 'الوادى الجديد';
                    } else if (temp == '33') {
                        region = 'مطروح';
                    } else if (temp == '34') {
                        region = 'شمال سيناء';
                    } else if (temp == '35') {
                        region = 'جنوب سيناء';
                    } else if (temp == '88') {
                        region = 'خارج الجمهورية';
                    }

                    document.getElementById('national_number_result2').innerHTML = "<div class='alert alert-info'><center><strong>النوع : " + type + " </strong></center><br><center><strong>تاريخ الميلاد : " + birth + " </strong></center><br><center><strong> محل الميلاد :  " + region + " </strong></center><br><center><strong> السن :   " + getAge(birth) + " </strong></center></div>";
                } else {

                    document.getElementById('national_number_result2').innerHTML = "<div class='alert alert-danger'><center><strong>الرقم الذي ادخلته غير صحيح يمكنك المحاولة مرة اخري </strong></center></div>";
                }


            });

        });
    </script>

@endsection
