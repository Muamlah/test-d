
@extends('admin.layouts.adminLayout')
@section('title')
    قائمة أقسام الخدمات الالكترونية
@endsection

@section('headings')
    @include('admin.include.headings',[

        'title1'        => ' إدارة أقسام الخدمات الإلكترونية',
        'link1'         => route('admin.section_list'),

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
        @if(session()->has('message'))
            <div style="color: red; font-weight: bolder; font-size: 18px;padding:20px 20px 0 0 ">
                {{ session()->get('message') }}
            </div>
        @endif
        <div class="card-header flex-wrap py-3">

            <div class="card-title">
                <h3 class="card-label">قائمة أقسام الخدمات الالكترونية</h3>
            </div>

        </div>
        <div class="card-body">
        <div class="datatable datatable-bordered datatable-head-custom" id="kt-sections"></div>

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

                let datatable = $('#kt-sections').KTDatatable({
                    // datasource definition
                    data: {
                        type: 'remote',
                        source: {
                            read: {
                                url: HOST_URL +'/admin/get-data/sections',
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
                        },
                        {
                            field: 'image',
                            title: 'الشعار',
                            sortable: false,
                            overflow: 'visible',
                            autoHide: false,
                            width: 150,
                            template: function(row) {
                                return `<div class="symbol symbol-120 symbol-sm flex-shrink-0">
                                            <img  src="{{asset('storage/${row.img}')}}" alt="photo">
                                    </div>
                                    `;
                            },
                        },
                        {
                            field: 'name',
                            title: 'الاسم',
                            sortable: false,
                            overflow: 'visible',
                            textAlign: 'center',
                        },
                        {
                            field: 'Actions',
                            title: 'التحكم بالطلب',
                            sortable: false,
                            overflow: 'visible',
                            autoHide: false,
                            width: 150,
                            template: function(row) {
                                return `
                                        <a href="${HOST_URL}/admin/sections/delete/${row.id}" onclick="return confirm('هل أنت متأكد من عملية الحذف؟')"  class="btn btn-sm btn-clean btn-icon btn-icon-md test" title="حذف">
                                            <i class="flaticon2-trash text-danger"></i>
                                        </a>`;
                            },
                        }
                    ],
                });
                // $('#kt_datatable_search_status').on('change', function() {
                //     datatable.search($(this).val().toLowerCase(), 'status');
                // });

                // $('#kt_datatable_search_type').on('change', function() {
                //     datatable.search($(this).val().toLowerCase(), 'pay_status');
                // });

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


