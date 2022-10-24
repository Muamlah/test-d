@extends('admin.layouts.adminLayout')
@section('title') الادوار و الصلاحيات
@endsection

@section('headings')
    @include('admin.include.headings',[

        'title1'        => ' الأدوار و الصلاحيات',
        'link1'         => route('admin.roles.index'),
        'title2'        => 'تعديل دور',
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
                    <div class="card-title m-0">
                        <h3 class="fw-bolder m-0">تعديل دور</h3>
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
                    <form method="post" action="{{ route('admin.roles.update',$role->id )}}"
                          enctype="multipart/form-data" class="form" role="form" id="kt_account_profile_details_form">
                    {{ csrf_field() }}
                    {{ method_field('PATCH')}}

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
                                    <input type="text" name="name" class="form-control form-control-lg form-control-solid"  value="{{@$role->name}}" />
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
                                                <input type="checkbox" name="role_permissions[]" value="READ_ADMINS" {{ in_array('READ_ADMINS', @$permissions) ? 'checked' : '' }}/>
                                                <span></span>
                                            </label>
                                        </td>
                                        <td>
                                            <label>
                                                <input type="checkbox" name="role_permissions[]" value="CREATE_ADMINS" {{ in_array('CREATE_ADMINS', @$permissions) ? 'checked' : '' }}/>
                                                <span></span>
                                            </label>
                                        </td>
                                        <td>
                                            <label>
                                                <input type="checkbox" name="role_permissions[]" value="UPDATE_ADMINS" {{ in_array('UPDATE_ADMINS', @$permissions) ? 'checked' : '' }}/>
                                                <span></span>
                                            </label>
                                        </td>
                                    </tr>

                                    <tr>
                                        <td>الاعضاء</td>
                                        <td>
                                            <label>
                                                <input type="checkbox" name="role_permissions[]" value="READ_USERS" {{ in_array('READ_USERS', $permissions) ? 'checked' : '' }}/>
                                                <span></span>
                                            </label>
                                        </td>
                                        <td>
                                            <label>
                                                <input type="checkbox" name="role_permissions[]" value="CREATE_USERS" {{ in_array('CREATE_USERS', $permissions) ? 'checked' : '' }}/>
                                                <span></span>
                                            </label>
                                        </td>
                                        <td>
                                            <label>
                                                <input type="checkbox" name="role_permissions[]" value="UPDATE_USERS" {{ in_array('UPDATE_USERS', $permissions) ? 'checked' : '' }}/>
                                                <span></span>
                                            </label>
                                        </td>
                                    </tr>

                                    <tr>
                                        <td>طلبات الخدمات الإلكترونية</td>
                                        <td>
                                            <label>
                                                <input type="checkbox" name="role_permissions[]" value="READ_PUBLIC_ORDER" {{ in_array('READ_PUBLIC_ORDER', $permissions) ? 'checked' : '' }}/>
                                                <span></span>
                                            </label>
                                        </td>
                                        <td>
                                            <label>
                                                <input type="checkbox" name="role_permissions[]" value="CREATE_PUBLIC_ORDER" {{ in_array('CREATE_PUBLIC_ORDER', $permissions) ? 'checked' : '' }}/>
                                                <span></span>
                                            </label>
                                        </td>
                                        <td>
                                            <label>
                                                <input type="checkbox" name="role_permissions[]" value="UPDATE_PUBLIC_ORDER" {{ in_array('UPDATE_PUBLIC_ORDER', $permissions) ? 'checked' : '' }}/>
                                                <span></span>
                                            </label>
                                        </td>
                                    </tr>

                                    <tr>
                                        <td>طلبات التعميد الخاص</td>
                                        <td>
                                            <label>
                                                <input type="checkbox" name="role_permissions[]" value="READ_PRIVATE_ORDER" {{ in_array('READ_PRIVATE_ORDER', $permissions) ? 'checked' : '' }}/>
                                                <span></span>
                                            </label>
                                        </td>
                                        <td>
                                            <label>
                                                <input type="checkbox" name="role_permissions[]" value="CREATE_PRIVATE_ORDER" {{ in_array('CREATE_PRIVATE_ORDER', $permissions) ? 'checked' : '' }}/>
                                                <span></span>
                                            </label>
                                        </td>
                                        <td>
                                            <label>
                                                <input type="checkbox" name="role_permissions[]" value="UPDATE_PRIVATE_ORDER" {{ in_array('UPDATE_PRIVATE_ORDER', $permissions) ? 'checked' : '' }}/>
                                                <span></span>
                                            </label>
                                        </td>
                                    </tr>

{{--                                    <tr>--}}
{{--                                        <td>طلبات الخدمات الالكترونية</td>--}}
{{--                                        <td>--}}
{{--                                            <label>--}}
{{--                                                <input type="checkbox" name="role_permissions[]" value="READ_ELECTRONIC_ORDER" {{ in_array('READ_ELECTRONIC_ORDER', $permissions) ? 'checked' : '' }}/>--}}
{{--                                                <span></span>--}}
{{--                                            </label>--}}
{{--                                        </td>--}}
{{--                                        <td>--}}
{{--                                            <label>--}}
{{--                                                <input type="checkbox" name="role_permissions[]" value="CREATE_ELECTRONIC_ORDER" {{ in_array('CREATE_ELECTRONIC_ORDER', $permissions) ? 'checked' : '' }}/>--}}
{{--                                                <span></span>--}}
{{--                                            </label>--}}
{{--                                        </td>--}}
{{--                                        <td>--}}
{{--                                            <label>--}}
{{--                                                <input type="checkbox" name="role_permissions[]" value="UPDATE_ELECTRONIC_ORDER" {{ in_array('UPDATE_ELECTRONIC_ORDER', $permissions) ? 'checked' : '' }}/>--}}
{{--                                                <span></span>--}}
{{--                                            </label>--}}
{{--                                        </td>--}}
{{--                                    </tr>--}}

                                    <tr>
                                        <td>الخدمات الالكترونية</td>
                                        <td>
                                            <label>
                                                <input type="checkbox" name="role_permissions[]" value="READ_ELECTRONIC_SERVICES" {{ in_array('READ_ELECTRONIC_SERVICES', $permissions) ? 'checked' : '' }}/>
                                                <span></span>
                                            </label>
                                        </td>
                                        <td>
                                            <label>
                                                <input type="checkbox" name="role_permissions[]" value="CREATE_ELECTRONIC_SERVICES" {{ in_array('CREATE_ELECTRONIC_SERVICES', $permissions) ? 'checked' : '' }}/>
                                                <span></span>
                                            </label>
                                        </td>
                                        <td>
                                            <label>
                                                <input type="checkbox" name="role_permissions[]" value="UPDATE_ELECTRONIC_SERVICES" {{ in_array('UPDATE_ELECTRONIC_SERVICES', $permissions) ? 'checked' : '' }}/>
                                                <span></span>
                                            </label>
                                        </td>
                                    </tr>


                                    <tr>
                                        <td>اقسام الخدمات الالكترونية</td>
                                        <td>
                                            <label>
                                                <input type="checkbox" name="role_permissions[]" value="READ_SECTIONS" {{ in_array('READ_SECTIONS', $permissions) ? 'checked' : '' }}/>
                                                <span></span>
                                            </label>
                                        </td>
                                        <td>
                                            <label>
                                                <input type="checkbox" name="role_permissions[]" value="CREATE_SECTIONS" {{ in_array('CREATE_SECTIONS', $permissions) ? 'checked' : '' }}/>
                                                <span></span>
                                            </label>
                                        </td>
                                        <td>
                                            <label>
                                                <input type="checkbox" name="role_permissions[]" value="UPDATE_SECTIONS" {{ in_array('UPDATE_SECTIONS', $permissions) ? 'checked' : '' }}/>
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
                                                <input type="checkbox" name="role_permissions[]" value="UPDATE_CONTACT_SETTINGS" {{ in_array('UPDATE_CONTACT_SETTINGS', $permissions) ? 'checked' : '' }}/>
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
                                                <input type="checkbox" name="role_permissions[]" value="UPDATE_SETTINGS" {{ in_array('UPDATE_SETTINGS', $permissions) ? 'checked' : '' }}/>
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
                                                <input type="checkbox" name="role_permissions[]" value="UPDATE_FEES" {{ in_array('UPDATE_FEES', $permissions) ? 'checked' : '' }}/>
                                                <span></span>
                                            </label>
                                        </td>
                                    </tr>

                                    <tr>
                                        <td>طلبات  سحب الرصيد</td>
                                        <td>
                                            <label>
                                                <input type="checkbox" name="role_permissions[]" value="READ_REQUEST_BALANCE" {{ in_array('READ_REQUEST_BALANCE', $permissions) ? 'checked' : '' }}/>
                                                <span></span>
                                            </label>
                                        </td>
                                        <td>

                                        </td>
                                        <td>
                                            <label>
                                                <input type="checkbox" name="role_permissions[]" value="UPDATE_REQUEST_BALANCE" {{ in_array('UPDATE_REQUEST_BALANCE', $permissions) ? 'checked' : '' }}/>
                                                <span></span>
                                            </label>
                                        </td>
                                    </tr>

                                    <tr>
                                        <td>سجل عمليات النظام</td>
                                        <td>
                                            <label>
                                                <input type="checkbox" name="role_permissions[]" value="READ_TRANSACTIONS" {{ in_array('READ_TRANSACTIONS', $permissions) ? 'checked' : '' }}/>
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
                                                <input type="checkbox" name="role_permissions[]" value="READ_WALLET" {{ in_array('READ_WALLET', $permissions) ? 'checked' : '' }}/>
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
                                                <input type="checkbox" name="role_permissions[]" value="READ_NOTIFICATIONS" {{ in_array('READ_NOTIFICATIONS', $permissions) ? 'checked' : '' }}/>
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
                                                <input type="checkbox" name="role_permissions[]" value="COMPLETED_ORDERS" {{ in_array('COMPLETED_ORDERS', $permissions) ? 'checked' : '' }}/>
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
                                                <input type="checkbox" name="role_permissions[]" value="CANCELED_ORDERS" {{ in_array('CANCELED_ORDERS', $permissions) ? 'checked' : '' }}/>
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
                                                <input type="checkbox" name="role_permissions[]" value="READ_STATISTICS" {{ in_array('READ_STATISTICS', $permissions) ? 'checked' : '' }}/>
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
                                                <input type="checkbox" name="role_permissions[]" value="READ_MESSAGES" {{ in_array('READ_MESSAGES', $permissions) ? 'checked' : '' }}/>
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
                                                <input type="checkbox" name="role_permissions[]" value="READ_PAGES" {{ in_array('READ_PAGES', $permissions) ? 'checked' : '' }}/>
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
                                                <input type="checkbox" name="role_permissions[]" value="READ_UPDATES" {{ in_array('READ_UPDATES', $permissions) ? 'checked' : '' }}/>
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
                                                <input type="checkbox" name="role_permissions[]" value="READ_COUPONS" {{ in_array('READ_COUPONS', $permissions) ? 'checked' : '' }}/>
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
                                                <input type="checkbox" name="role_permissions[]" value="READ_FAQ" {{ in_array('READ_FAQ', $permissions) ? 'checked' : '' }}/>
                                                <span></span>
                                            </label>
                                        </td>
                                        <td>

                                        </td>
                                        <td>

                                        </td>
                                    </tr>
                                    <tr>
                                        <td>المستخدمين أصحاب الرصيد الخاطئ</td>
                                        <td>
                                            <label>
                                                <input type="checkbox" name="role_permissions[]" value="READ_WRONG_USER" {{ in_array('READ_WRONG_USER', $permissions) ? 'checked' : '' }}/>
                                                <span></span>
                                            </label>
                                        </td>
                                        <td>

                                        </td>
                                        <td>
                                            <label>
                                                <input type="checkbox" name="role_permissions[]" value="UPDATE_WRONG_USER" {{ in_array('UPDATE_WRONG_USER', $permissions) ? 'checked' : '' }}/>
                                                <span></span>
                                            </label>
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
