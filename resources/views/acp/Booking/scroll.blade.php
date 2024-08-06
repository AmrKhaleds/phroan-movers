@foreach($bookings as $booking)
{{--    <div class="col-xl-4 col-sm-6">--}}
    <div class="col-xl-6 col-sm-6">
        <div class="card">
            <div class="card-body">
                <div class="dropdown float-end">
                    <a class="text-body dropdown-toggle font-size-16" href="#" role="button"
                       data-bs-toggle="dropdown" aria-haspopup="true">
                        <i class="uil uil-ellipsis-h"></i>
                    </a>

                    <div class="dropdown-menu dropdown-menu-end">
                        <a class="dropdown-item" href="{{route('bookings.edit',$booking->id)}}">@lang('back.edit')</a>
                        <a class="dropdown-item" href="{{route('bookings.destroy',$booking->id)}}">@lang('back.delete')</a>
                    </div>
                </div>
                <div class="d-flex align-items-start">
                    <div class="flex-shrink-0 me-4">
{{--                        <a href="https://wa.me/+2{{str_replace('-','',$booking->client_phone)}}?text=اهلا بك">--}}
                        <a href="https://web.whatsapp.com/send?phone=+2{{$booking->client_phone}}&text={{$booking->whatsappClient}}" target="_blank">

                        <div class="avatar-sm">
                                                    <span
                                                            class="avatar-title bg-soft-success text-success font-size-25 rounded-circle">
                                                        <i class="fab fa-whatsapp" style="font-size:35px;"></i>
                                                    </span>
                            </div>
                        </a>
                    </div>

                    <div class="flex-grow-1 align-self-center">

                        <div class="border-bottom pb-1">
                            <h5 class="text-truncate font-size-16 mb-1">

                                <a
                                        href="{{route('bookings.show',$booking->id)}}"
                                        class="text-dark">{{$booking->client_name}}</a>
                                {!! $booking->status == 'reservation' && $booking->booking_at == \Carbon\Carbon::today() ? '<span class="badge rounded-pill bg-warning animate__animated animate__flash animate__infinite">'.__('back.already_booked').'</span>' : '' !!}
                            </h5>
                            <div class="float-end">
                                @lang('back.price') {{$booking->price}}  @lang('back.L.E')
                            </div>

                            <p class="text-muted">
                                <i class="mdi mdi-account me-1"></i> {{$booking->user->name}}
                            </p>
                        </div>
                        <div class="row">
                            <div class="col-6">
                                <div class="mt-3">
                                    <h6 class="font-size-14 mb-0">@lang('back.from_area')</h6>
                                    <p class="text-muted mb-2">{{$booking->fromArea ? $booking->fromArea->name : ''}}</p>
                                </div>
                            </div>
                            {{--<div class="col-2">
                                <div class="mt-3">
                                    <h5 class="font-size-16 mb-0"><i class="uil-arrow-left"></i></h5>
                                </div>
                            </div>--}}
                            <div class="col-6">
                                <div class="mt-3">
                                    <h6 class="font-size-14 mb-0">@lang('back.to_area')</h6>
                                    <p class="text-muted mb-2">{{$booking->toArea ? $booking->toArea->name : ''}}</p>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-6">
                                <div class="mt-3">
                                    <h6 class="font-size-14 mb-0">@lang('back.call_at')</h6>
                                    <p class="text-muted mb-2">{{$booking->created_at}}</p>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="mt-3">
                                    <h6 class="font-size-14 mb-0">@lang('back.order_at')</h6>
                                    <p class="text-muted mb-2">{{$booking->booking_at}} {{$booking->order_time}} ( {{ $booking->order_day }} )</p>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div> <!-- end col -->
@endforeach
