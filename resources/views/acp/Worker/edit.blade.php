@extends('acp.layout.app')

@section('title')
    @lang('back.edit') @lang('back.worker')
@endsection
@section('content')

    <!-- start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-flex align-items-center justify-content-between">
                <h4 class="mb-0">@lang('back.edit') @lang('back.worker')</h4>

                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item active">@lang('back.edit') @lang('back.worker')</li>
                        <li class="breadcrumb-item ">@lang('back.workers')</li>
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

                    <form method="post" action="{{route('workers.update',$worker->id)}}" class="custom-validation">
                        @method('PUT')
                        @csrf
                        <div class="row">

                            <div class="col-lg-6">
                                <div class="mt-5 mt-lg-4">
                                    <div class="row mb-4">
                                        <label for="horizontal-Fullname-input"
                                               class="col-sm-4 col-form-label">@lang('back.name') *</label>
                                        <div class="col-sm-8">
                                            <input type="text" class="form-control" id="horizontal-Fullname-input" value="{{old('name',$worker->name)}}"
                                                   placeholder="@lang('back.name')" name="name" required>
                                        </div>
                                    </div>

                                </div>
                                <div class="mt-5 mt-lg-4">
                                    <div class="row mb-4">
                                        <label for="horizontal-Fullname-input"
                                               class="col-sm-4 col-form-label">@lang('back.phone') *</label>
                                        <div class="col-sm-8">
                                            <input type="text" class="form-control" id="horizontal-Fullname-input" value="{{old('phone',$worker->phone)}}"
                                                   placeholder="@lang('back.phone')" name="phone">
                                        </div>
                                    </div>

                                </div>
                            </div>
                            <div class="col-lg-6">
                                @if(!$worker->parent)

                                <div class="mt-5 mt-lg-4">
                                    <div class="row mb-4">
                                        <label for="horizontal-Fullname-input"
                                               class="col-sm-4 col-form-label">@lang('back.job_type') *</label>
                                        <div class="col-sm-8">
                                            <select class="form-control" name="job_type" required>
                                                <option value="" selected disabled>@lang('back.select_one')</option>
                                                <option {{$worker->job_type == 'HVAC_technician' ? 'selected' : ''}} value="HVAC_technician">@lang('back.HVAC_technician')</option>
                                                <option {{$worker->job_type == 'carpenter' ? 'selected' : ''}} value="carpenter">@lang('back.carpenter')</option>
                                                <option {{$worker->job_type == 'wrapping' ? 'selected' : ''}} value="wrapping">@lang('back.wrapping')</option>
                                                <option {{$worker->job_type == 'workers' ? 'selected' : ''}} value="workers">@lang('back.workers')</option>
                                            </select>
                                        </div>
                                    </div>

                                </div>
                                @endif

                                <div class="mt-5 mt-lg-4">
                                    <div class="row mb-4">
                                        <label for="horizontal-Fullname-input"
                                               class="col-sm-4 col-form-label">@lang('back.phone2')</label>
                                        <div class="col-sm-8">
                                            <input type="text" class="form-control" id="horizontal-Fullname-input" value="{{old('phone2',$worker->phone2)}}"
                                                   placeholder="@lang('back.phone2')" name="phone2">
                                        </div>
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
            </div>
        </div>
    </div>

@endsection
