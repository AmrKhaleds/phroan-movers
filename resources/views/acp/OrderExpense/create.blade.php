@extends('acp.layout.app')

@section('title')
    @lang('back.create') @lang('back.expense')
@endsection
@section('content')

    <style>
        input::placeholder {
            text-align: center;
        }

        /* or, for legacy browsers */

        input::-webkit-input-placeholder {
            text-align: center;
        }

        input:-moz-placeholder { /* Firefox 18- */
            text-align: center;
        }

        input::-moz-placeholder {  /* Firefox 19+ */
            text-align: center;
        }

        input:-ms-input-placeholder {
            text-align: center;
        }
    </style>

    <!-- start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-flex align-items-center justify-content-between">

                <div class="page-title-left">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item">@lang('back.dashborad')</li>

                        <li class="breadcrumb-item ">@lang('back.trakings')</li>
                        <li class="breadcrumb-item active">@lang('back.create') @lang('back.expense')</li>

                    </ol>
                </div>

{{--                <h4 class="mb-0">@lang('back.create') @lang('back.expense')</h4>--}}

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

                            <form method="post" class="repeater" action="{{route('expense_order.store')}}"
                                  class="custom-validation">
                                @csrf
                                <input type="hidden" name="booking_id" value="{{$booking->id}}">
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="col px-1 mb-3">
                                            <label for="input1" class="ms-2 position-absolute" style="margin-top: -0.7rem !important">
                                                <span class="h6 small bg-white text-muted px-1">@lang('back.sallary_drive')</span>
                                            </label>
                                            <input  type="hidden" name="reason[]" value="sallary_drive">

                                            <input type="number" class="form-control mt-n3 expense text-center"
                                                   id="horizontal-Fullname-input"
                                                   {{--                                                           value="{{searchArray('راتب', $booking->order_expense->toArray())}}"--}}
                                                   value="{{searchForValue(__('back.sallary_drive'), $expense)}}"
                                                   placeholder="@lang('back.financial_value')"
                                                   name="cost[]">

                                            <input type="hidden" name="expense_type[]" value="expense">
                                        </div>

                                        <div class="col px-1 mb-3">
                                            <label for="input1" class="ms-2 position-absolute" style="margin-top: -0.7rem !important">
                                                <span class="h6 small bg-white text-muted px-1">@lang('back.workers')</span>
                                            </label>
                                            <input  type="hidden" name="reason[]" value="workers">

                                            <input type="number" class="form-control mt-n3 expense text-center"
                                                   id="horizontal-Fullname-input"
                                                   {{--                                                           value="{{searchArray('راتب', $booking->order_expense->toArray())}}"--}}
                                                   value="{{searchForValue(__('back.workers'), $expense)}}"
                                                   placeholder="@lang('back.financial_value')"
                                                   name="cost[]">

                                            <input type="hidden" name="expense_type[]" value="expense">
                                        </div>


                                        <div class="col px-1 mb-3">
                                            <label for="input1" class="ms-2 position-absolute" style="margin-top: -0.7rem !important">
                                                <span class="h6 small bg-white text-muted px-1">@lang('back.vehicle')</span>
                                                <input type="hidden" name="reason[]" value="vehicle">
                                            </label>
                                            <input type="number" class="form-control expense text-center"
                                                   id="horizontal-Fullname-input"
                                                   value="{{searchForValue(__('back.vehicle'), $expense)}}"
                                                   placeholder="@lang('back.financial_value')"
                                                   name="cost[]">
                                            <input type="hidden" name="expense_type[]" value="expense">
                                        </div>


                                        <div class="col px-1 mb-3">
                                            <label for="input1" class="ms-2 position-absolute" style="margin-top: -0.7rem !important">
                                                <span class="h6 small bg-white text-muted px-1">@lang('back.gas')</span>
                                                <input type="hidden" name="reason[]" value="gas">
                                            </label>
                                            <input type="number" class="form-control expense text-center"
                                                   id="horizontal-Fullname-input"
                                                   value="{{searchForValue(__('back.gas'), $expense)}}"
                                                   placeholder="@lang('back.financial_value')"
                                                   name="cost[]">
                                            <input type="hidden" name="expense_type[]" value="expense">
                                        </div>


                                        <div class="col px-1 mb-3">
                                            <label for="input1" class="ms-2 position-absolute" style="margin-top: -0.7rem !important">
                                                <span class="h6 small bg-white text-muted px-1">@lang('back.oil')</span>
                                                <input type="hidden" name="reason[]" value="oil">
                                            </label>
                                            <input type="number" class="form-control expense text-center"
                                                   id="horizontal-Fullname-input"
                                                   value="{{searchForValue(__('back.oil'), $expense)}}"
                                                   placeholder="@lang('back.financial_value')"
                                                   name="cost[]">
                                            <input type="hidden" name="expense_type[]" value="expense">
                                        </div>



                                        <div class="col px-1 mb-3">
                                            <label for="input1" class="ms-2 position-absolute" style="margin-top: -0.7rem !important">
                                                <span class="h6 small bg-white text-muted px-1">@lang('back.carpenter')</span>
                                                <input type="hidden" name="reason[]" value="carpenter">
                                            </label>
                                            <input type="number" class="form-control expense text-center"
                                                   id="horizontal-Fullname-input"
                                                   value="{{searchForValue(__('back.carpenter'), $expense)}}"
                                                   placeholder="@lang('back.financial_value')"
                                                   name="cost[]">
                                            <input type="hidden" name="expense_type[]" value="expense">
                                        </div>


                                        <div class="col px-1 mb-3">
                                            <label for="input1" class="ms-2 position-absolute" style="margin-top: -0.7rem !important">
                                                <span class="h6 small bg-white text-muted px-1">@lang('back.chandelier')</span>
                                                <input type="hidden" name="reason[]" value="chandelier">
                                            </label>
                                            <input type="number" class="form-control expense text-center"
                                                   id="horizontal-Fullname-input"
                                                   value="{{searchForValue(__('back.chandelier'), $expense)}}"
                                                   placeholder="@lang('back.financial_value')"
                                                   name="cost[]">
                                            <input type="hidden" name="expense_type[]" value="expense">
                                        </div>


                                        <div class="col px-1 mb-3">
                                            <label for="input1" class="ms-2 position-absolute" style="margin-top: -0.7rem !important">
                                                <span class="h6 small bg-white text-muted px-1">@lang('back.conditioning')</span>
                                                <input type="hidden" name="reason[]" value="chandelier">
                                            </label>
                                            <input type="number" class="form-control expense text-center"
                                                   id="horizontal-Fullname-input"
                                                   value="{{searchForValue(__('back.conditioning'), $expense)}}"
                                                   placeholder="@lang('back.financial_value')"
                                                   name="cost[]">
                                            <input type="hidden" name="expense_type[]" value="expense">
                                        </div>


                                        <div class="col px-1 mb-3">
                                            <label for="input1" class="ms-2 position-absolute" style="margin-top: -0.7rem !important">
                                                <span class="h6 small bg-white text-muted px-1">@lang('back.tire')</span>
                                                <input type="hidden" name="reason[]" value="tire">
                                            </label>
                                            <input type="number" class="form-control expense text-center"
                                                   id="horizontal-Fullname-input"
                                                   value="{{searchForValue(__('back.tire'), $expense)}}"
                                                   placeholder="@lang('back.financial_value')"
                                                   name="cost[]">
                                            <input type="hidden" name="expense_type[]" value="expense">
                                        </div>

                                        <div class="col px-1 mb-3">
                                            <label for="input1" class="ms-2 position-absolute" style="margin-top: -0.7rem !important">
                                                <span class="h6 small bg-white text-muted px-1">@lang('back.crane')</span>
                                                <input type="hidden" name="reason[]" value="crane">
                                            </label>
                                            <input type="number" class="form-control expense text-center"
                                                   id="horizontal-Fullname-input"
                                                   value="{{searchForValue(__('back.crane'), $expense)}}"
                                                   placeholder="@lang('back.financial_value')"
                                                   name="cost[]">
                                            <input type="hidden" name="expense_type[]" value="expense">
                                        </div>

                                        <div class="col px-1 mb-3">
                                            <label for="input1" class="ms-2 position-absolute" style="margin-top: -0.7rem !important">
                                                <span class="h6 small bg-white text-muted px-1">@lang('back.infraction')</span>
                                                <input type="hidden" name="reason[]" value="infraction">
                                            </label>
                                            <input type="number" class="form-control expense text-center"
                                                   id="horizontal-Fullname-input"
                                                   value="{{searchForValue(__('back.infraction'), $expense)}}"
                                                   placeholder="@lang('back.financial_value')"
                                                   name="cost[]">
                                            <input type="hidden" name="expense_type[]" value="expense">
                                        </div>

                                        <div class="col px-1 mb-3">
                                            <label for="input1" class="ms-2 position-absolute" style="margin-top: -0.7rem !important">
                                                <span class="h6 small bg-white text-muted px-1">@lang('back.bubils')</span>
                                                <input type="hidden" name="reason[]" value="bubils">
                                            </label>
                                            <input type="number" class="form-control expense text-center"
                                                   id="horizontal-Fullname-input"
                                                   value="{{searchForValue(__('back.bubils'), $expense)}}"
                                                   placeholder="@lang('back.financial_value')"
                                                   name="cost[]">
                                            <input type="hidden" name="expense_type[]" value="expense">
                                        </div>


                                        <div class="col px-1 mb-3">
                                            <label for="input1" class="ms-2 position-absolute" style="margin-top: -0.7rem !important">
                                                <span class="h6 small bg-white text-muted px-1">@lang('back.chanal')</span>
                                                <input type="hidden" name="reason[]" value="chanal">
                                            </label>
                                            <input type="number" class="form-control expense text-center"
                                                   id="horizontal-Fullname-input"
                                                   value="{{searchForValue(__('back.chanal'), $expense)}}"
                                                   placeholder="@lang('back.financial_value')"
                                                   name="cost[]">
                                            <input type="hidden" name="expense_type[]" value="expense">
                                        </div>


                                        <div class="col px-1 mb-3">
                                            <label for="input1" class="ms-2 position-absolute" style="margin-top: -0.7rem !important">
                                                <span class="h6 small bg-white text-muted px-1">@lang('back.boxs')</span>
                                                <input type="hidden" name="reason[]" value="boxs">
                                            </label>
                                            <input type="number" class="form-control expense text-center"
                                                       id="horizontal-Fullname-input"
                                                       value="{{searchForValue(__('back.boxs'), $expense)}}"
                                                       placeholder="@lang('back.financial_value')"
                                                       name="cost[]">
                                                <input type="hidden" name="expense_type[]" value="expense">
                                        </div>


                                        <div class="col px-1 mb-3">
                                            <label for="input1" class="ms-2 position-absolute" style="margin-top: -0.7rem !important">
                                                <span class="h6 small bg-white text-muted px-1">@lang('back.commetion')</span>
                                                <input type="hidden" name="reason[]" value="commetion">
                                            </label>
                                            <input type="number" class="form-control expense text-center"
                                                       id="horizontal-Fullname-input"
                                                       value="{{searchForValue(__('back.commetion'), $expense)}}"
                                                       placeholder="@lang('back.financial_value')"
                                                       name="cost[]">
                                                <input type="hidden" name="expense_type[]" value="expense">
                                        </div>

                                        <div class="col px-1 mb-3">
                                            <label for="input1" class="ms-2 position-absolute" style="margin-top: -0.7rem !important">
                                                <span class="h6 small bg-white text-muted px-1">@lang('back.serv_packing')</span>
                                                <input type="hidden" name="reason[]" value="serv_packing">
                                            </label>
                                            <input type="number" class="form-control expense text-center"
                                                       id="horizontal-Fullname-input"
                                                       value="{{searchForValue(__('back.serv_packing'), $expense)}}"
                                                       placeholder="@lang('back.financial_value')"
                                                       name="cost[]">
                                                <input type="hidden" name="expense_type[]" value="expense">
                                        </div>

                                    </div>
                                    <div class="col-md-8">
                                        <table class="table table-bordered">
                                            <tr>
                                                <th>@lang('back.client_name')</th>
                                                <td>{{$booking->client_name}}</td>
                                            </tr>
                                            <tr>
                                                <th>@lang('back.client_phone')</th>
                                                <td>{{Str::replace('-','',$booking->client_phone)}}</td>
                                            </tr>
                                            <tr>
                                                <th>@lang('back.from_area')</th>
                                                <td>
                                                    <p style="font-weight: bolder;">{{$booking->fromArea ? $booking->fromArea->name : ''}}</p>
                                                    <code class="code">{{$booking->from_address}}</code>
                                                </td>
                                            </tr>
                                            <tr>
                                                <th>@lang('back.to_area')</th>
                                                <td>
                                                    <p style="font-weight: bolder;">{{$booking->toArea ? $booking->toArea->name : ''}}</p>
                                                    <code class="code">{{$booking->to_address}}</code>
                                                </td>
                                            </tr>
                                            <tr>
                                                <th>@lang('back.time')</th>
                                                <td>{{\Carbon\Carbon::parse($booking->order_time)->format('h:i a')}}</td>
                                            </tr>
                                            <tr>
                                                <th>@lang('back.price')</th>
                                                <td>{{$booking->price}}@lang('back.L.E')</td>
                                            </tr>
                                            <tr>
                                                <th>@lang('back.from_floor')</th>
                                                <td>{{$booking->from_floor}}</td>
                                            </tr>
                                            <tr>
                                                <th>@lang('back.to_floor')</th>
                                                <td>{{$booking->to_floor}}</td>
                                            </tr>

                                            <tr>
                                                <th>@lang('back.booking_at')</th>
                                                <td>{{$booking->booking_at}}</td>
                                            </tr>
                                            <tr>
                                                <th>@lang('back.created_at')</th>
                                                <td>{{$booking->created_at->format('d-m-Y H:i')}}</td>
                                            </tr>

                                            <tr>
                                                <th>@lang('back.note')</th>
                                                <td>{!!  $booking->note !!}</td>
                                            </tr>

                                        </table>
                                    </div>
                                </div>


                                <div class="row">
                                    <div class="col-lg-3">
                                        <div class=" mt-lg-4">
                                            <p>@lang('back.deposit')</p>
                                            <input type="hidden" name="reason_more[]" value="deposit">

                                        </div>
                                    </div>
                                    <div class="col-lg-9">
                                        <div class=" mt-lg-4">
                                            <div class="row ">
                                                <div class="col-sm-6">
                                                    <input type="number" class="form-control expense"
                                                           id="horizontal-Fullname-input"
                                                           value="{{searchForValue('deposit', $expense)}}"
                                                           placeholder="@lang('back.financial_value')"
                                                           name="cost_more[]">


                                                </div>
                                                <label for="horizontal-Fullname-input"
                                                       class="col-sm-2 col-form-label">@lang('back.payment_method')
                                                    *</label>

                                                <div class="col-sm-4">
                                                    <select name="payment_method" class="form-control">
                                                        <option {{searchForValue('',$expense,'deposit','deposit') == '' ? 'selected' : ''}}  value="">@lang('back.select_one')</option>
                                                        <option {{searchForValue('حساب ال CIB',$expense,'deposit','deposit') == 'حساب ال CIB' ? 'selected' : ''}}  value="حساب ال CIB">حساب ال CIB</option>
                                                        <option {{searchForValue('الجراج',$expense,'deposit','deposit') == 'الجراج' ? 'selected' : ''}}  value="الجراج">الجراج</option>
                                                        <option {{searchForValue('حساب ال QNB',$expense,'deposit','deposit') == 'حساب ال QNB' ? 'selected' : ''}}  value="حساب ال QNB">حساب ال QNB</option>
                                                        <option {{searchForValue('فرع الزهراء ١ ( ا.رضوي )',$expense,'deposit','deposit') == 'فرع الزهراء ١ ( ا.رضوي )' ? 'selected' : ''}}  value="فرع الزهراء ١ ( ا.رضوي )">فرع الزهراء ١ ( ا.رضوي )</option>
                                                        <option {{searchForValue('حساب كريدي اجريكول',$expense,'deposit','deposit') == 'حساب كريدي اجريكول' ? 'selected' : ''}}  value="حساب كريدي اجريكول">حساب كريدي اجريكول</option>
                                                        <option {{searchForValue('فودفوان كاش',$expense,'deposit','deposit') == 'فودفوان كاش' ? 'selected' : ''}}  value="فودفوان كاش">فودفوان كاش</option>
                                                        <option {{searchForValue('اتصالات كاش',$expense,'deposit','deposit') == 'اتصالات كاش' ? 'selected' : ''}}  value="اتصالات كاش">اتصالات كاش</option>
                                                        <option {{searchForValue('حساب البنك الاهلي',$expense,'deposit','deposit') == 'حساب البنك الاهلي' ? 'selected' : ''}}  value="حساب البنك الاهلي">حساب البنك الاهلي</option>
                                                        <option {{searchForValue('حساب بنك مصر',$expense,'deposit','deposit') == 'حساب بنك مصر' ? 'selected' : ''}}  value="حساب بنك مصر">حساب بنك مصر</option>
                                                        <option {{searchForValue('حساب بنك العربي الافريقي',$expense,'deposit','deposit') == 'حساب بنك العربي الافريقي' ? 'selected' : ''}}  value="حساب بنك العربي الافريقي">حساب بنك العربي الافريقي</option>
                                                        <option {{searchForValue('بنك الامارات دبي',$expense,'deposit','deposit') == 'بنك الامارات دبي' ? 'selected' : ''}}  value="بنك الامارات دبي">بنك الامارات دبي</option>
                                                        <option {{searchForValue('هبه اتصالات كاش',$expense,'deposit','deposit') == 'هبه اتصالات كاش' ? 'selected' : ''}}  value="هبه اتصالات كاش">هبه اتصالات كاش</option>
                                                        <option {{searchForValue('فودافون كاش هبه',$expense,'deposit','deposit') == 'فودافون كاش هبه' ? 'selected' : ''}}  value="فودافون كاش هبه">فودافون كاش هبه</option>
                                                        <option {{searchForValue('فرع التبة',$expense,'deposit','deposit') == 'فرع التبة' ? 'selected' : ''}}  value="فرع التبة">فرع التبة</option>
                                                        <option {{searchForValue('فرع الزهراء ( محمد الجميلي )',$expense,'deposit','deposit') == 'فرع الزهراء ( محمد الجميلي )' ? 'selected' : ''}}  value="فرع الزهراء ( محمد الجميلي )">فرع الزهراء ( محمد الجميلي )</option>
                                                        <option {{searchForValue('عربون مستلم باليد ( هبه )',$expense,'deposit','deposit') == 'عربون مستلم باليد ( هبه )' ? 'selected' : ''}}  value="عربون مستلم باليد ( هبه )">عربون مستلم باليد ( هبه )</option>
                                                        <option {{searchForValue('1000',$expense,'deposit','deposit') == '1000' ? 'selected' : ''}}  value="1000">1000</option>
                                                        <option {{searchForValue('فرع اكتوبر',$expense,'deposit','deposit') == 'فرع اكتوبر' ? 'selected' : ''}}  value="فرع اكتوبر">فرع اكتوبر</option>
                                                        <option {{searchForValue('91109',$expense,'deposit','deposit') == '91109' ? 'selected' : ''}}  value="91109">91109</option>
                                                    </select>

                                                </div>

                                            </div>
                                            <input type="hidden" name="expense_type_more[]" value="expense">
                                            {{--                                            more--}}
                                        </div>
                                    </div>
                                </div>


                                <div class="row">
                                    <div class="col-lg-4">
                                        <div class=" mt-lg-4">

                                            <div class="row ">
                                                <label for="horizontal-Fullname-input"
                                                       class="col-sm-4 col-form-label"> @lang('back.reason')* </label>
                                                <div class="col-sm-8">
                                                    <textarea name="reason_more[]" class="form-control" cols="30"
                                                              rows="5"
                                                              placeholder="@lang('back.enter_reason')"></textarea>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class=" mt-lg-4">
                                            <div class="row ">
                                                <label for="horizontal-Fullname-input"
                                                       class="col-sm-4 col-form-label">@lang('back.financial_value')
                                                    *</label>
                                                <div class="col-sm-8">
                                                    <input type="number" class="form-control"
                                                           id="extra-cost-value"
                                                           value="{{old('cost')}}"
                                                           placeholder="@lang('back.financial_value')"
                                                           name="cost_more[]">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class=" mt-lg-4">
                                            <div class="row ">
                                                <label for="horizontal-Fullname-input"
                                                       class="col-sm-4 col-form-label">@lang('back.expense_type')
                                                    *</label>
                                                <div class="col-sm-8">
                                                    <select name="expense_type_more[]" class="form-control"
                                                            id="extra-cost-type">
                                                        <option value="">@lang('back.select_one')</option>
                                                        <option value="expense">@lang('back.expense')</option>
                                                        <option value="more">@lang('back.more')</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row pb-4">
                                    <div class="col-lg-4">
                                        <div class=" mt-lg-4">
                                            <div class="row ">
                                                <label for="horizontal-Fullname-input" class="col-sm-5 col-form-label">
                                                    @lang('back.cost') @lang('back.order')
                                                </label>
                                                <div class="col-sm-5">
                                                    <h4 class="total_order text-success d-inline-block">{{$booking->price}}</h4>
                                                    <h4 class="text-success d-inline-block">@lang('back.L.E')</h4>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class=" mt-lg-4">
                                            <div class="row ">
                                                <label for="horizontal-Fullname-input" class="col-sm-5 col-form-label">
                                                    @lang('back.total_expenses')
                                                </label>
                                                <div class="col-sm-5">
                                                    <h4 class="total_expenses text-danger d-inline-block">0</h4> <h4
                                                            class="text-danger d-inline-block">@lang('back.L.E')</h4>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class=" mt-lg-4">
                                            <div class="row ">
                                                <label for="horizontal-Fullname-input" class="col-sm-5 col-form-label">
                                                    @lang('back.net_income')
                                                </label>
                                                <div class="col-sm-5">
                                                    <h4 class="net_income text-info d-inline-block">0</h4> <h4
                                                            class="text-info d-inline-block">@lang('back.L.E')</h4>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                </div>

                                <div class="row justify-content-end">
                                    <div class="col-sm-9">
                                        <div class="d-flex flex-wrap gap-3">
                                            <button type="submit"
                                                    class="btn btn-primary waves-effect waves-light w-md ">@lang('back.submit')</button>
                                        </div>
                                    </div>
                                </div>


                            </form>


                        </div>
                    </div>
{{--                    @if(Session::has('whatsapp'))--}}
{{--                        <a href="{{session('whatsapp')}}" id="whatsappsend" target="_blank"></a>--}}
{{--                    @endif--}}
                </div>
            </div>
        </div>
    </div>

