@extends('acp.layout.app')

@section('title')
    @lang('back.report_tracking')
@endsection
@section('content')

    <!-- start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-flex align-items-center justify-content-between">
                <h4 class="mb-0">@lang('back.report_tracking')</h4>

                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item active">@lang('back.report_tracking')</li>
                        <li class="breadcrumb-item ">@lang('back.dashborad')</li>
                    </ol>
                </div>

            </div>
        </div>

    </div>
    <!-- end page title -->

    <!-- start page title -->
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">@lang('back.search_box')</h4>

                    <div class="row">
                        <div class="col-lg-12">
                            <div class="mt-4">

                                <form action="{{route('report.tracking')}}?">

                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label class="form-label" for="formrow-email-input">@lang('back.from_date')</label>
                                                <input type="date" class="form-control" id="formrow-email-input" value="{{old('from_date',$request->from_date)}}" placeholder="@lang('back.from_date')" name="from_date">
                                            </div>
                                            <div class="mb-3">
                                                <label class="form-label" for="formrow-password-input">@lang('back.shift')</label>
                                                <select name="shift" class="form-control">
                                                    <option {{nBetween(date('H'), getSetting('last_shift')->value, getSetting('start_shift')->value) == true? 'selected' : ''}}  value="morning">@lang('back.morning')</option>
                                                    <option {{nBetween(date('H'), getSetting('last_shift')->value, getSetting('start_shift')->value) == false? 'selected' : ''}}  value="night">@lang('back.night')</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label class="form-label" for="formrow-email-input">@lang('back.to_date')</label>
                                                <input type="date" class="form-control" id="formrow-email-input" value="{{old(date('Y-m-d'),$request->to_date)}}" placeholder="@lang('back.to_date')" name="to_date">
                                            </div>

                                            <div class="d-flex flex-wrap gap-3 mt-3 mb-3">
                                                <button type="submit" class="btn btn-primary waves-effect waves-light w-md">@lang('back.search')</button>
                                            </div>
                                        </div>
                                    </div>




                                </form>
                            </div>
                        </div>
                    </div>



                </div>
            </div>
        </div>
    </div>
    <!-- end page title -->


    <div class="row">
        <div class="col-12">
            <div class="card ">
                <div class="card-body">

                    <h6 class="card-text">@lang('back.report_tracking') {!! nBetween(date('H'), getSetting('last_shift')->value, getSetting('start_shift')->value) ? '<span class="badge rounded-pill bg-soft-warning text-warning"><i class="uil-sun"></i> '.__('back.morning').' </span>' : '<span class="badge rounded-pill bg-soft-info text-info"><i class="uil-moon"></i> '.__('back.night').' </span>' !!}</h6>

                    <div class="row">
                        <div class="col-md-12">

                            <div class="table-responsive">

                                <table class="table table-sm mb-0">

                                    <thead class="table-light">
                                    <tr>
                                        <th>#</th>
                                        <th>@lang('back.drivrer_name')</th>
                                        <th>@lang('back.bookings')</th>
                                        <th>@lang('back.total_expenses')</th>
                                        <th>@lang('back.net_income')</th>

                                    </tr>
                                    </thead>
                                    <tbody>
                                    @php
                                        $expense_price = 0;
                                        $price = 0;
                                    @endphp
                                    @foreach($data as $key2 => $car)
                                        @php
                                            $expense_price += $car->first()->order_expense ? $car->first()->order_expense->where('expense_type','expense')->sum('cost') : 0;
                                            $price += $car->sum(['price']);
                                        @endphp
                                        <tr>
                                            <th scope="row">{{$key2+1}}</th>
                                            <td width="15%">{{$car->first()->assign->user->name}} <br>
                                                <p class="text-danger ">{{$car->sum(['price'])}} @lang('back.L.E')</p>
                                            </td>
                                            <td width="40%">
                                                @foreach($car as $k => $value)

                                                    <dl class="row mb-0">
                                                        <dt class="col-sm-3">@lang('back.client_name')</dt>
                                                        <dd class="col-sm-9">{{$value->client_name}}</dd>

                                                        <dt class="col-sm-3">@lang('back.client_phone')</dt>
                                                        <dd class="col-sm-9">{{$value->client_phone}}</dd>

                                                        <dt class="col-sm-3">@lang('back.from_area')</dt>
                                                        <dd class="col-sm-9">{{$value->fromArea->name}}</dd>

                                                        <dt class="col-sm-3">@lang('back.to_area')</dt>
                                                        <dd class="col-sm-9">{{$value->toArea->name}}</dd>

                                                        <dt class="col-sm-3">@lang('back.KM')</dt>
                                                        <dd class="col-sm-9">{{$value->km}}</dd>

                                                        <dt class="col-sm-3">@lang('back.price')</dt>
                                                        <dd class="col-sm-9">{{$value->price}}@lang('back.L.E')</dd>

                                                    </dl>
                                                    <hr>
                                                @endforeach
                                                {{--
                                                <div class="table-responsive" style="overflow: inherit;">
                                                    <table class="table table-nowrap table-centered table-sm mb-0"
                                                           style="overflow: inherit;">
                                                        <thead>
                                                        <tr>
                                                            <th class="text-center">#</th>
                                                            <th class="text-center">@lang('back.client_name')</th>
                                                            <th class="text-center">@lang('back.client_phone')</th>
                                                            <th class="text-center">@lang('back.from_area')</th>
                                                            <th class="text-center">@lang('back.to_area')</th>
                                                            <th class="text-center">@lang('back.KM')</th>
                                                            <th class="text-center">@lang('back.price')</th>

                                                        </tr>
                                                        </thead>


                                                        <tbody>
                                                        @foreach($car as $k => $value)

                                                            <tr>
                                                                <td class="text-center">{{$k+1}}</td>
                                                                <td class="text-center">{{$value->client_name}}</td>
                                                                <td class="text-center">{{$value->client_phone}}</td>
                                                                <td class="text-center">{{$value->fromArea->name}}</td>
                                                                <td class="text-center">{{$value->toArea->name}}</td>
                                                                <td class="text-center">{{$value->km}}</td>
                                                                <td class="text-center">{{$value->price}}@lang('back.L.E')</td>
                                                            </tr>
                                                        @endforeach
                                                        </tbody>
                                                    </table>
                                                </div>

--}}
                                            </td>

                                            <td width="15%">
                                                <!-- Large modal -->
                                                <button type="button" class="btn btn-success waves-effect waves-light"
                                                        data-bs-toggle="modal"
                                                        data-bs-target=".bs-example-modal-lg{{$key2+1}}">{{$car->first()->order_expense->where('expense_type','expense')->sum('cost')}} @lang('back.L.E')</button>
                                            </td>
                                            <td width="15%">
                                                {{$car->sum(['price']) - $car->first()->order_expense->where('expense_type','expense')->sum('cost')}}  @lang('back.L.E')</td>

                                        </tr>
                                        <tr>

                                            <td colspan="5">

                                            <!--  Large modal example -->
                                            <div class="modal fade bs-example-modal-lg{{$key2+1}}" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
                                                <div class="modal-dialog modal-lg">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="myLargeModalLabel">@lang('back.dailse_expenses')</h5>
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                                                            </button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <table class="table mb-0">

                                                                <thead>
                                                                <tr>
                                                                    <th>#</th>
                                                                    <th>@lang('back.reason')</th>
                                                                    <th>@lang('back.cost')</th>
                                                                </tr>
                                                                </thead>
                                                                <tbody>
                                                                @foreach($car->first()->order_expense->where('expense_type','expense') as $key_expense => $expense)

                                                                <tr>
                                                                    <th scope="row">{{$key_expense+1}}</th>
                                                                    <td>{{$expense->reason}}</td>
                                                                    <td>{{$expense->cost}}</td>
                                                                </tr>
                                                                @endforeach

                                                                </tbody>
                                                            </table>
                                                        </div>
                                                    </div><!-- /.modal-content -->
                                                </div><!-- /.modal-dialog -->
                                            </div><!-- /.modal -->
                                            </td>

                                        </tr>


                                    @endforeach

                                    <tr>


                                        <td colspan="3" style="font-weight: bolder;background-color: mediumturquoise;color: white;font-size: 25px;">@lang('back.net_total')</td>
                                        <td style="font-weight: bolder;background-color: mediumturquoise;color: white;font-size: 25px;">
                                            <strong>
                                                <strong>{{$expense_price}} @lang('back.L.E')</strong>
                                            </strong>
                                        </td>
                                        <td style="font-weight: bolder;background-color: mediumturquoise;color: white;font-size: 25px;">
                                            <strong>{{$price}} @lang('back.L.E')</strong>
                                        </td>
                                    </tr>

                                    </tbody>
                                </table>
                            </div>


                        </div>


                    </div>

                </div><!-- end row -->
            </div><!-- end card-body -->
        </div><!-- end card -->
    </div><!-- end col -->



@endsection