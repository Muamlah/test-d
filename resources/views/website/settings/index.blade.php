@extends('website.layout')


@section('style')
    <style>
        .update{
            font-size: 12px;
            color:#ddd;
            margin-left: 5px;

        }
        #profile-image:hover{
            border:2px solid #ddd;
            cursor: pointer;

        }
        .custom-input{
            background: transparent;
            border: 0;
            border-bottom: 1px solid #2f3135;
        }
        .parent-percentage{
            width: 200px;
            background: #898989;
            position: absolute;
            height: 15px;
            margin: 18px;
        }
        .child-percentage{
            background: green;
            position: absolute;
            height: 15px;
            margin: 18px;
        }
        .st-remove-label{
            display: inline-block !important;
        }
    </style>
@endsection
@php
 $user = auth()->user();
@endphp
@section('content')
    <div class="page-content header-clear-medium page-settings">
        @guest
            <div class="card card-style card-profile-qr mt-4">
                <div class="d-flex m-3">
                    <div>
                        <img data-src="{{asset("/template-muamlah/images/pictures/faces/1s.png")}}" src="{{asset("/template-muamlah/images/empty.png")}}"
                              class="ml-3 rounded-circle shadow-l preload-img" width="60" ></div>
                    <div>
                        <h3 class="mt-2 mb-1 font-700"></a> الاسم المستعار</h3>
                        <p class="font-12 mt-n1 mb-0 pb-0"></a> "الحمدللّه بلا سبب, و لا طلب, الحمدللّه حمدا كاملا, الحمدللّه
                            دائما و أبدا"</p>
                    </div>
                    <div class="mr-auto mt-3 pt-1">
                        <a href="#" data-menu="qrcode-show">
                            <i class="shadow-l fa qrcode-icon fa-qrcode"></i>
                        </a>
                    </div>
                </div>
            </div>
        @else
            <div class="alert alert-box mr-3 ml-3 rounded-s bg-red2-dark " role="alert" style="display: none;">
                <span class="alert-icon"><i class="fa fa-times-circle font-18"></i></span>
                <h4 class="text-uppercase color-white errors-text"></h4>
                <button type="button" class="close color-white opacity-60 font-16" data-dismiss="alert" aria-label="Close">&times;</button>
            </div>
            <div class="card card-style card-profile-qr mt-4">
                <div class="d-flex m-3 info-profile">
                    <div>
                        <img data-src="{{auth()->user()->getImage()}}" src="{{auth()->user()->getImage()}}"
                              class="ml-3 rounded-circle shadow-l preload-img" width="60" id="profile-image">
                        <input type="file" id="image" name="profile_image" style="display:none" accept="image/*">
                    </div>
                    <div>
                        <h3 class="mt-2 mb-0 font-700">
                            <span id="user-name">
                                {{ !empty(auth()->user()->name) ? auth()->user()->name : "الاسم المستعار" }}
                            </span>
                            <i id="name-edit" class="fas fa-pen font-12 mr-2 opacity-50"></i>
                        </h3>
                        <p class="font-12 mt-n1 mb-0 pb-0">
                            <span id="user-bio">
                                {{ !empty(auth()->user()->bio) ?  auth()->user()->bio : '--------'}}
                            </span>
                            <i id="excerpt-edit" class="fas fa-pen font-12 mr-2 opacity-50"></i>
                        </p>
                    </div>
                    <div class="mr-auto mt-3 pt-1">
                        <a href="#" data-menu="qrcode-show">
                            <i class="shadow-l fa qrcode-icon fa-qrcode"></i>
                        </a>
                    </div>
                </div>
                <div class="d-none edit-profile">
                    <div class="d-flex m-3">
                        <div
                            class="input-style edit-name d-none w-100 ml-2 mt-auto mb-auto input-style-2 has-icon input-required">
                            <i class="fa input-icon fa-user-alt"></i>
                            <span class="input-style-1-active font-900">الإسم المستعار</span>
                            <input class="form-control user-name" type="text" value="{{ !empty(auth()->user()->name) ? auth()->user()->name : "الاسم المستعار" }}">
                        </div>
                        <div
                            class="input-style edit-excerpt d-none w-100 ml-2 mt-auto mb-auto input-style-2 has-icon input-required">
                            <i class="fa input-icon fa-user-alt"></i>
                            <span class="input-style-1-active font-900">نبذة عنك</span>
                            <textarea class="requiredField user-bio" name="" id="" cols="30" rows="10">{{ !empty(auth()->user()->bio) ?  auth()->user()->bio : '--------'}}
                            </textarea>
                        </div>
                        <div class="m-auto">
                            <button class="btn btn-full w-100 bg-green-c btn-m text-uppercase rounded-sm shadow-l font-900 edit-profile-btn">حفظ</button>
                        </div>
                    </div>
                </div>
            </div>
        @endguest
        <div class="card card-style card-in">
            <div class="d-flex m-3 info-profile">
                <div class="list-group list-custom-small">
                    <a href="javascript:;" class="border-0">
                        <i class="fa font-13 fa-percent ml-1 rounded-s bg-red1-dark">
                            @php
                                $coupon = $user->coupon;
                            @endphp
                            {{!empty($coupon) ? round($coupon->owner_discount) : ''}}
                        </i>
                        <span class="font-12">
                            كود الخصم الخاص بك :
                            <p class="m-0 mr-1 d-inline">
                                <em id="paragraph-copy1">
                                    {{@$user->reference_code}}
                                </em>
                            </p>
                        </span>
                        <span class="toast-info">
                            <i class="fas fa-question-circle bubble"></i>
                            <span class="info-bubble">
                                <p class="font-11 m-0 color-white opacity-85">يمكنك ارسال هذا الكود لأي شخص
                                    عند الطلب يحصل على خصم {{!empty($coupon) ? round($coupon->discount) : ''}}٪؜
                                    و تحصل أنت على رصيد {{!empty($coupon) ? round($coupon->owner_discount) : ''}}٪؜ من رسوم الطلب.</p>
                            </span>
                        </span>
                    </a>
                </div>
                <div class="mr-auto mt-auto mb-auto">
                    <button class="p-1 btn d-inline bg-green2-dark" data-clipboard-action="copy" data-clipboard-target="#paragraph-copy1" onclick="Copy('{{@$user->reference_code}}');">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-copy">
                            <rect x="9" y="9" width="13" height="13" rx="2" ry="2"></rect>
                            <path d="M5 15H4a2 2 0 0 1-2-2V4a2 2 0 0 1 2-2h9a2 2 0 0 1 2 2v1"></path>
                        </svg> نسخ
                    </button>
                </div>
            </div>
        </div>
        <div class="card card-style card-in">
            <div class="d-flex m-3 info-profile">
                <div class="list-group list-custom-small">
                    <a href="javascript:;" class="border-0">
                        <i class="fas fa-id-card rounded-s bg-magenta2-dark font-14"></i>
                        <span class="font-15">شارك رابط ملفك الشخصي مع العملاء</span>
                    </a>
                </div>
                <div class="mr-auto mt-auto mb-auto">
                    <button class="p-1 btn d-inline bg-green2-dark" data-clipboard-action="copy" data-clipboard-target="#paragraph-copy1" onclick="Copy('{{$share_link}}');">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-copy">
                            <rect x="9" y="9" width="13" height="13" rx="2" ry="2"></rect>
                            <path d="M5 15H4a2 2 0 0 1-2-2V4a2 2 0 0 1 2-2h9a2 2 0 0 1 2 2v1"></path>
                        </svg> نسخ
                    </button>
                </div>
            </div>
        </div>
        <div class="card card-style mt-5">
            <div class="content mt-0 mb-0">
                <div class="list-group list-custom-small list-icon-0">
                    <a data-trigger-switch="switch-b" href="#">
                        <i class="fa font-14 fa-user-cog rounded-s bg-green1-dark"></i>
                        <span class="font-15" id="work-status-label">{{auth()->user()->work_status == 'online' ? 'متاح للعمل' : 'غير متاح للعمل'}}</span>
                        <div class="custom-control scale-switch ios-switch">
                            <input type="checkbox" class="ios-input work-status-input" id="switch-b"
                            {{auth()->user()->work_status == 'online' ? 'checked' : ''}}
                            data-checked="{{auth()->user()->work_status}}">
                            <label class="custom-control-label work-status-label" for="switch-1"></label>
                        </div>
                        <i class="fa fa-chevron-right opacity-30"></i>
                    </a>
                    <a href="{{route('website.settings.notifications')}}">
                        <i class="fa font-14 fa-bell rounded-s bg-red3-dark"></i>
                        <span class="font-15">الإشعارات</span>
                        <i class="fa fa-chevron-left opacity-30"></i>
                    </a>
                </div>
            </div>
        </div>
        <div class="card card-style">
            <div class="content my-0">
                <div class="list-group list-custom-small">
                    <a href="{{route('user.profile')}}">
                        <i class="fas fa-id-card rounded-s bg-magenta2-dark font-14"></i>
                        <span class="font-15">الملف الشخصي</span>
                        <i class="fa fa-chevron-left opacity-30"></i>
                    </a>
                    </a>
                    <a href="{{route('user.agents_list')}}">
                        <i class="fa font-14 fa-users rounded-s bg-yellow1-dark"></i>
                        <span class="font-15">
                           الوكلاء
                        </span>
                        <i class="fa fa-chevron-left opacity-30"></i>
                    </a>
                    <a href="{{route('privateOrder.index')}}">
                        <i class="fa font-14 fa-box-open rounded-s bg-plum-dark"></i>

                        <span class="font-15">طلباتي</span>
                        <i class="fa fa-chevron-left opacity-30"></i>
                    </a>
                    <a href="{{route('privateService.index')}}">
                        <i class="fa font-14 fa-briefcase rounded-s bg-violet-light"></i>
                        <span class="font-15">طلبات العملاء</span>
                        <i class="fa fa-chevron-left opacity-30"></i>
                    </a>
                    <a href="{{route('eserviceFavorite.index')}}">
                        <i class="fa font-14 fa-briefcase rounded-s bg-violet-light"></i>
                        <span class="font-15">خدماتي</span>
                        <i class="fa fa-chevron-left opacity-30"></i>
                    </a>
                    <a href="{{route('user.reviews')}}">
                        <i class="fa font-14 fa-star rounded-s bg-yellow1-dark"></i>
                        <span class="font-15">التقييمات</span>
                        <i class="fa fa-chevron-left opacity-30"></i>
                    </a>
                    <a href="{{route('tellFriend')}}">
                        <i class="fa font-14 fa-share-alt rounded-s bg-sky-dark"></i>
                        <span class="font-15">أخبر صديق</span>
                        <i class="fa fa-chevron-left opacity-30"></i>
                    </a>

                </div>
            </div>
        </div>
        <div class="card card-style">
            <div class="content my-0">
                <div class="list-group list-custom-small">
                    <a href="#" data-toggle-theme="" data-trigger-switch="switch-dark-mode">
                        <i class="fa font-12 fa-moon rounded-s bg-grey-c color-white ml-3"></i>
                        <span class="font-15">الوضع الليلي</span>
                        <div class="custom-control scale-switch ios-switch">
                            <input data-toggle-theme-switch="" type="checkbox" class="ios-input"
                                   id="switch-dark-mode">
                            <label class="custom-control-label" for="switch-dark-mode"></label>
                        </div>
                        <i class="fa fa-angle-left"></i>
                    </a>
                </div>
            </div>
        </div>
            <div class="card card-style">
                <div class="content my-0">
                    <div class="list-group list-custom-small">
                        <a href="{{route('user.balance')}}">
                            <i class="fa font-14 fa-wallet rounded-s color-white bg-highlight"></i>
                            <span class="font-15">المحفظة</span>
                            <i class="fa fa-chevron-left opacity-30"></i>
                        </a>
                    </div>
                </div>
            </div>
{{--        <div class="card card-style">--}}
{{--            <div class="content my-0">--}}
{{--                <div class="list-group list-custom-small">--}}

