@extends('admin.layouts.adminLayout')
@section('title')
قائمة المشرفين
@endsection
@section('breadcrumb')
<ul class="breadcrumb breadcrumb-transparent breadcrumb-dot font-weight-bold p-0 my-2 font-size-sm">
    <li class="breadcrumb-item text-muted">
        <a href="{{route('admin.home')}}" class="text-muted">الرئيسية</a>
    </li>
    <li class="breadcrumb-item text-muted">
        ادارة المشرفين </li>
</ul>
@endsection

@section('headings')
    @include('admin.include.headings',[

        'title1'        => ' المشرفين',
        'link1'         => route('admin.admins.index'),
        'title2'        => 'اضافة مشرف جديد',
        'link2'         => 'javascript:;',

    ])
@endsection

@section('content')

<div class="post fs-base d-flex flex-column-fluid" id="kt_post">

    <div id="kt_content_container" class="container">
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <div class="card card-custom">
            <!--begin::Card header-->
            <div class="card-header border-0 cursor-pointer" role="button" data-bs-toggle="collapse" data-bs-target="#kt_account_profile_details" aria-expanded="true" aria-controls="kt_account_profile_details">
                <!--begin::Card title-->
                <div class="card-title m-0">
                    <h3 class="fw-bolder m-0">اضافة مشرف جديد</h3>
                </div>
                <div class="card-toolbar">
                    <a class="btn btn-success mr-2" href="{{route('admin.admins.index')}}">
                        المشرفين
                    </a>
                </div>
                <!--end::Card title-->
            </div>
            <!--begin::Card header-->
            <!--begin::Content-->
            <div id="kt_account_profile_details" class="collapse show">
                <!--begin::Form-->
                <form method="post" action="{{route('admin.admins.store')}}" enctype="multipart/form-data" class="form" role="form" id="kt_account_profile_details_form">
                    {{ csrf_field() }}
                    <!--begin::Card body-->
                    <div class="card-body border-top p-9">
                        <!--begin::Input group-->
                        @php

                        @endphp


                        @if(session()->has('success'))
                        <h2 style="color:green; text-align:center;"> {{Session::get('success')}} </h2>
                        <br>
                        @endif
                        {{-- <div class="row mb-6">
                            <!--begin::Label-->
                            <label class="col-lg-3 col-form-label fw-bold fs-6">الصورة الشخصية</label>
                            <!--end::Label-->
                            <!--begin::Col-->
                            <div class="col-lg-9">
                                <div class="image-input image-input-empty image-input-outline" id="kt_image_5" style="background-image: url({{asset('public/admin/assets/media/users/blank.png')}})">
                                    <div class="image-input-wrapper"></div>
                                    <label class="btn btn-xs btn-icon btn-circle btn-white btn-hover-text-primary btn-shadow" data-action="change" data-toggle="tooltip" title="" data-original-title="اختر صورة">
                                        <i class="flaticon2-pen icon-sm text-muted"></i>
                                        <input type="file" id="img" name="img" accept=".png, .jpg, .jpeg" />
                                        <input type="hidden" name="profile_avatar_remove" />
                                    </label>
                                    <span class="btn btn-xs btn-icon btn-circle btn-white btn-hover-text-primary btn-shadow" data-action="cancel" data-toggle="tooltip" title="ازالة الصورة">
                                        <i class="flaticon-close icon-xs text-muted"></i>
                                    </span>
                                    <span class="btn btn-xs btn-icon btn-circle btn-white btn-hover-text-primary btn-shadow" data-action="remove" data-toggle="tooltip" title="ازالة الصورة">
                                        <i class="flaticon-close icon-xs text-muted"></i>
                                    </span>
                                </div>
                                <span class="form-text text-muted">النوع المسموح بة هي (.png, .jpg, .jpeg) و واكثر حجم مسموح بة ( 2M)</span>

                            </div>
                            <!--end::Col-->
                        </div> --}}

                        <div class="row mb-6">

                            <label class="col-lg-3 col-form-label required fw-bold fs-6">الاسم</label>

                            <div class="col-lg-9 fv-row">
                                <input type="text" name="name" class="form-control form-control-lg form-control-solid" value="{{old('name')}}" />
                            </div>
                            <!--end::Col-->
                        </div>

                        <div class="row mb-6">
                            <!--begin::Label-->
                            <label class="col-lg-3 col-form-label fw-bold fs-6">
                                <span class="required">الايميل</span>
                            </label>
                            <!--end::Label-->
                            <!--begin::Col-->
                            <div class="col-lg-9 fv-row">
                                <input type="email" name="email" class="form-control form-control-lg form-control-solid" value="{{old('email')}}" />
                            </div>
                            <!--end::Col-->
                        </div>
                        <div class="row mb-6">
                            <!--begin::Label-->
                            <label class="col-lg-3 col-form-label fw-bold fs-6">
                                <span class="required">الهاتف</span>
                            </label>
                            <!--end::Label-->
                            <!--begin::Col-->
                            <div class="col-lg-9 fv-row">
                                <input type="number" name="phone" class="form-control form-control-lg form-control-solid"  value="{{old('phone')}}" />
                            </div>
                            <!--end::Col-->
                        </div>
                        <div class="row mb-6">
                            <!--begin::Label-->
                            <label class="col-lg-3 col-form-label fw-bold fs-6">
                                <span class="required">كلمة المرور</span>
                            </label>
                            <!--end::Label-->
                            <!--begin::Col-->
                            <div class="col-lg-9 fv-row">
                                <input type="password" name="password" class="form-control form-control-lg form-control-solid" value="{{old('password')}}" />
                            </div>
                            <!--end::Col-->
                        </div>
                        <div class="row mb-6">
                            <!--begin::Label-->
                            <label class="col-lg-3 col-form-label fw-bold fs-6">
                                <span class="required">تأكيد كلمة المرور</span>
                            </label>
                            <!--end::Label-->
                            <!--begin::Col-->
                            <div class="col-lg-9 fv-row">
                                <input type="password" name="confirm_password" class="form-control form-control-lg form-control-solid" value="{{old('confirm_password')}}" />
                            </div>
                            <!--end::Col-->
                        </div>
                        <div class="row mb-6">
                            <!--begin::Label-->
                            <label class="col-lg-3 col-form-label fw-bold fs-6">
                                <span class="required">كلمة المرور الإضافية</span>
                            </label>
                            <!--end::Label-->
                            <!--begin::Col-->
                            <div class="col-lg-9 fv-row">
                                <input type="password" name="second_password" class="form-control form-control-lg form-control-solid" value="{{old('second_password')}}" />
                            </div>
                            <!--end::Col-->
                        </div>
                        <div class="row mb-6">
                            <label class="col-lg-3 col-form-label fw-bold fs-6">
                                الدور</label>

                            <div class="col-lg-9 fv-row">
                                <select class="form-control" data-control="select2" data-hide-search="true" name="role" required>
                                    <option value="">اختر الدور ...</option>
                                    @foreach($roles as $item)
                                    <option value="{{@$item->id}}">{{@$item->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="row mb-6">
                            <label class="col-lg-3 col-form-label fw-bold fs-6">
                                نوع المشرف
                            </label>

                            <div class="col-lg-9 fv-row">
                                <select class="form-control" data-control="select2" data-hide-search="true" name="user_type">
                                    <option value="">اختر نزع المشرف ...</option>
                                    <option value="financial">
                                        قسم مالي
                                    </option>
                                    <option value="order_management">
                                        إدارة الطلبات
                                    </option>
                                    <option value="admin">
                                        ادمن (المدير)
                                    </option>
                                </select>
                            </div>
                        </div>



                    </div>
                    <!--end::Card body-->
                    <!--begin::Actions-->
                    <div class="card-footer d-flex justify-content-end py-6 px-9">
                        <button type="submit" class="btn btn-primary" id="kt_account_profile_details_submit">حفظ التغييرات</button>
                        <a href="{{route('admin.admins.index')}}" class="btn btn-white">رجوع</a>

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
