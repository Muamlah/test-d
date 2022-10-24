@extends('website.layout')
@section('content')
    <!-- Page Content-->
    <div class="page-content header-clear-medium">
        <div class="card card-style" data-card-height="500">
            <div class="card-center">
                <img class="mb-3 mx-auto logo-slider" width="120"
                     src="{{asset("/template-muamlah/images/logo.png")}}">
                <h1 class="text-center font-20">منصة معاملة . كوم</h1>
                @if ($order->pay_status!='complete_convert')
                <div class="ml-3 mr-3 alert alert-small rounded-s shadow-xl bg-red2-dark" role="alert">
                    <strong> فشلت عملية الدفع الرجاء المحاولة مرة اخرى </strong>
                </div>
                    <a href="{{$url}}" class="btn btn-m font-900 text-uppercase bg-green2-dark btn-center-xl">محاولة مرة اخرى</a>
                @else
                <div class="ml-3 mr-3 alert alert-small rounded-s shadow-xl bg-green1-dark" role="alert">
                    <strong>تم عملية الدفع بنجاح</strong>
                </div>
                <div class="ml-3 mr-3">
                    <h3> الرقم المرجعي للدفعة:  {{$payment_status[0]->ref}}</h3>
                </div>
                    <a href="{{$url}}" class="btn btn-m font-900 text-uppercase bg-green2-dark btn-center-xl">الإنتقال إلى صفحة
                        الطلب</a>
                @endif



            </div>
            <div class="card-overlay bg-white opacity-90"></div>
        </div>
        <div class="card card-style">
            <div class="content">
                <h3 class="text-center color-highlight font-18 mb-5">للإستفسار تواصل مع أحد المشرفين المعتمدين..
                </h3>
                @foreach($admins as $admin)

                    <div class="user-slider owl-carousel">
                        <div class="user-left">
                            <div class="d-flex">
                                <div><img src="images/pictures/faces/1s.png" class="ml-3 rounded-circle shadow-l"
                                          width="50"></div>
                                <div>
                                    <h5 class="mt-1 mb-0">{{$admin->name}}</h5>
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
                                    <h5 class="mt-1 mb-0">{{$admin->name}}</h5>
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
                @endforeach

            </div>
        </div>
    </div>
    <!-- End of Page Content-->

@endsection
