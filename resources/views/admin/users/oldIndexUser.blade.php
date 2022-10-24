@extends('admin.layouts.adminLayout')

@section('title')العملاء
@endsection
@section('filter')
    <div class="d-flex align-items-center py-1">
        <!--begin::Wrapper-->
        <div class="me-4">
            <!--begin::Menu-->
            <a href="#" class="btn btn-sm btn-flex btn-light btn-active-primary fw-bolder" data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end" data-kt-menu-flip="top-end">
                <!--begin::Svg Icon | path: icons/stockholm/Text/Filter.svg-->
                <span class="svg-icon svg-icon-5 svg-icon-gray-500 me-1">
											<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
												<g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
													<rect x="0" y="0" width="24" height="24" />
													<path d="M5,4 L19,4 C19.2761424,4 19.5,4.22385763 19.5,4.5 C19.5,4.60818511 19.4649111,4.71345191 19.4,4.8 L14,12 L14,20.190983 C14,20.4671254 13.7761424,20.690983 13.5,20.690983 C13.4223775,20.690983 13.3458209,20.6729105 13.2763932,20.6381966 L10,19 L10,12 L4.6,4.8 C4.43431458,4.5790861 4.4790861,4.26568542 4.7,4.1 C4.78654809,4.03508894 4.89181489,4 5,4 Z" fill="#000000" />
												</g>
											</svg>
										</span>
                <!--end::Svg Icon-->Filter</a>
            <!--begin::Menu 1-->
            <div class="menu menu-sub menu-sub-dropdown w-250px w-md-300px" data-kt-menu="true">
                <!--begin::Header-->
                <div class="px-7 py-5">
                    <div class="fs-5 text-dark fw-bolder">Filter Options</div>
                </div>
                <!--end::Header-->
                <!--begin::Menu separator-->
                <div class="separator border-gray-200"></div>
                <!--end::Menu separator-->
                <!--begin::Form-->
                <div class="px-7 py-5">
                    <!--begin::Input group-->
                    <div class="mb-10">
                        <!--begin::Label-->
                        <label class="form-label fw-bold">Status:</label>
                        <!--end::Label-->
                        <!--begin::Input-->
                        <div>
                            <select class="form-select form-select-solid" data-kt-select2="true" data-placeholder="Select option" data-allow-clear="true">
                                <option></option>
                                <option value="1">Approved</option>
                                <option value="2">Pending</option>
                                <option value="2">In Process</option>
                                <option value="2">Rejected</option>
                            </select>
                        </div>
                        <!--end::Input-->
                    </div>
                    <!--end::Input group-->
                    <!--begin::Input group-->
                    <div class="mb-10">
                        <!--begin::Label-->
                        <label class="form-label fw-bold">Member Type:</label>
                        <!--end::Label-->
                        <!--begin::Options-->
                        <div class="d-flex">
                            <!--begin::Options-->
                            <label class="form-check form-check-sm form-check-custom form-check-solid me-5">
                                <input class="form-check-input" type="checkbox" value="1" />
                                <span class="form-check-label">Author</span>
                            </label>
                            <!--end::Options-->
                            <!--begin::Options-->
                            <label class="form-check form-check-sm form-check-custom form-check-solid">
                                <input class="form-check-input" type="checkbox" value="2" checked="checked" />
                                <span class="form-check-label">Customer</span>
                            </label>
                            <!--end::Options-->
                        </div>
                        <!--end::Options-->
                    </div>
                    <!--end::Input group-->
                    <!--begin::Input group-->
                    <div class="mb-10">
                        <!--begin::Label-->
                        <label class="form-label fw-bold">Notifications:</label>
                        <!--end::Label-->
                        <!--begin::Switch-->
                        <div class="form-check form-switch form-switch-sm form-check-custom form-check-solid">
                            <input class="form-check-input" type="checkbox" value="" name="notifications" checked="checked" />
                            <label class="form-check-label">Enabled</label>
                        </div>
                        <!--end::Switch-->
                    </div>
                    <!--end::Input group-->
                    <!--begin::Actions-->
                    <div class="d-flex justify-content-end">
                        <button type="reset" class="btn btn-sm btn-white btn-active-light-primary me-2" data-kt-menu-dismiss="true">Reset</button>
                        <button type="submit" class="btn btn-sm btn-primary" data-kt-menu-dismiss="true">Apply</button>
                    </div>
                    <!--end::Actions-->
                </div>
                <!--end::Form-->
            </div>
            <!--end::Menu 1-->
            <!--end::Menu-->
        </div>
        <!--end::Wrapper-->
        <!--begin::Wrapper-->
        <div data-bs-toggle="tooltip" data-bs-placement="left" data-bs-trigger="hover" title="Create a new account">
            <a href="{{route('admin.users.create')}}" class="btn btn-sm btn-primary fw-bolder"  id="kt_toolbar_create_button">اضافة عضو</a>
        </div>
        <!--end::Wrapper-->
    </div>

@endsection


