@extends('acp.layout.app')

@section('title')
    @lang('back.show') @lang('back.bookings')
@endsection

@section('css')
    <link href="{{url('acp/libs/jquery-bar-rating/themes/css-stars.css')}}" rel="stylesheet" type="text/css"/>
    <link href="{{url('acp/libs/jquery-bar-rating/themes/fontawesome-stars-o.css')}}" rel="stylesheet" type="text/css"/>
    <link href="{{url('acp/libs/jquery-bar-rating/themes/fontawesome-stars.css')}}" rel="stylesheet" type="text/css"/>
    <style>
        .fas {
            font-size: x-large;
        }
    </style>
@endsection

@section('content')

    <!-- start page title -->
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
            <div class="page-title-box d-flex align-items-center justify-content-between">
                <h4 class="mb-0">@lang('back.show') @lang('back.bookings')</h4>

                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item active">@lang('back.show') @lang('back.bookings')</li>
                        <li class="breadcrumb-item "><a href="{{route('bookings.index')}}">@lang('back.bookings')</a>
                        </li>
                        <li class="breadcrumb-item ">@lang('back.dashborad')</li>
                    </ol>
                </div>

            </div>
        </div>
    </div>
    <!-- end page title -->
    @php

        $color = '';
        if ($booking->status == 'sure'){
            $color = 'success';
        }elseif ($booking->status == 'waiting'){
            $color = 'warning';
        }elseif ($booking->status == 'reservation'){
            $color = 'info';
        }elseif ($booking->status == 'canceled'){
            $color = 'dark';
        }
    @endphp
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">

                    @php
                        $loads = json_decode($booking->load_car);
                        $expenses = (array) json_decode($booking->expenses);
                        $service = (array) json_decode($booking->service);
                        $sunExp = 0;
                    @endphp

                    <div class="row">
                        <div class="col-lg-6">
                            <div class="card border border-warning">
                                <div class="card-header bg-transparent border-warning">
                                    <h3 class="card-title text-center">تفاصيل بيانات العميل</h3>
                                </div>

                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table class="table table-sm m-0">
                                            <tbody>

                                            <tr>
                                                <th>@lang('back.order_number')</th>
                                                <th scope="row">{{$booking->id}}</th>
                                            </tr>
                                            <tr>
                                                <th>@lang('back.client_name')</th>
                                                <th scope="row">{{$booking->client_name}}</th>
                                            </tr>
                                            <tr>
                                                <th>@lang('back.client_phone')</th>
                                                <th scope="row">{{$booking->client_phone}}</th>
                                            </tr>
                                            <tr>
                                                <th>@lang('back.phone2')</th>
                                                <th scope="row">{{$booking->client_phone2}}</th>
                                            </tr>
                                            <tr>
                                                <th>@lang('back.client_whatsapp')</th>
                                                <th scope="row">
                                                    <a target="_blank"
                                                       href="https://web.whatsapp.com/send?phone=+2{{$booking->client_phone}}"
                                                       class="btn btn-success waves-effect waves-light btn-sm">
                                                        <i class="fab fa-whatsapp me-2"></i> وتساب
                                                    </a>

                                                </th>
                                            </tr>
                                            <tr>
                                                <th>@lang('back.nanonal_id')</th>
                                                <th scope="row">{{$booking->nanonal_id}}</th>
                                            </tr>
                                            <tr>
                                                <th>@lang('back.status')</th>
                                                <th scope="row"><span
                                                            class="badge bg-{{$color}} font-size-12 ms-2">@lang('back.'.$booking->status)</span>
                                                </th>
                                            </tr>
                                            <tr>
                                                <th>@lang('back.from_floor')</th>
                                                <th scope="row">{{$booking->from_floor}}</th>
                                            </tr>
                                            <tr>
                                                <th>@lang('back.to_floor')</th>
                                                <th scope="row">{{$booking->to_floor}}</th>
                                            </tr>

                                            <tr>
                                                <th>@lang('back.from_area')</th>
                                                <th scope="row">{{$booking->fromArea ? $booking->fromArea->name : ''}}</th>
                                            </tr>
                                            <tr>
                                                <th>@lang('back.to_area')</th>
                                                <th scope="row">{{$booking->toArea ? $booking->toArea->name : ''}}</th>
                                            </tr>
                                            <tr>
                                                <th>@lang('back.order_at')</th>
                                                <th scope="row">{{$booking->booking_at}} {{\Carbon\Carbon::createFromFormat('H:i', date("h:i",strtotime($booking->order_time)))->isoFormat('h:mm a')}}
                                                    <br> ( {{ $booking->order_day }} )
                                                </th>
                                            </tr>
                                            <tr>
                                                <th>@lang('back.created_by')</th>
                                                <th scope="row">{{$booking->user->name}}</th>
                                            </tr>

                                            </tbody>
                                        </table>

                                    </div>

                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="card border border-warning">
                                <div class="card-header bg-transparent border-warning">
                                    <h3 class="card-title text-center">تفاصيل حمولة الاوردر</h3>
                                </div>
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table class="table table-sm m-0">
                                            <thead>
                                            <tr>
                                                <th class="text-center">الاجهزه و الاثاث</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            @foreach($loads as $kload =>  $load)
                                                <tr>
                                                    <th>@lang('back.'.$kload)</th>
                                                    <th scope="row">{{$load}}</th>
                                                </tr>
                                            @endforeach

                                            </tbody>
                                        </table>


                                    </div>

                                </div>
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table class="table table-sm m-0">
                                            <thead>
                                            <tr>
                                                <th class="text-center">مصاريف الاوردر</th>
                                            </tr>
                                            </thead>
                                            {{--                                            @dd($expenses,$service)--}}

                                            <tbody>
                                            @foreach($expenses as $kExpense =>  $expense)
                                                @if(!is_null($expense))

                                                    @php($sunExp += $service[$kExpense])
                                                    <tr>
                                                        <th style="direction: ltr;">{{$expense}}
                                                            X @lang('back.'.$kExpense) </th>
                                                        <th scope="row">{{$service[$kExpense]}} @lang('back.l.e')</th>
                                                    </tr>
                                                @endif
                                            @endforeach

                                            </tbody>
                                        </table>


                                    </div>

                                </div>
                                <div class="card-body">
                                    <h3 class="card-title">السعر والملاحظات</h3>
                                    <div class="table-responsive">
                                        <table class="table table-sm m-0">
                                            <thead>
                                            <tr>
                                                <th class="text-center">السعر والخصومات</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            <tr>
                                                <th>@lang('back.price')</th>
                                                <th scope="row">{{$booking->price}} @lang('back.l.e')</th>
                                            </tr>
                                            <tr>
                                                <th>@lang('back.expense')</th>
                                                <th scope="row">{{$sunExp}} @lang('back.l.e')</th>
                                            </tr>

                                            <tr>
                                                <th>خصم</th>
                                                <th scope="row">{{$booking->discount ? $booking->discount : 0}} @lang('back.l.e')</th>
                                            </tr>
                                            <tr>
                                                <th>سبب الخصم</th>
                                                <th scope="row">{{$booking->discount_reson ? $booking->discount_reson : '-'}}</th>
                                            </tr>

                                            <tr>
                                                <th>اكراميات</th>
                                                <th scope="row">{{$booking->tips ? $booking->tips : 0}} @lang('back.l.e')</th>
                                            </tr>

                                            <tr>
                                                <th>الاجمالي</th>
                                                <th scope="row">{{ ($booking->price + $booking->tips) - $booking->discount  }} @lang('back.l.e')</th>
                                            </tr>

                                            <tr>
                                                <th>ملاحظات</th>
                                                <th scope="row">{{$booking->note}}</th>
                                            </tr>

                                            </tbody>
                                        </table>


                                    </div>

                                </div>
                            </div>
                        </div>

                    </div>

                </div>

                @if($booking->rate)
                    <div class="row">
                        <div class="col-xl-6 col-sm-6">
                            <div class="pt-5">
                                <h5 class="font-size-15">@lang('back.rate_callcenter')</h5>
                                @for($c=0;$c<(5-$booking->rate->callcenter);$c++)
                                    <i class="fas fa-star"></i>
                                @endfor
                                @for($c=0;$c<$booking->rate->callcenter;$c++)
                                    <i class="fas fa-star" style="color:#f1b44c;"></i>
                                @endfor
                            </div>
                            <div class="mt-4">
                                <p class="mb-1">@lang('back.note_callcenter')</p>
                                <h5 class="font-size-16">{{$booking->rate->callcenter_description}}</h5>
                            </div>
                        </div>

                        <div class="col-xl-6 col-sm-6">
                            <div class="pt-5">
                                <h5 class="font-size-15">@lang('back.rate_driver')</h5>
                                @for($d=0;$d<(5-$booking->rate->driver);$d++)
                                    <i class="fas fa-star"></i>
                                @endfor
                                @for($d=0;$d<$booking->rate->driver;$d++)
                                    <i class="fas fa-star" style="color:#f1b44c;"></i>
                                @endfor

                            </div>
                            <div class="mt-4">
                                <p class="mb-1">@lang('back.note_driver')</p>
                                <h5 class="font-size-16">{{$booking->rate->driver_description}}</h5>
                            </div>
                        </div>

                    </div>
                @else
                    <form action="{{route('bookings.rate')}}" method="post">
                        @csrf
                        <input type="hidden" value="{{$booking->id}}" name="id">
                        <div class="row">
                            <div class="col-xl-6 col-sm-6">
                                <div class="pt-5">
                                    <h5 class="font-size-15">@lang('back.rate_callcenter')</h5>
                                    <select class="rating-css " name="rate_callcenter_star" autocomplete="off">
                                        <option value="1">1</option>
                                        <option value="2">2</option>
                                        <option value="3">3</option>
                                        <option value="4">4</option>
                                        <option value="5">5</option>
                                    </select>
                                </div>
                                <div class="mt-4">
                                    <p class="mb-1">@lang('back.note_callcenter') *</p>
                                    <textarea name="rate_callcenter_note" placeholder="@lang('back.note_callcenter')"
                                              class="form-control" cols="30" required
                                              rows="5"></textarea>
                                </div>
                            </div>

                            <div class="col-xl-6 col-sm-6">
                                <div class="pt-5">
                                    <h5 class="font-size-15">@lang('back.rate_driver')</h5>
                                    <select class="rating-css" name="rate_driver_star" autocomplete="off">
                                        <option value="1">1</option>
                                        <option value="2">2</option>
                                        <option value="3">3</option>
                                        <option value="4">4</option>
                                        <option value="5">5</option>
                                    </select>
                                </div>
                                <div class="mt-4">
                                    <p class="mb-1">@lang('back.note_driver') *</p>
                                    <textarea name="rate_driver_note" placeholder="@lang('back.note_driver')"
                                              class="form-control" cols="30" required
                                              rows="5"></textarea>
                                </div>
                            </div>

                        </div>

                        <div class="row">
                            <div class="col-sm-9">
                                <div class="d-flex flex-wrap gap-3">
                                    <button type="submit"
                                            class="btn btn-primary waves-effect waves-light w-md">@lang('back.submit')</button>
                                </div>
                            </div>
                        </div>
                    </form>
                @endif
                <div class="d-print-none mt-4">
                    <div class="float-end">
                        <a href="javascript:window.print()"
                           class="btn btn-success waves-effect waves-light me-1"><i class="fa fa-print"></i></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- end row -->


@endsection
@section('js')

    <!-- jquery-bar-rating js -->
    <script src="{{url('acp/libs/jquery-bar-rating/jquery.barrating.min.js')}}"></script>

    <script src="{{url('acp/js/pages/rating-init.js')}}"></script>
@endsection

