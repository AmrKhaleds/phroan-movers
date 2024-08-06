@extends('Dashboard.layouts.app')

@section('title')
    @lang('back.edit_catch_receipt')
@endsection
@section('content')

    <!-- Content wrapper start -->
    <div class="content-wrapper">

        <!-- Row starts -->
        <div class="row gutters">
            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                <div class="card">
                    <div class="card-header">
                        <div class="card-title">@lang('back.edit_catch_receipt')</div>
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
                        <form action="{{route('catch_receipts.update',$cach->id)}}" method="post">
                            @method('PUT')
                            @csrf
                            <div class="row gutters">
                                <div class="col-xl-6 col-lg col-md-6 col-sm-6 col-12">
                                    <div class="form-group row">
                                        <label for="staticEmail"
                                               class="col-sm-4 col-form-label">@lang('back.bond_no')</label>
                                        <div class="col-sm-8">
                                            <input type="number" class="form-control form-control-lg"
                                                   name="bond_no" placeholder="@lang('back.bond_no')"
                                                   value="{{$cach->bond_no}}" readonly>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xl-6 col-lg col-md-6 col-sm-6 col-12">
                                    <div class="form-group row">
                                        <label for="staticEmail"
                                               class="col-sm-4 col-form-label">@lang('back.reference')</label>
                                        <div class="col-sm-8">
                                            <select class="form-control selectpicker" name="reference" required
                                                    data-live-search="true">
                                                <option value="" selected disabled>@lang('back.select_one')</option>
                                                @foreach($contracts as $contract)
                                                    <option {{$cach->reference == $contract->ref ? 'selected' : ''}}  value="{{$contract->ref}}">{{$contract->ref}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xl-6 col-lg col-md-6 col-sm-6 col-12">
                                    <div class="form-group row">
                                        <label for="staticEmail"
                                               class="col-sm-4 col-form-label">@lang('back.date')</label>
                                        <div class="col-sm-8">
                                            <input type="date" class="form-control form-control-lg" required
                                                   name="date" placeholder="@lang('back.date')" value="{{old('date',$cach->date)}}">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xl-6 col-lg col-md-6 col-sm-6 col-12">
                                    <div class="form-group row">
                                        <label for="staticEmail"
                                               class="col-sm-4 col-form-label">@lang('back.due_date')</label>
                                        <div class="col-sm-8">
                                            <input type="date" class="form-control form-control-lg" required
                                                   name="due_date" placeholder="@lang('back.due_date')" value="{{old('due_date',$cach->due_date)}}">
                                        </div>
                                    </div>
                                </div>

                                <div class="col-xl-6 col-lg col-md-6 col-sm-6 col-12">
                                    <div class="form-group row">
                                        <label for="staticEmail"
                                               class="col-sm-4 col-form-label">@lang('back.paid_type')</label>
                                        <div class="col-sm-8">
                                            <select name="payments_method_id" id="" required
                                                    class="form-control form-control-lg">
                                                <option value="">@lang('back.select_one')</option>
                                                @foreach($payments as $payment)
                                                    <option {{$cach->payments_method_id == $payment->id ? 'selected' : ''}}  value="{{$payment->id}}">{{$payment->name}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-xl-6 col-lg col-md-6 col-sm-6 col-12">
                                    <div class="form-group row">
                                        <label for="staticEmail"
                                               class="col-sm-4 col-form-label">@lang('back.amount')</label>
                                        <div class="col-sm-8">
                                            <input type="number" class="form-control form-control-lg" required
                                                   name="amount" placeholder="@lang('back.amount')"
                                                   value="{{old('amount',$cach->amount)}}">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xl-6 col-lg col-md-6 col-sm-6 col-12">
                                    <div class="form-group row">
                                        <label for="staticEmail"
                                               class="col-sm-4 col-form-label">@lang('back.recipient_from')</label>
                                        <div class="col-sm-8">
                                            <select name="recipient_from" id="" required class="form-control form-control-lg">
                                                <option value="">@lang('back.select_one')</option>
                                                @foreach($clients as $client)
                                                    <option {{$cach->recipient_from == $client->id ? 'selected' : ''}}  value="{{$client->id}}">{{$client->name}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xl-6 col-lg col-md-6 col-sm-6 col-12">
                                    <div class="form-group row">
                                        <label for="staticEmail"
                                               class="col-sm-4 col-form-label">@lang('back.to_account')</label>
                                        <div class="col-sm-8">
                                            <select name="to_account" id="" required class="form-control form-control-lg">
                                                <option value="">@lang('back.select_one')</option>
                                                @foreach($recipients as $recipient)
                                                    <option {{$cach->to_account == $recipient->id ? 'selected' : ''}}  value="{{$recipient->id}}">{{$recipient->name}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-xl-6 col-lg col-md-6 col-sm-6 col-12">
                                    <div class="form-group row">
                                        <label for="staticEmail"
                                               class="col-sm-4 col-form-label">@lang('back.upload_file')</label>
                                        <div class="col-sm-8">
                                            <input type="file" class="form-control form-control-lg" name="upload_file">
                                            @if($cach->upload_file)
                                            <a href="{{getFile($cach->upload_file)}}" class="badge badge-light"> <i class="icon-file-text"></i>
                                                @lang('back.view_file') </a>
                                            @endif
                                        </div>
                                    </div>
                                </div>

                                <div class="col-xl-6 col-lg col-md-6 col-sm-6 col-12">
                                    <div class="form-group row">
                                        <label for="staticEmail"
                                               class="col-sm-4 col-form-label">@lang('back.note')</label>
                                        <div class="col-sm-8">
                                            <textarea class="form-control" placeholder="@lang('back.description')"
                                                      rows="3" name="description">{{old('description',$cach->note)}}</textarea>
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
