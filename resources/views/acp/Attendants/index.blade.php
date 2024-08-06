@extends('acp.layout.app')

@section('title')
    @lang('back.attendants') {{$title}}
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
                <h4 class="mb-0">@lang('back.attendants') {{$title}}</h4>

                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item active">@lang('back.attendants') {{$title}}</li>
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

                    <table id="datatable-buttons" class="table table-striped table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>@lang('back.name')</th>
                            <th>@lang('back.check_at')</th>
                            <th>@lang('back.type')</th>
                            <th>@lang('back.status')</th>
                            <th>@lang('back.approved_by')</th>
                        </tr>
                        </thead>


                        <tbody>
                        @foreach($attendants as $key => $attendant)
                            <tr>
                                <td>{{$key+1}}</td>
                                <td>{{$attendant->user->name}}</td>
                                <td>{{$attendant->check_at}}</td>
                                <td><span class="badge rounded-pill bg-soft-{{$attendant->type == 'CHECKIN' ?'success' : 'danger'}} font-size-16">@lang('back.'.$attendant->type)</span></td>
                                <td>
                                    <a href="{{route('attendants.status',$attendant->id)}}" class="btn btn-{{$attendant->status == 'HOLD' ?'warning' : 'success'}} btn-sm btn-rounded waves-effect waves-light">
                                        @lang('back.'.$attendant->status)
                                    </a>
                                </td>
                                <td>{{$attendant->approved_by ? $attendant->approved->name : '-'}}</td>
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

