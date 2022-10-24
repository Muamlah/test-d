@extends('admin.layouts.adminLayout')
@section('title')
    طلبات التبليغ
@endsection

@section('headings')
    @include('admin.include.headings',[

        'title1'        => ' طلبات التبليغ',
        'link1'         => route('admin.reports_orders_list'),

    ])
@endsection

@section('breadcrumb')
    <ul class="breadcrumb breadcrumb-transparent breadcrumb-dot font-weight-bold p-0 my-2 font-size-sm">
        <li class="breadcrumb-item text-muted">
            <a href="{{route('admin.home')}}" class="text-muted">الرئيسية</a>
        </li>
        <li class="breadcrumb-item text-muted">
            طلبات التبليغ
        </li>
    </ul>
@endsection
@section('content')
    <div class="card card-custom">
        <div class="card-header flex-wrap py-3">
            <div class="card-title">
                <h3 class="card-label">قائمة طلبات التبليغ </h3>
            </div>
        </div>
        <div class="card-body">
            @include('admin.orders.table')
        </div>
    </div>
@endsection
@section('script')
    <script src="{{ asset('admin-file/assets/js/pages/crud/ktdatatable/base/pages.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/gh/jquery-form/form@4.3.0/dist/jquery.form.min.js" integrity="sha384-qlmct0AOBiA2VPZkMY3+2WqkHtIQ9lSdAsAn5RUJD/3vA5MKDgSGcdmIv4ycVxyn" crossorigin="anonymous"></script>
@endsection
