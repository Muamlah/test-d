@extends('website.layout')
@section('content')
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
        @if (Session::get('hyperpay_error') )
            <div class="ml-3 mr-3 alert alert-small rounded-s shadow-xl bg-red2-dark" role="alert">
                <span class="alert-icon"><i class="fa fa-times-circle font-18"></i></span>
                <strong>{{Session::get('hyperpay_error')}} </strong>
                <button type="button" class="close color-white opacity-60 font-16" data-dismiss="alert" aria-label="Close">&times;</button>
            </div>
        @endif

        <div class="card card-style">
            <div class="content mb-0">
                <div class="row mb-0">

                    <div class="col-4 pl-0">
                        <div class="mx-0 mb-3 text-center">
                            <h6 class="font-14 font-800 text-uppercase color-gray3-light ">قيمة الخدمة</h6>
                            <h3 class="color-gray2-dark font-16 mb-0">{{$order->price}} ريال</h3>
                        </div>
                    </div>
                    <div class="col-4 p-0 text-center">
                        <div class="mx-0 mb-3">
                            <h6 class="font-14 font-800 text-uppercase ">رسوم الخدمة
                                
                            </h6>
                            <h3 class="color-gray2-dark font-16 mb-0">{{$order->fees + $order->value_added_tax}} ريال</h3>
                        </div>
                    </div>
                    <div class="col-4 pr-0 text-center">
                        <div class="mx-0 mb-3">
                            <h6 class="font-14 font-800 text-uppercase ">رسوم الاسترجاع</h6>
                            <h3 class="color-gray2-dark font-16 mb-0">{{fess()->service_cancellation}} ريال</h3>
                        </div>
                    </div>
                </div>
                <div class="divider mt-2 mb-3"></div>
                <div class="row mb-0">
                    <div class="col-6 text-center">
                        <div class="mx-0 mb-3 text-center">
                            <h6 class="font-14 font-800 text-uppercase color-gray3-light">حالة الدفع</h6>
                            <h3 class="color-gray2-dark font-16 mb-0">في الانتظار</h3>
                        </div>
                    </div>
                    <div class="col-6 text-center">
                        <div class="mx-0 mb-3">
                            <h6 class="font-14 font-800 text-uppercase color-gray3-light">المبلغ المطلوب دفعة</h6>
                            <h3 class="color-gray2-dark font-16 mb-0">{{$order->diff_amount}} ريال</h3>
                        </div>
                    </div>
                </div>
                <div class="mt-2">
                    <a href="{{url('payment/eservice-store-second/balance').'/'.$order->order_id}}" class="btn btn-m w-100 btn-full rounded-l bg-green-c mr-auto ml-auto font-900 text mt-4">الدفع من الرصيد</a>
                </div>
            </div>
        </div>
    </div>

@endsection
