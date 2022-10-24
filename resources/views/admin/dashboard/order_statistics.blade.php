@extends('admin.layouts.adminLayout')

@section('headings')
    @include('admin.include.headings',[

        'title1'        => ' الرئيسية',
        'link1'         => route('admin.home'),

    ])
@endsection

@section('content')
<style>
    table{
        width: 100% !important;
    }
</style>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" integrity="sha512-iBBXm8fW90+nuLcSKlbmrPcLa0OT92xO1BIsZ+ywDWZCvqsWgccV3gFoRBv0z+8dLJgyAHIhR35VZc2oM/gI1w==" crossorigin="anonymous" referrerpolicy="no-referrer" />
<!-- Resources -->
<script src="https://cdn.amcharts.com/lib/4/core.js"></script>
<script src="https://cdn.amcharts.com/lib/4/charts.js"></script>
<script src="https://cdn.amcharts.com/lib/4/themes/animated.js"></script>
<script src="https://cdn.amcharts.com/lib/4/themes/material.js"></script>

<div class="row">
    <div class="col-lg-12 col-sm-12">
        <div class="pt-4 mt-5">
            @include('admin.include.filter')
        </div>
    </div>
    <div class="col-lg-6 col-sm-12">
        <div class="card card-custom pt-4 mt-5">
            @include('admin.charts.donut_chart',['data' => $_total_orders, 'title' =>"نسبة الطلبات المنجزة والملغاة", 'id' => "_total_orders"])
        </div>
    </div>
    <div class="col-lg-6 col-sm-12">
        <div class="card card-custom pt-4 mt-5">
            @include('admin.charts.donut_chart',['data' => $_public_orders, 'title' =>"نسبة طلبات الخدمات الإلكترونية المنجزة والملغاة", 'id' => "_public_orders"])
        </div>
    </div>
    <div class="col-lg-6 col-sm-12">
        <div class="card card-custom pt-4 mt-5">
            @include('admin.charts.donut_chart',['data' => $_private_orders, 'title' =>"نسبة طلبات التعميد الخاص المنجزة والملغاة", 'id' => "_private_orders"])
        </div>
    </div>
{{--    <div class="col-lg-6 col-sm-12">--}}
{{--        <div class="card card-custom pt-4 mt-5">--}}
{{--            @include('admin.charts.donut_chart',['data' => $_eservices_orders, 'title' =>"نسبة طلبات الخدمات الإلكترونية المنجزة والملغاة", 'id' => "_eservices_orders"])--}}
{{--        </div>--}}
{{--    </div>--}}
</div>

@endsection
