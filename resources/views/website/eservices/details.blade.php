@extends('website.layout')
@include('website.meta.meta', [
    'options' => [
        'title'     	=> 'منصة معاملة . كوم',
        'sub_title' 	=> $eservices->service_name,
        'description' 	=> $eservices->details,
        'image'         => asset('public/storage/').'/'.$eservices->img,
        'url' 	    =>  urlencode(url()->full()),
    ],
])
@include('website.meta.google', [
    'options' => [
        'title'     	=> 'منصة معاملة . كوم',
        'sub_title' 	=> $eservices->service_name,
        'description' 	=> $eservices->details,
        'image'         => asset('public/storage/').'/'.$eservices->img,
        'url' 	        =>  urlencode(url()->full()),
    ],
])
@include('website.meta.facebook', [
    'options' => [
        'title'     	=> 'منصة معاملة . كوم',
        'sub_title' 	=> $eservices->service_name,
        'description' 	=> $eservices->details,
        'image'         => asset('public/storage/').'/'.$eservices->img,
        'keywords' 	    => $eservices->details,
        'url' 	        =>  urlencode(url()->full()),
    ],
])
@include('website.meta.twitter', [
    'options' => [
        'title'     	=> 'منصة معاملة . كوم',
        'sub_title' 	=> $eservices->service_name,
        'description' 	=> $eservices->details,
        'image'         => asset('public/storage/').'/'.$eservices->img,
          'url' 	    =>  urlencode(url()->full()),
    ],
])
@section('style')
    <style>
        .a2a_default_style a {
            margin: 0 80px !important
        }

        .a2a_s__default {
            padding: 8px !important;
        }

        .a2a_svg {
            width: 38px !important;
            height: 38px !important;
        }

        .a2a_kit .a2a_svg {
            margin: auto;
            border-radius: 8px !important;
        }

        .a2a_default_style .a2a_count, .a2a_default_style .a2a_svg, .a2a_floating_style .a2a_svg, .a2a_menu .a2a_svg, .a2a_vertical_style .a2a_count, .a2a_vertical_style .a2a_svg {
            border-radius: 7px !important;
        }

        .addthis-smartlayers-desktop {
            display: none !important;
        }
    </style>
{{--    <script type="text/javascript" src="//s7.addthis.com/js/300/addthis_widget.js#pubid=ra-5a2bb9d7ce915971"></script>--}}
@endsection
@section('content')
    <!-- Page Content-->
    @if(session()->has('hyperpay_error'))
        <div class="ml-3 mr-3 alert alert-small rounded-s shadow-xl bg-green1-dark" role="alert">
            <span><i class="fa fa-check"></i></span>
            <strong>{{ session()->get('hyperpay_error') }}</strong>
            <button type="button" class="close color-white opacity-60 font-16" data-dismiss="alert" aria-label="Close">&times;</button>
        </div>
    @endif
    <div class="page-content header-clear-medium">
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
                <strong>{{Session::get('success')}} </strong>
                <button type="button" class="close color-white opacity-60 font-16" data-dismiss="alert" aria-label="Close">&times;</button>
            </div>
        @endif
        <div class="card card-overflow card-style">
            <div class="content" style="margin-bottom: 5px">
                <div class="d-flex">
                    <div class="flex-grow-1">
                        <h1 class="font-30">{{$eservices->service_name}}</h1>
                    </div>
                    {{--                    <div class="flex-shrink-1">--}}
                    {{--                        <h1 class="font-20">--}}
                    {{--                            {{$eservices->price}}--}}
                    {{--                            <span class="font-12">ريال</span>--}}
                    {{--                            <br>--}}
                    {{--                        </h1>--}}
                    {{--                    </div>--}}
                </div>
                {{-- <div class="divider"></div> --}}
                <div class="mb-4">
                    <strong>تفاصيل الخدمة</strong><br>
                    {{--                    {{$eservices->details}}--}}
                </div>
                @if (request()->has('provider_id'))
                    <form method="post" action="{{route('publicOrders.storeProvider')}}" id="form_add" enctype="multipart/form-data" class="form-horizontal" role="form">
                        <input hidden name="provider_id" value="{{request()->provider_id}}">
                        @else
                            <form method="post" action="{{route('publicOrders.store')}}" id="form_add"  enctype="multipart/form-data" class="form-horizontal" role="form">
                                @endif
                                {{ csrf_field() }}
                                {{--                    <div class="input-style input-style-2 has-icon input-required">--}}
                                {{--                        <i class="fa input-icon fa-heading"></i>--}}
                                {{--                        <span class="color-highlight">عنوان الطلب</span>--}}
                                {{--                        <em>(مطلوب)</em>--}}
                                {{--                        <input class="form-control" type="text" name="title" value="{{$eservices->title}}" required>--}}
                                {{--                    </div>--}}
                                <input hidden name="id" value="{{$eservices->id}}">
                                @if (request()->has('affiliate_id'))
                                    <input hidden name="affiliate_id" value="{{request()->affiliate_id}}">
                                @endif
                                <div class="input-style input-style-2 has-icon input-required">
                                    <i class="fa input-icon fa-info"></i>
                                    <span>تفاصيل الطلب</span>
                                    <textarea class="textarea-height requiredField" required name="details" id="searchWord" cols="30" rows="10">{{old('details')}}</textarea>
                                </div>
                                {{--                    @if(!is_null($agent = auth()->user()->agent))--}}
                                {{--                        <div>--}}
                                {{--                            <input id="checkbox-3" type="checkbox" value="1" name="agent">--}}
                                {{--                            <label for="checkbox-3">تنفيذ الطلب عن طريق الوكيل <b>{{$agent->getName()}}</b></label>--}}
                                {{--                        </div>--}}
                                {{--                    @endif--}}
                                {{--                    @if($public_count >= $setting->public_order_limit && ($setting->public_order_limit!=0 || $setting->public_order_limit!=null))--}}

                                {{--                        <button  class="btn btn-m w-100 btn-full rounded-l bg-green-c mr-auto ml-auto font-900 text mt-4" disabled>--}}
                                {{--                            إضافة طلب--}}
                                {{--                        </button>--}}
                                {{--                    @else--}}

                                <button type="submit" id="submit" class="btn btn-m w-100 btn-full rounded-l bg-green-c mr-auto ml-auto font-900 text mt-4">
                                    إضافة طلب
                                </button>
                                {{--                    @endif--}}
                            </form>
                    {{-- <div class="divider"></div> --}}
                    {{--                    <form action="{{url('order_eservice').'/'.$eservices->id}}" method="POST" role="form">--}}
                    {{--                    @csrf--}}
                    {{--                    @if(request()->has('provider_id'))--}}
                    {{--                    <input type="hidden" name="provider_id" value="{{request()->provider_id}}">--}}
                    {{--                    @endif--}}
                    {{--                    <input type="hidden" name="eservice_id" value="{{$eservices->id}}">--}}
                    {{--                    <input type="hidden" name="status" value="2">--}}
                    {{--                    <div class="input-style input-style-2 has-icon input-required">--}}
                    {{--                        <i class="fa input-icon fa-info"></i>--}}
                    {{--                        <span>تفاصيل الطلب</span>--}}
                    {{--                        <em>(مطلوب)</em>--}}
                    {{--                        <textarea class="textarea-height requiredField" required="required" name="details" cols="30"--}}
                    {{--                            rows="10"></textarea>--}}
                    {{--                    </div>--}}
                    {{--                    <div class="input-style input-style-2 has-icon input-required">--}}
                    {{--                        <i class="fa input-icon fa-gift"></i>--}}
                    {{--                        <span>كود الخصم</span>--}}
                    {{--                        <input type="text" class="form-control" name="coupon_code">--}}
                    {{--                    </div>--}}
                    {{--                    @if(!empty(auth()->user()))--}}
                    {{--                        @if(!is_null($agent = auth()->user()->agent))--}}
                    {{--                            <div>--}}
                    {{--                                <input id="checkbox-1" type="checkbox" value="1" name="agent">--}}
                    {{--                                <label for="checkbox-1">تنفيذ الطلب عن طريق الوكيل <b>{{$agent->getName()}}</b></label>--}}
                    {{--                            </div>--}}
                    {{--                        @endif--}}
                    {{--                    @endif--}}
                    {{--                    <button--}}
                    {{--                        class="btn btn-m w-100 btn-full rounded-l bg-yellow-c mr-auto ml-auto font-900 text mt-4">--}}
                    {{--                        @if(isset($net))--}}
                    {{--                            @if($net < 0)--}}
                    {{--                                الدفع الان--}}
                    {{--                            @else--}}
                    {{--                                الدفع بواسطة الرصيد--}}
                    {{--                            @endif--}}
                    {{--                        @else--}}
                    {{--                            تسجيل الدخول--}}
                    {{--                        @endif--}}
                    {{--                    </button>--}}
                    {{--                </form>--}}
            </div>
        </div>
        <div class="card card-overflow card-style">
            <div class="content">
                <div class="row">
                    <div class="col-md-6">
                        <span>عدد المشاهدات</span>
                        <span> {{$eservices->views}}</span>
                    </div>
                    <div class="col-md-6">
                        <span style="float: right;float: right;padding: 0px 0 0 10px;"> المهتمين </span>
                        <span>
                            @php
                                $count          = $eservices->providers()->count();
                                $favorites      = $eservices->providers()->orderBy('id','DESC')->limit(3)->get();
                            @endphp
                            <a href="{{route('supervisors',['service_id' => $eservices->id])}}">
                                @foreach($favorites as $favorite)
                                    <img src="{{ $favorite->getImage() }}" class="float-right border border-white bg-yellow-light rounded-circle  @if(!$loop->first) mr-n3 @endif" width="35" height="35">
                                @endforeach
                            </a>
                            @if ($count)
                                <a href="{{route('supervisors',['service_id' => $eservices->id])}}" class="float-right pt-1 pr-2 font-12">{{$count}} مهتم بهذه الخدمة</a>
                            @endif
                        </span>
                    </div>
                </div>
            </div>
        </div>
            @if($eservices->policies !='')
                <div class="card card-style">
                    <div class="accordion order-accordion" id="accordion-1">
                        <div class="mb-0">
                            <button class="btn accordion-btn" data-toggle="collapse" data-target="#collapse1" aria-expanded="true">
                                <i class="fa color-green-muamlah fa-clipboard"></i>
                                شروط و احكام
                                <i class="fa fa-plus font-10 accordion-icon rotate-180"></i>
                            </button>
                            <div id="collapse1" class="collapse" data-parent="#accordion-1" style="">
                                <div class="pt-1 pb-2 pl-3 pr-3">

                                    {!! $eservices->policies !!}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>


            @endif
        <div class="card card-overflow card-style">
            <div class="content">
                <div class="text-center">
                    <h3>التسويق بالعمولة </h3>
                </div>
                <div class="divider mt-3 mb-3"></div>
                <div class="d-flex">
                    شارك هذا الرابط الخاص بك , لتحصل على عمولة من اي طلب <a href="#" class="float-right pr-2" onclick="Copy('{{url()->full().'&affiliate_id='.Auth::id()}}');"> نسخ الرابط</a>
                </div>
            </div>
        </div>
        <div class="card card-overflow card-style">
            <div class="content">
                <div class="text-center">
                    <h3>شارك الخدمة </h3>
                </div>
                <div class="divider mt-3 mb-3"></div>
                <div class="d-flex">
                    <div class="flex-fill icon icon-xs text-center">
                        <a href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode(url()->full().'&affiliate_id='.Auth::id())}}" class="share-btn">
                            <i class="fab font-12 fa-facebook-f font-14 rounded-s bg-facebook"></i>
                        </a>
                    </div>
                    <div class="flex-fill icon icon-xs text-center">
                        <a href="https://twitter.com/intent/tweet?url={{ urlencode(url()->full().'&affiliate_id='.Auth::id())}}" class="share-btn">
                            <i class="fab font-12 fa-twitter bg-twitter rounded-s"></i>
                        </a>
                    </div>
                    <div class="flex-fill icon icon-xs text-center">
                        <a href="https://api.whatsapp.com/send?text={{ urlencode(url()->full().'&affiliate_id='.Auth::id())}}" class="share-btn">
                            <i class="fab font-12 fa-whatsapp bg-whatsapp rounded-s"></i>
                        </a>
                    </div>
                    <div class="flex-fill icon icon-xs text-center">
                        <a href="https://www.linkedin.com/shareArticle?mini=true&url={{ urlencode(url()->full().'&affiliate_id='.Auth::id())}}" class="share-btn">
                            <i class="fab font-12 fa-linkedin-in bg-linkedin rounded-s"></i>
                        </a>
                    </div>

                    {{--                    <a href="https://www.facebook.com/sharer.php?u={{ url()->full()  }}" rel="me" title="Facebook" target="_blank"><i class="fa facebook"></i></a>--}}
                    {{--                    <a href="https://twitter.com/share?url={{ url()->full() }}&text=test" rel="me" title="Twitter" target="_blank"><i class="fa twitter"></i></a>--}}
                    {{--                    <div class="addthis_inline_share_toolbox_2bxg"></div>--}}
                </div>
            </div>
        </div>


    </div>
@endsection
@section('script')
    <script>

        function Copy(text) {
            navigator.clipboard.writeText(text).then(() => {
                alert('تم نسخ الرابط')
            })
            // var $temp = $("<input>");
            // $("body").append($temp);
            // $temp.val(text).select();
            // document.execCommand("copy");
            // $temp.remove();
            // $("#copied").text("تم النسخ!").css('color','green');

        }

        $(".share-btn").click(function () {
            var token = "{{ csrf_token() }}";
            console.log(token);
            console.log(12);

            $.ajax({
                url: "{{route('shareCount')}}",
                data: {
                    eservice_id: "{{$eservices->id}}",
                    _token: token
                },
                type: "post",
            })
                .done(function (data) {

                })
                .fail(function (jqXHR, ajaxOptions, thrownError) {
                    alert('الرجاء المحاولة مرة اخرى');
                });
        });

        $("#form_add").submit(function(e) {
            $('#submit').attr('disabled',true);
            setTimeout(function(){$('#submit').attr('disabled',false);},30000);
        });
        function selectInput(enable, disable) {
            $('input[name=' + enable + ']').prop('readonly', false);
            $('input[name=' + disable + ']').prop('readonly', true);
        }
    </script>
@endsection
