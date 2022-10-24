@extends('admin.layouts.adminLayout')
@section('content')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" integrity="sha512-iBBXm8fW90+nuLcSKlbmrPcLa0OT92xO1BIsZ+ywDWZCvqsWgccV3gFoRBv0z+8dLJgyAHIhR35VZc2oM/gI1w==" crossorigin="anonymous" referrerpolicy="no-referrer" />
<!-- Resources -->
<script src="https://cdn.amcharts.com/lib/4/core.js"></script>
<script src="https://cdn.amcharts.com/lib/4/charts.js"></script>
<script src="https://cdn.amcharts.com/lib/4/themes/animated.js"></script>

<div class="row">
    <div class="col-lg-12 col-sm-12">
        <div class="pt-4 mt-5">
            @include('admin.charts.numbers2')
        </div>
    </div>
    <div class="col-lg-12 col-sm-12 mt-5">
        <div class="card card-custom pt-4 mt-5">
            @include('admin.charts.line_chart',['data' => $users_growth_last_month, 'title' => 'نمو العملاء اليومي لأخر شهر', 'id' => "users_growth_last_month"])
        </div>
    </div>
    <div class="col-lg-12 col-sm-12 mt-5">
        <div class="card-counter primary">
            <i class="fas fa-users"></i>
        <span class="count-numbers">{{$users_growth_day['value']}}</span>
        <span class="count-name">أكثر يوم شهد نمو في عدد العملاء لأخر شهر كان في تاريخ {{$users_growth_day['date']}}</span>
        </div>
    </div>
    <div class="col-lg-12 col-sm-12 mt-5">
        <div class="card card-custom pt-4 mt-5">
            @include('admin.charts.line_chart',['data' => $providers_growth_last_month, 'title' => 'نمو مقدمي الخدمات اليومي لأخر شهر', 'id' => "providers_growth_last_month"])
        </div>
    </div>
    <div class="col-lg-12 col-sm-12 mt-5">
        <div class="card-counter danger">
            <i class="fas fa-users"></i>
        <span class="count-numbers">{{$providers_growth_day['value']}}</span>
        <span class="count-name">أكثر يوم شهد نمو في عدد مقدمي الخدمات لأخر شهر كان في تاريخ {{$providers_growth_day['date']}}</span>
        </div>
    </div>
    <div class="col-lg-12 col-sm-12 mt-5">
        <div class="card card-custom pt-4 mt-5">
            @include('admin.charts.line_chart',['data' => $eservices_growth_last_month, 'title' => 'نمو طلبات الخدمات الإلكترونية اليومي لأخر شهر', 'id' => "eservices_growth_last_month"])
            @include('admin.charts.line_chart',['data' => $public_orders_growth_last_month, 'title' => 'نمو الطلبات العامة اليومي لأخر شهر', 'id' => "public_orders_growth_last_month"])
            @include('admin.charts.line_chart',['data' => $private_orders_growth_last_month, 'title' => 'نمو الطلبات الخاصة اليومي لأخر شهر', 'id' => "private_orders_growth_last_month"])
        </div>
    </div>
    <div class="col-lg-12 col-sm-12 mt-5">
        <div class="card-counter success">
            <i class="fas fa-handshake"></i>
        <span class="count-numbers">{{$orders_growth_day['value']}}</span>
        <span class="count-name">أكثر يوم شهد نمو في عدد الطلبات لأخر شهر كان في تاريخ {{$orders_growth_day['date']}}</span>
        </div>
    </div>

    <div class="col-lg-12 col-sm-12 mt-5">
        <div class="card card-custom pt-4 mt-5">
            @include('admin.charts.line_chart',['data' => $eservices_growth_hourly, 'title' => 'نمو طلبات الخدمات الإلكترونية خلال اليوم', 'id' => "eservices_growth_hourly", 'format' => 'H:i:s'])
            @include('admin.charts.line_chart',['data' => $public_orders_growth_hourly, 'title' => 'نمو الطلبات العامة خلال اليوم', 'id' => "public_orders_growth_hourly", 'format' => 'H:i:s'])
            @include('admin.charts.line_chart',['data' => $private_orders_growth_hourly, 'title' => 'نمو الطلبات الخاصة خلال اليوم', 'id' => "private_orders_growth_hourly", 'format' => 'H:i:s'])
        </div>
    </div>
@endsection
