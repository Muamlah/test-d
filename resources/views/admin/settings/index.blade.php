@extends('admin.layouts.adminLayout')
@section('title')اعدادات الموقع
@endsection

@section('headings')
    @include('admin.include.headings',[

        'title1'        => ' الإعدادات',
        'link1'         => 'javascript:;',
        'title2'        => ' اعدادات الموقع',
        'link2'         => route('admin.settings'),

    ])
@endsection

@section('content')

    <div class="post fs-base d-flex flex-column-fluid" id="kt_post">

        <div id="kt_content_container" class="container">

            <div class="card">
                <div class="card-header">
                    <div class="card-title fs-3 fw-bolder">اعدادات الموقع </div>
                </div>

                <form method="post" action="{{route('admin.updateSettings')}}"
                    enctype="multipart/form-data" class="form" role="form" id="kt_project_settings_form">
                    {{ csrf_field() }}
                <!--begin::Card body-->
                    <div class="card-body p-9">

                        <div class="row mb-8">
                            <div class="col-xl-3">
                                <div class="fs-6 fw-bold mt-2 mb-3"> اسم الموقع</div>
                            </div>
                            <div class="col-xl-3 fv-row">
                                <input type="text" value="{{ @$data->sitename }}" name="sitename" class="form-control form-control-solid">
                            </div>

                            <div class="col-xl-3">
                                <div class="fs-6 fw-bold mt-2 mb-3">نسبة الموقع</div>
                            </div>
                            <div class="col-xl-3 fv-row">
                                <input type="text" value="{{ @$data->profit }}" name="profit" class="form-control form-control-solid">
                            </div>

                        </div>

                        <div class="row mb-8">

                            <div class="col-xl-3">
                                <div class="fs-6 fw-bold mt-2 mb-3">الحد الاعلى لسعر الطلب</div>
                            </div>
                            <div class="col-xl-3 fv-row">
                                <input type="text" value="{{ @$data->order_price_limit }}" name="order_price_limit"   class="form-control form-control-solid">
                            </div>


                            <div class="col-xl-3">
                                <div class="fs-6 fw-bold mt-2 mb-3">عدد طلبات العميل في اليوم (طلب خاص)</div>
                            </div>
                            <div class="col-xl-3 fv-row">
                                <input type="text" value="{{ @$data->private_order_limit }}" name="private_order_limit"   class="form-control form-control-solid">
                            </div>
                        </div>

                        <div class="row mb-8">
                            <div class="col-xl-3">
                                <div class="fs-6 fw-bold mt-2 mb-3">عدد طلبات العميل في اليوم (خدمة الكترونية)</div>
                            </div>
                            <div class="col-xl-3 fv-row">
                                <input type="text" value="{{ @$data->electronic_order_limit }}" name="electronic_order_limit" class="form-control form-control-solid">
                            </div>
                            <div class="col-xl-3">
                                <div class="fs-6 fw-bold mt-2 mb-3">عدد طلبات العميل في اليوم (طلب عام)</div>
                            </div>
                            <div class="col-xl-3 fv-row">
                                <input type="text" value="{{ @$data->public_order_limit }}" name="public_order_limit" class="form-control form-control-solid">
                            </div>
                        </div>

                        <div class="row mb-8">


                            <div class="col-xl-3">
                                <div class="fs-6 fw-bold mt-2 mb-3">عدد الخدمات في اليوم لمقدم الخدمة (خدمة الكترونية)</div>
                            </div>
                            <div class="col-xl-3 fv-row">
                                <input type="text" value="{{ @$data->electronic_order_provider_limit }}" name="electronic_order_provider_limit" class="form-control form-control-solid">
                            </div>


                            <div class="col-xl-3">
                                <div class="fs-6 fw-bold mt-2 mb-3">عدد العروض في اليوم لمقدم الخدمة (طلب عام)</div>
                            </div>
                            <div class="col-xl-3 fv-row">
                                <input type="text" value="{{ @$data->offers_public_order_limit }}" name="offers_public_order_limit" class="form-control form-control-solid">
                            </div>

                        </div>

                        <div class="row mb-8">
                        <label class="col-xl-3 col-form-label fw-bold fs-6">تفعيل المستخدمين</label>

                        <div class="col-lg-3 fv-row">
                            <select name="active_users" aria-label="Select a Timezone" data-placeholder="اختر .." class="form-select form-select-solid form-select-lg">
                                <option value="">اختر ..</option>
                                <option  value="auto" @if(@$data->active_users == 'auto') selected @endif>تلقائي</option>
                                <option  value="email" @if(@$data->active_users == 'email') selected @endif>تفعيل برسالة عبر البريد الالكتروني</option>
                                <option  value="sms" @if(@$data->active_users == 'sms') selected @endif>تفعيل برسالة عبر sms</option>
                            </select>
                        </div>


                            <label class="col-xl-3 col-form-label fw-bold fs-6">طريقة تفعيل استلام الطلب</label>

                            <div class="col-lg-3 fv-row">
                                <select name="active_order" aria-label="Select a Timezone" data-placeholder="اختر .." class="form-select form-select-solid form-select-lg">
                                    <option value="">اختر ..</option>
                                    <option  value="password" @if(@$data->active_order == 'password') selected @endif>تفعيل بتأكيد كلمة المرور</option>
                                    <option  value="sms" @if(@$data->active_order == 'sms') selected @endif>تفعيل برسالة عبر sms</option>
                                </select>
                            </div>

                        </div>

                        <div class="row mb-8">
                            <label class="col-xl-3 col-form-label fw-bold fs-6">حالة الموقع</label>

                            <div class="col-lg-3 fv-row">
                                <select name="status_site" aria-label="Select a Timezone" data-placeholder="اختر .." class="form-select form-select-solid form-select-lg">
                                    <option  value="open" @if(@$data->status_site == 'open') selected @endif>مفتوح</option>
                                    <option  value="close" @if(@$data->status_site == 'close') selected @endif>مغلق</option>
                                </select>
                            </div>

                        </div>

                        <div class="row mb-8">
                            <div class="col-xl-3">
                                <div class="fs-6 fw-bold mt-2 mb-3">رسالة غلق الموقع</div>
                            </div>
                            <div class="col-xl-9 fv-row">
                                <textarea type="text" rows="2" name="status_message" class="form-control form-control-solid">{{@$data->status_message}}</textarea>
                            </div>

                        </div>
                        <div class="row mb-8">
                            <div class="col-xl-3">
                                <div class="fs-6 fw-bold mt-2 mb-3">script google analytics</div>
                            </div>
                            <div class="col-xl-9 fv-row">
                                <textarea type="text" rows="2" name="script_google_analytics" class="form-control form-control-solid">{{@$data->script_google_analytics}}</textarea>
                            </div>

                        </div>
                        <div class="row mb-8">
                            <div class="col-xl-3">
                                <div class="fs-6 fw-bold mt-2 mb-3">iframe google analytics</div>
                            </div>
                            <div class="col-xl-9 fv-row">
                                <textarea type="text" rows="2" name="iframe_google_analytics" class="form-control form-control-solid">{{@$data->iframe_google_analytics}}</textarea>
                            </div>

                        </div>
{{--                        <div class="row mb-8">--}}
{{--                            <label class="col-xl-3 col-form-label fw-bold fs-6">حالة طلبات الخدمات الإلكترونية</label>--}}

