@extends('acp.layout.app')

@section('title')
    @lang('back.accounts')
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
                <h4 class="mb-0">@lang('back.accounts')</h4>

                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item active">@lang('back.accounts')</li>
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
                    <a href="{{route('accounts.create')}}" class="btn btn-primary waves-effect waves-light">
                        @lang('back.create') @lang('back.account') <i class="uil uil-plus-square ms-2"></i>
                    </a>

                    <table id="datatable-buttons" class="table custom-table">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>@lang('back.account_num')</th>
                            <th>@lang('back.account_name')</th>
                            <th>@lang('back.balance')</th>
                            <th>@lang('back.parent_account')</th>
                            <th>@lang('back.account_type')</th>
                            <th>@lang('back.created_at')</th>
                            <th>@lang('back.action')</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($accounts as $key => $account)
                            <tr>
                                <td>{{$key+1}}</td>
                                <td>{{$account->num}}</td>
                                <th>
                                    <a href="{{route('accounts.show',$account->id)}}">{{$account->account_name}}</a>
                                </th>
                                <td>{{$account->balance}}</td>
                                <td>{{$account->masters->name}}</td>
                                <td>{{$account->name}}</td>
                                <td>{{$account->created_at}}</td>
                                <td style="width: 100px">
                                    <a href="{{route('accounts.edit',$account->id)}}" class="btn btn-outline-warning btn-sm" title="@lang('back.edit')">
                                        <i class="fas fa-pencil-alt"></i>
                                    </a>
                                    <a href="{{route('accounts.destroy',$account->id)}}" class="btn btn-outline-danger btn-sm" title="@lang('back.delete')">
                                        <i class="fas fa-times"></i>
                                    </a>
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
