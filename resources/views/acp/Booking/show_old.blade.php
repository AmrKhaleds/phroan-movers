@extends('acp.layout.app')

@section('title')
    @lang('back.show') @lang('back.bookings')
@endsection

@section('css')
    <link href="{{url('acp/libs/jquery-bar-rating/themes/css-stars.css')}}" rel="stylesheet" type="text/css"/>
    <link href="{{url('acp/libs/jquery-bar-rating/themes/fontawesome-stars-o.css')}}" rel="stylesheet" type="text/css"/>
    <link href="{{url('acp/libs/jquery-bar-rating/themes/fontawesome-stars.css')}}" rel="stylesheet" type="text/css"/>
    <style>
        .fas {
            font-size: x-large;
        }
    </style>
@endsection

@section('content')

    <!-- start page title -->
    <div class="row">
        <div class="col-12">
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
            <div class="page-title-box d-flex align-items-center justify-content-between">
                <h4 class="mb-0">@lang('back.show') @lang('back.bookings')</h4>

                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item active">@lang('back.show') @lang('back.bookings')</li>
                        <li class="breadcrumb-item "><a href="{{route('bookings.index')}}">@lang('back.bookings')</a></li>
                        <li class="breadcrumb-item ">@lang('back.dashborad')</li>
                    </ol>
                </div>

            </div>
        </div>
    </div>
    <!-- end page title -->

    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">

                    {!! $res->getBody() !!}





                </div>
            </div>
        </div>
    </div>
    <!-- end row -->


@endsection
@section('js')

    <!-- jquery-bar-rating js -->
    <script src="{{url('acp/libs/jquery-bar-rating/jquery.barrating.min.js')}}"></script>

    <script src="{{url('acp/js/pages/rating-init.js')}}"></script>
@endsection

