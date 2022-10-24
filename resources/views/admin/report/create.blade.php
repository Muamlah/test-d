@extends('admin.layouts.adminLayout') @section('title') الصفحات
@endsection
@section('content')
<div class="post fs-base d-flex flex-column-fluid" id="kt_post">
    <div id="kt_content_container" class="container">
        <div class="card mb-5 mb-xl-10">
            <!--begin::Card header-->
            <div class="card-header border-0 cursor-pointer" role="button" data-bs-toggle="collapse"
                data-bs-target="#kt_account_profile_details" aria-expanded="true"
                aria-controls="kt_account_profile_details">
                <!--begin::Card title-->
                <div class="card-title m-0">
                    <h3 class="fw-bolder m-0">تقرير جديد</h3>
                </div>
                <!--end::Card title-->
            </div>
            <!--begin::Card header-->
            <!--begin::Content-->
            <div id="kt_account_profile_details" class="collapse show">
                <!--begin::Form-->
                <form method="post" action="{{route('admin.report.export')}}"
                    class="form" role="form" id="kt_account_profile_details_form">
                    {{ csrf_field() }}
                    <input type="hidden" name="base_type" value="">
                    <!--begin::Card body-->
                    <div class="card-body border-top p-9">
                        <!--begin::Input group-->
                        @if(session()->has('success'))
                        <h3 style="color:green; text-align:center;"> تم الإضافة بنجاح </h3>
                        <br>
                        @endif
                        @if($errors->any())
                            {!! implode('', $errors->all('<div style="color: red; font-weight: bolder; font-size: 18px; text-align: center;">:message</div>')) !!}
                        @endif
                        <div class="row ">
                            <div class="col-4">
                                <label class="col-form-label required fw-bold fs-6">نوع </label>
                                <div class="fv-row">
                                    <select name="type" id="type" required data-placeholder="اختر .." class="form-control form-control-lg form-control-solid">
                                            <option  value="0" >كل الحسابات</option>
                                            <option  value="1" >الاحصائات فقط</option>

                                    </select>
                                </div>

                            </div>
                            <div  class="col-4">
                                <label class="col-form-label required fw-bold fs-6">من تاريخ </label>
                                <div class="fv-row">
                                    <input type="date" name="start" required class="form-control form-control-lg form-control-solid" value="" />
                                </div>
                            </div>
                            <div  class="col-4">
                                <label class="col-form-label required fw-bold fs-6">الى تاريخ </label>
                                <div class="fv-row">
                                    <input type="date" name="to" required class="form-control form-control-lg form-control-solid" value="" />
                                </div>
                            </div>

                            <!--end::Col-->
                        </div>
                        <div class="row ">
                            <div class="col-12">
                            <label class="col-form-label required fw-bold fs-6">الحالة </label>
                            </div>
                            @foreach($status as $item)
                            <div class="col-3">
                                <input type="checkbox" checked  id="{{$item->id}}" name="status[]" value="{{$item->id}}">
                                <label for="{{$item->id}}">{{$item->name}}</label><br>
                            </div>
                            @endforeach
                        </div>
                        <!--end::Input group-->
                    </div>
                    <!--end::Card body-->
                    <!--begin::Actions-->
                    <div class="card-footer d-flex justify-content-end py-6 px-9">
                        <!-- <button type="reset" class="btn btn-white btn-active-light-primary me-2">Discard</button> -->
                        <button type="submit" class="btn btn-primary" id="kt_account_profile_details_submit">تصدير الى اكسل</button>
                    </div>
                    <!--end::Actions-->
                </form>
                <!--end::Form-->
            </div>
            <!--end::Content-->
        </div>
    </div>
</div>
<style>
    .filter-option-inner-inner{
        text-align: right
    }
</style>
@endsection
@section('script')
@include('admin.include.script.script_form')
@endsection


