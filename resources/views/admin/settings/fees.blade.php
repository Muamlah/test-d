@extends('admin.layouts.adminLayout')
@section('title')رسوم التعميد
@endsection

@section('headings')
    @include('admin.include.headings',[

        'title1'        => ' الإعدادات',
        'link1'         => 'javascript:;',
        'title2'        => ' رسوم التعميد',
        'link2'         => route('admin.fees'),

    ])
@endsection


@section('content')

        <div class="post fs-base d-flex flex-column-fluid" id="kt_post">

            <div id="kt_content_container" class="container">

                <div class="card">
                    <div class="card-header">
                        <div class="card-title fs-3 fw-bolder">رسوم التعميد </div>
                    </div>

                        <form method="post" action="{{route('admin.updateFees')}}"
                              enctype="multipart/form-data" class="form" role="form" id="kt_project_settings_form">
                        {{ csrf_field() }}
                        <!--begin::Card body-->
                        <div class="card-body p-9">
                            <div class="row mb-8">
                            <div class="card-header border-0 cursor-pointer" role="button" data-bs-toggle="collapse" data-bs-target="#kt_account_connected_accounts" aria-expanded="true" aria-controls="kt_account_connected_accounts">
                                <div class="card-title m-0">
                                    <h3 class="fw-bolder m-0" style="color: #0d6efd">قسم طلب تعميد خاص > رسوم المنصة : على العميل</h3>
                                </div>
                            </div>
                            </div>

                            <div class="row mb-8">
                                <div class="col-xl-3">
                                    <div class="fs-6 fw-bold mt-2 mb-3"> رسوم المنصة %</div>
                                </div>
                                <div class="col-xl-3 fv-row">
                                    <input type="text" value="{{ @$data->client_platform_fee }}" name="client_platform_fee" class="form-control form-control-solid">
                                </div>


                                <div class="col-xl-3">
                                    <div class="fs-6 fw-bold mt-2 mb-3">اذا كان قيمة الطلب أقل من ٣٣٠٠ (ريال)</div>
                                </div>
                                <div class="col-xl-3 fv-row">
                                    <input type="text" value="{{ @$data->client_less_than_3300 }}" name="client_less_than_3300" class="form-control form-control-solid">
                                </div>

                            </div>

                            <div class="row mb-8">
                                <div class="col-xl-3">
                                    <div class="fs-6 fw-bold mt-2 mb-3"> رسوم إلغاء الطلب (ريال)</div>
                                </div>
                                <div class="col-xl-3 fv-row">
                                    <input type="text" value="{{ @$data->client_cancellation }}" name="client_cancellation" class="form-control form-control-solid">
                                </div>



                                <div class="col-xl-3">
                                    <div class="fs-6 fw-bold mt-2 mb-3">اذا كان قيمة الطلب أقل من ١٠٠٠ (ريال)</div>
                                </div>
                                <div class="col-xl-3 fv-row">
                                    <input type="text" value="{{ @$data->client_less_than_1000 }}" name="client_less_than_1000"   class="form-control form-control-solid">
                                </div>
                            </div>

{{--                            <div class="row mb-8">--}}
{{--                                <div class="card-header border-0 cursor-pointer" role="button" data-bs-toggle="collapse" data-bs-target="#kt_account_connected_accounts" aria-expanded="true" aria-controls="kt_account_connected_accounts">--}}
{{--                                    <div class="card-title m-0">--}}
{{--                                        <h3 class="fw-bolder m-0" style="color: #0d6efd">قسم طلب تعميد عام > رسوم المنصة : على العميل (على الطلب)--}}
{{--                                        </h3>--}}
{{--                                    </div>--}}
{{--                                </div>--}}
{{--                            </div>--}}

{{--                            <div class="row mb-8">--}}



