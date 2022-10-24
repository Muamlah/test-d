@extends('admin.layouts.adminLayout')
@section('title')
محفظة المنصة
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
        محفظة المنصة
    </li>
</ul>
@endsection

@section('headings')
    @include('admin.include.headings',[

        'title1'        => ' محفظة المنصة',
        'link1'         => route('admin.wallet'),

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
                                <label>إظهار نتائج </label>
                                <select style="padding: 0 5px" class="form-control" id="kt_datatable_search_period">
                                    <option value="all_days">الكل</option>
                                    <option value="tody">اليوم</option>
                                    <option value="week">أسبوع</option>
                                    <option value="month">شهر</option>
                                    <option value="year">سنة</option>
                                </select>
                            </div>
                        </div>

                        <div class="col-md-4 my-2 my-md-0">
                            <div class="form-group">
                                <label>التاريخ من</label>
                                <input type="date" id="kt_datatable_date_from" class="form-control" placeholder="التاريخ من">
                            </div>
                        </div>
                        <div class="col-md-4 my-2 my-md-0">
                            <div class="form-group">
                                <label>التاريخ إلى</label>
                                <input type="date" id="kt_datatable_date_to" class="form-control" placeholder="التاريخ إلى">
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
            <h3 class="card-label">محفظة المنصة </h3>
        </div>

        <div class="card-toolbar">
            <a id="xls-wallet" style="float:left" href="{{ route('admin.wallet.export',['type'=>'xls']) }}">
                <img src="{{ @asset("/template-muamlah/images/icons/xls.svg") }}" style="width:30px; height:30px;">
            </a>
            <a id="pdf-wallet" style="float:left" href="{{ route('admin.wallet.export',['type'=>'pdf']) }}">
                <img src="{{ @asset("/template-muamlah/images/icons/pdf.svg") }}" style="width:30px; height:30px; ">
            </a>
        </div>
    </div>
    <div class="card-body">
        <div class="datatable datatable-bordered datatable-head-custom" id="kt-wallet"></div>
    </div>
</div>

@endsection
@section('script')
<script src="{{ asset('admin-file/assets/js/pages/crud/ktdatatable/base/wallet.js') }}"></script>
@endsection
