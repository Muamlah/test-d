@extends('admin.layouts.adminLayout')
@section('title') طلبات سحب الرصيد
@endsection

@section('headings')
    @include('admin.include.headings',[

        'title1'        => ' طلبات سحب الرصيد',
        'link1'         => route('admin.balance_requests'),

    ])
@endsection

@section('content')
    <!--begin::Notice-->
    <!--end::Notice-->

    <div class="post fs-base d-flex flex-column-fluid" id="kt_post">

        <!--begin::Container-->
        <div id="kt_content_container" class="container">
            <!--begin::Row-->
            <div class="">
                <!--begin::Col-->
                @if ($message = Session::get('success') )

                    <div class="notice d-flex bg-light-success rounded border-success border border-dashed p-6">
                        <!--begin::Icon-->
                        <!--begin::Svg Icon | path: icons/stockholm/General/Shield-check.svg-->
                        <span class="svg-icon svg-icon-2tx svg-icon-success me-4">
                            <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                    <rect x="0" y="0" width="24" height="24" />
                                    <path d="M4,4 L11.6314229,2.5691082 C11.8750185,2.52343403 12.1249815,2.52343403 12.3685771,2.5691082 L20,4 L20,13.2830094 C20,16.2173861 18.4883464,18.9447835 16,20.5 L12.5299989,22.6687507 C12.2057287,22.8714196 11.7942713,22.8714196 11.4700011,22.6687507 L8,20.5 C5.51165358,18.9447835 4,16.2173861 4,13.2830094 L4,4 Z" fill="#000000" opacity="0.3" />
                                    <path d="M11.1750002,14.75 C10.9354169,14.75 10.6958335,14.6541667 10.5041669,14.4625 L8.58750019,12.5458333 C8.20416686,12.1625 8.20416686,11.5875 8.58750019,11.2041667 C8.97083352,10.8208333 9.59375019,10.8208333 9.92916686,11.2041667 L11.1750002,12.45 L14.3375002,9.2875 C14.7208335,8.90416667 15.2958335,8.90416667 15.6791669,9.2875 C16.0625002,9.67083333 16.0625002,10.2458333 15.6791669,10.6291667 L11.8458335,14.4625 C11.6541669,14.6541667 11.4145835,14.75 11.1750002,14.75 Z" fill="#000000" />
                                </g>
                            </svg>
                        </span>
                        <div class="d-flex flex-stack flex-grow-1 flex-wrap flex-md-nowrap">
                            <div class="mb-3 mb-md-0 fw-bold">
                                <h4 class="text-gray-800 fw-bolder">{{$message}}</h4>
                            </div>

                        </div>
                    </div>
                @endif


                <div class="card mb-5 mb-xl-8">
                    <!--begin::Header-->
                    <div class="card-header border-0 pt-5">
                        <h3 class="card-title align-items-start flex-column">
                            <span class="card-label fw-bolder fs-3 mb-1">طلبات سحب الرصيد</span>
                        </h3>

                    </div>
                    <!--end::Header-->
                    <!--begin::Body-->
                    <div class="card-body py-3">
                        <!--begin::Table container-->
                        <div class="table-responsive">
                            <!--begin::Table-->
                            <table class="table table-row-bordered table-row-gray-100 align-middle gs-0 gy-3">
                                <!--begin::Table head-->
                                <thead>
                                <tr class="fw-bolder text-muted">
                                    {{-- <th class="min-w-120px">#</th> --}}
                                    <th class="min-w-140px">اسم العميل</th>
                                    <th class="min-w-140px">موبايل العميل</th>
                                    <th class="min-w-140px">رقم الأيبان</th>
                                    <th class="min-w-120px">الرصيد المتاح</th>
                                    <th class="min-w-120px">المبلغ المطلوب سحبه</th>
                                    <th class="min-w-120px">تاريخ الطلب</th>
                                    <th class="min-w-120px">الحالة</th>
                                    <th class="min-w-120px">رقم الحوالة</th>
                                    <th class="min-w-100px text-center">تحويل</th>
                                </tr>
                                </thead>
                                <!--end::Table head-->
                                <!--begin::Table body-->
                                <tbody>
                               @foreach($data as $one)
                                <tr>
                                    {{-- <td>
                                        <a href="#" class="text-dark fw-bolder text-hover-primary d-block mb-1 fs-6">{{@$one->id}}</a>
                                    </td> --}}
                                    <td>
                                        <a href="#" class="text-dark fw-bolder text-hover-primary d-block mb-1 fs-6">{{@$one->user->name}}</a>
                                    </td>
                                    <td>
                                        <a target="_blank" href="{{route('admin.user_balance_requests',['user_id'=>$one->user->id])}}" class="text-dark fw-bolder text-hover-primary d-block mb-1 fs-6">{{@$one->user->phone}}</a>
                                    </td>
                                    <td>
                                        <a href="#" class="text-dark fw-bolder text-hover-primary d-block mb-1 fs-6">{{@$one->credit->account_number}}</a>
                                    </td>

                                    <td>
                                        <a href="#" class="text-dark fw-bolder text-hover-primary d-block mb-1 fs-6">{{@$one->user->available_balance}} ريال</a>
                                    </td>
                                    <td>
                                        <a href="#" class="text-dark fw-bolder text-hover-primary d-block mb-1 fs-6"> {{@$one->amount}} ريال </a>
                                    </td>
                                    <td>
                                        <a href="#" class="text-dark fw-bolder text-hover-primary d-block mb-1 fs-6">{{@$one->created_at->format('Y-m-d')}}</a>
                                    </td>
                                   @if(@$one->payment_status == "waiting" || @$one->payment_status == '')
                                    <td>
                                        <span class="badge badge-danger">قيد الانتظار</span>
                                    </td>
                                    @else
                                        <td>
                                            <span class="badge badge-success">تم التحويل</span>
                                        </td>
                                    @endif
                                    <td>
                                        <a href="#" class="text-dark fw-bolder text-hover-primary d-block mb-1 fs-6">{{@$one->ref}}</a>
                                    </td>
                                    <td class="text-center">
                                        @if(@$one->status == "waiting")
                                            {{-- <form  action="{{route('admin.updateBalanceRequests',@$one->id)}}" method="POST" style="display: contents;">
                                                {{ csrf_field() }}
                                                <button type="submit" class="btn btn-icon btn-bg-light btn-active-color-primary btn-sm me-1">
                                                    <i class="far fa-credit-card text-success"></i>
                                                </button>
                                            </form> --}}
                                        @else
                                            {{-- <button  class="btn btn-icon btn-bg-light btn-active-color-primary btn-sm me-1" disabled>
                                                <i class="far fa-credit-card "></i>
                                            </button> --}}
                                        @endif
                                        <a href="{{route('admin.balance_request', ['id' => $one->id])}}" class="btn btn-sm btn-clean btn-icon btn-icon-md" title="Edit details">
                                            <i class="flaticon-edit-1  text-primary"></i>
                                        </a>
                                    </td>
                                </tr>
                               @endforeach
                                </tbody>
                                <!--end::Table body-->
                            </table>
                            <!--end::Table-->
                        </div>
                        <!--end::Table container-->
                    </div>
                    <!--begin::Body-->
                </div>
                {!!$data->links()!!}
            </div>
        </div>
    </div>
@endsection
