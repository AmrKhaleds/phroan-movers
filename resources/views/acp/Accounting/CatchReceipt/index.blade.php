@extends('Dashboard.layouts.app')

@section('title')
    @lang('back.catch_receipts')
@endsection

@section('css')
    <!-- Data Tables -->
    <link rel="stylesheet" href="{{url('back/vendor/datatables/dataTables.bs4.css')}}" />
    <link rel="stylesheet" href="{{url('back/vendor/datatables/dataTables.bs4-custom.css')}}" />
    <link href="{{url('back/vendor/datatables/buttons.bs.css')}}" rel="stylesheet" />

@endsection
@section('content')

    <!-- Content wrapper start -->
    <div class="content-wrapper">

        <!-- Row starts -->
        <div class="row gutters">
            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                <div class="card">
                    <div class="card-header">
                        <div class="card-title">@lang('back.catch_receipts')</div>
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
                                    <a href="{{route('catch_receipts.create')}}" class="btn btn-info btn-rounded btn-lg">
                                        <span class="icon-plus-circle"></span> @lang('back.create_catch_receipt') </a>
                                </div>
                                <br>
                                <table id="copy-print-csv" class="table custom-table">
                                    <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>@lang('back.bond_no')</th>
                                        <th>@lang('back.reference')</th>
                                        <th>@lang('back.date')</th>
                                        <th>@lang('back.recipient_from')</th>
                                        <th>@lang('back.amount')</th>
                                        <th>@lang('back.paid_type')</th>
                                        <th>@lang('back.branch_name')</th>
                                        <th>@lang('back.note')</th>
                                        <th>@lang('back.action')</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($catchs as $key => $catch)
                                        <tr class="CatchReceipt" CatchReceipt="{{$catch->id}}">
                                            <td>{{$key+1}}</td>
                                            <td>{{$catch->registration_number}}</td>
                                            <td>{{$catch->reference}}</td>
                                            <td>{{$catch->date}}</td>
                                            <td>{{$catch->dailyMoveItem->first()->account->account_name}}</td>
                                            <td>{{$catch->creditor}}</td>
                                            <td>{{$catch->paymentMethod->name}}</td>
                                            <td>{{$catch->branch->branch_name}}</td>
                                            <td>{{$catch->notes}}</td>
                                            <td>
                                                <div class="td-actions">
                                                    <form  action="{{ route('catch_receipts.destroy' , $catch->id) }}"
                                                           method="post">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button class="icon red" data-toggle="tooltip" data-placement="top" title="" data-original-title="@lang('back.delete')">
                                                            <i class="icon-x"></i>
                                                        </button>
                                                    </form>
                                                    <a href="{{ route('catch_receipts.edit' , $catch->id) }}" class="icon green" data-toggle="tooltip" data-placement="top" title="" data-original-title="@lang('back.edit')">
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
    <div id="model"></div>

@endsection

@section('js')

    <!-- Data Tables -->
    <script src="{{url('back/vendor/datatables/dataTables.min.js')}}"></script>
    <script src="{{url('back/vendor/datatables/dataTables.bootstrap.min.js')}}"></script>

    <!-- Custom Data tables -->
    <script src="{{url('back/vendor/datatables/custom/custom-datatables.js')}}"></script>
    <script src="{{url('back/vendor/datatables/custom/fixedHeader.js')}}"></script>

    <!-- Download / CSV / Copy / Print -->
    <script src="{{url('back/vendor/datatables/buttons.min.js')}}"></script>
    <script src="{{url('back/vendor/datatables/jszip.min.js')}}"></script>
    <script src="{{url('back/vendor/datatables/pdfmake.min.js')}}"></script>
    <script src="{{url('back/vendor/datatables/vfs_fonts.js')}}"></script>
    <script src="{{url('back/vendor/datatables/html5.min.js')}}"></script>
    <script src="{{url('back/vendor/datatables/buttons.print.min.js')}}"></script>
    <script>

        $(document).ready(function () {
            $(".CatchReceipt").click(function () {
                var dailymove = $(this).attr('CatchReceipt') ;
                $('.bd-example-modal-lg').modal('toggle');
                $.ajax({
                    type: "GET",
                    url: '{{route('catch_receipts.details')}}/?id=' + dailymove,
                    success: function (data) {
                        $('#model').empty()
                        $('#model').append(data);
                        $('.bd-example-modal-lg').modal('toggle');

                    }
                });
            });
        });
    </script>

@endsection
