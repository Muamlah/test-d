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
            @include('admin.charts.numbers')
        </div>
    </div>
    <div class="col-lg-12 col-sm-12">
        <div class="pt-4 mt-5">
            @include('admin.include.filter')
        </div>
    </div>
    <div class="col-lg-12 col-sm-12">
        <div class="card card-custom pt-4 mt-5">
            @include('admin.charts.pie',['data' => $all_orders_growth_daily, 'title' => "الأيام النشطة", 'id' => "all_orders_growth_daily"])
        </div>
    </div>
    <div class="col-lg-12 col-sm-12">
        <div class="card card-custom pt-4 mt-5">
            @include('admin.charts.line_chart',['data' => $all_orders_growth_hourly, 'title' => 'الساعات النشطة', 'id' => "all_orders_growth_hourly", 'format' => 'H:i:s'])
        </div>
    </div>
    <div class="col-lg-6 col-sm-12">
        <div class="card card-custom pt-4 mt-5">
            @include('admin.charts.donut_chart',['data' => $users_by_types, 'title' => __('dashboard.users_by_types'), 'id' => "users_by_types"])
        </div>
    </div>
    <div class="col-lg-6 col-sm-12">
        <div class="card card-custom pt-4 mt-5">
            @include('admin.charts.pie',['data' => $orders_by_types, 'title' => __('dashboard.orders_by_types'), 'id' => "orders_by_types"])
        </div>
    </div>
{{--    <div class="col-lg-6 col-sm-12 mt-5">--}}
{{--        <div class="card card-custom pt-4 mt-5">--}}
{{--            @include('admin.charts.columns',['data' => $eservices_orders_by_status, 'title' => __('dashboard.eservices_orders_by_status'), 'id' => "eservices_orders_by_status"])--}}
{{--        </div>--}}
{{--    </div>--}}
    <div class="col-lg-6 col-sm-12 mt-5">
        <div class="card card-custom pt-4 mt-5">
            @include('admin.charts.columns',['data' => $public_orders_by_status, 'title' => __('dashboard.eservices_orders_by_status'), 'id' => "public_orders_by_status"])
        </div>
    </div>
    <div class="col-lg-6 col-sm-12 mt-5">
        <div class="card card-custom pt-4 mt-5">
            @include('admin.charts.columns',['data' => $private_orders_by_status, 'title' => __('dashboard.private_orders_by_status'), 'id' => "private_orders_by_status"])
        </div>
    </div>
{{--    <div class="col-lg-6 col-sm-12 mt-5">--}}
{{--        <div class="card card-custom pt-4 mt-5">--}}
{{--            @include('admin.charts.3d_cylinder_chart',['data' => $eservices_users, 'title' => __('dashboard.eservices_users'), 'id' => "eservices_users"])--}}
{{--        </div>--}}
{{--    </div>--}}
    <div class="col-lg-6 col-sm-12 mt-5">
        <div class="card card-custom pt-4 mt-5">
            @include('admin.charts.3d_cylinder_chart',['data' => $public_users, 'title' => __('dashboard.eservices_users'), 'id' => "public_users"])
        </div>
    </div>
    <div class="col-lg-6 col-sm-12 mt-5">
        <div class="card card-custom pt-4 mt-5">
            @include('admin.charts.3d_cylinder_chart',['data' => $private_users, 'title' => __('dashboard.private_users'), 'id' => "private_users"])
        </div>
    </div>
    <div class="col-lg-12 col-sm-12 mt-5">
        <div class="card card-custom pt-4 mt-5">
            @include('admin.charts.line_chart',['data' => $balances_last_3months, 'title' => __('dashboard.balances_last_3months',['total' => $total]), 'id' => "balances_last_3months"])
        </div>
    </div>
{{--    <div class="col-lg-12 col-sm-12 mt-5">--}}
{{--        <div class="card card-custom pt-4 mt-5">--}}
{{--            @include('admin.charts.columns',['data' => $most_requested_services, 'title' => __('dashboard.most_requested_services'), 'id' => "most_requested_services"])--}}
{{--        </div>--}}
{{--    </div>--}}
    {{-- <div class="col-lg-12 col-sm-12">
        <div class="card card-custom pt-4 mt-5">
            <div class="card-body">
                @include('admin.charts.table')
            </div>
        </div>
    </div> --}}
</div>

@endsection
