@extends('admin.layouts.adminLayout')
@section('title')
    قائمة إعدادات التواصل
@endsection
@section('breadcrumb')
    <ul class="breadcrumb breadcrumb-transparent breadcrumb-dot font-weight-bold p-0 my-2 font-size-sm">
        <li class="breadcrumb-item text-muted">
            <a href="{{route('admin.home')}}" class="text-muted">الرئيسية</a>
        </li>
        <li class="breadcrumb-item text-muted">
             إعدادات التواصل
        </li>
    </ul>
@endsection
@section('content')
    <div class="card card-custom">
        <div class="card-header flex-wrap py-3">
            <div class="card-title">
                <h3 class="card-label">قائمة إعدادات التواصل </h3>
            </div>
            <div class="card-toolbar">
                <!--begin::Dropdown-->
                <!--end::Dropdown-->
                <!--begin::Button-->
                <a class="btn btn-primary"  href="{{route('admin.config.create')}}" ><i class="flaticon2-plus"></i>  اضافة</a>

                <!--end::Button-->
            </div>
        </div>
        <div class="card-body">
            <!--begin::Search Form-->
            <div class="mb-7">
                <div class="row align-items-center">
                    <div class="col-lg-9 col-xl-8">
                        <div class="row align-items-center">
                            <div class="col-md-4 my-2 my-md-0">
                                <div class="input-icon">
                                    <input type="text" class="form-control" placeholder="اكتب كلمة للبحث" id="kt_datatable_search_query" />
                                    <span>
                                        <i class="flaticon2-search-1 text-muted"></i>
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="datatable datatable-bordered datatable-head-custom" id="kt_datatable"></div>
        </div>
    </div>
@endsection
@section('script')
    <script>
        "use strict";

        let KTDatatableRemoteAjaxDemo = function() {
            let demo = function() {
                let datatable = $('#kt_datatable').KTDatatable({
                    data: {
                        type: 'remote',
                        source: {
                            read: {
                                url: HOST_URL +'/admin/config/get-data',
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
                                    type: 'config',
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
                        }, 
                        {
                            field: 'name',
                            title: 'الاسم',
                            sortable: false,
                            overflow: 'visible',
                            textAlign: 'center',
                        },
                        {
                            field: 'val',
                            title: 'القيمة',
                            sortable: false,
                            overflow: 'visible',
                            textAlign: 'center',
                        }, 
                        {
                            field: 'key',
                            title: 'الرمز',
                            textAlign: 'center',
                        }, 
                        {
                            field: 'Actions',
                            title: 'التحكم ',
                            sortable: false,
                            overflow: 'visible',
                            autoHide: false,
                            template: function(row) {
                                return ` <a href="${HOST_URL}/admin/config/edit/${row.id}" class="btn btn-sm btn-clean btn-icon btn-icon-md" title="تعديل">
                                            <i class="flaticon-edit-1  text-primary"></i>
                                        </a>
                                        <a href="${HOST_URL}/admin/config/delete/${row.id}" onclick="return confirm('هل أنت متأكد من عملية الحذف؟')"  class="btn btn-sm btn-clean btn-icon btn-icon-md test" title="Edit details">
                                            <i class="flaticon2-trash text-danger"></i>
                                        </a>`;
                            },
                        }
                    ],
                });
                $('#kt_datatable_search_type').on('change', function() {
                    datatable.search($(this).val().toLowerCase(), 'type');
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
