@extends('website.layout')

@section('content')


    <div class="page-content header-clear-medium">






    <div class="card card-style bg-grey-c card-order" data-card-height="130">
        <div class="card-center text-center mr-3">
            <h1 class="color-white mb-0">تعديل قيمة الطلب</h1>
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
            <div class="tab-controls tabs-round tab-animated tabs-medium tabs-rounded shadow-xl" data-tab-items="2"
                 data-tab-active="bg-green-muamlah color-white">
                <a href="#" data-tab-active data-tab="tab-private">تعديل قيمة الطلب</a>
            </div>
            <div class="clearfix mb-3"></div>
            <div class="tab-content" id="tab-private">
                <div class="pt-2">
                    <form method="post" action="{{url('/user/update_order_value').'/'.$order->id}}"
                          enctype="multipart/form-data" class="form-horizontal" role="form">
                        {{ csrf_field() }}


                   @if(session()->has('success'))

                    <div style="color: green; font-weight: bolder; font-size: 18px; text-align: center;">

                         {{ session()->get('success') }}

                    </div>
                    <p>&nbsp;</p>

                   @endif

                        <div class="input-style input-style-2 has-icon input-required">
                            <i class="fa input-icon fa-calendar-plus"></i>
                            <span class="color-highlight"> تاريخ الانتهاء :  </span>
                            <em>(مطلوب)</em>
                            <input class="form-control" disabled type="number" value="{{$order->deadline}}" required name="deadline" id="deadline"
                                   oninput="checkDate(this)">
                        </div>



                        <div class="input-style input-style-2 has-icon input-required">
                            <i class="fa input-icon fa-money-bill-wave"></i>
                            <span class="color-highlight">ا
                                ضغط لتغيير قيمة الطلب الحالية :
                            @if($order->proposed_value == 0)
                            {{$order->price}}
                            @else
                            {{$order->proposed_value}}
                            @endif

                            </span>
                            <em>(مطلوب)</em>
                            <input class="form-control" type="number" value="
                            <?php if($order->proposed_value == 0) {
                            echo $order->price;
                             } else {
                            echo $order->proposed_value;
                             }
                             ?>"
                            name="proposed_value" >
                        </div>
                        <div class="input-style input-style-2 has-icon input-required">
                            <i class="fa input-icon fa-info"></i>
                            <span>التفاصيل : {{$order->details}}</span>
                            <em>(مطلوب)</em>
                            <textarea class="form-control" name="details" diabled >{{$order->details}}</textarea>
                        </div>

                        <button type="submit" class="btn btn-m w-100 btn-full rounded-l bg-green-c mr-auto ml-auto font-900 text mt-4">
                            تحديث قيمة الطلب
                        </button>
                    </form>
                </div>
            </div>
            <div class="tab-content" id="tab-public">
                <div class="pt-2">
                    <form method="post" action="#"
                          enctype="multipart/form-data" class="form-horizontal" role="form">
                        {{ csrf_field() }}

                        <div class="input-style input-style-2 has-icon input-required">
                            <i class="fa input-icon fa-heading"></i>
                            <span class="color-highlight">عنوان الخدمة</span>
                            <em>(مطلوب)</em>
                            <input class="form-control" type="text" name="title" required>
                        </div>

                        <div class="input-style input-style-2 has-icon input-required">
                            <i class="fa input-icon fa-info"></i>
                            <span>تفاصيل الخدمة</span>
                            <em>(مطلوب)</em>
                            <textarea class="form-control" name="description" placeholder="" rows="7"
                                      required></textarea>
                        </div>
                        <button type="submit" class="btn btn-m w-100 btn-full rounded-l bg-green-c mr-auto ml-auto font-900 text mt-4">
                            إضافة خدمة
                        </button>
                    </form>

                </div>
                <!-- End of Page Content-->
            </div>
            <!-- End of Page Content-->

        </div>

    <script>
        function checkDate(_this) {
            const deadline = document.getElementById("deadline").value;
            $.ajax({
                url: "{{ route('privateOrder.checkDate') }}",
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
