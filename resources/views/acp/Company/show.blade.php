@extends('acp.layout.app')

@section('title')
    @lang('back.report') @lang('back.companies') {{$company->name}}
@endsection

@section('content')

    <!-- start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-flex align-items-center justify-content-between">
                <h4 class="mb-0">@lang('back.report') @lang('back.companies') {{$company->name}}</h4>

                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item active">@lang('back.report') @lang('back.companies') {{$company->name}}</li>
                        <li class="breadcrumb-item">@lang('back.companies')</li>
                        <li class="breadcrumb-item ">@lang('back.dashborad')</li>
                    </ol>
                </div>

            </div>
        </div>
    </div>
    <!-- end page title -->

    <div class="row">
        <div class="col-12">
            @if(Session::has('msg'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <i class="uil uil-check me-2"></i>
                    {!! session('msg') !!}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">

                    </button>
                </div>

            @endif

            <div class="card bg-soft-warning border-warning">
                <div class="card-body">
                    <h6 class="card-text">@lang('back.bookings') @lang('back.export')</h6>
                    <h5 class="card-text">@lang('back.total_revenue') {{$bookings->where('type_company','export')->sum(['price'])}} @lang('back.L.E')</h5>

                    <div class="table-responsive">
                        <table class="table table-nowrap table-centered mb-0">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>@lang('back.employee')</th>
                                <th>@lang('back.client_name')</th>
                                <th>@lang('back.client_whatsapp')</th>
                                <th>@lang('back.client_phone')</th>
                                <th>@lang('back.from_area')</th>
                                <th>@lang('back.to_area')</th>
                                <th>@lang('back.KM')</th>
                                <th>@lang('back.type_car')</th>
                                <th>@lang('back.vehicle_status')</th>
                                <th>@lang('back.price')</th>
                                <th>@lang('back.action')</th>
                            </tr>
                            </thead>


                            <tbody>
                            @foreach($bookings->where('type_company','export') as $key => $booking)
                                <tr>
                                    <td>{{$key+1}}</td>
                                    <td>{{$booking->user->name}}</td>
                                    <td>{{$booking->client_name}}</td>
                                    <td>
                                        <a href="https://wa.me/+2{{Str::replace('-','',$booking->client_phone)}}?text=اهلا بك"
                                           target="_blank">
                                            <div class="avatar-sm">
                                                    <span
                                                            class="avatar-title bg-soft-success text-success font-size-25 rounded-circle">
                                                        <i class="fab fa-whatsapp" style="font-size:35px;"></i>
                                                    </span>
                                            </div>
                                        </a>
                                    </td>
                                    <td>{{$booking->client_phone}}</td>
                                    <td>{{$booking->fromArea->name}}</td>
                                    <td>{{$booking->toArea->name}}</td>
                                    <td>{{$booking->km}}</td>
                                    <td>@lang('back.'.$booking->vehicle_type)</td>
                                    <td>@lang('back.'.$booking->vehicle_status)</td>
                                    <td>{{$booking->price}}@lang('back.L.E')</td>
                                    <td style="width: 100px">
                                        {{--<button type="button" class="btn btn-outline-danger btn-sm"
                                                data-bs-toggle="modal" data-bs-target="#myModal{{$booking->id}}"
                                                title="@lang('back.canceled')"><i class="fas fa-times"></i></button>
                                        <a href="{{route('bookings.edit',$booking->id)}}"
                                           class="btn btn-outline-warning btn-sm"
                                           title="@lang('back.edit')"><i class="fas fa-pencil-alt"></i></a>--}}
                                        <a href="{{route('bookings.show',$booking->id)}}"
                                           class="btn btn-outline-info btn-sm"
                                           title="@lang('back.show')"><i class="fas fa-eye"></i></a>
                                    </td>
                                </tr>

                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div> <!-- end col -->
    </div> <!-- end row -->

    <div class="row">
        <div class="col-12">
            <div class="card bg-soft-info border-info">
                <div class="card-body">
                    <h6 class="card-text">@lang('back.bookings') @lang('back.take')</h6>
                    <h5 class="card-text">@lang('back.total_revenue') {{$bookings->where('type_company','take')->sum(['price'])}} @lang('back.L.E')</h5>

                    <div class="table-responsive">
                        <table class="table table-nowrap table-centered mb-0">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>@lang('back.employee')</th>
                                <th>@lang('back.client_name')</th>
                                <th>@lang('back.client_whatsapp')</th>
                                <th>@lang('back.client_phone')</th>
                                <th>@lang('back.from_area')</th>
                                <th>@lang('back.to_area')</th>
                                <th>@lang('back.KM')</th>
                                <th>@lang('back.type_car')</th>
                                <th>@lang('back.vehicle_status')</th>
                                <th>@lang('back.price')</th>
                                <th>@lang('back.action')</th>
                            </tr>
                            </thead>


                            <tbody>
                            @foreach($bookings->where('type_company','take') as $key => $booking)
                                <tr>
                                    <td>{{$key+1}}</td>
                                    <td>{{$booking->user->name}}</td>
                                    <td>{{$booking->client_name}}</td>
                                    <td>
                                        <a href="https://wa.me/+2{{Str::replace('-','',$booking->client_phone)}}?text=اهلا بك"
                                           target="_blank">
                                            <div class="avatar-sm">
                                                    <span
                                                            class="avatar-title bg-soft-success text-success font-size-25 rounded-circle">
                                                        <i class="fab fa-whatsapp" style="font-size:35px;"></i>
                                                    </span>
                                            </div>
                                        </a>
                                    </td>
                                    <td>{{$booking->client_phone}}</td>
                                    <td>{{$booking->fromArea->name}}</td>
                                    <td>{{$booking->toArea->name}}</td>
                                    <td>{{$booking->km}}</td>
                                    <td>@lang('back.'.$booking->vehicle_type)</td>
                                    <td>@lang('back.'.$booking->vehicle_status)</td>
                                    <td>{{$booking->price}}@lang('back.L.E')</td>
                                    <td style="width: 100px">
                                        {{--<button type="button" class="btn btn-outline-danger btn-sm"
                                                data-bs-toggle="modal" data-bs-target="#myModal{{$booking->id}}"
                                                title="@lang('back.canceled')"><i class="fas fa-times"></i></button>
                                        <a href="{{route('bookings.edit',$booking->id)}}"
                                           class="btn btn-outline-warning btn-sm"
                                           title="@lang('back.edit')"><i class="fas fa-pencil-alt"></i></a>--}}
                                        <a href="{{route('bookings.show',$booking->id)}}"
                                           class="btn btn-outline-info btn-sm"
                                           title="@lang('back.show')"><i class="fas fa-eye"></i></a>
                                    </td>
                                </tr>

                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div> <!-- end col -->
    </div> <!-- end row -->

@endsection

