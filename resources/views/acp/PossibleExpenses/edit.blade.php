@extends('acp.layout.app')

@section('title')
    @lang('back.edit') @lang('back.company')
@endsection
@section('content')

    <!-- start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-flex align-items-center justify-content-between">
                <h4 class="mb-0">@lang('back.edit') @lang('back.company')</h4>

                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item active">@lang('back.edit') @lang('back.company')</li>
                        <li class="breadcrumb-item ">@lang('back.companies')</li>
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

                        <form method="post" action="{{route('companies.update',$company->id)}}"
                              class="custom-validation">
                            @csrf
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="row mb-4">
                                        <label for="horizontal-Fullname-input"
                                               class="col-sm-4 col-form-label">@lang('back.name') @lang('back.company') </label>
                                        <div class="col-sm-8">
                                            <input type="text" class="form-control" required
                                                   id="horizontal-Fullname-input" value="{{old('name',$company->name)}}"
                                                   placeholder="@lang('back.name') @lang('back.company') "
                                                   name="name">
                                        </div>
                                    </div>
                                    <div class="row mb-4">
                                        <label for="horizontal-Fullname-input"
                                               class="col-sm-4 col-form-label">@lang('back.phone') </label>
                                        <div class="col-sm-8">
                                            <input type="text" class="form-control" required
                                                   id="horizontal-Fullname-input"
                                                   value="{{old('phone',$company->phone)}}"
                                                   placeholder="@lang('back.phone') "
                                                   name="phone">
                                        </div>
                                    </div>
                                    <div class="row mb-4">
                                        <label for="horizontal-Fullname-input"
                                               class="col-sm-4 col-form-label">@lang('back.address') </label>
                                        <div class="col-sm-8">
                                            <input type="text" class="form-control" required
                                                   id="horizontal-Fullname-input"
                                                   value="{{old('address',$company->address)}}"
                                                   placeholder="@lang('back.address') "
                                                   name="address">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="row mb-4">
                                        <label for="horizontal-Fullname-input"
                                               class="col-sm-4 col-form-label">@lang('back.manger') </label>
                                        <div class="col-sm-8">
                                            <input type="text" class="form-control" required
                                                   id="horizontal-Fullname-input"
                                                   value="{{old('manger',$company->manger)}}"
                                                   placeholder="@lang('back.manger') "
                                                   name="manger">
                                        </div>
                                    </div>
                                    <div class="row mb-4">
                                        <label for="horizontal-Fullname-input"
                                               class="col-sm-4 col-form-label">@lang('back.whatsapp') </label>
                                        <div class="col-sm-8">
                                            <input type="text" class="form-control" required
                                                   id="horizontal-Fullname-input"
                                                   value="{{old('whatsapp',$company->whatsapp)}}"
                                                   placeholder="@lang('back.whatsapp') "
                                                   name="whatsapp">
                                        </div>
                                    </div>
                                    <div class="row mb-4">
                                        <label for="horizontal-Fullname-input"
                                               class="col-sm-4 col-form-label">@lang('back.logo') </label>
                                        <div class="col-sm-8">
                                            <input type="file" class="form-control" 
                                                   id="horizontal-Fullname-input" name="logo">
                                            <img src="{{getFile($company->logo)}}" alt="" width="10%">
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
    </div>

@endsection
