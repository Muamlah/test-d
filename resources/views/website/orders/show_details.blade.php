@extends('website.layout')

@section('content')
    <!-- Page Content-->

    <div class="page-content header-clear-medium">

        @if ($message = Session::get('error') )
            <div class="alert mr-3 ml-3 rounded-s bg-red2-dark " role="alert">
                <span class="alert-icon"><i class="fa fa-times-circle font-18"></i></span>
                <h4 class="text-uppercase color-white">{{$message}} !</h4>
                <button type="button" class="close color-white opacity-60 font-16" data-dismiss="alert"
                        aria-label="Close">&times;
                </button>
            </div>
        @endif

        @if(@$item->status == '6')
            <div class="alert mr-3 ml-3 rounded-s bg-red2-dark " role="alert">
                <span class="alert-icon"><i class="fa fa-times-circle font-18"></i></span>
                <h4 class="text-uppercase color-white">بانتظار تأكيد مقدم الخدمة لالغاء الطلب !</h4>
                {{--                <strong class="alert-icon-text">بانتظار تأكيد مقدم الخدمة لالغاء الطلب</strong>--}}
                <button type="button" class="close color-white opacity-60 font-16" data-dismiss="alert"
                        aria-label="Close">&times;
                </button>
            </div>
        @endif

        @if(@$item->status == '5')
            <div class="ml-3 mr-3 alert alert-small rounded-s shadow-xl bg-green1-dark" role="alert">
                <span><i class="fa fa-check"></i></span>
                <strong>تم تأكيد استلام الطلب !</strong>
                <button type="button" class="close color-white opacity-60 font-16" data-dismiss="alert"
                        aria-label="Close">&times;
                </button>
            </div>
        @endif
        @if(@$item->status == '4')
            <div class="ml-3 mr-3 alert alert-small rounded-s shadow-xl bg-green1-dark" role="alert">
                <span><i class="fa fa-check"></i></span>
                <h4 class="text-uppercase color-white">بانتظار تأكيد العميل لاستلام الطلب !</h4>
                {{--                    <strong class="alert-icon-text">بانتظار تأكيد العميل لاستلام الطلب</strong>--}}
                <button type="button" class="close color-white opacity-60 font-16" data-dismiss="alert"
                        aria-label="Close">&times;
                </button>
            </div>
        @endif
        <div class="card card-overflow card-style">
            <div class="content">
                <div class="d-flex">
                    <div class="flex-grow-1">
                        <h1 class="font-30 mb-3"> {{$item->title}}</h1>
                    </div>
                    <div class="flex-shrink-1">
                        <h4 class="font-20"> {{@$item->price}} ريال </h4>
                    </div>
                </div>

                <div class="divider"></div>
                <h4>تفاصيل الطلب :</h4>
                <p>{{@$item->details}}</p>

                <div class="row">
                    <div class="col-6 mb-4">
                        <strong class="color-theme"><span class="font-14">حالة الطلب</span></strong>
                        <p>

                            @if(@$item->status == 1)
                                <span
                                    class="bg-dark1-light rounded-xs text-uppercase font-900 font-14 pr-2 pl-2 pb-0 pt-0 line-height-s">
 بإنتظارالمراجعة                                     </span>
                            @elseif(@$item->status == 2)
                                <span
                                    class="bg-yellow1-dark rounded-xs text-uppercase font-11 pr-2 pl-2 pb-1 pt-1 line-height-s">
                                        بإنتظار الموافقة
                                    </span>
                            @elseif(@$item->status ==3)
                                <span
                                    class="bg-yellow1-dark rounded-xs text-uppercase font-11 pr-2 pl-2 pb-1 pt-1 line-height-s">
 قيد التنفيذ                                      </span>

                            @elseif(@$item->status == 4)

                                <span
                                    class="bg-green1-dark rounded-xs text-uppercase font-11 pr-2 pl-2 pb-1 pt-1 line-height-s">
                                       بإنتظار الإستلام
                                    </span>
                            @elseif(@$item->status == 5)

                                <span
                                    class="bg-green1-dark rounded-xs text-uppercase font-11 pr-2 pl-2 pb-1 pt-1 line-height-s">
                                                                                تم التسليم

                                     </span>

                            @elseif(@$item->status == 6)
                                <span
                                    class="bg-red1-dark rounded-xs text-uppercase font-11 pr-2 pl-2 pb-1 pt-1 line-height-s">
                                         بانتظار الغاء مقدم الخدمة
                                      </span>
                            @elseif(@$item->status == 7)
                                <span
                                    class="bg-red2-dark rounded-xs text-uppercase font-11 pr-2 pl-2 pb-1 pt-1 line-height-s">
                                         ملغي
                                      </span>
                            @endif

                        </p>
                    </div>

                    <div class="col-6 mb-4">
                        <strong class="color-theme"><span class="font-14">
                                @if(@$item->provider->name !='')
                                    إسم مقدم الخدمة
                                @else
                                    رقم مقدم الخدمة
                                @endif
                            </span></strong>
                        <p class="font-12">
                            @if(@$item->provider->name !=null)
                                {{@$item->provider->name}}
                            @else
                                {{@$item->provider->phone}}
                            @endif
                        </p>
                    </div>
                    <div class="col-6 mb-4">
                        <strong class="color-theme"><span class="font-14">قيمة التعميد</span></strong>
                        <p class="font-12">
                            {{@$item->price}} ريال
                        </p>
                    </div>
                    <div class="col-6 mb-4">
                        <strong class="color-theme"><span class="font-14">رسوم التعميد</span></strong>
                        <p class="font-12">
                            {{@$item->fees}} ريال
                        </p>
                    </div>
                    <div class="col-6 mb-4">
                        <strong class="color-theme"><span class="font-14">ضريبة القيمة المضافة</span></strong>
                        <p class="font-12">
                            2.25 ريال
                        </p>
                    </div>
                    <div class="col-6 mb-4">
                        <strong class="color-theme"><span class="font-14">اجمالي المبلغ</span></strong>
                        <p class="font-12">
                            {{@$item->total_amount + 2.25}} ريال
                        </p>
                    </div>
                    <div class="col-6 mb-4">
                        <strong class="color-theme"><span class="font-14">تاريخ نهاية التعميد</span></strong>
                        <p class="font-12">
                            {{@$item->deadline}}
                        </p>
                    </div>
                    <div class="col-6 mb-4">
                        <strong class="color-theme"><span class="font-14">الحساب المحول منه</span></strong>
                        <p class="font-12">
                            MADA
                        </p>
                    </div>
                    <div class="col-6 mb-4">
                        <strong class="color-theme"><span class="font-14">حالة الدفع</span></strong>
                        @if(@$item->pay_status == 'processing_convert')
                            <p class="font-12">في إنتظار تأكيد الدفع</p>
                        @else
                            <p class="font-12">تم التحويل</p>
                        @endif
                    </div>
                    <div class="col-6 mb-4">
                        <strong class="color-theme"><span class="font-14">رسوم بوابة الدفع</span></strong>
                        <p class="font-12">
                            ريال  {{@$item->payment_gateway_fee}}
                        </p>
                    </div>
                    <div class="col-6 mb-4">
                        <strong class="color-theme"><span class="font-14">رسوم الاسترجاع</span></strong>
                        <p class="font-12">
                            ريال  {{@$item->client_cancellation}}
                        </p>
                    </div>
                </div>
                <div class="divider mt-4"></div>
              @if(auth()->user()->id == $item->user_id)
                <div class="row mb-0">
                    @if($item->status == 4)
                    <div class="col-6">
                            @if(settings()->active_order == 'sms')
                                <a href="#" data-menu="menu-otp" onclick="sendSMSOTP()"
                                   class="btn btn-full btn-m font-900 text-uppercase rounded-sm shadow-l bg-green-c">تأكيد استلام الطلب</a>
                            @else
                                <a href="#" data-menu="menu-password"
                                   class="btn btn-full btn-m font-900 text-uppercase rounded-sm shadow-l bg-green-c">تأكيد استلام الطلب</a>
                            @endif
                        </div>
                    @endif
                          @if($item->status == 2 || $item->status == 3 || $item->status == 4)
                        <div class="col-6">
                            <form action="{{url('/public_orders/update-status/'.$item->id.'/6')}}" method="POST">
                                {{ csrf_field() }}
                                <button type="submit" class="btn w-100  btn-full btn-m font-900 text-uppercase rounded-sm shadow-l bg-red2-dark">
                                    إلغاء الطلب
                                </button>
                            </form>
                        </div>
                    @endif
                </div>
                @else

                    @if($item->status == 2 || $item->status == 3 )

                    <div class="row mb-0">
                        <div class="col-6">
                            <form action="{{url('/public_orders/update-status/'.$item->id.'/3')}}" method="POST">
                                {{ csrf_field() }}
                                <button type="submit" class="btn w-100  btn-full btn-m font-900 text-uppercase rounded-sm shadow-l bg-green1-dark">
                                    تسليم الطلب
                                </button>
                            </form>
                        </div>
                        @endif
                        @if($item->status == 6)
                        <div class="col-6">
                            <form action="{{url('/public_orders/update-status/'.$item->id.'/7')}}" method="POST">
                                {{ csrf_field() }}
                                <button type="submit" class="btn w-100  btn-full btn-m font-900 text-uppercase rounded-sm shadow-l bg-red2-dark">
                                    تأكيد إلغاء الطلب
                                </button>
                            </form>
                        </div>
                        @endif
                    </div>
                @endif
            </div>
        </div>
        <div id="extension" class="menu menu-box-modal rounded-m"
             data-menu-height="200"
             data-menu-width="310">
            <div class="mr-3 ml-3 mt-3">
                <h3 class="text-uppercase font-900 mb-0">تمديد الطلب</h3>
                <div class="lineBorder"></div>
                <form method="post" action="{{  url('private-order/update-status/'.$item->id.'/extension')}}"
                      enctype="multipart/form-data" class="form-horizontal" role="form">
                    {{ csrf_field() }}
                    <div class="input-style has-icon input-style-1 input-required">
                        <i class="input-icon fa fa-user font-11"></i>
                        <input type="number" name="day" placeholder="المدة" required>
                    </div>

                    <button type="submit"
                            class="btn btn-full btn-m shadow-l rounded-s text-uppercase font-900 bg-green1-dark mt-4">
                        حفظ
                    </button>
                </form>
            </div>
        </div>
        <div id="menu-otp" class="menu menu-box-modal rounded-m"
             data-menu-height="280"
             data-menu-width="310">
            <div class="mr-3 ml-3 mt-3">
                <div class="input-style has-icon input-style-1 input-required">
                    <h1>المبلغ المستحق {{$item->price}} ريال </h1>
                </div>
                <hr>
                <h3 class="text-uppercase font-900 mb-0">ادخل رمز التحقق OTP لستلام الطلب</h3>
                <div class="lineBorder"></div>
                <form method="post" action="{{  url('public_orders/update-status/'.$item->id.'/4')}}"
                      enctype="multipart/form-data" class="form-horizontal" role="form">
                    {{ csrf_field() }}

                    <div class="input-style has-icon input-style-1 input-required">
                        <i class="input-icon fa fa-user font-11"></i>
                        <input type="text" name="code" placeholder="رمز التحقق OTP" required>
                    </div>

                    <button type="submit"
                            class="btn btn-full btn-m shadow-l rounded-s text-uppercase font-900 bg-green1-dark mt-4">تم
                    </button>
                </form>
            </div>
        </div>

        <div id="menu-password" class="menu menu-box-modal rounded-m"
             data-menu-height="280"
             data-menu-width="310">
            <div class="mr-3 ml-3 mt-3">
                <div class="input-style has-icon input-style-1 input-required">
                    <h1>المبلغ المستحق {{$item->price}} ريال </h1>
                </div>
                <hr>
                <h3 class="text-uppercase font-900 mb-0">ادخل كلمة المرور لاستلام الطلب :</h3>
                <div class="lineBorder"></div>
                <form method="post" action="{{ url('public_orders/update-status/'.$item->id.'/4')}}"
                      enctype="multipart/form-data" class="form-horizontal" role="form">
                    {{ csrf_field() }}

                    <div class="input-style has-icon input-style-1 input-required">
                        <i class="input-icon fa fa-user font-11"></i>
                        <input type="password" name="password" placeholder="كلمة المرور" required>
                    </div>

                    <button type="submit"
                            class="btn btn-full btn-m shadow-l rounded-s text-uppercase font-900 bg-green1-dark mt-4">تم
                    </button>
                </form>
            </div>
        </div>


    </div>
    <!-- End of Page Content-->
@endsection
<script>

    function sendSMSOTP() {
        $.ajax({
            url: "{{ route('public_orders.sendSMS',$item->id) }}",
            type: "POST",
            data: {
                _token: "{{csrf_token()}}",
            },

            success: function (response) {
                if (response) {
                    console.log(response);
                }
            }
        });
    }

</script>
