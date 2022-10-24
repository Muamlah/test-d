@extends('admin.layouts.adminLayout')
@section('title')
    قائمة المستخدمين اصحاب تقرير الإبلاغ
@endsection
@section('breadcrumb')
    <ul class="breadcrumb breadcrumb-transparent breadcrumb-dot font-weight-bold p-0 my-2 font-size-sm">
        <li class="breadcrumb-item text-muted">
            <a href="{{route('admin.home')}}" class="text-muted">الرئيسية</a>
        </li>
        <li class="breadcrumb-item text-muted">
            ادارة المستخدمين
        </li>
        <li class="breadcrumb-item text-muted">
            قائمة المستخدمين اصحاب تقرير الإبلاغ
        </li>
    </ul>
@endsection

@section('headings')
    @include('admin.include.headings',[

        'title1'        => ' قائمة المستخدمين اصحاب تقرير الإبلاغ',
        'link1'         => route('admin.indexUser'),

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

                            <div class="col-md-4 my-2 my-md-0">
                                <div class="form-group">
                                    <label>الاسم </label>
                                    <input type="text" id="kt_datatable_user_name" class="form-control" placeholder="الاسم">
                                </div>
                            </div>

                            <div class="col-md-4 my-2 my-md-0">
                                <div class="form-group">
                                    <label>رقم الهاتف</label>
                                    <input type="text"  id="kt_datatable_user_phone" class="form-control" placeholder="رقم الهاتف"/>
                                </div>
                            </div>

                            <div class="col-md-4 my-2 my-md-0">
                                <div class="form-group">
                                    <label>البريد الإلكتروني</label>
                                    <input type="text"  id="kt_datatable_user_email" class="form-control" placeholder="البريد الإلكتروني"/>
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
                <h3 class="card-label">قائمة المستخدمين اصحاب تقرير الإبلاغ </h3>
            </div>
        </div>
        <div class="card-body">
            <div class="datatable datatable-bordered datatable-head-custom" id="kt-users"></div>
        </div>
    </div>

@endsection


@section('script')
    <script src="{{ asset('admin-file/assets/js/pages/crud/ktdatatable/base/report-users.js') }}"></script>
@endsection