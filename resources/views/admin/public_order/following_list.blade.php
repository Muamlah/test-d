@extends('admin.layouts.adminLayout')
@section('title')
    قائمة طلبات التعميد التابع
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
            قائمة طلبات التعميد التابع
        </li>
    </ul>
@endsection

@section('headings')
    @include('admin.include.headings',[

        'title1'        => ' طلبات الخدمات الإلكترونية',
        'link1'         => route('admin.public_orders'),
        'title2'        => 'طلبات ',
        'link2'         => 'javascript:;',

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
                                    <label>الحالة </label>
                                    <select style="padding: 0 5px" class="form-control" id="kt_datatable_search_status">
                                        <option value="">كل الحالات</option>
                                        <option value="1">بانتظار المراجعة</option>
                                        <option value="2">مفتوح</option>
                                        <option value="3">قيد التنفيذ</option>
                                        <option value="4">بإنتظار الإستلام</option>
                                        <option value="5">تم التسليم</option>
                                        <option value="6">بانتظار الغاء مقدم الخدمة</option>
                                        <option value="7">ملغي</option>
                                        <option value="8">بلاغ</option>
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
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="card card-custom">
        <div class="card-header flex-wrap py-3">
            <div class="card-title">
                <h3 class="card-label">قائمة طلبات التعميد التابع </h3>
            </div>
            <div class="card-toolbar">
                <!--begin::Dropdown-->
                <!--end::Dropdown-->
                <!--begin::Button-->
            {{--                <button class="btn btn-primary" >اضافة</button>--}}

            <!--end::Button-->
            </div>
        </div>
        <div class="card-body">
            <!--begin::Search Form-->
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
                                        بانتظار المراجعة
                                        <input type="hidden" class="status-input" value="1">
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link status-parent" id="kt_datatable_status_all" data-toggle="tab" href="javascript:;" role="tab" aria-controls="contact" aria-selected="false">
                                        مفتوح
                                        <input type="hidden" class="status-input" value="2">
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link status-parent" id="kt_datatable_status_all" data-toggle="tab" href="javascript:;" role="tab" aria-controls="contact" aria-selected="false">
                                        قيد التنفيذ
                                        <input type="hidden" class="status-input" value="3">
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link status-parent" id="kt_datatable_status_all" data-toggle="tab" href="javascript:;" role="tab" aria-controls="contact" aria-selected="false">
                                        بإنتظار الإستلام
                                        <input type="hidden" class="status-input" value="4">
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link status-parent" id="kt_datatable_status_all" data-toggle="tab" href="javascript:;" role="tab" aria-controls="contact" aria-selected="false">
                                        تم التسليم
                                        <input type="hidden" class="status-input" value="5">
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link status-parent" id="kt_datatable_status_all" data-toggle="tab" href="javascript:;" role="tab" aria-controls="contact" aria-selected="false">
                                        بانتظار الغاء مقدم الخدمة
                                        <input type="hidden" class="status-input" value="6">
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link status-parent" id="kt_datatable_status_all" data-toggle="tab" href="javascript:;" role="tab" aria-controls="contact" aria-selected="false">
                                        ملغي
                                        <input type="hidden" class="status-input" value="7">
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link status-parent" id="kt_datatable_status_all" data-toggle="tab" href="javascript:;" role="tab" aria-controls="contact" aria-selected="false">
                                        بلاغ
                                        <input type="hidden" class="status-input" value="8">
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <!--end: Search Form-->
            <!--begin: Datatable-->
            <div class="datatable datatable-bordered datatable-head-custom" id="kt-public-orders"></div>
            <!--end: Datatable-->
        </div>
    </div>
@endsection
@section('script')
    <script>
        "use strict";
        // Class definition

        let KTDatatableRemoteAjaxDemo = function() {
            let demo = function() {
                let datatable = $('#kt-public-orders').KTDatatable({
                    data: {
                        type: 'remote',
                        source: {
                            read: {
                                url: HOST_URL +'/admin/get-data/following-public-orders/'+"{{$order_id}}",
                                // sample custom headers
                                // headers: {'x-my-custom-header': 'some value', 'x-test-header': 'the value'},
                                map: function(raw) {
                                    // sample data mapping
                                    let dataSet = raw;
                                    if (typeof raw.data !== 'undefined') {
                                        dataSet = raw.data;
                                    }
                                    return dataSet;
                                }
                            },
                        },
                        pageSize: 10,
                        serverPaging: true,
                        serverFiltering: true,
                        serverSorting: true,
                    },

                    // layout definition
                    layout: {
                        scroll: false,
                        footer: false,
                    },

                    // column sorting
                    sortable: true,

                    pagination: true,

                    search: {
                        input: $('#kt_datatable_search_query'),
                        key: 'generalSearch'
                    },

                    // columns definition
                    columns: [
                        {
                        field: 'id',
                        title: '#',
                        sortable: 'asc',
                        type: 'number',
                        selector: false,
                        textAlign: 'center',
                        width: 20,
                    },
                    {
                        field: 'title',
                        title: 'عنوان الطلب',
                        textAlign: 'center',
                    },
                    {
                        field: 'user_phone',
                        title: 'رقم العميل',
                        textAlign: 'center',
                        template: function(row) {
                            return `
                                <a target="_blank" href="user-informations/${row.user_id}">${row.user_name}</a><br>
                                <a target="_blank" href="https://api.whatsapp.com/send?phone=966${row.user_phone.slice(1)}" class="">
                                    ${row.user_phone}
                                    <i class="fab fa-whatsapp"></i>
                                </a>`;
                        },
                    },
                    {
                        field: 'service_provider_phone',
                        title: 'رقم مقدم الخدمه',
                        textAlign: 'center',
                        template: function(row) {
                            return `<a target="_blank" href="https://api.whatsapp.com/send?phone=966${row.service_provider_phone.slice(1)}" class="">
                                    ${row.service_provider_phone}
                                    <i class="fab fa-whatsapp"></i>
                                </a>`;
                        },
                    },
                    {
                        field: 'price',
                        title: 'السعر',
                        textAlign: 'center',
                        width: 40,
                    },
                    {
                        field: 'created_at',
                        title: 'تاريخ الطلب',
                        textAlign: 'center',
                    },
                    {
                        field: 'deadline',
                        title: 'تاريخ الانتهاء',
                        textAlign: 'center',
                    },
                    {
                        field: 'status',
                        title: 'الحالة',
                        // callback function support for column rendering
                        template: function(row) {
                            let status = {
                                1: {
                                    'title': 'بانتظار المراجعة',
                                    'class': ' label-light-success'
                                },
                                5: {
                                    'title': ' تم التسليم',
                                    'class': ' label-light-success'
                                },
                                3: {
                                    'title': 'قيد التنفيذ',
                                    'class': ' label-light-primary'
                                },
                                4: {
                                    'title': ' بإنتظار الإستلام',
                                    'class': ' label-light-success'
                                },
                                6: {
                                    'title': 'بانتظار الغاء مقدم الخدمة',
                                    'class': ' label-light-warning'
                                },
                                8: {
                                    'title': 'بلاغ',
                                    'class': ' label-light-warning'
                                },
                                9: {
                                    'title': 'غير موافق',
                                    'class': ' label-light-warning'
                                },
                                7: {
                                    'title': 'ملغي',
                                    'class': ' label-light-danger'
                                },
                                2: {
                                    'title': 'مفتوح',
                                    'class': ' label-light-info'
                                },
                            };
                            // console.log(status);
                            return '<span class="label font-weight-bold label-lg ' + status[row.status].class + ' label-inline">' + status[row.status].title + '</span>';
                        },
                    },
                    {
                        field: 'pay_status',
                        title: 'حالة الدفع',
                        // callback function support for column rendering
                        template: function(row) {
                            let status = {
                                processing_convert: {
                                    'title': 'بانتظار التحويل',
                                    'state': 'danger'
                                },
                                complete_convert: {
                                    'title': 'تم الدفع',
                                    'state': 'success'
                                },
                            };
                            return '<span class="label label-' + status[row.pay_status].state + ' label-dot mr-2"></span><span class="font-weight-bold text-' + status[row.pay_status].state + '">' +
                                status[row.pay_status].title + '</span>';
                        },
                    },
                    {
                        field: 'Actions',
                        title: 'التحكم بالطلب',
                        sortable: false,
                        overflow: 'visible',
                        autoHide: false,
                        width: 150,
                        template: function(row) {
                            return `<a href="${HOST_URL}/admin/public_orders/${row.id}" class="btn btn-sm btn-clean btn-icon btn-icon-md" title="Edit details">
                                        <i class="flaticon-edit-1  text-primary"></i>
                                    </a>
                                    <a href="${HOST_URL}/admin/chat/public/${row.id}" class="btn btn-sm btn-clean btn-icon btn-icon-md" title="محادثة">
                                        <i class="fab fa-whatsapp"></i>
                                    </a>
                                    `;
                        },
                    }],

                });
                $('#kt_datatable_search_status').on('change', function() {
                    datatable.search($(this).val().toLowerCase(), 'status');
                });

                $('#kt_datatable_search_type').on('change', function() {
                    datatable.search($(this).val().toLowerCase(), 'pay_status');
                });

                $('#kt_datatable_amount_from').on('keyup', function() {
                    datatable.search($(this).val(), 'amount_from');
                });

                $('#kt_datatable_amount_to').on('keyup', function() {
                    datatable.search($(this).val(), 'amount_to');
                });

                $('#kt_datatable_date_from').on('change', function() {
                    datatable.search($(this).val(), 'date_from');
                });

                $('#kt_datatable_date_to').on('change', function() {
                    datatable.search($(this).val(), 'date_to');
                });

                $('#kt_datatable_phone').on('keyup', function() {
                    datatable.search($(this).val(), 'phone');
                });

                $('.status-parent').on('click', function() {
                    datatable.search($(this).find('.status-input').val(), 'all_status');
                });


                // $('#kt_datatable_search_status, #kt_datatable_search_type').selectpicker();
            };

            return {
                // public functions
                init: function() {
                    demo();
                },
            };
        }();

        jQuery(document).ready(function() {
            KTDatatableRemoteAjaxDemo.init();
        });

    </script>
@endsection
