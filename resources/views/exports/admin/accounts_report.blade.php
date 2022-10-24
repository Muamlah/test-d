<html lang="ar" dir="rtl">
<table>
    <thead>
    <tr>
        <th>الحساب من {{$date['start']}} الى {{$date['to']}}</th>
    </tr>
    <tr>
    </tr>
    <tr>
    </tr>
    </thead>
    <tbody>
    <tr>
        <th>رقم التعميد</th>
        <th>الحالة</th>
        <th>البيان</th>
        <th>قيمة التعميد</th>
        <th>عمولة التعميد</th>
        <th>قيمة التعقيب</th>
        <th>ضريبة القيمة المُضافة</th>
        <th>رسوم الاسترجاع</th>
        <th>التاريخ والوقت</th>
        <th>وسيلة الدفع</th>
        <th>حالة الدفع</th>
    </tr>
    @foreach($orders as $order)
        <tr>
            <td>{{ $order->title }}</td>
            <td></td>
            <td>{{ $order->status }}</td>
            <td>{{ $order->price }}</td>
            <td>{{ $order->fees }}</td>
            <td>{{ $order->feedback_value }}</td>
            <td>{{ $order->value_added_tax }}</td>
            <td>{{ $order->client_cancellation }}</td>
            <td>{{ $order->created_at }}</td>
            <td>مدى</td>
            <td>{{ $order->pay_status}}</td>
        </tr>
    @endforeach

    @foreach($thisStatus as $id)
        <tr>
        </tr>
        <tr>
        </tr>
        <tr>
            <td> عدد التعاميد {{ $accounts["name_$id"]}} </td>
            <td> {{ $accounts["countStatus_$id"] ?? 0 }}  </td>
        </tr>
        <tr>
            <td> جمالي قيمة التعاميد {{ $accounts["name_$id"]}} </td>
            <td>{{$accounts["totalStatus_$id"]}}</td>
        </tr>
        <tr>
            <td> عدد التعاميد الأساسية {{ $accounts["name_$id"]}} </td>
            <td>{{ $accounts["countStatusBasic_$id"] ?? 0 }} </td>
        </tr>
        <tr>
            <td> جمالي قيمة التعاميد الأساسية {{ $accounts["name_$id"]}} </td>
            <td>{{$accounts["totalStatusBasic_$id"]}}</td>
        </tr>
    @endforeach

    {{--    <tr>--}}
    {{--        <td> عدد  التعاميد  تم  التسليم </td>--}}
    {{--        <td>{{$accounts['delivered']}}</td>--}}
    {{--    </tr>--}}
    {{--    <tr>--}}
    {{--        <td> عدد  التعاميد  الملغية </td>--}}
    {{--        <td>{{$accounts['canceled']}}</td>--}}
    {{--    </tr>--}}
    {{--    <tr>--}}
    {{--    </tr>--}}
    {{--    <tr>--}}
    {{--    </tr>--}}
    {{--    <tr>--}}
    {{--    </tr>--}}
    {{--    <tr>--}}
    {{--        <td> عدد  التعاميد  الأساسية  بانتظار  التنفيذ </td>--}}
    {{--        <td>{{$accounts['countPendingExecutionBasic']}}</td>--}}
    {{--    </tr>--}}
    {{--    <tr>--}}
    {{--        <td> عدد  التعاميد  الأساسية  تم  التسليم </td>--}}
    {{--        <td>{{$accounts['countDeliveredBasic']}}</td>--}}
    {{--    </tr>--}}
    {{--    <tr>--}}
    {{--        <td> عدد  التعاميد  الأساسية  الملغية </td>--}}
    {{--        <td>{{$accounts['countCanceledBasic']}}</td>--}}
    {{--    </tr>--}}
    {{--    <tr>--}}
    {{--    </tr>--}}
    {{--    <tr>--}}
    {{--    </tr>--}}
    {{--    <tr>--}}
    {{--    </tr>--}}
    {{--    <tr>--}}
    {{--        <td> إجمالي  قيمة  التعاميد  الأساسية  بانتظار  التنفيذ </td>--}}
    {{--        <td>{{$accounts['totalDeliveredBasic']}}</td>--}}
    {{--    </tr>--}}
    {{--    <tr>--}}
    {{--        <td> إجمالي  قيمة  التعاميد  الأساسية  تم  التسليم </td>--}}
    {{--        <td>{{$accounts['totalCanceledBasic']}}</td>--}}
    {{--    </tr>--}}
    {{--    <tr>--}}
    {{--        <td> إجمالي  قيمة  التعاميد  الأساسية  الملغية </td>--}}
    {{--        <td>{{$accounts['totalPendingExecutionBasic']}}</td>--}}
    {{--    </tr>--}}
        <tr>
        </tr>
        <tr>
        </tr>
        <tr>
        </tr>
    <tr>
        <td> اجمالي رسوم الاسترجاع</td>
        <td>{{$accounts['totalReturnFee']}}</td>
    </tr>
    <tr>
    </tr>
    <tr>
    </tr>
    <tr>
    </tr>
    <tr>
        <td> اجمالي عمولة التعميد</td>
        <td>{{$accounts['totalCommissionsDelivered']}}</td>
    </tr>
    <tr>
        <td> اجمالي التعقيب</td>
        <td>{{$accounts['totalFeedback']}}</td>
    </tr>
    <tr>
        <td> صافي التعقيب للمكتب</td>
        <td>{{$accounts['netFeedbackOffice']}}</td>
    </tr>
    <tr>
        <td> صافي الايراد</td>
        <td>{{$accounts['netRevenue']}}</td>
    </tr>
    <tr>
    </tr>
    <tr>
    </tr>
    <tr>
        <td> إجمالي ضريبة القيمة المُضافة</td>
        <td>{{$accounts['totalAddedTax']}}</td>
    </tr>
    <tr>
    </tr>
    <tr>
    </tr>
    <tr>
        <td> تفاصيل التعقيب</td>
        <td></td>
    </tr>
    @if(isset($feedback_view['name']))
        @foreach($feedback_view['name'] as $key=>$item)
            <tr>
                <td> اجمالي قيمة التعقيب للمشرف {{$item}}     </td>
                <td>{{$feedback_view['total'][$key]}}  </td>
            </tr>
            <tr>
                <td> المستحق للمشرف</td>
                <td>{{$feedback_view['total'][$key]*0.4}}  </td>
            </tr>
            <tr>
                <td>التفاصيل</td>
            </tr>
            @foreach($feedback_view['data'][$key] as $data)
                <tr>
                    <td>{{$data->title}}</td>
                    <td> {{$data->fees}}</td>
                </tr>
            @endforeach
            <tr>
            </tr>
            <tr>
            </tr>
        @endforeach
    @endif
    {{--        <td> اجمالي  عمولة  التعميد  </td>--}}
    {{--        <td>{{$accounts['totalChristeningCommission']}}</td>--}}
    {{--    </tr>--}}
    {{--    <tr>--}}
    {{--        <td> اجمالي  التعقيب </td>--}}
    {{--        <td>{{$accounts['totalFeedback']}}</td>--}}
    {{--    </tr>--}}
    {{--    <tr>--}}
    {{--        <td> صافي  التعقيب  للمكتب </td>--}}
    {{--        <td>{{$accounts['netFeedbackOffice']}}</td>--}}
    {{--    </tr>--}}
    {{--    <tr>--}}
    {{--        <td>  صافي  الايراد </td>--}}
    {{--        <td>{{$accounts['netRevenue']}}</td>--}}
    {{--    </tr>--}}
    {{--    <tr>--}}
    {{--        <td> إجمالي  قيمة  التعاميد  "  تم  التسليم  " </td>--}}
    {{--        <td>{{$accounts['totalDelivered']}}</td>--}}
    {{--    </tr>--}}
    {{--    <tr>--}}
    {{--        <td> إجمالي  قيمة  التعاميد  "  إلغاء  " </td>--}}
    {{--        <td>{{$accounts['totalCanceled']}}</td>--}}
    {{--    </tr>--}}
    {{--    <tr>--}}
    {{--        <td> إجمالي  حساب  الراجحي </td>--}}
    {{--        <td>{{$accounts['totalAlrajhi']}}</td>--}}
    {{--    </tr>--}}
    {{--    <tr>--}}
    {{--        <td> إجمالي  حساب  الأهلي </td>--}}
    {{--        <td>{{$accounts['totalAlahly']}}</td>--}}
    {{--    </tr>--}}
    {{--    <tr>--}}
    {{--        <td> إجمالي  العمولات  من  "  تم  التسليم  فقط  " </td>--}}
    {{--        <td>{{$accounts['totalCommissionsDelivered']}}</td>--}}
    {{--    </tr>--}}
    {{--    <tr>--}}
    {{--        <td> إجمالي  قيمة  التعقيب </td>--}}
    {{--        <td>{{$accounts['totalFeedback']}}</td>--}}
    {{--    </tr>--}}

    </tbody>
</table>
</html>


