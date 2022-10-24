@extends('admin.layouts.adminLayout')
@section('title')
    طلبات سحب الرصيد
@endsection
@section('breadcrumb')
    <ul class="breadcrumb breadcrumb-transparent breadcrumb-dot font-weight-bold p-0 my-2 font-size-sm">
        <li class="breadcrumb-item text-muted">
            <a href="{{route('admin.home')}}" class="text-muted">الرئيسية</a>
        </li>
        <li class="breadcrumb-item text-muted">
            ادارة الطلبات
        </li>
        <li class="breadcrumb-item text-muted">
            طلبات سحب الرصيد
        </li>
    </ul>
@endsection

@section('headings')
    @include('admin.include.headings',[

        'title1'        => ' طلبات سحب الرصيد',
        'link1'         => route('admin.balance_requests'),

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
                        <div class="row align-items-center">
                            <div class="col-md-3 my-2 my-md-0">
                                <div class="form-group">
                                    <label>رقم الهاتف </label>
                                    <input type="number" id="kt_datatable_phone" class="form-control" placeholder="رقم الهاتف">
                                </div>
                            </div>
                            <div class="col-md-3 my-2 my-md-0">
                                <div class="form-group">
                                    <label>الاسم </label>
                                    <input type="text" id="kt_datatable_name" class="form-control" placeholder="الاسم">
                                </div>
                            </div>
                            <div class="col-md-3 my-2 my-md-0">
                                <div class="form-group">
                                    <label>من تاريخ </label>
                                    <input type="date" class="form-control kt_datatable_date_from" placeholder="من تاريخ">
                                </div>
                            </div>
                            <div class="col-md-3 my-2 my-md-0">
                                <div class="form-group">
                                    <label>إلى تاريخ </label>
                                    <input type="date"  id="kt_datatable_date_to" class="form-control" placeholder="إلى تاريخ">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="card card-custom">
        <div class="card-header flex-wrap py-3">
            <div class="card-title">
                <h3 class="card-label">طلبات سحب الرصيد </h3>
            </div>
            <div class="card-toolbar">
                    <!--begin::Dropdown-->
                    <!--end::Dropdown-->
                    <!--begin::Button-->
{{--                    <a class="btn btn-primary" href="{{route('admin.admins.create')}}">--}}
{{--                        <i class="flaticon2-plus"></i>--}}
{{--                        اضافة</a>--}}
                    <!--end::Button-->
            </div>
        </div>
        <div class="card-body">
            <!--begin::Search Form-->
            <div class="mb-7">
                <div class="row align-items-center">
                    <div class="col-lg-12 col-xl-12">
                        <div class="row align-items-center">

                        </div>
                    </div>
                </div>
            </div>
            <!--end: Search Form-->
            <!--begin: Datatable-->
            <div class="datatable datatable-bordered datatable-head-custom" id="kt-balance"></div>
            <!--end: Datatable-->
        </div>
    </div>

@endsection
@section('script')
    <script src="{{ asset('admin-file/assets/js/pages/crud/ktdatatable/base/balance.js') }}"></script>
@endsection