{{--                            <div class="col-lg-3 fv-row">--}}
{{--                                <select name="eservices_orders_status" data-placeholder="اختر .." class="form-select selectpicker form-select-solid form-select-lg">--}}
{{--                                    <option  value="active" @if(@$data->eservices_orders_status == 'active') selected @endif>فعال</option>--}}
{{--                                    <option  value="passive" @if(@$data->eservices_orders_status == 'passive') selected @endif>غير فعال</option>--}}
{{--                                </select>--}}
{{--                            </div>--}}

{{--                        </div>--}}
                        <div class="row mb-8">
                            <label class="col-xl-3 col-form-label fw-bold fs-6">طلبات الخدمات الإلكترونية</label>

                            <div class="col-lg-3 fv-row">
                                <select name="public_orders_status" data-placeholder="اختر .." class="form-select selectpicker form-select-solid form-select-lg">
                                    <option  value="active" @if(@$data->public_orders_status == 'active') selected @endif>فعال</option>
                                    <option  value="passive" @if(@$data->public_orders_status == 'passive') selected @endif>غير فعال</option>
                                </select>
                            </div>

                        </div>
                        <div class="row mb-8">
                            <label class="col-xl-3 col-form-label fw-bold fs-6">حالة طلبات التعميد الخاص</label>

                            <div class="col-lg-3 fv-row">
                                <select name="private_orders_status" data-placeholder="اختر .." class="form-select selectpicker form-select-solid form-select-lg">
                                    <option  value="active" @if(@$data->private_orders_status == 'active') selected @endif>فعال</option>
                                    <option  value="passive" @if(@$data->private_orders_status == 'passive') selected @endif>غير فعال</option>
                                </select>
                            </div>

                        </div>

                        {{-- <div class="row mb-8">
                            <label class="col-xl-3 col-form-label fw-bold fs-6">حالة الدفع</label>
                            <div class="col-lg-3 fv-row">
                                <select name="production" data-placeholder="اختر .." class="form-select selectpicker form-select-solid form-select-lg">
                                    <option  value="1" @if(@$data->production == 1) selected @endif>دفع حقيقي</option>
                                    <option  value="0" @if(@$data->production == 0) selected @endif>دفع تجريبي</option>
                                </select>
                            </div>
                        </div> --}}

                         <div class="row mb-8">
                            <label class="col-xl-3 col-form-label fw-bold fs-6">بوابة الدفع</label>
                            <div class="col-lg-3 fv-row">
                                <select name="payment_gateway_type" data-placeholder="اختر .." class="form-select selectpicker form-select-solid form-select-lg">
                                    <option  value="rajhi_bank" @if(@$data->payment_gateway_type == 'rajhi_bank') selected @endif>Rajhi Bank</option>
                                    <option  value="hyperpay" @if(@$data->payment_gateway_type == 'hyperpay') selected @endif>Hyperpay</option>
                                </select>
                            </div>
                        </div>

                        <div class="row mb-8">
                            <div class="col-xl-3">
                                <div class="fs-6 fw-bold mt-2 mb-3">نسبة الوكيل من الطلب</div>
                            </div>
                            <div class="col-xl-3 fv-row">
                                <input type="text" value="{{ @$data->agent_per }}" name="agent_per" class="form-control form-control-solid">
                            </div>

                        </div>
                        <div class="row mb-8">
                            <div class="col-xl-3">
                                <div class="fs-6 fw-bold mt-2 mb-3">نسبة كود الخصم لصاحب الكود</div>
                            </div>
                            <div class="col-xl-3 fv-row">
                                <input type="text" value="{{ @$data->reference_code_discount_for_owner }}" name="reference_code_discount_for_owner" class="form-control form-control-solid">
                            </div>


                            <div class="col-xl-3">
                                <div class="fs-6 fw-bold mt-2 mb-3">نسبة كود الخصم لمستخدم الكود</div>
                            </div>
                            <div class="col-xl-3 fv-row">
                                <input type="text" value="{{ @$data->reference_code_discount_for_user }}" name="reference_code_discount_for_user" class="form-control form-control-solid">
                            </div>

                        </div>
                        <div class="row mb-8">
                            <label class="col-xl-3 col-form-label fw-bold fs-6">
                                المدة الزمنية لإيقاف الخدمات الالكترونية
                            </label>

                            <div class="col-lg-3 fv-row">
                                <select name="eservice_time" data-placeholder="اختر .." class="form-select selectpicker form-select-solid form-select-lg">
                                    <option  value="0" @if(@$data->eservice_time == '0') selected @endif>ايقاف</option>
                                    <option  value="1" @if(@$data->eservice_time == '1') selected @endif>يوم </option>
                                    <option  value="7" @if(@$data->eservice_time == '7') selected @endif>اسبوع</option>
                                    <option  value="30" @if(@$data->eservice_time == '30') selected @endif>شهر</option>
                                </select>
                            </div>

                        </div>
                        <div class="row mb-8">
                            <label class="col-xl-3 col-form-label fw-bold fs-6">
                                المدة الزمنية لإيقاف الطلبات العامة
                            </label>
                            <div class="col-lg-3 fv-row">
                                <select name="public_order_time" data-placeholder="اختر .." class="form-select selectpicker form-select-solid form-select-lg">
                                    <option  value="0" @if(@$data->public_order_time == '0') selected @endif>ايقاف</option>
                                    <option  value="1" @if(@$data->public_order_time == '1') selected @endif>يوم </option>
                                    <option  value="7" @if(@$data->public_order_time == '7') selected @endif>اسبوع</option>
                                    <option  value="30" @if(@$data->public_order_time == '30') selected @endif>شهر</option>
                                </select>
                            </div>
                        </div>
                        <div class="row mb-8">
                            <div class="col-xl-3">
                                <div class="fs-6 fw-bold mt-2 mb-3">البريد الإلكتروني</div>
                            </div>
                            <div class="col-xl-3 fv-row">
                                <input type="email" value="{{ @$data->email }}" name="email" class="form-control form-control-solid">
                            </div>
                        </div>
                    </div>
                    <!--end::Card body-->
                    <!--begin::Card footer-->
                    <div class="card-footer d-flex justify-content-center py-6 px-9">
                        <button type="submit" class="btn btn-primary" id="kt_project_settings_submit">حفظ</button>
                    </div>
                    <!--end::Card footer-->
                </form>
                <!--end:Form-->
            </div>

        </div>

    </div>
<style>
    .filter-option-inner-inner{
        text-align: right
    }
</style>
@endsection
