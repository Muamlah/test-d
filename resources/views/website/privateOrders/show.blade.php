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
        @if ( Session::get('success') )
            <div class="ml-3 mr-3 alert alert-small rounded-s shadow-xl bg-green1-dark" role="alert">
                <span><i class="fa fa-check"></i></span>
                <strong>{{Session::get('success')}}</strong>
                <button type="button" class="close color-white opacity-60 font-16" data-dismiss="alert" aria-label="Close">&times;</button>
            </div>
        @endif
        {!!@$item->getHtmlStatusAlert()!!}
        <div class="card card-overflow card-style">
            <div class="content">
                <div class="d-flex">
                    <div class="flex-grow-1">
                        <h1 class="font-30 mb-3"> طلب تعميد رقم{{$item->id}}</h1>
                    </div>
                    <div class="flex-shrink-1">
                        <h4 class="font-20"> {{@$item->price}} ريال</h4>
                    </div>
                </div>

                <div class="divider"></div>
                <div class="row">
                    <div class="col-6">
                        <h4>تفاصيل الطلب :</h4>
                    </div>
                    <div class="col-6 p-0">
                         @if( @$item->status_id != 11)
                         <form action="{{url('my-orders/update-status/'.$item->id.'/11')}}" method="POST">
                               {{ csrf_field() }}
                               <button type="submit" class="bg-green2-dark rounded-xs font-14 text-uppercase pr-2 pl-2 pb-1 pt-1 line-height-s">
                                   فتح الطلب واتس اب
                               </button>
                           </form>
                           <p style="color: red">تنبه: سيتم الغاء جميع ازرار التحكم في الطلب و التواصل سيكون عبر الواتساب فقط</p>
                        @endif
                    </div>
                </div>
                <p>{{@$item->details}}</p>

                <div class="row">
                    <div class="col-6 mb-4">
                        <strong class="color-theme"><span class="font-14">حالة الطلب</span></strong>
                        <p>
                            {!! @$item->getHtmlStatus() !!}
                        </p>
                    </div>

                    <div class="col-6 mb-4">
                        <strong class="color-theme"><span class="font-14"> @if($item->provider->name !='')إسم مقدم
                                الخدمة @else    رقم مقدم الخدمة   @endif</span></strong>
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
                            {{@$item->value_added_tax}} ريال
                        </p>
                    </div>
                    <div class="col-6 mb-4">
                        <strong class="color-theme"><span class="font-14">اجمالي المبلغ</span></strong>
                        <p class="font-12"> {{$item->value_added_tax + $item->fees +  $item->price}} ريال </p>
                    </div>
                    <div class="col-6 mb-4">
                        <strong class="color-theme"><span class="font-14">تاريخ نهاية التعميد</span></strong>
                        <p class="font-12">
                            {{@ \Carbon\Carbon::parse($item->deadline)->format('Y-d-m') }}
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
                    {{--                             {{@$item->payment_gateway_fee}}ريال--}}
                    {{--                        </p>--}}
                    {{--                    </div>--}}
                    {{--                    <div class="col-6 mb-4">--}}
                    {{--                        <strong class="color-theme"><span class="font-14">رسوم الاسترجاع</span></strong>--}}
                    {{--                        <p class="font-12">--}}
                    {{--                             {{@$item->client_cancellation}}ريال--}}
                    {{--                        </p>--}}
                    {{--                    </div>--}}
                </div>
                <div class="divider mt-4"></div>
                @include('website.chat.include_chat', ['message' => $chat_message])

{{--                {{$item->master_order}}--}}
{{--                @if( @$item->id ==  @$item->master_order )--}}
                    <div class="row mb-0">
{{--                        <div class="col">--}}
{{--                            <form action="{{url('my-orders/update-status/'.$item->id.'/11')}}" method="POST">--}}
{{--                                {{ csrf_field() }}--}}
{{--                                <button type="submit" class="btn btn-full btn-m font-900 text-uppercase rounded-l shadow-l bg-green-c w-100">--}}
{{--                                    تنفيذ واتس اب--}}
{{--                                </button>--}}
{{--                            </form>--}}
{{--                        </div>--}}
                        {{-- @if( @$item->status == 'completed') --}}
                        @if( @$item->status_id != 11)
                        @if( @$item->status_id == 4)
                            <div class="col">
                                @if(settings()->active_order == 'sms')
                                    <a href="#" data-menu="menu-otp" onclick="sendSMSOTP()"
                                       class="btn btn-full btn-m font-900 text-uppercase rounded-l shadow-l bg-green-c">استلام
                                        الطلب</a>
                                @else
                                    <a href="#" data-menu="menu-password"
                                       class="btn btn-full btn-m font-900 text-uppercase rounded-l shadow-l bg-green-c">استلام
                                        الطلب</a>
                                @endif
                            </div>
                        @endif
                        @if(@$item->status_id == 1 || @$item->status_id == 3 || @$item->status_id == 2 )
                            <div class="col">
                                <a data-menu="menu-cancel"
                                class="btn w-100 btn-full btn-m font-900 text-uppercase rounded-l shadow-l bg-red2-dark">
                                الغاء الطلب
                                </a>
                            </div>
                            @if(@$item->parent_order == 0)
                                <div class="col">
                                    <a href="{{route('privateOrder.edit',$item->id)}}"
                                       class="btn btn-full btn-m font-900 text-uppercase rounded-l shadow-l bg-yellow-c">
                                        تعديل الطلب</a>
                                </div>
                            @endif
                        @endif
                        @if(@$item->status_id == 6 && Carbon\Carbon::now() > $item->deadline)
                            <div class="col">
                                <a data-menu="menu-cancel"
                                class="btn w-100 btn-full btn-m font-900 text-uppercase rounded-l shadow-l bg-red2-dark">
                                الغاء الطلب
                                </a>
                            </div>
                        @endif
                        @if($item->status_id != "8")
                        <div class="col">
                            <a data-menu="menu-message"
                            class="btn w-100 btn-full btn-m font-900 text-uppercase rounded-l shadow-l bg-red2-dark">
                                إبلاغ
                            </a>
                        </div>
                        @endif
                        @endif
                    </div>
{{--                @endif--}}
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
                <form method="post" action="{{url('my-orders/update-status/'.$item->id.'/6')}}"
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
        <div id="menu-otp" class="menu menu-box-modal rounded-m"
             data-menu-height="280"
             data-menu-width="310">
            <div class="mr-3 ml-3 mt-3">
                <div class="input-style has-icon input-style-1 input-required">
                    <h1>المبلغ المستحق {{$item->payable_service_provider}} ريال </h1>
                </div>
                <hr>
                <h3 class="text-uppercase font-900 mb-0">ادخل رمز التحقق OTP لستلام الطلب</h3>
                <div class="lineBorder"></div>
                <form method="post" action="{{  url('my-orders/update-status/'.$item->id.'/4')}}"
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
                <h3 class="text-uppercase font-900 mb-0">ادخل كلمة المرور حسابك لتأكيد استلام الطلب :</h3>
                <div class="lineBorder"></div>
                <form method="post" action="{{url('my-orders/update-status/'.$item->id.'/4')}}"
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
                <form method="post" action="{{url('my-orders/update-status/'.$item->id.'/8')}}"
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
    <!-- End of Page Content-->
@endsection
@section('script')
    <script>

        function sendSMSOTP() {
            $.ajax({
                url: "{{ route('privateOrder.sendSMS',$item->id) }}",
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

        function sendEmail() {
            $.ajax({
                url: "{{ route('privateOrder.sendEmail',$item->id) }}",
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
@endsection

