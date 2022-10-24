@extends('admin.layouts.adminLayout') @section('title') الرسائل
@endsection
<style>
    .speech-bubble {
        position: relative;
        border-radius: 17px;
        padding: 10px 15px;
        margin-bottom: 15px;
        line-height: 22px;
        font-size: 13px;
        background-color: #dee2e6;
        overflow: hidden;
    }
    .speech-left {
        max-width: 240px;
        float: right;
        border-bottom-right-radius: 0px !important;
        color: #fff;
    }
    .bg-highlight, .page-item.active a {
        background-color: #2d7335!important;
    }
    .speech-right {
        max-width: 240px;
        float: left;
        border-bottom-left-radius: 0px !important;
    }
    .color-black {
        color: #000 !important;
    }
    .speach-icon {
        padding: 8px 0px;
        background: #3f4254;
        width: 35px;
        height: 35px;
        text-align: center;
        margin: 10px 0 0 10px;
        border-radius: 5px;
    }
    .speach-icon2{
        margin-right: 10px;
        background: #3699ff;
    }
    .speach-icon i{
        color: #fff;
    }
    #kt_chat_content .card.card-custom
    {
        background: #21252a
    }
    #kt_chat_content .card-body
    {
        background: #ECE5DD;
    }
    .header-fixed.subheader-fixed.subheader-enabled .wrapper{
        padding-top: 60px;
    }
    .mt-2.rounded.p-5.bg-light-primary.text-dark-50.font-weight-bold.font-size-lg.text-right.max-w-400px{
        background-color: #fff !important;
        font-weight: bold !important
    }
    #send_message{
        background: #128c7e!important;
        margin: 0 5px;
        border-radius: 113px;
        height: 40px;
        width: 40px;
        padding: 11px !important;
    }
    #message_text{
        background: transparent!important;
        border-radius: 104px;
        border-color: #747474;
        color: white;
    }
