
@extends('admin.layouts.adminLayout')
@section('title')
    قائمة المشرفين
@endsection
@section('breadcrumb')
    <ul class="breadcrumb breadcrumb-transparent breadcrumb-dot font-weight-bold p-0 my-2 font-size-sm">
        <li class="breadcrumb-item text-muted">
            <a href="{{route('admin.home')}}" class="text-muted">الرئيسية</a>
        </li>
        <li class="breadcrumb-item text-muted">
            ادارة المشرفين        </li>
    </ul>
@endsection

@section('headings')
    @include('admin.include.headings',[

        'title1'        => ' قائمة المشرفين',
        'link1'         => route('admin.admins.index'),

    ])
@endsection


@section('content')
    <div class="card card-custom" style="padding: 20px;margin-bottom:30px">
        <div class="accordion accordion-toggle-arrow" id="accordionExample1">
            <div class="card">
                <div class="card-header">
                    <div class="card-title collapsed" data-toggle="collapse" data-target="#collapseOne1" aria-expanded="false">
                        بحث متقدم
                    </div>
                </div>
                <div id="collapseOne1" class="collapse" data-parent="#accordionExample1" style="">
                    <div class="card-body">

                        <div class="input-icon">
                            <input type="text" class="form-control" placeholder="اكتب للبحث" id="kt_datatable_search_query" />
                            <span>
                                <i class="flaticon2-search-1 text-muted"></i>
                            </span>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="card card-custom">
        <div class="card-header flex-wrap py-3">
            <div class="card-title">
                <h3 class="card-label">قائمة المشرفين</h3>
            </div>
            <div class="card-toolbar">
                <!--begin::Dropdown-->
                <!--end::Dropdown-->
                <!--begin::Button-->
                <a class="btn btn-primary" href="{{route('admin.admins.create')}}">
                    <i class="flaticon2-plus"></i>
                    اضافة</a>
            <!--end::Button-->
            </div>
        </div>
        <div class="card-body">
        <div class="datatable datatable-bordered datatable-head-custom" id="kt-admins"></div>

        </div>
    </div>

@endsection
@section('script')
    <script src="{{ asset('/admin-file/assets/js/pages/crud/ktdatatable/base/admins.js') }}"></script>
@endsection