@section('content')
    <div class="post fs-base d-flex flex-column-fluid" id="kt_post">
        <!--begin::Container-->
        <div id="kt_content_container" class="container">
            <!--begin::Row-->
            <div class="row g-5 g-xl-8">
                <!--begin::Col-->


                <div class="card mb-5 mb-xl-8">
                    <!--begin::Header-->
                    <div class="card-header border-0 pt-5">
                        <h3 class="card-title align-items-start flex-column">
                            <span class="card-label fw-bolder fs-3 mb-1">العملاء</span>
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
                                    <th class="w-25px">
                                        <div class="form-check form-check-sm form-check-custom form-check-solid">
                                            <input class="form-check-input" type="checkbox" value="1" data-kt-check="true" data-kt-check-target=".widget-13-check" />
                                        </div>
                                    </th>
                                    <th class="min-w-140px">#</th>
                                    <th class="min-w-140px">الاسم</th>
                                    <th class="min-w-130px">الموبايل</th>
                                    <th class="min-w-130px">البريد الالكتروني</th>
                                    <th class="min-w-130px">الرصيد الكلي</th>
                                    <th class="min-w-130px">الرصيد المتاح</th>
                                    <th class="min-w-130px">الرصيد المعلق</th>
                                    <th class="min-w-130px">تاريخ التسجيل</th>
                                    <th class="min-w-130px">الحالة</th>

                                    <th class="min-w-150px text-center">العمليات</th>
                                </tr>
                                </thead>
                                <!--end::Table head-->
                                <!--begin::Table body-->
                                <tbody>
                                @foreach($users as $user)
                                    <tr>
                                        <td>
                                            <div class="form-check form-check-sm form-check-custom form-check-solid">
                                                <input class="form-check-input widget-13-check" type="checkbox" value="{{@$user->id}}" />
                                            </div>
                                        </td>
                                        <td>
                                            <a href="#" class="text-dark fw-bolder text-hover-primary d-block mb-1 fs-6">{{@$user->id}}</a>
                                        </td>
                                        <td>
                                            <a href="#" class="text-dark fw-bolder text-hover-primary d-block mb-1 fs-6">{{@$user->name}}</a>
                                        </td>
                                        <td>
                                            <a href="#" class="text-dark fw-bolder text-hover-primary d-block mb-1 fs-6">{{@$user->phone}}</a>
                                        </td>
                                        <td>
                                            <a href="#" class="text-dark fw-bolder text-hover-primary d-block mb-1 fs-6">{{@$user->email}}</a>
                                        </td>
                                        <td class="text-dark fw-bolder text-hover-primary fs-6">{{@$user->total_balance ? @$user->total_balance : 0.00}} </td>
                                        <td class="text-dark fw-bolder text-hover-primary fs-6">{{@$user->available_balance ? @$user->available_balance : 0.00}} </td>
                                        <td class="text-dark fw-bolder text-hover-primary fs-6">{{@$user->pinding_balance	 ? @$user->pinding_balance	 : 0.00}} </td>

                                        <td>
                                            <a href="#" class="text-dark fw-bolder text-hover-primary d-block mb-1 fs-6">{{@$user->created_at->format('Y-m-d')}}</a>
                                        </td>

                                        <td>
                                            @if($user->status == 'active')
                                                <span class="badge badge-success">فعال</span>
                                            @else
                                                <span class="badge badge-danger">غير فعال</span>
                                            @endif
                                        </td>
                                        <td class="text-center">
                                            {{--                            <a href="#" class="btn btn-icon btn-bg-light btn-active-color-primary btn-sm me-1">--}}
                                            {{--                                <!--begin::Svg Icon | path: icons/stockholm/General/Settings-1.svg-->--}}
                                            {{--                                <span class="svg-icon svg-icon-3">--}}
                                            {{--																	<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">--}}
                                            {{--																		<g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">--}}
                                            {{--																			<rect x="0" y="0" width="24" height="24" />--}}
                                            {{--																			<path d="M7,3 L17,3 C19.209139,3 21,4.790861 21,7 C21,9.209139 19.209139,11 17,11 L7,11 C4.790861,11 3,9.209139 3,7 C3,4.790861 4.790861,3 7,3 Z M7,9 C8.1045695,9 9,8.1045695 9,7 C9,5.8954305 8.1045695,5 7,5 C5.8954305,5 5,5.8954305 5,7 C5,8.1045695 5.8954305,9 7,9 Z" fill="#000000" />--}}
                                            {{--																			<path d="M7,13 L17,13 C19.209139,13 21,14.790861 21,17 C21,19.209139 19.209139,21 17,21 L7,21 C4.790861,21 3,19.209139 3,17 C3,14.790861 4.790861,13 7,13 Z M17,19 C18.1045695,19 19,18.1045695 19,17 C19,15.8954305 18.1045695,15 17,15 C15.8954305,15 15,15.8954305 15,17 C15,18.1045695 15.8954305,19 17,19 Z" fill="#000000" opacity="0.3" />--}}
                                            {{--																		</g>--}}
                                            {{--																	</svg>--}}
                                            {{--																</span>--}}
                                            {{--                                <!--end::Svg Icon-->--}}
                                            {{--                            </a>--}}
                                            <a href="{{route('admin.users.edit',$user->id)}}" class="btn btn-icon btn-bg-light btn-active-color-primary btn-sm me-1">
                                                <!--begin::Svg Icon | path: icons/stockholm/Communication/Write.svg-->
                                                <i class="far fa-edit text-warning"></i>

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

            </div>
        </div>
    </div>
@endsection
