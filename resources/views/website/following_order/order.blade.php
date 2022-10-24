@extends('website.layout')

@section('content')


    <div class="page-content header-clear-medium">



    <div class="card card-style bg-grey-c card-order" data-card-height="130">
        <div class="card-center text-center mr-3">
            <h1 class="color-white mb-0">طلب تعميد تابع</h1>
            <p class="color-white mt-n1 mb-0"></p>
        </div>
    </div>

        @guest()
            <div class="alert mr-3 ml-3 rounded-s bg-red2-dark " role="alert">
                <span class="alert-icon"><i class="fa fa-times-circle font-18"></i></span>
                <h4 class="text-uppercase color-white">انت لم تقم بتسجيل الدخول !</h4>
                <strong class="alert-icon-text">يجب عليك تسجيل الدخول اولا ليتم اتمام هذه العملية</strong>
                <button type="button" class="close color-white opacity-60 font-16" data-dismiss="alert" aria-label="Close">&times;</button>
            </div>
        @endguest



<?php //dd(Session::get('success')); ?>

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



        @if (Session::get('success'))
            <div class="ml-3 mr-3 alert alert-small rounded-s shadow-xl bg-green1-dark" role="alert">
                <span><i class="fa fa-check"></i></span>
                <strong>تم طلب التعميد التابع بنجاح !</strong>
                <button type="button" class="close color-white opacity-60 font-16" data-dismiss="alert" aria-label="Close">&times;</button>
            </div>

            <?php session()->forget('success'); ?>

                @endif


        @if (Session::get('fail') )
            <div class="ml-3 mr-3 alert alert-small rounded-s shadow-xl bg-red2-dark" role="alert">
                <span class="alert-icon"><i class="fa fa-times-circle font-18"></i></span>
                <strong>
                    <!--عفوا لا يمكنك اضافة تعميد تابع مرة أخرى - لقد قمت باضافة تعميد تابع لهذا الطلب مسبقا
                    -->
                        {{session()->get('fail')}}
                    </strong>
                <button type="button" class="close color-white opacity-60 font-16" data-dismiss="alert" aria-label="Close">&times;</button>
            </div>
            <?php session()->forget('fail'); ?>

                @endif


    <div class="card card-style bg-theme pb-0">
        <div class="content">
            <div class="tab-controls tabs-round tab-animated tabs-medium tabs-rounded shadow-xl" data-tab-items="1"
                 data-tab-active="bg-green-muamlah color-white" style="width:100% !important;">
                <a href="#" data-tab-active data-tab="tab-private" class="col-md-12">طلب تعميد تابع</a>

            </div>
            <div class="clearfix mb-3"></div>
            <div class="tab-content" id="tab-private">
                <div class="pt-2">
                    <form method="post" action="{{route('followingOrder.store')}}"
                          enctype="multipart/form-data" class="form-horizontal" role="form">
                        {{ csrf_field() }}



                <div class=" input-style input-style-2 has-icon input-required">

                                <i class="fa input-icon fa-phone"></i>
                                <em>(مطلوب)</em>


<input class="form-control" type="hidden" name="user_phone"value="{{$followingOrder->service_provider_phone}}" >

<input class="form-control" type="hidden" name="parent_order" value="{{$followingOrder->id}}" >

<input class="form-control" type="hidden" name="master_order" value="{{$followingOrder->master_order}}" >


                        </div>


                        <div class="input-style input-style-2  has-icon input-required">
                            <i class="fa input-icon fa-phone"></i>
                            <span class="color-highlight">اكتب رقم الجوال مقدم الخدمة</span>
                            <em>(مطلوب)</em>
                            <input class="form-control" type="text" name="service_provider_phone" required="required">
                        </div>

                        <div class="input-style input-style-2 has-icon input-required">
                            <i class="fa input-icon fa-calendar-plus"></i>
                            <span class="color-highlight"> تاريخ الانتهاء الحالي : {{$followingOrder->deadline}} </span>
                            <em>(مطلوب)</em>
                            <input class="form-control" readonly type="text" required
                            name="deadline" id="deadline" value="{{\Carbon\Carbon::parse($followingOrder->deadline)->format('Y-m-d')}}"

                            max="{{\Carbon\Carbon::parse($followingOrder->deadline)->format('Y-m-d')}}"
                                   oninput="checkDate(this)">
                        </div>

                <!--        <div class="input-style input-style-2 has-icon input-required">
                            <i class="fa input-icon fa-calendar-plus"></i>


                            <input class="form-control" placeholder="تاريخ انتهاء التعميد"  value=""
                                   name="end_date"  id="end_date" disabled>
                        </div> -->



                        <div class="input-style input-style-2 has-icon input-required">
                            <i class="fa input-icon fa-money-bill-wave"></i>
                            <span class="color-highlight"> قيمة التعميد الحالية {{$followingOrder->price}} ريال - اضغط لتقليل التكلفة</span>
                            <em>(مطلوب)</em>
                            <input class="form-control" type="number" required name="price" value="{{$followingOrder->price}}" max="{{$followingOrder->price}}" >
                        </div>
                        <div class="input-style input-style-2 has-icon input-required">
                            <i class="fa input-icon fa-info"></i>
                            <span>اضغط لمراجعة التفاصيل : {{$followingOrder->details}}</span>
                            <em>(مطلوب)</em>
                            <textarea class="form-control" name="details" required readonly>{{$followingOrder->details}}</textarea>
                        </div>
                        <div class="fac fac-checkbox"><span></span>
                            <input id="checkbox-1" type="checkbox" value="0">
                            <label for="checkbox-1"><a href="http://muamlah.com/terms" target="_blank">قرأت
                                    وأوافق على شروط الخدمة</a></label>
                        </div>
                        <div class="fac fac-checkbox"><span></span>
                            <input id="checkbox-2" type="checkbox" value="0">
                            <label for="checkbox-2">اقرار وتعهد صاحب الطلب و مقدم الخدمة بعدم مخالفة الشروط و
                                الأحكام أو الأنظمة و التعليمات ، و إذا حصل خلاف ذلك سوف يلغى
                                الطلب دون الرجوع لأي طرف .</label>
                        </div>
                        <button type="submit" class="btn btn-m w-100 btn-full rounded-l bg-green-c mr-auto ml-auto font-900 text mt-4">
                            أرسل الطلب
                        </button>
                    </form>
                </div>
            </div>

            <!-- End of Page Content-->

        </div>

    <script>
        function checkDate(_this) {
            var deadline = document.getElementById("deadline").value;


            $.ajax({
                url: "{{ route('checkDate') }}",
                type: "GET",
                data: {
                    _token:"{{csrf_token()}}",
                    deadline :deadline,
                },

                success: function (response) {
                    if (response) {
                        console.log(response);
                        document.getElementById("end_date").value= response;
                    }
                }
            });

        }
    </script>
@endsection
