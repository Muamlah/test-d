@extends('website.layout')
@include('website.meta.meta', [
    'options' => [
        'title'     	=> 'منصة معاملة . كوم',
        'sub_title' 	=> $eservices->service_name,
        'description' 	=> $eservices->details,
        'image'         => asset('public/storage/').'/'.$eservices->img,
          'url' 	    => url()->current(),
    ],
])
@include('website.meta.google', [
    'options' => [
        'title'     	=> 'منصة معاملة . كوم',
        'sub_title' 	=> $eservices->service_name,
        'description' 	=> $eservices->details,
        'image'         => asset('public/storage/').'/'.$eservices->img,
          'url' 	    => url()->current(),
    ],
])
@include('website.meta.facebook', [
    'options' => [
        'sub_title' 	=> $eservices->service_name,
        'description' 	=> $eservices->details,
        'image'         => asset('public/storage/').'/'.$eservices->img,
        'keywords' 	    => $eservices->details,
        'url' 	    => url()->current(),
    ],
])
@include('website.meta.twitter', [
    'options' => [
        'title'     	=> 'منصة معاملة . كوم',
        'sub_title' 	=> $eservices->service_name,
        'description' 	=> $eservices->details,
        'image'         => asset('public/storage/').'/'.$eservices->img,
          'url' 	    => url()->current(),
    ],
])
@section('style')
<style>
    .a2a_default_style a{
        margin: 0 80px !important
    }
    .a2a_s__default{
        padding: 8px !important;
    }
    .a2a_svg{
        width: 38px !important;
        height: 38px !important;
    }
    .a2a_kit .a2a_svg {
        margin: auto;
        border-radius: 8px !important;
    }
    .a2a_default_style .a2a_count, .a2a_default_style .a2a_svg, .a2a_floating_style .a2a_svg, .a2a_menu .a2a_svg, .a2a_vertical_style .a2a_count, .a2a_vertical_style .a2a_svg{
        border-radius: 7px !important;
    }
</style>
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
                    <div class="flex-shrink-1">
                        <h1 class="font-20">
                            {{$eservices->price}}
                            <span class="font-12">ريال</span>
                        </h1>
                    </div>
                </div>

                <p>
                    <strong>تفاصيل الخدمة</strong><br>
                    {{$eservices->details}}
                </p>

                <form action="{{route('eservices_orders.addPricePost')}}" method="POST" role="form">
                    @csrf
                    @if(request()->has('provider_id'))
                        <input type="hidden" name="provider_id" value="{{request()->provider_id}}">
                    @endif
                    <input type="hidden" name="eservice_id" value="{{$eservices->id}}">
                    <input type="hidden" name="order_id" value="{{$eservices_order->id}}">
                    <div class="input-style input-style-2 has-icon input-required">
                        <i class="fa input-icon fa-info"></i>
                        <span class="input-style-1-active focus-act input-style-1-inactive">تفاصيل الطلب</span>
                        <textarea class="textarea-height requiredField" required="required" name="details" cols="30"
                            rows="10">{{$eservices_order->details}}</textarea>
                    </div>
                    <div class="input-style input-style-2 has-icon input-required">
                        <i class="fa input-icon fa-gift"></i>
                        <span>المبلغ المراد اضافتة</span>
                        <input required type="number" class="form-control" name="price">
                    </div>

                    <button
                        class="btn btn-m w-100 btn-full rounded-l bg-yellow-c mr-auto ml-auto font-900 text mt-4">
                        @if($net < 0)
                            دفع
                        @else
                            الدفع بواسطة الرصيد
                        @endif
                    </button>
                </form>
            </div>
        </div>
    </div>
@endsection
