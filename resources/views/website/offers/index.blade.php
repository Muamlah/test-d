@extends('website.layout')
@section('content')
<!-- Page Content-->
<div class="page-content header-clear-medium">
    @if (Session::get('hyperpay_success') )
    <div class="ml-3 mr-3 alert alert-small rounded-s shadow-xl bg-green1-dark" role="alert">
        <span><i class="fa fa-check"></i></span>
        <strong>{{Session::get('hyperpay_success')}}</strong>
        <button type="button" class="close color-white opacity-60 font-16" data-dismiss="alert" aria-label="Close">&times;</button>
    </div>
    @endif
        @if (Session::get('success') )
    <div class="ml-3 mr-3 alert alert-small rounded-s shadow-xl bg-green1-dark" role="alert">
        <span><i class="fa fa-check"></i></span>
        <strong>{{Session::get('success')}}</strong>
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
    <div class="card card-overflow card-style">
        <div class="content">
            <div class="d-flex">
                <div class="flex-grow-1">
                    <h1 class="font-30 mb-3">{{@$order->title}}</h1>
                </div>
                <div class="flex-shrink-1">
                    <strong class="
                                @if(@$order->status == 1)
                                    bg-gray2-dark
                                @elseif(@$order->status == 2)
                                    bg-green2-dark
                                @elseif(@$order->status == 3)
                                    bg-yellow1-dark
                                @elseif(@$order->status == 6)
                                    bg-red2-dark
                                @elseif(@$order->status == 7)
                                    bg-red3-light
                                @elseif(@$order->status == 5)
                                    bg-green1-dark
                                @elseif(@$order->status == 6)
                                    bg-highlight color-white
                                @endif
                                rounded-xs text-uppercase float-left
                                font-11 pr-2 pl-2 pb-1 pt-1 line-height-s">
                        @if(@$order->status == 2)
                        مفتوح
                        @else
                        {{$order->st->name}}
                        @endif
                    </strong>
                </div>
            </div>

            <div class="divider"></div>
            <h4>تفاصيل الطلب :</h4>
            <p>
                {{@$order->details}}!
            </p>
        </div>
    </div>
    <div class="card card-style bg-gradient-green3">
        <div class="content">
            <h3 class="color-white text-center font-18 mb-0">العروض المقدمة</h3>
        </div>
    </div>
    @forelse($offers as $offer)
    <div class="card card-overflow card-style">
        <div class="content mt-2">
            <div class="d-flex m-2">
                <div><img data-src="{{asset('public/template-muamlah/images/pictures/faces/1s.png')}}" src="{{asset('public/template-muamlah/images/empty.png')}}" class="ml-3 rounded-circle shadow-l preload-img" width="60"></div>
                <div>
                    <h3 class="mt-3 mb-0 font-700">
                        @if($offer->user->name == null)
                        {{@$offer->user->phone}}
                        @else
                        {{@$offer->user->name}}
                        @endif
                    </h3>
                </div>
                <div class="mr-auto mt-3">
                    <span>
                        @php
                        if (count(@$offer->user->avgReviews) >0)
                            $avg = round((@$offer->user->avgReviews[0]->quality_of_service + @$offer->user->avgReviews[0]->execution_speed + @$offer->user->avgReviews[0]->professionalism_in_dealing + @$offer->user->avgReviews[0]->communication + @$offer->user->avgReviews[0]->deal_with_him_again) /5 , 1);
                        else
                            $avg = 0;

                        @endphp
                        <span class="font-12">
                            @if( $avg == 0 )
                            <i class="fa fa-star font-12"></i><i class="fa fa-star font-12"></i><i class="fa fa-star font-12"></i><i class="fa fa-star font-12"></i><i class="fa fa-star font-12"></i>
                            @elseif ( $avg < 1 ) <i class="fa fa-star-half-alt font-12 color-yellow1-dark"></i><i class="fa fa-star font-12"></i><i class="fa fa-star font-12"></i><i class="fa fa-star font-12"></i><i class="fa fa-star font-12"></i>
                                @elseif ( $avg == 1 )
                                <i class="fa fa-star font-12 color-yellow1-dark"></i><i class="fa fa-star font-12"></i><i class="fa fa-star font-12"></i><i class="fa fa-star font-12"></i><i class="fa fa-star font-12"></i>
                                @elseif ( $avg < 2 ) <i class="fa fa-star font-12 color-yellow1-dark"></i><i class="fa fa-star-half-alt font-12 color-yellow1-dark"></i><i class="fa fa-star font-12"></i><i class="fa fa-star font-12"></i><i class="fa fa-star font-12"></i>
                                    @elseif ( $avg == 2 )
                                    <i class="fa fa-star font-12 color-yellow1-dark"></i><i class="fa fa-star font-12 color-yellow1-dark"></i><i class="fa fa-star font-12"></i><i class="fa fa-star font-12"></i><i class="fa fa-star font-12"></i>
                                    @elseif ( $avg < 3 ) <i class="fa fa-star font-12 color-yellow1-dark"></i><i class="fa fa-star font-12 color-yellow1-dark"></i><i class="fa fa-star-half-alt font-12 color-yellow1-dark"></i></i><i class="fa fa-star font-12"></i><i class="fa fa-star font-12"></i>
                                        @elseif ( $avg == 3 )
                                        <i class="fa fa-star font-12 color-yellow1-dark"></i><i class="fa fa-star font-12 color-yellow1-dark"></i><i class="fa fa-star font-12 color-yellow1-dark"></i><i class="fa fa-star font-12"></i><i class="fa fa-star font-12"></i>
                                        @elseif ( $avg < 4 ) <i class="fa fa-star font-12 color-yellow1-dark"></i><i class="fa fa-star font-12 color-yellow1-dark"></i><i class="fa fa-star font-12 color-yellow1-dark"></i><i class="fa fa-star-half-alt font-12 color-yellow1-dark"></i><i class="fa fa-star font-12"></i>
                                            @elseif ( $avg == 4 )
                                            <i class="fa fa-star font-12 color-yellow1-dark"></i><i class="fa fa-star font-12 color-yellow1-dark"></i><i class="fa fa-star font-12 color-yellow1-dark"></i><i class="fa fa-star font-12 color-yellow1-dark"></i><i class="fa fa-star font-12"></i>
                                            @elseif ( $avg < 5 ) <i class="fa fa-star font-12 color-yellow1-dark"></i><i class="fa fa-star font-12 color-yellow1-dark"></i><i class="fa fa-star font-12 color-yellow1-dark"></i><i class="fa fa-star font-12 color-yellow1-dark"></i><i class="fa fa-star-half-alt font-12 color-yellow1-dark"></i>
                                                @elseif ( $avg == 5 )
                                                <i class="fa fa-star font-12 color-yellow1-dark"></i><i class="fa fa-star font-12 color-yellow1-dark"></i><i class="fa fa-star font-12 color-yellow1-dark"></i><i class="fa fa-star font-12 color-yellow1-dark"></i><i class="fa fa-star font-12 color-yellow1-dark"></i>
                                                @endif
                        </span>
                        <span class="font-12"> {{number_format($avg, 1) }}</span>


                    </span>
                </div>
            </div>

            <div class="divider"></div>

            <div class="row">
                <div class="col-4">
                    <div class="mx-0 mb-3 text-center">
                        <h6 class="font-14 font-800 text-uppercase color-gray3-light">السعر</h6>
                        <h3 class="color-gray2-dark font-16 mb-0">{{@$offer->price}} ريال </h3>
                    </div>
                </div>
                <div class="col-4">
                    <div class="mx-0 mb-3 text-center">
                        <h6 class="font-14 font-800 text-uppercase color-gray3-light">
                            فترة الإنجاز
                        </h6>
                        <h3 class="color-gray2-dark font-16 mb-0">{{@$offer->duration}} أيام</h3>
                    </div>
                </div>
                <div class="col-4">
                    <div class="mx-0 mb-3 text-center">
                        <h6 class=" font-14 font-800 text-uppercase color-gray3-light">تاريخ الإنتهاء</h6>
                        <h3 class="color-gray2-dark font-16 mb-0">{{@$offer->deadline->format('d-m-Y')}}</h3>
                    </div>
                </div>
{{--                <div class="col-6">--}}
{{--                    <div class="mx-0 mb-3 text-center">--}}
{{--                        <h6 class="font-14 font-800 text-uppercase color-gray3-light">وقت الإنتهاء</h6>--}}
{{--                        <h3 class="color-gray2-dark font-16 mb-0">{{@$offer->deadline->format('h:i A')}} </h3>--}}
{{--                    </div>--}}
{{--                </div>--}}

            </div>
            <div class="divider"></div>
            @if($order->user_id == Auth::user()->id)
            <div class="row mb-0">
                <div class="col-12 pl-2 pr-2">
                    <form method="post" action="{{route('publicOrders.offers.acceptOffer',[$offer->id,$order->id])}}" enctype="multipart/form-data" class="form-horizontal" role="form">
                        {{ csrf_field() }}
                        <div class="input-style input-style-2 has-icon input-required">
                            <i class="fa input-icon fa-gift"></i>
                            <span>كود الخصم </span>
                            <input type="text" class="form-control" name="coupon_code">
                        </div>
                        <button class="btn w-100 btn-full btn-m font-900 text-uppercase rounded-l shadow-l bg-green-c">
                            قبول العرض
                        </button>
                    </form>
                </div>
            </div>
            @endif

        </div>
    </div>
    @empty
    <h4 class="text-center"> لا يوجد عروض</h4>
    @endforelse
</div>
<!-- End of Page Content-->
@endsection
