@extends('website.layout')
@section('content')
    <div class="page-content header-clear-medium">
        <div class="card card-style bg-grey-c card-order" data-card-height="130">
            <div class="card-center text-center mr-3">
                <h1 class="color-white mb-0">طلب تعميد</h1>
                <p class="color-white mt-n1 mb-0"></p>
            </div>
        </div>
        @if (Session::get('hyperpay_success') )
            <div class="ml-3 mr-3 alert alert-small rounded-s shadow-xl bg-green1-dark" role="alert">
                <span><i class="fa fa-check"></i></span>
                <strong>{{Session::get('hyperpay_success')}}</strong>
                <button type="button" class="close color-white opacity-60 font-16" data-dismiss="alert" aria-label="Close">&times;</button>
            </div>
        @endif
        @if (Session::get('hyperpay_error') )
            <div class="ml-3 mr-3 alert alert-small rounded-s shadow-xl bg-red2-dark" role="alert">
                <span class="alert-icon"><i class="fa fa-times-circle font-18"></i></span>
                <strong>{{Session::get('hyperpay_error')}} </strong>
                <button type="button" class="close color-white opacity-60 font-16" data-dismiss="alert" aria-label="Close">&times;</button>
            </div>
        @endif
        @if (Session::get('error') )
            <div class="ml-3 mr-3 alert alert-small rounded-s shadow-xl bg-red2-dark" role="alert">
                <span class="alert-icon"><i class="fa fa-times-circle font-18"></i></span>
                <strong>{{Session::get('error')}} </strong>
                <button type="button" class="close color-white opacity-60 font-16" data-dismiss="alert" aria-label="Close">&times;</button>
            </div>
        @endif
        @if ($message = Session::get('success') )
            <div class="ml-3 mr-3 alert alert-small rounded-s shadow-xl bg-green1-dark" role="alert">
                <span><i class="fa fa-check"></i></span>
                <strong>تم طلب التعميد بنجاح !</strong>
                <button type="button" class="close color-white opacity-60 font-16" data-dismiss="alert" aria-label="Close">&times;</button>
            </div>
        @endif
        @guest()
            <div class="alert mr-3 ml-3 rounded-s bg-red2-dark " role="alert">
                <span class="alert-icon"><i class="fa fa-times-circle font-18"></i></span>
                <h4 class="text-uppercase color-white">انت لم تقم بتسجيل الدخول !</h4>
                <strong class="alert-icon-text">يجب عليك تسجيل الدخول اولا ليتم اتمام هذه العملية</strong>
                <button type="button" class="close color-white opacity-60 font-16" data-dismiss="alert" aria-label="Close">&times;</button>
            </div>
        @endguest
        @if($public_count >= $setting->public_order_limit && ($setting->public_order_limit!=0 || $setting->public_order_limit!=null) )
            <div class="alert mr-3 ml-3 rounded-s bg-red2-dark " role="alert">
                <span class="alert-icon"><i class="fa fa-times-circle font-18"></i></span>
                <h4 class="text-uppercase color-white">لا يمكنك اضافة طلب تعميد عام !</h4>
                <strong class="alert-icon-text">لقد تجاوزت العدد المسموح به من الطلبات اليوم</strong>
                <button type="button" class="close color-white opacity-60 font-16" data-dismiss="alert" aria-label="Close">&times;</button>
            </div>
        @endif

        @if($private_count >= $setting->private_order_limit && ($setting->private_order_limit!=0 || $setting->private_order_limit!=null) )
            <div class="alert mr-3 ml-3 rounded-s bg-red2-dark " role="alert">
                <span class="alert-icon"><i class="fa fa-times-circle font-18"></i></span>
                <h4 class="text-uppercase color-white">لا يمكنك اضافة طلب تعميد خاص !</h4>
                <strong class="alert-icon-text">لقد تجاوزت العدد المسموح به من الطلبات اليوم</strong>
                <button type="button" class="close color-white opacity-60 font-16" data-dismiss="alert" aria-label="Close">&times;</button>
            </div>
        @endif

        <div class="card card-style">
            <div class="accordion order-accordion" id="accordion-1">
                <div class="mb-0">
                    <button class="btn accordion-btn" data-toggle="collapse" data-target="#collapse1" aria-expanded="true">
                        <i class="fa color-green-muamlah fa-clipboard"></i>
                        تعليمات الطلب
                        <i class="fa fa-plus font-10 accordion-icon rotate-180"></i>
                    </button>
                    <div id="collapse1" class="collapse" data-parent="#accordion-1" style="">
                        <div class="pt-1 pb-2 pl-3 pr-3">
                            <h5>خدمة التعميد :</h5>
                            <p>تضمن معاملة . كوم بشكل آمن حقوق أصحاب الطلبات و مقدمي الخدمة والشركات بشكل كامل .<br>
                                من خلال هذه الخدمة كن مطمئنا عند تقديم طلب تعميد ، حيث تقوم معاملة . كوم&nbsp; بدور
                                الضامن و الوسيط بين صاحب الطلب
                                وبين مقدمي الخدمة لحماية الحقوق&nbsp; .<br>
                                فقط اختر مقدم الخدمة المناسب ثم اتفقوا على خدمة التعميد لدى منصة معاملة . كوم&nbsp;
                                .<br>

                            <h5>الخطوات :</h5>
                            1 - اتفق مع مقدم الخدمة المناسب على تفاصيل الخدمة .<br>
                            2 - املأ نموذج الطلب مع دفع قيمة الاتفاق والرسوم .<br>
                            3 - إذا كان السداد عن طريق التحويل يرجى الكتابة على إيصال التحويل رقم الطلب واسم صاحب
                            الحساب ورقم الجوال .<br>
                            4 - سنقوم بتأكيد الطلب لمقدم الخدمة لبدء الإنجاز .
                            </p>
                            <a href="/terms"><b>تطبق الشروط والقوانين</b></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>


        <div class="card card-style bg-theme pb-0">
            <div class="content">
                <div class="tab-controls tabs-round tab-animated tabs-medium tabs-rounded shadow-xl" data-tab-items="1" data-tab-active="bg-green-muamlah color-white">
                    <a href="#" data-tab-active data-tab="tab-private">طلب تعميد خاص</a>
                    {{--                    <a href="#" data-tab="tab-public">طلب تعميد عام </a>--}}
                </div>
                <div class="clearfix mb-3"></div>
                <div class="tab-content" id="tab-private">
                    <div class="pt-2">
                        @if($private_orders_status == 'active')
                            <form method="post" action="{{route('privateOrder.store')}}" enctype="multipart/form-data" class="form-horizontal" role="form">
                                {{ csrf_field() }}
                                <div class=" input-style input-style-2 has-icon input-required">
                                    @guest()
                                        <i class="fa input-icon fa-phone"></i>
                                        <span class="color-highlight input-style-1-inactive">اكتب رقم الجوال الخاص بك</span>
                                        <em>(مطلوب)</em>
                                        <input class="form-control" type="text" name="user_phone" placeholder="">
                                    @else
                                        <i class="fa input-icon fa-phone"></i>
                                        <em>(مطلوب)</em>
                                        <input class="form-control" type="tel" readonly value="{{auth()->user()->phone}}" name="user_phone" placeholder="{{auth()->user()->phone}}">
                                    @endguest
                                </div>
                                @php
                                    if(request()->has('provider_phone')){
                                        $phone = request()->provider_phone;
                                    }else if(!is_null($agent = auth()->user()->Agent)){
                                       $phone = $agent->phone;
                                    }else{
                                       $phone = '';
                                    }
                                @endphp
                                <div class="input-style input-style-2  has-icon input-required">
                                    <i class="fa input-icon fa-phone"></i>
                                    <span class="color-highlight {{$phone != '' ? 'input-style-1-active focus-act' : '' }}">اكتب رقم الجوال مقدم الخدمة</span>
                                    <em>(مطلوب)</em>
                                    <input class="form-control service-provider-phone" autocomplete="off" type="tel" pattern="(05)([0-9]{8})" title="يجب ان يكون رقم هاتف سعودي"
                                           placeholder="رقم الموبايل" name="service_provider_phone" value="{{$phone}}">
                                    <div class="color-white mt-n1 mb-0 service-provider-validator" style="display:none;color: red !important;">

                                    </div>
                                </div>

                                <div class="row mb-1">
                                    <div class="col-12">
                                        <div class="input-style input-style-2 has-icon input-required">
                                            <i class="fa input-icon fa-calendar-plus"></i>
                                            <span class="color-highlightgi">تاريخ إنتهاء التعميد</span>
                                            <input id="basicFlatpickr" class="form-control flatpickr text-right color-trn flatpickr-input max-date" type="text" name="date" required readonly="readonly">
                                        </div>
                                    </div>
                                    {{-- <div class="col-6">
                                        <div class="input-style input-style-2 has-icon input-required">
                                            <i class="fa input-icon fa-calendar-plus"></i>
                                            <span class="color-highlight">وقت الإنتهاء</span>
                                            <input id="timeFlatpickr" class="form-control flatpickr text-right color-trn flatpickr-input" type="text" name="time" required readonly="readonly">
                                        </div>
                                    </div> --}}
                                </div>

                                <div class="input-style input-style-2 has-icon input-required">
                                    <i class="fa input-icon fa-money-bill-wave"></i>
                                    <span class="color-highlight">اكتب قيمة التعميد</span>
                                    <em>(مطلوب)</em>
                                    <input class="form-control order-price" type="number" oninput="checkPrice(this)" required name="price" placeholder="">
                                </div>
                                <div id="check_price"></div>
                                <div style="color: red ; margin-bottom: 10px" id="forbiddenWord2"></div>

                                <div class="input-style input-style-2 has-icon input-required">
                                    <i class="fa input-icon fa-info"></i>
                                    <span>اكتب تفاصيل الإتفاق</span>
                                    <em>(مطلوب)</em>
                                    <textarea class="textarea-height requiredField" required name="details" id="searchWord2" cols="30" rows="10"></textarea>
                                </div>
                                <div class="input-style input-style-2 has-icon input-required">
                                    <i class="fa input-icon fa-gift"></i>
                                    <span>كود الخصم </span>
                                    <input type="text" class="form-control" name="coupon_code">
                                </div>
                                {{-- <div class="input-style input-style-2 has-icon input-required">
                                     <i class="fa input-icon fa-gift"></i>
                                     <span>الكود المرجعي إن وجد</span>
                                     <input type="text" class="form-control" name="reference_code" onclick="selectInput('reference_code', 'coupon_code')">
                                 </div> --}}
                                <div>
                                    <input id="checkbox-1" type="checkbox" value="0" required>
                                    <label for="checkbox-1"><a href="http://muamlah.com/terms" target="_blank">قرأت
                                            وأوافق على شروط الخدمة</a></label>
                                </div>
                                <div>
                                    <label><b>فتح الطلب واتساب</b> </label>
                                </div>
                                <div>
                                    <input id="checkbox-1" name="whatsapp" type="checkbox" value="11">
                                    <label for="checkbox-1" style="color: red">تنبه: سيتم الغاء جميع ازرار التحكم في الطلب و التواصل سيكون عبر الواتساب فقط</label>
                                </div>
                                @if(!is_null($agent = auth()->user()->agent))
                                    <div>
                                        <input id="checkbox-2" type="checkbox" value="1" name="agent">
                                        <label for="checkbox-2">تنفيذ الطلب عن طريق الوكيل <b>{{$agent->getName()}}</b></label>
                                    </div>
                                @endif
                                @if($private_count >= $setting->private_order_limit && ($setting->private_order_limit!=0 || $setting->private_order_limit!=null))
                                    <button class="btn btn-m w-100 btn-full rounded-l bg-green-c mr-auto ml-auto font-900 text mt-4" disabled>
                                        أرسل الطلب
                                    </button>
                                @else
                                    <button type="submit" class="btn btn-m w-100 btn-full rounded-l bg-green-c mr-auto ml-auto font-900 text mt-4 send-order">
                                        أرسل الطلب
                                    </button>
                                @endif
                            </form>
                        @else
                            @include('website.includes.alert')

                        @endif
                    </div>
                </div>
                {{--                <div class="tab-content" id="tab-public">--}}
                {{--                    <div class="pt-2">--}}
                {{--                        @if($public_orders_status == 'active')--}}
                {{--                        <form method="post" action="{{route('publicOrders.store')}}" enctype="multipart/form-data" class="form-horizontal" role="form">--}}
                {{--                            {{ csrf_field() }}--}}

                {{--                            <div class="input-style input-style-2 has-icon input-required">--}}
                {{--                                <i class="fa input-icon fa-heading"></i>--}}
                {{--                                <span class="color-highlight">عنوان الطلب</span>--}}
                {{--                                <em>(مطلوب)</em>--}}
                {{--                                <input class="form-control" type="text" name="title" value="{{old('title')}}" required>--}}
                {{--                            </div>--}}

                {{--                            <div style="color: red ; margin-bottom: 10px" id="forbiddenWord"></div>--}}

                {{--                            <div class="input-style input-style-2 has-icon input-required">--}}
                {{--                                <i class="fa input-icon fa-info"></i>--}}
                {{--                                <span>تفاصيل الطلب</span>--}}
                {{--                                <textarea class="textarea-height requiredField" name="details" id="searchWord" cols="30" rows="10">{{old('details')}}</textarea>--}}
                {{--                            </div>--}}
                {{--                            @if(!is_null($agent = auth()->user()->agent))--}}
                {{--                            <div>--}}
                {{--                                <input id="checkbox-3" type="checkbox" value="1" name="agent">--}}
                {{--                                <label for="checkbox-3">تنفيذ الطلب عن طريق الوكيل <b>{{$agent->getName()}}</b></label>--}}
                {{--                            </div>--}}
                {{--                            @endif--}}
                {{--                            @if($public_count >= $setting->public_order_limit && ($setting->public_order_limit!=0 || $setting->public_order_limit!=null))--}}

                {{--                            <button  class="btn btn-m w-100 btn-full rounded-l bg-green-c mr-auto ml-auto font-900 text mt-4" disabled>--}}
                {{--                                إضافة طلب--}}
                {{--                            </button>--}}
                {{--                            @else--}}

                {{--                                <button type="submit" class="btn btn-m w-100 btn-full rounded-l bg-green-c mr-auto ml-auto font-900 text mt-4">--}}
                {{--                                    إضافة طلب--}}
                {{--                                </button>--}}
                {{--                            @endif--}}
                {{--                        </form>--}}
                {{--                        @else--}}
                {{--                        @include('website.includes.alert')--}}

                {{--                        @endif--}}
                {{--                    </div>--}}
                {{--                    <!-- End of Page Content-->--}}
                {{--                </div>--}}
                <!-- End of Page Content-->
            </div>
        </div>
    </div>
