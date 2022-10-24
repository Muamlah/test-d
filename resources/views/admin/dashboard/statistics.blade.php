@extends('admin.layouts.adminLayout')
@section('content')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" integrity="sha512-iBBXm8fW90+nuLcSKlbmrPcLa0OT92xO1BIsZ+ywDWZCvqsWgccV3gFoRBv0z+8dLJgyAHIhR35VZc2oM/gI1w==" crossorigin="anonymous" referrerpolicy="no-referrer" />
<!-- Resources -->
<script src="https://cdn.amcharts.com/lib/4/core.js"></script>
<script src="https://cdn.amcharts.com/lib/4/charts.js"></script>
<script src="https://cdn.amcharts.com/lib/4/themes/animated.js"></script>

<div class="row">
    <div class="col-lg-12 col-sm-12">
        <div class="card card-custom pt-4 mt-5">
            @include('admin.charts.donut_chart',['data' => $most_ordered_services, 'title' => 'الخدمات الأكثر طلبا', 'id' => "most_ordered_services"])
        </div>
    </div>
    <div class="col-lg-12 col-sm-12">
        <div class="card card-custom pt-4 mt-5">
            @include('admin.charts.columns',['data' => $most_views_services, 'title' => 'الخدمات الأكثر زيارة', 'id' => "most_views_services"])
        </div>
    </div>
    <div class="col-lg-12 col-sm-12">
        <div class="card card-custom pt-4 mt-5">
            @include('admin.charts.columns',['data' => $most_shares_services, 'title' => 'الخدمات الأكثر مشاركة', 'id' => "most_shares_services"])
        </div>
    </div>
    <div class="col-lg-12 col-sm-12">
        <div class="card card-custom pt-4 mt-5">
            @include('admin.charts.columns',['data' => $most_searched_words, 'title' => 'الكلمات الأكثر بحثا', 'id' => "most_searched_words"])
        </div>
    </div>
    <div class="col-lg-12 col-sm-12">
        <div class="card card-custom pt-4 mt-5">
            @include('admin.charts.columns',['data' => $most_canceled_services, 'title' => 'الخدمات الأكثر إلغاء', 'id' => "most_canceled_services"])
        </div>
    </div>
    <div class="col-lg-12 col-sm-12">
        <div class="card card-custom pt-4 mt-5">
            @include('admin.charts.columns',['data' => $most_complete_services, 'title' => 'الخدمات الأكثر تسليم', 'id' => "most_complete_services"])
        </div>
    </div>
    <div class="col-lg-12 col-sm-12">
        <div class="card card-custom pt-4 mt-5">
            @include('admin.charts.columns',['data' => $most_report_services, 'title' => 'الخدمات الأكثر بلاغ', 'id' => "most_report_services"])
        </div>
    </div>
    
@endsection
