@extends('admin.layouts.adminLayout')
@section('title')
    سجل العميل
@endsection
@section('breadcrumb')
    <ul class="breadcrumb breadcrumb-transparent breadcrumb-dot font-weight-bold p-0 my-2 font-size-sm">
        <li class="breadcrumb-item text-muted">
            <a href="{{route('admin.home')}}" class="text-muted">الرئيسية</a>
        </li>
        <li class="breadcrumb-item text-muted">
            ادارة السجلات
        </li>
        <li class="breadcrumb-item text-muted">
            سجل العميل
        </li>
    </ul>
@endsection

@if($user->level == 'user')
    @section('headings')
        @include('admin.include.headings',[

            'title1'        => ' قائمة العملاء',
            'link1'         => route('admin.indexUser'),
            'title2'        => 'سجل العميل',
            'link2'         => 'javascript:;',

        ])
    @endsection
@else
    @section('headings')
        @include('admin.include.headings',[

            'title1'        => ' مقدمي الخدمات',
            'link1'         => route('admin.indexProvider'),
            'title2'        => 'سجل مقدم الخدمة',
            'link2'         => 'javascript:;',

        ])
    @endsection
@endif

@section('content')
    <div class="card card-custom">
        <div class="card-header flex-wrap py-3">
            <div class="card-title">
                <h3 class="card-label">سجل العميل </h3>
            </div>
            @if($user->level == 'user')
                <div class="card-toolbar">
                    <a class="btn btn-success mr-2" href="{{route('admin.indexUser')}}">
                        العملاء
                    </a>
                </div>
            @else
                <div class="card-toolbar">
                    <a class="btn btn-success mr-2" href="{{route('admin.indexProvider')}}">
                        مقدمي الخدمات
                    </a>
                </div>
            @endif
        </div>
        <div class="card-body">

            <div class="datatable datatable-bordered datatable-head-custom" id="kt-user-log"></div>
            <!--end: Datatable-->
        </div>
    </div>

@endsection


@section('script')
    <script src="{{ asset('admin-file/assets/js/pages/crud/ktdatatable/base/user_log.js') }}"></script>
@endsection
