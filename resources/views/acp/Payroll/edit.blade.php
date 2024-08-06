@extends('acp.layout.app')

@section('title')
    @lang('back.edit') @lang('back.set_payroll')
@endsection
@section('content')

    <!-- start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-flex align-items-center justify-content-between">
                <h4 class="mb-0">@lang('back.edit') @lang('back.set_payroll')</h4>

                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item active">@lang('back.edit') @lang('back.set_payroll')</li>
                        <li class="breadcrumb-item ">@lang('back.payrolls')</li>
                        <li class="breadcrumb-item">@lang('back.dashborad')</li>
                    </ol>
                </div>

            </div>
        </div>
    </div>
    <!-- end page title -->



    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                @if(Session::has('msg'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <i class="uil uil-check me-2"></i>
                        {!! session('msg') !!}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">

                        </button>
                    </div>

                @endif
                @if($errors->any())
                    @foreach($errors->all() as $error)
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <p></p>
                            <i class="uil uil-exclamation-octagon me-2"></i>
                            {{ $error }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">

                            </button>
                        </div>
                    @endforeach
                @endif
                <div class="card-body">

                    <div class="row">
                        <div class="col-lg-12">

                                <form method="post" action="{{route('payrolls.update',$payroll->id)}}" class="custom-validation">
                                    @csrf
                                    <div class="row">
                                        <div class="col-lg-6">
                                            <div class="mt-5 mt-lg-4">
                                                <div class="row mb-4">
                                                    <label for="name"
                                                           class="col-sm-4 col-form-label">@lang('back.name') @lang('back.employee') *</label>
                                                    <div class="col-sm-8">
                                                        <select name="user_id" class="form-control select2" id="name" required>
                                                            <option value="">@lang('back.select_one')</option>
                                                            @foreach($employees as $employee)
                                                                <option {{$payroll->user_id == $employee->id ? 'selected' : ''}}  value="{{$employee->id}}">{{$employee->name}}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>

                                                <div class="row mb-4">
                                                    <label for="payroll_type"
                                                           class="col-sm-4 col-form-label">@lang('back.type_value') *</label>
                                                    <div class="col-sm-8">
                                                        <select name="type_value" class="form-control select2" id="type_value" required>
                                                            <option value="">@lang('back.select_one')</option>
                                                            <option {{$payroll->type_value == '$' ? 'selected' : ''}} value="$">$</option>
                                                            <option {{$payroll->type_value == '%' ? 'selected' : ''}} value="%">%</option>
                                                        </select>
                                                    </div>
                                                </div>


                                                <div class="row mb-4">
                                                    <label for="reason"
                                                           class="col-sm-4 col-form-label">@lang('back.reason') *</label>
                                                    <div class="col-sm-8">
                                                        <textarea placeholder="@lang('back.reason')" id="reason" name="reason" required class="form-control" cols="30" rows="5">{{old('reason',$payroll->reason)}}</textarea>
                                                    </div>
                                                </div>








                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="mt-5 mt-lg-4">
                                                <div class="row mb-4">
                                                    <label for="payroll_type"
                                                           class="col-sm-4 col-form-label">@lang('back.payroll_type') *</label>
                                                    <div class="col-sm-8">
                                                        <select name="payroll_type" class="form-control select2" id="payroll_type" required>
                                                            <option value="">@lang('back.select_one')</option>
                                                            <option {{$payroll->payroll_type == 'deduction' ? 'selected' : ''}} value="deduction">@lang('back.deduction')</option>
                                                            <option {{$payroll->payroll_type == 'reward' ? 'selected' : ''}} value="reward">@lang('back.reward')</option>
                                                        </select>
                                                    </div>
                                                </div>

                                                <div class="row mb-4">
                                                    <label for="val"
                                                           class="col-sm-4 col-form-label">@lang('back.value') *</label>
                                                    <div class="col-sm-8">
                                                        <input type="number" class="form-control" id="val"
                                                               value="{{old('val',$payroll->val)}}" required
                                                               placeholder="@lang('back.value')"
                                                               name="val">
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
                                            </div>
                                        </div>
                                    </div>

                                </form>
                        </div>
                    </div>


                </div>
            </div>
        </div>
    </div>

@endsection
