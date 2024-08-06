@extends('Dashboard.layouts.app')

@section('title')
    @lang('back.bills')
@endsection
@section('content')


    <!-- Content wrapper start -->
    <div class="content-wrapper">

        <!-- Row starts -->
        <div class="row gutters">
            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                <div class="card">
                    <div class="card-header">
                        <div class="card-title">@lang('back.bills')</div>
                    </div>
                    @if(Session::has('msg'))
                        <div class="alert alert-success">
                            <strong>{!! session('msg') !!}</strong>
                        </div>
                    @endif
                    @if($errors->any())
                        <div class="alert alert-danger">
                            @foreach($errors->all() as $error)
                                <p>{{ $error }}</p>
                            @endforeach
                        </div>
                    @endif

                    <div class="card-body">
                        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">

                                <div class="card-body">


                                    <div class="table-container">
                                        <div class="table-responsive">
                                            <table class="table custom-table m-0">
                                                <tbody>
                                                <tr>
                                                    <td>@lang('back.bill_num')</td>
                                                    <td>@lang('back.client_name')</td>
                                                    <td>@lang('back.make_by')</td>
                                                    <td>@lang('back.created_at')</td>
                                                    <td>@lang('back.grand_total')</td>
                                                    {{--                                                    <td>@lang('back.action')</td>--}}
                                                </tr>
                                                @foreach($bills as $bill)
                                                    @if(is_null($bill->client->deleted_at))
                                                    <tr>
                                                        <td>
                                                            <a href="{{route('bills.show',$bill->id)}}"><h4>#{{$bill->bill_num}}</h4></a>
                                                        </td>
                                                        <td>{{$bill->client->name}}</td>
                                                        <td>{{$bill->user->name}}</td>
                                                        <td>{{$bill->created_at}}</td>
                                                        <td>{{$bill->total_price}}</td>
                                                        {{--<td>
                                                            --}}{{--                                                                            <a class="btn btn-success btn-rounded" href="{{route('projects.flow.type',[1,$service->id])}}">@lang('back.start')</a>--}}{{--
                                                            <a class="btn btn-danger btn-rounded" href="{{route('projects.file.delete',$bill->id)}}">@lang('back.delete')</a>
                                                        </td>--}}
                                                    </tr>
                                                    @endif
                                                @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>


                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Row end -->

    </div>
    <!-- Content wrapper end -->

@endsection
