@extends('acp.layout.app')

@section('title')
    @lang('back.trakings')
@endsection

@section('css')

    <!-- Sweet Alert-->
    <link href="{{url('acp/libs/sweetalert2/sweetalert2.min.css')}}" rel="stylesheet" type="text/css"/>
    <link href="{{url('acp/libs/select2/css/select2.min.css')}}" rel="stylesheet" type="text/css"/>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>

    <style>
        .digital-clock {
            margin: auto;
            top: 0;
            left: 0;
            bottom: 0;
            right: 0;
            height: 55px;
            border: 0px solid #999;
            border-radius: 4px;
            text-align: center;
            font-size: 20px;
        }

        .date {
            margin: auto;
            top: 0;
            left: 0;
            bottom: 0;
            right: 0;
            width: 300px;
            height: 55px;
            color: #ffffff;
            border: 0px solid #999;
            border-radius: 4px;
            text-align: center;
            font: 50px/60px 'DIGITAL', Helvetica;
            background: #d88800;
        }
    </style>
@endsection

@section('content')

    <!-- start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-flex align-items-center justify-content-between">
                <h4 class="mb-0">@lang('back.trakings')</h4>

                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item active">@lang('back.trakings')</li>
                        <li class="breadcrumb-item ">@lang('back.dashborad')</li>
                    </ol>
                </div>

            </div>
        </div>
    </div>
    <!-- end page title -->

    <!-- start page title -->
    <div class="row mb-3">

        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="row">

                        <div class="d-flex flex-wrap gap-3 align-items-center justify-content-center mt-3">
                            <div class="btn-group btn-group-lg" role="group" aria-label="Basic example">
                                @foreach($date_array as $date)

                                    <a href="{{route('trakings.index')}}?date={{$date[0]}}"
                                       class="btn btn-{{$date[0] == \Carbon\Carbon::now()->format('Y-m-d') || $date[0] == $request->date  ? '' : 'outline-'}}warning">{{$date[0]}}
                                        <br>{{$date[1]}}</a>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- end page title -->
    {{--@dd(nBetween(date('H'), getSetting('last_shift')->value, getSetting('start_shift')->value),getSetting('start_shift')->value > date('H') &&  getSetting('last_shift')->value  < date('H') ,date('H') , getSetting('start_shift')->value ,getSetting('last_shift')->value)--}}
    <div class="row">
        <div class="col-xl-6">
            <div class="card">
                <div class="card-body" style="min-height: 242px;">
                    <div class="row">
                        {{--                        <div class="digital-clock text-dark">@lang('back.traking') @lang('back.shift') {!! nBetween(date('H'), getSetting('last_shift')->value, getSetting('start_shift')->value) ? '<span class="badge rounded-pill bg-soft-warning text-warning"><i class="uil-sun"></i> '.__('back.morning').' </span>' : '<span class="badge rounded-pill bg-soft-info text-info"><i class="uil-moon"></i> '.__('back.night').' </span>' !!} </div>--}}
                        <div class="col-8">
                            <h6 class="card-text text-dark">@lang('back.trakings') </h6>
                            <h6 class="card-text text-info"> @lang('back.total') @lang('back.bookings')
                                = {{$bookings->whereNotNull('assign_car_id')->count()}}
                                : @lang('back.total') @lang('back.price')
                                = {{$bookings->whereNotNull('assign_car_id')->sum(['price']) - $expenses}} @lang('back.L.E')</h6>
                            <h6 class="card-text text-danger"> @lang('back.total') @lang('back.bookings') @lang('back.canceled')
                                = {{$bookings->where('status','canceled')->count()}}
                                : @lang('back.total') @lang('back.price')
                                = {{$bookings->where('status','canceled')->sum(['price'])}} @lang('back.L.E') </h6>
                        </div>
                        <div class="col-4">
                            <h6 class="card-text text-success"><i
                                        class="fas fa-car"></i> @lang('back.vehicles') @lang('back.avalble')
                                = {{$vehicles->where('status','available')->count()}}</h6>
                            <h6 class="card-text text-warning"><i
                                        class="fas fa-car-crash"></i> @lang('back.vehicles') @lang('back.damage')
                                = {{$vehicles->where('status','damage')->count()}}</h6>
                            <h6 class="card-text text-primary"><i
                                        class="fas fa-parking"></i> @lang('back.vehicles') @lang('back.garage')
                                = {{$vehicles->where('status','garage')->count()}}</h6>
                        </div>
                    </div>
                    <br>
                    <div class="row">
                        <div class="col-4">
                            <span class="badge bg-warning" style="font-size: 120%;width: 100%;">
                            الايرادات <br>
                            <h3 class="text-light">{{$bookings->whereNotNull('assign_car_id')->sum(['price'])}} ج.م</h3>
                            </span>
                        </div>
                        <div class="col-4">
                            <span class="badge bg-danger" style="font-size: 120%;width: 100%;">
                            المصروف <br>
                            <h3 class="text-light">{{$expenses}}</h3>
                            </span>
                        </div>
                        <div class="col-4">
                            <span class="badge bg-success" style="font-size: 120%;width: 100%;">
                            صافي الدخل <br>
                            <h3 class="text-light">{{$bookings->whereNotNull('assign_car_id')->sum(['price']) - $expenses}} ج.م</h3>
                            </span>
                        </div>
                    </div>


                </div>
            </div>
        </div> <!-- end col -->
        <div class="col-xl-6">
            <div class="card">
                <div class="card-body text-center">
                    <h5 class="card-title">@lang('back.target')</h5>
                    <div class="row">

                        <div class="col-6">

                            <a class="btn btn-warning" data-bs-toggle="offcanvas" href="#offcanvasExample"
                               role="button"
                               aria-controls="offcanvasExample">
                                @lang('back.cranes')
                            </a>

                            <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasExample"
                                 aria-labelledby="offcanvasExampleLabel">
                                <div class="offcanvas-header">
                                    <h5 class="offcanvas-title" id="offcanvasExampleLabel">@lang('back.cranes')</h5>
                                    <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas"
                                            aria-label="Close"></button>
                                </div>
                                <div class="offcanvas-body">
                                    <div class="accordion accordion-flush" id="accordionFlushExample">

                                        <div class="accordion-item">
                                            <h2 class="accordion-header" id="flush-headingTwo">
                                                <button class="accordion-button collapsed" type="button"
                                                        data-bs-toggle="collapse"
                                                        data-bs-target="#flush-collapseTwo"
                                                        aria-expanded="false" aria-controls="flush-collapseTwo">
                                                    @lang('back.cranes_available')
                                                    ({{$vehicleData->where('status','available')->count()}})
                                                </button>
                                            </h2>
                                            <div id="flush-collapseTwo" class="accordion-collapse collapse show"
                                                 aria-labelledby="flush-headingTwo"
                                                 data-bs-parent="#accordionFlushExample">
                                                <div class="accordion-body">
                                                    @foreach($vehicleData->where('status','available') as $available)
                                                        <div class="row">
                                                            <div class="col-6">
                                                                <h6>{{$available->car_name}} {{$available->vehicle_number}}</h6>
                                                            </div>
                                                            <div class="col-6">
                                                                <a href="{{route('vehicles.status',[$available->id,'garage'])}}"
                                                                   class="btn btn-success btn-rounded waves-effect waves-light">
                                                                    @lang('back.garage')
                                                                </a>
                                                            </div>
                                                        </div>
                                                        <hr>
                                                    @endforeach

                                                </div>
                                            </div>
                                        </div>

                                        <div class="accordion-item">
                                            <h2 class="accordion-header" id="flush-headingThree">
                                                <button class="accordion-button collapsed" type="button"
                                                        data-bs-toggle="collapse"
                                                        data-bs-target="#flush-collapseThree"
                                                        aria-expanded="false" aria-controls="flush-collapseThree">
                                                    @lang('back.garage')
                                                    ({{$vehicleData->where('status','garage')->count()}})
                                                </button>
                                            </h2>
                                            <div id="flush-collapseThree" class="accordion-collapse collapse show"
                                                 aria-labelledby="flush-headingThree"
                                                 data-bs-parent="#accordionFlushExample">
                                                <div class="accordion-body">
                                                    @foreach($vehicleData->where('status','garage') as $garage)
                                                        <div class="row">
                                                            <div class="col-6">
                                                                <h6>{{$garage->car_name}}</h6>
                                                            </div>
                                                            <div class="col-6">
                                                                <a href="{{route('vehicles.status',[$garage->id,'damage'])}}"
                                                                   class="btn btn-success btn-rounded waves-effect waves-light">
                                                                    @lang('back.damaged')
                                                                </a>
                                                            </div>
                                                        </div>
                                                        {{--<form action="{{route('')}}" method="post">
                                                            @csrf
                                                            <div class="row">
                                                                <div class="col-md-6">
                                                                    <div class="mb-3">
                                                                        <label class="form-label"
                                                                               for="formrow-email-input">Email</label>
                                                                        <input type="email" class="form-control"
                                                                               id="formrow-email-input"
                                                                               placeholder="Enter your email address">
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-6">
                                                                    <div class="mb-3">
                                                                        <label class="form-label"
                                                                               for="formrow-password-input">Password</label>
                                                                        <input type="password" class="form-control"
                                                                               id="formrow-password-input"
                                                                               placeholder="Enter your password">
                                                                    </div>
                                                                </div>

                                                            </div>
                                                            <div class="row">
                                                                <div class="col-md-12">
                                                                    <div class="mb-3">
                                                                        <button type="submit" class="btn btn-success btn-rounded waves-effect waves-light">
                                                                            @lang('back.submit') </button>
                                                                    </div>
                                                                </div>

                                                            </div>
                                                        </form>--}}
                                                        <hr>
                                                    @endforeach
                                                </div>
                                            </div>
                                        </div>

                                        <div class="accordion-item">
                                            <h2 class="accordion-header" id="flush-headingOne">
                                                <button class="accordion-button" type="button"
                                                        data-bs-toggle="collapse"
                                                        data-bs-target="#flush-collapseOne" aria-expanded="true"
                                                        aria-controls="flush-collapseOne">
                                                    @lang('back.maintenance')
                                                    ({{$vehicleData->where('status','damage')->count()}})
                                                </button>
                                            </h2>
                                            <div id="flush-collapseOne" class="accordion-collapse collapse show"
                                                 aria-labelledby="flush-headingOne"
                                                 data-bs-parent="#accordionFlushExample">
                                                <div class="accordion-body">
                                                    @foreach($vehicleData->where('status','damage') as $damage)
                                                        <div class="row">
                                                            <div class="col-6">
                                                                <h6>{{$damage->car_name}}</h6>
                                                            </div>
                                                            <div class="col-6">
                                                                <a href="{{route('vehicles.status',[$damage->id,'available'])}}"
                                                                   class="btn btn-success btn-rounded waves-effect waves-light">
                                                                    @lang('back.avalble')
                                                                </a>
                                                            </div>
                                                        </div>
                                                        <hr>
                                                    @endforeach
                                                </div>
                                            </div>
                                        </div>


                                    </div>
                                </div>
                            </div>
                        </div>
                        {{--
                                                <div class="col-3">

                                                    <a class="btn btn-warning" data-bs-toggle="offcanvas" href="#assign_cars"
                                                       role="button"
                                                       aria-controls="offcanvasExample">
                                                        @lang('back.assign_cars')
                                                    </a>

                                                    <div class="offcanvas offcanvas-end" tabindex="-1" id="assign_cars"
                                                         aria-labelledby="offcanvasExampleLabel">
                                                        <div class="offcanvas-header">
                                                            <h5 class="offcanvas-title"
                                                                id="offcanvasExampleLabel">@lang('back.assign_cars')</h5>
                                                            <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas"
                                                                    aria-label="Close"></button>
                                                        </div>
                                                        <div class="offcanvas-body">
                                                            <form action="{{route('assign_cars.storeAssign')}}" method="post">
                                                                @csrf
                                                                <div class="row">
                                                                    <div class="col-md-6">
                                                                        <div class="mb-3">
                                                                            <label class="form-label"
                                                                                   for="formrow-email-input">@lang('back.drivrer_name')</label>
                                                                            <select name="user_id" class="form-control select2" required>
                                                                                <option value="">@lang('back.select_one')</option>
                                                                                @foreach($drivers as $driver)
                                                                                    <option {{old('user_id') == $driver->id ? 'selected' : ''}} value="{{$driver->id}}">{{$driver->name}}</option>
                                                                                @endforeach
                                                                            </select>
                                                                        </div>
                                                                        <div class="mb-3">
                                                                            <label class="form-label"
                                                                                   for="formrow-counter_number">@lang('back.carpenter')</label>
                                                                            <select name="carpenter_id[]" class="form-control select2" multiple>
                                                                                <option value="">@lang('back.select_one')</option>
                                                                                @foreach($workers->where('job_type','carpenter') as $worker_carpenter)
                                                                                    <option {{old('carpenter_id') == $worker_carpenter->id ? 'selected' : ''}} value="{{$worker_carpenter->id}}">{{$worker_carpenter->name}}</option>
                                                                                @endforeach
                                                                            </select>
                                                                        </div>
                                                                        <div class="mb-3">
                                                                            <label class="form-label"
                                                                                   for="formrow-counter_number">@lang('back.counter_number')</label>
                                                                            <input type="number" name="counter_number" required
                                                                                   placeholder="@lang('back.counter_number')"
                                                                                   class="form-control" value="{{old('counter_number')}}">
                                                                        </div>
                                                                        <div class="mb-3">
                                                                            <label class="form-label"
                                                                                   for="formrow-counter_number">@lang('back.wrapping')</label>
                                                                            <select name="wrapping_id[]" class="form-control select2" multiple>
                                                                                <option value="">@lang('back.select_one')</option>
                                                                                @foreach($workers->where('job_type','wrapping') as $worker_wrapping)
                                                                                    <option {{old('wrapping_id') == $worker_wrapping->id ? 'selected' : ''}} value="{{$worker_wrapping->id}}">{{$worker_wrapping->name}}</option>
                                                                                @endforeach
                                                                            </select>
                                                                        </div>
                                                                    </div>

                                                                    <div class="col-md-6">
                                                                        <div class="mb-3">
                                                                            <label class="form-label"
                                                                                   for="formrow-password-input">@lang('back.car')</label>
                                                                            <select name="car_id" class="form-control select2" required>
                                                                                <option value="">@lang('back.select_one')</option>
                                                                                @foreach($vehicleDataAv->where('type_car','transportation') as $CarAvailable)
                                                                                    <option {{old('car_id') == $CarAvailable->id ? 'selected' : ''}} value="{{$CarAvailable->id}}">{{$CarAvailable->car_name}} {{$CarAvailable->vehicle_number}}</option>
                                                                                @endforeach
                                                                            </select>
                                                                        </div>
                                                                        <div class="mb-3">
                                                                            <label class="form-label"
                                                                                   for="formrow-password-input">@lang('back.crane')</label>
                                                                            <select name="crane_id" class="form-control select2">
                                                                                <option value="">@lang('back.select_one')</option>
                                                                                @foreach($vehicleDataAv->where('type_car','crane') as $crane)
                                                                                    <option {{old('crane_id') == $crane->id ? 'selected' : ''}} value="{{$crane->id}}">{{$crane->car_name}}</option>
                                                                                @endforeach
                                                                            </select>
                                                                        </div>
                                                                        <div class="mb-3">
                                                                            <label class="form-label"
                                                                                   for="formrow-counter_number">@lang('back.carpenter')</label>
                                                                            <select name="carpenter_id[]" class="form-control select2" multiple>
                                                                                <option value="">@lang('back.select_one')</option>
                                                                                @foreach($workers->where('job_type','carpenter') as $worker_carpenter)
                                                                                    <option {{old('carpenter_id') == $worker_carpenter->id ? 'selected' : ''}} value="{{$worker_carpenter->id}}">{{$worker_carpenter->name}}</option>
                                                                                @endforeach
                                                                            </select>
                                                                        </div>
                                                                        <div class="mb-3">
                                                                            <label class="form-label"
                                                                                   for="formrow-counter_number">@lang('back.HVAC_technician')</label>
                                                                            <select name="HVAC_technician_id[]" class="form-control select2" multiple>
                                                                                <option value="">@lang('back.select_one')</option>
                                                                                @foreach($workers->where('job_type','HVAC_technician') as $worker_HVAC)
                                                                                    <option {{old('carpenter_id') == $worker_HVAC->id ? 'selected' : ''}} value="{{$worker_HVAC->id}}">{{$worker_HVAC->name}}</option>
                                                                                @endforeach
                                                                            </select>
                                                                        </div>
                                                                        <div class="mb-3">
                                                                            <label class="form-label"
                                                                                   for="formrow-counter_number">@lang('back.workers')</label>
                                                                            <select name="worker_id[]" class="form-control select2" multiple>
                                                                                <option value="">@lang('back.select_one')</option>
                                                                                @foreach($workers->where('job_type','workers') as $worker)
                                                                                    <option {{old('worker_id') == $worker->id ? 'selected' : ''}} value="{{$worker->id}}">{{$worker->name}}</option>
                                                                                @endforeach
                                                                            </select>
                                                                        </div>
                                                                    </div>
                                                                </div>

                                                                <div class="row">
                                                                    <div class="col-md-12">
                                                                        <div class="mb-3">
                                                                            <label class="form-label" for="formrow"></label>

                                                                            <button type="submit"
                                                                                    class="btn btn-success btn-rounded waves-effect waves-light">@lang('back.submit')</button>
                                                                        </div>
                                                                    </div>
                                                                </div>

                                                            </form>

                                                            <br>
                                                            <hr>
                                                            <div class="row">
                                                                <div class="col-md-12">
                                                                    <h5>@lang('back.cranes_with_drivers')</h5>
                                                                    <hr>
                                                                    @foreach($vehicleData->whereNotNull('assign_car_id') as $with_drivers)
                                                                        <dl class="row mb-0">
                                                                            <dt class="col-sm-3">@lang('back.car_name')</dt>
                                                                            <dd class="col-sm-9">{{$with_drivers->car_name}}</dd>
                                                                            @if($with_drivers->crane)
                                                                                <dt class="col-sm-3">@lang('back.crane')</dt>
                                                                                <dd class="col-sm-9">{{$with_drivers->crane}}</dd>
                                                                            @endif
                                                                            <dt class="col-sm-3">@lang('back.drivrer_name')</dt>
                                                                            <dd class="col-sm-9">{{$with_drivers->driver_name}}</dd>
                                                                            @if($with_drivers->workers)
                                                                            <dt class="col-sm-3">@lang('back.workers')</dt>
                                                                            <dd class="col-sm-9">( {{implode(" - ",$with_drivers->workers)}} )</dd>
                                                                            @endif
                                                                            @if($with_drivers->HVAC)
                                                                            <dt class="col-sm-3">@lang('back.HVAC_technician')</dt>
                                                                            <dd class="col-sm-9">( {{$with_drivers->HVAC ? implode(" - ",$with_drivers->HVAC) : ''}} )</dd>
                                                                            @endif
                                                                            @if($with_drivers->wrapping)
                                                                            <dt class="col-sm-3">@lang('back.wrapping')</dt>
                                                                            <dd class="col-sm-9">( {{$with_drivers->wrapping ? implode(" - ",$with_drivers->wrapping) : ''}} )</dd>
                                                                            @endif
                                                                            @if($with_drivers->carpenter)
                                                                                <dt class="col-sm-3">@lang('back.carpenter')</dt>
                                                                                <dd class="col-sm-9">( {{$with_drivers->carpenter ? implode(" - ",$with_drivers->carpenter) : ''}} )</dd>
                                                                            @endif
                                                                            <dd class="col-sm-12"><a
                                                                                        href="{{route('assign_cars.leave',$with_drivers->id)}}"
                                                                                        class="btn btn-warning btn-rounded waves-effect waves-light">@lang('back.leave_drive')</a>
                                                                            </dd>
                                                                        </dl>
                                                                        <hr>
                                                                    @endforeach
                                                                </div>
                                                            </div>

                                                        </div>
                                                    </div>




                                                </div>
                        --}}


                        <div class="col-6">
                            <canvas data-type="radial-gauge" id="gauge-a"
                                    data-width="170"
                                    data-height="170"
                                    data-units="@lang('back.today')"
                                    data-value="{{$total_price_analog}}"
                                    data-min-value="0"
                                    data-start-angle="90"
                                    data-ticks-angle="180"
                                    data-value-box="false"
                                    data-max-value="250"
                                    {{--                                    data-major-ticks="0,{{$target}},{{($target*.5) + $target}},{{($target*2) + $target}}"--}}
                                    data-major-ticks="0,50,100,150,200,250"
                                    data-minor-ticks="2"
                                    data-stroke-ticks="true"
                                    data-highlights='@json($arrayToDay)'
                                    data-color-plate="#fff"
                                    data-border-shadow-width="0"
                                    data-borders="false"
                                    data-needle-type="arrow"
                                    data-needle-width="2"
                                    data-needle-circle-size="7"
                                    data-needle-circle-outer="true"
                                    data-needle-circle-inner="false"
                                    data-animation-duration="800"
                                    data-animation-rule="linear"
                            ></canvas>
                        </div>

                    </div>



                </div>
            </div>
        </div> <!-- end col -->
    </div> <!-- end row -->

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
    <div class="row">
        <div class="col-12">
            <div class="card  border-warning">

                <div class="card-body">
                    <h6 class="card-text text-center">@lang('back.bookings') @lang('back.notAssign')  @lang('back.today') </h6>
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
                                <th>@lang('back.time')</th>
                                <th>@lang('back.price')</th>
                                <th>@lang('back.assign')</th>
                                <th>@lang('back.action')</th>
                            </tr>
                            </thead>


                            <tbody>
                            @foreach($bookings->where('status','!=','canceled')->whereNull('vehicle_id') as $key => $booking)
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
                                    <td>{{$booking->fromArea ? $booking->fromArea->name : ''}}</td>
                                    <td>{{$booking->toArea ? $booking->toArea->name : ''}}</td>
                                    <td>{{\Carbon\Carbon::parse($booking->order_time)->format('h:i a')}}</td>
                                    <td>{{$booking->price}}@lang('back.L.E')</td>
                                    <td>
                                        {{--<select name="" class="form-control" onchange="location = this.value;">
                                            <option value="" selected>@lang('back.select_one')</option>
                                            @foreach($vehicles->whereNotNull('assign_car_id')->where('status','available') as $keyCount => $vehicle)
                                                <option
                                                        value="{{route('trakings.assign',[$booking->id,$vehicle->id])}}" {{$booking->vehicle_id==$vehicle->id ? 'selected' : ''}}>{{$vehicle->car_name}}
                                                    ({{$vehicle->assign ? $vehicle->assign->user->name : ''}})
                                                </option>
                                            @endforeach
                                        </select>--}}

                                        <a class="btn btn-warning" data-bs-toggle="offcanvas"
                                           href="#assign_cars{{$booking->id}}"
                                           role="button"
                                           aria-controls="offcanvasExample">
                                            @lang('back.assign_cars')
                                        </a>

                                    </td>
                                    <td style="width: 100px">
                                        <button type="button" class="btn btn-outline-danger btn-sm"
                                                data-bs-toggle="modal" data-bs-target="#myModal{{$booking->id}}"
                                                title="@lang('back.canceled')"><i class="fas fa-times"></i></button>
                                        <a href="{{route('bookings.edit',$booking->id)}}"
                                           class="btn btn-outline-warning btn-sm"
                                           title="@lang('back.edit')"><i class="fas fa-pencil-alt"></i></a>
                                    </td>
                                </tr>
                                <!-- sample modal content -->
                                <div id="myModal{{$booking->id}}" class="modal fade" tabindex="-1" role="dialog"
                                     aria-labelledby="myModalLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title"
                                                    id="myModalLabel">@lang('back.note_canceled')</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                        aria-label="Close">
                                                </button>
                                            </div>
                                            <form action="{{route('trakings.destroy',$booking->id)}}" method="post">
                                                <div class="modal-body">
                                                    @csrf
                                                    <textarea name="note_canceled" class="form-control" cols="30"
                                                              rows="5"
                                                              placeholder="@lang('back.write') @lang('back.note_canceled')"
                                                              required></textarea>

                                                </div>
                                                <div class="modal-footer">
                                                    <button type="submit"
                                                            class="btn btn-danger waves-effect waves-light">@lang('back.submit')</button>
                                                </div>
                                            </form>
                                        </div><!-- /.modal-content -->
                                    </div><!-- /.modal-dialog -->
                                </div><!-- /.modal -->

                                <div class="offcanvas offcanvas-end" tabindex="-1" id="assign_cars{{$booking->id}}"
                                     aria-labelledby="offcanvasExampleLabel">
                                    <div class="offcanvas-header">
                                        <h5 class="offcanvas-title"
                                            id="offcanvasExampleLabel">@lang('back.assign_cars')</h5>
                                        <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas"
                                                aria-label="Close"></button>
                                    </div>
                                    <div class="offcanvas-body">
                                        <form action="{{route('assign_cars.storeAssign')}}" method="post">
                                            <input type="hidden" name="booking_id" value="{{$booking->id}}">
                                            @csrf
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="mb-3">
                                                        <label class="form-label"
                                                               for="formrow-email-input">@lang('back.drivrer_name')</label>
                                                        <select name="user_id[]" class="form-control select2" required
                                                                multiple>
                                                            <option value="">@lang('back.select_one')</option>
                                                            @foreach($drivers as $driver)
                                                                <option {{old('user_id') == $driver->id ? 'selected' : ''}} value="{{$driver->id}}">{{$driver->name}}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                    <div class="mb-3">
                                                        <label class="form-label"
                                                               for="formrow-counter_number">@lang('back.carpenter')</label>
                                                        <select name="carpenter_id[]" class="form-control select2"
                                                                multiple>
                                                            <option value="">@lang('back.select_one')</option>
                                                            @foreach($workers->where('job_type','carpenter') as $worker_carpenter)
                                                                <option {{old('carpenter_id') == $worker_carpenter->id ? 'selected' : ''}} value="{{$worker_carpenter->id}}">{{$worker_carpenter->name}}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                    <div class="mb-3">
                                                        <label class="form-label"
                                                               for="formrow-counter_number">@lang('back.counter_number')</label>
                                                        <input type="number" name="counter_number" required
                                                               placeholder="@lang('back.counter_number')"
                                                               class="form-control" value="{{old('counter_number',0)}}">
                                                    </div>
                                                    <div class="mb-3">
                                                        <label class="form-label"
                                                               for="formrow-counter_number">@lang('back.wrapping')</label>
                                                        <select name="wrapping_id[]" class="form-control select2"
                                                                multiple>
                                                            <option value="">@lang('back.select_one')</option>
                                                            @foreach($workers->where('job_type','wrapping') as $worker_wrapping)
                                                                <option {{old('wrapping_id') == $worker_wrapping->id ? 'selected' : ''}} value="{{$worker_wrapping->id}}">{{$worker_wrapping->name}}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>

                                                <div class="col-md-6">
                                                    <div class="mb-3">
                                                        <label class="form-label"
                                                               for="formrow-password-input">@lang('back.car')</label>
                                                        <select name="car_id[]" class="form-control select2" required
                                                                multiple>
                                                            <option value="">@lang('back.select_one')</option>
                                                            @foreach($vehicleDataAv->where('type_car','transportation') as $CarAvailable)
                                                                <option {{old('car_id') == $CarAvailable->id ? 'selected' : ''}} value="{{$CarAvailable->id}}">{{$CarAvailable->car_name}} {{$CarAvailable->vehicle_number}}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                    <div class="mb-3">
                                                        <label class="form-label"
                                                               for="formrow-password-input">@lang('back.crane')</label>
                                                        <select name="crane_id" class="form-control select2">
                                                            <option value="">@lang('back.select_one')</option>
                                                            @foreach($vehicleDataAv->where('type_car','crane') as $crane)
                                                                <option {{old('crane_id') == $crane->id ? 'selected' : ''}} value="{{$crane->id}}">{{$crane->car_name}}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                    <div class="mb-3">
                                                        <label class="form-label"
                                                               for="formrow-counter_number">@lang('back.carpenter')</label>
                                                        <select name="carpenter_id[]" class="form-control select2"
                                                                multiple>
                                                            <option value="">@lang('back.select_one')</option>
                                                            @foreach($workers->where('job_type','carpenter') as $worker_carpenter)
                                                                <option {{old('carpenter_id') == $worker_carpenter->id ? 'selected' : ''}} value="{{$worker_carpenter->id}}">{{$worker_carpenter->name}}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                    <div class="mb-3">
                                                        <label class="form-label"
                                                               for="formrow-counter_number">@lang('back.HVAC_technician')</label>
                                                        <select name="HVAC_technician_id[]" class="form-control select2"
                                                                multiple>
                                                            <option value="">@lang('back.select_one')</option>
                                                            @foreach($workers->where('job_type','HVAC_technician') as $worker_HVAC)
                                                                <option {{old('carpenter_id') == $worker_HVAC->id ? 'selected' : ''}} value="{{$worker_HVAC->id}}">{{$worker_HVAC->name}}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                    <div class="mb-3">
                                                        <label class="form-label"
                                                               for="formrow-counter_number">@lang('back.workers')</label>
                                                        <select name="worker_id[]" class="form-control select2"
                                                                multiple>
                                                            <option value="">@lang('back.select_one')</option>
                                                            @foreach($workers->where('job_type','workers') as $worker)
                                                                <option {{old('worker_id') == $worker->id ? 'selected' : ''}} value="{{$worker->id}}">{{$worker->name}}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div class="mb-3">
                                                        <label class="form-label" for="formrow"></label>

                                                        <button type="submit"
                                                                class="btn btn-success btn-rounded waves-effect waves-light">@lang('back.submit')</button>
                                                    </div>
                                                </div>
                                            </div>

                                        </form>
                                    </div>
                                </div>


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
            <div class="card  border-info">

                <div class="card-body">
                    <h6 class="card-text text-center">@lang('back.bookings') @lang('back.already_booked') <span
                                class="badge rounded-pill bg-warning animate__animated animate__flash animate__infinite">@lang('back.already_booked')</span>
                    </h6>
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
                                <th>@lang('back.price')</th>
                                <th>@lang('back.assign')</th>
                                <th>@lang('back.action')</th>
                            </tr>
                            </thead>


                            <tbody>
                            @foreach($already_bookings->where('status','!=','canceled')->whereNull('vehicle_id') as $key => $already_booking)
                                <tr>
                                    <td>{{$key+1}}</td>
                                    <td>{{$already_booking->user->name}}</td>
                                    <td>{{$already_booking->client_name}}</td>
                                    <td>
                                        <a href="https://wa.me/+2{{Str::replace('-','',$already_booking->client_phone)}}?text=اهلا بك"
                                           target="_blank">
                                            <div class="avatar-sm">
                                                    <span
                                                            class="avatar-title bg-soft-success text-success font-size-25 rounded-circle">
                                                        <i class="fab fa-whatsapp" style="font-size:35px;"></i>
                                                    </span>
                                            </div>
                                        </a>
                                    </td>
                                    <td>{{$already_booking->client_phone}}</td>
                                    <td>{{$already_booking->fromArea ? $already_booking->fromArea->name : ''}}</td>
                                    <td>{{$already_booking->toArea ? $already_booking->toArea->name : ''}}</td>
                                    <td>{{$already_booking->price}}@lang('back.L.E')</td>
                                    <td>
                                        {{--<select name="" class="form-control" onchange="location = this.value;">
                                            <option value="" selected>@lang('back.select_one')</option>
                                            @foreach($vehicles->whereNotNull('assign_car_id')->where('status','available') as $keyCount => $vehicle)
                                                <option
                                                        value="{{route('trakings.assign',[$booking->id,$vehicle->id])}}" {{$booking->vehicle_id==$vehicle->id ? 'selected' : ''}}>{{$vehicle->car_name}}
                                                    ({{$vehicle->assign ? $vehicle->assign->user->name : ''}})
                                                </option>
                                            @endforeach
                                        </select>--}}

                                        <a class="btn btn-warning" data-bs-toggle="offcanvas"
                                           href="#assign_cars{{$already_booking->id}}"
                                           role="button"
                                           aria-controls="offcanvasExample">
                                            @lang('back.assign_cars')
                                        </a>

                                    </td>
                                    <td style="width: 100px">
                                        <button type="button" class="btn btn-outline-danger btn-sm"
                                                data-bs-toggle="modal" data-bs-target="#myModal{{$already_booking->id}}"
                                                title="@lang('back.canceled')"><i class="fas fa-times"></i></button>
                                        <a href="{{route('bookings.edit',$already_booking->id)}}"
                                           class="btn btn-outline-warning btn-sm"
                                           title="@lang('back.edit')"><i class="fas fa-pencil-alt"></i></a>
                                    </td>
                                </tr>
                                <!-- sample modal content -->
                                <div id="myModal{{$already_booking->id}}" class="modal fade" tabindex="-1" role="dialog"
                                     aria-labelledby="myModalLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title"
                                                    id="myModalLabel">@lang('back.note_canceled')</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                        aria-label="Close">
                                                </button>
                                            </div>
                                            <form action="{{route('trakings.destroy',$already_booking->id)}}"
                                                  method="post">
                                                <div class="modal-body">
                                                    @csrf
                                                    <textarea name="note_canceled" class="form-control" cols="30"
                                                              rows="5"
                                                              placeholder="@lang('back.write') @lang('back.note_canceled')"
                                                              required></textarea>

                                                </div>
                                                <div class="modal-footer">
                                                    <button type="submit"
                                                            class="btn btn-danger waves-effect waves-light">@lang('back.submit')</button>
                                                </div>
                                            </form>
                                        </div><!-- /.modal-content -->
                                    </div><!-- /.modal-dialog -->
                                </div><!-- /.modal -->
                                <div class="offcanvas offcanvas-end" tabindex="-1"
                                     id="assign_cars{{$already_booking->id}}"
                                     aria-labelledby="offcanvasExampleLabel">
                                    <div class="offcanvas-header">
                                        <h5 class="offcanvas-title"
                                            id="offcanvasExampleLabel">@lang('back.assign_cars')</h5>
                                        <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas"
                                                aria-label="Close"></button>
                                    </div>
                                    <div class="offcanvas-body">
                                        <form action="{{route('assign_cars.storeAssign')}}" method="post">
                                            <input type="hidden" name="booking_id" value="{{$already_booking->id}}">
                                            @csrf
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="mb-3">
                                                        <label class="form-label"
                                                               for="formrow-email-input">@lang('back.drivrer_name')</label>
                                                        <select name="user_id[]" class="form-control select2" required>
                                                            <option value="">@lang('back.select_one')</option>
                                                            @foreach($drivers as $driver)
                                                                <option {{old('user_id') == $driver->id ? 'selected' : ''}} value="{{$driver->id}}">{{$driver->name}}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                    <div class="mb-3">
                                                        <label class="form-label"
                                                               for="formrow-counter_number">@lang('back.carpenter')</label>
                                                        <select name="carpenter_id[]" class="form-control select2"
                                                                multiple>
                                                            <option value="">@lang('back.select_one')</option>
                                                            @foreach($workers->where('job_type','carpenter') as $worker_carpenter)
                                                                <option {{old('carpenter_id') == $worker_carpenter->id ? 'selected' : ''}} value="{{$worker_carpenter->id}}">{{$worker_carpenter->name}}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                    <div class="mb-3">
                                                        <label class="form-label"
                                                               for="formrow-counter_number">@lang('back.counter_number')</label>
                                                        <input type="number" name="counter_number" required
                                                               placeholder="@lang('back.counter_number')"
                                                               class="form-control" value="{{old('counter_number',0)}}">
                                                    </div>
                                                    <div class="mb-3">
                                                        <label class="form-label"
                                                               for="formrow-counter_number">@lang('back.wrapping')</label>
                                                        <select name="wrapping_id[]" class="form-control select2"
                                                                multiple>
                                                            <option value="">@lang('back.select_one')</option>
                                                            @foreach($workers->where('job_type','wrapping') as $worker_wrapping)
                                                                <option {{old('wrapping_id') == $worker_wrapping->id ? 'selected' : ''}} value="{{$worker_wrapping->id}}">{{$worker_wrapping->name}}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>

                                                <div class="col-md-6">
                                                    <div class="mb-3">
                                                        <label class="form-label"
                                                               for="formrow-password-input">@lang('back.car')</label>
                                                        <select name="car_id" class="form-control select2" required>
                                                            <option value="">@lang('back.select_one')</option>
                                                            @foreach($vehicleDataAv->where('type_car','transportation') as $CarAvailable)
                                                                <option {{old('car_id') == $CarAvailable->id ? 'selected' : ''}} value="{{$CarAvailable->id}}">{{$CarAvailable->car_name}} {{$CarAvailable->vehicle_number}}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                    <div class="mb-3">
                                                        <label class="form-label"
                                                               for="formrow-password-input">@lang('back.crane')</label>
                                                        <select name="crane_id" class="form-control select2">
                                                            <option value="">@lang('back.select_one')</option>
                                                            @foreach($vehicleDataAv->where('type_car','crane') as $crane)
                                                                <option {{old('crane_id') == $crane->id ? 'selected' : ''}} value="{{$crane->id}}">{{$crane->car_name}}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                    <div class="mb-3">
                                                        <label class="form-label"
                                                               for="formrow-counter_number">@lang('back.carpenter')</label>
                                                        <select name="carpenter_id[]" class="form-control select2"
                                                                multiple>
                                                            <option value="">@lang('back.select_one')</option>
                                                            @foreach($workers->where('job_type','carpenter') as $worker_carpenter)
                                                                <option {{old('carpenter_id') == $worker_carpenter->id ? 'selected' : ''}} value="{{$worker_carpenter->id}}">{{$worker_carpenter->name}}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                    <div class="mb-3">
                                                        <label class="form-label"
                                                               for="formrow-counter_number">@lang('back.HVAC_technician')</label>
                                                        <select name="HVAC_technician_id[]" class="form-control select2"
                                                                multiple>
                                                            <option value="">@lang('back.select_one')</option>
                                                            @foreach($workers->where('job_type','HVAC_technician') as $worker_HVAC)
                                                                <option {{old('carpenter_id') == $worker_HVAC->id ? 'selected' : ''}} value="{{$worker_HVAC->id}}">{{$worker_HVAC->name}}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                    <div class="mb-3">
                                                        <label class="form-label"
                                                               for="formrow-counter_number">@lang('back.workers')</label>
                                                        <select name="worker_id[]" class="form-control select2"
                                                                multiple>
                                                            <option value="">@lang('back.select_one')</option>
                                                            @foreach($workers->where('job_type','workers') as $worker)
                                                                <option {{old('worker_id') == $worker->id ? 'selected' : ''}} value="{{$worker->id}}">{{$worker->name}}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div class="mb-3">
                                                        <label class="form-label" for="formrow"></label>

                                                        <button type="submit"
                                                                class="btn btn-success btn-rounded waves-effect waves-light">@lang('back.submit')</button>
                                                    </div>
                                                </div>
                                            </div>

                                        </form>

                                    </div>
                                </div>

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
            <div class="card  border-success">
                <div class="card-body">

                    <h6 class="card-text text-center">@lang('back.traking') @lang('back.cranes') @lang('back.today') </h6>

                    <div class="row">
                        <div class="col-md-12">

                            <div class="table-responsive">

                                <table class="table table-sm mb-0">

                                    <thead class="table-light">
                                    <tr>
                                        <th>#</th>
                                        <th>@lang('back.drivrer_name')</th>
                                        <th>@lang('back.bookings')</th>

                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($data as $key2 => $car)
                                        <tr>
                                            <th scope="row">{{$key2+1}}</th>
                                            <td width="20%">
                                                @foreach($car[0]->drivers as $k_driver_val => $driver_val)
                                                    <strong>{{$driver_val[0]}} ( {{$car[0]->cars[$k_driver_val]}}
                                                        )</strong>
                                                    <br>
                                                @endforeach
                                                <h4 class="text-danger ">{{$car->sum(['price'])}} @lang('back.L.E')</h4>
                                                <br>
                                                <a href="{{route('expense_order',$car[0]->id)}}"
                                                   target="_blank">
                                                    <div class="avatar-sm">
                                                        <i class="fas fa-money-bill"
                                                           style="font-size:30px;"></i>
                                                    </div>
                                                </a>
                                            </td>
                                            <td width="80%">
                                                <div class="table-responsive" style="overflow: inherit;">
                                                    <table class="table table-nowrap table-centered table-sm mb-0"
                                                           style="overflow: inherit;">
                                                        <thead>
                                                        <tr>
                                                            <th>#</th>
                                                            <th width="10%">@lang('back.client_name')</th>
                                                            <th>@lang('back.employee')</th>
                                                            <th width="10%">@lang('back.client_phone')</th>
                                                            <th width="10%">@lang('back.whatsapp') @lang('back.driver')</th>
                                                            <th width="10%">@lang('back.client_whatsapp')</th>
                                                            <th width="10%">@lang('back.from_area')</th>
                                                            <th width="10%">@lang('back.to_area')</th>
                                                            <th width="10%">@lang('back.time')</th>
                                                            <th width="10%">@lang('back.price')</th>
                                                            <th width="10%">@lang('back.action')</th>
                                                        </tr>
                                                        </thead>


                                                        <tbody>
                                                        @foreach($car as $k => $value)
                                                            <tr>
                                                                <td>{{$k+1}}</td>
                                                                <td>{{$value->client_name}}</td>
                                                                <td>{{$value->user->name}}</td>
                                                                <td>{{Str::replace('-','',$value->client_phone)}}</td>
                                                                <td>
                                                                    <a href="https://web.whatsapp.com/send?phone=+2{{$value->drivers[$k][1]}}&text={{$value->whatsappDriver}}"
                                                                       target="_blank">
                                                                        <div class="avatar-sm">
                                                                            <span
                                                                                    class="avatar-title bg-soft-success text-success font-size-25 rounded-circle">
                                                                                <i class="fab fa-whatsapp"
                                                                                   style="font-size:35px;"></i>
                                                                            </span>
                                                                        </div>
                                                                    </a>
                                                                </td>
                                                                <td>
                                                                    <a href="https://web.whatsapp.com/send?phone=+2{{$value->client_phone}}&text={{$value->whatsappClient}}"
                                                                       target="_blank">
                                                                        <div class="avatar-sm">
                                                                            <span
                                                                                    class="avatar-title bg-soft-success text-success font-size-25 rounded-circle">
                                                                                <i class="fab fa-whatsapp"
                                                                                   style="font-size:35px;"></i>
                                                                            </span>
                                                                        </div>
                                                                    </a>
                                                                </td>
                                                                <td>
                                                                    <p style="font-weight: bolder;">{{$value->fromArea ? $value->fromArea->name : ''}}</p>
                                                                    <code class="code">{{$value->from_address}}</code>
                                                                </td>
                                                                <td>
                                                                    <p style="font-weight: bolder;">{{$value->toArea ? $value->toArea->name : ''}}</p>
                                                                    <code class="code">{{$value->to_address}}</code>
                                                                </td>
                                                                <td>{{\Carbon\Carbon::parse($value->order_time)->format('h:i a')}}</td>
                                                                <td>{{$value->price}}@lang('back.L.E')</td>
                                                                <td style="width: 100px">
                                                                    <a class="btn btn-outline-warning btn-sm"
                                                                       data-bs-toggle="offcanvas"
                                                                       href="#assign_cars_edit{{$value->id}}"
                                                                       role="button"
                                                                       title="@lang('back.assign_cars_edit')"
                                                                       aria-controls="offcanvasExample">
                                                                        <i class="fas fa-random"></i>
                                                                    </a>
                                                                    <a href="{{route('trakings.undestroy',$value->id)}}"
                                                                       class="btn btn-outline-warning btn-sm"
                                                                       title="@lang('back.recovery')">
                                                                        <i class="fas fa-sync-alt"></i>
                                                                    </a>
                                                                    <a href="{{route('bookings.edit',$value->id)}}"
                                                                       class="btn btn-outline-warning btn-sm"
                                                                       title="@lang('back.edit')"><i
                                                                                class="fas fa-pencil-alt"></i></a>
                                                                    {{--
                                                                    <div class="btn-group">
                                                                        <button type="button"
                                                                                class="btn btn-{{$value->color_status}} dropdown-toggle waves-effect waves-light"
                                                                                data-bs-toggle="dropdown"
                                                                                aria-haspopup="true"
                                                                                aria-expanded="false">@lang('back.'.$value->status)
                                                                            <i class="mdi mdi-chevron-down"></i>
                                                                        </button>
                                                                        <div class="dropdown-menu dropdown-menu-end"
                                                                             data-placement="top">
                                                                            <a class="dropdown-item text-primary"
                                                                               href="{{route('trakings.status',[$value->id,'inprocess'])}}">
                                                                                <i class="fas fa-recycle"></i> @lang('back.inprocess')
                                                                            </a>
                                                                            <a class="dropdown-item text-info"
                                                                               href="{{route('trakings.status',[$value->id,'inuploaded'])}}">
                                                                                <i class="fas fa-road"></i> @lang('back.inuploaded')
                                                                            </a>
                                                                            <a class="dropdown-item text-success"
                                                                               href="{{route('trakings.status',[$value->id,'finished'])}}">
                                                                                <i class="fas fa-check-double"></i> @lang('back.finished')
                                                                            </a>
                                                                            <a class="dropdown-item text-warning"
                                                                               href="{{route('trakings.undestroy',$value->id)}}">
                                                                                <i class="fas fa-sync-alt"></i> @lang('back.cancel_assign')
                                                                            </a>
                                                                        </div>
                                                                    </div><!-- /btn-group -->
                                                                    --}}
                                                                </td>

                                                            </tr>

                                                            <div class="offcanvas offcanvas-end" tabindex="-1"
                                                                 id="assign_cars_edit{{$value->id}}"
                                                                 aria-labelledby="offcanvasExampleLabel">
                                                                <div class="offcanvas-header">
                                                                    <h5 class="offcanvas-title"
                                                                        id="offcanvasExampleLabel">@lang('back.assign_cars_edit')</h5>
                                                                    <button type="button" class="btn-close text-reset"
                                                                            data-bs-dismiss="offcanvas"
                                                                            aria-label="Close"></button>
                                                                </div>
                                                                <div class="offcanvas-body">
                                                                    <form action="{{route('assign_cars.storeAssign')}}"
                                                                          method="post">
                                                                        <input type="hidden" name="booking_id"
                                                                               value="{{$value->id}}">
                                                                        <input type="hidden" name="type" value="edit">

                                                                        @csrf
                                                                        <div class="row">
                                                                            <div class="col-md-6">
                                                                                <div class="mb-3">
                                                                                    <label class="form-label"
                                                                                           for="formrow-email-input">@lang('back.drivrer_name')</label>
                                                                                    <select name="user_id[]"
                                                                                            class="form-control select2"
                                                                                            required multiple>
                                                                                        <option value="">@lang('back.select_one')</option>
                                                                                        @foreach($drivers as $driver)
                                                                                            <option {{old('user_id') == $driver->id ? 'selected' : ''}} value="{{$driver->id}}">{{$driver->name}}</option>
                                                                                        @endforeach
                                                                                    </select>
                                                                                </div>
                                                                                <div class="mb-3">
                                                                                    <label class="form-label"
                                                                                           for="formrow-counter_number">@lang('back.carpenter')</label>
                                                                                    <select name="carpenter_id[]"
                                                                                            class="form-control select2"
                                                                                            multiple>
                                                                                        <option value="">@lang('back.select_one')</option>
                                                                                        @foreach($workers->where('job_type','carpenter') as $worker_carpenter)
                                                                                            <option {{old('carpenter_id') == $worker_carpenter->id ? 'selected' : ''}} value="{{$worker_carpenter->id}}">{{$worker_carpenter->name}}</option>
                                                                                        @endforeach
                                                                                    </select>
                                                                                </div>
                                                                                <div class="mb-3">
                                                                                    <label class="form-label"
                                                                                           for="formrow-counter_number">@lang('back.counter_number')</label>
                                                                                    <input type="number"
                                                                                           name="counter_number"
                                                                                           required
                                                                                           placeholder="@lang('back.counter_number')"
                                                                                           class="form-control"
                                                                                           value="{{old('counter_number',0)}}">
                                                                                </div>
                                                                                <div class="mb-3">
                                                                                    <label class="form-label"
                                                                                           for="formrow-counter_number">@lang('back.wrapping')</label>
                                                                                    <select name="wrapping_id[]"
                                                                                            class="form-control select2"
                                                                                            multiple>
                                                                                        <option value="">@lang('back.select_one')</option>
                                                                                        @foreach($workers->where('job_type','wrapping') as $worker_wrapping)
                                                                                            <option {{old('wrapping_id') == $worker_wrapping->id ? 'selected' : ''}} value="{{$worker_wrapping->id}}">{{$worker_wrapping->name}}</option>
                                                                                        @endforeach
                                                                                    </select>
                                                                                </div>
                                                                            </div>

                                                                            <div class="col-md-6">
                                                                                <div class="mb-3">
                                                                                    <label class="form-label"
                                                                                           for="formrow-password-input">@lang('back.car')</label>
                                                                                    <select name="car_id[]"
                                                                                            class="form-control select2"
                                                                                            required multiple>
                                                                                        <option value="">@lang('back.select_one')</option>
                                                                                        @foreach($vehicleDataAv->where('type_car','transportation') as $CarAvailable)
                                                                                            <option {{old('car_id') == $CarAvailable->id ? 'selected' : ''}} value="{{$CarAvailable->id}}">{{$CarAvailable->car_name}} {{$CarAvailable->vehicle_number}}</option>
                                                                                        @endforeach
                                                                                    </select>
                                                                                </div>
                                                                                <div class="mb-3">
                                                                                    <label class="form-label"
                                                                                           for="formrow-password-input">@lang('back.crane')</label>
                                                                                    <select name="crane_id"
                                                                                            class="form-control select2">
                                                                                        <option value="">@lang('back.select_one')</option>
                                                                                        @foreach($vehicleDataAv->where('type_car','crane') as $crane)
                                                                                            <option {{old('crane_id') == $crane->id ? 'selected' : ''}} value="{{$crane->id}}">{{$crane->car_name}}</option>
                                                                                        @endforeach
                                                                                    </select>
                                                                                </div>
                                                                                <div class="mb-3">
                                                                                    <label class="form-label"
                                                                                           for="formrow-counter_number">@lang('back.carpenter')</label>
                                                                                    <select name="carpenter_id[]"
                                                                                            class="form-control select2"
                                                                                            multiple>
                                                                                        <option value="">@lang('back.select_one')</option>
                                                                                        @foreach($workers->where('job_type','carpenter') as $worker_carpenter)
                                                                                            <option {{old('carpenter_id') == $worker_carpenter->id ? 'selected' : ''}} value="{{$worker_carpenter->id}}">{{$worker_carpenter->name}}</option>
                                                                                        @endforeach
                                                                                    </select>
                                                                                </div>
                                                                                <div class="mb-3">
                                                                                    <label class="form-label"
                                                                                           for="formrow-counter_number">@lang('back.HVAC_technician')</label>
                                                                                    <select name="HVAC_technician_id[]"
                                                                                            class="form-control select2"
                                                                                            multiple>
                                                                                        <option value="">@lang('back.select_one')</option>
                                                                                        @foreach($workers->where('job_type','HVAC_technician') as $worker_HVAC)
                                                                                            <option {{old('carpenter_id') == $worker_HVAC->id ? 'selected' : ''}} value="{{$worker_HVAC->id}}">{{$worker_HVAC->name}}</option>
                                                                                        @endforeach
                                                                                    </select>
                                                                                </div>
                                                                                <div class="mb-3">
                                                                                    <label class="form-label"
                                                                                           for="formrow-counter_number">@lang('back.workers')</label>
                                                                                    <select name="worker_id[]"
                                                                                            class="form-control select2"
                                                                                            multiple>
                                                                                        <option value="">@lang('back.select_one')</option>
                                                                                        @foreach($workers->where('job_type','workers') as $worker)
                                                                                            <option {{old('worker_id') == $worker->id ? 'selected' : ''}} value="{{$worker->id}}">{{$worker->name}}</option>
                                                                                        @endforeach
                                                                                    </select>
                                                                                </div>
                                                                            </div>
                                                                        </div>

                                                                        <div class="row">
                                                                            <div class="col-md-12">
                                                                                <div class="mb-3">
                                                                                    <label class="form-label"
                                                                                           for="formrow"></label>

                                                                                    <button type="submit"
                                                                                            class="btn btn-success btn-rounded waves-effect waves-light">@lang('back.submit')</button>
                                                                                </div>
                                                                            </div>
                                                                        </div>

                                                                    </form>
                                                                </div>
                                                            </div>

                                                        @endforeach
                                                        </tbody>
                                                    </table>
                                                </div>


                                            </td>
                                        </tr>

                                    @endforeach


                                    </tbody>
                                </table>
                            </div>


                        </div>


                    </div>

                </div><!-- end row -->
            </div><!-- end card-body -->
        </div><!-- end card -->
    </div><!-- end col -->

    {{--



        <div class="row">
            <div class="col-12">
                <div class="card bg-soft-success border-success">
                    <div class="card-body">

                        <h6 class="card-text">@lang('back.traking') @lang('back.cranes') @lang('back.today')</h6>

                        <div class="row">
                            <div class="col-md-3">
                                <div class="nav flex-column nav-pills" id="v-pills-tab" role="tablist"
                                     aria-orientation="vertical">
                                    @foreach($titles as $key1 => $title)
                                        <a class="nav-link mb-2 {{$key1 == 0 ? 'active' : ''}}" id="v-pills-{{$key1}}-tab"
                                           data-bs-toggle="pill"
                                           href="#v-pills-{{$key1}}" role="tab" aria-controls="v-pills-{{$key1}}"
                                           aria-selected="{{$key1 == 0 ? 'true' : 'false'}}">  {{$title}} </a>
                                    @endforeach
                                </div>
                            </div>
                            <div class="col-md-9">
                                <div class="tab-content text-muted mt-4 mt-md-0" id="v-pills-tabContent">
                                    @foreach($data as $key2 => $car)

                                        <div class="tab-pane fade {{$key2 == 0 ? 'show active' : ''}}"
                                             id="v-pills-{{$key2}}" role="tabpanel"
                                             aria-labelledby="v-pills-{{$key2}}-tab">
                                            <div class="table-responsive">
                                                <table class="table table-nowrap table-centered mb-0">
                                                    <thead>
                                                    <tr>
                                                        <th>#</th>
                                                        <th>@lang('back.client_name')</th>
                                                        <th>@lang('back.whatsapp') @lang('back.driver')</th>
                                                        <th>@lang('back.from_area')</th>
                                                        <th>@lang('back.to_area')</th>
                                                        <th>@lang('back.KM')</th>
                                                        <th>@lang('back.type_car')</th>
                                                        <th>@lang('back.price')</th>
                                                        <th>@lang('back.action')</th>
                                                    </tr>
                                                    </thead>


                                                    <tbody>
                                                    @foreach($car as $k => $value)

                                                        <tr>
                                                            <td>{{$k+1}}</td>
                                                            <td>{{$value->client_name}}</td>
                                                            <td>
                                                                <a href="https://wa.me/+2{{$value->assign->user->employee->whatsapp}}?text={!! $value->whatsappMessage !!}"
                                                                   target="_blank">
                                                                    <div class="avatar-sm">

                                                        <span
                                                                class="avatar-title bg-soft-success text-success font-size-25 rounded-circle">
                                                            <i class="fab fa-whatsapp" style="font-size:35px;"></i>
                                                        </span>
                                                                    </div>
                                                                </a>
                                                            </td>
                                                            <td>{{$value->fromArea->name}}</td>
                                                            <td>{{$value->toArea->name}}</td>
                                                            <td>{{$value->km}}</td>
                                                            <td>@lang('back.'.$value->vehicle_type)</td>
                                                            <td>{{$value->price}}@lang('back.L.E')</td>
                                                            <td style="width: 100px">
                                                                <div class="btn-group">
                                                                    <button type="button"
                                                                            class="btn btn-{{$value->color_status}} dropdown-toggle waves-effect waves-light"
                                                                            data-bs-toggle="dropdown" aria-haspopup="true"
                                                                            aria-expanded="false">@lang('back.'.$value->status)
                                                                        <i class="mdi mdi-chevron-down"></i></button>
                                                                    <div class="dropdown-menu dropdown-menu-end"
                                                                         data-placement="top">
                                                                        <a class="dropdown-item text-primary"
                                                                           href="{{route('trakings.status',[$value->id,'inprocess'])}}">
                                                                            <i class="fas fa-recycle"></i> @lang('back.inprocess')
                                                                        </a>
                                                                        <a class="dropdown-item text-info"
                                                                           href="{{route('trakings.status',[$value->id,'inuploaded'])}}">
                                                                            <i class="fas fa-road"></i> @lang('back.inuploaded')
                                                                        </a>
                                                                        <a class="dropdown-item text-success"
                                                                           href="{{route('trakings.status',[$value->id,'finished'])}}">
                                                                            <i class="fas fa-check-double"></i> @lang('back.finished')
                                                                        </a>
                                                                        <a class="dropdown-item text-warning"
                                                                           href="{{route('trakings.undestroy',$value->id)}}">
                                                                            <i class="fas fa-sync-alt"></i> @lang('back.cancel_assign')
                                                                        </a>
                                                                    </div>
                                                                </div><!-- /btn-group -->
                                                            </td>
                                                        </tr>
                                                    @endforeach
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>

                    </div><!-- end row -->
                </div><!-- end card-body -->
            </div><!-- end card -->
        </div><!-- end col -->

    --}}


    <div class="row">
        <div class="col-12">
            <div class="card bg-soft-danger border-danger">
                <div class="card-body">
                    <h6 class="card-text text-danger">@lang('back.bookings') @lang('back.canceling') @lang('back.today')</h6>
                    <div class="table-responsive">
                        <table class="table table-nowrap table-centered mb-0">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>@lang('back.employee')</th>
                                <th>@lang('back.client_name')</th>
                                <th>@lang('back.client_phone')</th>
                                <th>@lang('back.from_area')</th>
                                <th>@lang('back.to_area')</th>
                                <th>@lang('back.price')</th>
                                <th>@lang('back.note_canceled')</th>
                                <th>@lang('back.action')</th>
                            </tr>
                            </thead>


                            <tbody>
                            @foreach($bookings->where('status','canceled') as $key => $booking2)
                                <tr>
                                    <td>{{$key+1}}</td>
                                    <td>{{$booking2->user->name}}</td>
                                    <td>{{$booking2->client_name}}</td>
                                    <td>
                                        <a href="https://wa.me/+2{{Str::replace('-','',$booking2->client_phone)}}?text=اهلا بك"
                                           target="_blank">
                                            <div class="avatar-sm">
                                                    <span
                                                            class="avatar-title bg-soft-success text-success font-size-25 rounded-circle">
                                                        <i class="fab fa-whatsapp" style="font-size:35px;"></i>
                                                    </span>
                                            </div>
                                        </a>
                                    </td>
                                    <td>{{$booking2->fromArea ? $booking2->fromArea->name : ''}}</td>
                                    <td>{{$booking2->toArea ? $booking2->toArea->name : ''}}</td>
                                    <td>{{$booking2->price}}@lang('back.L.E')</td>
                                    <td>{{$booking2->note_canceled}}</td>
                                    <td style="width: 100px">
                                        <a href="{{route('trakings.undestroy',$booking2->id)}}"
                                           class="btn btn-outline-warning btn-sm" title="@lang('back.recovery')">
                                            <i class="fas fa-sync-alt"></i>
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

    <!-- Sweet Alerts js -->
    <script src="{{url('acp/libs/sweetalert2/sweetalert2.min.js')}}"></script>
    <!-- Sweet alert init js-->
    <script src="{{url('acp/js/pages/sweet-alerts.init.js')}}"></script>
    <script src="{{url('acp/libs/select2/js/select2.min.js')}}"></script>
    <script src="{{url('acp/js/pages/form-advanced.init.js')}}"></script>


    <script src="https://cdn.rawgit.com/Mikhus/canvas-gauges/gh-pages/download/2.1.4/radial/gauge.min.js"></script>
    <script>

        var gauge = new RadialGauge({renderTo: 'gauge-a'});
        gauge.draw();
        var gauge2 = new RadialGauge({renderTo: 'gauge-b'});
        gauge2.draw();


        $(document).ready(function () {
            clockUpdate();
            setInterval(clockUpdate, 1000);
        })

        function clockUpdate() {
            var date = new Date();
            $('.digital-clock').css({'color': '#fff', 'text-shadow': '0 0 6px #ff0'});

            function addZero(x) {
                if (x < 10) {
                    return x = '0' + x;
                } else {
                    return x;
                }
            }

            function twelveHour(x) {
                if (x > 12) {
                    return x = x - 12;
                } else if (x == 0) {
                    return x = 12;
                } else {
                    return x;
                }
            }

            var h = addZero(twelveHour(date.getHours()));
            var m = addZero(date.getMinutes());
            var s = addZero(date.getSeconds());

        }
    </script>
@endsection