{{--                    <a href="{{route('user.invoices')}}">--}}
{{--                        <i class="fa fa-file-invoice font-14 rounded-s bg-aqua-dark"></i>--}}
{{--                        <span class="font-15">المحفظة</span>--}}
{{--                        <i class="fa fa-chevron-left opacity-30"></i>--}}
{{--                    </a>--}}
{{--                    <a href="{{route('user.balance')}}">--}}
{{--                        <i class="fa font-14 fa-brush rounded-s bg-phone"></i>--}}
{{--                        <span class="font-15">الرصيد</span>--}}
{{--                        <i class="fa fa-chevron-left opacity-30"></i>--}}
{{--                    </a>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}
        <div class="card card-style">
            <div class="content my-0">
                <div class="list-group list-custom-small">
                    <div class="list-group list-custom-small">
                        <a href="{{route('pages.index')}}">
                            <i class="fa font-14 fa-info-circle rounded-s bg-blue1-dark"></i>
                            <span class="font-15">المساعدة</span>
                            <i class="fa fa-chevron-left opacity-30"></i>
                        </a>
                    </div>
                    {{-- <div class="accordion" id="accordion-1">
                        <div class="mb-0">
                            <button class="accordion-btn border-0" data-toggle="collapse" data-target="#collapse1">
                                <i class="fa font-14 fa-info-circle rounded-s bg-blue1-dark"></i>
                                <span class="font-15">المساعدة</span>
                                <i class="fa fa-chevron-left opacity-30"></i>
                            </button>
                            <div id="collapse1" class="collapse border-top" data-parent="#accordion-1">
                                <div class="pt-1 pb-2 pr-3">
                                    <a href="{{route('faqs.index')}}">
                                        <i class="fa font-14 fa-question-circle rounded-s bg-orange-dark"></i>
                                        <span class="font-15">الأسئلة الشائعة</span>
                                        <i class="fa fa-chevron-left opacity-30"></i>
                                    </a>
                                    <a href="{{route('website.supervisorGuide')}}"> <i
                                            class="fa font-14 fa-book-open rounded-s bg-yellow1-dark"></i>
                                        <span class="font-15">دليل استخدام مقدم الخدمة</span> <i
                                            class="fa fa-chevron-left opacity-30"></i>
                                    </a>
                                    <a
                                        href="{{route('website.customerGuide')}}">
                                        <i class="fa font-14 fa-book-open rounded-s bg-green3-dark"></i>
                                        <span class="font-15">دليل استخدام العميل</span> <i
                                            class="fa fa-chevron-left opacity-30"></i> </a>
                                    <a href="{{route('messages.form')}}">
                                        <i class="fa font-14 fa-headset rounded-s bg-green2-dark"></i>
                                        <span class="font-15">خدمة العملاء</span>
                                        <i class="fa fa-chevron-left opacity-30"></i>
                                    </a>
                                    <a href="terms.html">
                                        <i class="fa font-14 fa-asterisk rounded-s bg-brown1-dark"></i>
                                        <span class="font-15">الشروط و الأحكام</span>
                                        <i class="fa fa-chevron-left opacity-30"></i>
                                    </a>
                                    <a href="privacy.html" class="border-0">
                                        <i class="fa font-14 fa-shield-alt rounded-s bg-gray2-dark"></i>
                                        <span class="font-15">سياسة الخصوصية</span>
                                        <i class="fa fa-chevron-left opacity-30"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div> --}}

                    <a href="{{route('pages.updates')}}">
                        <i class="fa font-14 fa-sync-alt rounded-s bg-blue2-dark"></i>
                        <span class="font-15">تحديثات</span>
                        <i class="fa fa-chevron-left opacity-30"></i>
                    </a>
                    <a href="#" onclick="event.preventDefault();
                                                             document.getElementById('logout-form').submit();">
                        <i class="fa font-14 fa-sign-out-alt rounded-s bg-red1-dark"></i>
                        <span class="font-15">تسجيل الخروج</span>
                        <i class="fa fa-chevron-left opacity-30"></i>
                    </a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST"
                          style="display: none;">
                        {{ csrf_field() }}
                    </form>




                </div>
            </div>
        </div>

    </div>
    <!-- End of Page Content-->
    <!--sidebar show QR CODE-->
    <div id="qrcode-show" class="menu menu-box-left" data-menu-width="100%" data-menu-effect="menu-parallax">
        <div class="d-flex text-center">
            <a href="#" onclick="share_facebook();" class="flex-fill icon icon-m text-center color-facebook border-bottom border-right">
                <i class="fab font-12 fa-facebook-f"></i>
            </a>
            <a href="#" onclick="share_twitter();" class="flex-fill icon icon-m text-center color-twitter border-bottom border-right">
                <i class="fab font-12 fa-twitter"></i>
            </a>
            <a href="#" class="flex-fill icon icon-m text-center color-instagram border-bottom border-right">
                <i class="fab font-12 fa-instagram"></i>
            </a>
            <a href="#" onclick="share_whatsapp();" class="flex-fill icon icon-m text-center color-whatsapp border-bottom border-right">
                <i class="fab font-12 fa-whatsapp"></i>
            </a>
            <a href="#" onclick="share_linkedin();" class="flex-fill icon icon-m text-center color-linkedin border-bottom border-right">
                <i class="fab font-12 fa-linkedin-in"></i>
            </a>
            <a href="#" class="close-menu flex-fill icon icon-m text-center color-red2-dark border-bottom">
                <i class="fa font-12 fa-times"></i>
            </a>

        </div>
        <div class="qrcode-show mt-5 mb-auto">
            <div class="qrcode-container rounded-sm pb-5">
                <div class="menu-title text-center">
                    <img data-src="{{asset("/template-muamlah/images/logo.png")}}" src="{{asset("/template-muamlah/images/empty.png")}}"
                        class="rounded-circle preload-img mt-n3" width="60">
                    <h3 class="pr-5 mb-2 pl-5">منصة معاملة</h3>
                </div>
                <div class="e-card-panel text-center">
                    <div class="d-flex e-card-user-social">
                        <a href="{{$user->facebook}}" class="flex-fill icon icon-m text-center color-gray3-dark">
                            <i class="fab font-12 fa-facebook-f"></i>
                        </a>
                        <a href="{{$user->twitter}}" class="flex-fill icon icon-m text-center color-gray3-dark">
                            <i class="fab font-12 fa-twitter"></i>
                        </a>
                        <a href="{{$user->instagram}}" class="flex-fill icon icon-m text-center color-gray3-dark">
                            <i class="fab font-12 fa-instagram"></i>
                        </a>
                        <a href="{{$user->whatsapp}}" class="flex-fill icon icon-m text-center color-gray3-dark">
                            <i class="fab font-12 fa-whatsapp"></i>
                        </a>
                    </div>
                    <div class="card-user-info">
                        <img data-src="{{auth()->user()->getImage()}}" src="{{auth()->user()->getImage()}}"
                            class="ml-3 rounded-circle shadow-l preload-img">
                        <p
                            class="opacity-60 font-700 text-uppercase text-shadow-large font-16 mr-n3 mt-1 mb-0 pb-0">
                            {{ !empty(auth()->user()->name) ? auth()->user()->name : "الاسم المستعار" }}
                        </p>
                    </div>
                    <img class="qrcode border mx-auto polaroid-effect" src="https://api.qrserver.com/v1/create-qr-code?data={{$share_link}}&size=200x200">
                    <div class="e-card-bottom">
                        <div class="positin-ab left text-center">
                            <p class="opacity-60 font-700 text-uppercase text-shadow-large font-16 mb-0 pb-0">
                                {{@$user->reference_code}}</p>
                        </div>
                    </div>
                    <img class="e-card-bg card-white" src="{{asset('website/images/card.png')}}" alt="">
                    <img class="e-card-bg card-dark" src="{{asset('website/images/card-dark.png')}}" alt="">

                </div>
            </div>
        </div>

        {{-- <div class="qrcode-show mt-5 mb-auto">
            <div class="qrcode-container rounded-sm pb-4">
                <div class="menu-title text-center">
                    <img data-src="{{asset("/template-muamlah/images/logo.png")}}" src="{{asset("/template-muamlah/images/empty.png")}}" class="rounded-circle preload-img mt-n3" width="60">
                    <h3 class="pr-5 mb-2 pl-5">QR CODE</h3>
                    <p class="mt-2">{{auth()->check() ? auth()->user()->full_name : 'حسابي'}}</p>
                </div>
                <img width="200" rel="{{$share_link}}" class="generate-qr-auto border mx-auto polaroid-effect shadow-l"
                src="https://api.qrserver.com/v1/create-qr-code?data={{$share_link}}&size=200x200">
            </div>
            <br>
        </div>

        <p class="text-center mt-3">يمكنك مشاركة QR CODE حسابك
            <br/>
            <a href="javascript:;" onclick="Copy('{{$share_link}}');"><i class="fas fa-copy"></i> <span id="copied">نسخ الرابط</span></a>
        </p>
        <div class="sharethis-inline-share-buttons" style="margin: 10px auto;" data-url="{{$share_link}}"></div> --}}

    </div>
    <!--end sidebar show QR CODE-->
@endsection
@section('script')
    <script>
        // change work status
        $(".work-status-label").on('click', function(e) {

            let input_value = $('.work-status-input').data('checked');

            if(input_value == 'online'){
                $('.work-status-input').data('checked','offline');
                $('#work-status-label').text('غير متاح للعمل');
                var work_status = 'offline';
            }else{
                $('.work-status-input').data('checked','online');
                $('#work-status-label').text('متاح للعمل');

                var work_status = 'online';
            }

            $.ajax({
                url:   "{{route('website.update-work-status')}}",
                data: {
                    work_status: work_status,
                    _token: '{{csrf_token()}}'
                },
                type: "post",
                success: function (data) {

                },
                error: function (reject) {
                    if( reject.status === 401 ) {
                        $(".errors-text").append("لا تملك الصلاحية للقيام بهذه العملية");
                        $('.alert-box').show();
                    }
                }
            });
        });
    </script>
    <script>

        $('#profile-image').click(function(){
            $('#image').click();
        });

        function handleUpload(event) {
            $('.alert-box').hide();
            var file = this.files[0];
            if (!file) return;
            var formData = new FormData();
            formData.append('_token', '{{csrf_token()}}');
            formData.append('image', file);
            return $.ajax({
                type: 'POST',
                url: '{{route("website.update-image")}}',
                data: formData,
                processData: false,
                contentType: false,
                success: function (data) {
                        $('#profile-image').attr('src', data.url);
                    },
                error: function (reject) {
                    if( reject.status === 401 ) {
                        $(".errors-text").append("لا تملك الصلاحية للقيام بهذه العملية");
                        $('.alert-box').show();
                    }
                    if( reject.status === 422 ) {
                        $(".errors-text").append("الملف غير مطابق للمعاير, يجب أن تكون صورة لا تتجاوز ال 2 ميغابايت");
                        $('.alert-box').show();
                    }
                }
            });
        }

        $('#image').on('change', handleUpload);

        function update(field){
            $('#'+field).hide();
            $('.'+field).show();
        }

        function updateData(){
            let name = $(".user-name").val();
            let bio = $(".user-bio").val();

            $.ajax({
                url:   "{{route('website.update-profile')}}",
                data: {
                    name: name,
                    bio: bio,
                    _token: '{{csrf_token()}}'
                },
                type: "post",
                success: function (data) {

                    $("#user-name").text(data.name);
                    $("#user-bio").text(data.bio);
                },
                error: function (reject) {
                    if( reject.status === 401 ) {
                        $(".errors-text").append("لا تملك الصلاحية للقيام بهذه العملية");
                        $('.alert-box').show();
                    }
                    if( reject.status === 422 ) {
                        $(".errors-text").append("يجب ان لايتجاوز النص المدخل عن 255 محرف");
                        $('.alert-box').show();
                    }
                }
            });
        }

        $('.custom-input').keydown(function(e){
            var field = $(this).data('field');
            if (e.keyCode == 13) {
                updateData(field);
            }
        });
        $('.custom-input').blur(function(e){
            var field = $(this).data('field');
            updateData(field);

        });


        // var share_link = '{{$share_link}}';
        var share_link = 'https://api.qrserver.com/v1/create-qr-code?data={{$share_link}}&size=200x200';
        function share_facebook(){
            window.open(
            'https://www.facebook.com/sharer/sharer.php?p[title]=my qr code&p[url]={{$share_link}}&u='+encodeURIComponent(share_link),
            'facebook-share-dialog',
            'width=626,height=436');
        }
        function share_twitter(){
            window.open("https://twitter.com/share?url="+ encodeURIComponent(window.location.href)+"&text="+document.title, '', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=300,width=600');return false;
        }
        function share_linkedin(){
            window.open("https://www.linkedin.com/shareArticle?mini=true&url="
                + encodeURIComponent(share_link)
                +"&title=منصة معاملة . كوم",'', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=300,width=600');return false;
        }
        function share_whatsapp(){
            var article = 'منصة معاملة . كوم';
            var weburl = share_link;
            var whats_app_message = encodeURIComponent(document.URL);
            var whatsapp_url = "whatsapp://send?text="+whats_app_message;
            window.location.href= whatsapp_url;
        }


        function Copy(text)
            {
                navigator.clipboard.writeText(text).then(() => {
                    alert('تم نسخ الرابط')
                })


            }

    </script>


    <script>

        $("#name-edit").on('click', function (e) {
            $(".info-profile").removeClass('d-flex');
            $(".edit-profile").removeClass('d-none');
            $(".edit-name").removeClass('d-none');
        });

        $("#excerpt-edit").on('click', function (e) {
            $(".info-profile").removeClass('d-flex');
            $(".edit-profile").removeClass('d-none');
            $(".edit-excerpt").removeClass('d-none');
        });

        $(".edit-profile-btn").on('click', function (e) {
            $(".info-profile").addClass('d-flex');
            $(".edit-profile").addClass('d-none');
            $(".edit-excerpt").addClass('d-none');
            $(".edit-name").addClass('d-none');
            updateData();
        });

    </script>

@endsection



