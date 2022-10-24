@extends('website.layout')
@section('style')

    <style>


        .wpwl-form-card {

            min-height: 0px !important;

        }


        .wpwl-label-brand {

            display: none !important;

        }

        .wpwl-control-brand {

            display: none !important;

        }


        .wpwl-brand-card {

            display: block;

            visibility: visible;

            position: absolute;

            right: 178px;

            top: 40px;

            width: 67px;

            z-index: 10;

        }


        .wpwl-brand-MASTER {

            margin-top: -10;

            margin-right: -10;

        }


    </style>
@endsection
@section('content')

    <!-- Page Content-->
    <div class="page-content header-clear-medium">
        <div data-card-height="240" class="card card-style rounded-m shadow-xl">
            <div class="card-top text-center mt-4 mr-3">
                <h3 class="color-white mb-0 mb-n2 font-20">الرجاء إكمال عملية الدفع لتأكيد الطلب!</h3>
            </div>
            <div class="card-center text-center">
                <h2 class="color-white fa-2x">رقم الطلب: {{$order->order_id}}</h2>
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

                    <div class="col pl-0">
                        <div class="mx-0 mb-3 text-center">
                            <h6 class="font-14 font-800 text-uppercase color-gray3-light ">قيمة التعميد </h6>

                                <h3 class="color-gray2-dark font-16 mb-0">{{$order->price}} ريال</h3>
                        </div>
                    </div>
                    <div class="col pr-0 text-center">
                        <div class="mx-0 mb-3">
                            <h6 class="font-14 font-800 text-uppercase ">رسوم التعميد</h6>
                            <h3 class="color-gray2-dark font-16 mb-0">
                            @if($order->edit_price!=0)
                                @if($order->getDiscount() > 0)
                                    <span class="old-price">
                                            {{$order->getDiscount() + CalculateFees($order->edit_price)->fee + CalculateFees($order->edit_price)->tax_amount}}
                                        </span>
                                @endif
                                {{CalculateFees($order->edit_price)->fee + CalculateFees($order->edit_price)->tax_amount}} ريال
                            @else
                                {{$order->fees }} ريال
                            @endif
                            </h3>
                        </div>
                    </div>
                    @if ( $order->value_added_tax != 0 )
                    <div class="col pr-0 text-center">
                        <div class="mx-0 mb-3">
                            <h6 class="font-14 font-800 text-uppercase ">ضريبة القيمة المضافة</h6>

                            <h3 class="color-gray2-dark font-16 mb-0">{{$order->value_added_tax }} ريال </h3>
                        </div>
                    </div>
                    @endif
                    @if ( $order->client_cancellation != 0 )
                        <div class="col pr-0 text-center">
                            <div class="mx-0 mb-3">
                                <h6 class="font-14 font-800 text-uppercase ">رسوم الاسترجاع</h6>
                                <h3 class="color-gray2-dark font-16 mb-0">{{$order->client_cancellation}} ريال</h3>
                            </div>
                        </div>
                    @endif
                    @if($order->update_price != 0)
                        <div class="col pr-0 text-center">
                            <div class="mx-0 mb-3">
                                <h6 class="font-14 font-800 text-uppercase ">عمولة التعديل</h6>
                                <h3 class="color-gray2-dark font-16 mb-0">{{$order->update_price}} ريال</h3>
                            </div>
                        </div>
                    @endif
                    @if($order->agent_per > 0)
                    <div class="col text-center">
                        <div class="mx-0 mb-3 text-center">
                            <h6 class="font-14 font-800 text-uppercase">رسوم الوكيل</h6>
                            <h3 class="color-gray2-dark font-16 mb-0">{{number_format($order->agent_per,2)}} ريال</h3>
                        </div>
                    </div>
                    @endif
                </div>
                <div class="divider mt-2 mb-3"></div>
                <div class="row mb-0">

                    @if( $order->total_amount - $order->deserved_price == 0)
                        <div class="col text-center">
                            <div class="mx-0 mb-3 text-center">
                                <h6 class="font-14 font-800 text-uppercase color-gray3-light">حالة الدفع</h6>
                                <h3 class="color-gray2-dark font-16 mb-0">في الانتظار</h3>
                            </div>
                        </div>
                        @if($order->getDiscount() > 0)
                        <div class="col text-center">
                            <div class="mx-0 mb-3 text-center">
                                <h6 class="font-14 font-800 text-uppercase color-gray3-light">مقدار الحسم</h6>
                                <h3 class="font-16 mb-0 discount" style="color: red">{{$order->getDiscount()}} ريال</h3>
                            </div>
                        </div>
                        @endif
                        <div class="col text-center">
                            <div class="mx-0 mb-3">
                                <h6 class="font-14 font-800 text-uppercase color-gray3-light">المبلغ المطلوب دفعة</h6>
                                <h3 class="color-gray2-dark font-16 mb-0">{{$order->total_amount}} ريال</h3>
                            </div>
                        </div>
                    @elseif($order->edit_price!=0)
                        <div class="col text-center">
                            <div class="mx-0 mb-3 text-center">
                                <h6 class="font-14 font-800 text-uppercase color-gray3-light">حالة الدفع</h6>
                                <h3 class="color-gray2-dark font-16 mb-0">في الانتظار</h3>
                            </div>
                        </div>
                        @if($order->getDiscount() > 0)
                        <div class="col text-center">
                            <div class="mx-0 mb-3 text-center">
                                <h6 class="font-14 font-800 text-uppercase color-gray3-light">الحسم</h6>
                                <h3 class="font-16 mb-0 discount">{{$order->getDiscount()}} ريال</h3>
                            </div>
                        </div>
                        @endif
                        <div class="col text-center">
                            <div class="mx-0 mb-3">
                                <h6 class="font-14 font-800 text-uppercase color-gray3-light">المبلغ المطلوب دفعة </h6>
                                <h3 class="color-gray2-dark font-16 mb-0">{{$order->deserved_price}} ريال</h3>
                            </div>
                        </div>
                        <div class="col text-center">
                            <div class="mx-0 mb-3">
                                <h6 class="font-14 font-800 text-uppercase color-gray3-light">المبلغ المدفوع سابقا قبل التعديل</h6>
                                <h3 class="color-gray2-dark font-16 mb-0">{{  $order->total_amount}} ريال</h3>
                            </div>
                        </div>
                    @else
                        <div class="col text-center">
                            <div class="mx-0 mb-3 text-center">
                                <h6 class="font-14 font-800 text-uppercase color-gray3-light">حالة الدفع</h6>
                                <h3 class="color-gray2-dark font-16 mb-0">في الانتظار</h3>
                            </div>
                        </div>
                        @if($order->getDiscount() > 0)
                        <div class="col text-center">
                            <div class="mx-0 mb-3 text-center">
                                <h6 class="font-14 font-800 text-uppercase color-gray3-light">الحسم</h6>
                                <h3 class="font-16 mb-0 discount">{{$order->getDiscount()}} ريال</h3>
                            </div>
                        </div>
                        @endif
                        <div class="col text-center">
                            <div class="mx-0 mb-3">
                                <h6 class="font-14 font-800 text-uppercase color-gray3-light">المبلغ المطلوب دفعة  بعد الخصم من الرصيد المتاح</h6>
                                <h3 class="color-gray2-dark font-16 mb-0">{{$order->deserved_price}} ريال</h3>
                            </div>
                        </div>
{{--                        <div class="col text-center">--}}
{{--                            <div class="mx-0 mb-3">--}}
{{--                                <h6 class="font-14 font-800 text-uppercase color-gray3-light">المبلغ المخصوم من الرصيد</h6>--}}
{{--                                <h3 class="color-gray2-dark font-16 mb-0">{{  $order->order->total_amount }} ريال</h3>--}}
{{--                            </div>--}}
{{--                        </div>--}}
                    @endif
                </div>
                <div class="mt-2">
                    <form action="{{ route('hyperpay.response',['id'=>$order->order->id,'type'=>$type])}}" class="paymentWidgets" data-brands="VISA MADA"></form>
                </div>
                {{-- <div class="mt-2">
                    <form action="{{ route('hyperpay.response',['id'=>$order->id,'type'=>$type])}}" class="paymentWidgets" data-brands="APPLEPAY"></form>
                </div> --}}
            </div>
        </div>
{{--        <div class="card card-style" hidden>--}}
{{--            <div class="content">--}}
{{--                <h3 class="text-center color-highlight">منصة معاملة . كوم</h3>--}}
{{--                <p class="text-center">--}}
{{--                    منصة للخدمات الالكترونية تجمع بين العملاء و مقدمي الخدمات في السعودية.--}}
{{--                    <br><br>--}}
{{--                    للإستفسار تواصل مع أحد المشرفين المعتمدين..--}}
{{--                </p>--}}
{{--                @foreach($admins as $admin)--}}
{{--                    <div class="user-slider owl-carousel">--}}
{{--                        <div class="user-left">--}}
{{--                            <div class="d-flex">--}}
{{--                                <div>--}}
{{--                                    <img src="images/pictures/faces/1s.png" class="ml-3 rounded-circle shadow-l" width="50">--}}
{{--                                </div>--}}
{{--                                <div>--}}
{{--                                    <h5 class="mt-1 mb-0">{{$admin->name}}</h5>--}}
{{--                                    <p class="font-10 mt-n1 color-red2-dark">المشرف المالي</p>--}}
{{--                                </div>--}}
{{--                                <div class="mr-auto"><span--}}
{{--                                        class="next-slide-user color-white rounded-s bg-highlight mt-2 p-2 font-8">--}}
{{--                                        تواصل معه--}}
{{--                                    </span></div>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                        <div class="user-right">--}}
{{--                            <div class="d-flex">--}}
{{--                                <div>--}}
{{--                                    <h5 class="mt-1 mb-0">{{$admin->name}}</h5>--}}
{{--                                    <p class="font-10 mt-n1 color-red2-dark">المشرف المالي</p>--}}
{{--                                </div>--}}
{{--                                <div class="mr-auto">--}}
{{--                                    <a href="#" class="icon icon-xs rounded-circle shadow-l bg-blue2-dark mr-2 ml-2">--}}
{{--                                        <i class="fab fa-telegram-plane"></i></a>--}}
{{--                                    <a href="#" class="icon icon-xs rounded-circle shadow-l bg-whatsapp">--}}
{{--                                        <i class="fab fa-whatsapp"></i></a>--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                    </div>--}}

{{--                    <div class="divider mt-3"></div>--}}
{{--                @endforeach--}}

{{--            </div>--}}
{{--        </div>--}}
    </div>
    <script>
        var wpwlOptions = {
            locale: "ar", //change it based on the werbsite language

            onReady: function(){
                $(".wpwl-brand").css("display","none");

                if (wpwlOptions.locale == "ar") {
                    $(".wpwl-group").css('direction', 'ltr');
                    $(".wpwl-control-cardNumber").css({'direction': 'ltr' , "text-align":"right"});
                    $(".wpwl-brand-card").css('right', '200px');
                }

            },onDetectBrand: function(brands){
                $(".wpwl-brand").css("display","block");
            }
        };
    </script>
    @if(config('payment.production'))
        <script src="https://oppwa.com/v1/paymentWidgets.js?checkoutId={{$checkout_id}}"></script>
    @else
        <script src="https://test.oppwa.com/v1/paymentWidgets.js?checkoutId={{$checkout_id}}"></script>
    @endif

@endsection
