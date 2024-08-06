<pre style="    text-align: right;    font-weight: bolder;">
شركة فرعون لنقل الاثاث الشركة الاولي في مصر
%0a___________________________________%0a
رقم الاوردر : {{$val->id}} %0a
اسم العميل : {{str_replace('"',' ',$val->client_name)}}%0a
رقم الهاتف : {{$val->client_phone}} %0a
من : {{$val->fromArea ? $val->fromArea->name : ''}} %0a
الي : {{$val->toArea ? $val->toArea->name : ''}} %0a
نازل من الدور : {{$val->from_floor}} %0a
طالع الي الدور : {{$val->to_floor}} %0a
تاريخ التنفيذ : {{$val->booking_at}} {{$val->order_day}} %0a
وقت التنفيذ : {{\Carbon\Carbon::createFromFormat('H:i', date("h:i",strtotime($val->order_time)))->isoFormat('h:mm a')}} %0a
اجمالي الاوردر : {{number_format($val->price)}} @lang('back.l.e') %0a
%0a___________________________________%0a
               فريق التنفيذ
%0a___________________________________%0a
                السيارة : فرعون
%0a___________________________________%0a
الملاحظات الموجودة في الاوردر :
%0a___________________________________%0a
    {{$val->note}}
</pre>
