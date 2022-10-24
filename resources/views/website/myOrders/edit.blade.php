@extends('website.layout')
@section('content')
    <div class="page-content header-clear-medium">
        <div class="card card-style bg-grey-c card-order" data-card-height="130">
            <div class="card-center text-center mr-3">
                <h1 class="color-white mb-0"> تعديل طلب تعميد عام رقم {{$order->id}}</h1>
            </div>
        </div>
        @if (Session::get('hyperpay_success') )
            <div class="ml-3 mr-3 alert alert-small rounded-s shadow-xl bg-green1-dark" role="alert">
                <span><i class="fa fa-check"></i></span>
                <strong>{{Session::get('hyperpay_success')}}</strong>
                <button type="button" class="close color-white opacity-60 font-16" data-dismiss="alert" aria-label="Close">&times;</button>
            </div>
        @endif
        @if (Session::get('edit_success') )
            <div class="ml-3 mr-3 alert alert-small rounded-s shadow-xl bg-green1-dark" role="alert">
                <span><i class="fa fa-check"></i></span>
                <strong>{{Session::get('edit_success')}}</strong>
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
                    {{--                    <a href="#" data-tab-active data-tab="tab-private">طلب تعميد خاص</a>--}}
                </div>
                <div class="clearfix mb-3"></div>
                <div class="pt-2">
                    <form  action="{{route('publicOrders.update',$order->id)}}" method="POST" class="form-horizontal" role="form">
                        @method('PUT')
                        @csrf
                        <div class="row mb-1">
                            <div class="col-6">
                                <div class="input-style input-style-2 has-icon input-required">
                                    <i class="fa input-icon fa-calendar-plus"></i>
                                    <span class="color-highlight input-style-1-active input-style-1-inactive">تاريخ إنتهاء التعميد </span>
                                    <input id="basicFlatpickr"
                                           class="form-control flatpickr text-right  flatpickr-input"
                                           type="text" name="date" required    >
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="input-style input-style-2 has-icon input-required">
                                    <i class="fa input-icon fa-calendar-plus"></i>
                                    <span class="color-highlight input-style-1-active input-style-1-inactive"> وقت الإنتهاء</span>
                                    <input id="timeFlatpickr"
                                           class="form-control flatpickr text-right  flatpickr-input"
                                           type="text" name="time"  required readonly="readonly">
                                </div>
                            </div>
                        </div>
                        <div class="input-style input-style-2 has-icon input-required">
                            <i class="fa input-icon fa-money-bill-wave"></i>
                            <span class="color-highlight input-style-1-active input-style-1-inactive">اكتب قيمة التعميد</span>
                            <em>(مطلوب)</em>
                            <input class="form-control" type="number" value="{{$order->price}}" required name="price" placeholder="">
                        </div>
                        <div class="input-style input-style-2 has-icon input-required">
                            <i class="fa input-icon fa-info"></i>
                            <span  class="color-highlight input-style-1-active input-style-1-inactive">عنوان الطلب</span>
                            <em>(مطلوب)</em>
                            <input class="form-control" type="text" value="{{$order->title}}" required name="title" placeholder="">

                        </div>
                        <div class="input-style input-style-2 has-icon input-required">
                            <i class="fa input-icon fa-info"></i>
                            <span  class="color-highlight input-style-1-active input-style-1-inactive"> تفاصيل الطلب</span>
                            <em>(مطلوب)</em>
                            <textarea class="textarea-height requiredField" required name="details" id="" cols="30"
                                      rows="10">{{$order->details}}</textarea>
                        </div>

                        <button type="submit" class="btn btn-m w-100 btn-full rounded-l bg-green-c mr-auto ml-auto font-900 text mt-4">
                            حفظ
                        </button>
                    </form>
                </div>
                <!-- End of Page Content-->

            </div>

            @endsection
            @section('script')
                <script type="text/javascript">
                    let date = "{{ \Carbon\Carbon::parse($order->deadline)->format('Y-m-d') }}";
                    $( document ).ready(function() {
                        $('#basicFlatpickr').flatpickr({
                            disableMobile: "true",
                            defaultDate: date
                        });
                    });




                </script>
@endsection
