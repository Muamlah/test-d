@extends('admin.layouts.adminLayout')
@section('title')
    قائمة طلبات التعميد الخاص
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
            قائمة طلبات التعميد الخاص
        </li>
    </ul>
@endsection

@section('headings')
    @include('admin.include.headings',[

        'title1'        => ' طلبات التعميد الخاص',
        'link1'         => route('admin.private_orders'),

    ])
@endsection

<style>
    .nav-tabs .nav-link{
        padding: 13px !important;
    }
</style>
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
                                    <label>الحالة </label>
                                    <select style="padding: 0 5px" class="form-control" id="kt_datatable_search_status">
                                        <option value="">كل الحالات</option>
                                        @foreach($status as $item)
                                            <option value="{{$item->id}}">{{$item->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-3 my-2 my-md-0">
                                <div class="form-group">
                                    <label>حالةالدفع </label>
                                    <select style="padding: 0 5px" class="form-control" id="kt_datatable_search_type">
                                        <option value="">كل حالات الدفع</option>
                                        <option value="processing_convert">بانتظار التحويل</option>
                                        <option value="complete_convert">تم الدفع</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-3 my-2 my-md-0">
                                <div class="form-group">
                                    <label>من قيمة </label>
                                    <input type="number" id="kt_datatable_amount_from" class="form-control" placeholder="من قيمة">
                                </div>
                            </div>
                            <div class="col-md-3 my-2 my-md-0">
                                <div class="form-group">
                                    <label>إلى قيمة </label>
                                    <input type="number"  id="kt_datatable_amount_to" class="form-control" placeholder="إلى قيمة"/>
                                </div>
                            </div>
                            <div class="col-md-3 my-2 my-md-0">
                                <div class="form-group">
                                    <label>من تاريخ </label>
                                    <input type="date" class="form-control kt_datatable_date_from" placeholder="من تاريخ">
                                    {{-- <input type="text" class="form-control kt_datatable_date_from" id="kt_datepicker_1" placeholder="من تاريخ"/> --}}
                                </div>
                            </div>
                            <div class="col-md-3 my-2 my-md-0">
                                <div class="form-group">
                                    <label>إلى تاريخ </label>
                                    <input type="date"  id="kt_datatable_date_to" class="form-control" placeholder="إلى تاريخ">
                                </div>
                            </div>
                            <div class="col-md-3 my-2 my-md-0">
                                <div class="form-group">
                                    <label>رقم الهاتف </label>
                                    <input type="number" id="kt_datatable_phone" class="form-control" placeholder="رقم الهاتف">
                                </div>
                            </div>
                            <div class="col-md-3 my-2 my-md-0">
                                <div class="form-group">
                                    <label>رقم الطلب </label>
                                    <input type="number" id="kt_datatable_order_number" class="form-control" placeholder="رقم الطلب">
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
                <h3 class="card-label">قائمة طلبات التعميد الخاص </h3>
            </div>
            <div class="card-toolbar">
            </div>
        </div>
        <div class="card-body">
            <div class="mb-7">
                <div class="row align-items-center">
                    <div class="col-lg-12 col-xl-12">
                        <div class="row align-items-center">
                            <ul class="nav nav-tabs" id="myTab" role="tablist" style="margin-top: 30px">
                                <li class="nav-item">
                                    <a class="nav-link status-parent active" id="kt_datatable_status_all" data-toggle="tab" href="javascript:;" role="tab" aria-controls="home" aria-selected="true">
                                        كل الحالات
                                        <input type="hidden" class="status-input" value="all">
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link status-parent" id="kt_datatable_status_all" data-toggle="tab" href="javascript:;" role="tab" aria-controls="profile" aria-selected="false">
                                        بانتظار المراجعة ({{$pending->count()}})
                                        <input type="hidden" class="status-input" value="1">
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link status-parent" id="kt_datatable_status_all" data-toggle="tab" href="javascript:;" role="tab" aria-controls="contact" aria-selected="false">
                                        بانتظار موافقة مقدم الخدمة ({{$waiting->count()}})
                                        <input type="hidden" class="status-input" value="2">
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link status-parent" id="kt_datatable_status_all" data-toggle="tab" href="javascript:;" role="tab" aria-controls="contact" aria-selected="false">
                                        قيد التنفيذ ({{$processing->count()}})
                                        <input type="hidden" class="status-input" value="3">
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link status-parent" id="kt_datatable_status_all" data-toggle="tab" href="javascript:;" role="tab" aria-controls="contact" aria-selected="false">
                                        بانتظار استلام العميل ({{$completed->count()}})
                                        <input type="hidden" class="status-input" value="4">
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link status-parent" id="kt_datatable_status_all" data-toggle="tab" href="javascript:;" role="tab" aria-controls="contact" aria-selected="false">
                                        تنفيذ واتس اب ({{$whatsapp->count()}})
                                        <input type="hidden" class="status-input" value="11">
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link status-parent" id="kt_datatable_status_all" data-toggle="tab" href="javascript:;" role="tab" aria-controls="contact" aria-selected="false">
                                        تم التسليم ({{$confirm_completed->count()}})
                                        <input type="hidden" class="status-input" value="5">
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link status-parent" id="kt_datatable_status_all" data-toggle="tab" href="javascript:;" role="tab" aria-controls="contact" aria-selected="false">
                                        بانتظار الغاء مقدم الخدمة ({{$canceled->count()}})
                                        <input type="hidden" class="status-input" value="6">
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link status-parent" id="kt_datatable_status_all" data-toggle="tab" href="javascript:;" role="tab" aria-controls="contact" aria-selected="false">
                                        ملغي ({{$confirm_canceled->count()}})
                                        <input type="hidden" class="status-input" value="7">
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link status-parent" id="kt_datatable_status_all" data-toggle="tab" href="javascript:;" role="tab" aria-controls="contact" aria-selected="false">
                                        بلاغ ({{$report->count()}})
                                        <input type="hidden" class="status-input" value="8">
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <div class="datatable datatable-bordered datatable-head-custom" id="kt-private-orders"></div>
        </div>
    </div>

@endsection
@section('script')
    @include('admin.private_orders.script')
     <script src="{{ asset('admin-file/assets/js/pages/crud/ktdatatable/base/private-orders.js') }}"></script>

    <script>
        // $( document ).ready(function() {
        //     $('.kt_datatable_date_from').datepicker({
        //         format          : 'yyyy-mm-dd',
        //         todayHighlight  : true
        //     });
        // });


    </script>
@endsection
