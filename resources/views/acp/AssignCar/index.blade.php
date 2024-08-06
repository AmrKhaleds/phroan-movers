@extends('acp.layout.app')

@section('title')
    @lang('back.assign_cars')
@endsection

@section('content')

    <!-- start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-flex align-items-center justify-content-between">
                <h4 class="mb-0">@lang('back.assign_cars')</h4>

                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item active">@lang('back.assign_cars')</li>
                        <li class="breadcrumb-item">@lang('back.vehicles')</li>
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
                @if(Session::has('msg'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <i class="uil uil-check me-2"></i>
                        {!! session('msg') !!}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">

                        </button>
                    </div>

                @endif
                <div class="card-body">
                    <button type="button" class="btn btn-primary waves-effect waves-light" data-bs-toggle="modal"
                            data-bs-target=".bs-example-modal-lg">
                        @lang('back.create') @lang('back.assign') <i class="uil uil-plus-square ms-2"></i>
                    </button>
                    <div class="">
                        <br>
                        <ul class="verti-timeline list-unstyled">
                            @foreach($assigns as $key => $assign)
                                <li class="event-list">
                                    <div class="event-date text-primar">{{$assign->assign_at}}</div>
                                    <h5>@lang('back.drivrer_name') {{$assign->user->name}}</h5>
                                    <p class="text-muted">@lang('back.counter_number') {{$assign->counter_number}}</p>
                                    @if($assign->description)
                                        <p class="text-muted">{!! $assign->description !!}</p>
                                    @endif
                                    <div>
                                        <button type="button" class="btn btn-outline-warning btn-sm"
                                                data-bs-toggle="modal"
                                                data-bs-target=".bs-example-modal-lg{{$assign->id}}"
                                                title="@lang('back.edit')">
                                            <i class="fas fa-pencil-alt"></i>
                                        </button>

                                        <a href="{{route('assign_cars.destroy',$assign->id)}}"
                                           class="btn btn-outline-danger btn-sm" title="@lang('back.delete')">
                                            <i class="fas fa-times"></i>
                                        </a>
                                    </div>
                                </li>
                                <!--  Large modal example -->
                                <div class="modal fade bs-example-modal-lg{{$assign->id}}" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel"
                                     aria-hidden="true">
                                    <div class="modal-dialog modal-lg">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="myLargeModalLabel">@lang('back.create') @lang('back.assign')</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <form method="post" action="{{route('assign_cars.update',$assign->id)}}">
                                                    @csrf
                                                    <div class="row">
                                                        <div class="col-lg-6">

                                                            <div class="row mb-4">
                                                                <label for="horizontal-Fullname-input"
                                                                       class="col-sm-4 col-form-label">@lang('back.drivrer_name') *</label>
                                                                <div class="col-sm-8">
                                                                    <select name="user_id" class="form-control" required>
                                                                        <option value="">@lang('back.select_one')</option>
                                                                        @foreach($drivers as $driver)
                                                                            <option {{$assign->user_id == $driver->id ? 'selected' : '' }} value="{{$driver->id}}">{{$driver->name}}</option>
                                                                        @endforeach
                                                                    </select>
                                                                </div>
                                                            </div>

                                                            <div class="row mb-4">
                                                                <label for="horizontal-Fullname-input"
                                                                       class="col-sm-4 col-form-label">@lang('back.counter_number') *</label>
                                                                <div class="col-sm-8">
                                                                    <input type="text" class="form-control" id="horizontal-Fullname-input"
                                                                           value="{{old('counter_number',$assign->counter_number)}}" required
                                                                           placeholder="@lang('back.counter_number')"
                                                                           name="counter_number">
                                                                </div>
                                                            </div>


                                                        </div>
                                                        <div class="col-lg-6">


                                                            <div class="row mb-4">
                                                                <label for="horizontal-Fullname-input"
                                                                       class="col-sm-4 col-form-label">@lang('back.description')</label>
                                                                <div class="col-sm-8">
                                                                    <textarea name="description" class="classic-editor" cols="30" rows="5">{{old('description',$assign->description)}}</textarea>


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
                                                </form>

                                            </div>
                                        </div><!-- /.modal-content -->
                                    </div><!-- /.modal-dialog -->
                                </div><!-- /.modal -->

                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!--  Large modal example -->
    <div class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel"
         aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="myLargeModalLabel">@lang('back.create') @lang('back.assign')</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                    </button>
                </div>
                <div class="modal-body">
                    <form method="post" action="{{route('assign_cars.store',$id)}}">
                        @csrf
                        <div class="row">
                            <div class="col-lg-6">

                                <div class="row mb-4">
                                    <label for="horizontal-Fullname-input"
                                           class="col-sm-4 col-form-label">@lang('back.drivrer_name') *</label>
                                    <div class="col-sm-8">
                                        <select name="user_id" class="form-control" required>
                                            <option value="">@lang('back.select_one')</option>
                                            @foreach($drivers as $driver)
                                                <option value="{{$driver->id}}">{{$driver->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                <div class="row mb-4">
                                    <label for="horizontal-Fullname-input"
                                           class="col-sm-4 col-form-label">@lang('back.counter_number') *</label>
                                    <div class="col-sm-8">
                                        <input type="text" class="form-control" id="horizontal-Fullname-input"
                                               value="{{old('counter_number')}}" required
                                               placeholder="@lang('back.counter_number')"
                                               name="counter_number">
                                    </div>
                                </div>


                            </div>
                            <div class="col-lg-6">

                                <div class="row mb-4">
                                    <label for="horizontal-Fullname-input"
                                           class="col-sm-4 col-form-label">@lang('back.description')</label>
                                    <div class="col-sm-8">
                                        <textarea name="description" class="classic-editor" cols="30" rows="5">{{old('description')}}</textarea>
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
                    </form>

                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->

@endsection
@section('js')

    <!-- ckeditor -->
    <script src="{{url('acp/libs/@ckeditor/ckeditor5-build-classic/build/ckeditor.js')}}"></script>

    <!--tinymce js-->
    <script src="{{url('acp/libs/tinymce/tinymce.min.js')}}"></script>

    <!-- init js -->
    <script src="{{url('acp/js/pages/form-editor.init.js')}}"></script>

    <script>
        ClassicEditor
            .create(document.querySelector('.classic-editor'))
            .catch(error => {
                console.error(error);
            });
    </script>
@endsection

