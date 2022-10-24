@extends('website.layout')

@section('content')
    <!-- Page Content-->
    <div class="page-content header-clear-medium">
        @if ($message = Session::get('error') )
            <div class="alert mr-3 ml-3 rounded-s bg-red2-dark " role="alert">
                <span class="alert-icon"><i class="fa fa-times-circle font-18"></i></span>
                <h4 class="text-uppercase color-white">{{$message}} !</h4>
                <button type="button" class="close color-white opacity-60 font-16" data-dismiss="alert" aria-label="Close">&times;</button>
            </div>
        @endif
        @if(@$item->status == '6')
            <div class="alert mr-3 ml-3 rounded-s bg-red2-dark " role="alert">
                <span class="alert-icon"><i class="fa fa-times-circle font-18"></i></span>
                <h4 class="text-uppercase color-white">بانتظار تأكيد مقدم الخدمة لالغاء الطلب !</h4>
                {{-- <strong class="alert-icon-text"></strong>--}}
                <button type="button" class="close color-white opacity-60 font-16" data-dismiss="alert" aria-label="Close">&times;</button>
            </div>
        @endif
        @if(@$item->status == '5')
            <div class="ml-3 mr-3 alert alert-small rounded-s shadow-xl bg-green1-dark" role="alert">
                <span><i class="fa fa-check"></i></span>
                <strong>تم تأكيد استلام الطلب !</strong>
                <button type="button" class="close color-white opacity-60 font-16" data-dismiss="alert" aria-label="Close">&times;</button>
            </div>
        @endif
        @if(@$item->status == '4')
            <div class="ml-3 mr-3 alert alert-small rounded-s shadow-xl bg-green1-dark" role="alert">
                <span><i class="fa fa-check"></i></span>
                <h4 class="text-uppercase color-white">بانتظار تأكيد العميل لاستلام الخدمة !</h4>
                {{-- <strong class="alert-icon-text"></strong>--}}
                <button type="button" class="close color-white opacity-60 font-16" data-dismiss="alert" aria-label="Close">&times;</button>
            </div>
        @endif
        @if ( $item->pay_status == 'processing_convert' )
            <div class="alert mr-3 ml-3 rounded-s bg-red2-dark " role="alert">
                <span class="alert-icon"><i class="fa fa-times-circle font-18"></i></span>
                <h4 class="text-uppercase color-white">تحذير..! لم يتم دفع رسوم الخدمة من قبل العميل</h4>
                <button type="button" class="close color-white opacity-60 font-16" data-dismiss="alert" aria-label="Close">&times;</button>
            </div>
        @endif

        <div class="card card-overflow card-style">
            <div class="content">
                <div class="d-flex">
                    <div class="flex-grow-1">
                        <h1 class="font-30 mb-3">#{{$item->id}} - {{$item->eservices->service_name}}</h1>
                    </div>
                    <div class="flex-shrink-1">
                        <h4 class="font-20">
                          {{@$item->eservices->price}} ريال </h4>
                    </div>
                </div>

                <div class="divider"></div>
                <div class="row">
                    <div class="col-6">
                        <h4>تفاصيل الطلب :</h4>
                    </div>
                    @if($item->user_id != 0 && $item->status != 5)
                    <div class="col-6 p-0">
                        {{-- <a href="{{route('eservices_orders.open_chat',@$item->id)}}">
                            <strong  class="bg-green2-dark rounded-xs font-14 text-uppercase pr-2 pl-2 pb-1 pt-1 line-height-s"><i class="fas ml-2 fa-comments"></i>فتح
                                المحادثة</strong>
                        </a> --}}
                        <a href="#messages-card">
                            <strong  class="bg-green2-dark rounded-xs font-14 text-uppercase pr-2 pl-2 pb-1 pt-1 line-height-s"><i class="fas ml-2 fa-comments"></i>
                                المحادثة</strong>
                        </a>
                    </div>
                    @endif
                </div>
                <p>{{@$item->details}}</p>
                <div class="row">
                    <div class="col-6 mb-4">
                        <strong class="color-theme"><span class="font-14">حالة الخدمة</span></strong>
                        <p>
                            @if(@$item->status == '1')
                                <span class="bg-dark1-light rounded-xs text-uppercase font-900 font-14 pr-2 pl-2 pb-0 pt-0 line-height-s">
 بإنتظارالمراجعة                                     </span>

                            @elseif(@$item->status == '3')
                                <span class="bg-yellow1-dark rounded-xs text-uppercase font-11 pr-2 pl-2 pb-1 pt-1 line-height-s">
 قيد التنفيذ                                      </span>
                            @elseif(@$item->status == '2')
                                <span class="bg-yellow1-dark rounded-xs text-uppercase font-11 pr-2 pl-2 pb-1 pt-1 line-height-s">
                                        بإنتظار الموافقة
                                    </span>
                            @elseif(@$item->status == '6')

                                <span class="bg-red2-dark rounded-xs text-uppercase font-11 pr-2 pl-2 pb-1 pt-1 line-height-s">
                                        ملغي
                                    </span>
                            @elseif(@$item->status == '7')

                                <span class="bg-red2-dark rounded-xs text-uppercase font-11 pr-2 pl-2 pb-1 pt-1 line-height-s">
                                        تم تأكيد الغاء الطلب
                                     </span>

                            @elseif(@$item->status == '4')
                                <span class="bg-green1-dark rounded-xs text-uppercase font-11 pr-2 pl-2 pb-1 pt-1 line-height-s">
                                         بإنتظار الإستلام
                                      </span>
                            @elseif(@$item->status == '5')
                                <span class="bg-green1-dark rounded-xs text-uppercase font-11 pr-2 pl-2 pb-1 pt-1 line-height-s">
                                         تم التسليم
                                      </span>
                            @elseif(@$item->status == '8')
                                <span class="bg-red2-dark rounded-xs text-uppercase font-11 pr-2 pl-2 pb-1 pt-1 line-height-s">
                                        بلاغ
                                    </span>
                            @endif

                        </p>
                    </div>
                    <div class="col-6 mb-4">
                        <strong class="color-theme"><span class="font-14"> @if($item->users->name !='')إسم طالب الخدمة @else    رقم طالب الخدمة   @endif</span></strong>
                        <p class="font-12">
                            @if($item->users->name !=null) {{$item->users->name}}  @else    {{$item->users->phone}}  @endif
                        </p>
                    </div>
                    <div class="col-6 mb-4">
                        <strong class="color-theme"><span class="font-14">قيمة الخدمة</span></strong>
                        <p class="font-12">
                              {{@$item->eservices->price}} ريال
                        </p>
                    </div>
                    <div class="col-6 mb-4">
                        <strong class="color-theme"><span class="font-14">رسوم الخدمة</span></strong>
                        <p class="font-12">
                            {{$item->provider_fees }} ريال
                        </p>
                    </div>
                    <div class="col-6 mb-4">
                        <strong class="color-theme"><span class="font-14">ضريبة القيمة المضافة</span></strong>
                        <p class="font-12">
                            {{$item->provider_value_added_tax}} ريال
                        </p>
                    </div>
                    <div class="col-6 mb-4">
                        <strong class="color-theme"><span class="font-14">اجمالي المبلغ</span></strong>
                        <p class="font-12"> <?php
                        $fees = $item->provider_value_added_tax + $item->provider_fees;
                        $total = $item->price -$fees;
                        echo $total;
                         ?>  ريال </p>
                    </div>
                    <div class="col-6 mb-4">
                        <strong class="color-theme"><span class="font-14">حالة الدفع</span></strong>
                        @if(@$item->pay_status == 'processing_convert')
                            <p class="font-12">في إنتظار تأكيد الدفع</p>
                        @else
                            <p class="font-12">تم تحويل</p>
                        @endif
                    </div>
                </div>
                <div class="divider mt-4"></div>
                @include('website.chat.include_chat', ['message' => $chat_message])
                
                <div class="row mb-0">
                    @if(@$item->status != '8')
                        @if(@$item->status == '2')
                            <div class="col">
                                <form  action="{{url('eservices_orders/update-status/'.$item->id.'/2')}}" method="POST">
                                    {{ csrf_field() }}
                                    <button type="submit" class="btn btn-full w-100 btn-m font-900 text-uppercase rounded-l shadow-l bg-green-c">
                                        الموافقة على الخدمة</button>
                                </form>
                            </div>
                        @endif
                        @if(@$item->status == '3')
                            <div class="col">
                                <form  action="{{url('eservices_orders/update-status/'.$item->id.'/4')}}" method="POST">
                                    {{ csrf_field() }}
                                    <button type="submit" class="btn btn-full w-100 btn-m font-900 text-uppercase rounded-l shadow-l bg-green-c">
                                        تسليم الخدمة</button>
                                </form>
                            </div>
                        @endif
                        @if($item->status == "6")
                            <div class="col">
                                <form  action="{{url('eservices_orders/update-status/'.$item->id.'/7')}}" method="POST">
                                    {{ csrf_field() }}
                                    <button type="submit" class="btn w-100 btn-full btn-m font-900 text-uppercase rounded-l shadow-l bg-red2-dark">
                                        تأكيد لغاء الخدمة</button>
                                </form>
                            </div>
                        @endif
                        @if($item->status != "8")
                        <div class="col">
                            <a data-menu="menu-message"
                            class="btn w-100 btn-full btn-m font-900 text-uppercase rounded-l shadow-l bg-red2-dark">
                                إبلاغ
                            </a>
                        </div>
                        @endif
                    @endif
                </div>

            </div>
        </div>

        @if(Auth::user()->level == 'provider' && $eservices->how_do !='')
            <div class="card card-overflow card-style">
                <div class="content">
                    {!! $eservices->how_do !!}
                </div>
            </div>
        @endif
    </div>
    <!-- End of Page Content-->

    <div id="service-delivery" class="menu menu-box-modal rounded-m"
         data-menu-height="180"
         data-menu-width="310">
        <div class="mr-3 ml-3 mt-3">
            <h1 class="text-uppercase font-900 mb-0">الرجاء ادخال المبلغ المطلوب</h1>
            <div class="lineBorder"></div>
            <form method="post" action="{{  url('private-service/update-status/'.$item->id.'/3')}}"
                  enctype="multipart/form-data" class="form-horizontal" role="form">
                {{ csrf_field() }}
                <div class="input-style has-icon input-style-1 input-required">
                    <input type="number" max="{{$item->price}}" value="{{$item->price}}"  name="deserved_price" placeholder="المبلغ" required>
                </div>
                <button type="submit" class="btn btn-full btn-m shadow-l rounded-s text-uppercase font-900 bg-green1-dark mt-4">تم</button>
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
            <form method="post" action="{{url('eservices_orders/update-status/'.$item->id.'/8')}}"
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
@endsection
