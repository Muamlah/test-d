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

        @if(@$item->pay_status == 'processing_convert')
            <div class="alert mr-3 ml-3 rounded-s bg-red2-dark " role="alert">
                <span class="alert-icon"><i class="fa fa-times-circle font-18"></i></span>
                <h4 class="text-uppercase color-white">الرجاء الانتباة لم يتم دفع بعد !</h4>
                <button type="button" class="close color-white opacity-60 font-16" data-dismiss="alert"
                        aria-label="Close">&times;
                </button>
            </div>
        @endif
        {!!@$item->getHtmlStatusAlert()!!}

        <div class="card card-overflow card-style">
            <div class="content">
                <div class="d-flex">
                    <div class="flex-grow-1">
                        <h1 class="font-30 mb-3">خدمة تعميد رقم{{$item->id}}</h1>
                    </div>
                    <div class="flex-shrink-1">
                        <h4 class="font-20">
                            {{@$item->price}} ريال</h4>
                    </div>
                </div>

                <div class="divider"></div>
                <div class="row">
                    <div class="col-6">
                        <h4>تفاصيل الطلب :</h4>
                    </div>
                    <div class="col-6 p-0">
                        {{-- <a href="{{route('privateOrder.open_chat',@$item->id)}}">
                            <strong  class="bg-green2-dark rounded-xs font-14 text-uppercase pr-2 pl-2 pb-1 pt-1 line-height-s"><i class="fas ml-2 fa-comments"></i>فتح
                                المحادثة</strong>
                        </a> --}}
                        <a href="#messages-card">
                            <strong  class="bg-green2-dark rounded-xs font-14 text-uppercase pr-2 pl-2 pb-1 pt-1 line-height-s"><i class="fas ml-2 fa-comments"></i>
                                المحادثة</strong>
                        </a>
                    </div>
                </div>
                <p>{{@$item->details}}</p>

                <div class="row">
                    <div class="col-6 mb-4">
                        <strong class="color-theme"><span class="font-14">حالة الخدمة</span></strong>
                        <p>
                            {!! @$item->getHtmlStatus() !!}
                        </p>
                    </div>
                    <div class="col-6 mb-4">
                        <strong class="color-theme"><span class="font-14"> @if($item->user->name !='')إسم طالب
                                الخدمة @else    رقم طالب الخدمة   @endif</span></strong>
                        <p class="font-12">
                            @if($item->user->name !=null) {{$item->user->name}}  @else    {{$item->user->phone}}  @endif
                        </p>
                    </div>
                    <div class="col-6 mb-4">
                        <strong class="color-theme"><span class="font-14">قيمة التعميد</span></strong>
                        <p class="font-12"> {{@$item->price}}ريال </p>
                    </div>

                    @if(@$item->proposed_value <> 0)
                        <div class="col-6 mb-4">
                            <strong class="color-theme"><span class="font-14">
                        طلب تغيير القيمة الى</span></strong>
                            <p class="font-12" style="color: red; font-weight: bolder;"> {{@$item->proposed_value}}
                                ريال </p>
                        </div>
                    @endif

                    <div class="col-6 mb-4">
                        <strong class="color-theme"><span class="font-14">رسوم التعميد</span></strong>
                        <p class="font-12">
                            {{@$item->fees}} ريال
                        </p>
                    </div>
                    <div class="col-6 mb-4">
                        <strong class="color-theme"><span class="font-14">ضريبة القيمة المضافة</span></strong>
                        <p class="font-12">  {{$item->value_added_tax }} ريال </p>
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
                    {{--                    <div class="col-6 mb-4">--}}
                    {{--                        <strong class="color-theme"><span class="font-14">الحساب المحول منه</span></strong>--}}
                    {{--                        <p class="font-12">--}}
                    {{--                            MADA--}}
                    {{--                        </p>--}}
                    {{--                    </div>--}}
                    <div class="col-6 mb-4">
                        <strong class="color-theme"><span class="font-14">حالة الدفع</span></strong>
                        @if(@$item->pay_status == 'processing_convert')
                            <p class="font-12">في إنتظار تأكيد الدفع</p>
                        @else
                            <p class="font-12">تم تحويل</p>
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
                    {{--                            ريال {{@$item->client_cancellation}}--}}
                    {{--                        </p>--}}
                    {{--                    </div>--}}
                </div>
                <div class="divider mt-4"></div>
                @if(@$item->status_id != 11)
                    <div class="row mb-0">
                        {{-- @if(@$item->status == 'waiting') --}}
                        @if(@$item->status_id == 2)
                            <div class="col">
                                <form action="{{url('private-service/update-status/'.$item->id.'/3')}}" method="POST">
                                    {{ csrf_field() }}
                                    <button type="submit" class="btn w-100 btn-full btn-m font-900 text-uppercase rounded-l shadow-l bg-green-c">
                                        الموافقة على الخدمة
                                    </button>
                                </form>
                            </div>
                        {{-- @elseif(@$item->status == 'processing' ) --}}
                        @elseif(@$item->status_id == 3 )
                            @if($row->id == $item->id)
                                <div class="col">
                                    <a href="#" data-menu="service-delivery" class="btn w-100 btn-full btn-m font-900 text-uppercase rounded-l shadow-l bg-green-c">
                                        تسليم الخدمة
                                    </a>
                                </div>
                            @if($row_count < 5)
                            <div class="col">
                                <a href="{{ route('followingOrder.create',$item->id) }}"
                                   class="btn w-100 btn-full btn-m font-900 text-uppercase rounded-l shadow-l bg-yellow1-dark">تعميد
                                    تابع </a>
                            </div>
                            @endif
                        @endif
                    @endif
                    @if(@$item->proposed_value <> 0 && ($item->status_id != 4 || $item->status_id != 5 || $item->status_id != 6  ))
                    {{-- @if(@$item->proposed_value <> 0 && ($item->status != 'completed' || $item->status != 'confirm_completed' || $item->status != 'canceled'  )) --}}
                        <div class="col">
                            <form action="{{url('user/new_value_update/'.$item->id)}}" method="POST">
                                {{ csrf_field() }}
                                <button type="submit"
                                        class="btn w-100 btn-full btn-m font-900 text-uppercase rounded-l shadow-l bg-yellow1-dark">
                                    تأكيد القيمة الجديدة
                                </button>
                            </form>
                        </div>
                    @endif
                    {{-- @if($item->status != 'confirm_completed') --}}
                    @if($item->status_id != 8)
                    <div class="col">
                        <a data-menu="menu-message"
                        class="btn w-100 btn-full btn-m font-900 text-uppercase rounded-l shadow-l bg-red2-dark">
                            إبلاغ
                        </a>
                    </div>
                    @endif

                        @if($item->id == $row->id)
                            {{-- @if(@$item->status == 'pending' || @$item->status == 'processing' ||@$item->status == 'waiting') --}}
                            @if(@$item->status_id == 1 || @$item->status_id == 3 ||@$item->status_id == 2)
                                <div class="col">
                                <form action="{{url('private-service/update-status/'.$item->id.'/6')}}"
                                      method="POST">
                                    {{ csrf_field() }}
                                    <button  type="submit"
                                            class="btn w-100 btn-full btn-m font-900 text-uppercase rounded-l shadow-l bg-red2-dark">
                                        إلغاء الخدمة
                                    </button>
                                </form>
                                </div>
                            @elseif(@$item->status_id == 6)
                                        <div class="col">
                                <form action="{{url('private-service/update-status/'.$item->id.'/7')}}" method="POST">
                                    {{ csrf_field() }}
                                    <button type="submit"
                                            class="btn w-100 btn-full btn-m font-900 text-uppercase rounded-l shadow-l bg-red2-dark">
                                        تأكيد إلغاء الخدمة
                                    </button>
                                </form>
                                        </div>
                            @endif

                        @endif


                </div>
                @endif
            </div>
        </div>
    </div>
    <!-- End of Page Content-->

    <div id="service-delivery" class="menu menu-box-modal rounded-m"
         data-menu-height="180"
         data-menu-width="310">
        <div class="mr-3 ml-3 mt-3">
            <h1 class="text-uppercase font-900 mb-0">الرجاء ادخال المبلغ المطلوب</h1>
            <div class="lineBorder"></div>
            <form method="post" action="{{  url('private-service/update-status/'.$item->id.'/4')}}"
                  enctype="multipart/form-data" class="form-horizontal" role="form">
                {{ csrf_field() }}
                <div class="input-style has-icon input-style-1 input-required">
                    <input type="number" max="{{$item->price}}" value="{{$item->price}}" name="deserved_price"
                           placeholder="المبلغ" required>
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
            <form method="post" action="{{url('private-service/update-status/'.$item->id.'/8')}}"
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
    @include('website.chat.include_chat', ['message' => $chat_message])
@endsection
