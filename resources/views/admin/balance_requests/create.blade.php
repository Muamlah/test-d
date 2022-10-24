@extends('admin.layouts.adminLayout') @section('title') طلبات سحب الرصيد
@endsection

@section('headings')
    @include('admin.include.headings',[

        'title1'        => ' طلبات سحب الرصيد',
        'link1'         => route('admin.balance_requests'),
        'title2'        => 'تعديل طلب سحب الرصيد',
        'link2'         => 'javascript:;',

    ])
@endsection

@section('content')
    <div class="post fs-base d-flex flex-column-fluid" id="kt_post">

        <div id="kt_content_container" class="container">
            @if (Session::get('success') )
                <div class="alert alert-success">
                    <ul>
                        <li>{{Session::get('success')}}</li>
                    </ul>
                </div>
            @endif
            @if (Session::get('error') )
                <div class="alert alert-danger">
                    <ul>
                        <li>{{Session::get('error')}}</li>
                    </ul>
                </div>
            @endif
            <div class="card mb-5 mb-xl-10">
                <!--begin::Card header-->
                <div class="card-header border-0 cursor-pointer" role="button" data-bs-toggle="collapse"
                     data-bs-target="#kt_account_profile_details" aria-expanded="true"
                     aria-controls="kt_account_profile_details">
                    <!--begin::Card title-->
                    <div class="card-title m-0">
                        <h3 class="fw-bolder m-0">طلبات سحب الرصيد</h3>
                    </div>
                    <!--end::Card title-->
                </div>
                <!--begin::Card header-->
                <!--begin::Content-->
                <div id="kt_account_profile_details" class="collapse show">

                    <!--begin::Form-->
                    <form method="post" action="{{route('admin.storeBalanceRequest')}}"
                          class="form" role="form" id="kt_account_profile_details_form" enctype="multipart/form-data">
                        {{ csrf_field() }}
                        <input type="text" name="user_id" hidden class="form-control form-control-lg form-control-solid" value="{{$user->id}}"/>
                        <!--begin::Card body-->
                        <div class="card-body border-top p-9">
                            <!--begin::Input group-->
                            <div class="row mb-6">
                                <label class="col-lg-3 col-form-label required fw-bold fs-6">موبايل العميل </label>
                                <div class="col-lg-9 fv-row">
                                    <input type="text" readonly class="form-control form-control-lg form-control-solid" value="{{$user->phone}}"/>
                                </div>
                            </div>

                            <div class="row mb-6">
                                <label class="col-lg-3 col-form-label required fw-bold fs-6">اسم العميل </label>
                                <div class="col-lg-9 fv-row">
                                    <input type="text" readonly class="form-control form-control-lg form-control-solid" value="{{$user->name}}"/>
                                </div>
                            </div>

                            <div class="row mb-6">
                                <label class="col-lg-3 col-form-label required fw-bold fs-6">الرصيد المتاح </label>
                                <div class="col-lg-9 fv-row">
                                    <input type="text" readonly class="form-control form-control-lg form-control-solid" value="{{$user->available_balance}}"/>
                                </div>
                            </div>
                            <div class="row mb-6">
                                <label class="col-lg-3 col-form-label required fw-bold fs-6">اسم الحساب</label>
                                <div class="col-lg-9 fv-row">
                                    <input type="text"  class="form-control form-control-lg form-control-solid" value="{{@$user->creditCard->name}}"/>
                                </div>
                            </div>
                            <div class="row mb-6">
                                <label class="col-lg-3 col-form-label required fw-bold fs-6">رقم الحساب</label>
                                <div class="col-lg-9 fv-row">
                                    <input type="text"  class="form-control form-control-lg form-control-solid" value="{{@$user->creditCard->number}}"/>
                                </div>
                            </div>
                            <div class="row mb-6">
                                <label class="col-lg-3 col-form-label required fw-bold fs-6">رقم الأيبان </label>
                                <div class="col-lg-9 fv-row">
                                    <input type="text"  class="form-control form-control-lg form-control-solid" value="{{@$user->creditCard->account_number}}"/>
                                </div>
                            </div>
                            <div class="row mb-6">
                                <label class="col-lg-3 col-form-label required fw-bold fs-6">قيمة الرصيد </label>
                                <div class="col-lg-9 fv-row">
                                    <input type="text" name="amount" required class="form-control form-control-lg form-control-solid" value=""/>
                                </div>
                            </div>

                            <div class="row mb-6">
                                <label class="col-lg-3 col-form-label required fw-bold fs-6">تاريخ الطلب </label>
                                <div class="col-lg-9 fv-row">
                                    <input type="date" required class="form-control form-control-lg form-control-solid" value=""/>
                                </div>
                            </div>

                            <div class="row mb-6">
                                <label class="col-lg-3 col-form-label required fw-bold fs-6">الحالة</label>

                                <div class="col-lg-9 fv-row">
                                    <select name="payment_status" data-placeholder="اختر .." class="form-select selectpicker form-select-solid form-select-lg">
                                        <option value="waiting" @if(@$data->payment_status == "waiting") selected @endif>قيد الانتظار</option>
                                        <option value="completed" @if(@$data->payment_status == "completed") selected @endif>تم التحويل</option>
                                        <option value="refused" @if(@$data->payment_status == "refused") selected @endif>مرفوض من الادمن</option>
                                    </select>
                                </div>

                            </div>

                            <div class="row mb-6">
                                <label class="col-lg-3 col-form-label  fw-bold fs-6">رقم الحوالة </label>
                                <div class="col-lg-9 fv-row">
                                    <input type="text"  name="ref"
                                           class="form-control form-control-lg form-control-solid" value=""/>
                                </div>
                            </div>

                            <div class="row mb-6">
                                <label class="col-lg-3 col-form-label required fw-bold fs-6">تفاصيل </label>
                                <div class="col-lg-9 fv-row">
                                    <textarea required name="description" class="form-control form-control-lg form-control-solid"></textarea>
                                </div>
                                <!--end::Col-->
                            </div>
                            <div class="row mb-6">
                                <label class="col-lg-3 col-form-label  fw-bold fs-6">رفع ملف </label>
                                <div class="col-lg-9 fv-row">
                                    <input type="file" name="file" class="form-control form-control-lg form-control-solid"/>
                                </div>
                            </div>
                        </div>
                        <!--end::Card body-->
                        <!--begin::Actions-->
                        <div class="card-footer d-flex justify-content-end py-6 px-9">
                            <!-- <button type="reset" class="btn btn-white btn-active-light-primary me-2">Discard</button> -->
                            <button type="submit" class="btn btn-primary" id="kt_account_profile_details_submit">حفظ
                                البيانات
                            </button>
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
@section('script')
    @include('admin.include.script.script_form')
@endsection
