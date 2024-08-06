@extends('Dashboard.layouts.app')

@section('title')
    @lang('back.payments_method')
@endsection
@section('content')

    <!-- Content wrapper start -->
    <div class="content-wrapper">

        <!-- Row starts -->
        <div class="row gutters">
            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                <div class="card">
                    <div class="card-header">
                        <div class="card-title">@lang('back.payments_method')</div>
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
                        <div class="table-container">
                            <div class="table-responsive">
                                <div class="avatar-group flex-row-reverse">
                                    <a href="{{route('payments.create')}}" class="btn btn-info btn-rounded btn-lg">
                                        <span class="icon-plus-circle"></span> @lang('back.create_payment_method') </a>
                                </div>
                                <br>
                                <table class="table custom-table m-0">
                                    <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>@lang('back.payment_method')</th>
                                        <th>@lang('back.description')</th>
                                        <th>@lang('back.created_at')</th>
                                        <th>@lang('back.action')</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($paymentsMethods as $key => $paymentsMethod)
                                        <tr>
                                            <td>{{$key+1}}</td>
                                            <td>{{$paymentsMethod->name}}</td>
                                            <td>{!! $paymentsMethod->description !!}</td>
                                            <td>{{$paymentsMethod->created_at}}</td>
                                            <td>
                                                <div class="td-actions">
                                                    <form  action="{{ route('payments.destroy' , $paymentsMethod->id) }}"
                                                           method="post">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button class="icon red" data-toggle="tooltip" data-placement="top" title="" data-original-title="@lang('back.delete')">
                                                            <i class="icon-x"></i>
                                                        </button>
                                                    </form>
                                                    <a href="{{ route('payments.edit' , $paymentsMethod->id) }}" class="icon green" data-toggle="tooltip" data-placement="top" title="" data-original-title="@lang('back.edit')">
                                                        <i class="icon-edit"></i>
                                                    </a>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
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
