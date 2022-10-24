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
            <!--begin::Search Form-->
            <div class="mb-7">
                <div class="row align-items-center">
                    <div class="col-lg-9 col-xl-8">
                        <div class="row align-items-center">
                            <div class="col-md-4 my-2 my-md-0">
                                <div class="input-icon">
                                    <input type="text" class="form-control" placeholder="Search..." id="kt_datatable_search_query" />
                                    <span>
																	<i class="flaticon2-search-1 text-muted"></i>
																</span>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
            <!--end: Search Form-->
            <!--begin: Datatable-->
{{--            <div class="datatable datatable-bordered datatable-head-custom" id="kt_datatable"></div>--}}
            <!--end: Datatable-->
            <div class="table-responsive">
                <!--begin::Table-->
                <table class="table table-row-bordered table-row-gray-100 align-middle gs-0 gy-3">
                    <!--begin::Table head-->
                    <thead>
                    <tr class="fw-bolder text-muted">
                        <th class="min-w-120px">
                            <div class="form-check form-check-sm form-check-custom form-check-solid">
                            </div>
                        </th>
                        <th class="min-w-120px">#</th>
                        <th class="min-w-140px">الاسم</th>
                        <th class="min-w-140px">تاريخ التسجيل</th>
                        <th class="min-w-100px text-center">العمليات</th>
                    </tr>
                    </thead>
                    <!--end::Table head-->
                    <!--begin::Table body-->
                        <tbody>
                               @if($items->count() > 0)
                                 @foreach($items as $item)
                                                    <tr>
                                                        <td>
                                                            <div class="form-check form-check-sm form-check-custom form-check-solid">
                                                                <input class="form-check-input widget-13-check" type="checkbox" value="{{@$item->id}}" />
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <a href="#" class="text-dark fw-bolder text-hover-primary d-block mb-1 fs-6">{{@$item->id}}</a>
                                                        </td>
                                                        <td>
                                                            <a href="#" class="text-dark fw-bolder text-hover-primary d-block mb-1 fs-6">{{@$item->name}}</a>
                                                        </td>

                                                        <td>
                                                            <a href="#" class="text-dark fw-bolder text-hover-primary d-block mb-1 fs-6">{{@$item->created_at}}</a>
                                                        </td>

                                                        <td class="text-center">

                                                            <a href="{{route('admin.roles.edit',$item->id)}}" class="btn btn-icon btn-bg-light btn-active-color-primary btn-sm me-1">
                                                                <i class="flaticon2-edit"></i>
                                                            </a>

                                                            <a href="{{route('admin.roles.destroy',$item->id)}}" class="btn btn-icon btn-bg-light btn-active-color-primary btn-sm me-1">
                                                                <i class="flaticon2-trash"></i>
                                                            </a>

                                                        </td>
                                                    </tr>
                                                @endforeach
                                                @else
                                                    <h2>لا يوجد بيانات</h2>
                                                @endif

                                                </tbody>
                    <!--end::Table body-->
                </table>
                <!--end::Table-->
            </div>

        </div>
    </div>

@endsection
@section('script')
    <script src="{{ asset('admin-file/assets/js/pages/crud/ktdatatable/base/eservices.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/gh/jquery-form/form@4.3.0/dist/jquery.form.min.js" integrity="sha384-qlmct0AOBiA2VPZkMY3+2WqkHtIQ9lSdAsAn5RUJD/3vA5MKDgSGcdmIv4ycVxyn" crossorigin="anonymous"></script>
    <script src="{{ asset('admin-file/assets/js/pages/crud/forms/validation/e-services-form-controls.js') }}"></script>
    <script src="{{ asset('admin-file/assets/js/pages/crud/file-upload/image-input.js') }}"></script>
@endsection

