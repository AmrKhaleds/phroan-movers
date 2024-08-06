@extends('acp.layout.app')

@section('title')
    @lang('back.payrolls')
@endsection

@section('css')
    <link href="{{url('acp/libs/datatables.net-buttons-bs4/css/buttons.bootstrap4.min.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{url('acp/libs/datatables.net-bs4/css/dataTables.bootstrap4.min.css')}}" rel="stylesheet" type="text/css" />
    <!-- Responsive datatable examples -->
    <link href="{{url('acp/libs/datatables.net-responsive-bs4/css/responsive.bootstrap4.min.css')}}" rel="stylesheet" type="text/css" />

@endsection

@section('content')

    <!-- start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-flex align-items-center justify-content-between">
                <h4 class="mb-0">@lang('back.payrolls')</h4>

                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item active">@lang('back.payrolls')</li>
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
                    <a href="{{route('payrolls.create')}}" class="btn btn-primary waves-effect waves-light">
                        @lang('back.set_payroll') <i class="uil uil-plus-square ms-2"></i>
                    </a>

                    <table id="datatable-buttons" class="table table-striped table-bordered dt-responsive nowrap"
                           style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>@lang('back.name') @lang('back.employee')</th>
                            <th>@lang('back.payroll_type')</th>
                            <th>@lang('back.payroll_value')</th>
                            <th>@lang('back.reason')</th>
                            <th>@lang('back.month')</th>
                            <th>@lang('back.status')</th>
                            <th>@lang('back.action')</th>
                        </tr>
                        </thead>


                        <tbody>
                        @foreach($payrolls as $key => $payroll)
                            <tr>
                                <td>{{$key+1}}</td>
                                <td>{{$payroll->user->name}}</td>
                                <td><span class="badge rounded-pill bg-soft-{{$payroll->color}} text-{{$payroll->color}}"><i class="{{$payroll->icon}}"></i> @lang('back.'.$payroll->payroll_type) </span></td>
                                <td>{{$payroll->payroll_value}} @lang('back.L.E')</td>
                                <td>{{$payroll->reason}}</td>
                                <td>{{\Carbon\Carbon::createFromFormat('!m', $payroll->set_month)->translatedFormat('F')}}</td>
                                <td><span class="badge rounded-pill bg-soft-{{$payroll->status_color}} text-{{$payroll->status_color}}"> @lang('back.'.$payroll->status) </span></td>
                                <td style="width: 100px">
                                    @if($payroll->status == 'HOLD')
                                    <a href="{{route('payrolls.status',$payroll->id)}}" class="btn btn-outline-danger btn-sm" title="@lang('back.APPROVE')">
                                        <i class="fas fa-check"></i>
                                    </a>
                                    @else
                                        <a href="{{route('payrolls.status',$payroll->id)}}" class="btn btn-outline-success btn-sm" title="@lang('back.HOLD')">
                                            <i class="fas fa-info-circle"></i>
                                        </a>
                                    @endif
                                    @if($payroll->status == 'HOLD')
                                    <a href="{{route('payrolls.edit',$payroll->id)}}" class="btn btn-outline-warning btn-sm" title="@lang('back.edit')">
                                        <i class="fas fa-pencil-alt"></i>
                                    </a>
                                    @endif

                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div> <!-- end col -->
    </div> <!-- end row -->

@endsection


@section('js')
    <!-- Required datatable js -->
    <script src="{{url('acp/libs/datatables.net/js/jquery.dataTables.min.js')}}"></script>
    <script src="{{url('acp/libs/datatables.net-bs4/js/dataTables.bootstrap4.min.js')}}"></script>

    <!-- Buttons examples -->
    <script src="{{url('acp/libs/datatables.net-buttons/js/dataTables.buttons.min.js')}}"></script>
    <script src="{{url('acp/libs/datatables.net-buttons-bs4/js/buttons.bootstrap4.min.js')}}"></script>
    <script src="{{url('acp/libs/jszip/jszip.min.js')}}"></script>
    <script src="{{url('acp/libs/pdfmake/build/pdfmake.min.js')}}"></script>
    <script src="{{url('acp/libs/pdfmake/build/vfs_fonts.js')}}"></script>
    <script src="{{url('acp/libs/datatables.net-buttons/js/buttons.html5.min.js')}}"></script>
    <script src="{{url('acp/libs/datatables.net-buttons/js/buttons.print.min.js')}}"></script>
    <script src="{{url('acp/libs/datatables.net-buttons/js/buttons.colVis.min.js')}}"></script>

    <!-- Datatable init js -->
    <script src="{{url('acp/js/pages/datatables.init.js')}}"></script>
@endsection

