@extends('admin.layouts.adminLayout')
@section('title') الادوار و الصلاحيات
@endsection

@section('headings')
    @include('admin.include.headings',[

        'title1'        => ' الأدوار و الصلاحيات',
        'link1'         => route('admin.roles.index'),
        'title2'        => 'اضافة دور',
        'link2'         => 'javascript:;',

    ])
@endsection

@section('content')

    <div class="post fs-base d-flex flex-column-fluid" id="kt_post">

        <div id="kt_content_container" class="container">
            <div class="card card-custom">
                <!--begin::Card header-->
                <div class="card-header border-0 cursor-pointer" role="button" data-bs-toggle="collapse" data-bs-target="#kt_account_profile_details" aria-expanded="true" aria-controls="kt_account_profile_details">
                    <!--begin::Card title-->
                    <div class="card-title ">
                        <h3 class="fw-bolder ">اضافة دور</h3>
                    </div>
                    <div class="card-toolbar">
                        <a class="btn btn-success mr-2" href="{{route('admin.roles.index')}}">
                            الأدوار والصلاحيات
                        </a>
                    </div>
                    <!--end::Card title-->
                </div>
                <!--begin::Card header-->
                <!--begin::Content-->
                <div id="kt_account_profile_details" class="collapse show">
                    <!--begin::Form-->
                    <form method="post" action="{{route('admin.roles.store')}}"
                          enctype="multipart/form-data" class="form" role="form" id="kt_account_profile_details_form">
                    {{ csrf_field() }}
                    <!--begin::Card body-->
                        <div class="card-body border-top p-9">
                            <!--begin::Input group-->
                            @if(session()->has('success'))
                                <h2 style="color:green; text-align:center;"> {{Session::get('success')}} </h2>
                                <br>
                            @endif

                            <div class="row mb-6">

                                <label class="col-lg-3 col-form-label required fw-bold fs-6">اسم الدور</label>

                                <div class="col-lg-9 fv-row">
                                    <input type="text" name="name" class="form-control form-control-lg form-control-solid"  value="{{old('name')}}" />
                                </div>
                                <!--end::Col-->
                            </div>





                                <div class="card-header" >
                                    <!--begin::Card title-->
                                    <div class="card-title m-0">
                                        <h3 class="fw-bolder m-0" style="color: green">الصلاحيات</h3>
                                    </div>
                                    <!--end::Card title-->
                                </div>

                            <div class="table-responsive">
                                <!--begin::Table-->
                                <table class="table table-row-bordered table-row-gray-100 align-middle gs-0 gy-3">
{{--                                <table id="list-datatable" class="table datatable">--}}
                                    <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>قراءة</th>
                                        <th>اضافة</th>
                                        <th>تعديل</th>

                                    </tr>
                                    </thead>
                                    <tbody>

                                    <tr>
                                        <td>المشرفين</td>
                                        <td>
                                            <label>
                                                <input type="checkbox" name="role_permissions[]" value="READ_ADMINS"/>
                                                <span></span>
                                            </label>
                                        </td>
                                        <td>
                                            <label>
                                                <input type="checkbox" name="role_permissions[]" value="CREATE_ADMINS"/>
                                                <span></span>
                                            </label>
                                        </td>
                                        <td>
                                            <label>
                                                <input type="checkbox" name="role_permissions[]" value="UPDATE_ADMINS"/>
                                                <span></span>
                                            </label>
                                        </td>
                                    </tr>

                                    <tr>
                                        <td>الاعضاء</td>
                                        <td>
                                            <label>
                                                <input type="checkbox" name="role_permissions[]" value="READ_USERS"/>
                                                <span></span>
                                            </label>
                                        </td>
                                        <td>
                                            <label>
                                                <input type="checkbox" name="role_permissions[]" value="CREATE_USERS"/>
                                                <span></span>
                                            </label>
                                        </td>
                                        <td>
                                            <label>
                                                <input type="checkbox" name="role_permissions[]" value="UPDATE_USERS"/>
                                                <span></span>
                                            </label>
                                        </td>
                                    </tr>

                                    <tr>
                                        <td>طلبات الخدمات الإلكترونية</td>
                                        <td>
                                            <label>
                                                <input type="checkbox" name="role_permissions[]" value="READ_PUBLIC_ORDER"/>
                                                <span></span>
                                            </label>
                                        </td>
                                        <td>
                                            <label>
                                                <input type="checkbox" name="role_permissions[]" value="CREATE_PUBLIC_ORDER"/>
                                                <span></span>
                                            </label>
                                        </td>
                                        <td>
                                            <label>
                                                <input type="checkbox" name="role_permissions[]" value="UPDATE_PUBLIC_ORDER"/>
                                                <span></span>
                                            </label>
                                        </td>
                                    </tr>

                                    <tr>
                                        <td>طلبات التعميد الخاص</td>
                                        <td>
                                            <label>
                                                <input type="checkbox" name="role_permissions[]" value="READ_PRIVATE_ORDER"/>
                                                <span></span>
                                            </label>
                                        </td>
                                        <td>
                                            <label>
                                                <input type="checkbox" name="role_permissions[]" value="CREATE_PRIVATE_ORDER"/>
                                                <span></span>
                                            </label>
                                        </td>
                                        <td>
                                            <label>
                                                <input type="checkbox" name="role_permissions[]" value="UPDATE_PRIVATE_ORDER"/>
                                                <span></span>
                                            </label>
                                        </td>
                                    </tr>

                                    <tr>
                                        <td>طلبات الخدمات الالكترونية</td>
                                        <td>
                                            <label>
                                                <input type="checkbox" name="role_permissions[]" value="READ_ELECTRONIC_ORDER"/>
                                                <span></span>
                                            </label>
                                        </td>
                                        <td>
                                            <label>
                                                <input type="checkbox" name="role_permissions[]" value="CREATE_ELECTRONIC_ORDER"/>
                                                <span></span>
                                            </label>
                                        </td>
                                        <td>
                                            <label>
                                                <input type="checkbox" name="role_permissions[]" value="UPDATE_ELECTRONIC_ORDER"/>
                                                <span></span>
                                            </label>
                                        </td>
                                    </tr>

                                    <tr>
                                        <td>الخدمات الالكترونية</td>
                                        <td>
                                            <label>
                                                <input type="checkbox" name="role_permissions[]" value="READ_ELECTRONIC_SERVICES"/>
                                                <span></span>
                                            </label>
                                        </td>
                                        <td>
                                            <label>
                                                <input type="checkbox" name="role_permissions[]" value="CREATE_ELECTRONIC_SERVICES"/>
                                                <span></span>
                                            </label>
                                        </td>
                                        <td>
                                            <label>
                                                <input type="checkbox" name="role_permissions[]" value="UPDATE_ELECTRONIC_SERVICES"/>
                                                <span></span>
                                            </label>
                                        </td>
                                    </tr>


                                    <tr>
                                        <td>اقسام الخدمات الالكترونية</td>
                                        <td>
                                            <label>
                                                <input type="checkbox" name="role_permissions[]" value="READ_SECTIONS"/>
                                                <span></span>
                                            </label>
                                        </td>
                                        <td>
                                            <label>
                                                <input type="checkbox" name="role_permissions[]" value="CREATE_SECTIONS"/>
                                                <span></span>
                                            </label>
                                        </td>
                                        <td>
                                            <label>
                                                <input type="checkbox" name="role_permissions[]" value="UPDATE_SECTIONS"/>
                                                <span></span>
                                            </label>
                                        </td>
                                    </tr>

                                    <tr>
                                        <td>اعدادات التواصل</td>
                                        <td>

                                        </td>
                                        <td>

                                        </td>
                                        <td>
                                            <label>
                                                <input type="checkbox" name="role_permissions[]" value="UPDATE_CONTACT_SETTINGS"/>
                                                <span></span>
                                            </label>
                                        </td>
                                    </tr>

                                    <tr>
                                        <td>اعدادات الموقع</td>
                                        <td>

                                        </td>
                                        <td>
                                        </td>
                                        <td>
                                            <label>
                                                <input type="checkbox" name="role_permissions[]" value="UPDATE_SETTINGS"/>
                                                <span></span>
                                            </label>
                                        </td>
                                    </tr>

                                    <tr>
                                        <td>اعدادات رسوم التعميد</td>
                                        <td>

                                        </td>
                                        <td>

                                        </td>
                                        <td>
                                            <label>
                                                <input type="checkbox" name="role_permissions[]" value="UPDATE_FEES"/>
                                                <span></span>
                                            </label>
                                        </td>
                                    </tr>

                                    <tr>
                                        <td>طلبات  سحب الرصيد</td>
                                        <td>
                                            <label>
                                                <input type="checkbox" name="role_permissions[]" value="READ_REQUEST_BALANCE"/>
                                                <span></span>
                                            </label>
                                        </td>
                                        <td>

                                        </td>
                                        <td>
                                            <label>
                                                <input type="checkbox" name="role_permissions[]" value="UPDATE_REQUEST_BALANCE"/>
                                                <span></span>
                                            </label>
                                        </td>
                                    </tr>

                                    <tr>
                                        <td>سجل عمليات النظام</td>
                                        <td>
                                            <label>
                                                <input type="checkbox" name="role_permissions[]" value="READ_TRANSACTIONS"/>
                                                <span></span>
                                            </label>
                                        </td>
                                        <td>

                                        </td>
                                        <td>

                                        </td>
                                    </tr>

                                    <tr>
                                        <td>محفظة المنصة</td>
                                        <td>
                                            <label>
                                                <input type="checkbox" name="role_permissions[]" value="READ_WALLET"/>
                                                <span></span>
                                            </label>
                                        </td>
                                        <td>
                                        </td>
                                        <td>

                                        </td>
                                    </tr>

                                    <tr>
                                        <td>الاشعارات</td>
                                        <td>
                                            <label>
                                                <input type="checkbox" name="role_permissions[]" value="READ_NOTIFICATIONS"/>
                                                <span></span>
                                            </label>
                                        </td>
                                        <td>

                                        </td>
                                        <td>

                                        </td>
                                    </tr>



                                    <tr>
                                        <td>تسليم الطلبات</td>
                                        <td>
                                            <label>
                                                <input type="checkbox" name="role_permissions[]" value="COMPLETED_ORDERS"/>
                                                <span></span>
                                            </label>
                                        </td>
                                        <td>

                                        </td>
                                        <td>

                                        </td>
                                    </tr>
                                    <tr>
                                        <td>إلغاء الطلبات</td>
                                        <td>
                                            <label>
                                                <input type="checkbox" name="role_permissions[]" value="CANCELED_ORDERS"/>
                                                <span></span>
                                            </label>
                                        </td>
                                        <td>

                                        </td>
                                        <td>

                                        </td>
                                    </tr>
                                    <tr>
                                        <td>الإحصائيات</td>
                                        <td>
                                            <label>
                                                <input type="checkbox" name="role_permissions[]" value="READ_STATISTICS"/>
                                                <span></span>
                                            </label>
                                        </td>
                                        <td>

                                        </td>
                                        <td>

                                        </td>
                                    </tr>
                                    <tr>
                                        <td>الرسائل</td>
                                        <td>
                                            <label>
                                                <input type="checkbox" name="role_permissions[]" value="READ_MESSAGES"/>
                                                <span></span>
                                            </label>
                                        </td>
                                        <td>

                                        </td>
                                        <td>

                                        </td>
                                    </tr>
                                    <tr>
                                        <td>الصفحات</td>
                                        <td>
                                            <label>
                                                <input type="checkbox" name="role_permissions[]" value="READ_PAGES"/>
                                                <span></span>
                                            </label>
                                        </td>
                                        <td>

                                        </td>
                                        <td>

                                        </td>
                                    </tr>
                                    <tr>
                                        <td>التحديثات</td>
                                        <td>
                                            <label>
                                                <input type="checkbox" name="role_permissions[]" value="READ_UPDATES"/>
                                                <span></span>
                                            </label>
                                        </td>
                                        <td>

                                        </td>
                                        <td>

                                        </td>
                                    </tr>
                                    <tr>
                                        <td>الكوبونات</td>
                                        <td>
                                            <label>
                                                <input type="checkbox" name="role_permissions[]" value="READ_COUPONS"/>
                                                <span></span>
                                            </label>
                                        </td>
                                        <td>

                                        </td>
                                        <td>

                                        </td>
                                    </tr>
                                    <tr>
                                        <td>الاسألة والأجوبة</td>
                                        <td>
                                            <label>
                                                <input type="checkbox" name="role_permissions[]" value="READ_FAQ"/>
                                                <span></span>
                                            </label>
                                        </td>
                                        <td>

                                        </td>
                                        <td>

                                        </td>
                                    </tr>


                                    </tbody>
                                </table>
                            </div>


                        </div>
                        <!--end::Card body-->
                        <!--begin::Actions-->
                        <div class="card-footer d-flex justify-content-end py-6 px-9">
                            <button type="submit" class="btn btn-primary" id="kt_account_profile_details_submit">حفظ التغييرات</button>
                            <a href="{{route('admin.roles.index')}}" class="btn btn-white">رجوع</a>

                        </div>
                        <!--end::Actions-->
                    </form>
                    <!--end::Form-->
                </div>
                <!--end::Content-->
            </div>
        </div>
    </div>
@endsection