{{--                                <div class="col-xl-3">--}}
{{--                                    <div class="fs-6 fw-bold mt-2 mb-3"> اذا كان قيمة الطلب اكبر من 3300 (%)</div>--}}
{{--                                </div>--}}
{{--                                <div class="col-xl-3 fv-row">--}}
{{--                                    <input type="text" value="{{ @$data->public_order_platform_fee }}" name="public_order_platform_fee" class="form-control form-control-solid">--}}
{{--                                </div>--}}

{{--                                <div class="col-xl-3">--}}
{{--                                    <div class="fs-6 fw-bold mt-2 mb-3"> اذا كان قيمة الطلب اقل من 3300 (ريال)</div>--}}
{{--                                </div>--}}
{{--                                <div class="col-xl-3 fv-row">--}}
{{--                                    <input type="text" value="{{ @$data->public_order_less_than_3300}}" name="public_order_less_than_3300" class="form-control form-control-solid">--}}
{{--                                </div>--}}


{{--                            </div>--}}
{{--                            <div class="row mb-8">--}}

{{--                                <div class="col-xl-3">--}}
{{--                                    <div class="fs-6 fw-bold mt-2 mb-3"> اذا كان قيمة الطلب اقل من 1000 (ريال)</div>--}}
{{--                                </div>--}}
{{--                                <div class="col-xl-3 fv-row">--}}
{{--                                    <input type="text" value="{{ @$data->public_order_less_than_1000}}" name="public_order_less_than_1000" class="form-control form-control-solid">--}}
{{--                                </div>--}}

{{--                                <div class="col-xl-3">--}}
{{--                                    <div class="fs-6 fw-bold mt-2 mb-3">ضريبة القيمة المضافة (%)</div>--}}
{{--                                </div>--}}
{{--                                <div class="col-xl-3 fv-row">--}}
{{--                                    <input type="text" value="{{ @$data->public_order_added_tax }}" name="public_order_added_tax" class="form-control form-control-solid">--}}
{{--                                </div>--}}
{{--                            </div>--}}


{{--                            <div class="row mb-8">--}}
{{--                                <div class="card-header border-0 cursor-pointer" role="button" data-bs-toggle="collapse" data-bs-target="#kt_account_connected_accounts" aria-expanded="true" aria-controls="kt_account_connected_accounts">--}}
{{--                                    <div class="card-title m-0">--}}
{{--                                        <h3 class="fw-bolder m-0" style="color: #0d6efd">قسم طلب تعميد عام > رسوم المنصة : على مقدم الخدمة (على العرض)--}}
{{--                                        </h3>--}}
{{--                                    </div>--}}
{{--                                </div>--}}
{{--                            </div>--}}

{{--                            <div class="row mb-8">--}}

{{--                                <div class="col-xl-3">--}}
{{--                                    <div class="fs-6 fw-bold mt-2 mb-3"> اذا كان قيمة العرض اكبر من 3300 (%)</div>--}}
{{--                                </div>--}}
{{--                                <div class="col-xl-3 fv-row">--}}
{{--                                    <input type="text" value="{{ @$data->offer_platform_fee }}" name="offer_platform_fee" class="form-control form-control-solid">--}}
{{--                                </div>--}}

{{--                                <div class="col-xl-3">--}}
{{--                                    <div class="fs-6 fw-bold mt-2 mb-3"> اذا كان قيمة العرض اقل من 3300 (ريال)</div>--}}
{{--                                </div>--}}
{{--                                <div class="col-xl-3 fv-row">--}}
{{--                                    <input type="text" value="{{ @$data->offer_less_than_3300}}" name="offer_less_than_3300" class="form-control form-control-solid">--}}
{{--                                </div>--}}


{{--                            </div>--}}
{{--                            <div class="row mb-8">--}}

