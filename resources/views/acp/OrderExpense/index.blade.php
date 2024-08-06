@extends('acp.layout.app')

@section('title')
    @lang('back.list_expenses')
@endsection

@section('content')

    <!-- start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-flex align-items-center justify-content-between">
                <h4 class="mb-0">@lang('back.list_expenses')</h4>

                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item active">@lang('back.list_expenses')</li>
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
                    {{--<a href="{{route('maintenances.create')}}" class="btn btn-primary waves-effect waves-light">
                        @lang('back.create') @lang('back.maintenance') <i class="uil uil-plus-square ms-2"></i>
                    </a>
                    --}}
                    <div class="table-responsive">
                        <table class="table table-nowrap table-centered mb-0">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>@lang('back.reason')</th>
                                <th>@lang('back.expense_type')</th>
                                <th>@lang('back.cost')</th>
                                <th>@lang('back.crane')</th>
                                <th>@lang('back.action')</th>
                            </tr>
                            </thead>


                            <tbody>
                            @foreach($expenses as $key => $expenses)
                                <tr>
                                    <td>{{$key+1}}</td>
                                    <td>{{$expenses->reason}}</td>
                                    <td>@lang('back.'.$expenses->expense_type)</td>
                                    <td>{{$expenses->cost}}</td>
                                    <td>{{$expenses->booking->assign->vehicle->car_name}}</td>
                                    <td style="width: 100px">
                                        <a href="{{route('expense_orders.destroy',$expenses->id)}}"
                                           class="btn btn-outline-danger btn-sm" title="@lang('back.delete')">
                                            <i class="fas fa-times"></i>
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div> <!-- end col -->
    </div> <!-- end row -->

@endsection