</style>
@section('content')
<link rel="stylesheet" type="text/css" href="{{asset("/template-muamlah/fonts/css/fontawesome-all.min.css")}}">
    <div class="d-flex flex-row">
        <!--begin::Aside-->
        <div class="flex-row-auto offcanvas-mobile w-350px w-xl-400px" id="kt_chat_aside">
            <!--begin::Card-->
            <div class="card card-custom">
                <!--begin::Body-->
                <div class="card-body">
                    <div class="post fs-base d-flex flex-column-fluid" id="kt_post">
                        <div class="card mb-5 mb-xl-10">
                            <!--begin::Card header-->
                            <div class="card-header border-0 cursor-pointer" role="button" data-bs-toggle="collapse"
                                 data-bs-target="#kt_account_profile_details" aria-expanded="true"
                                 aria-controls="kt_account_profile_details">
                                <!--begin::Card title-->
                                <div class="card-title m-0">
                                    <h3 class="fw-bolder m-0">الرسائل - عرض وإضافة رد</h3>
                                </div>
                                <!--end::Card title-->
                            </div>
                            <!--begin::Card header-->
                            <!--begin::Content-->
                            <div id="kt_account_profile_details" class="collapse show">
                                <!--begin::Form-->
                                <form method="post" action="{{route('admin.messages.reply')}}"
                                      class="form" role="form" id="kt_account_profile_details_form">
                                    {{ csrf_field() }}
                                    <input type="hidden" name="message_id" value="{{$message->id}}">
                                    <!--begin::Card body-->
                                    <div class="card-body border-top p-9">
                                        <!--begin::Input group-->
                                        @if(session()->has('success'))
                                            <h3 style="color:green; text-align:center;"> تم إضافة رد بنجاح </h3>
                                            <br>
                                        @endif
                                        @if($errors->any())
                                            {!! implode('', $errors->all('<div style="color: red; font-weight: bolder; font-size: 18px; text-align: center;">:message</div>')) !!}
                                        @endif
                                        <table class="table table-striped">
                                            <tr>
                                                <td><b>الاسم</b></td>
                                                <td>{{$message->name}}</td>
                                            </tr>
                                            <tr>
                                                <td><b>البريد الإلكتروني</b></td>
                                                <td>{{$message->email}}</td>
                                            </tr>
                                            <tr>
                                                <td><b>التاريخ</b></td>
                                                <td>{{$message->created_at}}</td>
                                            </tr>
                                            <tr>
                                                <td><b>الموضوع</b></td>
                                                <td>{{$message->subject}}</td>
                                            </tr>
                                            <tr>
                                                <td><b>الرسالة</b></td>
                                                <td>{{$message->message}}</td>
                                            </tr>
                                        </table>
                                        <br/>
{{--                                        @foreach($message->children as $child)--}}
{{--                                            @if(!is_null($child->file))--}}
{{--                                                <div class="clearfix"></div>--}}
{{--                                                <div class="speech-bubble speech-{{auth()->user()->id == $child->user_id ? 'left bg-highlight' : 'right color-black'}}">--}}
{{--                                                    @if($child->getFile('ext') == 'image')--}}
{{--                                                        <a href="{{$child->getFile()}}" download >--}}
{{--                                                            <img class="img-fluid preload-img" src="{{$child->getFile()}}" data-src="{{$child->getFile()}}">--}}
{{--                                                        </a>--}}
{{--                                                    @else--}}
{{--                                                        <a href="{{$child->getFile()}}" download class="color-white mr-2 button-message m-3">--}}
{{--                                                            <i class="fa fa-arrow-down"></i> تحميل الملف المرفق--}}
{{--                                                        </a>--}}
{{--                                                        @endif--}}
{{--                                                        </a>--}}
{{--                                                </div>--}}
{{--                                            @else--}}
{{--                                                <div class="clearfix"></div>--}}
{{--                                                <div class="speech-bubble speech-{{auth()->user()->id == $child->user_id ? 'left bg-highlight' : 'right color-black'}}">--}}
{{--                                                    {!!$child->message!!}--}}
{{--                                                </div>--}}
{{--                                            @endif--}}
{{--                                        @endforeach--}}


                                        <div class="clearfix"></div>

