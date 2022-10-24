@extends('website.layout')

@section('content')
    <div class="page-content header-clear-medium">
        <div class="card card-style bg-grey-c card-order" data-card-height="130">
            <div class="card-center text-center mr-3">
                <h1 class="color-white mb-0">طلب تعميد تابع</h1>
                <p class="color-white mt-n1 mb-0"></p>
            </div>
        </div>
        @if (Session::get('success') )
            <div class="ml-3 mr-3 alert alert-small rounded-s shadow-xl bg-green1-dark" role="alert">
                <span><i class="fa fa-check"></i></span>
                <strong>{{Session::get('success')}}</strong>
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
        <div class="card card-style">
            <div class="accordion order-accordion" id="accordion-1">
                <div class="mb-0">
                    <button class="btn accordion-btn" data-toggle="collapse" data-target="#collapse1"
                            aria-expanded="true">
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
                            <p>
                                عند طلب تابع
                                يمكن لمقدم الخدمة إلغاء الطلب
                                و يمكنه تسليم الخدمة بدون الرجوع إليك
                                و ستبقى مستحقاتك محفوظة في رصيدك في حال تم الان</p>
                            <a href="/terms"><b>تطبق الشروط والقوانين</b></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>





        <div class="card card-style bg-theme pb-0">
            <div class="content">
                <div class="tab-controls tabs-round tab-animated tabs-medium tabs-rounded shadow-xl" data-tab-items="1"
                     data-tab-active="bg-green-muamlah color-white" style="width:100% !important;">
                    <a href="#" data-tab-active data-tab="tab-private" class="col-md-12">طلب تعميد تابع</a>

                </div>
                <div class="clearfix mb-3"></div>
                <div class="tab-content" id="tab-private">
                    <div class="pt-2">
                        <form method="post" action="{{route('followingOrder.storeWithoutLogin')}}"
                              enctype="multipart/form-data" class="form-horizontal" role="form">
                            @csrf
                            <div class="input-style input-style-2  has-icon input-required">
                                <i class="fa input-icon fa-phone"></i>
                                <span class="color-highlight">رقم التعميد</span>
                                <em>(مطلوب)</em>
                                <input class="form-control "  type="number"
                                        placeholder="رقم التعميد "  autocomplete="off"  name="order_number"
                                       required="required">

                                </div>
                            <div class="input-style input-style-2  has-icon input-required">
                                <i class="fa input-icon fa-phone"></i>
                                <span class="color-highlight">اكتب رقم الجوالك</span>
                                <em>(مطلوب)</em>
                                <input class="form-control  user-phone"  type="tel" title="يجب ان يكون رقم هاتف سعودي"
                                       pattern="(05)([0-9]{8})"  placeholder="رقم الموبايل"  autocomplete="off"  name="user_phone"
                                       required="required">
                            </div>
                            <div class="input-style input-style-2  has-icon input-required">
                                <i class="fa input-icon fa-phone"></i>
                                <span class="color-highlight">اكتب رقم الجوال مقدم الخدمة</span>
                                <em>(مطلوب)</em>
                                <input class="form-control "  type="tel" title="يجب ان يكون رقم هاتف سعودي"
                                       pattern="(05)([0-9]{8})"  placeholder="رقم الموبايل"  autocomplete="off"  name="service_provider_phone"
                                       required="required">
                                </div>
                            </div>
                            <div class="row mb-1">
                                <div class="col-12">
                                    <div class="input-style input-style-2 has-icon input-required">
                                        <i class="fa input-icon fa-calendar-plus"></i>
                                        <span class="color-highlightgi">تاريخ إنتهاء التعميد</span>
                                        <input id="basicFlatpickr" class="form-control flatpickr text-right color-trn flatpickr-input max-date"  type="text" name="date" required readonly="readonly">
                                    </div>
                                </div>
                            </div>
                            <div class="input-style input-style-2 has-icon input-required">
                                <i class="fa input-icon fa-money-bill-wave"></i>
                                <span class="color-highlight input-style-1-active input-style-1-inactive">اكتب قيمة التعميد</span>
                                <em>(مطلوب)</em>
                                <input class="form-control" type="number"  autocomplete="off" value="" required name="price" placeholder="">
                            </div>
                            <div class="input-style input-style-2 has-icon input-required">
                                <i class="fa input-icon fa-info"></i>
                                <span  class="color-highlight input-style-1-active input-style-1-inactive">اكتب تفاصيل الإتفاق</span>
                                <em>(مطلوب)</em>
                                <textarea class="textarea-height requiredField" required name="details" id="" cols="30"
                                          rows="10"></textarea>
                            </div>
                            <div >
                                <input id="checkbox-1" required type="checkbox" value="0">
                                <label for="checkbox-1"><a href="http://muamlah.com/terms" target="_blank">قرأت
                                        وأوافق على شروط الخدمة</a></label>
                            </div>
                            <button type="submit"
                                    class="btn btn-m w-100 btn-full rounded-l bg-green-c mr-auto ml-auto font-900 text mt-4 send-order">
                                أرسل الطلب
                            </button>
                        </form>
                    </div>
                </div>

                <!-- End of Page Content-->

            </div>
            @endsection
{{--            @section('script')--}}
{{--                <script type="text/javascript">--}}
{{--                    var f1 = flatpickr(document.getElementById('basicFlatpickr'), {--}}
{{--                        defaultDate: '{{ \Carbon\Carbon::parse($order->deadline)->format('Y-m-d') }}',--}}
{{--                        disableMobile: "true",--}}
{{--                        minDate: '{{ \Carbon\Carbon::parse($order->deadline)->format('Y-m-d') }}'--}}
{{--                    });--}}
{{--                    --}}{{--var f2 = flatpickr(document.getElementById('timeFlatpickr'), {--}}
{{--                    --}}{{--    enableTime: true,--}}
{{--                    --}}{{--    noCalendar: true,--}}
{{--                    --}}{{--    dateFormat: "H:i",--}}
{{--                    --}}{{--    defaultDate: '{{\Carbon\Carbon::parse($order->deadline)->format('H:i')}}'--}}
{{--                    --}}{{--});--}}
{{--                    $(".service-provider-phone").on('change', function(e) {--}}

{{--                        var service_provider_phone      = $(this).val();--}}

{{--                        $.ajax({--}}
{{--                            url:   "{{route('privateOrder.check-service-provider-phone')}}",--}}
{{--                            data: {--}}
{{--                                service_provider_phone: service_provider_phone,--}}
{{--                                _token: '{{csrf_token()}}'--}}
{{--                            },--}}
{{--                            type: "post",--}}
{{--                            success: function (data) {--}}
{{--                                $('.send-order').attr('disabled',false);--}}
{{--                                $('.service-provider-validator').html('');--}}
{{--                                $('.service-provider-validator').fadeOut();--}}
{{--                            },--}}
{{--                            error: function (reject) {--}}
{{--                                if( reject.status === 401 ) {--}}
{{--                                    $(".errors-text").append("لا تملك الصلاحية للقيام بهذه العملية");--}}
{{--                                    $('.alert-box').show();--}}
{{--                                }--}}
{{--                                if( reject.status === 402 ) {--}}
{{--                                    $('.send-order').attr('disabled',true);--}}
{{--                                    $('.service-provider-validator').html(reject.responseJSON.message);--}}
{{--                                    $('.service-provider-validator').fadeIn();--}}
{{--                                }--}}
{{--                                if( reject.status === 403 ) {--}}
{{--                                    $('.send-order').attr('disabled',true);--}}
{{--                                    $('.service-provider-validator').html(reject.responseJSON.message);--}}
{{--                                    $('.service-provider-validator').fadeIn();--}}
{{--                                }--}}
{{--                                if( reject.status === 404 ) {--}}
{{--                                    $('.send-order').attr('disabled',true);--}}
{{--                                    $('.service-provider-validator').html(reject.responseJSON.message);--}}
{{--                                    $('.service-provider-validator').fadeIn();--}}
{{--                                }--}}
{{--                            }--}}
{{--                        });--}}

{{--                    });--}}
{{--                </script>--}}
{{--@endsection--}}