{{--                                <div class="col-xl-3">--}}
{{--                                    <div class="fs-6 fw-bold mt-2 mb-3">اذا كان قيمة الطلب اقل من 1000 (ريال)</div>--}}
{{--                                </div>--}}
{{--                                <div class="col-xl-3 fv-row">--}}
{{--                                    <input type="text" value="{{ @$data->offer_less_than_1000 }}" name="offer_less_than_1000" class="form-control form-control-solid">--}}
{{--                                </div>--}}
{{--                                <div class="col-xl-3">--}}
{{--                                    <div class="fs-6 fw-bold mt-2 mb-3">ضريبة القيمة المضافة (%)</div>--}}
{{--                                </div>--}}
{{--                                <div class="col-xl-3 fv-row">--}}
{{--                                    <input type="text" value="{{ @$data->offer_added_tax }}" name="offer_added_tax" class="form-control form-control-solid">--}}
{{--                                </div>--}}
{{--                            </div>--}}



                            <div class="row mb-8">
                                <div class="card-header border-0 cursor-pointer" role="button" data-bs-toggle="collapse" data-bs-target="#kt_account_connected_accounts" aria-expanded="true" aria-controls="kt_account_connected_accounts">
                                    <div class="card-title m-0">
                                        <h3 class="fw-bolder m-0" style="color: #0d6efd">قسم الخدمات الالكترونية > رسوم المنصة : على مقدم الخدمة</h3>
                                    </div>
                                </div>
                            </div>

                            <div class="row mb-8">

                                <div class="col-xl-3">
                                    <div class="fs-6 fw-bold mt-2 mb-3">رسوم المنصة لمقدم الخدمة %</div>
                                </div>
                                <div class="col-xl-3 fv-row">
                                    <input type="text" value="{{ @$data->service_platform_fee }}" name="service_platform_fee" class="form-control form-control-solid">
                                </div>

                                <div class="col-xl-3">
                                    <div class="fs-6 fw-bold mt-2 mb-3">رسوم المنصة للعميل %</div>
                                </div>
                                <div class="col-xl-3 fv-row">
                                    <input type="text" value="{{ @$data->service_client_fees }}" name="service_client_fees" class="form-control form-control-solid">
                                </div>


                            </div>

                            <div class="row mb-8">

                                <div class="col-xl-3">
                                    <div class="fs-6 fw-bold mt-2 mb-3">رسوم إلغاء الطلب (ريال)</div>
                                </div>
                                <div class="col-xl-3 fv-row">
                                    <input type="text" value="{{ @$data->service_cancellation }}" name="service_cancellation" class="form-control form-control-solid">

                                </div>

                                <div class="col-xl-3">
                                    <div class="fs-6 fw-bold mt-2 mb-3">ضريبة القيمة المضافة</div>
                                </div>
                                <div class="col-xl-3 fv-row">
                                    <input type="text" value="{{ @$data->value_added_tax }}" name="value_added_tax" class="form-control form-control-solid">

                                </div>



                            </div>


                            <div class="row mb-8">
                                <div class="card-header border-0 cursor-pointer" role="button" data-bs-toggle="collapse" data-bs-target="#kt_account_connected_accounts" aria-expanded="true" aria-controls="kt_account_connected_accounts">
                                    <div class="card-title m-0">
                                        <h3 class="fw-bolder m-0" style="color: #0d6efd">رسوم بوابة الدفع</h3>
                                    </div>
                                </div>
                            </div>

                            <div class="row mb-8">

                                <div class="col-xl-3">
                                    <div class="fs-6 fw-bold mt-2 mb-3"> رسوم بوابة الدفع على كل عملية دفع (ريال)
                                    </div>
                                </div>
                                <div class="col-xl-3 fv-row">
                                    <input type="text" value="{{@$data->payment_gateway_fee }}" name="payment_gateway_fee" class="form-control form-control-solid">

                                </div>

                                <div class="col-xl-3">
                                    <div class="fs-6 fw-bold mt-2 mb-3"> رسوم إلغاء الطلب (ريال)
                                    </div>
                                </div>
                                <div class="col-xl-3 fv-row">
                                    <input type="text" value="{{ @$data->payment_gateway_cancellation_fee }}" name="payment_gateway_cancellation_fee" class="form-control form-control-solid">

                                </div>
                            </div>

                            <div class="row mb-8">

                                <div class="col-xl-3">
                                    <div class="fs-6 fw-bold mt-2 mb-3">عند الغاء الطلب يسترجع (ريال)
                                    </div>
                                </div>
                                <div class="col-xl-3 fv-row">
                                    <input type="text" value="{{ @$data->payment_gateway_refunded }}" name="payment_gateway_refunded" class="form-control form-control-solid">
                                </div>
                            </div>



                            <div class="row mb-8">
                                <div class="card-header border-0 cursor-pointer" role="button" data-bs-toggle="collapse" data-bs-target="#kt_account_connected_accounts" aria-expanded="true" aria-controls="kt_account_connected_accounts">
                                    <div class="card-title m-0">
                                        <h3 class="fw-bolder m-0" style="color: #0d6efd">رسوم البنك
                                        </h3>
                                    </div>
                                </div>
                            </div>
                            <div class="row mb-8">

                                <div class="col-xl-3">
                                    <div class="fs-6 fw-bold mt-2 mb-3">رسوم البنك
                                    </div>
                                </div>
                                <div class="col-xl-3 fv-row">
                                    <input type="text" value="{{ @$data->bank_fees }}" name="bank_fees" class="form-control form-control-solid">
                                </div>

                                <div class="col-xl-3">
                                    <div class="fs-6 fw-bold mt-2 mb-3">رسوم إلغاء الطلب (ريال)
                                    </div>
                                </div>
                                <div class="col-xl-3 fv-row">
                                    <input type="text" value="{{ @$data->bank_cancellation_fee }}" name="bank_cancellation_fee" class="form-control form-control-solid">
                                </div>
                            </div>

                            <div class="row mb-8">

                                <div class="col-xl-3">
                                    <div class="fs-6 fw-bold mt-2 mb-3">عند الغاء الطلب يسترجع (ريال)
                                    </div>
                                </div>
                                <div class="col-xl-3 fv-row">
                                    <input type="text" value="{{ @$data->bank_refunded }}" name="bank_refunded" class="form-control form-control-solid">
                                </div>
                            </div>

                            <div class="row mb-8">
                                <div class="card-header border-0 cursor-pointer" role="button" data-bs-toggle="collapse" data-bs-target="#kt_account_connected_accounts" aria-expanded="true" aria-controls="kt_account_connected_accounts">
                                    <div class="card-title m-0">
                                        <h3 class="fw-bolder m-0" style="color: #0d6efd">العمولات
                                        </h3>
                                    </div>
                                </div>
                            </div>
                            <div class="row mb-8">

                                <div class="col-xl-3">
                                    <div class="fs-6 fw-bold mt-2 mb-3">عمولة الموظفين %</div>
                                </div>
                                <div class="col-xl-3 fv-row">
                                    <input type="text" value="{{ @$data->staff_commission }}" name="staff_commission" class="form-control form-control-solid">
                                </div>

                                <div class="col-xl-3">
                                    <div class="fs-6 fw-bold mt-2 mb-3">عمولة المسوقين %</div>
                                </div>
                                <div class="col-xl-3 fv-row">
                                    <input type="text" value="{{ @$data->marketers_commission }}" name="marketers_commission" class="form-control form-control-solid">
                                </div>
                            </div>
                            <div class="row mb-8">
                                <div class="col-xl-3">
                                    <div class="fs-6 fw-bold mt-2 mb-3">عمولة التسويق بالعمولة %</div>
                                </div>
                                <div class="col-xl-3 fv-row">
                                    <input type="text" value="{{ @$data2->affiliate }}" name="affiliate" class="form-control form-control-solid">
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

@endsection
