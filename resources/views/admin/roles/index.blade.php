{{--@extends('admin.layouts.adminLayout')--}}

{{--@section('title') ادارة الادوار و الصلاحيات--}}
{{--@endsection--}}
{{--@section('filter')--}}
{{--    <div class="d-flex align-items-center py-1">--}}
{{--        <!--begin::Wrapper-->--}}
{{--        <div class="me-4">--}}

{{--        </div>--}}

{{--        <div data-bs-toggle="tooltip" data-bs-placement="left" data-bs-trigger="hover" title="Create a new account">--}}
{{--            <a href="{{route('admin.roles.create')}}" class="btn btn-sm btn-primary fw-bolder"  id="kt_toolbar_create_button">اضافة دور</a>--}}
{{--        </div>--}}
{{--        <!--end::Wrapper-->--}}
{{--    </div>--}}

{{--@endsection--}}


{{--@section('content')--}}
{{--    <div class="post fs-base d-flex flex-column-fluid" id="kt_post">--}}
{{--        <!--begin::Container-->--}}
{{--        <div id="kt_content_container" class="container">--}}
{{--            <!--begin::Row-->--}}
{{--            <div class="row g-5 g-xl-8">--}}
{{--                <!--begin::Col-->--}}


{{--                <div class="card mb-5 mb-xl-8">--}}
{{--                    <!--begin::Header-->--}}
{{--                    <div class="card-header border-0 pt-5">--}}

{{--                        <h3 class="card-title align-items-start flex-column">--}}
{{--                            <span class="card-label fw-bolder fs-3 mb-1">الادوار</span>--}}
{{--                        </h3>--}}
{{--                        <div data-bs-toggle="tooltip" data-bs-placement="right" data-bs-trigger="hover" title="Create a new account">--}}
{{--                            <a href="{{route('admin.roles.create')}}" class="btn btn-sm btn-primary fw-bolder"  >اضافة دور</a>--}}
{{--                        </div>--}}
{{--                    </div>--}}

{{--                    <!--end::Header-->--}}
{{--                    <!--begin::Body-->--}}
{{--                    <div class="card-body py-3">--}}