@endsection

@section('js')
    <script>
        $( document ).ready(function() {
            calculateSum();
        });

        $(document).on("keydown keyup",".expense", function () {
            calculateSum();

        });



        $("#extra-cost-type").change(function(){
            if(this.value == 'expense'){
                $("#extra-cost-value").addClass('expense')
                $("#extra-cost-value").removeClass('more');
            }else if(this.value == 'more'){
                $("#extra-cost-value").addClass('more')
                $("#extra-cost-value").removeClass('expense');
            }else{
                $("#extra-cost-value").removeClass('expense');
                $("#extra-cost-value").removeClass('more');
            }
            calculateSum();
        })

        function calculateSum() {
            var amount_sum = 0;
            var amount_sum_more = 0;
            $('.expense').each(function () {
                amount_sum += Number($(this).val());
            });

            $('.more').each(function () {
                amount_sum_more += Number($(this).val());
            });

            $(".total_expenses").text(amount_sum.toFixed(2));
            $(".net_income").text(($(".total_order").text() - amount_sum + amount_sum_more).toFixed(2));
        }

    </script>


{{--

        <script>
                $('.send').click(function () {
                    window.open('https://web.whatsapp.com/send?phone=+201150529330&text=كراتين ("10 ج.م") ______________________ </br>نسبه سواق ("20 ج.م") ______________________ </br>خدمة الباكينج ("30 ج.م") ______________________ </br>عربون ("40 ج.م") ______________________ </br> (" ج.م")  ');

                    $('.repeater').submit();

                });
        </script>
--}}



@endsection