{{--                                        <form action="">--}}
{{--                                            <div class="d-flex">--}}
{{--                                                --}}{{-- <div class="speach-icon">--}}
{{--                                                    <a href="#" data-menu="menu-upload" class="bg-gray2-dark text-center"><i--}}
{{--                                                            class="fa fa-plus"></i></a>--}}
{{--                                                </div> --}}
{{--                                                <div class="flex-fill speach-input">--}}
{{--                                                    <textarea class="form-control" placeholder="أدخل رسالتك هنا" id="message_text"></textarea>--}}
{{--                                                </div>--}}
{{--                                                <div class="speach-icon speach-icon2">--}}
{{--                                                    <a href="javascript:;" id="send_message" class=" color-white  button-message"><i--}}
{{--                                                            class="fa fa-arrow-up"></i></a>--}}
{{--                                                </div>--}}
{{--                                            </div>--}}
{{--                                        </form>--}}

                                        {{-- <div class="row mb-6">
                                            <label class="col-lg-2 col-form-label required fw-bold fs-6"><b>الرد</b> </label>
                                            <div class="col-lg-10 fv-row">
                                                <textarea name="reply" id="kt-tinymce-4" class="form-control form-control-lg form-control-solid" >{!!$message->reply!!}</textarea>
                                            </div>
                                            <!--end::Col-->
                                        </div> --}}
                                    </div>
                                    <!--end::Card body-->
                                    <!--begin::Actions-->
                                {{-- <div class="card-footer d-flex justify-content-end py-6 px-9">
                                    <!-- <button type="reset" class="btn btn-white btn-active-light-primary me-2">Discard</button> -->
                                    <button type="submit" class="btn btn-primary" id="kt_account_profile_details_submit">إرسال</button>
                                </div> --}}
                                <!--end::Actions-->
                                </form>

                            </div>
                            <!--end::Content-->



                        </div>
                    </div>

                </div>
                <!--end::Body-->
            </div>
            <!--end::Card-->
        </div>
        <!--end::Aside-->
        <!--begin::Content-->
        <div class="flex-row-fluid ml-lg-8" id="kt_chat_content">
            <!--begin::Card-->
            <div class="card card-custom">
                <!--begin::Header-->
                <div class="card-header align-items-center px-4 py-3">
                    <div class="text-left flex-grow-1">
                        <!--begin::Aside Mobile Toggle-->
                        <button type="button" class="btn btn-clean btn-sm btn-icon btn-icon-md d-lg-none" id="kt_app_chat_toggle">
														<span class="svg-icon svg-icon-lg">
															<!--begin::Svg Icon | path:assets/media/svg/icons/Communication/Adress-book2.svg-->
															<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
																<g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
																	<rect x="0" y="0" width="24" height="24" />
																	<path d="M18,2 L20,2 C21.6568542,2 23,3.34314575 23,5 L23,19 C23,20.6568542 21.6568542,22 20,22 L18,22 L18,2 Z" fill="#000000" opacity="0.3" />
																	<path d="M5,2 L17,2 C18.6568542,2 20,3.34314575 20,5 L20,19 C20,20.6568542 18.6568542,22 17,22 L5,22 C4.44771525,22 4,21.5522847 4,21 L4,3 C4,2.44771525 4.44771525,2 5,2 Z M12,11 C13.1045695,11 14,10.1045695 14,9 C14,7.8954305 13.1045695,7 12,7 C10.8954305,7 10,7.8954305 10,9 C10,10.1045695 10.8954305,11 12,11 Z M7.00036205,16.4995035 C6.98863236,16.6619875 7.26484009,17 7.4041679,17 C11.463736,17 14.5228466,17 16.5815,17 C16.9988413,17 17.0053266,16.6221713 16.9988413,16.5 C16.8360465,13.4332455 14.6506758,12 11.9907452,12 C9.36772908,12 7.21569918,13.5165724 7.00036205,16.4995035 Z" fill="#000000" />
																</g>
															</svg>
                                                            <!--end::Svg Icon-->
														</span>
                        </button>
                        <!--end::Aside Mobile Toggle-->
                        <!--begin::Dropdown Menu-->
                        <div class="dropdown dropdown-inline">
{{--                            <button type="button" class="btn btn-clean btn-sm btn-icon btn-icon-md" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">--}}
{{--                                <i class="ki ki-bold-more-hor icon-md"></i>--}}
{{--                            </button>--}}
{{--                            <div class="dropdown-menu p-0 m-0 dropdown-menu-left dropdown-menu-md">--}}
{{--                                <!--begin::Navigation-->--}}
{{--                                <ul class="navi navi-hover py-5">--}}
{{--                                    <li class="navi-item">--}}
{{--                                        <a href="#" class="navi-link">--}}
{{--																		<span class="navi-icon">--}}
{{--																			<i class="flaticon2-drop"></i>--}}
{{--																		</span>--}}
{{--                                            <span class="navi-text">New Group</span>--}}
{{--                                        </a>--}}
{{--                                    </li>--}}
{{--                                    <li class="navi-item">--}}
{{--                                        <a href="#" class="navi-link">--}}
{{--																		<span class="navi-icon">--}}
{{--																			<i class="flaticon2-list-3"></i>--}}
{{--																		</span>--}}
{{--                                            <span class="navi-text">Contacts</span>--}}
{{--                                        </a>--}}
{{--                                    </li>--}}
{{--                                    <li class="navi-item">--}}
{{--                                        <a href="#" class="navi-link">--}}
{{--																		<span class="navi-icon">--}}
{{--																			<i class="flaticon2-rocket-1"></i>--}}
{{--																		</span>--}}
{{--                                            <span class="navi-text">Groups</span>--}}
{{--                                            <span class="navi-link-badge">--}}
{{--																			<span class="label label-light-primary label-inline font-weight-bold">new</span>--}}
{{--																		</span>--}}
{{--                                        </a>--}}
{{--                                    </li>--}}
{{--                                    <li class="navi-item">--}}
{{--                                        <a href="#" class="navi-link">--}}
{{--																		<span class="navi-icon">--}}
{{--																			<i class="flaticon2-bell-2"></i>--}}
{{--																		</span>--}}
{{--                                            <span class="navi-text">Calls</span>--}}
{{--                                        </a>--}}
{{--                                    </li>--}}
{{--                                    <li class="navi-item">--}}
{{--                                        <a href="#" class="navi-link">--}}
{{--																		<span class="navi-icon">--}}
{{--																			<i class="flaticon2-gear"></i>--}}
{{--																		</span>--}}
{{--                                            <span class="navi-text">Settings</span>--}}
{{--                                        </a>--}}
{{--                                    </li>--}}
{{--                                    <li class="navi-separator my-3"></li>--}}
{{--                                    <li class="navi-item">--}}
{{--                                        <a href="#" class="navi-link">--}}
{{--																		<span class="navi-icon">--}}
{{--																			<i class="flaticon2-magnifier-tool"></i>--}}
{{--																		</span>--}}
{{--                                            <span class="navi-text">Help</span>--}}
{{--                                        </a>--}}
{{--                                    </li>--}}
{{--                                    <li class="navi-item">--}}
{{--                                        <a href="#" class="navi-link">--}}
{{--																		<span class="navi-icon">--}}
{{--																			<i class="flaticon2-bell-2"></i>--}}
{{--																		</span>--}}
{{--                                            <span class="navi-text">Privacy</span>--}}
{{--                                            <span class="navi-link-badge">--}}
{{--																			<span class="label label-light-danger label-rounded font-weight-bold">5</span>--}}
{{--																		</span>--}}
{{--                                        </a>--}}
{{--                                    </li>--}}
{{--                                </ul>--}}
{{--                                <!--end::Navigation-->--}}
{{--                            </div>--}}
                        </div>
                        <!--end::Dropdown Menu-->
                    </div>
{{--                    <div class="text-center text-center">--}}
{{--                        <div class="symbol-group symbol-hover justify-content-center">--}}
{{--                            <div class="symbol symbol-35 symbol-circle" data-toggle="tooltip" title="Ana Fox">--}}
{{--                                <img alt="Pic" src="assets/media/users/300_16.jpg" />--}}
{{--                            </div>--}}
{{--                            <div class="symbol symbol-35 symbol-circle" data-toggle="tooltip" title="Nich Nilson">--}}
{{--                                <img alt="Pic" src="assets/media/users/300_21.jpg" />--}}
{{--                            </div>--}}
{{--                            <div class="symbol symbol-35 symbol-circle" data-toggle="tooltip" title="James Stone">--}}
{{--                                <img alt="Pic" src="assets/media/users/300_22.jpg" />--}}
{{--                            </div>--}}
{{--                            <div class="symbol symbol-35 symbol-circle" data-toggle="tooltip" title="Micheal Bold">--}}
{{--                                <img alt="Pic" src="assets/media/users/300_23.jpg" />--}}
{{--                            </div>--}}
{{--                            <div class="symbol symbol-35 symbol-circle" data-toggle="tooltip" title="Sean Cooper">--}}
{{--                                <img alt="Pic" src="assets/media/users/300_15.jpg" />--}}
{{--                            </div>--}}
{{--                            <div class="symbol symbol-35 symbol-circle symbol-light-success" data-toggle="tooltip" title="Invite someone">--}}
{{--                                <span class="symbol-label font-weight-bold">5+</span>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                    </div>--}}
                    <div class="text-right flex-grow-1">
                        <!--begin::Dropdown Menu-->
{{--                        <div class="dropdown dropdown-inline">--}}
{{--                            <button type="button" class="btn btn-clean btn-sm btn-icon btn-icon-md" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">--}}
{{--															<span class="svg-icon svg-icon-lg">--}}
{{--																<!--begin::Svg Icon | path:assets/media/svg/icons/Communication/Add-user.svg-->--}}
{{--																<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">--}}
{{--																	<g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">--}}
{{--																		<polygon points="0 0 24 0 24 24 0 24" />--}}
{{--																		<path d="M18,8 L16,8 C15.4477153,8 15,7.55228475 15,7 C15,6.44771525 15.4477153,6 16,6 L18,6 L18,4 C18,3.44771525 18.4477153,3 19,3 C19.5522847,3 20,3.44771525 20,4 L20,6 L22,6 C22.5522847,6 23,6.44771525 23,7 C23,7.55228475 22.5522847,8 22,8 L20,8 L20,10 C20,10.5522847 19.5522847,11 19,11 C18.4477153,11 18,10.5522847 18,10 L18,8 Z M9,11 C6.790861,11 5,9.209139 5,7 C5,4.790861 6.790861,3 9,3 C11.209139,3 13,4.790861 13,7 C13,9.209139 11.209139,11 9,11 Z" fill="#000000" fill-rule="nonzero" opacity="0.3" />--}}
{{--																		<path d="M0.00065168429,20.1992055 C0.388258525,15.4265159 4.26191235,13 8.98334134,13 C13.7712164,13 17.7048837,15.2931929 17.9979143,20.2 C18.0095879,20.3954741 17.9979143,21 17.2466999,21 C13.541124,21 8.03472472,21 0.727502227,21 C0.476712155,21 -0.0204617505,20.45918 0.00065168429,20.1992055 Z" fill="#000000" fill-rule="nonzero" />--}}
{{--																	</g>--}}
{{--																</svg>--}}
{{--                                                                <!--end::Svg Icon-->--}}
{{--															</span>--}}
{{--                            </button>--}}
{{--                            <div class="dropdown-menu p-0 m-0 dropdown-menu-right dropdown-menu-md">--}}
{{--                                <!--begin::Navigation-->--}}
{{--                                <ul class="navi navi-hover py-5">--}}
{{--                                    <li class="navi-item">--}}
{{--                                        <a href="#" class="navi-link">--}}
{{--																		<span class="navi-icon">--}}
{{--																			<i class="flaticon2-drop"></i>--}}
{{--																		</span>--}}
{{--                                            <span class="navi-text">New Group</span>--}}
{{--                                        </a>--}}
{{--                                    </li>--}}
{{--                                    <li class="navi-item">--}}
{{--                                        <a href="#" class="navi-link">--}}
{{--																		<span class="navi-icon">--}}
{{--																			<i class="flaticon2-list-3"></i>--}}
{{--																		</span>--}}
{{--                                            <span class="navi-text">Contacts</span>--}}
{{--                                        </a>--}}
{{--                                    </li>--}}
{{--                                    <li class="navi-item">--}}
{{--                                        <a href="#" class="navi-link">--}}
{{--																		<span class="navi-icon">--}}
{{--																			<i class="flaticon2-rocket-1"></i>--}}
{{--																		</span>--}}
{{--                                            <span class="navi-text">Groups</span>--}}
{{--                                            <span class="navi-link-badge">--}}
{{--																			<span class="label label-light-primary label-inline font-weight-bold">new</span>--}}
{{--																		</span>--}}
{{--                                        </a>--}}
{{--                                    </li>--}}
{{--                                    <li class="navi-item">--}}
{{--                                        <a href="#" class="navi-link">--}}
{{--																		<span class="navi-icon">--}}
{{--																			<i class="flaticon2-bell-2"></i>--}}
{{--																		</span>--}}
{{--                                            <span class="navi-text">Calls</span>--}}
{{--                                        </a>--}}
{{--                                    </li>--}}
{{--                                    <li class="navi-item">--}}
{{--                                        <a href="#" class="navi-link">--}}
{{--																		<span class="navi-icon">--}}
{{--																			<i class="flaticon2-gear"></i>--}}
{{--																		</span>--}}
{{--                                            <span class="navi-text">Settings</span>--}}
{{--                                        </a>--}}
{{--                                    </li>--}}
{{--                                    <li class="navi-separator my-3"></li>--}}
{{--                                    <li class="navi-item">--}}
{{--                                        <a href="#" class="navi-link">--}}
{{--																		<span class="navi-icon">--}}
{{--																			<i class="flaticon2-magnifier-tool"></i>--}}
{{--																		</span>--}}
{{--                                            <span class="navi-text">Help</span>--}}
{{--                                        </a>--}}
{{--                                    </li>--}}
{{--                                    <li class="navi-item">--}}
{{--                                        <a href="#" class="navi-link">--}}
{{--																		<span class="navi-icon">--}}
{{--																			<i class="flaticon2-bell-2"></i>--}}
{{--																		</span>--}}
{{--                                            <span class="navi-text">Privacy</span>--}}
{{--                                            <span class="navi-link-badge">--}}
{{--																			<span class="label label-light-danger label-rounded font-weight-bold">5</span>--}}
{{--																		</span>--}}
{{--                                        </a>--}}
{{--                                    </li>--}}
{{--                                </ul>--}}
{{--                                <!--end::Navigation-->--}}
{{--                            </div>--}}
{{--                        </div>--}}
                        <!--end::Dropdown Menu-->
                    </div>
                </div>
                <!--end::Header-->
                <!--begin::Body-->
                <div class="card-body">
                    <!--begin::Scroll-->
                    <div id="scroll" class="scroll scroll-pull" data-mobile-height="350">
                        <!--begin::Messages-->
                        <div class="messages" id="children">
                        @foreach($message->children as $child)
                            @if (auth()->user()->id != $child->user_id)
                                <!--begin::Message In-->
                                    <div class="d-flex flex-column mb-5 align-items-start message-item"  data-id="{{ $child->id }}">
                                        <div class="d-flex align-items-center">
{{--                                            <div class="symbol symbol-circle symbol-35 mr-3">--}}
{{--                                                <img alt="Pic" src="assets/media/users/300_12.jpg" />--}}
{{--                                            </div>--}}
                                            <div>
                                                <a style="font-weight:bold" class="text-dark-75 text-hover-primary font-size-12"> {{$child->name}}</a>
                                                <span class="text-muted font-size-sm">{{$child->created_at->diffForHumans()}}</span>
                                            </div>
                                        </div>
                                        <div style="background: #DCF8C6;font-weight:bold !important" class="mt-2 rounded p-5 text-dark-50 font-weight-bold font-size-lg text-left max-w-400px">{!!$child->message!!}</div>
                                    </div>
                                    <!--end::Message In-->
                                @else
                                <!--begin::Message Out-->
                                    <div class="d-flex flex-column mb-5 align-items-end message-item"  data-id="{{ $child->id }}">
                                        <div class="d-flex align-items-center">
                                            <div>
                                                <span class="text-muted font-size-sm">{{ $child->created_at->diffForHumans()}}</span>
                                                <a style="font-weight:bold" class="text-dark-75 text-hover-primary font-size-12">{{$child->name}}</a>
                                            </div>
{{--                                            <div class="symbol symbol-circle symbol-35 ml-3">--}}
{{--                                                <img alt="Pic" src="assets/media/users/300_21.jpg" />--}}
{{--                                            </div>--}}
                                        </div>
                                        <div style="background: #fff;font-weight:bold !important" class="mt-2 rounded p-5 text-dark-50 font-weight-bold font-size-lg text-right max-w-400px">{!!$child->message!!}</div>
                                    </div>
                                    <!--end::Message Out-->
                            @endif
                            @endforeach
                        </div>
                        <!--end::Messages-->
                    </div>
                    <!--end::Scroll-->
                </div>
                <!--end::Body-->
                <!--begin::Footer-->
                <div class="card-footer align-items-center d-flex">
                    <!--begin::Compose-->
                    <input class="form-control " id="message_text" placeholder="أدخل رسالتك هنا">
                    <div class="">
{{--                        <div class="mr-3">--}}
{{--                            <a href="#" class="btn btn-clean btn-icon btn-md mr-1">--}}
{{--                                <i class="flaticon2-photograph icon-lg"></i>--}}
{{--                            </a>--}}
{{--                            <a href="#" class="btn btn-clean btn-icon btn-md">--}}
{{--                                <i class="flaticon2-photo-camera icon-lg"></i>--}}
{{--                            </a>--}}
{{--                        </div>--}}
                        <div>
                            <button type="button" id="send_message"  class="btn btn-primary btn-md text-uppercase font-weight-bold chat-send py-2 px-6">
                                <i class="fa fa-arrow-up"></i>
                            </button>
                        </div>
                    </div>
                    <!--begin::Compose-->
                </div>
                <!--end::Footer-->
            </div>
            <!--end::Card-->
        </div>
        <!--end::Content-->
    </div>

@endsection
@section('script')
{{--@include('admin.include.script.script_form')--}}
<script>
    function sendMessage(){
        let message = $('#message_text').val();
        if(message == ""){
            return ;
        }
        $.ajax(
            {
                url:   "{{route('admin.messages.new_message')}}",
                type: "POST",
                data : {
                    message : message,
                    _token : "{{csrf_token()}}",
                    parent_id : "{{$message->id}}"
                },
                beforeSend: function()
                {
                    $('#message_text').val("");
                }
            })
            .done(function(data)
            {
                if(data.html != ""){
                    $('#message_text').val("");
                    $('#children').append(data.html);
                    var div  = document.getElementById('scroll');
                    $('.scroll').animate({
                        scrollTop: div.scrollHeight + div.clientHeight
                    }, 1);
                }
            })
            .fail(function(jqXHR, ajaxOptions, thrownError)
            {
                alert('الرجاء المحاولة مرة اخرى');
            });
    }
    $('#send_message').on('click', sendMessage);


    $('#message_text').on('keypress',function(e) {
        if(e.which == 13) {
            e.preventDefault();
            sendMessage();
        }
    });

    function getLastId(){
        var last_item = $('#children').find('.message-item').last();
        var last_id = 0;
        if(last_item.length > 0){
            last_id = last_item.data('id');
        }
        return last_id
    }
    var last_id = '{{!empty($message->children->last()) ? $message->children->last()->id : 0}}';
    function seeNewMessages(){
        var parent_id = "{{$message->id}}";
        // console.log(last_id);
        $.ajax(
            {
                url:   "{{route('admin.messages.see_new_message')}}",
                type: "POST",
                data : {
                    _token : "{{csrf_token()}}",
                    parent_id : parent_id,
                    last_id : last_id
                }
            })
            .done(function(data)
            {
                if(data.html != ""){
                    $('#message_text').val("");
                    $('#children').append(data.html);
                    var div  = document.getElementById('scroll');
                    $('.scroll').animate({
                        scrollTop: div.scrollHeight + div.clientHeight
                    }, 1);
                    last_id = getLastId();

                }
            })
            .fail(function(jqXHR, ajaxOptions, thrownError)
            {
                console.log('الرجاء المحاولة مرة اخرى');
            });
    }
    setInterval(seeNewMessages, 3000);
</script>
<script src="{{ asset('admin-file/assets/js/pages/custom/chat/chat.js') }}"></script>

@endsection
