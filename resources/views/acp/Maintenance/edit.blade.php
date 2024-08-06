@extends('acp.layout.app')

@section('title')
    @lang('back.edit') @lang('back.maintenance')
@endsection
@section('content')

    <!-- start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-flex align-items-center justify-content-between">
                <h4 class="mb-0">@lang('back.edit') @lang('back.maintenance')</h4>

                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item active">@lang('back.edit') @lang('back.maintenance')</li>
                        <li class="breadcrumb-item ">@lang('back.periodic_maintenance')</li>
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

                    <div class="row">
                        <div class="col-lg-12">

                                <form method="post" action="{{route('maintenances.update',$maintenances->id)}}" class="custom-validation">
                                    @csrf
                                    <div class="row">
                                        <div class="col-lg-6">
                                            <div class="mt-5 mt-lg-4">
                                                <div class="row mb-4">
                                                    <label for="horizontal-Fullname-input"
                                                           class="col-sm-4 col-form-label">@lang('back.damaged') *</label>
                                                    <div class="col-sm-8">
                                                        <input type="text" class="form-control" id="horizontal-Fullname-input"
                                                               value="{{old('damaged',$maintenances->damaged)}}" required
                                                               placeholder="@lang('back.damaged')"
                                                               name="damaged">
                                                    </div>
                                                </div>
                                                <div class="row mb-4">
                                                    <label for="horizontal-Fullname-input"
                                                           class="col-sm-4 col-form-label">@lang('back.cost_maintenance') *</label>
                                                    <div class="col-sm-8">
                                                        <input type="number" class="form-control" id="horizontal-Fullname-input"
                                                               value="{{old('cost_maintenance',$maintenances->cost_maintenance)}}" required
                                                               placeholder="@lang('back.cost_maintenance')"
                                                               name="cost_maintenance">
                                                    </div>
                                                </div>


                                                <div class="row mb-4">
                                                    <label for="horizontal-Fullname-input"
                                                           class="col-sm-4 col-form-label">@lang('back.maintenance_manager') *</label>
                                                    <div class="col-sm-8">
                                                        <select name="maintenance_manager" class="form-control" required>
                                                            <option value="">@lang('back.select_one')</option>
                                                            @foreach($drivers as $driver)
                                                                <option value="{{$driver->id}}" {{$maintenances->maintenance_manager == $driver->id ? 'selected' : ''}} >{{$driver->name}}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>





                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="mt-5 mt-lg-4">
                                                <div class="row mb-4">
                                                    <label for="horizontal-Fullname-input"
                                                           class="col-sm-4 col-form-label">@lang('back.maintenance_date') *</label>
                                                    <div class="col-sm-8">
                                                        <input type="date" class="form-control" id="horizontal-Fullname-input"
                                                               value="{{old('maintenance_date',$maintenances->maintenance_date)}}" required
                                                               placeholder="@lang('back.maintenance_date')"
                                                               name="maintenance_date">
                                                    </div>
                                                </div>
                                                <div class="row mb-4">
                                                    <label for="horizontal-Fullname-input"
                                                           class="col-sm-4 col-form-label">@lang('back.counter_number') *</label>
                                                    <div class="col-sm-8">
                                                        <input type="number" class="form-control" id="horizontal-Fullname-input"
                                                               value="{{old('counter_number',$maintenances->counter_number)}}" required
                                                               placeholder="@lang('back.counter_number')"
                                                               name="counter_number">
                                                    </div>
                                                </div>



                                                <div class="row mb-4">
                                                    <label for="horizontal-Fullname-input"
                                                           class="col-sm-4 col-form-label">@lang('back.vehicle') *</label>
                                                    <div class="col-sm-8">
                                                        <select name="vehicle_id" class="form-control" required>
                                                            <option value="">@lang('back.select_one')</option>
                                                            @foreach($vehicles as $vehicle)
                                                                <option value="{{$vehicle->id}}" {{$maintenances->vehicle_id == $vehicle->id ? 'selected' : ''}} >{{$vehicle->car_name}}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>



                                                <div class="row justify-content-end">
                                                    <div class="col-sm-9">
                                                        <div class="d-flex flex-wrap gap-3">
                                                            <button type="submit"
                                                                    class="btn btn-primary waves-effect waves-light w-md">@lang('back.submit')</button>
                                                        </div>
                                                    </div>
                                                </div>
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

@endsection
