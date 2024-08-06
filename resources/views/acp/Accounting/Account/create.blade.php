@extends('acp.layout.app')

@section('title')
    @lang('back.create') @lang('back.account')
@endsection

@section('css')
    <link href="{{url('acp/libs/select2/css/select2.min.css')}}" rel="stylesheet" type="text/css"/>
@endsection
@section('content')

    <!-- start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-flex align-items-center justify-content-between">
                <h4 class="mb-0">@lang('back.create') @lang('back.account')</h4>

                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item active">@lang('back.create') @lang('back.account')</li>
                        <li class="breadcrumb-item ">@lang('back.accounts')</li>
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

                    <form action="{{route('accounts.store')}}" method="post">
                        @method('POST')
                        @csrf
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="mt-5 mt-lg-4">
                                    <div class="row mb-4">

                                        <label for="staticEmail"
                                               class="col-sm-4 col-form-label">@lang('back.account_name')</label>
                                        <div class="col-sm-8">
                                            <input type="text" class="form-control "
                                                   name="account_name" placeholder="@lang('back.account_name')"
                                                   value="{{old('account_name')}}">
                                        </div>
                                    </div>
                                    <div class="row mb-4">

                                        <label for="staticEmail"
                                               class="col-sm-4 col-form-label">@lang('back.parent_account')</label>
                                        <div class="col-sm-8">
                                            <select name="parent_account" id="emptyDropdown"
                                                    class="form-control select2">
                                                <option value="">@lang('back.select_one')</option>
                                                @foreach($trees->where('parent_id','!=',0) as $parent)
                                                    <option value="{{$parent->id}}">{{$parent->name}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="mt-5 mt-lg-4">
                                    <div class="row mb-4">

                                        <label for="staticEmail"
                                               class="col-sm-4 col-form-label">@lang('back.account_type')</label>
                                        <div class="col-sm-8">
                                            <select name="account_type" id="parent"
                                                    class="form-control select2">
                                                <option value="">@lang('back.select_one')</option>
                                                @foreach($trees->where('parent_id',0) as $type)
                                                    <option value="{{$type->id}}">{{$type->name}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="row mb-4">

                                        <label for="staticEmail"
                                               class="col-sm-4 col-form-label">@lang('back.description')</label>
                                        <div class="col-sm-8">
                                            <textarea class="summernote" placeholder="@lang('back.description')"
                                                      cols="40" rows="4" name="description">{{old('description')}}</textarea>
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


@section('js')

    <script>

        $(document).ready(function () {
            $("#parent").change(function () {
                $('#emptyDropdown').empty()
                var dropDown = document.getElementById("parent");
                var parent = dropDown.options[dropDown.selectedIndex].value;
                $.ajax({
                    type: "GET",
                    url: '{{route('account.ajax')}}/?id=' + parent,
                    success: function (data) {
                        // Parse the returned json data
                        // Use jQuery's each to iterate over the opts value
                        $('#emptyDropdown').append('<option value="">@lang('back.select_one')</option>');
                        $('#emptyDropdown').append('<option value="' + parent + '">@lang('back.parent')</option>');
                        $.each(data, function (i, d) {
                            $('#emptyDropdown').append('<option value="' + d.id + '">' + d.account_name + '</option>');
                        });
                    }
                });
            });
        });

    </script>
    <script src="{{url('acp/libs/select2/js/select2.min.js')}}"></script>


    <!-- init js -->
    <script src="{{url('acp/js/pages/form-advanced.init.js')}}"></script>

@endsection
