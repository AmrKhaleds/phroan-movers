@extends('acp.layout.app')

@section('title')
    @lang('back.create_dailymove')
@endsection

@section('content')


    <!-- start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-flex align-items-center justify-content-between">
                <h4 class="mb-0">@lang('back.create_dailymove')</h4>

                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item active">@lang('back.create_dailymove')</li>
                        <li class="breadcrumb-item ">@lang('back.dailymoves')</li>
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

                        <form method="post" action="{{route('dailymoves.store')}}"
                              enctype="multipart/form-data">
                            @method('POST')
                            @csrf

                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="row mb-4">
                                        <label for="horizontal-Fullname-input"
                                               class="col-sm-4 col-form-label">@lang('back.num_dailymove') </label>
                                        <div class="col-sm-8">
                                            <input type="number" class="form-control"
                                                   id="horizontal-Fullname-input"
                                                   value="{{$last ? $last->registration_number + 1 : account_setting('accounting','sales','serial_dailymove')['value']}}"
                                                   placeholder="@lang('back.num_dailymove') " required readonly
                                                   name="num_dailymove">
                                        </div>
                                    </div>
                                    <div class="row mb-4">
                                        <label for="horizontal-Fullname-input"
                                               class="col-sm-4 col-form-label">@lang('back.date') </label>
                                        <div class="col-sm-8">
                                            <input type="date" class="form-control" required
                                                   id="horizontal-Fullname-input" value="{{old('date',date('Y-m-d'))}}"
                                                   placeholder="@lang('back.date') "
                                                   name="date">
                                        </div>
                                    </div>

                                </div>
                                <div class="col-lg-6">
                                    <div class="row mb-4">
                                        <label for="horizontal-Fullname-input"
                                               class="col-sm-4 col-form-label">@lang('back.document') </label>
                                        <div class="col-sm-8">
                                            <input type="file" class="form-control" name="document">
                                        </div>
                                    </div>
                                    <div class="row mb-4">
                                        <label for="horizontal-Fullname-input"
                                               class="col-sm-4 col-form-label">@lang('back.paid_type') </label>
                                        <div class="col-sm-8">
                                            <select name="payments_method_id" id="" required
                                                    class="form-control">
                                                <option value="">@lang('back.select_one')</option>
                                                @foreach($payments as $payment)
                                                    <option value="{{$payment->id}}">{{$payment->name}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>


                                </div>
                                <div class="col-md-12">
                                    <table class="table table-bordered table-hover"
                                           id="tab_logic">
                                        <thead>
                                        <tr>
                                            <th class="text-center"> #</th>
                                            <th class="text-center" width="40%"> @lang('back.account_num')
                                                / @lang('back.account_name')</th>
                                            <th class="text-center" width="10%"> @lang('back.debtor') </th>
                                            <th class="text-center" width="10%">@lang('back.creditor') </th>
                                            <th class="text-center" width="40%">@lang('back.statement') </th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <tr id='addr0'>
                                            <td>1</td>
                                            <td>
                                                {{--<select name="account_id[]" class="form-control" data-trigger name="accounts[]"
                                                        id="choices-single-default"
                                                        placeholder="@lang('back.select_one')">--}}
                                                <select name="account_id[]" class="form-control accounts "
                                                        data-live-search="true">
                                                    <option value="">@lang('back.select_one')</option>
                                                    @foreach($accounts as $account)
                                                        <option value="{{$account->id}}">{{$account->account_name}}
                                                            , {{$account->num}}</option>
                                                    @endforeach

                                                </select>

                                            </td>

                                            <td><input type="number" name='debtor[]'
                                                       placeholder='@lang('back.debtor')'
                                                       class="form-control debtor" value="0"
                                                       step="any" min="0"/></td>
                                            <td><input type="number" name='creditor[]' value="0"
                                                       placeholder='@lang('back.creditor')'
                                                       class="form-control creditor"
                                                       step="any" min="0"/></td>
                                            <td>
                                                <textarea name='noteItem[]' placeholder='@lang('back.note')'
                                                          class="form-control notes"></textarea>
                                            </td>
                                        </tr>
                                        <tr id='addr1'></tr>

                                        </tbody>
                                    </table>
                                </div>
                            </div>

                            <div class="row clearfix">
                                <div class="col-md-12">
                                    <button type="button" id="add_row"
                                            class="btn btn-info pull-lef btn-rounded">@lang('back.add_row')</button>
                                    <button type="button" id='delete_row'
                                            class="pull-right btn btn-danger btn-rounded">@lang('back.delete_row')</button>
                                </div>
                            </div>
                            <div class="row clearfix" style="margin-top:20px">
                                <div class="pull-right col-md-4">
                                    <h6 style="color: red ; display: none"
                                        id="err">@lang('back.total_amount_creditor_not_equal_total_amount_debtor')</h6>
                                    <h6 style="color: red ; display: none"
                                        id="errduble">@lang('back.creditors_account_may_not_same_debit_account')</h6>
                                    <table class="table table-bordered table-hover"
                                           id="tab_logic_total">
                                        <tbody>
                                        <tr>
                                            <th class="text-center">@lang('back.debtor')</th>
                                            <td class="text-center"><input type="number"
                                                                           name='debtorTotal'
                                                                           placeholder='0.00'
                                                                           class="form-control"
                                                                           id="debtor"
                                                                           readonly/>
                                            </td>
                                        </tr>


                                        <tr>
                                            <th class="text-center">@lang('back.creditor')</th>
                                            <td class="text-center"><input type="text"
                                                                           name='creditorTotal'
                                                                           id="creditor"
                                                                           placeholder='0.00'
                                                                           class="form-control"
                                                                           readonly/>
                                            </td>
                                        </tr>
                                        </tbody>
                                    </table>
                                </div>

                            </div>


                            <div class="row clearfix">

                                <div class="col-md-12">
                                    <div class="form-group row">
                                        <label for="staticEmail"
                                               class="col-sm-4 col-form-label">@lang('back.note')</label>
                                        <div class="col-sm-8">
                                            <textarea name="notes" placeholder="@lang('back.note')"
                                                      class="form-control">{{old('notes')}}</textarea>
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

@section('js')

    <script>
        $(document).ready(function () {
            var i = 1;
            $("#add_row").click(function () {
                b = i - 1;
                $('#addr' + i).html($('#addr' + b).html()).find('td:first-child').html(i + 1);
                $('#tab_logic').append('<tr id="addr' + (i + 1) + '"></tr>');
                i++;
            });
            $("#delete_row").click(function () {
                if (i > 1) {
                    $("#addr" + (i - 1)).html('');
                    i--;
                }
                calc();
            });

            $('#tab_logic tbody').on('keyup change', function () {
                calc();
            });

        });

        function calc() {
            $('#tab_logic tbody tr').each(function (i, element) {
                var html = $(this).html();
                if (html != '') {
                    var accounts = $(this).find('.accounts').val();
                    console.log(accounts);
                    // var debtor = $(this).find('.debtor').val();
                    // $(this).find('#debtor').val((debtor + debtor));

                    // var creditor = $(this).find('.creditor').val();
                    debtor = 0;
                    $('.debtor').each(function () {
                        debtor += parseInt($(this).val());
                    });
                    totaldebtor = $('#debtor').val(debtor);

                    creditor = 0;
                    $('.creditor').each(function () {
                        creditor += parseInt($(this).val());
                    });
                    $('#creditor').val(creditor);

                    totalcreditor = $('#debtor').val(debtor);
                    if (debtor !== creditor) {
                        $("#debtor,#creditor").css("background-color", "#f5c1c1");
                        $('#err').show();
                        $('#errbutton').hide();
                    }
                    if (debtor === creditor) {
                        $("#debtor,#creditor").css("background-color", "#b4f3b4");
                        $('#err').hide();
                        $('#errbutton').show();
                    }
                    if (accounts !== accounts) {
                        $("#debtor,#creditor").css("background-color", "#f5c1c1");
                        $('#errduble').show();
                        $('#errbutton').hide();
                    }
                    if (accounts === accounts) {
                        $('#errduble').hide();
                        $('#errbutton').show();
                    }
                    // calc_total();
                }

            });
        }


        $(document).ready(function () {
            $("#tax").on('change', function () {
                var tax = $("#tax").val();
                var subtotal = parseInt($("#subtotal").text());
                var total = (subtotal * tax) / 100;
                var grandTotal = $(".grand_total").text();
                $(".grand_total").text('');
                var grandTotal = $(".grand_total").text(total + grandTotal);
                $("#total_price").text($("#grand_total").text());

            });
        });

    </script>

@endsection

