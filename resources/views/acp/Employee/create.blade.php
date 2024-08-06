@extends('acp.layout.app')

@section('title')
    @lang('back.create') @lang('back.employee')
@endsection
@section('content')

    <!-- start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-flex align-items-center justify-content-between">
                <h4 class="mb-0">@lang('back.create') @lang('back.employee')</h4>

                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item active">@lang('back.create') @lang('back.employee')</li>
                        <li class="breadcrumb-item ">@lang('back.employees')</li>
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

                    <form method="post" action="{{route('employees.store')}}" enctype="multipart/form-data"
                          class="custom-validation">
                        @csrf

                        <div class="row">
                            <div class="col-lg-6">
                                <div class="mt-5 mt-lg-4">

                                    <div class="row mb-4">
                                        <label for="horizontal-Fullname-input"
                                               class="col-sm-4 col-form-label">@lang('back.employee') @lang('back.name')
                                            *</label>
                                        <div class="col-sm-8">
                                            <input type="text" class="form-control" id="horizontal-Fullname-input"
                                                   value="{{old('name')}}" required
                                                   placeholder="@lang('back.employee') @lang('back.name')" name="name">
                                        </div>
                                    </div>
                                    <div class="row mb-4">
                                        <label for="horizontal-Fullname-input"
                                               class="col-sm-4 col-form-label">@lang('back.phone') *</label>
                                        <div class="col-sm-8">
                                            <input type="text" class="form-control" id="horizontal-Fullname-input"
                                                   value="{{old('phone')}}" required
                                                   placeholder="@lang('back.phone')" name="phone">
                                        </div>
                                    </div>
                                    <div class="row mb-4">
                                        <label for="horizontal-Fullname-input"
                                               class="col-sm-4 col-form-label">@lang('back.start_work') *</label>
                                        <div class="col-sm-8">
                                            <input type="date" class="form-control" id="horizontal-Fullname-input"
                                                   value="{{old('start_work')}}" required
                                                   placeholder="@lang('back.start_work')" name="start_work">
                                        </div>
                                    </div>
                                    <div class="row mb-4">
                                        <label for="horizontal-Fullname-input"
                                               class="col-sm-4 col-form-label">@lang('back.work_hours') *</label>
                                        <div class="col-sm-8">
                                            <input type="number" class="form-control" id="horizontal-Fullname-input"
                                                   value="{{old('work_hours')}}" required
                                                   placeholder="@lang('back.work_hours')" name="work_hours">
                                        </div>
                                    </div>
                                    <div class="row mb-4">
                                        <label for="horizontal-Fullname-input"
                                               class="col-sm-4 col-form-label">@lang('back.sallary') *</label>
                                        <div class="col-sm-8">
                                            <input type="number" class="form-control" id="horizontal-Fullname-input"
                                                   value="{{old('sallary')}}" required
                                                   placeholder="@lang('back.sallary')" name="sallary">
                                        </div>
                                    </div>
                                    <div class="row mb-4">
                                        <label for="horizontal-Fullname-input"
                                               class="col-sm-4 col-form-label">@lang('back.photo') *</label>
                                        <div class="col-sm-8">
                                            <input type="file" class="form-control" id="horizontal-Fullname-input"
                                                   required name="photo" accept="image/*">
                                        </div>
                                    </div>
                                    <div class="row mb-4">
                                        <label for="horizontal-Fullname-input"
                                               class="col-sm-4 col-form-label">@lang('back.category') *</label>
                                        <div class="col-sm-8">
                                            <select name="category_id" class="form-control">
                                                <option value="">@lang('back.select_one')</option>
                                                @foreach($categories as $category)
                                                    <option value="{{$category->id}}">{{$category->title}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>


                                </div>
                            </div>

                            <div class="col-lg-6">
                                <div class="mt-5 mt-lg-4">

                                    <div class="row mb-4">
                                        <label for="horizontal-Fullname-input"
                                               class="col-sm-4 col-form-label">@lang('back.email')</label>
                                        <div class="col-sm-8">
                                            <input type="email" class="form-control" id="horizontal-Fullname-input"
                                                   value="{{old('email')}}"
                                                   placeholder="@lang('back.email')" name="email">
                                        </div>
                                    </div>
                                    <div class="row mb-4">
                                        <label for="horizontal-Fullname-input"
                                               class="col-sm-4 col-form-label">@lang('back.whatsapp')</label>
                                        <div class="col-sm-8">
                                            <input type="text" class="form-control" id="horizontal-Fullname-input"
                                                   value="{{old('whatsapp')}}"
                                                   placeholder="@lang('back.whatsapp')" name="whatsapp">
                                        </div>
                                    </div>
                                    <div class="row mb-4">
                                        <label for="horizontal-Fullname-input"
                                               class="col-sm-4 col-form-label">@lang('back.start_day')*</label>
                                        <div class="col-sm-8">
                                            <input type="time" class="form-control" id="horizontal-Fullname-input"
                                                   value="{{old('start_day')}}" required
                                                   placeholder="@lang('back.start_day')" name="start_day">
                                        </div>
                                    </div>
                                    <div class="row mb-4">
                                        <label for="horizontal-Fullname-input"
                                               class="col-sm-4 col-form-label">@lang('back.team_leader') *</label>
                                        <div class="col-sm-8">
                                            <select name="team_leader_id" class="form-control">
                                                <option value="">@lang('back.select_one')</option>
                                                <option value="0">@lang('back.team_leader')</option>
                                                <option value="1">@lang('back.general')</option>
                                                @foreach($team_leaders as $team_leader)
                                                    @if($team_leader->profile->team_leader_id == 0)
                                                        <option value="{{$team_leader->id}}">{{$team_leader->name}}</option>
                                                    @endif
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="row mb-4">
                                        <label for="horizontal-Fullname-input"
                                               class="col-sm-4 col-form-label">@lang('back.sallary_per') *</label>
                                        <div class="col-sm-8">
                                            <select name="sallary_per" class="form-control">
                                                <option value="">@lang('back.select_one')</option>
                                                <option value="in_hour">@lang('back.in_hour')</option>
                                                <option value="in_week">@lang('back.in_week')</option>
                                                <option value="in_munoth">@lang('back.in_munoth')</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="row mb-4">
                                        <label for="horizontal-Fullname-input"
                                               class="col-sm-4 col-form-label">@lang('back.cv') *</label>
                                        <div class="col-sm-8">
                                            <input type="file" class="form-control" id="horizontal-Fullname-input"
                                                   required name="cv" accept="image/*">
                                        </div>
                                    </div>
                                    <div class="row mb-4">
                                        <label for="horizontal-Fullname-input"
                                               class="col-sm-4 col-form-label">@lang('back.nanonal_id') *</label>
                                        <div class="col-sm-8">
                                            <input type="file" class="form-control" id="horizontal-Fullname-input"
                                                   required name="id[]" multiple accept="image/*">
                                            <span class="highlighter-rouge">@lang('back.upload_2File')</span>
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

@endsection