{{--                        <!--begin::Table container-->--}}
{{--                        <div class="table-responsive">--}}
{{--                            <!--begin::Table-->--}}
{{--                            <table class="table table-row-bordered table-row-gray-100 align-middle gs-0 gy-3">--}}
{{--                                <!--begin::Table head-->--}}
{{--                                <thead>--}}
{{--                                <tr class="fw-bolder text-muted">--}}
{{--                                    <th class="w-120px">--}}
{{--                                        <div class="form-check form-check-sm form-check-custom form-check-solid">--}}
{{--                                            <input class="form-check-input" type="checkbox" value="1" data-kt-check="true" data-kt-check-target=".widget-13-check" />--}}
{{--                                        </div>--}}
{{--                                    </th>--}}
{{--                                    <th class="min-w-150px">#</th>--}}
{{--                                    <th class="min-w-150px">الاسم</th>--}}
{{--                                    <th class="min-w-150px">تاريخ التسجيل</th>--}}
{{--                                    <th class="min-w-150px text-center">العمليات</th>--}}
{{--                                </tr>--}}
{{--                                </thead>--}}
{{--                                <!--end::Table head-->--}}
{{--                                <!--begin::Table body-->--}}
{{--                                <tbody>--}}
{{--                                @if($items->count() > 0)--}}
{{--                                @foreach($items as $item)--}}
{{--                                    <tr>--}}
{{--                                        <td>--}}
{{--                                            <div class="form-check form-check-sm form-check-custom form-check-solid">--}}
{{--                                                <input class="form-check-input widget-13-check" type="checkbox" value="{{@$item->id}}" />--}}
{{--                                            </div>--}}
{{--                                        </td>--}}
{{--                                        <td>--}}
{{--                                            <a href="#" class="text-dark fw-bolder text-hover-primary d-block mb-1 fs-6">{{@$item->id}}</a>--}}
{{--                                        </td>--}}
{{--                                        <td>--}}
{{--                                            <a href="#" class="text-dark fw-bolder text-hover-primary d-block mb-1 fs-6">{{@$item->name}}</a>--}}
{{--                                        </td>--}}

{{--                                        <td>--}}
{{--                                            <a href="#" class="text-dark fw-bolder text-hover-primary d-block mb-1 fs-6">{{@$item->created_at}}</a>--}}
{{--                                        </td>--}}

{{--                                        <td class="text-center">--}}

{{--                                            <a href="{{route('admin.roles.edit',$item->id)}}" class="btn btn-icon btn-bg-light btn-active-color-primary btn-sm me-1">--}}
{{--                                                <i class="far fa-edit text-warning"></i>--}}
{{--                                            </a>--}}

{{--                                            <a href="{{route('admin.roles.destroy',$item->id)}}" class="btn btn-icon btn-bg-light btn-active-color-primary btn-sm me-1">--}}
{{--                                                <i class="far fa-edit text-warning"></i>--}}
{{--                                            </a>--}}

{{--                                        </td>--}}
{{--                                    </tr>--}}
{{--                                @endforeach--}}
{{--                                @else--}}
{{--                                    <h2>لا يوجد بيانات</h2>--}}
{{--                                @endif--}}

{{--                                </tbody>--}}
{{--                                <!--end::Table body-->--}}
{{--                            </table>--}}

{{--                            <!--end::Table-->--}}
{{--                        </div>--}}
{{--                        <!--end::Table container-->--}}
{{--                    </div>--}}
{{--                    <!--begin::Body-->--}}
{{--                </div>--}}

{{--            </div>--}}
{{--        </div>--}}
{{--    </div>--}}
{{--@endsection--}}

@extends('admin.layouts.adminLayout')
@section('title')
    قائمة الأدوار و الصلاحيات
@endsection
@section('breadcrumb')
    <ul class="breadcrumb breadcrumb-transparent breadcrumb-dot font-weight-bold p-0 my-2 font-size-sm">
        <li class="breadcrumb-item text-muted">
            <a href="{{route('admin.home')}}" class="text-muted">الرئيسية</a>
        </li>
        <li class="breadcrumb-item text-muted">
            الادوار والصلاحيات        </li>
    </ul>
@endsection

@section('headings')
    @include('admin.include.headings',[

        'title1'        => ' الأدوار و الصلاحيات',
        'link1'         => route('admin.roles.index'),

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
                <h3 class="card-label">قائمة الأدوار و الصلاحيات </h3>
            </div>
            <div class="card-toolbar">
                <!--begin::Dropdown-->
                <!--end::Dropdown-->
                <!--begin::Button-->
                <a class="btn btn-primary" href="{{route('admin.roles.create')}}">
                    <i class="flaticon2-plus"></i>
                    اضافة</a>
            {{--            <a href="{{route('admin.roles.create')}}" class="btn btn-sm btn-primary fw-bolder"  id="kt_toolbar_create_button">اضافة دور</a>--}}

            <!--end::Button-->
            </div>
        </div>
        <div class="card-body">
            <div class="datatable datatable-bordered datatable-head-custom" id="kt-roles"></div>
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

                    let datatable = $('#kt-roles').KTDatatable({
                        // datasource definition
                        data: {
                            type: 'remote',
                            source: {
                                read: {
                                    url: HOST_URL +'/admin/roles-get-data',
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
                                width: 10,
                            }, 
                            {
                                field: 'name',
                                title: 'الاسم',
                                sortable: false,
                                overflow: 'visible',
                                textAlign: 'center',
                            }, 
                            {
                                field: 'guard_name',
                                title: 'اسم الصلاحية',
                                textAlign: 'center',
                            },
                            {
                                field: 'created_at',
                                title: 'التاريخ',
                                textAlign: 'center',
                            },
                            {
                            field: 'Actions',
                            title: 'التحكم بالعميل',
                            sortable: false,
                            overflow: 'visible',
                            autoHide: false,
                            width: 250,
                            template: function(row) {
                                return ` 
                                    <a href="${HOST_URL}/admin/roles/${row.id}/edit" class="btn btn-sm btn-clean btn-icon btn-icon-md" title="Edit details">
                                        تعديل
                                    </a>`;
                            },
                        }

                        ],

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

