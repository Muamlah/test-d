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
                        <h3 class="mt-2 mb-1 font-700">
                            <a class="update" href="javascript:;" onclick="update('user-name');">
                                <i class="fas fa-pencil-alt"></i>
                            </a> 
                            <input type="text"  value="{{ auth()->user()->name }}" class="custom-input user-name" data-field="user-name" 
                            style="display:none" maxlength="60"> 
                            <span id="user-name">
                                {{ !empty(auth()->user()->name) ? auth()->user()->name : "الاسم المستعار" }}
                            </span>
                        </h3>
                        <p class="font-12 mt-n1 mb-0 pb-0">
                            <a class="update" href="javascript:;" onclick="update('user-bio');">
                                <i class="fas fa-pencil-alt"></i>
                            </a> 
                            <input type="text" value="{{ auth()->user()->bio }}" class="custom-input user-bio" data-field="user-bio" 
                            style="display:none" maxlength="100"> 
                            <span id="user-bio">
                                {{ !empty(auth()->user()->bio) ?  auth()->user()->bio : '--------'}}
                            </span>
                        </p>
                    </div>
                    <div class="mr-auto mt-3 pt-1">
                        <a href="#" data-menu="qrcode-show">
                            <i class="shadow-l fa qrcode-icon fa-qrcode"></i>
                        </a>
                    </div>
                </div>
            </div>
        @endguest
        <div class="card card-style">
            <div class="d-flex m-3 info-profile">
                <div class="list-group list-custom-small">
                    <a href="javascript:;" class="border-0">
                        <i class="fa font-13 fa-percent ml-1 rounded-s bg-red1-dark"></i>
                        <span class="font-13">كود الخصم الخاص بك :<p class="m-0 mr-1 d-inline"><em id="paragraph-copy1">{{@$user->reference_code}}</em></p></span>
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
        <div class="card card-style">
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
                    <a href="{{route('privateOrder.index')}}">
                        <i class="fa font-14 fa-box-open rounded-s bg-plum-dark"></i>

                        <span class="font-15">طلباتي</span>
                        <i class="fa fa-chevron-left opacity-30"></i>
                    </a>
                    <a href="{{route('privateService.index')}}">
                        <i class="fa font-14 fa-briefcase rounded-s bg-violet-light"></i>
                        <span class="font-15">خدماتي</span>
                        <i class="fa fa-chevron-left opacity-30"></i>
                    </a><a href="{{route('user.reviews')}}">
                        <i class="fa font-14 fa-star rounded-s bg-yellow1-dark"></i>
                        <span class="font-15">التقييمات</span>
                        <i class="fa fa-chevron-left opacity-30"></i>
                    </a>
                    <a href="#">
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
            {{-- <a href="#" onclick="share_facebook();" class="flex-fill icon icon-m text-center color-facebook border-bottom border-right"><i
                    class="fab font-12 fa-facebook-f"></i></a>
            <a href="#" class="flex-fill icon icon-m text-center color-twitter border-bottom border-right"><i
                    class="fab font-12 fa-twitter"></i></a>
            <a href="#" class="flex-fill icon icon-m text-center color-instagram border-bottom border-right"><i
                    class="fab font-12 fa-instagram"></i></a>
            <a href="#" class="flex-fill icon icon-m text-center color-whatsapp border-bottom border-right"><i
                    class="fab font-12 fa-whatsapp"></i></a>
            <a href="#" onclick="share_linkedin();" class="flex-fill icon icon-m text-center color-linkedin border-bottom border-right"><i
                    class="fab font-12 fa-linkedin-in"></i></a> --}}
            {{-- <a href="#" class="close-menu flex-fill icon icon-m text-center color-red2-dark border-bottom"><i
                    class="fa font-12 fa-times"></i></a> --}}
                    <div class="sharethis-inline-share-buttons" style="margin: 10px auto;"></div>
                    
        </div>
        <div class="qrcode-show mt-5 mb-auto">
            <div class="qrcode-container rounded-sm pb-4">
                <div class="menu-title text-center"><img data-src="{{asset("/template-muamlah/images/logo.png")}}" src="{{asset("/template-muamlah/images/empty.png")}}"
                                                         class="rounded-circle preload-img mt-n3" width="60">
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
        function updateData(field){
            $('#'+field).show();
            $('.'+field).hide();
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
                        $(".errors-text").append("يجب أن يكون النص المدخل لا يحتوي على رموز");
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
        var share_link = '{{$share_link}}';
        function share_facebook(){
            window.open(
            'https://www.facebook.com/sharer/sharer.php?p[title]=my qr code&p[url]={{$share_link}}&u='+encodeURIComponent(share_link), 
            'facebook-share-dialog', 
            'width=626,height=436'); 
        } 

        function Copy(text) 
            {
                var $temp = $("<input>");
                $("body").append($temp);
                $temp.val(text).select();
                document.execCommand("copy");
                $temp.remove();
                $("#copied").text("تم النسخ!").css('color','green');
                     
            }

    </script>
@endsection



