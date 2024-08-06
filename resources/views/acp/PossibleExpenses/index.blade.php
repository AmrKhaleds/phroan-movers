@extends('acp.layout.app')

@section('title')
    @lang('back.possible_expenses')
@endsection

@section('content')

    <!-- start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-flex align-items-center justify-content-between">
                <h4 class="mb-0">@lang('back.possible_expenses')</h4>

                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item active">@lang('back.possible_expenses')</li>
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
                <div class="card-body">
                    @if(Session::has('msg'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            <i class="uil uil-check me-2"></i>
                            {!! session('msg') !!}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">

                            </button>
                        </div>

                    @endif
                        <button type="button" class="btn btn-primary waves-effect waves-light" data-bs-toggle="modal" data-bs-target=".bs-example-modal-center">@lang('back.create') @lang('back.possible_expenses') <i class="uil uil-plus-square ms-2"></i></button>
                        <!-- Center Modal example -->
                        <div class="modal fade bs-example-modal-center" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-lg">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title">@lang('back.create') @lang('back.possible_expenses')</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <form method="post" action="{{route('possible_expenses.store')}}" class="custom-validation" enctype="multipart/form-data">
                                            @csrf

                                            <div class="row">
                                                <div class="col-lg-6">
                                                    <div class="row mb-4">
                                                        <label for="horizontal-Fullname-input"
                                                               class="col-sm-4 col-form-label">@lang('back.expenses_name') </label>
                                                        <div class="col-sm-8">
                                                            <input type="text" class="form-control" required
                                                                   id="horizontal-Fullname-input" value="{{old('expense_name')}}"
                                                                   placeholder="@lang('back.expenses_name') "
                                                                   name="expense_name">
                                                        </div>
                                                    </div>
                                                    <div class="row mb-4">
                                                        <label for="horizontal-Fullname-input"
                                                               class="col-sm-4 col-form-label">@lang('back.cost') </label>
                                                        <div class="col-sm-8">
                                                            <input type="text" class="form-control" required
                                                                   id="horizontal-Fullname-input" value="{{old('cost')}}"
                                                                   placeholder="@lang('back.cost') "
                                                                   name="cost">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-lg-6">
                                                    <div class="row mb-4">
                                                        <label for="horizontal-Fullname-input"
                                                               class="col-sm-4 col-form-label">@lang('back.expense_type') </label>
                                                        <div class="col-sm-8">
                                                            <select name="expense_type" class="form-control" required>
                                                                <option value="" selected disabled>@lang('back.select_one')</option>
                                                                <option value="fixed">@lang('back.fixed_expenses')</option>
                                                                <option value="moving">@lang('back.moving_expenses')</option>
                                                            </select>
                                                        </div>
                                                    </div>

                                                </div>

                                            </div>


                                            <div class="row justify-content-end">
                                                <div class="col-sm-9">
                                                    <div class="d-flex flex-wrap gap-3">
                                                        <button type="submit"
                                                                class="btn btn-primary waves-effect waves-light w-md">@lang('back.submit')</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </form>

                                    </div>
                                </div><!-- /.modal-content -->
                            </div><!-- /.modal-dialog -->
                        </div><!-- /.modal -->
                </div>
            </div>

            <div class="card bg-soft-warning border-warning">
                <div class="card-body">
                    <h6 class="card-text">@lang('back.fixed_expenses')</h6>
                    <h5 class="card-text">@lang('back.total') @lang('back.cost') {{$expenses->where('expense_type','fixed')->sum(['cost'])}} @lang('back.L.E')</h5>

                    <div class="table-responsive">
                        <table class="table table-nowrap table-centered mb-0">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>@lang('back.expenses_name')</th>
                                <th>@lang('back.cost')</th>
                                <th>@lang('back.action')</th>
                            </tr>
                            </thead>


                            <tbody>
                            @foreach($expenses->where('expense_type','fixed') as $key => $expense)
                                <tr>
                                    <td>{{$key+1}}</td>
                                    <td>{{$expense->expense_name}}</td>
                                    <td>{{$expense->cost}}@lang('back.L.E')</td>
                                    <td>
                                        <a href="{{route('possible_expenses.destroy',$expense->id)}}"
                                           class="btn btn-outline-danger btn-sm"
                                           title="@lang('back.delete')"><i class="fas fa-times"></i></a>
                                        <button type="button" title="@lang('back.edit')" class="btn btn-outline-warning btn-sm waves-effect waves-light" data-bs-toggle="modal" data-bs-target=".bs-example-modal-center{{$expense->id}}"><i class="fas fa-pencil-alt ms-2"></i></button>
                                        <!-- Center Modal example -->
                                        <div class="modal fade bs-example-modal-center{{$expense->id}}" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
                                            <div class="modal-dialog modal-lg">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title">@lang('back.create') @lang('back.possible_expenses')</h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <form method="post" action="{{route('possible_expenses.update',$expense->id)}}" class="custom-validation" enctype="multipart/form-data">
                                                            @csrf

                                                            <div class="row">
                                                                <div class="col-lg-6">
                                                                    <div class="row mb-4">
                                                                        <label for="horizontal-Fullname-input"
                                                                               class="col-sm-4 col-form-label">@lang('back.expenses_name') </label>
                                                                        <div class="col-sm-8">
                                                                            <input type="text" class="form-control" required
                                                                                   id="horizontal-Fullname-input" value="{{old('expense_name',$expense->expense_name)}}"
                                                                                   placeholder="@lang('back.expenses_name') "
                                                                                   name="expense_name">
                                                                        </div>
                                                                    </div>
                                                                    <div class="row mb-4">
                                                                        <label for="horizontal-Fullname-input"
                                                                               class="col-sm-4 col-form-label">@lang('back.cost') </label>
                                                                        <div class="col-sm-8">
                                                                            <input type="text" class="form-control" required
                                                                                   id="horizontal-Fullname-input" value="{{old('cost',$expense->cost)}}"
                                                                                   placeholder="@lang('back.cost') "
                                                                                   name="cost">
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="col-lg-6">
                                                                    <div class="row mb-4">
                                                                        <label for="horizontal-Fullname-input"
                                                                               class="col-sm-4 col-form-label">@lang('back.expense_type') </label>
                                                                        <div class="col-sm-8">
                                                                            <select name="expense_type" class="form-control" required>
                                                                                <option value="" selected disabled>@lang('back.select_one')</option>
                                                                                <option {{$expense->expense_type == 'fixed' ? 'selected' : ''}}  value="fixed">@lang('back.fixed_expenses')</option>
                                                                                <option {{$expense->expense_type == 'moving' ? 'selected' : ''}}  value="moving">@lang('back.moving_expenses')</option>
                                                                            </select>
                                                                        </div>
                                                                    </div>

                                                                </div>

                                                            </div>


                                                            <div class="row justify-content-end">
                                                                <div class="col-sm-9">
                                                                    <div class="d-flex flex-wrap gap-3">
                                                                        <button type="submit"
                                                                                class="btn btn-primary waves-effect waves-light w-md">@lang('back.submit')</button>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </form>

                                                    </div>
                                                </div><!-- /.modal-content -->
                                            </div><!-- /.modal-dialog -->
                                        </div><!-- /.modal -->
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <div class="card bg-soft-info border-info">
                <div class="card-body">
                    <h6 class="card-text">@lang('back.moving_expenses')</h6>
                    <h5 class="card-text">@lang('back.total') @lang('back.cost') {{$expenses->where('expense_type','moving')->sum(['cost'])}} @lang('back.L.E')</h5>

                    <div class="table-responsive">
                        <table class="table table-nowrap table-centered mb-0">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>@lang('back.expenses_name')</th>
                                <th>@lang('back.cost')</th>
                                <th>@lang('back.action')</th>
                            </tr>
                            </thead>


                            <tbody>
                            @foreach($expenses->where('expense_type','moving') as $key2 => $expense1)
                                <tr>
                                    <td>{{$key2+1}}</td>
                                    <td>{{$expense1->expense_name}}</td>
                                    <td>{{$expense1->cost}}@lang('back.L.E')</td>
                                    <td>
                                        <a href="{{route('possible_expenses.destroy',$expense1->id)}}"
                                           class="btn btn-outline-danger btn-sm"
                                           title="@lang('back.delete')"><i class="fas fa-times"></i></a>

                                        <button type="button" title="@lang('back.edit')" class="btn btn-outline-warning btn-sm waves-effect waves-light" data-bs-toggle="modal" data-bs-target=".bs-example-modal-center{{$expense1->id}}"><i class="fas fa-pencil-alt ms-2"></i></button>
                                        <!-- Center Modal example -->
                                        <div class="modal fade bs-example-modal-center{{$expense1->id}}" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
                                            <div class="modal-dialog modal-lg">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title">@lang('back.create') @lang('back.possible_expenses')</h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <form method="post" action="{{route('possible_expenses.update',$expense1->id)}}" class="custom-validation" enctype="multipart/form-data">
                                                            @csrf

                                                            <div class="row">
                                                                <div class="col-lg-6">
                                                                    <div class="row mb-4">
                                                                        <label for="horizontal-Fullname-input"
                                                                               class="col-sm-4 col-form-label">@lang('back.expenses_name') </label>
                                                                        <div class="col-sm-8">
                                                                            <input type="text" class="form-control" required
                                                                                   id="horizontal-Fullname-input" value="{{old('expense_name',$expense1->expense_name)}}"
                                                                                   placeholder="@lang('back.expenses_name') "
                                                                                   name="expense_name">
                                                                        </div>
                                                                    </div>
                                                                    <div class="row mb-4">
                                                                        <label for="horizontal-Fullname-input"
                                                                               class="col-sm-4 col-form-label">@lang('back.cost') </label>
                                                                        <div class="col-sm-8">
                                                                            <input type="text" class="form-control" required
                                                                                   id="horizontal-Fullname-input" value="{{old('cost',$expense1->cost)}}"
                                                                                   placeholder="@lang('back.cost') "
                                                                                   name="cost">
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="col-lg-6">
                                                                    <div class="row mb-4">
                                                                        <label for="horizontal-Fullname-input"
                                                                               class="col-sm-4 col-form-label">@lang('back.expense_type') </label>
                                                                        <div class="col-sm-8">
                                                                            <select name="expense_type" class="form-control" required>
                                                                                <option value="" selected disabled>@lang('back.select_one')</option>
                                                                                <option {{$expense1->expense_type == 'fixed' ? 'selected' : ''}}  value="fixed">@lang('back.fixed_expenses')</option>
                                                                                <option {{$expense1->expense_type == 'moving' ? 'selected' : ''}}  value="moving">@lang('back.moving_expenses')</option>
                                                                            </select>
                                                                        </div>
                                                                    </div>

                                                                </div>

                                                            </div>


                                                            <div class="row justify-content-end">
                                                                <div class="col-sm-9">
                                                                    <div class="d-flex flex-wrap gap-3">
                                                                        <button type="submit"
                                                                                class="btn btn-primary waves-effect waves-light w-md">@lang('back.submit')</button>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </form>

                                                    </div>
                                                </div><!-- /.modal-content -->
                                            </div><!-- /.modal-dialog -->
                                        </div><!-- /.modal -->
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

