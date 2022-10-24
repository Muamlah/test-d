@extends('website.layout')
@section('content')
    <!-- Page Content-->
    <div class="page-content header-clear-medium">
        <div data-card-height="240" class="card card-style rounded-m shadow-xl">
            <div class="card-top text-center mt-4 mr-3">
                <h3 class="color-white mb-0 mb-n2 font-20">الرجاء إكمال عملية الدفع لتأكيد الطلب!</h3>
            </div>
            <div class="card-center text-center">
                <h2 class="color-white fa-2x">رقم الطلب: {{$order->id}}</h2>
                <p class="color-white opacity-70 font-11 mt-5 mb-n5"><i class="fas m-1 fa-shield-alt"></i>نظام آمن و
                    مشفر 100%</p>
            </div>
            <div class="card-overlay bg-gradient opacity-70"></div>
            <div class="card-overlay bg-gradient bg-gradient-magenta3 opacity-80"></div>
        </div>
        @if (Session::get('payment_error') )
            <div class="ml-3 mr-3 alert alert-small rounded-s shadow-xl bg-red2-dark" role="alert">
                <span class="alert-icon"><i class="fa fa-times-circle font-18"></i></span>
                <strong>{{Session::get('payment_error')}} </strong>
                <button type="button" class="close color-white opacity-60 font-16" data-dismiss="alert" aria-label="Close">&times;</button>
            </div>
        @endif
        <div class="card card-style">
            <div class="content mb-0">
                <div class="row mb-0">

                    <div class="col-3 pl-0">
                        <div class="mx-0 mb-3 text-center">
                            <h6 class="font-14 font-800 text-uppercase color-gray3-light ">قيمة التعميد </h6>
                            @if($order->edit_price!=0)
                                <h3 class="color-gray2-dark font-16 mb-0">{{$order->edit_price}} ريال</h3>
                            @else
                                <h3 class="color-gray2-dark font-16 mb-0">{{$offer->price}} ريال</h3>
                            @endif
                        </div>
                    </div>
                    <div class="col-3 p-0 text-center">
                        <div class="mx-0 mb-3">
                            <h6 class="font-14 font-800 text-uppercase "> رسوم التعميد  <span class="toast-info">
                                        <i class="fas fa-question-circle bubble"></i>
                                        <span class="info-bubble">
                                            <ul>
                                                <li>اجمالي الرسوم 3.5%</li>
                                                <li>ضريبة القيمة المضافة {{$fees['order_added_tax']}}% من الرسوم</li>
                                                <li>رسوم المنصة {{$fees['order_fee']}} ريال؜ (مسترجعة)</li>
                                                <li>رسوم البنك {{$order->bank_fees}} ريال (غير مستردة)</li>
                                                <li>رسوم بوابة الدفع {{$fees['payment_gateway_fee']}} ريال (غير مستردة)</li>
                                            </ul>
                                        </span>
                                    </span></h6>
                            @if($order->edit_price!=0)
                                <h3 class="color-gray2-dark font-16 mb-0">
                                    @if($order->getDiscount() > 0)
                                    <span class="old-price">{{$order->getDiscount() + CalculateFees($order->edit_price)->fee + CalculateFees($order->edit_price)->tax_amount}}</span>
                                @endif
                                {{CalculateFees($order->edit_price)->fee + CalculateFees($order->edit_price)->tax_amount}} ريال</h3>
                            @else
                                <h3 class="color-gray2-dark font-16 mb-0">
                                    @if($order->getDiscount() > 0)
                                        <span class="old-price">{{$order->getDiscount() + $fees['order_fee'] + $fees['order_added_tax']}}</span>
                                    @endif
                                {{$fees['order_fee'] + $fees['order_added_tax']}} ريال</h3>
                            @endif
                        </div>
                    </div>
                    <div class="col-3 pr-0 text-center">
                        <div class="mx-0 mb-3">
                            <h6 class="font-14 font-800 text-uppercase ">رسوم الاسترجاع</h6>
                            <h3 class="color-gray2-dark font-16 mb-0">{{$order->client_cancellation}} ريال</h3>
                        </div>
                    </div>
                    <div class="col-3 text-center">
                        <div class="mx-0 mb-3 text-center">
                            <h6 class="font-14 font-800 text-uppercase">رسوم الوكيل</h6>
                            <h3 class="color-gray2-dark font-16 mb-0">{{number_format($order->agent_per,2)}} ريال</h3>
                        </div>
                    </div>
                </div>
                <div class="divider mt-2 mb-3"></div>
                <div class="row mb-0">
                    <div class="col-4 text-center">
                        <div class="mx-0 mb-3 text-center">
                            <h6 class="font-14 font-800 text-uppercase color-gray3-light">حالة الدفع</h6>
                            <h3 class="color-gray2-dark font-16 mb-0">في الانتظار</h3>
                        </div>
                    </div>
                    <div class="col-4 text-center">
                        <div class="mx-0 mb-3">
                            <h6 class="font-14 font-800 text-uppercase color-gray3-light">الرصيد المتاح</h6>
                            <h3 class="color-gray2-dark font-16 mb-0">{{Auth::user()->available_balance}} ريال</h3>
                        </div>
                    </div>
                    @php
                        $total_amount       = $fees['order_fee'] + $fees['order_added_tax'] + (double)$offer->price;
                    @endphp
                    <div class="col-4 text-center">
                        <div class="mx-0 mb-3">
                            <h6 class="font-14 font-800 text-uppercase color-gray3-light">المبلغ المطلوب خصمة  من الرصيد</h6>
                            <h3 class="color-gray2-dark font-16 mb-0">{{  $total_amount }} ريال</h3>
                        </div>
                    </div>
                </div>
                @if(Auth::user()->available_balance >= $total_amount)
                    <div class="mt-2">
                        @if($type == 'public_order')
                            <a href="{{route('balance.public_order_payment_from_balance',['id'=>$order->id,'offer_id' => $offer->id])}}" class="btn btn-m w-100 btn-full rounded-l bg-green-c mr-auto ml-auto font-900 text mt-4">ادفع من الرصيد</a>
                        @else
                            <a href="{{route('balance.private_order_payment_from_balance',['id'=>$order->id])}}" class="btn btn-m w-100 btn-full rounded-l bg-green-c mr-auto ml-auto font-900 text mt-4">ادفع من الرصيد</a>
                        @endif
                    </div>
                @endif
            </div>
        </div>
    </div>
@endsection
