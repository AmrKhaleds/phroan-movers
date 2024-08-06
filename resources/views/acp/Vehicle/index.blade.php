@extends('acp.layout.app')

@section('title')
    @lang('back.vehicles')
@endsection

@section('css')
    <link href="{{url('acp/libs/admin-resources/rwd-table/rwd-table.min.css')}}" rel="stylesheet" type="text/css"/>
@endsection

@section('content')

    <!-- start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-flex align-items-center justify-content-between">
                <h4 class="mb-0">@lang('back.vehicles')</h4>

                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item active">@lang('back.vehicles')</li>
                        <li class="breadcrumb-item ">@lang('back.dashborad')</li>
                    </ol>
                </div>

            </div>
        </div>
    </div>
    <!-- end page title -->

    <div class="row">
        <div class="col-12">
            <div class="card">
                @if(Session::has('msg'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <i class="uil uil-check me-2"></i>
                        {!! session('msg') !!}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">

                        </button>
                    </div>

                @endif
                <div class="card-body">
                    <a href="{{route('vehicles.create')}}" class="btn btn-primary waves-effect waves-light">
                        @lang('back.create') @lang('back.vehicle') <i class="uil uil-plus-square ms-2"></i>
                    </a>
                    <div class="table-responsive">
                        <table class="table table-nowrap table-centered mb-0">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>@lang('back.car_name')</th>
                                <th>@lang('back.type_car')</th>
                                <th>@lang('back.model_car')</th>
                                <th>@lang('back.vehicle_number')</th>
                                <th>@lang('back.license_num')</th>
                                <th>@lang('back.license_to')</th>
                                <th>@lang('back.vehicle_status')</th>
                                <th>@lang('back.action')</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($vehicles as $key => $vehicle)
                                <tr>
                                    <td>{{$key+1}}</td>
                                    <td>{{$vehicle->car_name}}</td>
                                    <td>@lang('back.'.$vehicle->type_car)</td>
                                    <td>{{$vehicle->model_car}}</td>
                                    <td>{{$vehicle->vehicle_number}}</td>
                                    <td>{{$vehicle->license_num}}</td>
                                    <td>{{$vehicle->license_to}}</td>
                                    <td>
                                        <select name="" class="form-control" onchange="location = this.value;">
                                            <option value="" selected>@lang('back.select_one')</option>
                                            <option value="{{route('vehicles.status',[$vehicle->id,'damage'])}}" {{$vehicle->status == 'damage' ? 'selected' : ''}} >@lang('back.damage')</option>
                                            <option value="{{route('vehicles.status',[$vehicle->id,'available'])}}" {{$vehicle->status == 'available' ? 'selected' : ''}} >@lang('back.avalble')</option>
                                            <option value="{{route('vehicles.status',[$vehicle->id,'garage'])}}" {{$vehicle->status == 'garage' ? 'selected' : ''}} >@lang('back.garage')</option>

                                        </select>
                                    </td>
                                    <td style="width: 15%">
                                        <a href="{{route('vehicles.edit',$vehicle->id)}}"
                                           class="btn btn-outline-warning btn-sm" title="@lang('back.edit')">
                                            <i class="fas fa-pencil-alt"></i>
                                        </a>
                                        <a href="{{route('vehicles.destroy',$vehicle->id)}}"
                                           class="btn btn-outline-danger btn-sm" title="@lang('back.delete')">
                                            <i class="fas fa-times"></i>
                                        </a>
                                        <a href="{{route('assign_cars.index',$vehicle->id)}}"
                                           class="btn btn-outline-info btn-sm" title="@lang('back.assign_cars')">
                                            <i class="fas fa-random"></i>
                                        </a>
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
@section('js')

    <!-- Responsive Table js -->
    <script src="{{url('acp/libs/admin-resources/rwd-table/rwd-table.min.js')}}"></script>

    <!-- Init js -->
    <script src="{{url('acp/js/pages/table-responsive.init.js')}}"></script>

@endsection

