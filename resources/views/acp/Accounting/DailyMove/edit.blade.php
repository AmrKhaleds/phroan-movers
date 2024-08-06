@extends('Dashboard.layouts.app')

@section('title')
    @lang('back.edit_dailymove')
@endsection

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
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

                <div class="card-body p-4">
                    <form action="{{route('dailymoves.update',$daily_move->id)}}" method="post">
                        @method('PUT')
                        @csrf
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label"
                                           for="formrow-email-input">@lang('back.reference')</label>
                                    <input type="number" class="form-control"
                                           placeholder="@lang('back.reference')"
                                           name="reference"
                                           value="{{old('reference',$daily_move->ref)}}">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="example-text-input"
                                           class="form-label">@lang('back.num_dailymove')</label>
                                    <input class="form-control" type="number"
                                           name="num_dailymove" value="{{old('num_dailymove',$daily_move->registration_number)}}"
                                           id="example-text-input"
                                           placeholder="@lang('back.num_dailymove')">
                                </div>
                            </div>



                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label"
                                           for="formrow-email-input">@lang('back.date')</label>
                                    <input type="date" class="form-control"
                                           placeholder="@lang('back.date')"
                                           name="date"
                                           value="{{old('date',$daily_move->date)}}">
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label"
                                           for="formrow-email-input">@lang('back.document')</label>
                                    <input type="file" class="form-control" name="document">
                                </div>
                            </div>


                        </div>

                        <div class="row">

                            <div class="col-lg-12">
                                <div class="row clearfix">
                                    <div class="col-md-12">
                                        <table class="table table-bordered table-hover"
                                               id="tab_logic">
                                            <thead>
                                            <tr>
                                                <th class="text-center"> #</th>
                                                <th class="text-center" width="40%"> @lang('back.account_num') /  @lang('back.account_name')</th>
                                                <th class="text-center" width="10%"> @lang('back.debtor') </th>
                                                <th class="text-center" width="10%">@lang('back.creditor') </th>
                                                <th class="text-center" width="40%">@lang('back.statement') </th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            @php
                                                $debtor =0;
                                                $creditor =0;
                                            @endphp
                                            @foreach($daily_move->dailyMoveItem as $k => $item)
                                                @php
                                                    $debtor +=$item->debtor;
                                                    $creditor +=$item->creditor;
                                                @endphp
                                            <tr id='addr0'>
                                                <td>{{$k+1}}</td>
                                                <td>
                                                    {{--<select name="account_id[]" class="form-control" data-trigger name="accounts[]"
                                                            id="choices-single-default"
                                                            placeholder="@lang('back.select_one')">--}}
                                                    <select name="account_id[]" class="form-control accounts">
                                                        <option value="">@lang('back.select_one')</option>
                                                        @foreach($accounts as $account)
                                                            <option value="{{$account->id}}" {{$item->account_id == $account->id ? 'selected' : ''}} >{{$account->name}} , {{$account->num}}</option>
                                                        @endforeach

                                                    </select>

                                                </td>

                                                <td><input type="number" name='debtor[]'
                                                           placeholder='@lang('back.debtor')'
                                                           class="form-control debtor" value="{{old('debtor',$item->debtor ? $item->debtor : 0)}}"
                                                           step="0.00" min="0"/></td>
                                                <td><input type="number" name='creditor[]' value="{{old('creditor',$item->creditor ? $item->creditor : 0)}}"
                                                           placeholder='@lang('back.creditor')'
                                                           class="form-control creditor"
                                                           step="0.00" min="0"/></td>
                                                <td>
                                                    <textarea name='noteItem[]' placeholder='@lang('back.notes')' class="form-control notes">{{old('noteItem',$item->notes)}}</textarea>
                                                </td>
                                            </tr>
                                            <tr id='addr1'></tr>
                                            @endforeach

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
                                        <h6 style="color: red ; display: none" id="err">@lang('back.total_amount_creditor_not_equal_total_amount_debtor')</h6>
                                        <h6 style="color: red ; display: none" id="errduble">@lang('back.creditors_account_may_not_same_debit_account')</h6>
                                        <table class="table table-bordered table-hover"
                                               id="tab_logic_total">
                                            <tbody>
                                            <tr>
                                                <th class="text-center">@lang('back.debtor')</th>
                                                <td class="text-center"><input type="number"
                                                                               name='debtorTotal' value="{{$debtor}}"
                                                                               placeholder='0.00'
                                                                               class="form-control"
                                                                               id="debtor"
                                                                               readonly/>
                                                </td>
                                            </tr>


                                            <tr>
                                                <th class="text-center">@lang('back.creditor')</th>
                                                <td class="text-center"><input type="text"
                                                                               name='creditorTotal' value="{{$creditor}}"
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

                            </div>


                            <div class="mt-4">
                                <textarea name="notes" placeholder="@lang('back.notes')" class="form-control">{{old('notes',$daily_move->notes)}}</textarea>
                            </div>
                            <div class="mt-4" id="errbutton">
                                <button type="submit"
                                        class="btn btn-primary w-md">@lang('back.submit')</button>
                            </div>
                        </div>

                    </form>
                </div>
            </div>
        </div> <!-- end col -->
    </div>



@endsection

@section('js')
    <script src="{{url('acp/js/jquery.invoice.js')}}"></script>
    <script src="{{url('acp/libs/choices.js/assets/scripts/choices.min.js')}}"></script>
    <script src="{{url('acp/js/pages/form-advanced.init.js')}}"></script>


    <script>

        $(document).ready(function () {
            var i = 1;
            $(".add_row").click(function () {
                b = i - 1;
                $('.addr' + i).html($('.addr' + b).html()).find('td:first-child').html(i + 1);
                $('.tab_logic').append('<tr class="addr' + (i + 1) + '"></tr>');
                i++;
            });
            $(".delete_row").click(function () {
                if (i > 1) {
                    $(".addr" + (i - 1)).html('');
                    i--;
                }
                calc();
            });

            $('.tab_logic tbody').on('keyup change', function () {
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
                    if (debtor !== creditor){
                        $("#debtor,#creditor").css("background-color","#f5c1c1");
                        $('#err').show();
                        $('#errbutton').hide();
                    }
                    if(debtor === creditor){
                        $("#debtor,#creditor").css("background-color","#b4f3b4");
                        $('#err').hide();
                        $('#errbutton').show();
                    }
                    if (accounts !== accounts){
                        $("#debtor,#creditor").css("background-color","#f5c1c1");
                        $('#errduble').show();
                        $('#errbutton').hide();
                    }
                    if(accounts === accounts){
                        $('#errduble').hide();
                        $('#errbutton').show();
                    }
                    // calc_total();
                }
            });
        }


    </script>

@endsection

