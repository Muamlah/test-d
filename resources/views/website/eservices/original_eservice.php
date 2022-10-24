@extends('website.layout')

@section('content')






        <div class="page-content header-clear-medium">

            <div class="card card-style bg-grey-c card-order" data-card-height="130">
                <div class="card-center text-center mr-3">
                    <h1 class="color-white mb-0">الخدمات الإلكترونية</h1>
                    <p class="color-white mt-1 mb-0">إختر الجهة ثم أطلب الخدمة المناسبة</p>
                </div>
            </div>



                   @if(session()->has('error'))


            <div class="alert mr-3 ml-3 rounded-s bg-red2-dark " role="alert">
                <span class="alert-icon"><i class="fa fa-times-circle font-18"></i></span>
                <h4 class="text-uppercase color-white"> {{ session()->get('error') }}</h4>
                <button type="button" class="close color-white opacity-60 font-16" data-dismiss="alert" aria-label="Close">&times;</button>
            </div>

                   @endif

                   @if(session()->has('success'))


            <div class="ml-3 mr-3 alert alert-small rounded-s shadow-xl bg-green1-dark" role="alert">
                <span><i class="fa fa-check"></i></span>
                <strong>{{ session()->get('success') }}</strong>
                <button type="button" class="close color-white opacity-60 font-16" data-dismiss="alert" aria-label="Close">&times;</button>
            </div>
            

                   @endif

            <div class="search-box search-header bg-theme card-style mr-3 ml-3">
                <form action="">
                    <button type="submit" class="search-btn" style="position: absolute; border: transparent;"><i class="fa fa-search"></i></button>
                    <input type="text" class="border-0" placeholder="البحث عن الخدمات " style="padding-right: 55px;" data-search="">
                    <a href="#" class="disabled"><i class="fa fa-times-circle color-red2-dark"></i></a>
                </form>
            </div>
            <div class="f-slider owl-carousel owl-no-dots owl-rtl owl-loaded owl-drag">

            @foreach($sections as $r)
                <div class="card card-style card-services" style="
                background-image:url('{{asset('public/storage').'/'.$r->img}}');"
                    data-card-height="150">
                    <a href="{{url('section'.'/'.$r->id)}}" class="link-cover"></a>
                </div>
            @endforeach

            </div>

            <?php

            ?>

            @foreach($eservices as $r)
            <div class="card card-style">
                <div class="content">
                    <div class="d-flex mb-4">
                        <div class="align-self-center">
                            <span class="icon icon-xxl rounded-m me-3"><img src="{{asset('public/storage/').'/'.$r->img}}"
                                    width="80" class="rounded-sm"></span>
                        </div>
                        <div class="align-self-center w-100 mr-2">
                            <h4>{{$r->service_name}}
                                <strong
                                    class="bg-green2-dark rounded-xs text-uppercase float-left font-11 pr-2 pl-2 pb-1 pt-1 line-height-s">{{$r->price}}
                                    ريال</strong>
                            </h4>
                            <p class="mb-0 opacity-60 line-height-s font-14">
                                {{$r->details}}
                            </p>
                        </div>
                    </div>
                    <div class="divider mb-2 mt-n2"></div>
                    <div class="row mb-n2 text-center">
                        <div class="col-12">
                            <a href="{{url('eservices'.'/'.$r->id)}}"
                                class="color-yellow1-dark text-uppercase font-800 font-14 opacity-90">
                                أطلب الخدمة
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <?php
            $last_id = $r->id;
            ?>
            @endforeach


        <!--    <p>&nbsp;</p>

            <div style="position: absolute;

left: 50%;
transform: translate(-50%, -50%);
">
            {{ $eservices }}
            </div> -->

<div id="my_eservices">

</div>


            <div id="more_button" class="content shadow-l mb-0">
                <a href="#" onclick="get_eservices('<?php echo $last_id ?>');  return false;" class="btn btn-full btn-m rounded-s mb-3 mt-4 font-900 text-uppercase bg-grey-c">
                    المزيد</a>
            </div>


        </div>


@endsection
















