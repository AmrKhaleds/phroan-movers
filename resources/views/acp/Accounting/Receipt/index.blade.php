@extends('Dashboard.layouts.app')

@section('title')
    @lang('back.receipts')
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
                        <div class="card-title">@lang('back.receipts')</div>
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
                                    <a href="{{route('receipts.create')}}" class="btn btn-info btn-rounded btn-lg">
                                        <span class="icon-plus-circle"></span> @lang('back.create_receipt') </a>
                                </div>
                                <br>
                                <table id="copy-print-csv" class="table custom-table">
                                    <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>@lang('back.bond_no')</th>
                                        <th>@lang('back.reference')</th>
                                        <th>@lang('back.date')</th>
                                        <th>@lang('back.recipient_to')</th>
                                        <th>@lang('back.amount')</th>
                                        <th>@lang('back.paid_type')</th>
                                        <th>@lang('back.branch_name')</th>
                                        <th>@lang('back.note')</th>
                                        <th>@lang('back.action')</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($catchs as $key => $catch)
                                        <tr>
                                            <td>{{$key+1}}</td>
                                            <td>{{$catch->bond_no}}</td>
                                            <td>{{$catch->reference}}</td>
                                            <td>{{$catch->date}}</td>
                                            <td>{{$catch->supplier->name}}</td>
                                            <td>{{$catch->amount}}</td>
                                            <td>{{$catch->paymentMethod->name}}</td>
                                            <td>{{$catch->branch->branch_name}}</td>
                                            <td>{{$catch->note}}</td>
                                            <td>
                                                <div class="td-actions">
                                                    <form  action="{{ route('receipts.destroy' , $catch->id) }}"
                                                           method="post">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button class="icon red" data-toggle="tooltip" data-placement="top" title="" data-original-title="@lang('back.delete')">
                                                            <i class="icon-x"></i>
                                                        </button>
                                                    </form>
                                                    <a href="{{ route('receipts.edit' , $catch->id) }}" class="icon green" data-toggle="tooltip" data-placement="top" title="" data-original-title="@lang('back.edit')">
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

@endsection
