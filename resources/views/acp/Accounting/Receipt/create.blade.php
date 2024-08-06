@extends('Dashboard.layouts.app')

@section('title')
    @lang('back.create_catch_receipt')
@endsection
@section('content')

    <!-- Content wrapper start -->
    <div class="content-wrapper">

        <!-- Row starts -->
        <div class="row gutters">
            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                <div class="card">
                    <div class="card-header">
                        <div class="card-title">@lang('back.create_catch_receipt')</div>
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
                        <form action="{{route('receipts.store')}}" method="post">
                            @method('POST')
                            @csrf
                            <div class="row gutters">
                                <div class="col-xl-6 col-lg col-md-6 col-sm-6 col-12">
                                    <div class="form-group row">
                                        <label for="staticEmail"
                                               class="col-sm-4 col-form-label">@lang('back.bond_no')</label>
                                        <div class="col-sm-8">
                                            <input type="number" class="form-control form-control-lg"
                                                   name="bond_no" placeholder="@lang('back.bond_no')"
                                                   value="{{$last ? $last->bond_no + 1 : account_setting('accounting','sales','serial_receipt')['value']}}" readonly>
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
                                                    <option value="{{$contract->ref}}">{{$contract->ref}}</option>
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
                                                   name="date" placeholder="@lang('back.date')" value="{{old('date')}}">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xl-6 col-lg col-md-6 col-sm-6 col-12">
                                    <div class="form-group row">
                                        <label for="staticEmail"
                                               class="col-sm-4 col-form-label">@lang('back.upload_file')</label>
                                        <div class="col-sm-8">
                                            <input type="file" class="form-control form-control-lg" name="upload_file">
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
                                                    <option value="{{$payment->id}}">{{$payment->name}}</option>
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
                                                   value="{{old('amount')}}">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xl-6 col-lg col-md-6 col-sm-6 col-12">
                                    <div class="form-group row">
                                        <label for="staticEmail"
                                               class="col-sm-4 col-form-label">@lang('back.recipient_to')</label>
                                        <div class="col-sm-8">
                                            <select name="recipient_to" data-live-search="true" required class="form-control form-control-lg selectpicker">
                                                <option value="">@lang('back.select_one')</option>
                                                @foreach($suppliers as $supplier)
                                                    <option value="{{$supplier->id}}">{{$supplier->name}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xl-6 col-lg col-md-6 col-sm-6 col-12">
                                    <div class="form-group row">
                                        <label for="staticEmail"
                                               class="col-sm-4 col-form-label">@lang('back.from_account')</label>
                                        <div class="col-sm-8">
                                            <select name="from_account" data-live-search="true" required class="form-control form-control-lg selectpicker">
                                                <option value="">@lang('back.select_one')</option>
                                                @foreach($recipients as $recipient)
                                                    <option value="{{$recipient->id}}">{{$recipient->account_name}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-xl-6 col-lg col-md-6 col-sm-6 col-12">
                                    <div class="form-group row">
                                        <label for="staticEmail"
                                               class="col-sm-4 col-form-label">@lang('back.note')</label>
                                        <div class="col-sm-8">
                                            <textarea class="form-control" placeholder="@lang('back.description')"
                                                      rows="3" name="description">{{old('description')}}</textarea>
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
