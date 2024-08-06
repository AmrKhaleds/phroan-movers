@extends('Dashboard.layouts.app')

@section('title')
    @lang('back.edit_payment_method')
@endsection

@section('css')
    <link rel="stylesheet" href="{{url('back/vendor/summernote/summernote-bs4.css')}}"/>
@endsection
@section('content')

    <!-- Content wrapper start -->
    <div class="content-wrapper">

        <!-- Row starts -->
        <div class="row gutters">
            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                <div class="card">
                    <div class="card-header">
                        <div class="card-title">@lang('back.edit_payment_method')</div>
                    </div>
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
                        <form action="{{route('payments.update',$paymentsMethod->id)}}" method="post">
                            @method('PUT')
                            @csrf
                            <div class="row gutters">
                                <div class="col-xl-6 col-lg col-md-6 col-sm-6 col-12">
                                    <div class="form-group row">
                                        <label for="staticEmail"
                                               class="col-sm-4 col-form-label">@lang('back.name_payment_method')</label>
                                        <div class="col-sm-8">
                                            <input type="text" class="form-control form-control-lg"
                                                   name="name" placeholder="@lang('back.name_payment_method')" value="{{$paymentsMethod->name}}">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xl-6 col-lg col-md-6 col-sm-6 col-12">
                                    <div class="form-group row">
                                        <label for="staticEmail"
                                               class="col-sm-4 col-form-label">@lang('back.description')</label>
                                        <div class="col-sm-8">
                                            <textarea class="summernote" placeholder="@lang('back.description')" rows="3" name="description">{{$paymentsMethod->description}}</textarea>
                                        </div>
                                    </div>
                                </div>


                            </div>
                            <div class="custom-btn-group">
                                <!-- Buttons -->
                                <button type="submit" class="btn btn-primary">@lang('back.submit')</button>
                                <button type="reset" class="btn btn-info">@lang('back.cancel')</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!-- Row end -->

    </div>
    <!-- Content wrapper end -->

@endsection


@section('js')
    <script>
        $(document).ready(function () {
            $('.summernote').summernote({
                toolbar: [
                    // [groupName, [list of button]]
                    ['style', ['bold', 'italic', 'underline', 'clear']],
                    ['font', ['strikethrough', 'superscript', 'subscript']],
                    ['fontsize', ['fontsize']],
                    ['color', ['color']],
                    ['para', ['ul', 'ol', 'paragraph']],
                    ['height', ['height']]
                ],
                height: 170,
            });
        });

    </script>

@endsection
