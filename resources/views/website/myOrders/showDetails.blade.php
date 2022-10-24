@extends('website.layout')

@section('content')
    <!-- Page Content-->

    <div class="page-content header-clear-medium">

        @if (Session::get('error') )
            <div class="alert mr-3 ml-3 rounded-s bg-red2-dark " role="alert">
                <span class="alert-icon"><i class="fa fa-times-circle font-18"></i></span>
                <h4 class="text-uppercase color-white">{{Session::get('error')}} !</h4>
                <button type="button" class="close color-white opacity-60 font-16" data-dismiss="alert"
                        aria-label="Close">&times;
                </button>
            </div>
        @endif
        @if (Session::get('success') )
            <div class="ml-3 mr-3 alert alert-small rounded-s shadow-xl bg-green1-dark" role="alert">
                <span><i class="fa fa-check"></i></span>
                <strong>{{Session::get('success')}}</strong>
                <button type="button" class="close color-white opacity-60 font-16" data-dismiss="alert" aria-label="Close">&times;</button>
            </div>
        @endif
            @if(@$item->status == 6)
                <div class="alert mr-3 ml-3 rounded-s bg-red2-dark " role="alert">
                    <span class="alert-icon"><i class="fa fa-times-circle font-18"></i></span>
                    <h4 class="text-uppercase color-white">بانتظار تأكيد مقدم الخدمة لالغاء الطلب !</h4>
                    {{--                <strong class="alert-icon-text"></strong>--}}
                    <button type="button" class="close color-white opacity-60 font-16" data-dismiss="alert" aria-label="Close">&times;</button>
                </div>
            @endif

            @if(@$item->status == 5)
                <div class="ml-3 mr-3 alert alert-small rounded-s shadow-xl bg-green1-dark" role="alert">
                    <span><i class="fa fa-check"></i></span>
                    <strong>تم تأكيد استلام الطلب !</strong>
                    <button type="button" class="close color-white opacity-60 font-16" data-dismiss="alert" aria-label="Close">&times;</button>
                </div>
            @endif
            @if(@$item->status == 4)
                <div class="ml-3 mr-3 alert alert-small rounded-s shadow-xl bg-green1-dark" role="alert">
                    <span><i class="fa fa-check"></i></span>
                    <h4 class="text-uppercase color-white">بانتظار تأكيد العميل لاستلام الخدمة !</h4>
                    {{--                <strong class="alert-icon-text"></strong>--}}
                    <button type="button" class="close color-white opacity-60 font-16" data-dismiss="alert" aria-label="Close">&times;</button>
                </div>
            @endif
            @if(@$item->status == 8)
                <div class="ml-3 mr-3 alert alert-small rounded-s shadow-xl bg-red2-dark" role="alert">
                    <span><i class="fa fa-check"></i></span>
                    <h4 class="text-uppercase color-white">تم فتح نزاع من قبل مقدم الخدمة</h4>
                    {{--                <strong class="alert-icon-text"></strong>--}}
                    <button type="button" class="close color-white opacity-60 font-16" data-dismiss="alert" aria-label="Close">&times;</button>
                </div>
            @endif
        <div class="card card-overflow card-style">
            <div class="content">
                <div class="d-flex">
                    <div class="flex-grow-1">
                        <h1 class="font-30 mb-3"> {{@$item->title}}</h1>
                    </div>
                    <div class="flex-shrink-1">
                        <h4 class="font-20"> {{@$item->price}} ريال </h4>
                    </div>
                </div>

                <div class="divider"></div>
                @if(!in_array($item->status,[1,2]))
                <div class="row">
                    <div class="col-6">
                        <h4>تفاصيل الطلب :</h4>
                    </div>
                    <div class="col-6 p-0">
                        {{-- <a href="{{route('publicOrders.open_chat',@$item->id)}}">
                            <strong  class="bg-green2-dark rounded-xs font-14 text-uppercase pr-2 pl-2 pb-1 pt-1 line-height-s"><i class="fas ml-2 fa-comments"></i>فتح
                                المحادثة</strong>
                        </a> --}}
                        <a href="#messages-card">
                            <strong  class="bg-green2-dark rounded-xs font-14 text-uppercase pr-2 pl-2 pb-1 pt-1 line-height-s"><i class="fas ml-2 fa-comments"></i>
                                المحادثة</strong>
                        </a>
                    </div>
                </div>
                @endif
                <p>{{@$item->details}}</p>

                <div class="row">
                    <div class="col-6 mb-4">
                        <strong class="color-theme"><span class="font-14">حالة الطلب</span></strong>
                        <p>
                            {!! $item->getHtmlStatus() !!}
                        </p>
                    </div>

                    <div class="col-6 mb-4">
                        <strong class="color-theme"><span class="font-14">
                                @if($item->provider->name !='')
                                    اسم مقدم الخدمة
                                @else
                                    رقم مقدم الخدمة
                                @endif
                            </span></strong>
                        <p class="font-12">
                            @if($item->provider->name !=null) {{$item->provider->name}}  @else    {{$item->provider->phone}}  @endif
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
                            {{@$item->value_added_tax }}  ريال
                        </p>
                    </div>
                    @if ($item->agent_per!=0)
                        <div class="col-6 mb-4">
                            <strong class="color-theme"><span class="font-14">رسوم الوكيل</span></strong>
                            <p class="font-12">
                                {{ number_format( @$item->agent_per,2) }}  ريال
                            </p>
                        </div>
                    @endif

                    <div class="col-6 mb-4">
                        <strong class="color-theme"><span class="font-14">اجمالي المبلغ</span></strong>
                        <p class="font-12">
                            {{@$item->total_amount}} ريال
                        </p>
                    </div>
                    <div class="col-6 mb-4">
                        <strong class="color-theme"><span class="font-14">تاريخ نهاية التعميد</span></strong>
                        <p class="font-12">
                            {{  @$item->deadline}}
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
{{--                    <div class="col-6 mb-4">--}}
{{--                        <strong class="color-theme"><span class="font-14">رسوم بوابة الدفع</span></strong>--}}
{{--                        <p class="font-12">--}}
{{--                            ريال {{@$item->payment_gateway_fee}}--}}
{{--                        </p>--}}
{{--                    </div>--}}
{{--                    <div class="col-6 mb-4">--}}
{{--                        <strong class="color-theme"><span class="font-14">رسوم الاسترجاع</span></strong>--}}
{{--                        <p class="font-12">--}}
{{--                            ريال {{@$item->public_order_cancellation}}--}}
{{--                        </p>--}}
{{--                    </div>--}}
                </div>
                <div class="divider mt-4"></div>
                @include('website.chat.include_chat', ['message' => $chat_message])
                
                @if( @$item->status != 8 && @$item->status != 9)
                    <div class="row mb-0">
                        @if( @$item->status == 4)
                            <div class="col">
                                @if(settings()->active_order == 'sms')
                                    <a href="#" data-menu="menu-otp" onclick="sendSMSOTP()"
                                    class="btn btn-full btn-m font-900 text-uppercase rounded-sm shadow-l bg-green-c">استلام
                                        الطلب</a>
                                @else
                                    <a href="#" data-menu="menu-password"
                                    class="btn btn-full btn-m font-900 text-uppercase rounded-sm shadow-l bg-green-c">استلام
                                        الطلب</a>
                                @endif
                            </div>
                            <div class="col">
                                <a data-menu="menu-cancel"
                                class="btn w-100 btn-full btn-m font-900 text-uppercase rounded-sm shadow-l bg-red2-dark">
                                الغاء الطلب
                                </a>
                            </div>
                        @endif
                        @if(@$item->status == 1 || @$item->status == 2 || @$item->status == 3 )
                        <div class="col">
                            <a data-menu="menu-cancel"
                            class="btn w-100 btn-full btn-m font-900 text-uppercase rounded-sm shadow-l bg-red2-dark">
                            الغاء الطلب
                            </a>
                        </div>
                        @endif
                        @if(@$item->status == 6 && Carbon\Carbon::now() > $item->deadline)
                        <div class="col">
                            <a data-menu="menu-cancel"
                            class="btn w-100 btn-full btn-m font-900 text-uppercase rounded-sm shadow-l bg-red2-dark">
                            الغاء الطلب
                            </a>
                        </div>
                        @endif

                        <div class="col">
                            <a data-menu="menu-message"
                                    class="btn w-100 btn-full btn-m font-900 text-uppercase rounded-sm shadow-l bg-red2-dark">
                                إبلاغ
                            </a>
                        </div>
                    </div>
                @endif
            </div>
        </div>
        <div id="menu-cancel" class="menu menu-box-modal rounded-m"
            data-menu-height="280"
            data-menu-width="310">
            <div class="mr-3 ml-3 mt-3">
                <div class="input-style has-icon input-style-1 input-required">
                    <h1> من فضلك ادخل سبب الإلغاء</h1>
                </div>
                <hr>
                <h3 class="text-uppercase font-900 mb-0">سيتم إيقاف الطلب</h3>
                <br/>
                <div class="lineBorder"></div>
                <form method="post" action="{{url('my-orders/public_orders/update-status/'.$item->id.'/6')}}"
                        enctype="multipart/form-data" class="form-horizontal" role="form">
                    {{ csrf_field() }}

                    <div class="input-style has-icon input-style-1 input-required">
                        <textarea name="cancel_reason" placeholder="سبب الإلغاء" required></textarea>
                    </div>

                    <button type="submit"
                            class="btn btn-full btn-m shadow-l rounded-s text-uppercase font-900 bg-green1-dark mt-4">إرسال
                    </button>
                </form>
            </div>
        </div>
        <div id="extension" class="menu menu-box-modal rounded-m"
             data-menu-height="200"
             data-menu-width="310">
            <div class="mr-3 ml-3 mt-3">
                <h3 class="text-uppercase font-900 mb-0">تمديد الطلب</h3>
                <div class="lineBorder"></div>
                <form method="post" action="{{  url('my-orders/public_orders/update-status/'.$item->id.'/extension')}}"
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
                    <h1>المبلغ المستحق {{$item->deserved_price}} ريال </h1>
                </div>
                <hr>
                <h3 class="text-uppercase font-900 mb-0">ادخل رمز التحقق OTP لاستلام الطلب</h3>
                <div class="lineBorder"></div>
                <form method="post" action="{{  url('my-orders/public_orders/update-status/'.$item->id.'/4')}}"
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
                    <h1>المبلغ المستحق {{$item->payable_service_provider}} ريال </h1>
                </div>
                <hr>
                <h3 class="text-uppercase font-900 mb-0">ادخل كلمة المرور لاستلام الطلب :</h3>
                <div class="lineBorder"></div>
                <form method="post" action="{{url('my-orders/public_orders/update-status/'.$item->id.'/4')}}"
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

        <div id="menu-message" class="menu menu-box-modal rounded-m"
             data-menu-height="280"
             data-menu-width="310">
            <div class="mr-3 ml-3 mt-3">
                <div class="input-style has-icon input-style-1 input-required">
                    <h1> من فضلك ادخل سبب الإبلاغ</h1>
                </div>
                <hr>
                <h3 class="text-uppercase font-900 mb-0">سيتم إيقاف الطلب مؤقتاً</h3>
                <br/>
                <div class="lineBorder"></div>
                <form method="post" action="{{url('my-orders/public_orders/update-status/'.$item->id.'/8')}}"
                      enctype="multipart/form-data" class="form-horizontal" role="form">
                    {{ csrf_field() }}

                    <div class="input-style has-icon input-style-1 input-required">
                        <textarea name="message" placeholder="سبب الإبلاغ" required></textarea>
                    </div>

                    <button type="submit"
                            class="btn btn-full btn-m shadow-l rounded-s text-uppercase font-900 bg-green1-dark mt-4">إرسال
                    </button>
                </form>
            </div>
        </div>

    </div>
    <script>
        function sendSMSOTP() {
            $.ajax({
                url: "{{ route('publicOrders.sendSMS',$item->id) }}",
                type: "POST",
                data: {
                    _token: "{{csrf_token()}}",
                },

                success: function (response) {
                    console.log(response.message);
                    if (response.error == 0) {
                        console.log('done');
                        console.log(response.message);
                    }
                    if (response.status == 500){
                        alert(response.message)
                    }else if(response.status == 404){
                        alert(response.message)
                    }
                    else if(response.status == 429){
                        console.log('429');
                        alert(response.message)

                    }
                }

            });
        }

        function sendEmail() {
            $.ajax({
                url: "{{ route('publicOrders.sendEmail',$item->id) }}",
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
    <!-- End of Page Content-->
@endsection

