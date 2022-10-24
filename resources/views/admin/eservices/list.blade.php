@extends('admin.layouts.adminLayout')
@section('title')
    قائمة الخدمات الالكترونية
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
            قائمة الخدمات الالكترونية
        </li>
    </ul>
@endsection

@section('headings')
    @include('admin.include.headings',[

        'title1'        => ' إدارة الخدمات',
        'link1'         => route('admin.eservices.list'),

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
                                    <label>الحالة </label>
                                    <select style="padding: 0 5px" class="form-control" id="kt_datatable_search_status">
                                        <option value="">كل الحالات</option>
                                        <option value="waiting">بإنتظار الموافقة</option>
                                        <option value="pending">بانتظار المراجعة</option>
                                        <option value="processing">قيد التنفيذ</option>
                                        <option value="completed">بإنتظار الإستلام</option>
                                        <option value="confirm_completed">تم التسليم</option>
                                        <option value="canceled">بانتظار الغاء مقدم الخدمة</option>
                                        <option value="confirm_canceled">ملغي</option>
                                        <option value="report">بلاغ</option>
                                    </select>
                                </div>
                            </div>

                            <div class="col-md-4 my-2 my-md-0">
                                <div class="form-group">
                                    <label>اكتب للبحث</label>
                                    <input type="text" class="form-control" placeholder="اكتب للبحث" id="kt_datatable_search_query" placeholder="اكتب للبحث" />
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
                <h3 class="card-label">قائمة الخدمات الالكترونية </h3>
            </div>
            <div class="card-toolbar">
                <a class="btn btn-primary"  href="{{route('admin.eservices.create')}}" >
                    <i class="flaticon2-plus"></i>  اضافة</a>
            </div>
        </div>
        <div class="card-body">
            <!--begin::Search Form-->
            <div class="mb-7">
                <div class="row align-items-center">
                    <div class="col-lg-9 col-xl-8">
                        <div class="row align-items-center">


                        </div>
                    </div>
                </div>
            </div>
            <!--end: Search Form-->
            <!--begin: Datatable-->
            <div class="datatable datatable-bordered datatable-head-custom" id="kt-eservices"></div>
            <!--end: Datatable-->
        </div>
    </div>
@endsection
@section('script')
    <script>
        "use strict";
        // Class definition

        let KTDatatableRemoteAjaxDemo = function() {
            // Private functions

            // basic demo
            let demo = function() {

                let datatable = $('#kt-eservices').KTDatatable({
                    // datasource definition
                    data: {
                        type: 'remote',
                        source: {
                            read: {
                                url: HOST_URL +'/admin/get-data/e-services',
                                // sample custom headers
                                // headers: {'x-my-custom-header': 'some value', 'x-test-header': 'the value'},
                                map: function(raw) {
                                    // sample data mapping
                                    let dataSet = raw;
                                    if (typeof raw.data !== 'undefined') {
                                        dataSet = raw.data;
                                    }
                                    return dataSet;
                                },
                                params: {
                                    status: 'test',
                                    pay_status: 'test',
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
                    columns: [{
                        field: 'id',
                        title: '#',
                        sortable: 'asc',
                        type: 'number',
                        selector: false,
                        textAlign: 'center',
                    }, {
                        field: 'ımg',
                        title: 'الصورة',
                        sortable: false,
                        textAlign: 'center',
                        template:function (row){
                            return   `<div class="symbol symbol-120 symbol-sm flex-shrink-0">
                                            <img  src="${HOST_URL}/storage/${row.img}" alt="photo">
                                    </div>`
                        }
                    }, {
                        field: 'sections_name',
                        title: 'القسم',
                        sortable: false,
                        overflow: 'visible',
                        textAlign: 'center',
                    }, {
                        field: 'service_name',
                        title: 'الخدمة',
                        textAlign: 'center',
                    }, {
                        field: 'Actions',
                        title: 'التحكم بالطلب',
                        sortable: false,
                        overflow: 'visible',
                        autoHide: false,
                        width: 150,
                        template: function(row) {
                            return `
                                <a href="${HOST_URL}/admin/e_services/${row.id}/edit" class="btn btn-sm btn-clean btn-icon btn-icon-md" title="تعديل">
                                    <i class="flaticon-edit-1  text-primary"></i>
                                </a>
                                <a href="${HOST_URL}/admin/e_services/delete/${row.id}" onclick="return confirm('هل أنت متأكد من عملية الحذف؟')"  class="btn btn-sm btn-clean btn-icon btn-icon-md test" title="حذف">
                                    <i class="flaticon2-trash text-danger"></i>
                                </a>`;
                        },
                    }],

                });
                $('#kt_datatable_search_status').on('change', function() {
                    datatable.search($(this).val().toLowerCase(), 'status');
                });

                $('#kt_datatable_search_type').on('change', function() {
                    datatable.search($(this).val().toLowerCase(), 'pay_status');
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
