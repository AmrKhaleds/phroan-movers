@extends('acp.layout.app')


@section('title')
    @lang('back.dailymoves')
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
                <h4 class="mb-0">@lang('back.dailymoves')</h4>

                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item active">@lang('back.dailymoves')</li>
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
                    <a href="{{route('dailymoves.create')}}" class="btn btn-primary waves-effect waves-light">
                        @lang('back.create_dailymove') <i class="uil uil-plus-square ms-2"></i>
                    </a>

                    <table id="datatable-buttons" class="table custom-table">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>@lang('back.account_num')</th>
                            <th>@lang('back.type')</th>
                            <th>@lang('back.account_name')</th>
                            <th>@lang('back.debtor')</th>
                            <th>@lang('back.creditor')</th>
                            <th>@lang('back.note')</th>
                            <th>@lang('back.created_at')</th>
                        </tr>
                        </thead>
                        <tbody>
                        @php
                            $debtor =0;
                            $creditor =0;
                        @endphp
                        @foreach($dailymoves as $key => $dailymove)
                            @php
                                $debtor +=$dailymove->debtor;
                                $creditor +=$dailymove->creditor;
                            @endphp
                            <tr account="{{$dailymove->id}}" class="account">
                                <td>{{$key+1}}</td>
                                <td>{{$dailymove->registration_number}}</td>
                                <th>{{$dailymove->type}}</th>
                                <td>
                                    @foreach($dailymove->dailyMoveItem as $dailyMoveItem)
                                        {{$dailyMoveItem->account->name}}
                                        <hr>
                                    @endforeach
                                </td>
                                <td>{{$dailymove->debtor}}</td>
                                <td>{{$dailymove->creditor}}</td>
                                <td>{{$dailymove->notes}}</td>
                                <td>{{$dailymove->created_at}}</td>
                                {{--
                                                                            <td>
                                                                                <div class="td-actions">
                                                                                    <form  action="{{ route('dailymoves.destroy' , $dailymove->id) }}"
                                                                                           method="post">
                                                                                        @csrf
                                                                                        @method('DELETE')
                                                                                        <button type="submit"
                                                                                                class="btn btn-danger btn-rounded waves-effect waves-light">@lang('back.delete')</button>
                                                                                    </form>
                                                                                    <a href="{{ route('dailymoves.edit' , $dailymove->id) }}" class="btn btn-success  btn-rounded waves-effect waves-light" data-toggle="tooltip" data-placement="top" title="" data-original-title="@lang('back.edit')">
                                                                                        @lang('back.edit')
                                                                                    </a>
                                                                                </div>
                                                                            </td>
                                --}}
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                    <table class="total_all table table-bordered table-striped" rowspan="4" colspan="10" style=" margin-top: 1px; ">
                        <tbody>
                        <tr class="total_header">
                            <td class="text-center w_max" rowspan="3" colspan="4" style=" background-color: #fffad2; ">
                                <h5> @lang('back.grand_total') </h5>
                            </td>

                            <td class="text-center total_debit"><h5>  @lang('back.sub_total')  @lang('back.debtor') </h5></td>
                            <td class="text-center total_credite"><h5>  @lang('back.sub_total') @lang('back.creditor')  </h5></td>
                        </tr>
                        <tr class="total_tr" style="text-align: center">
                            <td id="total_debit"><h5> {{$debtor}}</h5></td>
                            <td id="total_credite"><h5> {{$creditor}}</h5></td>

                        </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div> <!-- end col -->
    </div> <!-- end row -->


    <div id="model"></div>

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
    <script>

        $(document).ready(function () {
            $(".account").click(function () {
                var dailymove = $(this).attr('account') ;
                $.ajax({
                    type: "GET",
                    url: '{{route('account.details')}}/?id=' + dailymove,
                    success: function (data) {
                        $('#model').empty()
                        $('#model').append(data);
                        $('.bd-example-modal-lg').modal('show');

                    }
                });
            });
        });
    </script>

@endsection