@endsection
@section('script')
    <script>
        function selectInput(enable, disable) {
            $('input[name=' + enable + ']').prop('readonly', false);
            $('input[name=' + disable + ']').prop('readonly', true);
        }

        $(".order-price").on('change', function (e) {
            let order_price = $(this).val();
            if (order_price < 0) {
                $(this).val(0);
            }
        });

        // check service provider phone
        $(".service-provider-phone").on('change', function (e) {

            var service_provider_phone = $(this).val();

            $.ajax({
                url: "{{route('privateOrder.check-service-provider-phone')}}",
                data: {
                    service_provider_phone: service_provider_phone,
                    _token: '{{csrf_token()}}'
                },
                type: "post",
                success: function (data) {
                    $('.send-order').attr('disabled', false);
                    $('.service-provider-validator').html('');
                    $('.service-provider-validator').fadeOut();
                },
                error: function (reject) {
                    if (reject.status === 401) {
                        $(".errors-text").append("لا تملك الصلاحية للقيام بهذه العملية");
                        $('.alert-box').show();
                    }
                    if (reject.status === 402) {
                        $('.send-order').attr('disabled', true);
                        $('.service-provider-validator').html(reject.responseJSON.message);
                        $('.service-provider-validator').fadeIn();
                    }
                    if (reject.status === 403) {
                        $('.send-order').attr('disabled', true);
                        $('.service-provider-validator').html(reject.responseJSON.message);
                        $('.service-provider-validator').fadeIn();
                    }
                    if (reject.status === 404) {
                        $('.send-order').attr('disabled', true);
                        $('.service-provider-validator').html(reject.responseJSON.message);
                        $('.service-provider-validator').fadeIn();
                    }
                }
            });

        });

    </script>
    <script>
        function checkDate(_this) {
            const duration = document.getElementById("duration").value;
            $.ajax({
                url: "{{ route('privateOrder.checkDate') }}",
                type: "GET",
                data: {
                    _token: "{{csrf_token()}}",
                    duration: duration,
                },

                success: function (response) {
                    if (response) {
                        console.log(response);
                        document.getElementById("end_date").value = response;
                    }
                }
            });

        }
    </script>
    {{--        فحص الكلمات الممنوعة في تفاصيل الطلب العام --}}
    <script>
        $(document).ready(function () {
            $("#searchWord").keyup(function () {
                var keyword = $("#searchWord").val();

                var csrf_token = '{{csrf_token()}}';

                // console.log(keyword);
                $.ajax({
                    type: "post",
                    url: "{{ route('search-forbidden') }}",
                    data: {
                        "keyword": keyword,
                        "_token": csrf_token,
                    },
                    success: function (response) {
                        if (response.success) {
                            let htmlDiv = "";
                            $.each(response.success, function (index, item) {
                                if (item != null) {
                                    htmlDiv += item.name + ' ' + ':' + 'هذه الكلمة ممنوعة بسبب' + ' ' + item.description + '<br>';
                                }
                            });

                            $('#forbiddenWord').html(htmlDiv);

                        }

                        // console.log(response.success);
                    }
                });
            });
        });
    </script>
    {{--        فحص الكلمات الممنوعة في تفاصيل الطلب الخاص  --}}
    <script>
        $(document).ready(function () {
            $("#searchWord2").keyup(function () {
                var keyword = $("#searchWord2").val();

                var csrf_token = '{{csrf_token()}}';

                console.log(keyword);
                $.ajax({
                    type: "post",
                    url: "{{ route('search-forbidden') }}",
                    data: {
                        "keyword": keyword,
                        "_token": csrf_token,
                    },
                    success: function (response) {
                        if (response.success) {
                            let htmlDiv = "";
                            $.each(response.success, function (index, item) {
                                if (item != null) {
                                    htmlDiv += item.name + ' ' + ':' + 'هذه الكلمة ممنوعة بسبب' + ' ' + item.description + '<br>';
                                }
                            });

                            $('#forbiddenWord2').html(htmlDiv);

                        }

                        console.log(response.success);
                    }
                });
            });
        });
    </script>
    {{--    فحص الحد الاعلى لسعر الطلب --}}
    <script>
        function checkPrice(_this) {
            var settingPrice = {{$setting->order_price_limit}};
            // if(_this.value) {
            var price = _this.value;

            if (price >= settingPrice && (settingPrice != 0 || settingPrice != null)) {
                $("#check_price").html(`<small style="color: red">قيمة التعميد اعلى من الحد المسموح به</small>`);
                $("#check_price").show('slow')
            } else {
                $("#check_price").hide('slow')
            }
            // }
        }
    </script>
@endsection
