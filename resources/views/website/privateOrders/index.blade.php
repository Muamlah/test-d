@extends('website.layout')

@section('content')


<!-- Page Content-->
<!-- Page Content-->
<div class="page-content header-clear-medium">
    <div class="card card-style bg-grey-c card-order" data-card-height="130">
        <div class="card-center text-center mr-3">
            <h1 class="color-white mb-0">طلباتي</h1>
            <p class="color-white mt-n1 mb-0">الطلبات التي قمت بها</p>
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
    <div class="card card-style">
        <div class="accordion order-accordion" id="accordion-1">
            <div class="mb-0">
                <button class="btn accordion-btn" data-toggle="collapse" data data-target="#collapse1"
                        aria-expanded="true">
                    <i class="fa fa fa-box-open"></i>
                    طلباتي
                    <i class="fas fa-sliders-h font-14 accordion-icon"></i>
                </button>
                <div id="collapse1" class="collapse border-top" data-parent="#accordion-1" style="">
                    <div class="pt-1 pb-2 pl-3 pr-3">
                        @foreach($order_status as $status)
                        <div class="fac fac-checkbox"><span></span>
                            <input id="box1-fac-checkbox-{{$status->id}}" class="filter" type="checkbox" value="{{$status->id}}">
                            <label for="box1-fac-checkbox-{{$status->id}}">{{$status->name}}</label>
                        </div>
                       @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="card card-style bg-theme pb-0">
        <div class="content">
            <div class="tab-controls tabs-round tab-animated tabs-medium tabs-rounded shadow-xl"
                 data-tab-items="2" data-tab-active="bg-green-muamlah color-white">
                {{-- <a href="#" data-tab="tab-orders-private">طلبات التعميد الخاص</a> --}}
                <a href="#" data-tab="tab-orders-public">طلبات التعميد</a>
                <a href="#" data-tab-active data-tab="tab-eservices">طلبات الخدمات الإلكترونية</a>
            </div>
            <div class="clearfix mb-3"></div>
            <div class="tab-content" id="tab-eservices">
                <div class="pt-2">
                    <div id="eservices">
                        @include('website.eservices_orders.ajax-view.data')
                    </div>
                    <div class="content shadow-l mb-0 ml-0 mr-0">
                        <a data-page="1" data-link="{{route('eServicesOrder.seeMore')}}" data-div="#eservices" href="#"  class="see-more btn btn-full btn-plus shadow-l m-auto btn-m rounded-s mb-3 mt-4 font-900 text-uppercase bg-grey-c">
                            المزيد</a>

                    </div>
                </div>
            </div>
            {{-- <div class="tab-content" id="tab-orders-private">
                <div class="pt-2">
                    <div  id="privateOrder">
                        @include('website.privateOrders.ajax-view.data')
                    </div>
                    <div  class="content shadow-l mb-0 ml-0 mr-0">
                        <a data-page="1" data-link="{{route('privateOrder.seeMore')}}" data-div="#privateOrder" href="#"  class="see-more btn btn-full btn-plus shadow-l m-auto btn-m rounded-s mb-3 mt-4 font-900 text-uppercase bg-grey-c">
                            المزيد</a>

                    </div>

                </div>
            </div> --}}
            <div class="tab-content" id="tab-orders-public">
                <div class="pt-2">
                    <div  id="publicOrder">
                        @include('website.orders.ajax-view.data')
                    </div>
                    <div  class="content shadow-l mb-0 ml-0 mr-0">
                        <a data-page="1" data-link="{{route('publicOrders.seeMore')}}" data-div="#publicOrder" href="#"  class="see-more btn btn-full btn-plus shadow-l m-auto btn-m rounded-s mb-3 mt-4 font-900 text-uppercase bg-grey-c">
                            المزيد</a>

                    </div>

                </div>
            </div>

        </div>

    </div>
</div>
@endsection
@section('script')
    <script>
        $(".see-more").click(function() {
            var filter = [];
            $('.filter:checked').each(function () {
                filter.push(this.value);
            });
            let div = $($(this).data('div')); //div to append
            let link = $(this).data('link'); //current URL
            let page = $(this).data('page'); //get the next page #
            // alert(page)
            let thisSeeMore =$(this);
            console.log(page);
            let href = link + '?page='+ page; //complete URL
            $.ajax(
                {
                    url:   href,
                    type: "get",
                    data: {
                        filter:filter
                    },
                    beforeSend: function()
                    {
                        thisSeeMore.html('جاري التحميل....');
                    }
                })
                .done(function(data)
                {
                    if(data.html == ""){
                            thisSeeMore.html('لا يوجد المزيد');
                        setTimeout(function(){
                            thisSeeMore.hide();
                        },1000);
                        return;
                    }
                    thisSeeMore.data('page',page + 1); //update page #
                    $(data.html).hide().appendTo(div).show(1000);
                    thisSeeMore.html('المزيد');
                })
                .fail(function(jqXHR, ajaxOptions, thrownError)
                {
                    alert('الرجاء المحاولة مرة اخرى');
                });
        });

        $('.filter').change(function(){
            $('.filter').prop("disabled", true);
            setTimeout(function(){
                $('.filter').prop("disabled", false);
            },2000);
            // $('#privateOrder').html('');
            $('#publicOrder').html('');
            $('#eservices').html('');
            $(".see-more").data('page', 1);
            $(".see-more").click();

        });
        $(".see-more").click();
    </script>

@endsection
