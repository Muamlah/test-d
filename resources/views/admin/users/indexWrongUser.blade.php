@extends('admin.layouts.adminLayout')
@section('title')
    قائمة المستخدمين اصحاب الرصيد الخاطئ
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
            قائمة المستخدمين اصحاب الرصيد الخاطئ
        </li>
    </ul>
@endsection

@section('headings')
    @include('admin.include.headings',[

        'title1'        => ' قائمة المستخدمين اصحاب الرصيد الخاطئ',
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
                <h3 class="card-label">قائمة المستخدمين اصحاب الرصيد الخاطئ </h3>
            </div>
        </div>
        <div class="card-body">
            <div class="datatable datatable-bordered datatable-head-custom" id="kt-users"></div>
        </div>
    </div>

@endsection


@section('script')
    {{-- <script src="{{ asset('admin-file/assets/js/pages/crud/ktdatatable/base/wrong-users.js') }}"></script> --}}
    <script>
        "use strict";
            // Class definition

            let KTDatatableRemoteAjaxDemo = function() {
                // Private functions

                // basic demo
                let demo = function() {

                    let datatable = $('#kt-users').KTDatatable({
                        // datasource definition
                        data: {
                            type: 'remote',
                            source: {
                                read: {
                                    url: HOST_URL +'/admin/get-data/wrong-users',
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
                            width:40
                        },
                        {
                            field: 'name',
                            title: 'الاسم',
                            sortable: false,
                            textAlign: 'center',
                            template: function(row) {
                                return `<a target="_blank" href="user-informations/${row.id}">${row.name}</a>`;
                            },
                        },
                        {
                            field: 'phone',
                            title: 'رقم الهاتف',
                            sortable: false,
                            textAlign: 'center',
                            template: function(row) {
                                return `<a target="_blank" href="user-informations/${row.id}">${row.phone}</a>`;
                            },
                        },
                        {
                            field: 'email',
                            title: 'البريد الالكتروني',
                            textAlign: 'center',
                        },
                        {
                            field: 'total_balance',
                            title: 'الرصيد الكلي',
                            textAlign: 'center',
                        },
                        {
                            field: 'pinding_balance',
                            title: 'الرصيد المعلق',
                            textAlign: 'center',
                        }, {
                            field: 'created_at',
                            title: 'تاريخ التسجيل',
                            textAlign: 'center',
                        },
                        {
                            field: 'status',
                            title: 'الحالة',
                            template: function(row) {
                                let status = {
                                    active: {
                                        'title': 'فعال',
                                        'state': 'danger'
                                    },
                                    not_active: {
                                        'title': 'غير فعال',
                                        'state': 'success'
                                    },
                                };
                                return '<span class="label label-' + status[row.status].state + ' label-dot mr-2"></span><span class="font-weight-bold text-' + status[row.status].state + '">' +
                                    status[row.status].title + '</span>';
                            },
                        },
                        {
                            field: 'number_of_reference_orders',
                            title: 'عدد طلبات باستخدام كود الخصم',
                        },
                        {
                            field: 'owner_amount_of_reference_orders',
                            title: 'قيمة الرصيد الذي حصل عليه عن طريق كود خصم',
                        },
                        {
                            field: 'user_amount_of_reference_orders',
                            title: 'قيمة الحسم الذي حصل عليه عن طريق كود خصم',
                        },
                        {
                            field: 'Actions',
                            title: 'التحكم بالعميل',
                            sortable: false,
                            overflow: 'visible',
                            autoHide: false,
                            width: 250,
                            template: function(row) {
                                var check_user = "{{can('UPDATE_WRONG_USER')}}";
                                var wrong_user = '';
                                if(check_user){
                                    wrong_user = `<a href="${HOST_URL}/admin/users/update-order/${row.id}" class="btn btn-sm btn-clean btn-icon btn-icon-md" title="تعديل الطلب">
                                                    تعديل الطلب
                                                </a>`;
                                }
                                return ` <a href="${HOST_URL}/admin/users/edit/${row.id}" class="btn btn-sm btn-clean btn-icon btn-icon-md" title="تعديل">
                                            <i class="flaticon-edit-1  text-primary"></i>
                                        </a>
                                        <a href="${HOST_URL}/admin/users/log/${row.id}" class="btn btn-sm btn-clean btn-icon btn-icon-md" title="السجل">
                                            السجل
                                        </a>
                                        <a href="${HOST_URL}/admin/users/reset_password/${row.id}" class="btn btn-sm btn-clean btn-icon btn-icon-md" title="إعادة تعيين كلمة المرور">
                                            <i class="fa fa-reply-all"></i>
                                        </a>
                                        ${wrong_user}
                                            `;
                            },
                        }
                        ],
                    });
                    $('#kt_datatable_user_name').on('change', function() {
                        datatable.search($(this).val().toLowerCase(), 'name');
                    });
                    $('#kt_datatable_user_phone').on('change', function() {
                        datatable.search($(this).val().toLowerCase(), 'phone');
                    });
                    $('#kt_datatable_user_email').on('change', function() {
                        datatable.search($(this).val().toLowerCase(), 'email');
                    });


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
