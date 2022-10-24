
@extends('website.layout')

@section('content')
 
 
            <div data-card-height="240" class="card card-style rounded-m shadow-xl">
                <div class="card-top text-center mt-4 mr-3">
                    <h3 class="color-white mb-0 mb-n2 font-20">الرجاء إكمال عملية الدفع لتأكيد الطلب!</h3>
                </div>
                <div class="card-center text-center">
                    <h2 class="color-white fa-2x">رقم الطلب: 58162</h2>
                    <p class="color-white opacity-70 font-11 mt-5 mb-n5"><i class="fas m-1 fa-shield-alt"></i>نظام آمن و
                        مشفر 100%</p>
                </div>
                <div class="card-overlay bg-gradient opacity-70"></div>
                <div class="card-overlay bg-gradient bg-gradient-magenta3 opacity-80"></div>
            </div>
            <div class="card card-style">
                <div class="content mb-0">
                    <div class="row mb-0">
                        <div class="col-4 pl-0">
                            <div class="mx-0 mb-3">
                                <h6 class="font-14 font-800 text-uppercase opacity-50">قيمة التعميد</h6>
                                <h3 class="color-magenta2-dark font-16 mb-0">100 ريال</h3>
                            </div>
                        </div>
                        <div class="col-4 p-0 text-center">
                            <div class="mx-0 mb-3">
                                <h6 class="font-14 font-800 text-uppercase opacity-50">رسوم التعميد</h6>
                                <h3 class="color-yellow1-dark font-16 mb-0">50 ريال</h3>
                            </div>
                        </div>
                        <div class="col-4 pr-0 text-center">
                            <div class="mx-0 mb-3">
                                <h6 class="font-14 font-800 text-uppercase opacity-50">رسوم الاسترجاع</h6>
                                <h3 class="color-blue2-dark font-16 mb-0">10 ريال</h3>
                            </div>
                        </div>
                    </div>
                    <div class="divider mt-2 mb-3"></div>
                    <div class="row mb-0">
                        <div class="col-6 text-center">
                            <div class="mx-0 mb-3">
                                <h6 class="font-16 font-800 text-uppercase opacity-50">المبلغ الاجمالي</h6>
                                <h3 class="color-green2-dark font-16 mb-0">160 ريال</h3>
                            </div>
                        </div>
                        <div class="col-6 text-center">
                            <div class="mx-0 mb-3">
                                <h6 class="font-16 font-800 text-uppercase opacity-50">حالة الدفع</h6>
                                <h3 class="color-red2-dark font-16 mb-0">في الانتظار</h3>
                            </div>
                        </div>
                    </div>
                    <div class="mt-2">
                        <form action="">
                            <div class="input-style input-style-2 input-required mb-3">
                                <span class="color-highlight">اسم حامل البطاقة</span>
                                <input class="form-control" type="name" placeholder="Joe Purchases">
                            </div>
                            <div class="input-style input-style-2 input-required mb-3">
                                <span class="color-highlight">رقم البطاقة</span>
                                <input class="form-control" type="name">
                            </div>
                            <div class="row mb-0">
                                <div class="col-7">
                                    <div class="input-style input-style-2 input-required mb-3">
                                        <span class="color-highlight">تاريخ الإنتهاء</span>
                                        <input class="form-control" type="name" placeholder="">
                                    </div>
                                </div>
                                <div class="col-5">
                                    <div class="input-style input-style-2 input-required mb-3">
                                        <span class="color-highlight">CVV</span>
                                        <input class="form-control" type="name">
                                    </div>
                                </div>
                            </div>
                            <button type="submit"
                                class="btn btn-m btn-full color-white rounded-l bg-gradient-magenta3 mr-auto ml-auto font-900 text mt-4 mb-4">
                                إدفع الأن
                            </button>
                        </form>
                    </div>
                </div>
            </div>
            <div class="card card-style">
                <div class="content">
                    <h3 class="text-center color-highlight">منصة معاملة . كوم</h3>
                    <p class="text-center">
                        منصة للخدمات الالكترونية تجمع بين العملاء و مقدمي الخدمات في السعودية.
                        <br><br>
                        للإستفسار تواصل مع أحد المشرفين المعتمدين..
                    </p>

                    <div class="user-slider owl-carousel">
                        <div class="user-left">
                            <div class="d-flex">
                                <div><img src="{{asset('public/website/images/pictures/faces/1s.png')}}" class="ml-3 rounded-circle shadow-l"
                                        width="50"></div>
                                <div>
                                    <h5 class="mt-1 mb-0">أبو عازم</h5>
                                    <p class="font-10 mt-n1 color-red2-dark">المشرف المالي</p>
                                </div>
                                <div class="mr-auto"><span
                                        class="next-slide-user color-white rounded-s bg-highlight mt-2 p-2 font-8">
                                        تواصل معه
                                    </span></div>
                            </div>
                        </div>
                        <div class="user-right">
                            <div class="d-flex">
                                <div>
                                    <h5 class="mt-1 mb-0">أبو عازم</h5>
                                    <p class="font-10 mt-n1 color-red2-dark">المشرف المالي</p>
                                </div>
                                <div class="mr-auto">
                                    <a href="#" class="icon icon-xs rounded-circle shadow-l bg-blue2-dark mr-2 ml-2">
                                        <i class="fab fa-telegram-plane"></i></a>
                                    <a href="#" class="icon icon-xs rounded-circle shadow-l bg-whatsapp">
                                        <i class="fab fa-whatsapp"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="divider mt-3"></div>
                    <div class="user-slider owl-carousel">
                        <div class="user-left">
                            <div class="d-flex">
                                <div><img src="{{asset('public/website/images/pictures/faces/3s.png')}}" class="ml-3 rounded-circle shadow-l"
                                        width="50"></div>
                                <div>
                                    <h5 class="mt-1 mb-0">أبو عازم</h5>
                                    <p class="font-10 mt-n1 color-red2-dark">مدير التعميد</p>
                                </div>
                                <div class="mr-auto"><span
                                        class="next-slide-user color-white rounded-s bg-highlight mt-2 p-2 font-8">
                                        تواصل معه
                                    </span></div>
                            </div>
                        </div>
                        <div class="user-right">
                            <div class="d-flex">
                                <div>
                                    <h5 class="mt-1 mb-0">أبو عازم</h5>
                                    <p class="font-10 mt-n1 color-red2-dark">مدير التعميد</p>
                                </div>
                                <div class="mr-auto">
                                    <a href="#" class="icon icon-xs rounded-circle shadow-l bg-blue2-dark mr-2 ml-2">
                                        <i class="fab fa-telegram-plane"></i></a>
                                    <a href="#" class="icon icon-xs rounded-circle shadow-l bg-whatsapp">
                                        <i class="fab fa-whatsapp"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            

        @endsection